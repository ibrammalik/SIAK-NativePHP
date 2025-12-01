<?php

namespace App\Filament\Resources\Markers\Pages;

use App\Filament\Resources\Markers\MarkerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMarkers extends ListRecords
{
    protected static string $resource = MarkerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
