<?php

namespace App\Filament\Resources\RWS\Pages;

use App\Filament\Resources\RWS\RWResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRWS extends ListRecords
{
    protected static string $resource = RWResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
