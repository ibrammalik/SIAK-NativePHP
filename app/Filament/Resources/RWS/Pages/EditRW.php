<?php

namespace App\Filament\Resources\RWS\Pages;

use App\Filament\Resources\RWS\RWResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRW extends EditRecord
{
    protected static string $resource = RWResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
