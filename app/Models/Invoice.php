<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'route_id',
        'user_id',
        'total_earning',
        'vat',
        'discount',
        'driver_earning',
        'dispatcher_earning',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
