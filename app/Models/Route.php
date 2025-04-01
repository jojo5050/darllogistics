<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['user_id', 'vehicle_id', 'driver_id', 'dispatcher_id', 'load_name', 'load_number', 'broker_name', 'broker_email'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function jobs()
    {
        return $this->hasMany(RouteJob::class);
    }

    public function extraFees()
    {
        return $this->hasMany(ExtraFee::class);
    }
}
