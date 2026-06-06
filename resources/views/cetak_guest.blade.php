<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Daftar Pengunjung Tamu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 40px;
            color: #000;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
            height: auto;
        }

        .header-text {
            flex: 1;
            text-align: center;
        }

        .header-text h2 {
            margin: 0;
            font-size: 18px;
        }

        .header-text p {
            margin: 2px 0;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #f2f2f2;
        }

        td.text-left {
            text-align: left;
        }

        .signature-img {
            height: 50px;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .footer {
            font-size: 10px;
            text-align: center;
            position: fixed;
            bottom: 10px;
            left: 0;
            right: 0;
        }

        @page {
            margin: 40px 40px 60px 40px;
        }

        .page-number:after {
            content: counter(page);
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ public_path('img/logo-sma.png') }}" class="logo" alt="Logo Sekolah">
        <div class="header-text">
            <h2>DAFTAR PENGUNJUNG TAMU PERPUSTAKAAN</h2>
            <p><strong>SMA Muhammadiyah Kuala Kapuas</strong></p>
            <p>Jl. Barito No. 11, Kuala Kapuas, Kalimantan Tengah</p>
        </div>

    </div>
    @if (request('start_date') && request('end_date'))
        <p>Periode: {{ \Carbon\Carbon::parse(request('start_date'))->format('d-m-Y') }} s.d
            {{ \Carbon\Carbon::parse(request('end_date'))->format('d-m-Y') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Alamat / Instansi</th>
                <th>Jabatan</th>
                <th>Pesan / Kesan</th>
                <th>Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($guests as $guest)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($guest->tanggal)->format('d-m-Y') }}</td>
                    <td class="text-left">{{ $guest->nama }}</td>
                    <td class="text-left">{{ $guest->alamat }}</td>
                    <td>{{ $guest->jabatan }}</td>
                    <td class="text-left">{{ $guest->pesan }}</td>
                    <td>
                        @if ($guest->tanda_tangan)
                            <img src="{{ public_path('storage/' . $guest->tanda_tangan) }}" alt="Tanda Tangan"
                                class="signature-img">
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data pengunjung tamu.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature">
        <p>Kuala Kapuas, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p>Kepala Perpustakaan</p>
        <br><br><br>
        <p><strong><u>_________________________</u></strong></p>
    </div>

    <div class="footer">
        © {{ date('Y') }} SMA Muhammadiyah Kuala Kapuas – Halaman <span class="page-number"></span>
    </div>

</body>

</html>
