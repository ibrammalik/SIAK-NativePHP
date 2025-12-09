<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriUsaha extends Model
{
    protected $fillable = ['name'];

    public function subkategoriUsaha()
    {
        return $this->hasMany(SubkategoriUsaha::class);
    }
}
