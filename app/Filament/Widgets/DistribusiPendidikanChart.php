<?php

namespace App\Filament\Widgets;

use App\Models\Penduduk;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DistribusiPendidikanChart extends ChartWidget
{
    protected ?string $heading = 'Distribusi Pendidikan';
    protected static ?int $sort = 2;
    protected static bool $isLazy = false;

    protected function getData(): array
    {
        $user = auth()->user();

        $query = Penduduk::query();

        if ($user->isRT()) {
            $query->where('rt_id', $user->rt_id);
        } elseif ($user->isRW()) {
            $query->where('rw_id', $user->rw_id);
        }

        $data = $query
            ->select('pendidikan', DB::raw('COUNT(*) as total'))
            ->groupBy('pendidikan')
            ->orderBy('pendidikan')
            ->pluck('total', 'pendidikan')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Penduduk',
                    'data' => array_values($data),
                ],
            ],
            'labels' => array_keys($data),
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
                        'precision' => 0, // This forces integer values
                    ],
                ],
            ],
        ];
    }
}
