<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kartu Anggota Perpustakaan</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            /* Menggunakan Arial sebagai font utama */
            font-size: 8px;
            color: #333;
            /* Warna teks gelap */
            /* Background-color di body tidak akan terlihat di PDF, hanya untuk pratinjau HTML */
        }

        .card-container {
            width: 283.465px;
            /* Sekitar 85mm */
            height: 170.079px;
            /* Sekitar 54mm */
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            /* Latar belakang gradien lembut */
            border-radius: 10px;
            /* Sudut membulat */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            /* Bayangan modern */
            box-sizing: border-box;
            padding: 15px;
            /* Padding internal */
            position: relative;
            /* Penting untuk elemen absolute di dalamnya */
            overflow: hidden;
            /* Memastikan tidak ada yang keluar dari batas kartu */
            border: 1px solid #e9ecef;
            /* Border tipis */
        }

        /* Elemen dekoratif di sudut - pastikan z-index lebih rendah dari konten utama */
        .card-container::before {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 80px;
            height: 80px;
            background: rgba(0, 123, 255, 0.08);
            border-radius: 50%;
            transform: rotate(45deg);
            /* Transform mungkin tidak didukung penuh, tapi coba saja */
            z-index: 0;
        }

        .card-container::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: -15px;
            width: 50px;
            height: 50px;
            background: rgba(40, 167, 69, 0.08);
            border-radius: 50%;
            z-index: 0;
        }

        .logo {
            width: 30px;
            position: absolute;
            /* Tetap absolute untuk penempatan di sudut */
            top: 15px;
            left: 10px;
            z-index: 10;
            /* Pastikan logo di atas elemen dekoratif */
        }

        .header {
            text-align: right;
            margin-bottom: 8px;
            padding-top: 5px;
            position: relative;
            /* Konten header relatif terhadap card-container */
            z-index: 5;
            /* Di atas elemen dekoratif */
        }

        .header h3 {
            font-family: 'Times New Roman', serif;
            font-size: 14px;
            margin: 0;
            color: #007bff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .header p {
            font-size: 9px;
            margin: 0;
            color: #6c757d;
            line-height: 1.2;
        }

        /* Menggunakan display: table untuk layout yang lebih stabil di Dompdf */
        .content {
            display: table;
            width: 100%;
            /* Penting agar tabel memenuhi lebar container */
            border-collapse: collapse;
            /* Menghilangkan spasi antar cell tabel */
            margin-top: 10px;
            position: relative;
            /* Konten utama relatif terhadap card-container */
            z-index: 5;
            /* Di atas elemen dekoratif */
        }

        .photo {
            display: table-cell;
            /* Mengubah dari flex item menjadi table cell */
            width: 70px;
            /* Lebar tetap untuk foto */
            height: 85px;
            /* Tinggi tetap untuk foto */
            border: 2px solid #007bff;
            border-radius: 8px;
            background-color: #e9ecef;
            text-align: center;
            /* Untuk menengahkan span 'Tidak ada foto' */
            vertical-align: top;
            /* Sejajarkan ke atas */
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Memberi jarak ke details */
        }

        .photo img {
            width: 70px;
            height: 85px;
            object-fit: cover;
            display: block;
        }

        .photo span {
            color: #888;
            font-size: 9px;
            display: block;
            /* Agar span bisa di-align center vertikal */
            line-height: 85px;
            /* Menengahkan teks secara vertikal */
        }

        .details {
            display: table-cell;
            /* Mengubah dari flex item menjadi table cell */
            vertical-align: top;
            /* Sejajarkan ke atas */
            padding-left: 5px;
            /* Padding kiri untuk detail */
        }

        .details p {
            margin: 4px 0;
            line-height: 1.4;
            font-size: 9px;
            color: #333;
        }

        .details p strong {
            color: #495057;
            width: 70px;
            display: inline-block;
        }

        .footer {
            position: absolute;
            /* Tetap absolute */
            bottom: 10px;
            left: 15px;
            right: 15px;
            text-align: center;
            font-size: 8px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            padding-top: 8px;
            z-index: 5;
        }

        .nowrap {
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="card-container">
        <!-- Logo sekolah, perhatikan jalur asset -->
        <img src="{{ public_path('img/logo-sma.png') }}" class="logo" alt="Logo Sekolah">

        <div class="header">
            <h3>KARTU ANGGOTA PERPUSTAKAAN</h3>
            <p>SMA Muhammadiyah Kuala Kapuas</p>
        </div>

        <div class="content">
            <div class="photo">

                @if ($member->foto && file_exists(public_path('storage/' . $member->foto)))
                    <img src="{{ public_path('storage/' . $member->foto) }}" alt="Foto Anggota" class="cover-img">
                @else
                    <span class="text-muted">Tidak Ada Foto</span>
                @endif
            </div>

            <div class="details">
                <p><strong>Kode     :</strong> <span class="nowrap">{{ $member->kode }}</span></p>
                <p><strong>Nama     :</strong> {{ $member->user->name ?? '-' }}</p>
                <p><strong>Tahun Ajaran    :</strong> {{ $member->user->tahun_ajaran ?? '-' }}</p>
                <p><strong>Telepon  :</strong> <span class="nowrap">{{ $member->telepon }}</span></p>
                <p><strong>Expire   :</strong> {{ \Carbon\Carbon::parse($member->expire)->format('d-m-Y') }}</p>
            </div>
        </div>

        <div class="footer">
            Perpustakaan SMA Muhammadiyah Kuala Kapuas © {{ date('Y') }}
        </div>
    </div>
</body>

</html>
