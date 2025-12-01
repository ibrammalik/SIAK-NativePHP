<?php

namespace App\Filament\Resources\RWS\Schemas;

use App\Models\RT;
use App\Models\RW;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RWForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                // === Nomor RW ===
                TextInput::make('nomor')
                    ->label('Nomor RW')
                    ->placeholder('Contoh: 1')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->numeric()
                    ->hintIcon('heroicon-m-numbered-list')
                    ->hintIconTooltip('Isi dengan angka urut RW di wilayah Anda, misalnya 1, 2, atau 3.')
                    ->columnSpanFull(),

                // === Ketua RW ===
                Select::make('ketua_id')
                    ->label('Ketua RW')
                    ->relationship('ketua', 'nama')
                    ->getOptionLabelFromRecordUsing(fn($record) => "{$record->nama} — {$record->nik}")
                    ->hiddenOn('create')
                    ->preload()
                    ->searchable()
                    ->hintIcon('heroicon-m-user-circle')
                    ->hintIconTooltip('Pilih penduduk yang akan dijadikan Ketua RW.')
                    ->helperText('Pastikan penduduk sudah terdaftar di sistem penduduk.')
                    ->columnSpanFull()
                    ->rule(function (callable $get) {
                        return function (string $attribute, $value, \Closure $fail) use ($get) {
                            if (!$value) return;

                            // Cek apakah penduduk sudah menjadi ketua RW lain
                            $existsRw = RW::where('ketua_id', $value)
                                ->where('id', '!=', $get('id'))
                                ->exists();

                            if ($existsRw) {
                                $fail('Penduduk ini sudah terdaftar sebagai Ketua RW lain.');
                                return;
                            }

                            // Cek apakah penduduk sudah menjadi ketua RT
                            $existsRt = RT::where('ketua_id', $value)->exists();
                            if ($existsRt) {
                                $fail('Penduduk ini sudah terdaftar sebagai Ketua RT.');
                            }
                        };
                    }),
            ]);
    }
}
