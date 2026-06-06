<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pengunjung Guru/Karyawan</title>
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

        .signature-img {
            width: 60px;
            height: auto;
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
            <h2>DAFTAR PENGUNJUNG GURU PERPUSTAKAAN</h2>
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
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Tujuan</th>
                <th>Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($teachers as $key => $teacher)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $teacher->nama }}</td>
                    <td>{{ $teacher->jabatan }}</td>
                    <td>{{ $teacher->tujuan }}</td>
                    <td>
                        @if ($teacher->tanda_tangan)
                            <img src="{{ public_path('storage/' . $teacher->tanda_tangan) }}" class="signature-img"
                                alt="Tanda Tangan">
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data pengunjung.</td>
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
        © {{ date('Y') }} SMA Muhammadiyah Kuala Kapuas – Halaman <span class="page-number"></span>
    </div>

</body>

</html>
