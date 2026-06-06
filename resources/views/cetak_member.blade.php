<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Induk Anggota Perpustakaan</title>
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
            <h2>DAFTAR INDUK ANGGOTA PERPUSTAKAAN</h2>
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
                <th>Kode</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Tahun Ajaran</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Status</th>
                <th>Expire</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $index => $member)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $member->kode }}</td>
                    <td>
                        @if ($member->foto && file_exists(public_path('storage/' . $member->foto)))
                            <img src="{{ public_path('storage/' . $member->foto) }}" width="50">
                        @else
                            -
                        @endif
                    </td>

                    <td>{{ $member->user->name ?? '-' }}</td>
                    <td>{{ $member->user->tahun_ajaran ?? '-' }}</td>
                    <td>{{ $member->tempat_lahir }}</td>
                    <td>{{ \Carbon\Carbon::parse($member->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td>{{ $member->alamat }}</td>
                    <td>{{ $member->telepon }}</td>
                    <td>{{ $member->status }}</td>
                    <td>{{ \Carbon\Carbon::parse($member->expire)->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="11">Tidak ada data anggota.</td>
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
