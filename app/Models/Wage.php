<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wage extends Model
{
    protected $fillable = [
        'driver_id',
        'start_date',
        'end_date',
        'gross_pay',
        'amount_paid',
        'date_paid',
        'time_paid',
        'comment',
        'payment_method',
        'balance',
        'balance_paid',
        'balance_paid_date',
        'balance_paid_time',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
