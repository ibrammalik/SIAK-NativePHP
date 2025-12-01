<?php

namespace App\Filament\Resources\Layers\Pages;

use App\Filament\Resources\Layers\LayerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLayer extends CreateRecord
{
    protected static string $resource = LayerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return LayerResource::generateNameAndDescription($data);
    }
}
