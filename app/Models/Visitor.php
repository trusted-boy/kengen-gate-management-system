<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    // Mass assignable attributes
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

}
