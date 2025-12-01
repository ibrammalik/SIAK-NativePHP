<?php

namespace App\Filament\Resources\RWS\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RWInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nomor')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('layer_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('ketua_id')
                    ->numeric()
                    ->placeholder('-'),
            ]);
    }
}
