<?php

namespace App\Jobs;

use App\Models\Flight;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessFlightReschedule implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $flight;

    /**
     * Create a new job instance.
     *
     * @param Flight $flight
     */
    public function __construct(Flight $flight)
    {
        $this->flight = $flight;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->flight->departure_date = $this->flight->departure_date->addHour();
        $this->flight->arrival_date = $this->flight->arrival_date->addHour();
        $this->flight->save();
    }
}
