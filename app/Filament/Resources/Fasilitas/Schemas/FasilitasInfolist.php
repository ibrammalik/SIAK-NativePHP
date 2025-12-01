<?php

namespace App\Filament\Resources\Fasilitas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FasilitasInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kategori')
                    ->badge(),
                TextEntry::make('subkategori')
                    ->badge(),
                TextEntry::make('subkategori_lainnya')
                    ->placeholder('-'),
                TextEntry::make('nama'),
                TextEntry::make('alamat'),
                TextEntry::make('rw_id')
                    ->numeric(),
                TextEntry::make('rt_id')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
