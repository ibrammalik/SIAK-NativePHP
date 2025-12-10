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
        Schema::create('kategori_usahas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('kategori_usahas')->insert([
            ['name' => 'Perdagangan'],
            ['name' => 'Jasa'],
            ['name' => 'Industri Rumahan'],
            ['name' => 'Kuliner'],
            ['name' => 'Pertanian'],
            ['name' => 'Peternakan'],
            ['name' => 'Pariwisata'],
            ['name' => 'Kesehatan'],
            ['name' => 'Lainnya'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_usahas');
    }
};
