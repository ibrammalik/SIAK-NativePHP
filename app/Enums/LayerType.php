<?php

namespace App\Enums;

use App\Enums\Traits\HasEnumHelpers;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum LayerType: string implements HasLabel, HasColor
{
  use HasEnumHelpers;

  case Kelurahan = 'kelurahan';
  case RW = 'rw';
  case RT = 'rt';
  case Lainnya = 'lainnya';

  public function getLabel(): string
  {
    return match ($this) {
      self::Kelurahan => 'Kelurahan',
      self::RW => 'RW',
      self::RT => 'RT',
      self::Lainnya => 'Lainnya',
    };
  }

  public function getColor(): string
  {
    return match ($this) {
      self::Kelurahan => 'info',
      self::RW => 'success',
      self::RT => 'warning',
      self::Lainnya => 'gray',
    };
  }
}
