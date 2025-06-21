<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'user_id',
        'payroll_number',
        'invoice_id',
        'gross',
        'deductions',
        'net',
        'reimbursement',
        'grand_total',
        'comment',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
