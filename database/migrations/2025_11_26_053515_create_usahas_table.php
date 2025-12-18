<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usahas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kategori_usaha_id')->nullable()->constrained('kategori_usahas')->nullOnDelete();
            $table->foreignId('subkategori_usaha_id')->nullable()->constrained('subkategori_usahas')->nullOnDelete();

            $table->string('nama');
            $table->string('nama_pemilik');
            $table->string('alamat');

            $table->foreignId('rw_id')->constrained('rws')->cascadeOnDelete();
            $table->foreignId('rt_id')->constrained('rts')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usahas');
    }
};
