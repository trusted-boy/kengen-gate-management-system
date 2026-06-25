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
        'signature',
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
    ];
}
