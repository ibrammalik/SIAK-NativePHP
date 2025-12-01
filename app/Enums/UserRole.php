<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use App\Enums\Traits\HasEnumHelpers;

enum UserRole: string implements HasLabel, HasColor
{
  use HasEnumHelpers;

  case SuperAdmin = 'super_admin';
  case AdminKelurahan = 'admin_kelurahan';
  case KetuaRW = 'ketua_rw';
  case KetuaRT = 'ketua_rt';

  public function label(): string
  {
    return match ($this) {
      self::SuperAdmin => 'Super Admin',
      self::AdminKelurahan => 'Admin Kelurahan',
      self::KetuaRW => 'Ketua RW',
      self::KetuaRT => 'Ketua RT',
    };
  }

  /**
   * Label yang tampil di UI (otomatis dipakai Filament di form, table, filter).
   */
  public function getLabel(): ?string
  {
    return match ($this) {
      self::SuperAdmin => 'Super Admin',
      self::AdminKelurahan => 'Admin Kelurahan',
      self::KetuaRW => 'Ketua RW',
      self::KetuaRT => 'Ketua RT',
    };
  }

  /**
   * Warna badge otomatis untuk Filament Table / BadgeColumn.
   */
  public function getColor(): string|array|null
  {
    return match ($this) {
      self::SuperAdmin => 'primary',
      self::AdminKelurahan => 'success',
      self::KetuaRW => 'warning',
      self::KetuaRT => 'danger',
    };
  }

  /**
   * Untuk digunakan di Select / Filter (dropdown options).
   */
  public static function options(): array
  {
    return collect(self::cases())
      ->mapWithKeys(fn(self $role) => [$role->value => $role->getLabel()])
      ->toArray();
  }

  public function canManageRW(): bool
  {
    return in_array($this, [self::SuperAdmin, self::AdminKelurahan, self::KetuaRW]);
  }

  public function canManageRT(): bool
  {
    return in_array($this, [self::SuperAdmin, self::AdminKelurahan, self::KetuaRW, self::KetuaRT]);
  }
}
