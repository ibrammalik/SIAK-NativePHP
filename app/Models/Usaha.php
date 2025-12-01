<?php

namespace App\Models;

use App\Enums\KategoriUsaha;
use App\Enums\SubkategoriUsaha;
use Illuminate\Database\Eloquent\Model;

class Usaha extends Model
{
    protected $table = 'usahas';

    protected $fillable = [
        'kategori',
        'subkategori',
        'subkategori_lainnya',
        'nama',
        'nama_pemilik',
        'alamat',
        'rw_id',
        'rt_id',
    ];

    protected $casts = [
        'kategori' => KategoriUsaha::class,
        'subkategori' =>  SubkategoriUsaha::class,
    ];

    public function rw()
    {
        return $this->belongsTo(RW::class);
    }

    public function rt()
    {
        return $this->belongsTo(RT::class);
    }
}
