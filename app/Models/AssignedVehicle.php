<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedVehicle extends Model
{
    protected $fillable = [
        'driver_id',
        'date_assigned',
        'status',
        'dropped_date',
        'load_id',
        'layover',
        'layover_amount',
        'payment_status',
        'payroll_status',
        'truck',
        'trailer',
        'tractor',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
