<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedLoad extends Model
{
    protected $fillable = [
        'load_id',
        'driver_id',
        'date_assigned',
        'status',
    ];

    public function _load()
    {
        return $this->belongsTo(Load::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
