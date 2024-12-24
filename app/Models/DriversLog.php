<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriversLog extends Model
{
    protected $fillable = [
        'driver_id',
        'rate_confirmation_id',
        'rate_confirmation',
        'date_uploaded',
        'time_uploaded',
        'uploaded_by',
        'status',
        'comment',
    ];

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }
}
