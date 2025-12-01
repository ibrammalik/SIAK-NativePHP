<?php

namespace App\Livewire\Pages;

use App\Enums\LayerType;
use App\Livewire\BaseLayout;
use App\Models\Layer;
use App\Models\Marker;

class Peta extends BaseLayout
{
    protected string $pageTitle = 'Peta';

    public function render()
    {
        $kelurahanLayers = Layer::where('type', LayerType::Kelurahan)
            ->get()
            ->map(fn($l) => [
                'name'  => $l->name,
                'color' => $l->color,
                'geo'   => $l->geojson,
                'type'  => 'Kelurahan',
            ]);

        $rwLayers = Layer::where('type', LayerType::RW)
            ->get()
            ->map(fn($l) => [
                'name'  => $l->name,
                'color' => $l->color,
                'geo'   => $l->geojson,
                'type'  => 'RW',
            ]);

        $rtLayers = Layer::where('type', LayerType::RT)
            ->get()
            ->map(fn($l) => [
                'name'  => $l->name,
                'color' => $l->color,
                'geo'   => $l->geojson,
                'type'  => 'RT',
            ]);

        $markers = Marker::all()
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
            view('livewire.pages.peta', [
                'layersKelurahan' => $kelurahanLayers,
                'layersRW'        => $rwLayers,
                'layersRT'        => $rtLayers,
                'markers'         => $markers,
            ])
        );
    }
}
