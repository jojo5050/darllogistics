<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'amount',
        'currency',
        'transaction_reference',
        'payment_method',
        'status',
        'gateway_response',
    ];
}
