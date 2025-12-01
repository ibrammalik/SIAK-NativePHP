<?php

namespace App\Enums\Traits;

trait HasEnumHelpers
{
  /**
   * Get all enum values as array.
   */
  public static function values(): array
  {
    return array_column(self::cases(), 'value');
  }

  /**
   * Get all enum labels (if label() method exists, use it).
   */
  public static function labels(): array
  {
    return collect(self::cases())
      ->mapWithKeys(fn($case) => [
        $case->value => method_exists($case, 'label')
          ? $case->label()
          : $case->value,
      ])
      ->toArray();
  }

  /**
   * Convert enum to options array for Filament, Livewire, or Form::select().
   */
  public static function options(): array
  {
    return self::labels();
  }
}
