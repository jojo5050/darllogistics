<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffSalary extends Model
{
    protected $fillable = [
        'user_id',
        'gross_salary',
        'deductions',
        'net_salary',
        'payment_date',
        'payment_method',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
