<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteJob extends Model
{
    protected $fillable = [
        'route_id', 'jobType', 'address', 'date', 'time', 'jobDescription',
        'email', 'phone', 'appointmentID', 'trailerType', 'loadingMethod',
        'goodsDescription', 'rate', 'quantity', 'weightType'
    ];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
