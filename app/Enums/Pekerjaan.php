<?php

namespace App\Enums;

use App\Enums\Traits\HasEnumHelpers;
use Filament\Support\Contracts\HasLabel;

enum Pekerjaan: string implements HasLabel
{
  use HasEnumHelpers;

  case PetaniSendiri = 'Petani Sendiri';
  case BuruhTani = 'Buruh Tani';
  case Nelayan = 'Nelayan';
  case Pengusaha = 'Pengusaha';
  case BuruhIndustri = 'Buruh Industri';
  case BuruhBangunan = 'Buruh Bangunan';
  case Dagang = 'Dagang';
  case Pengangkutan = 'Pengangkutan';
  case ASN = 'ASN';
  case Polri = 'Polri';
  case TNI = 'TNI';
  case Pensiunan = 'Pensiunan';
  case Lainlain = 'Lain-lain';

  public function getLabel(): string
  {
    return $this->value;
  }
}
