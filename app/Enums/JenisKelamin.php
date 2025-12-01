<?php

namespace App\Enums;

use App\Enums\Traits\HasEnumHelpers;

enum JenisKelamin: string
{
  use HasEnumHelpers;

  case L = 'L';
  case P = 'P';

  public function label(): string
  {
    return match ($this) {
      self::L => 'Laki-laki',
      self::P => 'Perempuan',
    };
  }

  public static function values(): array
  {
    return array_column(self::cases(), 'value');
  }
}
