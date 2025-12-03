<?php

namespace Database\Seeders;

use App\Enums\LayerType;
use App\Enums\MarkerCategory;
use App\Enums\UserRole;
use App\Models\Kelurahan;
use App\Models\Layer;
use App\Models\Marker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layer = Layer::create([
            'type' => LayerType::Kelurahan->value,
            'geojson' => '{"type":"FeatureCollection","features":[{"type":"Feature","geometry":{"type":"Polygon","coordinates":[[[110.45163,-6.983595],[110.454152,-6.984325],[110.454962,-6.986002],[110.45523,-6.98646],[110.455434,-6.98704],[110.456126,-6.988505],[110.456271,-6.988723],[110.456513,-6.989122],[110.45809,-6.991108],[110.459292,-6.992594],[110.459727,-6.99302],[110.459314,-6.993457],[110.459378,-6.993568],[110.459341,-6.993712],[110.459062,-6.993824],[110.459024,-6.994032],[110.459072,-6.994229],[110.459029,-6.994404],[110.45882,-6.994489],[110.458691,-6.994649],[110.45867,-6.994873],[110.458622,-6.995262],[110.458439,-6.995592],[110.458343,-6.995927],[110.458402,-6.996151],[110.458536,-6.996358],[110.458809,-6.996449],[110.459137,-6.996923],[110.459099,-6.997083],[110.459024,-6.997194],[110.45911,-6.997471],[110.459137,-6.997626],[110.45984,-6.998004],[110.459877,-6.998312],[110.459754,-6.99868],[110.459689,-6.998749],[110.459705,-6.998909],[110.459824,-6.999058],[110.459888,-6.999409],[110.46014,-6.999612],[110.460419,-6.999681],[110.460934,-6.999676],[110.46109,-6.999713],[110.46117,-6.999676],[110.461262,-6.999707],[110.461326,-6.999835],[110.461358,-6.999984],[110.46131,-7.000117],[110.461251,-7.000181],[110.461251,-7.000261],[110.461331,-7.00041],[110.461337,-7.000661],[110.461262,-7.000788],[110.460865,-7.000687],[110.460816,-7.000948],[110.460832,-7.001124],[110.460693,-7.001342],[110.460623,-7.001608],[110.460671,-7.001763],[110.460607,-7.00204],[110.460419,-7.002077],[110.46028,-7.002322],[110.460156,-7.002428],[110.460103,-7.002577],[110.460017,-7.00311],[110.460011,-7.003296],[110.459925,-7.003328],[110.45977,-7.003323],[110.459555,-7.003616],[110.459298,-7.003781],[110.45919,-7.003924],[110.45911,-7.004116],[110.458852,-7.004404],[110.458729,-7.004776],[110.458573,-7.00476],[110.458477,-7.004851],[110.458439,-7.004963],[110.458326,-7.005058],[110.4583,-7.005554],[110.45816,-7.00591],[110.458063,-7.005974],[110.457956,-7.006225],[110.457951,-7.006485],[110.45779,-7.006762],[110.456175,-7.00632],[110.455643,-7.006139],[110.455166,-7.006017],[110.454431,-7.005745],[110.4534,-7.005319],[110.453089,-7.005138],[110.452783,-7.004872],[110.452547,-7.004782],[110.45185,-7.004313],[110.451667,-7.004079],[110.452392,-7.003344],[110.452821,-7.002833],[110.45325,-7.002151],[110.453572,-7.001326],[110.45376,-7.000421],[110.453857,-6.999569],[110.453706,-6.998451],[110.453411,-6.996199],[110.453282,-6.995139],[110.452901,-6.992764],[110.452676,-6.991247],[110.45244,-6.989676],[110.452193,-6.987775],[110.451978,-6.986194],[110.45163,-6.983595]]]},"properties":[]}]}',
            'area' => 148.32,
            'name' => 'Wilayah Kelurahan Kalicari',
            'description' => 'Layer wilayah administrasi untuk Kelurahan Kalicari.',
            'color' => '#3388ff',
        ]);

        Marker::create([
            'category' => MarkerCategory::KantorKelurahan,
            'name' => 'Kantor Kelurahan Kalicari',
            'latitude' => -6.99673109673,
            'longitude' => 110.45527027589,
            'description' => 'Jl. Supriyadi No. 20, Kalicari, Pedurungan, Kota Semarang, Jawa Tengah 50198',
            'icon' => 'heroicon-s-map-pin',
            'color' => '#3388ff',
        ]);

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
            'layer_id' => $layer->id,
        ]);

        User::Create([
            'name' => 'Super Admin',
            'email' => 'superadmin@siak.test',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => UserRole::SuperAdmin->value
        ]);

        User::Create([
            'name' => 'Admin Kelurahan',
            'email' => 'adminkelurahan@siak.test',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => UserRole::AdminKelurahan->value
        ]);
    }
}
