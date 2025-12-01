<?php

namespace App\Filament\Resources\RTS\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RTInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('rw_id')
                    ->numeric(),
                TextEntry::make('nomor')
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
