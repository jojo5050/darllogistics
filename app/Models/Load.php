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
    ];

    public function assigned()
    {
        return $this->hasMany(AssignedLoad::class);
    }
}
