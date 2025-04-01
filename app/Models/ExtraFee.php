<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraFee extends Model
{
    protected $fillable = ['route_id', 'feeType', 'amount'];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
