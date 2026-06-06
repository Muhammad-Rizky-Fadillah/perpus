<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'nama' => 'Ahmad Fauzi',
                'jabatan' => 'Guru Matematika',
                'tujuan' => 'Mengembalikan buku pelajaran',
                'tanda_tangan' => 'teacher_signatures/ahmad_fauzi.png',
            ],
            [
                'nama' => 'Siti Rahmawati',
                'jabatan' => 'Guru Bahasa Indonesia',
                'tujuan' => 'Meminjam novel referensi',
                'tanda_tangan' => 'teacher_signatures/siti_rahmawati.png',
            ],
            [
                'nama' => 'Budi Santoso',
                'jabatan' => 'Guru Fisika',
                'tujuan' => 'Mengajar kelas XII IPA 1',
                'tanda_tangan' => 'teacher_signatures/budi_santoso.png',
            ],
            [
                'nama' => 'Dewi Kartika',
                'jabatan' => 'Guru Biologi',
                'tujuan' => 'Praktikum Biologi kelas XI',
                'tanda_tangan' => 'teacher_signatures/dewi_kartika.png',
            ],
            [
                'nama' => 'Rizky Hidayat',
                'jabatan' => 'Guru Kimia',
                'tujuan' => 'Mengajar materi larutan',
                'tanda_tangan' => 'teacher_signatures/rizky_hidayat.png',
            ],
            [
                'nama' => 'Nurlaila Hasanah',
                'jabatan' => 'Guru Sejarah',
                'tujuan' => 'Menyiapkan materi sejarah',
                'tanda_tangan' => 'teacher_signatures/nurlaila_hasanah.png',
            ],
            [
                'nama' => 'Taufik Hidayat',
                'jabatan' => 'Guru Penjas',
                'tujuan' => 'Koordinasi jadwal senam',
                'tanda_tangan' => 'teacher_signatures/taufik_hidayat.png',
            ],
            [
                'nama' => 'Linda Rosdiana',
                'jabatan' => 'Guru Ekonomi',
                'tujuan' => 'Meminjam buku akuntansi',
                'tanda_tangan' => 'teacher_signatures/linda_rosdiana.png',
            ],
            [
                'nama' => 'Agus Susanto',
                'jabatan' => 'Guru Geografi',
                'tujuan' => 'Membuat soal ujian',
                'tanda_tangan' => 'teacher_signatures/agus_susanto.png',
            ],
            [
                'nama' => 'Maya Sari',
                'jabatan' => 'Guru Sosiologi',
                'tujuan' => 'Rapat guru BK',
                'tanda_tangan' => 'teacher_signatures/maya_sari.png',
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}
