<div class="pt-32 pb-20 bg-gray-50 min-h-screen max-w-7xl mx-auto px-6">
    <h2 class="text-3xl font-bold text-green-700 mb-8 text-center">
        Monografi Kelurahan {{ $nama_kelurahan ?? 'Contoh' }}
    </h2>

    {{-- Section: Data Umum --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 mb-10">
        <h3 class="text-xl font-semibold text-green-700 mb-4">Data Umum
        </h3>
        <div class="overflow-x-auto max-h-80">
            <table
                class="min-w-full border border-gray-200 text-sm text-gray-700">
                <thead>
                    <tr class="bg-green-100 text-left">
                        <th class="py-2 px-4 border">No</th>
                        <th class="py-2 px-4 border">Keterangan</th>
                        <th class="py-2 px-4 border">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">1</td>
                        <td class="border px-4 py-2">Jumlah RW</td>
                        <td class="border px-4 py-2 text-right">12</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">2</td>
                        <td class="border px-4 py-2">Jumlah RT</td>
                        <td class="border px-4 py-2 text-right">45</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">3</td>
                        <td class="border px-4 py-2">Luas Wilayah</td>
                        <td class="border px-4 py-2 text-right">2,4 km²
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Section: Kependudukan --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 mb-10">
        <h3 class="text-xl font-semibold text-green-700 mb-4">Data
            Kependudukan
        </h3>
        <div class="overflow-x-auto max-h-80">
            <table
                class="min-w-full border border-gray-200 text-sm text-gray-700">
                <thead>
                    <tr class="bg-green-100 text-left">
                        <th class="py-2 px-4 border">No</th>
                        <th class="py-2 px-4 border">Uraian</th>
                        <th class="py-2 px-4 border">Laki-laki</th>
                        <th class="py-2 px-4 border">Perempuan</th>
                        <th class="py-2 px-4 border">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">1</td>
                        <td class="border px-4 py-2">Jumlah Penduduk
                        </td>
                        <td class="border px-4 py-2 text-right">2.340
                        </td>
                        <td class="border px-4 py-2 text-right">2.520
                        </td>
                        <td class="border px-4 py-2 text-right">4.860
                        </td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">2</td>
                        <td class="border px-4 py-2">Kepala Keluarga
                        </td>
                        <td class="border px-4 py-2 text-right" colspan="2">
                            1.250</td>
                        <td class="border px-4 py-2 text-right">1.250
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Section: Pendidikan --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 mb-10">
        <h3 class="text-xl font-semibold text-green-700 mb-4">Data
            Pendidikan</h3>
        <div class="overflow-x-auto max-h-80">
            <table
                class="min-w-full border border-gray-200 text-sm text-gray-700">
                <thead>
                    <tr class="bg-green-100 text-left">
                        <th class="py-2 px-4 border">No</th>
                        <th class="py-2 px-4 border">Jenjang Pendidikan
                        </th>
                        <th class="py-2 px-4 border">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">1</td>
                        <td class="border px-4 py-2">Tidak Sekolah</td>
                        <td class="border px-4 py-2 text-right">220</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">2</td>
                        <td class="border px-4 py-2">SD/Sederajat</td>
                        <td class="border px-4 py-2 text-right">680</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">3</td>
                        <td class="border px-4 py-2">SMP/Sederajat</td>
                        <td class="border px-4 py-2 text-right">540</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">4</td>
                        <td class="border px-4 py-2">SMA/Sederajat</td>
                        <td class="border px-4 py-2 text-right">430</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">5</td>
                        <td class="border px-4 py-2">Perguruan Tinggi
                        </td>
                        <td class="border px-4 py-2 text-right">150</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Section: Pekerjaan --}}
    <div class="bg-white shadow-lg rounded-2xl p-6">
        <h3 class="text-xl font-semibold text-green-700 mb-4">Data
            Pekerjaan</h3>
        <div class="overflow-x-auto max-h-80">
            <table
                class="min-w-full border border-gray-200 text-sm text-gray-700">
                <thead>
                    <tr class="bg-green-100 text-left">
                        <th class="py-2 px-4 border">No</th>
                        <th class="py-2 px-4 border">Jenis Pekerjaan
                        </th>
                        <th class="py-2 px-4 border">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">1</td>
                        <td class="border px-4 py-2">Petani</td>
                        <td class="border px-4 py-2 text-right">120</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">2</td>
                        <td class="border px-4 py-2">Pegawai Negeri</td>
                        <td class="border px-4 py-2 text-right">80</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">3</td>
                        <td class="border px-4 py-2">Karyawan Swasta
                        </td>
                        <td class="border px-4 py-2 text-right">450</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">4</td>
                        <td class="border px-4 py-2">Wiraswasta</td>
                        <td class="border px-4 py-2 text-right">300</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">5</td>
                        <td class="border px-4 py-2">Pelajar/Mahasiswa
                        </td>
                        <td class="border px-4 py-2 text-right">600</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>