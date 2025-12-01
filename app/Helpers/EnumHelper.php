<?php

namespace App\Helpers;

class EnumHelper
{
  public static function enumOrFail(string $enumClass, string|null $value)
  {
    if (!$value) return null;

    $enum = $enumClass::tryFrom(trim($value));

    if (!$enum) {
      throw new \Exception("Value [$value] tidak valid untuk enum [$enumClass]");
    }

    return $enum->value;
  }
}
