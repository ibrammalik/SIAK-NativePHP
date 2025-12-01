<?php

namespace App\Filament\Resources\RTS;

use App\Filament\Resources\RTS\Pages\CreateRT;
use App\Filament\Resources\RTS\Pages\EditRT;
use App\Filament\Resources\RTS\Pages\ListRTS;
use App\Filament\Resources\RTS\Pages\ViewRT;
use App\Filament\Resources\RTS\Schemas\RTForm;
use App\Filament\Resources\RTS\Schemas\RTInfolist;
use App\Filament\Resources\RTS\Tables\RTSTable;
use App\Models\RT;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class RTResource extends Resource
{
    protected static ?string $model = RT::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::HomeModern;
    protected static ?string $recordTitleAttribute = 'nomor';
    protected static string | UnitEnum | null $navigationGroup = 'Kependudukan';
    protected static ?int $navigationSort = 2;
    protected static ?string $slug = 'rts';
    protected static ?string $navigationLabel = 'RT';
    protected static ?string $pluralModelLabel = 'RT';
    protected static ?string $modelLabel = 'RT';

    public static function form(Schema $schema): Schema
    {
        return RTForm::configure($schema);
    }

    // public static function infolist(Schema $schema): Schema
    // {
    //     return RTInfolist::configure($schema);
    // }

    public static function table(Table $table): Table
    {
        return RTSTable::configure($table);
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
            'index' => ListRTS::route('/'),
            'create' => CreateRT::route('/create'),
            'view' => ViewRT::route('/{record}'),
            'edit' => EditRT::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();
        if ($user->isSuperAdmin() || $user->isKelurahan()) return parent::getEloquentQuery();
        if ($user->isRW()) return parent::getEloquentQuery()->where('rw_id', $user->rw_id);
        return parent::getEloquentQuery()->where('id', $user->rt_id);
    }
}
