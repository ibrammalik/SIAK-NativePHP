<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RW extends Model
{
    protected $table = 'rws';
    protected $fillable = ['nomor'];

    public function layer()
    {
        return $this->hasOne(Layer::class);
    }

    public function ketua()
    {
        return $this->belongsTo(Penduduk::class, 'ketua_id');
    }

    public function rt()
    {
        return $this->hasMany(RT::class, 'rw_id');
    }
}
