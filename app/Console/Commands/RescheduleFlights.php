<?php

namespace App\Console\Commands;

use App\Jobs\ProcessFlightReschedule;
use App\Models\Flight;
use Illuminate\Console\Command;

class RescheduleFlights extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'airport:reschedule-flights';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reschedule Flights';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $flights = Flight::get();
        foreach ($flights as $flight){
            ProcessFlightReschedule::dispatch($flight)->delay(10);
        }
    }
}
