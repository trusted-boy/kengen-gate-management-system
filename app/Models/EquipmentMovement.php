<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EquipmentMovement extends Model
{
    protected $fillable = [
        'equipment_name',
        'description',
        'equipment_type',
        'owner_name',
        'recipient_name',
        'check_out_time',
        'check_in_time',
        'status',
        'purpose',
        'remarks',
        'authorized_by_user_id',
    ];

    protected $casts = [
        'check_out_time' => 'datetime',
        'check_in_time' => 'datetime',
    ];

    public function authorizedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'authorized_by_user_id');
    }

    /**
     * For consistency with other register tables:
     * - Check-In Time  => check_out_time (equipment leaves store)
     * - Check-Out Time => check_in_time (equipment returned)
     */
    public function getCheckInTimeFormattedAttribute()
    {
        return $this->check_out_time ? $this->check_out_time->format('d/m/Y h:i A') : '-';
    }

    public function getCheckOutTimeFormattedAttribute()
    {
        if ($this->status === 'Out' || !$this->check_in_time) {
            return 'Still Inside';
        }

        return $this->check_in_time->format('d/m/Y h:i A');
    }

    public function getStayDurationHumanAttribute()
    {
        if (!$this->check_out_time) {
            return '-';
        }

        $end = ($this->status === 'Out' || !$this->check_in_time) ? now() : $this->check_in_time;
        $seconds = $end->diffInSeconds($this->check_out_time);

        $minsTotal = intdiv($seconds, 60);
        $days = intdiv($minsTotal, 1440);
        $minsRemainingAfterDays = $minsTotal % 1440;
        $hours = intdiv($minsRemainingAfterDays, 60);
        $mins = $minsRemainingAfterDays % 60;

        if ($days > 0) {
            $hrsPart = $hours > 0 ? " {$hours} hrs" : '';
            return "{$days} day{$days > 1 ? 's' : ''}{$hrsPart}";
        }

        if ($hours > 0) {
            return $mins > 0
                ? "{$hours} hr{$hours > 1 ? 's' : ''} {$mins} min{$mins > 1 ? 's' : ''}"
                : "{$hours} hr{$hours > 1 ? 's' : ''}";
        }

        return "{$minsTotal} min{$minsTotal > 1 ? 's' : ''}";
    }
}

