<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Inventaris Perpustakaan</title>
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
            page-break-inside: auto;
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
        td.text-left {
            text-align: left;
        }
        .signature-container {
            page-break-inside: avoid;
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
            margin: 40px 40px 80px 40px;
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
            <h2>LAPORAN INVENTARIS RUANG PERPUSTAKAAN</h2>
            <p><strong>SMA Muhammadiyah Kuala Kapuas</strong></p>
            <p>Jl. Barito No. 11, Kuala Kapuas, Kalimantan Tengah</p>
        </div>
    </div>

        <div style="margin-top: 10px; text-align: left;">
        @if(request('tahun'))
            <p><strong>Tahun:</strong> {{ request('tahun') }}</p>
        @else
            <p><strong>Tahun:</strong> Semua Tahun</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Merk</th>
                <th>Tahun</th>
                <th>Jumlah</th>
                <th>Harga (Rp)</th>
                <th>Keadaan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inventories as $key => $inventory)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td class="text-left">{{ $inventory->nama }}</td>
                    <td>{{ $inventory->merk }}</td>
                    <td>{{ $inventory->tahun }}</td>
                    <td>{{ $inventory->jumlah }}</td>
                    <td class="text-left">Rp{{ number_format($inventory->harga, 0, ',', '.') }}</td>
                    <td>{{ $inventory->keadaan }}</td>
                    <td class="text-left">{{ $inventory->keterangan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada data inventaris.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature-container">
        <div class="signature">
            <p>Kuala Kapuas, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Kepala Perpustakaan</p>
            <br><br><br>
            <p><strong><u>_________________________</u></strong></p>
        </div>
    </div>

    <div class="footer">
        © {{ date('Y') }} SMA Muhammadiyah Kuala Kapuas – Halaman <span class="page-number"></span>
    </div>

</body>
</html>
