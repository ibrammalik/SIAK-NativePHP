<?php

namespace App\Livewire\Pages;

use App\Enums\MarkerCategory;
use App\Livewire\BaseLayout;
use App\Models\Kelurahan;
use App\Models\Marker;

class Kontak extends BaseLayout
{
    protected string $pageTitle = 'Kontak';

    public function render()
    {
        $kelurahan = Kelurahan::query()->first();

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
            view('livewire.pages.kontak', [
                'data' => [
                    'alamat' => $kelurahan?->alamat,
                    'telepon' => $kelurahan?->telepon,
                    'email' => $kelurahan?->email,
                    'jam_pelayanan' => $kelurahan?->jam_pelayanan,
                ],
                'kantor' => $markers[0] ?? null,
            ])
        );
    }
}
