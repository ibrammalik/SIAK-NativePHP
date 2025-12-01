<?php

namespace App\Enums;

use App\Enums\Traits\HasEnumHelpers;
use Filament\Support\Contracts\HasLabel;

enum SubkategoriUsaha: string implements HasLabel
{
  use HasEnumHelpers;

    // Perdagangan
  case TOKO_KELONTONG = 'Toko Kelontong';
  case WARUNG = 'Warung';
  case MINIMARKET = 'Minimarket';
  case TOKO_PAKAIAN = 'Toko Pakaian';
  case TOKO_BANGUNAN = 'Toko Bangunan';

    // Jasa
  case JASA_POTONG_RAMBUT = 'Jasa Potong Rambut';
  case LAUNDRY = 'Laundry';
  case BENGKEL = 'Bengkel';
  case FOTOKOPI = 'Fotokopi';
  case JASA_LAINNYA = 'Jasa Lainnya';

    // Industri rumahan
  case KERAJINAN = 'Kerajinan';
  case KONVEKSI = 'Konveksi';
  case MEUBEL = 'Meubel';
  case PRODUK_RUMAHAN = 'Produk Rumahan';

    // Kuliner
  case RUMAH_MAKAN = 'Rumah Makan';
  case KAFE = 'Kafe';
  case PRODUK_MAKANAN = 'Produk Makanan';
  case KATERING = 'Katering';

    // Pertanian
  case PERTANIAN_LAINNYA = 'Pertanian Lainnya';

    // Peternakan
  case PETERNAKAN_LAINNYA = 'Peternakan Lainnya';

    // Pariwisata
  case WISATA_ALAM = 'Wisata Alam';
  case WISATA_BUATAN = 'Wisata Buatan';
  case PENGINAPAN = 'Penginapan';

    // Umum
  case LAINNYA = 'Lainnya';

  public static function byKategori(?KategoriUsaha $kategori): array
  {
    if (! $kategori) {
      return [self::LAINNYA];
    }

    return match ($kategori) {
      // Perdagangan
      KategoriUsaha::PERDAGANGAN => [
        self::TOKO_KELONTONG,
        self::WARUNG,
        self::MINIMARKET,
        self::TOKO_PAKAIAN,
        self::TOKO_BANGUNAN,
        self::LAINNYA,
      ],

      // Jasa
      KategoriUsaha::JASA => [
        self::JASA_POTONG_RAMBUT,
        self::LAUNDRY,
        self::BENGKEL,
        self::FOTOKOPI,
        self::LAINNYA,
      ],

      // Industri Rumahan
      KategoriUsaha::INDUSTRI_RUMAHAN => [
        self::KERAJINAN,
        self::KONVEKSI,
        self::MEUBEL,
        self::PRODUK_RUMAHAN,
        self::LAINNYA,
      ],

      // Kuliner
      KategoriUsaha::KULINER => [
        self::RUMAH_MAKAN,
        self::KAFE,
        self::PRODUK_MAKANAN,
        self::KATERING,
        self::LAINNYA,
      ],

      // Pertanian
      KategoriUsaha::PERTANIAN => [
        self::LAINNYA,
      ],

      // Peternakan
      KategoriUsaha::PETERNAKAN => [
        self::LAINNYA,
      ],

      // Pariwisata
      KategoriUsaha::PARIWISATA => [
        self::WISATA_ALAM,
        self::WISATA_BUATAN,
        self::PENGINAPAN,
        self::LAINNYA,
      ],

      // Default
      default => [
        self::LAINNYA,
      ],
    };
  }

  public function getLabel(): string
  {
    return $this->value;
  }
}
