<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Laporan Rating Buku</title>
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
        td.text-left {
            text-align: left;
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
            <h2>LAPORAN RATING BUKU</h2>
            <p><strong>SMA Muhammadiyah Kuala Kapuas</strong></p>
            <p>Jl. Barito No. 11, Kuala Kapuas, Kalimantan Tengah</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Rata-Rata Rating</th>
                <th>Total Penilai</th>
                <th>Detail Penilai</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $i => $book)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="text-left">{{ $book->judul }}</td>
                    <td>{{ number_format($book->ratings->avg('rating'), 2) }}</td>
                    <td>{{ $book->ratings->count() }}</td>
                    <td class="text-left">
                        @forelse($book->ratings as $rating)
                            • {{ $rating->user->name }}: {{ $rating->rating }}<br>
                        @empty
                            <em>Tidak ada penilai</em>
                        @endforelse
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data rating buku.</td>
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
