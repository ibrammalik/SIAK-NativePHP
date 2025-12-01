<?php

namespace App\Enums;

use App\Enums\Traits\HasEnumHelpers;

enum Shdk: string
{
  use HasEnumHelpers;

  case Kepala = 'Kepala';
  case Suami = 'Suami';
  case Istri = 'Istri';
  case Anak = 'Anak';
  case Menantu = 'Menantu';
  case Cucu = 'Cucu';
  case OrangTua = 'Orang Tua';
  case Mertua = 'Mertua';
  case FamilyLainnya = 'Family Lainnya';
  case Lainnya = 'Lainnya';

  public static function values(): array
  {
    return array_column(self::cases(), 'value');
  }
}
