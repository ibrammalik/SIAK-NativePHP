<?php

namespace App\Filament\Resources\Usahas;

use App\Filament\Resources\Usahas\Pages\CreateUsaha;
use App\Filament\Resources\Usahas\Pages\EditUsaha;
use App\Filament\Resources\Usahas\Pages\ListUsahas;
use App\Filament\Resources\Usahas\Pages\ViewUsaha;
use App\Filament\Resources\Usahas\Schemas\UsahaForm;
use App\Filament\Resources\Usahas\Schemas\UsahaInfolist;
use App\Filament\Resources\Usahas\Tables\UsahasTable;
use App\Models\Usaha;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UsahaResource extends Resource
{
    protected static ?string $model = Usaha::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingStorefront;

    protected static ?string $recordTitleAttribute = 'nama';

    public static string|UnitEnum|null $navigationGroup = 'Data Monografi';

    protected static ?string $pluralLabel = 'Usaha';

    public static function form(Schema $schema): Schema
    {
        return UsahaForm::configure($schema);
    }

    // public static function infolist(Schema $schema): Schema
    // {
    //     return UsahaInfolist::configure($schema);
    // }

    public static function table(Table $table): Table
    {
        return UsahasTable::configure($table);
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
            'index' => ListUsahas::route('/'),
            'create' => CreateUsaha::route('/create'),
            'view' => ViewUsaha::route('/{record}'),
            'edit' => EditUsaha::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();
        if ($user->isSuperAdmin() || $user->isKelurahan()) return parent::getEloquentQuery();
        if ($user->isRW()) return parent::getEloquentQuery()->where('rw_id', $user->rw_id);
        if ($user->isRT()) return parent::getEloquentQuery()->where('rt_id', $user->rt_id);
        return parent::getEloquentQuery();
    }
}
