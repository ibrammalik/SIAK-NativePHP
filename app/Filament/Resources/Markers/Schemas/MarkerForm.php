<?php

namespace App\Filament\Resources\Markers\Schemas;

use App\Enums\MarkerCategory;
use App\Models\Marker;
use Dotswan\MapPicker\Fields\Map;
use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Guava\IconPicker\Forms\Components\IconPicker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class MarkerForm
{
    public static function isEditable(): bool
    {
        $path = Request::path(); // Contoh: 'users/edit/1' atau 'users/create'
        return strpos($path, 'edit') !== false || strpos($path, 'create') !== false;
    }

    public static function getColor(): string
    {
        try {
            if (!empty(session('color'))) {
                return session('color');
            }
            $recordId = request()->route('record') ?? request()->route('id');
            if ($recordId) {
                $modelClass = Marker::class;
                $record = $modelClass::find($recordId);
                if ($record && !empty($record->color)) {
                    return $record->color;
                }
            }
            return '#3388ff';
        } catch (\Throwable $e) {
            Log::warning('⚠️ Error determining marker color: ' . $e->getMessage());
            return '#3388ff';
        }
    }

    public static function getIcon(): string
    {
        try {
            if (!empty(session('icon'))) {
                return session('icon');
            }
            $recordId = request()->route('record') ?? request()->route('id');
            if ($recordId) {
                $modelClass = Marker::class;
                $record = $modelClass::find($recordId);
                if ($record && !empty($record->icon)) {
                    return $record->icon;
                }
            }
            return 'heroicon-s-map-pin';
        } catch (\Throwable $e) {
            Log::warning('⚠️ Error determining marker icon: ' . $e->getMessage());
            return 'heroicon-s-map-pin';
        }
    }

    public static function getMarkerHtml(): string
    {
        $icon = self::getIcon();
        $color = self::getColor();

        return "<div class='marker-pin' style='--marker-color: {$color}'></div>"
            . svg($icon, ['class' => "w-['14px'] h-['14px']"])->toHtml();
    }

    public static function getZoomLevel(): int
    {
        $recordId = Request::route()->parameter('record');
        $record = Marker::find($recordId);

        if (session('form_longitude') || $record?->longitude) {
            return 12;
        } else {
            return 5;
        }
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category')
                    ->label('Kategori')
                    ->options(MarkerCategory::class)
                    ->native(false)
                    ->searchable(true)
                    ->required()
                    ->afterStateHydrated(function ($state, $record, Set $set) {
                        $set('category', session('form_category') ?? $record?->category ?? null);
                    })->rule(function ($get) {
                        if ($get('category') === MarkerCategory::KantorKelurahan) {
                            return Rule::unique('markers', 'category')
                                ->where('category', MarkerCategory::KantorKelurahan)
                                ->ignore($get('id')); // ignore record on edit
                        }
                        return null;
                    }),

                TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->afterStateHydrated(function ($state, $record, Set $set) {
                        $set('name', session('form_name') ?? $record?->name ?? null);
                    }),

                Textarea::make('description')
                    ->columnSpanFull()
                    ->required()
                    ->afterStateHydrated(function ($state, $record, Set $set) {
                        $set('description', session('form_description') ?? $record?->description ?? null);
                    }),

                Map::make('location')
                    ->label('Location')
                    ->columnSpanFull()

                    // State Management
                    ->afterStateUpdated(function (Set $set, ?array $state, $operation): void {
                        $set('latitude', $state['lat']);
                        $set('longitude', $state['lng']);
                    })
                    ->afterStateHydrated(function ($state, $record, Set $set, $livewire): void {
                        $set('location', [
                            'lat' => session('form_latitude') ?? $record->latitude ??  null,
                            'lng' =>  session('form_longitude') ?? $record->longitude ?? null,
                        ]);
                    })

                    // Basic Configuration
                    ->defaultLocation(latitude: 0.7893, longitude: 113.9213)
                    ->draggable(self::isEditable())
                    ->clickable(self::isEditable())
                    ->zoom(self::getZoomLevel())
                    ->minZoom(0)
                    ->maxZoom(18)
                    ->tilesUrl('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
                    ->detectRetina(true)

                    // Marker Configuration
                    ->showMarker(true)
                    ->markerHtml(self::getMarkerHtml())
                    ->markerIconClassName('custom-div-icon')
                    ->markerIconAnchor([15, 42])
                    ->markerIconSize([30, 42])

                    // Extra Customization
                    ->extraTileControl([
                        'tileSize' => 256,
                        'zoomOffset' => 0,
                    ])
                    ->extraStyles([
                        'min-height: 500px',
                        'border-radius: 10px',
                        'z-index: 1',
                    ]),

                Actions::make([
                    Action::make('ubah_icon_marker')
                        ->label('Ubah Tampilan Marker')
                        ->modalHeading('Ubah Tampilan Marker')
                        ->outlined()
                        ->icon('heroicon-s-pencil-square')
                        ->mountUsing(function ($form, $get) {
                            $form->fill([
                                'icon' => $get('icon'),
                                'color' => $get('color'),
                            ]);
                        })
                        ->schema([
                            IconPicker::make('icon')
                                ->label('Marker Icon')
                                ->sets(['heroicons'])
                                ->iconsSearchResults(),

                            ColorPicker::make('color')
                                ->label('Marker Color')
                        ])
                        ->modalSubmitActionLabel('Update Marker')
                        ->action(function (array $data, Component $livewire) {
                            // Save marker icon/color to session or directly to model
                            Session::flash('icon', $data['icon']);
                            Session::flash('color', $data['color']);

                            // Simpan semua input lain ke session
                            foreach ($livewire->all()['data'] as $key => $value) {
                                Session::flash("form_{$key}", $value);
                            }

                            // Determine redirect URL
                            $record = $livewire->record ?? null;
                            $redirectUrl = $record
                                ? route('filament.app.resources.markers.edit', ['record' => $record])
                                : route('filament.app.resources.markers.create');

                            $livewire->redirect($redirectUrl, true);
                        }),
                ])
                    ->hiddenOn('view')
                    ->columnSpanFull()
                    ->alignEnd(),

                TextInput::make('latitude')
                    ->disabled()
                    ->dehydrated()
                    ->hintIcon('heroicon-m-question-mark-circle')
                    ->hintIconTooltip('Otomatis terisi setelah memilih lokasi di peta')
                    ->required()
                    ->numeric()
                    ->afterStateHydrated(function ($state, $record, Set $set) {
                        $set('latitude', session('form_latitude') ?? $record?->latitude ?? 0.7893);
                    }),

                TextInput::make('longitude')
                    ->disabled()
                    ->dehydrated()
                    ->hintIcon('heroicon-m-question-mark-circle')
                    ->hintIconTooltip('Otomatis terisi setelah memilih lokasi di peta')
                    ->required()
                    ->numeric()
                    ->afterStateHydrated(function ($state, $record, Set $set) {
                        $set('longitude', session('form_longitude') ?? $record?->longitude ?? 113.9213);
                    }),

                Hidden::make('color')
                    ->afterStateHydrated(function ($state, $record, Set $set) {
                        $set('color', self::getColor());
                    }),

                Hidden::make('icon')->default(self::getIcon())
                    ->afterStateHydrated(function ($state, $record, Set $set) {
                        $set('icon', self::getIcon());
                    }),
            ]);
    }
}
