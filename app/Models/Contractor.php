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
    ];
}
