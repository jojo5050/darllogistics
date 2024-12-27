<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'image_path',
        'country_id',
        'state_id',
        'address1',
        'address2',
        'gender',
        'zip_code',
        'payment_method',
        'currency',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
