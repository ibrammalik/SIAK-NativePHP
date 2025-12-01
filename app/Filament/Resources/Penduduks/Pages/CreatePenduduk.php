<?php

namespace App\Filament\Resources\Penduduks\Pages;

use App\Enums\UserRole;
use App\Filament\Resources\Penduduks\PendudukResource;
use App\Models\Keluarga;
use Filament\Resources\Pages\CreateRecord;

class CreatePenduduk extends CreateRecord
{
    protected static string $resource = PendudukResource::class;

    protected function afterFill(): void
    {
        logger('its running');

        $id = request()->get('keluarga_id');

        $keluarga = \App\Models\Keluarga::find($id);

        if (!$keluarga) {
            return;
        }

        $user = auth()->user();

        if ($user->role === UserRole::KetuaRW && $user->rw->id !== $keluarga?->rw?->id) return;
        if ($user->role === UserRole::KetuaRT && $user->rt->id !== $keluarga?->rt?->id) return;

        $this->form->fill([
            'keluarga_id' => $keluarga?->id,
            'rw_id' => $keluarga?->rw?->id,
            'rt_id' => $keluarga?->rt?->id,
        ]);
    }

    protected function afterCreate(): void
    {
        $record = $this->record;

        if ($record->shdk === 'Kepala') {
            if ($record->keluarga_id) {
                Keluarga::where('id', $record->keluarga_id)
                    ->update(['kepala_id' => $record->id]);
            }
        }
    }
}
