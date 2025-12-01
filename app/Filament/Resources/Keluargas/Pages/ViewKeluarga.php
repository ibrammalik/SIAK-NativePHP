<?php

namespace App\Filament\Resources\Keluargas\Pages;

use App\Filament\Resources\Keluargas\KeluargaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKeluarga extends ViewRecord
{
    protected static string $resource = KeluargaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
