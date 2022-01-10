<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassengerValue extends Model
{
    use HasFactory;

    public $fillable = [
        'passenger_id',
        'passenger_field_id',
        'value',
    ];
}
