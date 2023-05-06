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
        $listings = Listing::all();
        $events = Event::all();

        return view('ListingsIndex', [
            'listings' => $listings,
            'events' => $events,
        ]);
    }

    public function show(Listing $listing): Factory|View|Application
    {
        return view('ListingsShow', [
            'listing' => $listing,
        ]);
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
