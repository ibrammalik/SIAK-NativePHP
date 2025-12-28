<?php

namespace App\Filament\Resources\Fasilitas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FasilitasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable(),

                TextColumn::make('kategoriFasilitas.name')
                    ->label('Kategori')
                    ->searchable(),

                TextColumn::make('subkategoriFasilitas.name')
                    ->badge()
                    ->searchable(),

                TextColumn::make('nama_pengelola')
                    ->label('Nama Pengelola')
                    ->searchable(),

                TextColumn::make('nomor_pengelola')
                    ->label('Nomor Pengelola')
                    ->searchable(),

                TextColumn::make('rw.nomor')
                    ->label('RW')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('rt.nomor')
                    ->label('RT')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('alamat')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
