<?php

namespace App\Filament\Resources\KategoriUsahas\Pages;

use App\Filament\Resources\KategoriUsahas\KategoriUsahaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKategoriUsaha extends EditRecord
{
    protected static string $resource = KategoriUsahaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
