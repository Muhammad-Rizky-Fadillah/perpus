<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inventories = [
            [
                'nama' => 'Meja Perpustakaan',
                'merk' => 'Olympic',
                'tahun' => 2020,
                'jumlah' => 10,
                'harga' => 350000,
                'keadaan' => 'Baik',
                'keterangan' => 'Meja baca siswa',
            ],
            [
                'nama' => 'Kursi Baca',
                'merk' => 'Futura',
                'tahun' => 2021,
                'jumlah' => 20,
                'harga' => 150000,
                'keadaan' => 'Baik',
                'keterangan' => 'Kursi kayu untuk siswa',
            ],
            [
                'nama' => 'Rak Buku Besi',
                'merk' => 'Informa',
                'tahun' => 2019,
                'jumlah' => 5,
                'harga' => 750000,
                'keadaan' => 'Baik',
                'keterangan' => 'Rak buku pelajaran',
            ],
            [
                'nama' => 'Komputer Perpustakaan',
                'merk' => 'Lenovo',
                'tahun' => 2022,
                'jumlah' => 2,
                'harga' => 5500000,
                'keadaan' => 'Baik',
                'keterangan' => 'Untuk input data',
            ],
            [
                'nama' => 'Printer',
                'merk' => 'Epson L3110',
                'tahun' => 2022,
                'jumlah' => 1,
                'harga' => 2000000,
                'keadaan' => 'Baik',
                'keterangan' => 'Cetak kartu anggota',
            ],
            [
                'nama' => 'Lemari Arsip',
                'merk' => 'Lion Star',
                'tahun' => 2018,
                'jumlah' => 3,
                'harga' => 900000,
                'keadaan' => 'Baik',
                'keterangan' => 'Menyimpan dokumen',
            ],
            [
                'nama' => 'Karpet Ruang Baca',
                'merk' => 'Royal',
                'tahun' => 2020,
                'jumlah' => 1,
                'harga' => 800000,
                'keadaan' => 'Baik',
                'keterangan' => 'Karpet ruang baca',
            ],
            [
                'nama' => 'Dispenser Air',
                'merk' => 'Miyako',
                'tahun' => 2019,
                'jumlah' => 1,
                'harga' => 600000,
                'keadaan' => 'Rusak Ringan',
                'keterangan' => 'Perlu diganti heater',
            ],
            [
                'nama' => 'Proyektor',
                'merk' => 'Epson',
                'tahun' => 2020,
                'jumlah' => 1,
                'harga' => 3500000,
                'keadaan' => 'Baik',
                'keterangan' => 'Untuk presentasi',
            ],
            [
                'nama' => 'Speaker Aktif',
                'merk' => 'Polytron',
                'tahun' => 2020,
                'jumlah' => 2,
                'harga' => 800000,
                'keadaan' => 'Baik',
                'keterangan' => 'Speaker ruang baca',
            ],
            [
                'nama' => 'Kipas Angin',
                'merk' => 'Maspion',
                'tahun' => 2018,
                'jumlah' => 3,
                'harga' => 250000,
                'keadaan' => 'Baik',
                'keterangan' => 'Sirkulasi udara',
            ],
            [
                'nama' => 'Stop Kontak',
                'merk' => 'Broco',
                'tahun' => 2019,
                'jumlah' => 10,
                'harga' => 35000,
                'keadaan' => 'Baik',
                'keterangan' => 'Listrik tambahan',
            ],
            [
                'nama' => 'Lemari Buku Kayu',
                'merk' => 'Olympic',
                'tahun' => 2019,
                'jumlah' => 4,
                'harga' => 950000,
                'keadaan' => 'Baik',
                'keterangan' => 'Rak koleksi fiksi',
            ],
            [
                'nama' => 'Jam Dinding',
                'merk' => 'Seiko',
                'tahun' => 2018,
                'jumlah' => 2,
                'harga' => 150000,
                'keadaan' => 'Baik',
                'keterangan' => 'Jam ruang baca',
            ],
            [
                'nama' => 'Alat Pel',
                'merk' => 'Scotch Brite',
                'tahun' => 2022,
                'jumlah' => 2,
                'harga' => 50000,
                'keadaan' => 'Baik',
                'keterangan' => 'Kebersihan lantai',
            ],
        ];

        foreach ($inventories as $inventory) {
            Inventory::create($inventory);
        }
    }
}
