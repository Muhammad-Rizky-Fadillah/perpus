<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reminder Pengembalian Buku</title>
</head>

<body>
    <p>Assalamualaikum, {{ optional($borrower->user)->name ?? 'Pengguna' }}</p>

    <p>Ini adalah pengingat untuk mengembalikan buku yang kamu pinjam dengan detail berikut:</p>

    <ul>
        @foreach ($borrower->books as $book)
            <li><strong>Judul Buku:</strong> {{ $book->judul }}</li>
        @endforeach
        <li><strong>Tanggal Pinjam:</strong> {{ \Carbon\Carbon::parse($borrower->tgl_pinjam)->format('d-m-Y') }}</li>
        <li><strong>Tanggal Kembali:</strong> {{ \Carbon\Carbon::parse($borrower->tgl_kembali)->format('d-m-Y') }}</li>
    </ul>

    <p>Mohon segera dikembalikan sebelum atau pada tanggal kembali untuk menghindari denda.</p>

    <p>Terima kasih,<br>Perpustakaan SMA Muhammadiyah Kuala Kapuas</p>
</body>

</html>
