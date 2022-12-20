<?php

namespace Database\Seeders;

use App\Models\Airplane;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Passenger;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $plane747 = Airplane::create([
            'typ'=>'747',
        ]);

        $airportZrh = Airport::create([
            'short_name'=>'ZRH',
            'name'=>'Zürich',
        ]);

        $airportLax = Airport::create([
            'short_name'=>'LAX',
            'name'=>'Los Angeles',
        ]);

        Flight::create([
            'number'=>'255686',
            'departure_date'=>Carbon::today(),
            'arrival_date'=>Carbon::tomorrow(),
            'airplane_id'=>$plane747->id,
            'start_airport_id'=>$airportZrh->id,
            'end_airport_id'=>$airportLax->id,
        ]);

        Flight::create([
            'number'=>'1988',
            'departure_date'=>Carbon::tomorrow()->addDays(1)->addMinutes(1),
            'arrival_date'=>Carbon::tomorrow()->addDays(2),
            'airplane_id'=>$plane747->id,
            'start_airport_id'=>$airportZrh->id,
            'end_airport_id'=>$airportLax->id,
        ]);

        $urs = Passenger::create([
            'email'=>'urs',
        ]);
        $martin = Passenger::create([
            'email'=>'martin',
        ]);
        $klaus = Passenger::create([
            'email'=>'klaus',
        ]);

        //$flight = Flight::first()->passengers()->attach($urs);
    }
}
