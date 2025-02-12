<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    protected $fillable = [
        'user_id',
        'pickup_state',
        'pickup_time_range',
        'pickup_address',
        'vehicleType',
        'loading_method',
        'temperature',
        'commodities',
        'rate',
        'driver_id',
        'vehicle_id',
        'dispatcher_id',
        'fee_type',
        'amount'
    ];

    public function assigned()
    {
        return $this->hasMany(AssignedLoad::class);
    }
}
