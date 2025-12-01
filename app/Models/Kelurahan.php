<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'kelurahan';
    protected $fillable = [
        'nama',
        'kecamatan',
        'kota',
        'provinsi',
        'alamat',
        'telepon',
        'email',
        'kode_pos',
        'jam_pelayanan',
        'batas_utara',
        'batas_timur',
        'batas_selatan',
        'batas_barat',
        'visi',
        'misi',
        'layer_id',
        'hero_image_path',
        'struktur_organisasi_image_path',
    ];

    public function layer()
    {
        return $this->belongsTo(Layer::class);
    }
}
