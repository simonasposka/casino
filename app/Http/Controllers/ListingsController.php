<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Listing;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ListingsController extends Controller
{
    public function index(): Factory|View|Application
    {
        $listings = Listing::all()->load('event');

        return view('ListingsIndex', [
            'listings' => $listings,
        ]);
    }

    public function show(Listing $listing): Factory|View|Application
    {
        $data = [
            'listing' => $listing->load([
                'event',
                'bets' => function($query) {
                    return $query->with(['creator', 'items']);
                }
            ])->toArray(),
        ];

        // Calculate total bet values
        $data = array_map(function($listing) {
            $bets = array_map(function($bet) {
                $totalValue = 0;

                foreach ($bet['items'] as $item) {
                    $totalValue += $item['value'];
                }

                $bet['total_value'] = $totalValue;
                return $bet;
            }, $listing['bets']);

            $listing['bets'] = $bets;
            return $listing;
        }, $data);

        return view('ListingsShow', $data);
    }

    public function create(): Factory|View|Application
    {
        return view('ListingsCreate', [
            'events' => Event::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_label' => ['required', 'string', 'min:1', 'max:255'],
            'second_label' => ['required', 'string', 'min:1', 'max:255'],
            'event_id' => ['required', 'int', 'min:1']
        ]);

        Listing::createNewListing(
            $validated['first_label'],
            $validated['second_label'],
            $validated['event_id'],
        );

        // TODO: prognozuoti varzybu baigti
        return redirect()->route('listings.index')->with('message', 'Listing successfully created');
    }
}
