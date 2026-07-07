<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleTrip extends Model
{
    protected $fillable = [
        'vehicle_id',
        'driver_id',
        'departure_gate',
        'return_gate',
        'destination',
        'purpose_of_trip',
        'departure_at',
        'expected_return_at',
        'actual_return_at',
        'departure_odometer_km',
        'return_odometer_km',
        'distance_km',
        'remarks',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'departure_at' => 'datetime',
        'expected_return_at' => 'datetime',
        'actual_return_at' => 'datetime',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function passengers()
    {
        return $this->hasOne(VehicleTripPassenger::class);
    }
}

