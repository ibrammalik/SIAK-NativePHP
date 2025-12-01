<?php

namespace App\Enums;

use App\Enums\Traits\HasEnumHelpers;

enum Agama: string
{
  use HasEnumHelpers;

  case Islam = 'Islam';
  case Kristen = 'Kristen';
  case Katolik = 'Katolik';
  case Hindu = 'Hindu';
  case Buddha = 'Buddha';
  case Konghucu = 'Konghucu';
  case Lainnya = 'Lainnya';

  public static function values(): array
  {
    return array_column(self::cases(), 'value');
  }
}
