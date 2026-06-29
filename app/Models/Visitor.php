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
        'department', // ADDED
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
    ];
}
