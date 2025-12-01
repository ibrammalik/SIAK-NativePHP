<?php

namespace App\Filament\Resources\Penduduks\Pages;

use App\Filament\Resources\Penduduks\PendudukResource;
use App\Models\Keluarga;
use App\Models\Penduduk;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPenduduk extends EditRecord
{
    protected static string $resource = PendudukResource::class;

    public ?string $oldStatus = null; // temporary property

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function beforeFill(): void
    {
        // Store the original value before Filament fills the form
        $this->oldStatus = $this->record->shdk;
        logger($this->record->shdk .  ' from before fill');
    }

    protected function beforeSave(): void
    {
        // Always fetch the latest value from DB before saving
        $fresh = $this->record->fresh();
        $this->oldStatus = $fresh->shdk ?? $this->record->shdk;
    }

    protected function afterSave(): void
    {
        $record = $this->record;

        logger($this->oldStatus . ' from after save');

        // CASE 1: If changed from Kepala → something else
        if ($this->oldStatus === 'Kepala' && $record->shdk !== 'Kepala') {
            if ($record->keluarga_id) {
                Keluarga::where('id', $record->keluarga_id)
                    ->update(['kepala_id' => null]);
            }
        }

        // CASE 2: If now Kepala → make sure keluarga.kepala_id = this penduduk
        if ($record->shdk === 'Kepala' && $record->keluarga_id) {
            Keluarga::where('id', $record->keluarga_id)
                ->update(['kepala_id' => $record->id]);
        }
    }
}
