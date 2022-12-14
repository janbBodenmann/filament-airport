<?php

namespace App\Domain\Passenger;

use App\Models\Passenger;
use Carbon\Carbon;

class  FlightCollisionDetector{

    /**
     * @param Passenger $passenger
     * @return string
     */
    public static function run (Passenger $passenger) : string{

        foreach ($passenger->flights as $flight){
            /** @var Carbon $d  */
            $d = $flight->departure_date;

            foreach ($passenger->flights as $flightControl){
                if($flightControl === $flight) continue;
                if($flight->departure_date->gte($flightControl->departure_date) && $flight->arrival_date->gte($flightControl->departure_date))
                    return 'Collision by '.$flight->number.' and '.$flightControl->number;
            }
        }
        return 'Non Collision';
    }

}
