<?php

namespace Tests\Unit\Domain\Passenger;

use App\Domain\Passenger\FlightCollisionDetector;
use App\Models\Flight;
use App\Models\Passenger;
use Carbon\Carbon;
use Database\Seeders\FlightSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PassengerCollisionDetectorTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void {
        parent::setUp();
        $this->seed(FlightSeeder::class);
    }

    /**
     *
     * @return void
     */
    public function test_no_collision() : void
    {
        $passenger = Passenger::create([
            'email'=>'no-collision-passenger',
        ]);

        $flights = Flight::limit(2)->get();

        foreach ($flights as $flight){
            $flight->passengers()->attach($passenger);
        }

        $flightCollision = (new FlightCollisionDetector)($passenger);

        $this->assertFalse($flightCollision->collided);
    }

    /**
     *
     * @return void
     */
    public function test_with_collision_first_flight_starts_earlier() : void
    {
        $passenger = Passenger::create([
            'email'=>'collision-passenger',
        ]);

        $flights = Flight::limit(2)->get();

        $flights[0]->departure_date = Carbon::tomorrow()->addMinutes(1);
        $flights[0]->arrival_date = Carbon::tomorrow()->addDays(1)->addMinutes(1);
        $flights[0]->save();

        $flights[1]->departure_date = Carbon::tomorrow()->addHours(1);
        $flights[1]->arrival_date = Carbon::tomorrow()->addHours(1)->addMinutes(1);
        $flights[1]->save();

        foreach ($flights as $flight){
            $flight->passengers()->attach($passenger);
        }

        $flightCollision = (new FlightCollisionDetector)($passenger);

        $this->assertTrue($flightCollision->collided);
    }

    /**
     *
     * @return void
     */
    public function test_with_collision_first_flight_starts_later() : void
    {
        $passenger = Passenger::create([
            'email'=>'collision-passenger',
        ]);

        $flights = Flight::limit(2)->get();

        $flights[0]->departure_date = Carbon::tomorrow()->addHours(2);
        $flights[0]->arrival_date = Carbon::tomorrow()->addDays(1)->addMinutes(1);
        $flights[0]->save();

        $flights[1]->departure_date = Carbon::tomorrow()->addHours(1);
        $flights[1]->arrival_date = Carbon::tomorrow()->addDays(1)->addMinutes(1);
        $flights[1]->save();

        foreach ($flights as $flight){
            $flight->passengers()->attach($passenger);
        }

        $flightCollision = (new FlightCollisionDetector)($passenger);

        $this->assertTrue($flightCollision->collided);
    }
}
