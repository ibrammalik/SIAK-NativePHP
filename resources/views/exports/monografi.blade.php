<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Monografi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            margin: 20px;
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
            page-break-inside: auto;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 2px 3px;
            text-align: center;
        }

        th {
            background: #f3f3f3;
        }

        .section-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 2px;
        }

        .grid {
            width: 100%;
            text-align: left;
        }

        .section {
            display: inline-block;
            vertical-align: top;
            width: 32%;
            margin-right: 1%;
        }

        .section:nth-child(3n) {
            margin-right: 0;
        }

        .signature {
            text-align: right;
            margin-top: 15px;
            page-break-inside: avoid;
        }

        .tabel-nomor th:first-child,
        .tabel-nomor td:first-child {
            width: 25px;
            text-align: center;
            white-space: nowrap;
        }
    </style>
</head>

<body>

    <h2>{{ $judul }}</h2>
    <h3>KECAMATAN PEDURUNGAN KOTA SEMARANG</h3>
    <p style="text-align:center;">KEADAAN BULAN: {{ strtoupper($bulan) }}</p>

    <div class="grid">
        {{-- =================== KOLOM 1 =================== --}}
        <div class="section">
            <p style="font-weight: bold; font-size: 12px">
                I. Penduduk Angkatan Kerja
            </p>
            <table style="padding: 0; margin: 0;">
                <tr>
                    <td style="text-align: left; border: none; font-weight: bold">Jumlah
                        Kepala Keluarga</td>
                    <td>
                        {{ $data['jumlah_kepala_keluarga'] }} Orang
                    </td>
                </tr>
            </table>

            <p class="section-title">Penduduk menurut kelompok umur</p>
            <table>
                <thead>
                    <tr>
                        <th>Kelompok Umur</th>
                        <th>L</th>
                        <th>P</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['penduduk_umur'] as $item)
                        <tr>
                            <td>{{ $item['kelompok'] }}</td>
                            <td>{{ $item['L'] }}</td>
                            <td>{{ $item['P'] }}</td>
                            <td>{{ $item['L'] + $item['P'] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>Jumlah</td>
                        <td>{{ $data['total_L'] }}</td>
                        <td>{{ $data['total_P'] }}</td>
                        <td>{{ $data['total_umur'] }}</td>
                    </tr>
                </tbody>
            </table>

            <p class="section-title">Mata Pencaharian (Bagi umur 10 tahun keatas)</p>
            <table class="tabel-nomor">
                <thead>
                    <tr>
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
                    <tr>
                        <td colspan="2">Jumlah</td>
                        <td>{{ $data['total_pekerjaan'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- =================== KOLOM 2 =================== --}}
        <div class="section">
            <p class="section-title">
                Penduduk menurut Pendidikan (Bagi umur 5 tahun keatas)
            </p>
            <table class="tabel-nomor">
                <thead>
                    <tr>
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
                    <tr>
                        <td colspan="2">Jumlah</td>
                        <td>{{ $data['total_pendidikan'] }}</td>
                    </tr>
                </tbody>
            </table>


            <p class="section-title">Banyaknya Pemeluk Agama</p>
            <table class="tabel-nomor">
                <thead>
                    <tr>
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
                    <tr>
                        <td colspan="2">Jumlah</td>
                        <td>{{ $data['total_agama'] }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- <p class="section-title">5. WNI Keturunan Asing</p>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Keturunan</th>
            <th>L</th>
            <th>P</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data['wni_keturunan'] as $i => $wni)
          <tr>
            <td>{{ $i+1 }}</td>
            <td style="text-align:left;">{{ $wni['keturunan'] }}</td>
            <td>{{ $wni['L'] }}</td>
            <td>{{ $wni['P'] }}</td>
          </tr>
          @endforeach
        </tbody>
      </table> --}}
        </div>

        {{-- =================== KOLOM 3 =================== --}}
        <div class="section">
            <p class="section-title">Status Perkawinan</p>
            <table class="tabel-nomor">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['nikah'] as $i => $nk)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $nk['status'] }}</td>
                            <td>{{ $nk['jumlah'] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">Jumlah</td>
                        <td>{{ $data['total_perkawinan'] }}</td>
                    </tr>
                </tbody>
            </table>

            <table style="border:none;">
                <tr>
                    <td style="border:none;">&nbsp;</td>
                </tr>
            </table>

            <div class="signature">
                Semarang, {{ now()->translatedFormat('d F Y') }}<br>
                Plt. Lurah Kalicari<br><br><br><br>
                <strong>LISETYA BUDI, S.IP., M.M</strong>
            </div>
        </div>
    </div>

</body>

</html>
