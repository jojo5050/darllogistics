<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $fillable = [
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
}
