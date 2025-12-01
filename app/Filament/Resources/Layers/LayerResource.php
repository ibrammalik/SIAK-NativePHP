<?php

namespace App\Filament\Resources\Layers;

use App\Filament\Resources\Layers\Pages\CreateLayer;
use App\Filament\Resources\Layers\Pages\EditLayer;
use App\Filament\Resources\Layers\Pages\ListLayers;
use App\Filament\Resources\Layers\Pages\ViewLayer;
use App\Filament\Resources\Layers\Schemas\LayerForm;
use App\Filament\Resources\Layers\Tables\LayersTable;
use App\Models\Layer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class LayerResource extends Resource
{
    protected static ?string $model = Layer::class;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Wilayah';
    protected static string | UnitEnum | null $navigationGroup = 'Peta';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Map;

    public static function form(Schema $schema): Schema
    {
        return LayerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LayersTable::configure($table);
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
            'index' => ListLayers::route('/'),
            'create' => CreateLayer::route('/create'),
            'view' => ViewLayer::route('/{record}'),
            'edit' => EditLayer::route('/{record}/edit'),
        ];
    }

    public static function generateNameAndDescription(array $data): array
    {
        if (($data['type'] ?? null) !== \App\Enums\LayerType::Lainnya->value) {
            switch ($data['type']) {
                case \App\Enums\LayerType::Kelurahan->value:
                    $kel = \App\Models\Kelurahan::find($data['kelurahan']['id'] ?? null);
                    if ($kel) {
                        $data['name'] = 'Wilayah Kelurahan ' . $kel->nama;
                        $data['description'] = 'Layer wilayah administrasi untuk Kelurahan ' . $kel->nama . '.';
                    }
                    break;

                case \App\Enums\LayerType::RW->value:
                    $rw = \App\Models\RW::find($data['rw']['id'] ?? null);
                    if ($rw) {
                        $namaKel = \App\Models\Kelurahan::first()->nama;
                        $data['name'] = 'Wilayah RW ' . $rw->nomor;
                        $data['description'] = 'Layer wilayah administrasi RW ' . $rw->nomor . ($namaKel ? " di Kelurahan $namaKel." : '.');
                    }
                    break;

                case \App\Enums\LayerType::RT->value:
                    $rt = \App\Models\RT::find($data['rt']['id'] ?? null);
                    if ($rt) {
                        $namaKel = \App\Models\Kelurahan::first()->nama;
                        $rwNomor = $rt->rw?->nomor;
                        $data['name'] = 'Wilayah RT ' . $rt->nomor . ($rwNomor ? " / RW $rwNomor" : '');
                        $data['description'] = 'Layer wilayah administrasi RT ' . $rt->nomor
                            . ($rwNomor ? " di RW $rwNomor" : '')
                            . ($namaKel ? " Kelurahan $namaKel." : '.');
                    }
                    break;
            }
        }

        return $data;
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();
        if ($user->isSuperAdmin() || $user->isKelurahan()) return parent::getEloquentQuery();

        if ($user->isRW()) return parent::getEloquentQuery()
            ->where('id', $user->rw->layer_id)
            ->orWhereIn('id', $user->rw->rt()->whereNotNull('layer_id')->pluck('layer_id')->toArray());

        if ($user->isRT()) return parent::getEloquentQuery()->where('id', $user->rt->layer_id);

        return parent::getEloquentQuery();
    }
}
