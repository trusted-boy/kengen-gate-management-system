<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternsAttachee extends Model
{
    protected $table = 'interns_attachees';

    protected $fillable = [
        'full_name',
        'id_number',
        'phone',
        'institution',
        'purpose',
        'department',
        'check_in_time',
        'check_out_time',
        'status',

    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
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

        $end = ($this->status === 'IN' || !$this->check_out_time) ? now() : $this->check_out_time;
        return $end->diffInMinutes($this->check_in_time);
    }

    /**
     * Human readable duration (e.g. 15 mins, 2 hrs 10 mins, 1 day 3 hrs)
     */
    public function getStayDurationHumanAttribute()
    {
        if (!$this->check_in_time) {
            return '-';
        }

        $end = ($this->status === 'IN' || !$this->check_out_time) ? now() : $this->check_out_time;
        $seconds = $end->diffInSeconds($this->check_in_time);

        $minsTotal = intdiv($seconds, 60);
        $days = intdiv($minsTotal, 1440);
        $minsRemainingAfterDays = $minsTotal % 1440;
        $hours = intdiv($minsRemainingAfterDays, 60);
        $mins = $minsRemainingAfterDays % 60;

        if ($days > 0) {
            $hrsPart = $hours > 0 ? " {$hours} hrs" : '';
            $daysPlural = $days > 1 ? 's' : '';
            return $days . ' day' . $daysPlural . $hrsPart;
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

        if ($this->status === 'IN' || !$this->check_out_time) {
            return 'Still Inside';
        }

        return $this->check_out_time->format('d/m/Y h:i A');
    }
}

