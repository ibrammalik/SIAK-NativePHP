<?php

namespace App\Livewire\Pages;

use App\Enums\JenisKelamin;
use App\Enums\MarkerCategory;
use App\Enums\Shdk;
use App\Livewire\BaseLayout;
use App\Models\Kelurahan;
use App\Models\Marker;
use App\Models\Penduduk;

/**
 * @method \Livewire\Component layout(string $layout, array $params = [])
 */
class Beranda extends BaseLayout
{
    protected string $pageTitle = 'Beranda';

    public function render()
    {
        $kelurahan = Kelurahan::first();

        // Normalize layer safely
        $geoLayer = $kelurahan?->layer?->geojson;
        $layerColor = $kelurahan?->layer?->color;

        $geoLayer = $geoLayer && $geoLayer !== "null" && $geoLayer !== "{}"
            ? $geoLayer
            : null;

        // ONLY load markers with category KantorKelurahan
        $markers = Marker::where('category', MarkerCategory::KantorKelurahan)
            ->get()
            ->map(function ($m) {
                return [
                    'name' => $m->name,
                    'lat'  => $m->latitude,
                    'lng'  => $m->longitude,
                    'icon' => $m->icon,
                    'color' => $m->color,
                    'desc' => $m->description,
                    'icon_html' => "<div class='marker-pin' style='--marker-color: {$m->color}'></div>"
                        . svg($m->icon, ['class' => "w-['14px'] h-['14px'] text-white"])->toHtml()
                ];
            });

        return $this->layoutWithData(
            view('livewire.pages.beranda', [
                'totalPenduduk' => Penduduk::count(),
                'totalLaki' => Penduduk::where('jenis_kelamin', JenisKelamin::L)->count(),
                'totalPerempuan' => Penduduk::where('jenis_kelamin', JenisKelamin::P)->count(),
                'totalKepalaKeluarga' => Penduduk::where('shdk', Shdk::Kepala)->count(),
                'geoLayer' => $geoLayer,
                'layerColor' => $layerColor,
                'hero_bg' => $kelurahan?->hero_image_path,
                'kantor' => $markers[0] ?? null,
            ])
        );
    }
}
