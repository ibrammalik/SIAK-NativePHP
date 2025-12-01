<?php

namespace App\Models;

use App\Enums\KategoriFasilitas;
use App\Enums\SubkategoriFasilitas;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitases';

    protected $fillable = [
        'kategori',
        'subkategori',
        'subkategori_lainnya',
        'nama',
        'alamat',
        'rw_id',
        'rt_id',
    ];

    protected $casts = [
        'kategori' => KategoriFasilitas::class,
        'subkategori' =>  SubkategoriFasilitas::class,
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
