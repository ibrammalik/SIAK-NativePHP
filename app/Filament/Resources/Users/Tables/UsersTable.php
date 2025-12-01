<?php

namespace App\Filament\Resources\Users\Tables;

use App\Enums\UserRole;
use App\Models\RT;
use App\Models\RW;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('role')
                    ->label('Role')
                    ->searchable()
                    ->badge(),

                TextColumn::make('wilayah')
                    ->label('Wilayah')
                    ->state(function ($record) {
                        switch ($record->role) {
                            case UserRole::AdminKelurahan:
                                return 'Kelurahan';

                            case UserRole::KetuaRW:
                                return $record->rw?->nomor
                                    ? 'RW ' . $record->rw->nomor
                                    : '-';

                            case UserRole::KetuaRT:
                                $rt = $record->rt?->nomor ? 'RT ' . $record->rt->nomor : '-';
                                $rw = $record->rt?->rw?->nomor ? 'RW ' . $record->rt?->rw?->nomor : '-';
                                return "$rt / $rw";

                            default:
                                return '-';
                        }
                    }),

                TextColumn::make('penduduk.nik')
                    ->label('NIK')
                    ->default('-')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('rw.nomor')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('rt.nomor')->searchable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort(function (Builder $query, string $direction): Builder {
                return $query->orderByRaw("
                            CASE
                                WHEN role IS NULL THEN 0
                                WHEN role = '" . UserRole::AdminKelurahan->value . "' THEN 1
                                WHEN role = '" . UserRole::KetuaRW->value . "' THEN 2
                                WHEN role = '" . UserRole::KetuaRT->value . "' THEN 3
                                ELSE 4
                            END $direction
                        ");
            });
    }
}
