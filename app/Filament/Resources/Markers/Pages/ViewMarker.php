<?php

namespace App\Filament\Resources\Markers\Pages;

use App\Filament\Resources\Markers\MarkerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMarker extends ViewRecord
{
    protected static string $resource = MarkerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
