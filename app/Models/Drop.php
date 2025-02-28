<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drop extends Model
{
    protected $fillable = ['load_id', 'latitude', 'longitude', 'drop_date', 'drop_time'];

    public function _load()
    {
        return $this->belongsTo(Load::class);
    }
}
