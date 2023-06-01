<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Listing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;

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
    public function userBets(): View
    {
        $userId = auth()->id();
        $bets = Bet::with(['listing', 'listing.event'])
        ->where('creator_id', $userId)
        ->orWhere('participant_id', $userId)
        ->get();

        return view('MyBetsIndex', ['bets' => $bets]);
    }

    public function delete(Bet $bet): View
    {
        return view('BetsDelete', [
            'bet' => $bet
        ]);
    }

    public function destroy(Bet $bet): RedirectResponse
    {
        if ($bet->participant_id != null) {
            return redirect()->back()->with('error', 'bet cannot be deleted because other people joined this bet');
        } else {
            $bet->delete();
            return redirect()->route('bets.index')->with('message', 'bet deleted');
        }
    }

    public function edit(Bet $bet): View
    {
        $bet = Bet::find($bet->id)->load('listing');
        return view('BetsEdit', [
            'bet' => $bet
        ]);
    }
    public function update(Request $request, Bet $bet): RedirectResponse
    {
        if($bet->participant_id != null){
            return back()->withErrors(['participant' => 'Update not allowed. Participant ID is already set.']);
        }
        $validated = $request->validate([
            'outcome' => [
                'required',
                Rule::in([$bet->listing->outcome_label_one, $bet->listing->outcome_label_two]),
            ],
            // validate other fields...
        ]);

        // Determine if the chosen outcome is the first or the second one
        $outcomeValue = $validated['outcome'] == $bet->listing->outcome_label_one ? 0 : 1;

        // Update the bet
        $bet->value = $outcomeValue;
        $bet->save();

        return redirect()->route('bets.index', $bet->id)->with('message', 'Bet updated');
    }

}
