<?php

namespace App\Filament\Resources\PassengerResource\Pages;

use App\Filament\Resources\PassengerResource;
use App\Models\Airport;
use App\Models\PassengerField;
use App\Models\PassengerValue;
use Filament\Resources\Pages\CreateRecord;

class CreatePassenger extends CreateRecord
{
    protected static string $resource = PassengerResource::class;


    public function afterCreate()
    {
        foreach (PassengerField::get() as $passengerField) {
            foreach ($this->data as $key => $data) {
                if ($key == $passengerField->short_name) {
                    PassengerValue::create([
                        'passenger_id' => $this->record->id,
                        'passenger_field_id' => $passengerField->id,
                        'value' => $data,
                    ]);
                }
            }
        }
    }
}
