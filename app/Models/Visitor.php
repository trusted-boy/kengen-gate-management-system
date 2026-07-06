<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'full_name',
        'id_number',
        'phone',
        'vehicle_registration',
        'number_of_visitors',
        'reason_for_visit',
        'host_name',
        'whom_to_see',
        'purpose',
        'check_in_time',
        'check_out_time',
        'status',
        'signature',
        'department',
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
        if (!$this->check_out_time || $this->status === 'IN') {
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
