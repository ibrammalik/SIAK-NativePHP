<?php

namespace App\Livewire\Pages;

use App\Enums\MarkerCategory;
use App\Livewire\BaseLayout;
use App\Models\Kelurahan;
use App\Models\Marker;
use App\Models\Penduduk;
use App\Models\RT;
use App\Models\RW;

class Profil extends BaseLayout
{
    protected string $pageTitle = 'Profil';

    public function render()
    {
        $kelurahan = Kelurahan::query()->first();
        // Normalize layer safely
        $geoLayer = $kelurahan?->layer?->geojson;
        $layerColor = $kelurahan?->layer?->color;

        $geoLayer = $geoLayer && $geoLayer !== "null" && $geoLayer !== "{}"
            ? $geoLayer
            : null;

        return $this->layoutWithData(
            view('livewire.pages.profil', [
                'batas' => [
                    'utara' => $kelurahan->batas_utara ?? null,
                    'selatan' => $kelurahan->batas_selatan ?? null,
                    'timur' => $kelurahan->batas_timur ?? null,
                    'barat' => $kelurahan->batas_barat ?? null,
                ],
                'kecamatan' => $kelurahan->kecamatan ?? null,
                'kota' => $kelurahan->kota ?? null,
                'visi' => $kelurahan->visi ?? null,
                'misi' => $kelurahan->misi ?? null,
                'luas_wilayah' => $kelurahan?->layer?->area ?? 0,
                'jumlah_penduduk' => Penduduk::count() ?? 0,
                'geoLayer' => $geoLayer,
                'layerColor' => $layerColor,
                'jumlah_rw' => RW::count() ?? 0,
                'jumlah_rt' => RT::count() ?? 0,
                'struktur_organisasi' => $kelurahan?->struktur_organisasi_image_path,
            ])
        );
    }
}
