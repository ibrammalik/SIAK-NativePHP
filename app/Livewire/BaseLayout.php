<?php

namespace App\Livewire;

use App\Models\Kelurahan;
use Livewire\Component;

class BaseLayout extends Component
{

    public $nama_kelurahan = '';
    public $alamat = '';
    public $telepon = '';
    public $email = '';

    protected string $pageTitle = 'Halaman';

    protected function layoutWithData($view)
    {
        $kelurahan = Kelurahan::query()->first();

        $this->nama_kelurahan = $kelurahan->nama ?? 'Contoh';
        $this->alamat = $kelurahan->alamat ?? 'Jalan Contoh Nomor 11';
        $this->telepon = $kelurahan->telepon ?? '023491753';
        $this->email = $kelurahan->email ?? 'contoh@gmail.com';

        // Automatically pass shared variables + title to the layout
        return $view->layout('layouts.app', [
            'title' => $this->pageTitle,
            'nama_kelurahan' => $this->nama_kelurahan,
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'email' => $this->email,
        ]);
    }
}
