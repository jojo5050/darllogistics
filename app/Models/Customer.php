<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function shipments()
    {
        return $this->hasManyThrough(Shipment::class, Invoice::class, 'customer_id', 'id', 'id', 'shipment_id');
    }
}
