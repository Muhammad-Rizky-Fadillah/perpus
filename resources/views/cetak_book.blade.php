<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Katalog Buku</title>
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

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: middle;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        td.text-left {
            text-align: left;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .cover-img {
            max-width: 60px;
            max-height: 80px;
            display: block;
            margin: 0 auto;
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
            <h2>KATALOG BUKU PERPUSTAKAAN</h2>
            <p><strong>SMA Muhammadiyah Kuala Kapuas</strong></p>
            <p>Jl. Barito No. 11, Kuala Kapuas, Kalimantan Tengah</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Cover</th>
                <th>Judul Buku</th>
                <th>Kategori</th>
                <th>Pengarang</th>
                <th>Rak Buku</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($book->cover && file_exists(public_path('storage/' . $book->cover)))
                            <img src="{{ public_path('storage/' . $book->cover) }}" alt="Cover" class="cover-img">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="text-left">{{ $book->judul }}</td>
                    <td class="text-left">{{ $book->category->nama_kategori ?? '-' }}</td>
                    <td class="text-left">{{ $book->pengarang }}</td>
                    <td class="text-left">{{ $book->rak_buku ?? '-' }}</td>
                    <td>{{ $book->stock }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Tidak ada data buku.</td>
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
