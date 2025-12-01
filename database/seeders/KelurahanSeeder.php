<?php

namespace Database\Seeders;

use App\Models\Kelurahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelurahan::create([
            'nama' => 'Kalicari',
            'kecamatan' => 'Pedurungan',
            'kota' => 'Semarang',
            'provinsi' => 'Jawa Tengah',
            'kode_pos' => 50198,
            'alamat' => 'Jl. Supriyadi No. 20, Kalicari, Pedurungan, Kota Semarang, Jawa Tengah 50198',
            'telepon' => '(024) 6725029',
            'email' => 'kelurahankalicari@gmail.com',
            'jam_pelayanan' => '<ul><li><p>Senin – Kamis: 08.00 – 16.00 WIB</p></li><li><p>Jumat: 07.30 – 14.00 WIB</p></li></ul>',
            'batas_utara' => 'Tlogosari Kulon',
            'batas_timur' => 'Gemah',
            'batas_selatan' => 'Palebon',
            'batas_barat' => 'Gayamsari',
            'visi' => '<p><em>“Terwujudnya Kelurahan Kalicari yang mandiri, maju, dan sejahtera melalui pelayanan publik yang transparan dan partisipatif.”</em></p>',
            'misi' => '<ul><li><p>Meningkatkan pelayanan publik yang cepat dan berkualitas.</p></li><li><p>Memberdayakan masyarakat melalui kegiatan ekonomi dan sosial.</p></li><li><p>Menjaga kebersihan, keamanan, dan ketertiban lingkungan.</p></li><li><p>Meningkatkan partisipasi masyarakat dalam pembangunan.</p></li></ul>',
        ]);
    }
}
