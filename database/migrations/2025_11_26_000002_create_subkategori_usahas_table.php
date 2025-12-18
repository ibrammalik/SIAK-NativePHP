<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subkategori_usahas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_usaha_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();
        });

        $kategoriPerdagangan = DB::table('kategori_usahas')->where('name', 'Perdagangan')->value('id');
        $kategoriJasa = DB::table('kategori_usahas')->where('name', 'Jasa')->value('id');
        $kategoriIndustriRumahan = DB::table('kategori_usahas')->where('name', 'Industri Rumahan')->value('id');
        $kategoriKuliner = DB::table('kategori_usahas')->where('name', 'Kuliner')->value('id');
        $kategoriPertanian = DB::table('kategori_usahas')->where('name', 'Pertanian')->value('id');
        $kategoriPeternakan = DB::table('kategori_usahas')->where('name', 'Peternakan')->value('id');
        $kategoriPariwisata = DB::table('kategori_usahas')->where('name', 'Pariwisata')->value('id');
        $kategoriKesehatan = DB::table('kategori_usahas')->where('name', 'Kesehatan')->value('id');


        DB::table('subkategori_usahas')->insert([
            ['kategori_usaha_id' => $kategoriPerdagangan, 'name' => 'Toko Kelontong', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPerdagangan, 'name' => 'Warung', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPerdagangan, 'name' => 'Minimarket', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPerdagangan, 'name' => 'Toko Pakaian', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPerdagangan, 'name' => 'Bangunan', 'created_at' => now(), 'updated_at' => now()],

            ['kategori_usaha_id' => $kategoriJasa, 'name' => 'Jasa Potong Rambut', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriJasa, 'name' => 'Laundry', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriJasa, 'name' => 'Bengkel', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriJasa, 'name' => 'Fotocopy', 'created_at' => now(), 'updated_at' => now()],

            ['kategori_usaha_id' => $kategoriIndustriRumahan, 'name' => 'Kerajinan', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriIndustriRumahan, 'name' => 'Konveksi', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriIndustriRumahan, 'name' => 'Meubel', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriIndustriRumahan, 'name' => 'Produk Rumahan', 'created_at' => now(), 'updated_at' => now()],

            ['kategori_usaha_id' => $kategoriKuliner, 'name' => 'Rumah Makan', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriKuliner, 'name' => 'Kafe', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriKuliner, 'name' => 'Produk Makanan', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriKuliner, 'name' => 'Katering', 'created_at' => now(), 'updated_at' => now()],

            ['kategori_usaha_id' => $kategoriPertanian, 'name' => 'Tanaman Pangan', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPertanian, 'name' => 'Hortikultura', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPertanian, 'name' => 'Perkebunan', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPertanian, 'name' => 'Tanaman Obat', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPertanian, 'name' => 'Budi Daya Padi', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPertanian, 'name' => 'Budi Daya Sayuran', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPertanian, 'name' => 'Budi Daya Buah', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPertanian, 'name' => 'Pertanian Organik', 'created_at' => now(), 'updated_at' => now()],

            ['kategori_usaha_id' => $kategoriPeternakan, 'name' => 'Peternakan Sapi', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPeternakan, 'name' => 'Peternakan Kambing', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPeternakan, 'name' => 'Peternakan Domba', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPeternakan, 'name' => 'Peternakan Ayam', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPeternakan, 'name' => 'Peternakan Itik', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPeternakan, 'name' => 'Peternakan Bebek', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPeternakan, 'name' => 'Peternakan Burung Puyuh', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPeternakan, 'name' => 'Perikanan Air Tawar (Kolam Ikan)', 'created_at' => now(), 'updated_at' => now()],

            ['kategori_usaha_id' => $kategoriPariwisata, 'name' => 'Wisata Alam', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPariwisata, 'name' => 'Wisata Buatan', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriPariwisata, 'name' => 'Penginapan', 'created_at' => now(), 'updated_at' => now()],

            ['kategori_usaha_id' => $kategoriKesehatan, 'name' => 'Klinik Kesehatan', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriKesehatan, 'name' => 'Praktik Bidan', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriKesehatan, 'name' => 'Praktik Perawat', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriKesehatan, 'name' => 'Apotek', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriKesehatan, 'name' => 'Toko Alat Kesehatan', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriKesehatan, 'name' => 'Layanan Terapi (Bekam, Pijat, Refleksi)', 'created_at' => now(), 'updated_at' => now()],
            ['kategori_usaha_id' => $kategoriKesehatan, 'name' => 'Posyandu Mandiri', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subkategori_usahas');
    }
};
