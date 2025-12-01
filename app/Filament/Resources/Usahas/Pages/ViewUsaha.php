<?php

namespace App\Filament\Resources\Usahas\Pages;

use App\Filament\Resources\Usahas\UsahaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUsaha extends ViewRecord
{
    protected static string $resource = UsahaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
