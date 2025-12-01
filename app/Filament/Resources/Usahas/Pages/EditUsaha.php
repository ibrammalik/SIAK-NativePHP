<?php

namespace App\Filament\Resources\Usahas\Pages;

use App\Filament\Resources\Usahas\UsahaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUsaha extends EditRecord
{
    protected static string $resource = UsahaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
