<?php

namespace App\Filament\Resources\KategoriPendidikans\Pages;

use App\Filament\Resources\KategoriPendidikans\KategoriPendidikanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageKategoriPendidikans extends ManageRecords
{
    protected static string $resource = KategoriPendidikanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
