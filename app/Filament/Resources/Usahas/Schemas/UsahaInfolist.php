<?php

namespace App\Filament\Resources\Usahas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UsahaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kategori')
                    ->badge(),
                TextEntry::make('subkategori')
                    ->badge(),
                TextEntry::make('subkategori_lainnya'),
                TextEntry::make('nama'),
                TextEntry::make('nama_pemilik'),
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
