<?php

namespace App\Filament\Resources\Markers\Pages;

use App\Filament\Resources\Markers\MarkerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMarker extends EditRecord
{
    protected static string $resource = MarkerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
