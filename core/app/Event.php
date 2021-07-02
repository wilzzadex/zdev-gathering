<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';

    public function lokasi()
    {
        return $this->hasOne(Lokasi::class,'id','lokasi_id');
    }
}
