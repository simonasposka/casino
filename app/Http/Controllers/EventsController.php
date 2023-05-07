<?php

namespace App\Http\Controllers;

use App\Enums\ListingStatus;
use App\Models\Event;
use App\Models\Listing;
use App\Service\SportsApi;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;

class EventsController extends Controller
{
    public function index(SportsApi $api): View
    {
        $events = [];// $api->getEvents();

        foreach ($events as $event) {
            $foundEvent = Event::where('uuid', '=', $event['uuid'])->first();
            if (!$foundEvent instanceof Event) {
                Event::createNewBasketballGameEvent($event);
            }
        }

        $allEvents = Event::all();

        return view('EventsIndex', [
            'events' =>$allEvents
        ]);
    }

    public function checkStartedEvents(): void
    {
        $events = Event::all();

        foreach ($events as $event) {
            /* @var Event $event */
            $listing = Listing::where('event_id', '=', $event->id)->first();

            if (is_null($listing) && $event->date_of_event < Carbon::now()) {
                $config = json_decode($event->config, true);
                $nListing = new Listing();
                $nListing->event_id = $event->id;
                $nListing->outcome_label_one = $config['teams'][0]['name'] . ' wins';
                $nListing->outcome_label_two = $config['teams'][1]['name'] . ' wins';
                $nListing->status = ListingStatus::ACTIVE;
                $nListing->save();
            }
        }
    }

    public function checkEnded(): void
    {
        $endedEvents = Event::where('date_of_event', '>', Carbon::now())->get();

        if ($endedEvents->isEmpty()) {
            return;
        } else {
            foreach ($endedEvents as $event) {
                $listings = Listing::where('event_id', '=', $event->id)->get();

                foreach ($listings as $listing) {
                    $listing->status = ListingStatus::ENDED;
                    $listing->save();

                    // TODO: isrinkti laimetoja
                }

                $event->delete();
            }
        }
    }
}
