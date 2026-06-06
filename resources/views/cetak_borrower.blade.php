<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Daftar Peminjaman Buku</title>
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
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
        }

        td.text-left {
            text-align: left;
        }

        ul {
            margin: 0;
            padding-left: 15px;
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
            <h2>LAPORAN DAFTAR PEMINJAMAN BUKU</h2>
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
                <th>Nama Peminjam</th>
                <th>Email</th>
                <th>Buku Dipinjam</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotalDenda = 0; @endphp
            @forelse ($borrowers as $borrower)
                @php
                    $today = \Carbon\Carbon::today();
                    $tglKembali = \Carbon\Carbon::parse($borrower->tgl_kembali);
                    $terlambat = $today->greaterThan($tglKembali) ? $today->diffInDays($tglKembali) : 0;
                    $dendaPerHari = 1000;
                    $totalDenda = $terlambat * $dendaPerHari;
                    $grandTotalDenda += $totalDenda;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-left">{{ $borrower->user->name ?? 'User tidak ditemukan' }}</td>
                    <td>{{ $borrower->user->email ?? '-' }}</td>
                    <td class="text-left">
                        @if ($borrower->books->isNotEmpty())
                            <ul>
                                @foreach ($borrower->books as $book)
                                    <li>{{ $book->judul }}</li>
                                @endforeach
                            </ul>
                        @else
                            <em>Tidak ada buku</em>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($borrower->tgl_pinjam)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($borrower->tgl_kembali)->format('d-m-Y') }}</td>
                    <td>{{ $borrower->is_confirm ? 'Disetujui' : 'Menunggu' }}</td>
                    <td>
                        @if ($totalDenda > 0)
                            Rp{{ number_format($totalDenda, 0, ',', '.') }}
                        @else
                            Tidak ada
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada data peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="7" style="text-align: right;">Total Denda Keseluruhan:</th>
                <th>Rp{{ number_format($grandTotalDenda, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
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
