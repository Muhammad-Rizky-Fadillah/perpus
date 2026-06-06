<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Stok Opname Perpustakaan</title>
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
        th, td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: middle;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        td.text-left {
            text-align: left;
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
            <h2>LAPORAN STOK OPNAME PERPUSTAKAAN</h2>
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
                <th>No</th>
                <th>Judul Buku</th>
                <th>Rak Buku</th>
                <th>Stok Fisik</th>
                <th>Selisih</th>
                <th>Petugas</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($opnames as $index => $opname)
                @php
                    $rakBuku = $opname->book->rak_buku ?? '-';
                    $selisih = $opname->actual_stock - ($opname->book->stock ?? 0);
                @endphp
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td class="text-left">{{ $opname->book->judul }}</td>
                    <td style="text-align: center;">{{ $rakBuku }}</td>
                    <td style="text-align: center;">{{ $opname->actual_stock }}</td>
                    <td style="text-align: center;">
                        @if($selisih > 0)
                            +{{ $selisih }}
                        @elseif($selisih < 0)
                            {{ $selisih }}
                        @else
                            0
                        @endif
                    </td>
                    <td class="text-left">{{ $opname->user->name }}</td>
                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($opname->created_at)->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data stok opname.</td>
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
