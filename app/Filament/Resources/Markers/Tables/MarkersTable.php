<?php

namespace App\Filament\Resources\Markers\Tables;

use App\Enums\MarkerCategory;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Guava\IconPicker\Tables\Columns\IconColumn;

class MarkersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->color(fn($record) => Color::hex($record->color)),

                TextColumn::make('latitude')
                    ->label('Lat')
                    ->numeric(),

                TextColumn::make('longitude')
                    ->label('Long')
                    ->numeric(),

                IconColumn::make('icon')
                    ->label('Icon')
                    ->label('Icon'),

                ColorColumn::make('color')
                    ->label('Color')
                    ->label('Warna'),

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
                EditAction::make(),
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
