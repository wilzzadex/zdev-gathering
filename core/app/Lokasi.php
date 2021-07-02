<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi';
    public $timestamps = false;

    public function gambar()
    {
        return $this->hasMany(Lokasi_Gambar::class, 'id','lokasi_id');
    }
}
