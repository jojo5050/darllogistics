<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'ceo',
        'tel',
        'mobile',
        'country',
        'state',
        'city',
        'zip_code',
        'address',
        'po_box',
        'logo',
        'email',
        'email2',
        'whatsapp',
        'instagram',
        'twitter',
        'linkedin',
        'facebook',
        'website',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

}
