<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'judul' => 'Perahu Kertas',
                'category_id' => 2,
                'pengarang' => 'Dee Lestari',
                'stock' => 10,
                'rak_buku' => 'A1',
                'cover' => 'perahukertas.jpg',
            ],
            [
                'judul' => 'Pergi',
                'category_id' => 2,
                'pengarang' => 'Tere Liye',
                'stock' => 5,
                'rak_buku' => 'A2',
                'cover' => 'pergi.jpg',
            ],
            [
                'judul' => 'Aku Mengenal Hewan',
                'category_id' => 11,
                'pengarang' => 'Olivia Wilson',
                'stock' => 15,
                'rak_buku' => 'B1',
                'cover' => 'hewan.jpg',
            ],
            [
                'judul' => 'Kala Senja Menyapa',
                'category_id' => 12,
                'pengarang' => 'Rosa Maria Aquado',
                'stock' => 8,
                'rak_buku' => 'B2',
                'cover' => 'senja.jpg',
            ],
            [
                'judul' => 'Sang Penerbang di Taman Puisi',
                'category_id' => 13,
                'pengarang' => 'Brigitte Schwartz',
                'stock' => 7,
                'rak_buku' => 'C1',
                'cover' => 'penerbang.jpg',
            ],
            [
                'judul' => 'Pilih Untuk Pulih',
                'category_id' => 20,
                'pengarang' => 'Sepiaheru',
                'stock' => 12,
                'rak_buku' => 'C1',
                'cover' => 'pulih.jpg',
            ],
            [
                'judul' => 'What We Talk About When We Talk About Love',
                'category_id' => 13,
                'pengarang' => 'Raymond Carver',
                'stock' => 6,
                'rak_buku' => 'C2',
                'cover' => 'inggris.jpg',
            ],
            [
                'judul' => 'Laskar Pelangi',
                'category_id' => 13,
                'pengarang' => 'Andrea Hirata',
                'stock' => 9,
                'rak_buku' => 'A1',
                'cover' => 'pelangi.jpg',
            ],
            [
                'judul' => 'Perspektif Pendidikan dalam Bingkai Ilmu dan Tokoh',
                'category_id' => 16,
                'pengarang' => 'Kurniawan',
                'stock' => 11,
                'rak_buku' => 'C2',
                'cover' => 'pendidikan.jpg',
            ],
            [
                'judul' => 'Abstract Book',
                'category_id' => 19,
                'pengarang' => 'Regina Phalange',
                'stock' => 4,
                'rak_buku' => 'C1',
                'cover' => 'abstract.jpg',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
