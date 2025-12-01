<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;

class LeafletPolygon extends Field
{
    protected string $view = 'filament.forms.components.leaflet-polygon';

    // Ensure the state is always an array
    protected function setUp(): void
    {
        parent::setUp();

        $this->dehydrateStateUsing(fn($state) => $state ?: []);
        $this->afterStateHydrated(function ($state, $set) {
            if (is_string($state)) {
                $set($this->getName(), json_decode($state, true));
            }
        });
    }

    protected int $height = 500;

    public function height(int $height): static
    {
        $this->height = $height;
        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}
