<?php

namespace App\Filament\Resources\RTS\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RTSTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor')
                    ->label('Nomor RT')
                    ->formatStateUsing(function ($state) {
                        return "RT $state";
                    })
                    ->sortable(),

                TextColumn::make('rw.nomor')
                    ->label('Nomor RW')
                    ->formatStateUsing(function ($state) {
                        return "RW $state";
                    })
                    ->sortable(),

                TextColumn::make('ketua.nama')
                    ->default('-')
                    ->label('Ketua RT'),

                TextColumn::make('ketua.no_telp')
                    ->label('Nomor Telepon')
                    ->default('-'),

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
