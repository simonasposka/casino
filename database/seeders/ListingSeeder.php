<?php

namespace Database\Seeders;
use App\Enums\ListingStatus;
use App\Models\Event;
use App\Models\Listing;
use Exception;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    /**
     * @throws Exception
     */
    public function run(): void
    {
        $this->createPendingListingFromEvent(EventSeeder::FIRST_ENDED_EVENT_ID);
        $this->createPendingListingFromEvent(EventSeeder::FIRST_PENDING_EVENT_ID);
    }

    private function createPendingListingFromEvent(int $eventId): void
    {
        $event = Event::find($eventId);
        if (!$event instanceof Event) {
            return;
        }

        $config = json_decode($event->config, true);

        $listing = new Listing();
        $listing->event_id = $eventId;
        $listing->outcome_label_one = $config['teams'][0]['name'] . ' wins';
        $listing->outcome_label_two = $config['teams'][1]['name'] . ' wins';
        $listing->status = ListingStatus::ACTIVE;
        $listing->save();
    }
}
