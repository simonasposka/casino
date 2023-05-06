<?php

namespace App\Http\Controllers;

use App\Enums\ListingStatus;
use App\Models\Event;
use App\Models\Listing;
use App\Service\SportsApi;

class EventsController extends Controller
{
    public function index(SportsApi $api)
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
            if (is_null($listing)) {
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
}
