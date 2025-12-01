<?php

namespace App\Filament\Resources\Keluargas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class KeluargaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('rw_id')
                    ->label('RW')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('rt_id')
                    ->label('RT')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('no_kk')
                    ->label('Nomor KK'),
                TextEntry::make('alamat')
                    ->label('Alamat')
                    ->placeholder('-'),
                TextEntry::make('kepala.nama')
                    ->label('Kepala Keluarga')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
