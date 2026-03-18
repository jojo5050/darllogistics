<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryProof extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
        'route_id',
        'deliveryProof',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
