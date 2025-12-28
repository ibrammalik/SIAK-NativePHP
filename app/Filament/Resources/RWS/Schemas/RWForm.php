<?php

namespace App\Filament\Resources\RWS\Schemas;

use App\Filament\Resources\Penduduks\Schemas\PendudukForm;
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
                    ->getSearchResultsUsing(function (string $search) {
                        return \App\Models\Penduduk::query()
                            ->where(function ($query) use ($search) {
                                $query
                                    ->where('nama', 'like', "%{$search}%")
                                    ->orWhere('nik', 'like', "%{$search}%");
                            })
                            ->limit(50)
                            ->pluck('nama', 'id')
                            ->map(fn($nama, $id) => [
                                'id' => $id,
                                'label' => \App\Models\Penduduk::find($id)->nama
                                    . ' — '
                                    . \App\Models\Penduduk::find($id)->nik,
                            ])
                            ->pluck('label', 'id');
                    })
                    ->hintIcon('heroicon-m-user-circle')
                    ->hintIconTooltip('Pilih penduduk yang akan dijadikan Ketua RW.')
                    ->helperText('Pilih Ketua RW dengan Nama atau NIK. Jika belum ada, daftarkan dengan tombol + di sebelah kanan kolom.')
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
                    })
                    ->createOptionModalHeading(fn($get) => "Buat Ketua RW {$get('nomor')}")
                    ->createOptionForm(PendudukForm::getFormSchema())
                    ->createOptionUsing(function (array $data) {
                        $penduduk = \App\Models\Penduduk::create($data);

                        if (($data['shdk'] ?? null) === 'Kepala' && !empty($data['keluarga_id'])) {
                            \App\Models\Keluarga::where('id', $data['keluarga_id'])
                                ->update(['kepala_id' => $penduduk->id]);
                        }

                        return $penduduk->id;
                    }),
            ]);
    }
}
