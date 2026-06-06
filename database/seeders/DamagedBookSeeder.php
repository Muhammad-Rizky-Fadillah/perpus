<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DamagedBook;
use App\Models\Book;
use App\Models\Category;
use Carbon\Carbon;

class DamagedBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada kategori buku
        if (Category::count() == 0) {
            for ($i = 1; $i <= 3; $i++) {
                Category::create([
                    'name' => 'Kategori ' . $i,
                ]);
            }
        }

        $categories = Category::all();

        // Pastikan ada minimal 10 buku
        if (Book::count() < 10) {
            for ($i = 1; $i <= 10; $i++) {
                Book::create([
                    'judul' => 'Buku Dummy ' . $i,
                    'category_id' => $categories->random()->id,
                    'pengarang' => 'Pengarang ' . $i,
                    'stock' => 10,
                    'rak_buku' => 'Rak ' . rand(1, 5),
                    'cover' => null,
                ]);
            }
        }

        // Ambil 10 buku
        $books = Book::take(10)->get();

        foreach ($books as $book) {
            // Tentukan jumlah rusak random antara 1-2 (jangan melebihi stok buku)
            $jumlahRusak = rand(1, min(2, $book->stock));

            // Buat data buku rusak
            DamagedBook::create([
                'book_id' => $book->id,
                'jumlah' => $jumlahRusak,
                'keterangan' => 'Kerusakan ringan pada sampul.',
                'tanggal' => Carbon::now()->subDays(rand(0, 30))->toDateString(),
            ]);

            // Kurangi stok buku
            $book->stock -= $jumlahRusak;
            $book->save();
        }
    }
}
