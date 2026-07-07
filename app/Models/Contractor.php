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
            $dayLabel = $days > 1 ? 'days' : 'day';

return $days . ' ' . $dayLabel . $hrsPart;
        }

        if ($hours > 0) {
            $hourLabel = $hours > 1 ? 'hrs' : 'hr';
$minLabel = $mins > 1 ? 'mins' : 'min';

if ($mins > 0) {
    return $hours . ' ' . $hourLabel . ' ' . $mins . ' ' . $minLabel;
}

return $hours . ' ' . $hourLabel;
        }

        $minLabel = $minsTotal > 1 ? 'mins' : 'min';

return $minsTotal . ' ' . $minLabel;
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
}

