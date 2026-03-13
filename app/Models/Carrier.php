<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    protected $fillable = [
        'company_id', 
        'name', 
        'email', 
        'phone', 
        'mc_number', 
        'dot_number', 
        'country', 
        'city', 
        'state'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function route(){
        return $this->hasOne(Route::class);
    }
}
