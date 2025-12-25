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
        Schema::create('kategori_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('kategori_pendidikans')->insert([
            ['name' => 'Tidak Sekolah', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Belum Tamat SD', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tidak Tamat SD', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tamat SD', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tamat SLTP', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tamat SLTA', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tamat Akademi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'S1', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'S2', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'S3', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_pendidikans');
    }
};
