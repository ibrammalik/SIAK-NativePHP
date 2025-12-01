<?php

namespace App\Filament\Resources\Fasilitas\Schemas;

use App\Enums\KategoriFasilitas;
use App\Enums\SubkategoriFasilitas;
use App\Models\RT;
use App\Models\RW;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class FasilitasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kategori')
                    ->label('Kategori')
                    ->options(KategoriFasilitas::class)
                    ->native(false)
                    ->live()
                    ->afterStateUpdated(function ($set) {
                        $set('subkategori', null);
                        $set('subkategori_lainnya', null);
                    })
                    ->required()
                    ->hintIcon('heroicon-o-information-circle')
                    ->hintIconTooltip('Pilih kategori utama fasilitas'),

                Select::make('subkategori')
                    ->label('Sub Kategori')
                    ->options(
                        fn($get) => collect(SubkategoriFasilitas::byKategori($get('kategori')))
                            ->mapWithKeys(fn(SubkategoriFasilitas $item) => [
                                $item->value => $item->getLabel(),
                            ])
                            ->toArray()
                    )
                    ->native(false)
                    ->live()
                    ->required()
                    ->hintIcon('heroicon-o-information-circle')
                    ->hintIconTooltip('Pilih subkategori sesuai jenis fasilitas. Jika subkategori tidak ada, pilih "Lainnya"'),

                TextInput::make('subkategori_lainnya')
                    ->label('Sub Kategori Lainnya')
                    ->visible(fn($get) => $get('subkategori') === SubkategoriFasilitas::LAINNYA->value)
                    ->columnSpanFull()
                    ->hintIcon('heroicon-o-information-circle')
                    ->hintIconTooltip('Isi jika subkategori belum tersedia'),

                TextInput::make('nama')
                    ->label('Nama Fasilitas')
                    ->columnSpanFull()
                    ->required()
                    ->hint('Nama fasilitas sesuai dengan dokumen resmi jika ada')
                    ->helperText('Contoh: SD Negeri 02 Kalicari'),

                Select::make('rw_id')
                    ->label('RW')
                    ->relationship('rw', 'nomor', modifyQueryUsing: function (Builder $query) {
                        $user = auth()->user();
                        if ($user->isRW() || $user->isRT()) {
                            $query->where('id', $user->rw_id);
                        }
                    })
                    ->getOptionLabelFromRecordUsing(fn(RW $rw) => "RW {$rw->nomor}")
                    ->afterStateUpdated(fn(callable $set) => $set('rt_id', null))
                    ->live()
                    ->preload()
                    ->searchable()
                    ->required()
                    ->hintIcon('heroicon-o-map')
                    ->hintIconTooltip('Pilih RW tempat fasilitas berada. RW mempengaruhi daftar RT yang tersedia'),

                Select::make('rt_id')
                    ->label('RT')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->relationship('rt', 'nomor', modifyQueryUsing: function (Builder $query, $get) {
                        $user = auth()->user();
                        $query->where('rw_id', $get('rw_id'));

                        if ($user->isRT()) {
                            $query->where('id', $user->rt_id);
                        }
                    })
                    ->getOptionLabelFromRecordUsing(fn(RT $rt) => "RT {$rt->nomor}")
                    ->hintIconTooltip('Pilih RT sesuai RW yang dipilih')
                    ->hintIcon('heroicon-o-map'),

                Textarea::make('alamat')
                    ->columnSpanFull()
                    ->required()
                    ->hint('Alamat lengkap fasilitas')
            ]);
    }
}
