<?php

namespace App\Filament\Resources\RWS\Pages;

use App\Filament\Resources\RWS\RWResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRW extends ViewRecord
{
    protected static string $resource = RWResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
