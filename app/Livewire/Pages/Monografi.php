<?php

namespace App\Livewire\Pages;

use App\Livewire\BaseLayout;

class Monografi extends BaseLayout
{
    protected string $pageTitle = 'Monografi';

    public function render()
    {
        return $this->layoutWithData(
            view('livewire.pages.monografi')
        );
    }
}
