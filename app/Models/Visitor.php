<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'full_name',
        'id_number',
        'phone',
        'organization',
        'host_name',
        'department',
        'purpose',
        'check_in_time',
        'check_out_time',
        'status',
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
    ];
}
