<?php

namespace App\Enums;

use App\Enums\Traits\HasEnumHelpers;

enum StatusKependudukan: string
{
  use HasEnumHelpers;

  case Tetap = 'Tetap';
  case Domisili = 'Domisili';

  public static function values(): array
  {
    return array_column(self::cases(), 'value');
  }
}
