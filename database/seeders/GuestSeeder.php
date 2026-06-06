<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guest;
use Carbon\Carbon;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guests = [
            [
                'tanggal' => Carbon::create(2025, 7, 1),
                'nama' => 'Ahmad Fauzi',
                'alamat' => 'Jl. Merdeka No.1',
                'jabatan' => 'Guru',
                'pesan' => 'Perpustakaan sangat nyaman.',
                'tanda_tangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::create(2025, 7, 1),
                'nama' => 'Siti Rahmawati',
                'alamat' => 'Jl. Kenanga No.10',
                'jabatan' => 'Orang Tua',
                'pesan' => 'Anak saya betah membaca di sini.',
                'tanda_tangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::create(2025, 7, 1),
                'nama' => 'Budi Santoso',
                'alamat' => 'Jl. Ahmad Yani No.25',
                'jabatan' => 'Kepala Sekolah',
                'pesan' => 'Fasilitas perlu terus ditingkatkan.',
                'tanda_tangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::create(2025, 7, 1),
                'nama' => 'Rina Agustina',
                'alamat' => 'Jl. Flamboyan No.3',
                'jabatan' => 'Mahasiswa',
                'pesan' => 'Tempat yang cocok untuk riset.',
                'tanda_tangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::create(2025, 7, 1),
                'nama' => 'Dewi Lestari',
                'alamat' => 'Jl. Mawar No.17',
                'jabatan' => 'Pustakawan',
                'pesan' => 'Koleksi buku sudah baik.',
                'tanda_tangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::create(2025, 7, 1),
                'nama' => 'Fajar Nugroho',
                'alamat' => 'Jl. Melati No.9',
                'jabatan' => 'Tamu',
                'pesan' => 'Pelayanan sangat ramah.',
                'tanda_tangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::create(2025, 7, 1),
                'nama' => 'Sri Wahyuni',
                'alamat' => 'Jl. Anggrek No.5',
                'jabatan' => 'Guru Tamu',
                'pesan' => 'Senang melihat anak rajin membaca.',
                'tanda_tangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::create(2025, 7, 1),
                'nama' => 'Hendra Saputra',
                'alamat' => 'Jl. Dahlia No.8',
                'jabatan' => 'Alumni',
                'pesan' => 'Bangga dengan perpustakaan sekolah.',
                'tanda_tangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::create(2025, 7, 1),
                'nama' => 'Linda Permata',
                'alamat' => 'Jl. Sawo No.14',
                'jabatan' => 'Orang Tua',
                'pesan' => 'Sangat membantu anak belajar.',
                'tanda_tangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::create(2025, 7, 1),
                'nama' => 'Rizky Hidayat',
                'alamat' => 'Jl. Rambutan No.22',
                'jabatan' => 'Tamu',
                'pesan' => 'Tempat yang asri dan nyaman.',
                'tanda_tangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($guests as $guest) {
            Guest::create($guest);
        }
    }
}
