<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'registration_number',
        'vehicle_type',
        'make_model',
        'year',
        'color',
        'owner_name',
        'owner_contact',
        'driver_name',
        'driver_license_number',
        'status',
        'remarks',
    ];
}
