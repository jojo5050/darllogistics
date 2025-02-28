<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    protected $fillable = ['load_id', 'latitude', 'longitude', 'pickup_date', 'pickup_time'];

    public function _load()
    {
        return $this->belongsTo(Load::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
