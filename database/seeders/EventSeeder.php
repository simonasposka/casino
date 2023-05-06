<?php

namespace Database\Seeders;
use App\Models\Event;
use App\Service\SportsApi;
use Exception;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public const FIRST_ENDED_EVENT_ID = 1;

    public const SECOND_ENDED_EVENT_ID = 2;

    public const FIRST_PENDING_EVENT_ID = 3;

    public const SECOND_PENDING_EVENT_ID = 4;

    private SportsApi $sportsApi;

    public function __construct()
    {
        $this->sportsApi = new SportsApi();
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $this->createEndedEvents();
        $this->cretePendingEvents();
    }

    /**
     * @throws Exception
     */
    private function createEndedEvents(): void
    {
        $events = $this->sportsApi->getEvents(2);

        foreach ($events as $event) {
            Event::createNewBasketballGameEvent($event);
        }
    }

    /**
     * @throws Exception
     */
    private function cretePendingEvents(): void
    {
        $events = array_map(function($event) {
            $event['date_of_event'] = $event['date_of_event'] + 3600;
            return $event;
        }, $this->sportsApi->getEvents(2));

        foreach ($events as $event) {
            Event::createNewBasketballGameEvent($event);
        }
    }
}
