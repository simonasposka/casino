<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Service\ItemPriceService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Store;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{
    public function index(): View
    {
        $items = Item::all();
        $user = Auth::user();
        $items = $user->items;

        return view('ItemsIndex', [
           'items' => $items
        ]);
    }

    public function create(): View
    {
        return view('ItemsCreate');
    }

    public function store(Request $request, ItemPriceService $itemPriceService): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'description' => ['sometimes', 'string', 'min:1', 'max:2000'],
        ]);

        $itemName = $validated['name'];
        $item = new Item();
        $item->name = $itemName;
        $item->user_id = auth()->id();
        $item->description = $validated['description'];
        $item->value = $itemPriceService->getItemPrice($itemName);
        $item->save();

        return redirect()->route('items.index')->with('message', 'Item created');
    }

    public function show(Item $item): View
    {
        return view('ItemsShow', [
            'item' => $item
        ]);
    }

    public function edit(Item $item): View
    {
        return view('ItemsEdit', [
            'item' => $item
        ]);
    }

    public function update(Item $item, Request $request, ItemPriceService $itemPriceService): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'description' => ['sometimes', 'string', 'min:1', 'max:2000'],
        ]);

        $itemName = $validated['name'];
        $item->name = $itemName;
        $item->description = $validated['description'];
        $item->value = $itemPriceService->getItemPrice($itemName);
        $item->save();

        return redirect()->route('items.show', $item->id)->with('message', 'Item updated');
    }

    public function delete(Item $item): View
    {
        return view('ItemsDelete', [
            'item' => $item
        ]);
    }

    public function destroy(Item $item): RedirectResponse
    {
        if ($item->bet_id != null) {
            return redirect()->back()->with('error', 'Item cannot be deleted because it is in bet');
        } else {
            $item->delete();
            return redirect()->route('items.index')->with('message', 'Item deleted');
        }
    }
        public function sell(Item $item): RedirectResponse
    {
        // Check if the user is the owner of the item
        if (auth()->id() !== $item->user_id) {
            return redirect()->back()->with('error', 'You are not the owner of this item');
        }

        // "Sell" the item by setting its user_id to null
        $item->user_id = null;
        $item->save();

        $store = new Store();
        $store->item_id = $item->id;
        $store->price = $item->value;  // Assuming price = value of the item
        $store->save();

            // Update the wallet balance
        $wallet = Auth::user()->wallet;
        $wallet->balance += $item->value;  // Deduct the item price from the wallet balance
        $wallet->save();

        return redirect()->route('items.index')->with('message', 'Item sold');
    }
}
