<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $data = [
            'IRT',
            'Pelajar/Mahasiswa',
        ];

        foreach ($data as $name) {
            DB::table('pekerjaans')->updateOrInsert(
                ['name' => $name],
                [
                    'name' => $name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    public function down(): void
    {
        DB::table('pekerjaans')
            ->whereIn('name', ['IRT', 'Pelajar/Mahasiswa'])
            ->delete();
    }
};
