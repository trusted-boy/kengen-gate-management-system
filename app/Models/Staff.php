<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $fillable = [
        'staff_id',
        'full_name',
        'department',
        'vehicle_registration',
        'phone',
        'check_in_time',
        'check_out_time',
        'status',
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
