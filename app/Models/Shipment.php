<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'tracking_number',
        'origin',
        'destination',
        'status',
        'weight',
        'cost',
        'driver_id',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function customer()
    {
        return $this->hasOneThrough(Customer::class, Invoice::class, 'shipment_id', 'id', 'id', 'customer_id');
    }
}
