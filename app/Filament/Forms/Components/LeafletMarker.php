<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;

class LeafletMarker extends Field
{
    protected string $view = 'filament.forms.components.leaflet-marker';

    protected int $height = 400;

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
