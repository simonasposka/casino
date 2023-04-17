<?php

namespace App\Http\Controllers;

use App\Models\Event;
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

        return view('events.index', [
            'events' =>$allEvents
        ]);
    }
}
