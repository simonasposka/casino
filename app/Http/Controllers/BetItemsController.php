<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BetItemsController extends Controller
{
    public function create(int $listingId, int $betId): View
    {
        /* @var Collection $items */
        $items = auth()->user()->items;
        $items = $items->filter(function (Item $item) {
            return is_null($item->bet_id);
        });

        return view('AddItemToBet', [
            'items' => $items,
            'listingId' => $listingId,
            'betId' => $betId
        ]);
    }

    public function store(int $listingId, int $betId, Request $request): RedirectResponse
    {
        $itemId = intval($request->get('item_id'));

        /* @var Item $item */
        $item = Item::find($itemId);
        $item->bet_id = $betId;
        $item->save();

        return redirect(route('listings.show', $listingId))->with('message', 'Item added to bet');
    }
}
