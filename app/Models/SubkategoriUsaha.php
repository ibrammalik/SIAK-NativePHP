<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubkategoriUsaha extends Model
{
    protected $fillable = ['kategori_usaha_id', 'name'];

    public function kategoriUsaha()
    {
        return $this->belongsTo(KategoriUsaha::class);
    }
}
