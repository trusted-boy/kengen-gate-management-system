<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleTripPassenger extends Model
{
    protected $fillable = [
        'vehicle_trip_id',
        'staff_count',
        'attachee_count',
        'contractor_count',
        'visitor_count',
        'total_occupants',
        'staff_names',
        'attachee_names',
        'contractor_names',
        'visitor_names',
    ];

    public function trip()
    {
        return $this->belongsTo(VehicleTrip::class, 'vehicle_trip_id');
    }
}

