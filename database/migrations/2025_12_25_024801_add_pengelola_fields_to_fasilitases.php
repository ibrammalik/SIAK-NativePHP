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
        Schema::table('fasilitases', function (Blueprint $table) {
            $table->string('nama_pengelola')->nullable()->after('alamat');
            $table->string('nomor_pengelola')->nullable()->after('nama_pengelola');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fasilitases', function (Blueprint $table) {
            $table->dropColumn(['nama_pengelola', 'nomor_pengelola']);
        });
    }
};
