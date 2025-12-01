<?php

namespace App\Filament\Resources\RWS;

use App\Filament\Resources\RWS\Pages\CreateRW;
use App\Filament\Resources\RWS\Pages\EditRW;
use App\Filament\Resources\RWS\Pages\ListRWS;
use App\Filament\Resources\RWS\Pages\ViewRW;
use App\Filament\Resources\RWS\Schemas\RWForm;
use App\Filament\Resources\RWS\Schemas\RWInfolist;
use App\Filament\Resources\RWS\Tables\RWSTable;
use App\Models\RW;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use BackedEnum;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class RWResource extends Resource
{
    protected static ?string $model = RW::class;
    protected static ?string $recordTitleAttribute = 'nomor';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;
    protected static string | UnitEnum | null $navigationGroup = 'Kependudukan';
    protected static ?int $navigationSort = 1;
    protected static ?string $slug = 'rws';
    protected static ?string $navigationLabel = 'RW';
    protected static ?string $pluralModelLabel = 'RW';
    protected static ?string $modelLabel = 'RW';

    public static function form(Schema $schema): Schema
    {
        return RWForm::configure($schema);
    }

    // public static function infolist(Schema $schema): Schema
    // {
    //     return RWInfolist::configure($schema);
    // }

    public static function table(Table $table): Table
    {
        return RWSTable::configure($table);
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
            'index' => ListRWS::route('/'),
            'create' => CreateRW::route('/create'),
            'view' => ViewRW::route('/{record}'),
            'edit' => EditRW::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        if ($user->isSuperAdmin() || $user->isKelurahan()) return parent::getEloquentQuery();

        return parent::getEloquentQuery()->where('id', $user->rw_id);
    }
}
