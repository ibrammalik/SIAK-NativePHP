<?php

namespace App\Filament\Widgets;

use App\Models\Penduduk;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DistribusiUmurChart extends ChartWidget
{
    protected ?string $heading = 'Distribusi Umur';
    protected static ?int $sort = 2;
    protected static bool $isLazy = false;

    protected function getData(): array
    {
        $user = auth()->user();

        // Tentukan filter berdasarkan role
        $query = Penduduk::query();

        if ($user->isRT()) {
            $query->where('rt_id', $user->rt_id);
        } elseif ($user->isRW()) {
            $query->where('rw_id', $user->rw_id);
        }

        // Hitung umur berdasarkan tanggal lahir
        $data = $query
            ->select(DB::raw("
                CASE
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 4 THEN '0-4'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 5 AND 9 THEN '5-9'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 10 AND 14 THEN '10-14'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 15 AND 19 THEN '15-19'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 20 AND 29 THEN '20-29'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 30 AND 44 THEN '30-44'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 45 AND 59 THEN '45-59'
                    ELSE '60+' END AS kategori_umur,
                COUNT(*) AS total
            "))
            ->groupBy('kategori_umur')
            ->orderByRaw("MIN(TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()))")
            ->pluck('total', 'kategori_umur')
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
