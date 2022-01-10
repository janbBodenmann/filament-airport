<?php

namespace App\Filament\Resources\FlightResource\Pages;

use App\Filament\Resources\FlightResource;
use App\Models\Flight;
use Filament\Resources\Pages\ListRecords;

class ListFlights extends ListRecords
{
    protected static string $resource = FlightResource::class;

    public function toggleReady(Flight $flight){
        if($flight->ready){
            $flight->ready = false;
        }else{
            $flight->ready = true;
        }
        $flight->save();
    }
}
