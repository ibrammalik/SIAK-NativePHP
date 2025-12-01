<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Monografi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #000;
        }

        h2,
        h3 {
            text-align: center;
            margin: 0;
        }

        h2 {
            font-size: 14px;
        }

        h3 {
            font-size: 12px;
        }

        p {
            margin: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 3px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 2px 3px;
            text-align: center;
            font-size: 10px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 12px;
            margin-bottom: 2px;
        }

        .tabel-nomor th:first-child,
        .tabel-nomor td:first-child {
            width: 25px;
            text-align: center;
            white-space: nowrap;
        }

        .tabel-nomor th:last-child,
        .tabel-nomor td:last-child {
            width: 80px;
        }

        .signature {
            text-align: right;
            margin-top: 15px;
            page-break-inside: avoid;
        }
    </style>
</head>

<body>

    <div>
        <table>
            <tr>
                <td colspan="5" style="border: none;">
                    <h2>{{ $judul }}</h2>
                </td>
            </tr>
            <tr>
                <td colspan="5" style="border: none;">
                    <h3>KECAMATAN PEDURUNGAN KOTA SEMARANG</h3>
                </td>
            </tr>
            <tr>
                <td colspan="5" style="border: none; text-align:center;">
                    <p style="text-align:center;">KEADAAN BULAN: {{ strtoupper($bulan) }}</p>
                </td>
            </tr>
        </table>
        <br>

        <!-- ===================== BAGIAN 1 ===================== -->
        <p style="font-weight: bold; font-size: 12px">
            I. Penduduk Angkatan Kerja
        </p>

        <table>
            <tr>
                <td style="text-align: left; border: none; font-weight: bold; font-size: 12px;" colspan="4">
                    Jumlah Kepala Keluarga
                </td>
                <td>
                    {{ $data['jumlah_kepala_keluarga'] }} Orang
                </td>
            </tr>
        </table>

        <p class="section-title">Penduduk menurut kelompok umur</p>
        <table class="tabel-nomor">
            <thead>
                <tr style="background: #f3f3f3;">
                    <th>No</th>
                    <th>Kelompok Umur</th>
                    <th style="width: 80px;">L</th>
                    <th style="width: 80px;">P</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['penduduk_umur'] as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item['kelompok'] }}</td>
                        <td style="width: 80px;">{{ $item['L'] }}</td>
                        <td style="width: 80px;">{{ $item['P'] }}</td>
                        <td>{{ $item['L'] + $item['P'] }}</td>
                    </tr>
                @endforeach
                <tr style="font-weight:bold;">
                    <td colspan="2">Total</td>
                    <td style="width: 80px;">{{ $data['total_L'] }}</td>
                    <td style="width: 80px;">{{ $data['total_P'] }}</td>
                    <td>{{ $data['total_umur'] }}</td>
                </tr>
            </tbody>
        </table>
        <br>

        <p class="section-title">Mata Pencaharian (Bagi umur 10 tahun keatas)</p>
        <table class="tabel-nomor">
            <thead>
                <tr style="background: #f3f3f3;">
                    <th>No</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['pekerjaan'] as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td style="text-align:left;">{{ $item['jenis'] }}</td>
                        <td>{{ $item['jumlah'] }}</td>
                    </tr>
                @endforeach
                <tr style="font-weight:bold;">
                    <td colspan="2">Total</td>
                    <td>{{ $data['total_pekerjaan'] }}</td>
                </tr>
            </tbody>
        </table>
        <br>

        <!-- ===================== BAGIAN 2 ===================== -->
        <p class="section-title">
            Penduduk menurut Pendidikan (Bagi umur 5 tahun keatas)
        </p>
        <table class="tabel-nomor">
            <thead>
                <tr style="background: #f3f3f3;">
                    <th>No</th>
                    <th>Pendidikan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['pendidikan'] as $i => $p)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td style="text-align:left;">{{ $p['jenjang'] }}</td>
                        <td>{{ $p['jumlah'] }}</td>
                    </tr>
                @endforeach
                <tr style="font-weight:bold;">
                    <td colspan="2">Total</td>
                    <td>{{ $data['total_pendidikan'] }}</td>
                </tr>
            </tbody>
        </table>
        <br>

        <p class="section-title">Banyaknya Pemeluk Agama</p>
        <table class="tabel-nomor">
            <thead>
                <tr style="background: #f3f3f3;">
                    <th>No</th>
                    <th>Agama</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['agama'] as $i => $ag)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td style="text-align:left;">{{ $ag['agama'] }}</td>
                        <td>{{ $ag['jumlah'] }}</td>
                    </tr>
                @endforeach
                <tr style="font-weight:bold;">
                    <td colspan="2">Total</td>
                    <td>{{ $data['total_agama'] }}</td>
                </tr>
            </tbody>
        </table>
        <br>

        <!-- ===================== BAGIAN 3 ===================== -->
        <p class="section-title">Status Perkawinan</p>
        <table class="tabel-nomor">
            <thead>
                <tr style="background: #f3f3f3;">
                    <th>No</th>
                    <th>Status</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['nikah'] as $i => $nk)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td style="text-align:left;">{{ $nk['status'] }}</td>
                        <td>{{ $nk['jumlah'] }}</td>
                    </tr>
                @endforeach
                <tr style="font-weight:bold;">
                    <td colspan="2">Total</td>
                    <td>{{ $data['total_perkawinan'] }}</td>
                </tr>
            </tbody>
        </table>
        <br>

        <!-- ===================== BAGIAN 4 ===================== -->
        <p class="section-title">Usaha / Kegiatan Ekonomi</p>
        <table class="tabel-nomor">
            <thead>
                <tr style="background: #f3f3f3;">
                    <th>No</th>
                    <th>Kategori</th>
                    <th colspan="2" style="width: 160px;">Jumlah</th>
                </tr>
            </thead>
            <tbody>

                @php $no = 1; @endphp

                @foreach ($data['usaha'] as $kategori)
                    {{-- KATEGORI --}}
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td style="text-align:left; font-weight:bold;" colspan="2">{{ $kategori['label'] }}</td>
                        <td style="font-weight:bold; width: 80px" rowspan="{{ count($kategori['sub']) + 1 }}">
                            {{ $kategori['total'] }}</td>
                    </tr>

                    {{-- SUBKATEGORI --}}
                    @foreach ($kategori['sub'] as $sub)
                        <tr>
                            <td></td>
                            <td style="padding-left:18px; text-align:left;">{{ $sub['label'] }}</td>
                            <td style="width: 80px;">{{ $sub['total'] }}</td>
                        </tr>
                    @endforeach
                @endforeach

                {{-- TOTAL KESELURUHAN --}}
                <tr>
                    <td colspan="3" style="font-weight:bold;">Total</td>
                    <td style="font-weight:bold; width: 80px;">{{ $data['total_usaha'] }}</td>
                </tr>

            </tbody>
        </table>
        <br>

        <!-- ===================== BAGIAN 5 ===================== -->
        <p class="section-title">Fasilitas Umum</p>
        <table class="tabel-nomor">
            <thead>
                <tr style="background: #f3f3f3;">
                    <th>No</th>
                    <th>Kategori</th>
                    <th colspan="2" style="width: 160px;">Jumlah</th>
                </tr>
            </thead>
            <tbody>

                @php $no = 1; @endphp

                @foreach ($data['fasilitas'] as $kategori)
                    {{-- KATEGORI --}}
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td style="text-align:left; font-weight:bold;" colspan="2">{{ $kategori['label'] }}</td>
                        <td style="font-weight:bold; width: 80px;" rowspan="{{ count($kategori['sub']) + 1 }}">
                            {{ $kategori['total'] }}</td>
                    </tr>

                    {{-- SUBKATEGORI --}}
                    @foreach ($kategori['sub'] as $sub)
                        <tr>
                            <td></td>
                            <td style="padding-left:18px; text-align:left;">{{ $sub['label'] }}</td>
                            <td style="width: 80px;">{{ $sub['total'] }}</td>
                        </tr>
                    @endforeach
                @endforeach

                {{-- TOTAL KESELURUHAN --}}
                <tr>
                    <td colspan="3" style="font-weight:bold;">Total</td>
                    <td style="font-weight:bold; width: 80px;">{{ $data['total_fasilitas'] }}</td>
                </tr>

            </tbody>
        </table>
        <br>

        <!-- ===================== BAGIAN 6 SIGNATURE ===================== -->
        <table style="page-break-inside: avoid;">
            <tr>
                <td colspan="5" style="border: none; text-align: right;">
                    Semarang, {{ now()->translatedFormat('d F Y') }}
                </td>
            </tr>
            <tr>
                <td colspan="5" style="border: none; text-align: right;">
                    Plt. Lurah Kalicari
                </td>
            </tr>
            <tr>
                <td style="border: none; text-align: right;">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td colspan="5" style="border: none; text-align: right;">
                    <strong>LISETYA BUDI, S.IP., M.M</strong>
                </td>
            </tr>
        </table>

    </div>

</body>

</html>
