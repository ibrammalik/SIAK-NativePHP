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
        Schema::table('rts', function (Blueprint $table) {
            $table->foreignId('layer_id')->nullable()->constrained('layers')->nullOnDelete();
            $table->foreignId('ketua_id')->nullable()->constrained('penduduks')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('layer_id');
            $table->dropConstrainedForeignId('ketua_id');
        });
    }
};
