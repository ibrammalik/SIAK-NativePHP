<?php

namespace App\Filament\Resources\Users;

use App\Enums\UserRole;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\ViewUser;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Schemas\UserInfolist;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'User';

    protected static ?string $pluralLabel = 'Users';

    protected static ?string $slug = 'users';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan';

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UserInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'view' => ViewUser::route('/{record}'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }

    // ======================================================
    // == RULE WILAYAH / QUERY PEMBATASAN DATA
    // ======================================================
    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        // Super Admin -> Lihat semua user
        if ($user->isSuperAdmin()) return parent::getEloquentQuery();

        // Admin Kelurahan -> Lihat semua user kecuali Super Admin
        if ($user->isKelurahan()) return parent::getEloquentQuery()->where('role', '!=', UserRole::SuperAdmin);

        // Ketua RW -> Lihat semua user dalam RW-nya
        if ($user->isRW()) return parent::getEloquentQuery()->where('rw_id', $user->rw_id);

        // Ketua RT -> Lihat semua user dalam RT-nya
        if ($user->isRT()) return parent::getEloquentQuery()->where('rt_id', $user->rt_id);

        // Default (jika ada role lain di masa depan)
        return parent::getEloquentQuery()->where('id', $user->id);
    }
}
