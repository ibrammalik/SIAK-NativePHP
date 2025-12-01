<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $table = 'keluargas';
    protected $fillable = ['no_kk', 'kepala_id', 'alamat', 'rt_id', 'rw_id'];

    public function kepala()
    {
        return $this->belongsTo(Penduduk::class, 'kepala_id');
    }

    public function rw()
    {
        return $this->belongsTo(RW::class);
    }

    public function rt()
    {
        return $this->belongsTo(RT::class);
    }

    public function penduduks()
    {
        return $this->hasMany(Penduduk::class);
    }
}
