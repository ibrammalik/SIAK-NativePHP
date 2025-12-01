<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum KategoriFasilitas: string implements HasLabel
{
  case PENDIDIKAN = 'Pendidikan';
  case KESEHATAN = 'Kesehatan';
  case IBADAH = 'Ibadah';
  case PERDAGANGAN = 'Perdagangan';
  case OLAHRAGA = 'Olahraga';
  case TRANSPORTASI = 'Transportasi';
  case PEMERINTAHAN = 'Pemerintahan';
  case KEAMANAN = 'Keamanan';
  case SOSIAL = 'Sosial';
  case LAINNYA = 'Lainnya';

  public function getLabel(): string
  {
    return $this->value;
  }
}
