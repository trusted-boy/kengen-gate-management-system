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

        // Odometer / service reminders
        'current_odometer_km',
        'last_service_mileage_km',
        'service_interval_km',
        'last_service_date',
        'service_remarks',
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',

        'last_service_date' => 'date',
    ];

    /**
     * Duration in minutes (computed).
     * - When OUT: check_out_time - check_in_time
     * - When IN: now() - check_in_time
     */
    public function getDurationAttribute()
    {
        if (!$this->check_in_time) {
            return null;
        }

        $end = ($this->visit_status === 'IN' || !$this->check_out_time) ? now() : $this->check_out_time;
        return $end->diffInMinutes($this->check_in_time);
    }

    public function getStayDurationHumanAttribute()
    {
        if (!$this->check_in_time) {
            return '-';
        }

        $end = ($this->visit_status === 'IN' || !$this->check_out_time) ? now() : $this->check_out_time;
        $seconds = $end->diffInSeconds($this->check_in_time);

        $minsTotal = intdiv($seconds, 60);
        $days = intdiv($minsTotal, 1440);
        $minsRemainingAfterDays = $minsTotal % 1440;
        $hours = intdiv($minsRemainingAfterDays, 60);
        $mins = $minsRemainingAfterDays % 60;

        if ($days > 0) {
            $hrsPart = $hours > 0 ? " {$hours} hrs" : '';
            return $days . ' day' . ($days > 1 ? 's' : '') . $hrsPart;
        }

        if ($hours > 0) {
            $hrsPlural = $hours > 1 ? 's' : '';
            if ($mins > 0) {
                $minsPlural = $mins > 1 ? 's' : '';
                return $hours . ' hr' . $hrsPlural . ' ' . $mins . ' min' . $minsPlural;
            }

            return $hours . ' hr' . $hrsPlural;
        }

        $minsPlural = $minsTotal > 1 ? 's' : '';
        return $minsTotal . ' min' . $minsPlural;
    }

    public function getCheckInTimeFormattedAttribute()
    {
        return $this->check_in_time ? $this->check_in_time->format('d/m/Y h:i A') : '-';
    }

    public function getCheckOutTimeFormattedAttribute()
    {
        if (!$this->check_in_time) {
            return '-';
        }

        if ($this->visit_status === 'IN' || !$this->check_out_time) {
            return 'Still Inside';
        }

        return $this->check_out_time->format('d/m/Y h:i A');
    }

    public function trips()
    {
        return $this->hasMany(VehicleTrip::class, 'vehicle_id');
    }

    public function drivers()
    {
        return $this->belongsToMany(\App\Models\Driver::class, 'driver_vehicles', 'vehicle_id', 'driver_id')
            ->withTimestamps();
    }
}



