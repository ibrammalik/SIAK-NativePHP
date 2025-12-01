<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum SubkategoriFasilitas: string implements HasLabel
{
  // Pendidikan
  case PAUD = 'PAUD';
  case TK = 'TK';
  case SD = 'SD';
  case SMP = 'SMP';
  case SMA = 'SMA';
  case PERGURUAN_TINGGI = 'Perguruan Tinggi';
  case PENDIDIKAN_LAINNYA = 'Pendidikan Lainnya';

    // Kesehatan
  case POSYANDU = 'Posyandu';
  case PUSKESMAS = 'Puskesmas';
  case KLINIK = 'Klinik';
  case APOTEK = 'Apotek';
  case RUMAH_SAKIT = 'Rumah Sakit';
  case KESEHATAN_LAINNYA = 'Kesehatan Lainnya';

    // Ibadah
  case MASJID = 'Masjid';
  case MUSHOLA = 'Mushola';
  case GEREJA = 'Gereja';
  case VIHARA = 'Vihara';
  case PURA = 'Pura';
  case IBADAH_LAINNYA = 'Ibadah Lainnya';

    // Perdagangan
  case PASAR = 'Pasar';
  case TOKO = 'Toko';
  case KIOS = 'Kios';
  case RUKO = 'Ruko';
  case PERDAGANGAN_LAINNYA = 'Perdagangan Lainnya';

    // Olahraga
  case LAPANGAN = 'Lapangan';
  case GOR = 'GOR';
  case FITNESS = 'Fitness';
  case OLAHRAGA_LAINNYA = 'Olahraga Lainnya';

    // Transportasi
  case TERMINAL = 'Terminal';
  case HALTE = 'Halte';
  case PARKIR = 'Parkir';
  case TRANSPORTASI_LAINNYA = 'Transportasi Lainnya';

    // Pemerintahan
  case KANTOR_KELURAHAN = 'Kantor Kelurahan';
  case KANTOR_RW = 'Kantor RW';
  case KANTOR_RT = 'Kantor RT';
  case PEMERINTAHAN_LAINNYA = 'Pemerintahan Lainnya';

    // Keamanan
  case POS_KAMLING = 'Pos Kamling';
  case POS_POLISI = 'Pos Polisi';
  case POS_TNI = 'Pos TNI';
  case KEAMANAN_LAINNYA = 'Keamanan Lainnya';

    // Sosial
  case BALAI_WARGA = 'Balai Warga';
  case PANTI_ASUHAN = 'Panti Asuhan';
  case SOSIAL_LAINNYA = 'Sosial Lainnya';

    // Umum
  case LAINNYA = 'Lainnya';

  public function getLabel(): string
  {
    return $this->value;
  }

  public static function byKategori(?KategoriFasilitas $kategori): array
  {
    if (! $kategori) {
      return [self::LAINNYA];
    }

    return match ($kategori) {

      KategoriFasilitas::PENDIDIKAN => [
        self::PAUD,
        self::TK,
        self::SD,
        self::SMP,
        self::SMA,
        self::PERGURUAN_TINGGI,
        self::PENDIDIKAN_LAINNYA,
      ],

      KategoriFasilitas::KESEHATAN => [
        self::POSYANDU,
        self::PUSKESMAS,
        self::KLINIK,
        self::APOTEK,
        self::RUMAH_SAKIT,
        self::KESEHATAN_LAINNYA,
      ],

      KategoriFasilitas::IBADAH => [
        self::MASJID,
        self::MUSHOLA,
        self::GEREJA,
        self::VIHARA,
        self::PURA,
        self::IBADAH_LAINNYA,
      ],

      KategoriFasilitas::PERDAGANGAN => [
        self::PASAR,
        self::TOKO,
        self::KIOS,
        self::RUKO,
        self::PERDAGANGAN_LAINNYA,
      ],

      KategoriFasilitas::OLAHRAGA => [
        self::LAPANGAN,
        self::GOR,
        self::FITNESS,
        self::OLAHRAGA_LAINNYA,
      ],

      KategoriFasilitas::TRANSPORTASI => [
        self::TERMINAL,
        self::HALTE,
        self::PARKIR,
        self::TRANSPORTASI_LAINNYA,
      ],

      KategoriFasilitas::PEMERINTAHAN => [
        self::KANTOR_KELURAHAN,
        self::KANTOR_RW,
        self::KANTOR_RT,
        self::PEMERINTAHAN_LAINNYA,
      ],

      KategoriFasilitas::KEAMANAN => [
        self::POS_KAMLING,
        self::POS_POLISI,
        self::POS_TNI,
        self::KEAMANAN_LAINNYA,
      ],

      KategoriFasilitas::SOSIAL => [
        self::BALAI_WARGA,
        self::PANTI_ASUHAN,
        self::SOSIAL_LAINNYA,
      ],

      default => [self::LAINNYA],
    };
  }
}
