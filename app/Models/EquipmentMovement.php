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
}
