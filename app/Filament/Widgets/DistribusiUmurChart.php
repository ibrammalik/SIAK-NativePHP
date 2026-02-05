<?php

namespace App\Filament\Widgets;

use App\Filament\Concerns\ResolvesWilayah;
use App\Models\Penduduk;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class DistribusiUmurChart extends ChartWidget
{
    use InteractsWithPageFilters, ResolvesWilayah;

    protected ?string $heading = 'Distribusi Umur';
    protected static ?int $sort = 2;
    protected static bool $isLazy = false;

    protected function getData(): array
    {
        $state = $this->resolveWilayah();

        $query = Penduduk::query();

        if ($state['wilayah'] === 'rw') {
            $query->where('rw_id', $state['rw']->id);
        }

        if ($state['wilayah'] === 'rt') {
            $query->where('rt_id', $state['rt']->id);
        }

        $penduduks = $query
            ->select('tanggal_lahir')
            ->get();

        $groups = [
            '0-4'   => 0,
            '5-9'   => 0,
            '10-14' => 0,
            '15-19' => 0,
            '20-24' => 0,
            '25-29' => 0,
            '30-34' => 0,
            '35-39' => 0,
            '40-44' => 0,
            '45-49' => 0,
            '50-54' => 0,
            '55-59' => 0,
            '60-64' => 0,
            '65+'   => 0,
        ];

        foreach ($penduduks as $p) {
            if (!$p->tanggal_lahir) {
                continue;
            }

            $age = Carbon::parse($p->tanggal_lahir)->age;

            match (true) {
                $age <= 4   => $groups['0-4']++,
                $age <= 9   => $groups['5-9']++,
                $age <= 14  => $groups['10-14']++,
                $age <= 19  => $groups['15-19']++,
                $age <= 24  => $groups['20-24']++,
                $age <= 29  => $groups['25-29']++,
                $age <= 34  => $groups['30-34']++,
                $age <= 39  => $groups['35-39']++,
                $age <= 44  => $groups['40-44']++,
                $age <= 49  => $groups['45-49']++,
                $age <= 54  => $groups['50-54']++,
                $age <= 59  => $groups['55-59']++,
                $age <= 64  => $groups['60-64']++,
                default     => $groups['65+']++,
            };
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Penduduk',
                    'data' => array_values($groups),
                ],
            ],
            'labels' => array_keys($groups),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }
}
