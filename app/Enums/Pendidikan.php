<?php

namespace App\Enums;

use App\Enums\Traits\HasEnumHelpers;

enum Pendidikan: string
{
  use HasEnumHelpers;

  case PerguruanTinggi = 'Perguruan Tinggi';
  case TamatAkademi = 'Tamat Akademi';
  case TamatSLTA = 'Tamat SLTA';
  case TamatSLTP = 'Tamat SLTP';
  case TamatSD = 'Tamat SD';
  case TidakTamatSD = 'Tidak Tamat SD';
  case BelumTamatSD = 'Belum Tamat SD';
  case TidakSekolah = 'Tidak Sekolah';

  public static function values(): array
  {
    return array_column(self::cases(), 'value');
  }
}
