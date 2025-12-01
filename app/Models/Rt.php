<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    protected $table = 'rts';
    protected $fillable = ['rw_id', 'nomor'];

    public function rw()
    {
        return $this->belongsTo(RW::class);
    }

    public function layer()
    {
        return $this->hasOne(Layer::class);
    }

    public function ketua()
    {
        return $this->belongsTo(Penduduk::class, 'ketua_id');
    }
}
