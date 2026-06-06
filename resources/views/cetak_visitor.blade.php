<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Pengunjung Siswa Perpustakaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 40px;
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
            font-weight: bold;
        }
        .header-text p {
            margin: 2px 0;
            font-size: 13px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: #f2f2f2;
        }
        .signature-img {
            width: 60px;
            height: auto;
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
        <img src="{{ public_path('img/logo-sma.png') }}" alt="Logo SMA" class="logo" />
        <div class="header-text">
            <h2>DAFTAR PENGUNJUNG SISWA PERPUSTAKAAN</h2>
            <p><strong>SMA Muhammadiyah Kuala Kapuas</strong></p>
            <p>Jl. Barito No. 11, Kuala Kapuas, Kalimantan Tengah</p>
        </div>
    </div>

    <div style="margin-top: 10px; text-align: left;">
        @if(request('tahun_ajaran'))
            <p><strong>Tahun Ajaran:</strong> {{ request('tahun_ajaran') }}</p>
        @else
            <p><strong>Tahun Ajaran:</strong> Semua Tahun Ajaran</p>
        @endif
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tahun Ajaran</th>
                <th>Tujuan Pengunjung</th>
                <th>Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($visitors as $key => $visitor)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $visitor->nama }}</td>
                    <td>{{ $visitor->tahun_ajaran }}</td>
                    <td>{{ $visitor->tujuan }}</td>
                    <td>
                        @if ($visitor->tanda_tangan)
                            <img src="{{ public_path('storage/' . $visitor->tanda_tangan) }}" class="signature-img" alt="Tanda Tangan" />
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data pengunjung siswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 50px; text-align: right;">
        <p>Kuala Kapuas, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p>Kepala Perpustakaan</p>
        <br><br><br>
        <p><strong><u>_________________________</u></strong></p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} SMA Muhammadiyah Kuala Kapuas - Halaman <span class="page-number"></span>
    </div>

</body>
</html>
