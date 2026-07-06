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
        'check_in_time',
        'check_out_time',
        'visit_status',
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
    ];

    /**
     * Get the duration of stay in minutes
     */
    public function getDurationAttribute()
    {
        if (!$this->check_out_time || $this->visit_status === 'IN') {
            return null;
        }

        return $this->check_out_time->diffInMinutes($this->check_in_time);
    }

    /**
     * Get formatted duration (HH:MM)
     */
    public function getFormattedDurationAttribute()
    {
        if (!$this->duration) {
            return null;
        }

        $hours = intdiv($this->duration, 60);
        $minutes = $this->duration % 60;

        return sprintf('%02d:%02d', $hours, $minutes);
    }
}
