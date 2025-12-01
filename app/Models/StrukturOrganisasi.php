<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    protected $table = 'struktur_organisasi';

    protected $fillable = ['kelurahan_id', 'nama', 'jabatan', 'parent_id', 'foto_path'];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
