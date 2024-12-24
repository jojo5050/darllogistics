<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'country_id',
        'state',
        'address1',
        'address2',
        'gender',
        'currency',
        'zip_code',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
