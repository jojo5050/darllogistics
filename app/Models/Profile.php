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
        'city_id',
        'dot_number',
        'mc_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
