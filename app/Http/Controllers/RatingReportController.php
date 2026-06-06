<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class RatingReportController extends Controller
{
    public function index_rating()
    {
        $ratings = Rating::with(['book', 'user'])->get();
        return view('index_rating', compact('ratings'));
    }

    public function create_rating(Book $book)
    {
        $existing = Rating::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first();

        return view('create_rating', compact('book', 'existing'));
    }


    public function store_rating(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:255'
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'book_id' => $request->book_id
            ],
            [
                'rating' => $request->rating,
                'review' => $request->review
            ]
        );

        return redirect()->route('home')->with('success', 'Rating berhasil disimpan!');
    }

    public function edit_rating(Rating $rating)
    {
        $this->authorize('update', $rating);
        $books = Book::all();
        return view('edit_rating', compact('rating', 'books'));
    }

    public function update_rating(Request $request, Rating $rating)
    {
        $this->authorize('update', $rating);

        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:255'
        ]);

        $rating->update([
            'book_id' => $request->book_id,
            'rating' => $request->rating,
            'review' => $request->review
        ]);

        return redirect()->route('home')->with('success', 'Rating berhasil diperbarui!');
    }

    public function delete_rating(Rating $rating)
    {
        $this->authorize('delete', $rating);
        $rating->delete();
        return redirect()->route('index_rating')->with('success', 'Rating berhasil dihapus.');
    }

    public function cetak_rating()
    {
        $books = Book::with('ratings.user')->get();
        $pdf = PDF::loadView('cetak_rating', compact('books'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('laporan_rating_buku.pdf');
    }
}
