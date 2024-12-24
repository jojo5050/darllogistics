<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'license',
        'license_expiry',
        'email',
        'address',
        'city',
        'state',
        'country',
        'status',
    ];
}
