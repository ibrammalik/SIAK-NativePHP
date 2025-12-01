<?php

namespace App\Enums;

use App\Enums\Traits\HasEnumHelpers;

enum StatusPerkawinan: string
{
  use HasEnumHelpers;

  case BelumKawin = 'Belum Kawin';
  case Kawin = 'Kawin';
  case CeraiHidup = 'Cerai Hidup';
  case CeraiMati = 'Cerai Mati';

  public static function values(): array
  {
    return array_column(self::cases(), 'value');
  }
}
