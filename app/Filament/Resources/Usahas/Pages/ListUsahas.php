<?php

namespace App\Filament\Resources\Usahas\Pages;

use App\Filament\Resources\Usahas\UsahaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUsahas extends ListRecords
{
    protected static string $resource = UsahaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
