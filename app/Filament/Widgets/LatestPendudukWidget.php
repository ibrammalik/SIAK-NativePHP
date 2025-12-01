<?php

namespace App\Filament\Widgets;

use App\Models\Penduduk;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class LatestPendudukWidget extends TableWidget
{
    protected static bool $isLazy = false;
    protected static ?string $heading = 'Penduduk Terbaru';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(function (): Builder {
                $user = auth()->user();
                $query = Penduduk::query();

                if ($user->isRT()) {
                    $query->where('rt_id', $user->rt_id);
                } elseif ($user->isRW()) {
                    $query->where('rw_id', $user->rw_id);
                }

                return $query->latest()->limit(5);
            })
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-user'),

                TextColumn::make('nik')
                    ->label('NIK')
                    ->copyable()
                    ->toggleable(),

                TextColumn::make('jenis_kelamin')
                    ->label('JK')
                    ->formatStateUsing(fn($state) => $state === 'L' ? 'Laki-laki' : 'Perempuan')
                    ->badge()
                    ->color(fn($state) => $state === 'L' ? 'info' : 'pink'),

                TextColumn::make('rw.nomor')
                    ->label('RW')
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('rt.nomor')
                    ->label('RT')
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Didaftarkan')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->icon('heroicon-o-clock'),
            ])
            ->filters([])

            ->headerActions([])

            ->recordActions([])

            ->toolbarActions([
                BulkActionGroup::make([]),
            ]);
    }
}
