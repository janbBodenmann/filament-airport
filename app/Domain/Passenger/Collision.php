<?php

namespace App\Domain\Passenger;

use App\Models\Passenger;
use Carbon\Carbon;

class Collision {
    public string $text = '';
    public bool $collided = false;
}
