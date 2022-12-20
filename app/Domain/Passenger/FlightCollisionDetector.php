<?php

namespace App\Domain\Passenger;

use App\Models\Passenger;
use Carbon\Carbon;

class  FlightCollisionDetector {

    /**
     * @param Passenger $passenger
     * @return Collision
     */
    public function __invoke(Passenger $passenger): Collision {

        $collision = new Collision();

        foreach ($passenger->flights as $flight) {
            foreach ($passenger->flights as $flightControl) {
                if ($flightControl === $flight) {
                    continue;
                }

                /**
                 * |-----flight----|
                 *                     |----flightControl---|
                 */

                if ($flight->arrival_date->lt($flightControl->departure_date)) {
                    continue;
                }

                /**
                 *                           |-----flight----|
                 * |----flightControl---|
                 */

                if ($flight->departure_date->gt($flightControl->arrival_date)) {
                    continue;
                }

                /**
                 *                  |-----flight----|
                 * |----flightControl---|
                 *
                 * or
                 *
                 * |-----flight----|
                 *            |----flightControl---|
                 *
                 */

                $collision->text = 'Collision by ' . $flight->number . ' and ' . $flightControl->number;
                $collision->collided = true;
                return $collision;
            }

        }
        $collision->text = 'No Collision';
        return $collision;
    }
}
