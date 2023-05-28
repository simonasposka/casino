<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Service\ItemPriceService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index(): View
    {
        $storeItems = DB::table('store')
        ->join('items', 'store.item_id', '=', 'items.id')
        ->select('store.price', 'items.*')
        ->get();

        return view('StoreIndex', [
        'storeItems' => $storeItems
        ]);
    }

    public function show($id): View
    {
        $storeItem = DB::table('store')
        ->join('items', 'store.item_id', '=', 'items.id')
        ->select('store.price', 'items.*')
        ->where('store.item_id', $id)
        ->first();

    return view('StoreShow', [
        'storeItem' => $storeItem
    ]);
    }

    public function buy(Item $item): RedirectResponse
    {
        // Check if the user has enough balance to buy the item
        $wallet = Auth::user()->wallet;
        if ($wallet->balance < $item->price) {
            return redirect()->back()->with('error', 'Insufficient balance to buy the item');
        }

        // Update the wallet balance
        $wallet->balance -= $item->value;
        $wallet->save();

        // Purchase the item by assigning the user_id to the current user's ID
        $item->user_id = auth()->id();
        $item->save();

        // Remove the item from the store
        $store = Store::where('item_id', $item->id)->first();
        $store->delete();

        return redirect()->route('store.index')->with('message', 'Item purchased successfully');
    }


}
