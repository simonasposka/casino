<?php

namespace App\Service;

use App\Models\Item;
use DOMDocument;
use DOMXPath;
use Exception;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ItemPriceService
{
    protected const API_URL = 'https://www.kaina24.lt/search?q=';

    public function getItemPrice(string $itemName): int
    {
        $priceMean = $this->findItemPriceLocally($itemName);

        $response = Http::get(self::API_URL . str_replace(' ', '+', $itemName));
        if ($response->status() == ResponseAlias::HTTP_OK) {
            $responseMean = $this->findLowerPriceRange($response->body());

            if ($responseMean != 0) {
                if ($priceMean != 0) {
                    $estimatedPrice = $this->calculateMean($priceMean + $responseMean, 2);
                } else {
                    $estimatedPrice = $this->calculateMean($priceMean + $responseMean, 1);
                }
            } else {
                $estimatedPrice = $priceMean;
            }

            return $estimatedPrice;
        } else {
            return $priceMean;
        }
    }

    private function findItemPriceLocally(string $itemName): int {
        $items = Item::where('name', '=', $itemName)->get();
        $itemsCount = $items->count();

        switch ($itemsCount) {
            case 0:
            case 1:
                $priceMean = 0;
                break;
            case 2:
                $priceMean = $items->last()->value; // first one will contain my value
                break;
            default:
                $sum = 0;
                foreach ($items as $item) {
                    $sum += $item->value;
                }

                $priceMean = $this->calculateMean($sum, $itemsCount);
                break;
        }

        return $priceMean;
    }

    private function calculateMean(int $sum, int $itemsCount): int
    {
        return floor($sum / $itemsCount);
    }

    private function findLowerPriceRange(string $response): int
    {
        // Create a new DOMDocument object
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);

        // Load the HTML content from a file or string
        $doc->loadHTML($response);

        // Create a new DOMXPath object to query the document
        $xpath = new DOMXPath($doc);

        // Find all paragraphs with class name "price"
        $prices = $xpath->query('//p[@class="price"]');
        $pricesFromResponse = [];
        $count = 0;
        // Loop through the results and output the text content of each paragraph
        foreach ($prices as $price) {
            if ($count == 3) { break; } // only take first 3 values

            $pricesFromResponse[] = $price->textContent;
            $count += 1;
        }

        $pricesCount = count($pricesFromResponse);
        if ($pricesCount == 0) {
            return 0;
        }

        $responsePriceSum = 0;

        foreach ($pricesFromResponse as $priceFromResponse) {
            $parts = explode(' ', $priceFromResponse);

            if (count($parts) == 3) {
                $responsePriceSum += floatval($parts[1]);
            }

            if (count($parts) == 2) {
                $responsePriceSum += floatval($parts[0]);
            }
        }

        return $this->calculateMean($responsePriceSum * 100, $pricesCount);
    }
}
