<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    protected $fillable = [
        'user_id', 'broker', 'temperature', 'commodity', 'load_number', 'dispatcher_id', 'rate'
    ];

    public function pickups()
    {
        return $this->hasMany(Pickup::class);
    }

    public function drops()
    {
        return $this->hasMany(Drop::class);
    }

    public function assigned()
    {
        return $this->hasMany(AssignedLoad::class);
    }
}
