<?php

namespace App\Filament\Pages;

use App\Models\Kelurahan;
use App\Models\RT;
use App\Models\RW;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use UnitEnum;

class LaporanMonografi extends Page
{
    protected string $view = 'filament.pages.laporan-monografi';
    public ?array $data = [
        'tipe' => null,
        'wilayah' => null,
        'kelurahan' => null,
        'rw' => null,
        'rt' => null,
    ];

    protected static string|BackedEnum|null $navigationIcon = "heroicon-s-document-text";
    protected static string|null $navigationLabel = "Laporan Monografi";
    protected static string|UnitEnum|null $navigationGroup = "Data Monografi";
    protected ?string $subheading = 'Pilih wilayah untuk menampilkan laporan monografi secara rinci.';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Select::make('tipe')
                    ->label('Tipe File')
                    ->options([
                        'pdf' => 'PDF',
                        'excel' => 'Excel',
                    ])
                    ->native(false)
                    ->columnSpanFull()
                    ->required(),

                Select::make('wilayah')
                    ->label('Wilayah')
                    ->options([
                        'kelurahan' => 'Kelurahan',
                        'rw' => 'RW',
                        'rt' => 'RT',
                    ])
                    ->live()
                    ->afterStateUpdated(function ($set) {
                        $set('kelurahan', null);
                        $set('rw', null);
                        $set('rt', null);
                    })
                    ->native(false)
                    ->columnSpanFull()
                    ->required(),

                Select::make('kelurahan')
                    ->label('Kelurahan')
                    ->options(Kelurahan::query()->pluck('nama', 'id'))
                    ->native(false)
                    ->preload()
                    ->visibleJs(<<<'JS'
                        $get('wilayah') === 'kelurahan'
                        JS)
                    ->columnSpanFull(),

                Select::make('rw')
                    ->columnSpanFull()
                    ->options(RW::query()->pluck('nomor', 'id'))
                    ->native(false)
                    ->preload()
                    ->visibleJs(<<<'JS'
                        $get('wilayah') === 'rw' || $get('wilayah') === 'rt'
                        JS)
                    ->label('RW')
                    ->live()
                    ->afterStateUpdated(fn($set) => $set('rt', null)),

                Select::make('rt')
                    ->columnSpanFull()
                    ->options(function ($get) {
                        if ($get('rw') === null) return [];
                        return RT::query()->where('rw_id', $get('rw'))->pluck('nomor', 'id');
                    })
                    ->native(false)
                    ->preload()
                    ->visibleJs(<<<'JS'
                        $get('wilayah') === 'rt'
                        JS)
                    ->label('RT'),
            ])
            ->statePath("data");
    }

    public function submit()
    {
        $data = $this->form->getState();

        $tipe = $data['tipe'];
        $wilayah = $data['wilayah'];
        $id = null;

        if ($wilayah === 'kelurahan') {
            $id = $data['kelurahan'];
        } elseif ($wilayah === 'rw') {
            $id = $data['rw'];
        } elseif ($wilayah === 'rt') {
            $id = $data['rt'];
        }

        if (!$id) {
            \Filament\Notifications\Notification::make()
                ->title('Mohon pilih wilayah dengan spesifik')
                ->danger()
                ->send();
            return;
        }

        $url = route('preview.monografi', [
            'wilayah' => $wilayah,
            'tipe' => $tipe,
            'id' => $id,
        ]);

        $this->js("
            window.open('{$url}', '_blank');
        ");
    }
}
