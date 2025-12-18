<?php

namespace App\Filament\Resources\KategoriUsahas\Pages;

use App\Filament\Resources\KategoriUsahas\KategoriUsahaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKategoriUsahas extends ListRecords
{
    protected static string $resource = KategoriUsahaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
