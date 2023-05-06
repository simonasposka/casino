<?php

namespace App\Console\Commands;

use App\Http\Controllers\EventsController;
use Illuminate\Console\Command;

class PendingEventsJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pending:events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    private EventsController $eventsController;

    public function __construct(EventsController $eventsController)
    {
        parent::__construct();
        $this->eventsController = $eventsController;
    }

    /**
     * Execute the console command.
     *
     */
    public function handle(): void
    {
        $this->eventsController->checkStartedEvents();
    }
}
