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
        if ($response->status() != ResponseAlias::HTTP_OK) {
            return $priceMean;
        }

        $responseMean = $this->findLowerPriceRange($response->body());

        if ($responseMean != 0) {
            if ($priceMean == 0) {
                $estimatedPrice = $this->calculateMean($priceMean + $responseMean, 1);
            } else {
                $estimatedPrice = $this->calculateMean($priceMean + $responseMean, 2);
            }
        } else {
            $estimatedPrice = $priceMean;
        }

        return $estimatedPrice;
    }

    private function findItemPriceLocally(string $itemName): int {
        $items = Item::where('name', '=', $itemName)->get();
        $priceMean = 0;
        $itemsCount = $items->count();

        switch ($itemsCount) {
            case 0:
            case 1:
                return $priceMean;
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
//        $prices = ["nuo 714.00 €",
//            "nuo 588.00 €",
//            "nuo 788.00 €",
//            "nuo 859.00 €",
//            "nuo 689.00 €",
//            "nuo 909.00 €",
//            "nuo 855.00 €",
//            "nuo 1049.00 €",
//            "nuo 899.00 €",
//            "nuo 1148.00 €",
//            "nuo 979.00 €",
//            "nuo 899.00 €",
//            "nuo 1239.00 €",
//            "nuo 1499.00 €",
//            "588.00 €",
//            "714.00 €",
//            "788.00 €",
//            "908.00 €",
//            "958.00 €",
//            "689.00 €",
//            "974.00 €",
//            "859.00 €",
//            "864.25 €",
//            "989.00 €",
//            "1179.00 €",
//            "1259.00 €",
//            "1499.00 €",
//            "728.00 €",
//            "798.00 €",
//            "839.00 €",
//            "899.00 €",
//            "904.00 €",
//            "964.00 €",
//            "1299.00 €"];

        // Create a new DOMDocument object
        $doc = new DOMDocument();
        $internalErrors = libxml_use_internal_errors(true);


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
//            echo $price->textContent . "\n";
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
