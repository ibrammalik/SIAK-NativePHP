<?php

namespace App\Filament\Resources\Markers;

use App\Filament\Resources\Markers\Pages\CreateMarker;
use App\Filament\Resources\Markers\Pages\EditMarker;
use App\Filament\Resources\Markers\Pages\ListMarkers;
use App\Filament\Resources\Markers\Pages\ViewMarker;
use App\Filament\Resources\Markers\Schemas\MarkerForm;
use App\Filament\Resources\Markers\Tables\MarkersTable;
use App\Models\Marker;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MarkerResource extends Resource
{
    protected static ?string $model = Marker::class;
    protected static ?string $navigationLabel = 'Lokasi';
    protected static string | UnitEnum | null $navigationGroup = 'Peta';
    protected static ?string $recordTitleAttribute = 'name';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::MapPin;

    public static function form(Schema $schema): Schema
    {
        return MarkerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MarkersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMarkers::route('/'),
            'create' => CreateMarker::route('/create'),
            'view' => ViewMarker::route('/{record}'),
            'edit' => EditMarker::route('/{record}/edit'),
        ];
    }
}
