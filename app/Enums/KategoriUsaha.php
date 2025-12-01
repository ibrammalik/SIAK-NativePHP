<?php

namespace App\Enums;

use App\Enums\Traits\HasEnumHelpers;
use Filament\Support\Contracts\HasLabel;

enum KategoriUsaha: string implements HasLabel
{
  use HasEnumHelpers;

  case PERDAGANGAN = 'Perdagangan';
  case JASA = 'Jasa';
  case INDUSTRI_RUMAHAN = 'Industri Rumahan';
  case KULINER = 'Kuliner';
  case PERTANIAN = 'Pertanian';
  case PETERNAKAN = 'Peternakan';
  case PARIWISATA = 'Pariwisata';
  case LAINNYA = 'Lainnya';

  public function getLabel(): string
  {
    return $this->value;
  }
}
