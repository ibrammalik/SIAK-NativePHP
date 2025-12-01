<?php

namespace App\Enums;

use App\Enums\Traits\HasEnumHelpers;
use Filament\Support\Contracts\HasLabel;

enum MarkerCategory: string implements HasLabel
{
  use HasEnumHelpers;

    // ⚙️ Administratif
  case KantorKelurahan = 'kantor_kelurahan';
  case KantorRW = 'kantor_rw';
  case KantorRT = 'kantor_rt';
  case BalaiWarga = 'balai_warga';
  case Poskamling = 'poskamling';

    // 🕌 Fasilitas Keagamaan
  case Masjid = 'masjid';
  case Mushola = 'mushola';
  case Gereja = 'gereja';
  case Pura = 'pura';
  case Vihara = 'vihara';

    // 🏫 Fasilitas Pendidikan
  case PAUD = 'paud';
  case TK = 'tk';
  case SD = 'sd';
  case SMP = 'smp';
  case SMA = 'sma';
  case PerguruanTinggi = 'perguruan_tinggi';

    // 🏥 Fasilitas Kesehatan
  case Puskesmas = 'puskesmas';
  case Klinik = 'klinik';
  case RumahSakit = 'rumah_sakit';
  case Apotek = 'apotek';

    // 🏢 Fasilitas Umum / Sosial
  case KantorPemerintah = 'kantor_pemerintah';
  case Lapangan = 'lapangan';
  case Taman = 'taman';
  case Pasar = 'pasar';
  case Warung = 'warung';
  case Lainnya = 'lainnya';

  public function getLabel(): string
  {
    return match ($this) {
      self::KantorKelurahan => 'Kantor Kelurahan',
      self::KantorRW => 'Kantor RW',
      self::KantorRT => 'Kantor RT',
      self::BalaiWarga => 'Balai Warga',
      self::Poskamling => 'Pos Kamling',
      self::Masjid => 'Masjid',
      self::Mushola => 'Mushola',
      self::Gereja => 'Gereja',
      self::Pura => 'Pura',
      self::Vihara => 'Vihara',
      self::PAUD => 'PAUD',
      self::TK => 'TK',
      self::SD => 'SD',
      self::SMP => 'SMP',
      self::SMA => 'SMA',
      self::PerguruanTinggi => 'Perguruan Tinggi',
      self::Puskesmas => 'Puskesmas',
      self::Klinik => 'Klinik',
      self::RumahSakit => 'Rumah Sakit',
      self::Apotek => 'Apotek',
      self::KantorPemerintah => 'Kantor Pemerintah',
      self::Lapangan => 'Lapangan',
      self::Taman => 'Taman',
      self::Pasar => 'Pasar',
      self::Warung => 'Warung',
      self::Lainnya => 'Lainnya',
    };
  }
}
