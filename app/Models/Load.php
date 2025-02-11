<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    protected $fillable = [
        'description',
        'pickup_date',
        'delivery_date',
        'weight',
        'pickup_state',
        'pickup_time_range',
        'pickup_address',
        'vehicleType',
        'loading_method',
        'temperature',
        'commodities',
        'rate',
        'driver_id',
        'assigned_vehicle_id',
        'dispatcher_id',
        'fee_type',
        'amount'
    ];

    public function assigned()
    {
        return $this->hasMany(AssignedLoad::class);
    }
}
