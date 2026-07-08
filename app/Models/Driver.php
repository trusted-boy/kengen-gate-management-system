<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'employee_id',
        'full_name',
        'phone',
        'license_number',
        'license_expiry_date',
        'license_category',
        'status',
        'remarks',
    ];

    protected $casts = [
        'license_expiry_date' => 'date',
    ];

    public function trips()
    {
        return $this->hasMany(VehicleTrip::class, 'driver_id');
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'driver_vehicles', 'driver_id', 'vehicle_id')
            ->withTimestamps();
    }

}

