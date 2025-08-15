<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    protected $fillable = [
        'name',
        'phone1',
        'phone2',
        'email1',
        'email2',
        'city',
        'state',
        'country',
        'company_id',
    ];

    public function company(){
        return $this->belongsTo(company::class);
    }
}
