<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;

class BookController extends Controller
{
    public function create_book()
    {
        $categories = Category::all();
        return view('create_book', compact('categories'));
    }

    public function store_book(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'pengarang' => 'required|string',
            'stock' => 'required|integer',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rak_buku' => 'required|string|max:255',
        ]);

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public'); // Simpan ke storage/app/public/covers
        } else {
            $path = null;
        }

        Book::create([
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'pengarang' => $request->pengarang,
            'stock' => $request->stock,
            'cover' => $path, // Simpan path-nya ke DB
            'rak_buku' => $request->rak_buku,
        ]);

        return redirect()->route('show_book')->with('success', 'Buku berhasil ditambahkan.');
    }



    public function show_book()
    {
        $books = Book::with('category', 'ratings')->withAvg('ratings', 'rating')->get();
        return view('show_book', compact('books'));
    }

    public function edit_book(Book $book)
    {
        $categories = Category::all();
        return view('edit_book', compact('book', 'categories'));
    }

    public function update_book(Request $request, Book $book)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'pengarang' => 'required|string',
            'stock' => 'required|integer',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rak_buku' => 'nullable|string|max:255',
        ]);

        // Jika ada file cover baru di-upload
        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($book->cover && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }

            // Simpan cover baru ke storage/public/covers
            $imageName = 'covers/' . time() . '.' . $request->cover->extension();
            $request->file('cover')->storeAs('public', $imageName);

            // Update data termasuk cover
            $book->cover = $imageName;
        }

        // Update data lain
        $book->judul = $request->judul;
        $book->category_id = $request->category_id;
        $book->pengarang = $request->pengarang;
        $book->stock = $request->stock;
        $book->rak_buku = $request->rak_buku;
        $book->save();

        return redirect()->route('show_book')->with('success', 'Data buku berhasil diperbarui.');
    }

    public function delete_book(Book $book)
    {
        $book->delete();
        return Redirect::route('show_book');
    }

    public function cetak_book()
    {
        $books = Book::with('category')->get();

        $pdf = Pdf::loadHTML('cetak_book', compact('books'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('Daftar-Buku.pdf');
    }
}
