<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    protected $fillable = [
        'company_name',
        'contact_person',
        'email',
        'phone',
        'license_number',
        'license_expiry',
        'services_offered',
        'status',
        'remarks',
        'check_in_time',
        'check_out_time',
        'visit_status',
    ];

    protected $casts = [
        'license_expiry' => 'date',
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
