<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Listing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BetsController extends Controller
{
    public function store(Listing $listing, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'outcome' => ['required', 'int', 'min:0', 'max:1'],
        ]);

        $bet = new Bet();
        $bet->listing_id = $listing->id;
        $bet->creator_id = auth()->id();
        $bet->value = intval($validated['outcome']);
        $bet->save();

        return redirect()->back()->with('message', 'Bet created');
    }
    
}
