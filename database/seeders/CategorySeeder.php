<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Novel',
            'Fiksi',
            'Non-Fiksi',
            'Biografi',
            'Ensiklopedia',
            'Komik',
            'Majalah',
            'Jurnal',
            'Kamus',
            'Pelajaran',
            'Matematika',
            'Bahasa Inggris',
            'Bahasa Indonesia',
            'IPA',
            'IPS',
            'Seni Budaya',
            'Olahraga',
            'Agama',
            'Teknologi',
            'Sejarah',
        ];

        foreach ($categories as $category) {
            Category::create([
                'nama_kategori' => $category
            ]);
        }
    }
}
