<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Inventaris</title>

<style>
body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 12px;
    margin: 30px;
    color: #000;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #000;
    padding: 6px;
    text-align: center;
}

th {
    background: #f2f2f2;
}

.text-left {
    text-align: left;
}

.footer {
    position: fixed;
    bottom: -30px;
    left: 0;
    right: 0;
    text-align: center;
    font-size: 10px;
}
</style>
</head>

<body>

@php
    $logoPath = public_path('img/logo-sma.png');
    $logo = base64_encode(file_get_contents($logoPath));
@endphp

<table style="border: none; margin-bottom: 15px;">
    <tr>
        <td style="border:none; width:100px;">
            <img src="data:image/png;base64,{{ $logo }}" style="width:80px;">
        </td>
        <td style="border:none; text-align:center;">
            <h3 style="margin:0;">LAPORAN INVENTARIS PERPUSTAKAAN</h3>
            <p style="margin:0;">SMA Muhammadiyah Kuala Kapuas</p>
            <p style="margin:0;">Jl. Barito No. 11</p>
        </td>
    </tr>
</table>

<hr>

<p>
<strong>Tahun:</strong>
{{ request('tahun') ?? 'Semua Tahun' }}
</p>

<table>
<thead>
<tr>
    <th>No</th>
    <th>Nama Barang</th>
    <th>Merk</th>
    <th>Tahun</th>
    <th>Jumlah</th>
    <th>Harga</th>
    <th>Keadaan</th>
    <th>Keterangan</th>
</tr>
</thead>

<tbody>
@forelse ($inventories as $key => $item)
<tr>
    <td>{{ $key + 1 }}</td>
    <td class="text-left">{{ $item->nama }}</td>
    <td>{{ $item->merk }}</td>
    <td>{{ $item->tahun }}</td>
    <td>{{ $item->jumlah }}</td>
    <td class="text-left">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
    <td>{{ $item->keadaan }}</td>
    <td class="text-left">{{ $item->keterangan }}</td>
</tr>
@empty
<tr>
    <td colspan="8">Tidak ada data</td>
</tr>
@endforelse
</tbody>
</table>

<br><br>

<div style="text-align:right;">
<p>Kuala Kapuas, {{ Carbon::now()->translatedFormat('d F Y') }}</p>
<p>Kepala Perpustakaan</p>
<br><br><br>
<p><u>_________________________</u></p>
</div>

<div class="footer">
    © {{ date('Y') }} SMA Muhammadiyah Kuala Kapuas
</div>

</body>
</html>