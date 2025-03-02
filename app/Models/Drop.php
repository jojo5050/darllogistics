<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drop extends Model
{
    protected $fillable = ['load_id', 'address', 'drop_date', 'drop_time'];

    public function _load()
    {
        return $this->belongsTo(Load::class);
    }
}
