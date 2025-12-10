<?php

namespace App\Filament\Resources\KategoriUsahas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KategoriUsahaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Kategori')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}
