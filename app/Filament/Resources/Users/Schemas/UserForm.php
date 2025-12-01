<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
use App\Models\Penduduk;
use App\Models\RT;
use App\Models\RW;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Informasi Akun')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(100),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable()
                            ->required(fn(string $context): bool => $context === 'create')
                            ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn($state) => filled($state))
                            ->maxLength(255)
                            ->helperText('Kosongkan jika tidak ingin mengubah password.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Fieldset::make('Peran dan Wilayah')
                    ->schema([
                        Select::make('role')
                            ->label('Role')
                            ->options(function () {
                                $user = auth()->user();
                                if ($user->isSuperAdmin()) return UserRole::class;
                                if ($user->isKelurahan()) return [
                                    UserRole::KetuaRW->value => UserRole::KetuaRW->getLabel(),
                                    UserRole::KetuaRT->value => UserRole::KetuaRT->getLabel(),
                                ];
                                if ($user->isRW()) return [UserRole::KetuaRT->value => UserRole::KetuaRT->getLabel()];
                            })
                            ->getOptionLabelUsing(fn($value) => UserRole::from($value)->getLabel())
                            ->preload()
                            ->native(false)
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                // ✅ Reset otomatis saat role berubah
                                $set('rw_id', null);
                                $set('rt_id', null);
                            }),

                        Select::make('rw_id')
                            ->label('RW')
                            ->options(function () {
                                $auth = auth()->user();
                                if ($auth->isSuperAdmin() || $auth->isKelurahan()) return Rw::pluck('nomor', 'id');
                                if ($auth->isRW()) return Rw::where('id', $auth->rw_id)->pluck('nomor', 'id');
                                return [];
                            })
                            ->visible(fn($get) => $get('role') === UserRole::KetuaRW->value || $get('role') === UserRole::KetuaRT->value)
                            ->required(fn($get) => $get('role') === UserRole::KetuaRW->value || $get('role') === UserRole::KetuaRT->value)
                            ->preload()
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(fn($set) => $set('rt_id', null))
                            ->rule(function (callable $get) {
                                return function (string $attribute, $value, \Closure $fail) use ($get) {
                                    $role = $get('role');
                                    $recordId = $get('id');

                                    if ($role === UserRole::KetuaRW->value && $value) {
                                        $exists = \App\Models\User::where('role', UserRole::KetuaRW->value)
                                            ->where('rw_id', $value)
                                            ->when($recordId, fn($q) => $q->where('id', '!=', $recordId))
                                            ->exists();

                                        if ($exists) {
                                            $fail('RW ini sudah memiliki Ketua RW.');
                                        }
                                    }
                                };
                            }),

                        Select::make('rt_id')
                            ->label('RT')
                            ->options(fn($get) => RT::where('rw_id', $get('rw_id'))->pluck('nomor', 'id'))
                            ->visible(fn($get) => $get('role') === UserRole::KetuaRT->value)
                            ->required(fn($get) => $get('role') === UserRole::KetuaRT->value)
                            ->preload()
                            ->searchable()
                            ->rule(function (callable $get) {
                                return function (string $attribute, $value, \Closure $fail) use ($get) {
                                    $role = $get('role');
                                    $recordId = $get('id');

                                    if ($role === UserRole::KetuaRT->value && $value) {
                                        $exists = \App\Models\User::where('role', UserRole::KetuaRT->value)
                                            ->where('rt_id', $value)
                                            ->when($recordId, fn($q) => $q->where('id', '!=', $recordId))
                                            ->exists();

                                        if ($exists) {
                                            $fail('RT ini sudah memiliki Ketua RT.');
                                        }
                                    }
                                };
                            }),

                        Select::make('penduduk_id')
                            ->label('Data Penduduk')
                            ->options(Penduduk::query()->pluck('nama', 'id'))
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->columnSpan(fn($get) => $get('role') === UserRole::KetuaRW->value ? 'full' : 1)
                            ->rule('unique:users,penduduk_id')
                            ->hintIcon(Heroicon::QuestionMarkCircle)
                            ->hintIconTooltip('Opsional: hubungkan dengan data penduduk terkait.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
