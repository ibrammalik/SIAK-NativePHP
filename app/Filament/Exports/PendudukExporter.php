<?php

namespace App\Filament\Exports;

use App\Models\Penduduk;
use Carbon\Carbon;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class PendudukExporter extends Exporter
{
    protected static ?string $model = Penduduk::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('rw')
                ->label('rw')
                ->getStateUsing(fn(Penduduk $record) => $record->rw?->nomor),

            ExportColumn::make('rt')
                ->label('rt')
                ->getStateUsing(fn(Penduduk $record) => $record->rt?->nomor),

            ExportColumn::make('no_kk')
                ->label('no_kk')
                ->getStateUsing(fn(Penduduk $record) => $record->keluarga?->no_kk),

            ExportColumn::make('nik')
                ->label('nik')
                ->getStateUsing(fn(Penduduk $record) => $record->nik),

            ExportColumn::make('nama')
                ->label('nama')
                ->getStateUsing(fn(Penduduk $record) => $record->nama),

            ExportColumn::make('no_telp')
                ->label('no_telp')
                ->getStateUsing(fn(Penduduk $record) => $record->no_telp),

            ExportColumn::make('tempat_lahir')
                ->label('tempat_lahir')
                ->getStateUsing(fn(Penduduk $record) => $record->tempat_lahir),

            ExportColumn::make('tanggal_lahir')
                ->label('tanggal_lahir')
                ->getStateUsing(fn(Penduduk $record) => $record->tanggal_lahir ? Carbon::parse($record->tanggal_lahir)->format('d/m/Y') : null),

            ExportColumn::make('jenis_kelamin')
                ->label('jenis_kelamin')
                ->getStateUsing(fn(Penduduk $record) => $record->jenis_kelamin),

            ExportColumn::make('agama')
                ->label('agama')
                ->getStateUsing(fn(Penduduk $record) => $record->agama),

            ExportColumn::make('pendidikan')
                ->label('pendidikan')
                ->getStateUsing(fn(Penduduk $record) => $record->pendidikan?->name),

            ExportColumn::make('status_perkawinan')
                ->label('status_perkawinan')
                ->getStateUsing(fn(Penduduk $record) => $record->status_perkawinan),

            ExportColumn::make('pekerjaan')
                ->label('pekerjaan')
                ->getStateUsing(fn(Penduduk $record) => $record->pekerjaan?->name),

            ExportColumn::make('status_kependudukan')
                ->label('status_kependudukan')
                ->getStateUsing(fn(Penduduk $record) => $record->status_kependudukan),

            ExportColumn::make('shdk')
                ->label('shdk')
                ->getStateUsing(fn(Penduduk $record) => $record->shdk),

            ExportColumn::make('alamat')
                ->label('alamat')
                ->getStateUsing(fn(Penduduk $record) => $record->keluarga?->alamat),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Proses ekspor data penduduk telah selesai dan ' . Number::format($export->successful_rows) . ' ' . str('baris')->plural($export->successful_rows) . ' berhasil diekspor.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('baris')->plural($failedRowsCount) . ' gagal diekspor.';
        }

        return $body;
    }
}
