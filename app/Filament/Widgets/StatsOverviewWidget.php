<?php

namespace App\Filament\Widgets;

use App\Models\Keluarga;
use App\Models\Penduduk;
use App\Models\RT;
use App\Models\RW;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected static bool $isLazy = false;
    protected int|string|array $columnSpan = 'full';

    protected function getHeading(): ?string
    {
        $user = auth()->user();
        if ($user->isRW()) return "Statistik RW {$user->rw->nomor}, Kelurahan Kalicari";
        if ($user->isRT()) return "Statistik RT {$user->rt->nomor} / RW {$user->rt->rw->nomor}, Kelurahan Kalicari";
        return 'Statistik Kelurahan Kalicari';
    }

    protected function getDescription(): ?string
    {
        return 'Menampilkan ikhtisar statistik wilayah berdasarkan peran pengguna (Kelurahan, RW, atau RT).';
    }

    protected function getStats(): array
    {
        $user = auth()->user();

        $penduduk = Penduduk::query();
        $keluarga = Keluarga::query();
        $rw = Rw::query();
        $rt = Rt::query();

        // 🔎 Filter data berdasarkan role
        if ($user->isRT()) {
            $penduduk->where('rt_id', $user->rt_id);
            $keluarga->where('rt_id', $user->rt_id);
        } elseif ($user->isRW()) {
            $penduduk->where('rw_id', $user->rw_id);
            $keluarga->where('rw_id', $user->rw_id);
            $rt->where('rw_id', $user->rw_id);
        }

        // 🧮 Hitung data umum
        $totalPenduduk = $penduduk->count();
        $totalKeluarga = $keluarga->count();
        $totalRw = $rw->count();
        $totalRt = $rt->count();

        $laki = (clone $penduduk)->where('jenis_kelamin', 'L')->count();
        $perempuan = (clone $penduduk)->where('jenis_kelamin', 'P')->count();

        $umurSekarang = now();
        $lansia = (clone $penduduk)
            ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, ?) >= 60', [$umurSekarang])
            ->count();

        // 🎨 Dummy mini chart for aesthetic consistency
        $chart = [1, 1];

        // 🏢 Kelurahan
        if ($user->isKelurahan() || $user->isSuperAdmin()) {
            return [
                Stat::make('Total RW', $totalRw)
                    ->icon('heroicon-o-building-office-2')
                    ->chart($chart)
                    ->color('success')
                    ->description('Rukun Warga')
                    ->descriptionIcon('heroicon-o-building-office-2'),

                Stat::make('Total RT', $totalRt)
                    ->icon('heroicon-o-home-modern')
                    ->chart($chart)
                    ->color('warning')
                    ->description('Rukun Tetangga')
                    ->descriptionIcon('heroicon-o-home-modern'),

                Stat::make('Total KK', $totalKeluarga)
                    ->icon('heroicon-o-user-group')
                    ->chart($chart)
                    ->color('info')
                    ->description('Kepala Keluarga')
                    ->descriptionIcon('heroicon-o-user-group'),

                Stat::make('Total Penduduk', $totalPenduduk)
                    ->icon('heroicon-o-users')
                    ->chart($chart)
                    ->color('primary')
                    ->description('Jumlah Warga')
                    ->descriptionIcon('heroicon-o-users'),
            ];
        }

        // 🏘️ RW
        if ($user->isRW()) {
            return [
                Stat::make('Total RT', $totalRt)
                    ->icon('heroicon-o-home-modern')
                    ->chart($chart)
                    ->color('warning')
                    ->description('Jumlah RT di RW ini')
                    ->descriptionIcon('heroicon-o-home-modern'),

                Stat::make('Total KK', $totalKeluarga)
                    ->icon('heroicon-o-user-group')
                    ->chart($chart)
                    ->color('info')
                    ->description('Jumlah KK di RW ini')
                    ->descriptionIcon('heroicon-o-user-group'),

                Stat::make('Laki-laki / Perempuan', "{$laki} / {$perempuan}")
                    ->icon('heroicon-o-users')
                    ->chart($chart)
                    ->color('success')
                    ->description('Gender di RW ini')
                    ->descriptionIcon('heroicon-o-users'),

                Stat::make('Total Penduduk', $totalPenduduk)
                    ->icon('heroicon-o-user-group')
                    ->chart($chart)
                    ->color('primary')
                    ->description('Jumlah warga RW ini')
                    ->descriptionIcon('heroicon-o-user-group'),
            ];
        }

        // 🏠 RT
        return [
            Stat::make('Laki-laki / Perempuan', "{$laki} / {$perempuan}")
                ->icon('heroicon-o-user-group')
                ->chart($chart)
                ->color('success')
                ->description('Jenis Kelamin')
                ->descriptionIcon('heroicon-o-user-group'),

            Stat::make('Total KK', $totalKeluarga)
                ->icon('heroicon-o-users')
                ->chart($chart)
                ->color('info')
                ->description('Kepala Keluarga')
                ->descriptionIcon('heroicon-o-users'),

            Stat::make('Total Penduduk', $totalPenduduk)
                ->icon('heroicon-o-user-group')
                ->chart($chart)
                ->color('primary')
                ->description('Jumlah warga')
                ->descriptionIcon('heroicon-o-user-group'),

            Stat::make('Lansia (≥60)', $lansia)
                ->icon('heroicon-o-user')
                ->chart($chart)
                ->color('warning')
                ->description('Lanjut usia')
                ->descriptionIcon('heroicon-o-user'),
        ];
    }
}
