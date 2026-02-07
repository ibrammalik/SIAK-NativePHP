<?php

namespace App\Filament\Pages;

use App\Models\Kelurahan;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class KelurahanSetting extends Page
{
    protected string $view = "filament.pages.kelurahan-setting";
    public ?array $data = [];

    protected static string|BackedEnum|null $navigationIcon = "heroicon-s-building-library";
    protected static string|null $navigationLabel = "Profil Kelurahan";
    protected static string|UnitEnum|null $navigationGroup = "Pengaturan";

    public static function canAccess(): bool
    {
        $user = Auth::user();
        if ($user->isSuperAdmin()) {
            return true;
        }
        return false;
    }

    public function mount(): void
    {
        $this->form->fill($this->getRecord()?->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make("nama")->label("Nama Kelurahan")->required(),

                TextInput::make("kecamatan"),

                Grid::make(3)
                    ->schema([
                        TextInput::make("kota"),

                        TextInput::make("provinsi"),

                        TextInput::make("kode_pos"),
                    ])
                    ->columnSpanFull(),

                Textarea::make("alamat")->columnSpanFull(),

                TextInput::make("telepon"),

                TextInput::make("email"),

                Fieldset::make("Batas Wilayah")
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make("batas_utara")->label("Utara"),

                        TextInput::make("batas_timur")->label("Timur"),

                        TextInput::make("batas_selatan")->label("Selatan"),

                        TextInput::make("batas_barat")->label("Barat"),
                    ]),

                RichEditor::make("jam_pelayanan")
                    ->label("Jam Pelayanan")
                    ->disableToolbarButtons(["attachFiles"])
                    ->fileAttachmentsDisk(null)
                    ->columnSpanFull(),

                RichEditor::make("visi")
                    ->disableToolbarButtons(["attachFiles"])
                    ->fileAttachmentsDisk(null)
                    ->columnSpanFull(),

                RichEditor::make("misi")
                    ->disableToolbarButtons(["attachFiles"])
                    ->fileAttachmentsDisk(null)
                    ->columnSpanFull(),

                FileUpload::make('hero_image_path')
                    ->label('Gambar Hero Banner')
                    ->disk('public')
                    ->directory('hero_banners')
                    ->image()
                    ->imageEditor()
                    ->downloadable()
                    ->previewable(true)
                    ->columnSpanFull(),

                FileUpload::make('struktur_organisasi_image_path')
                    ->label('Gambar Struktur Organisasi')
                    ->disk('public')
                    ->directory('struktur_organisasi_images')
                    ->image()
                    ->imageEditor()
                    ->downloadable()
                    ->previewable(true)
                    ->columnSpanFull(),
            ])
            ->record($this->getRecord())
            ->statePath("data");
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $record = $this->getRecord();

        if (!$record) {
            $record = new Kelurahan();
        }

        $record->fill($data);
        $record->save();

        if ($record->wasRecentlyCreated) {
            $this->form->record($record)->saveRelationships();
        }

        Notification::make()
            ->title("Profil kelurahan berhasil disimpan.")
            ->success()
            ->send();
        // ->sendToDatabase(Auth::user());
    }

    public function getRecord(): ?Kelurahan
    {
        return Kelurahan::query()->first();
    }
}
