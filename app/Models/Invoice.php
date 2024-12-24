<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'customer_id',
        'shipment_id',
        'amount',
        'invoice_date',
        'due_date',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}
