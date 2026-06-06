<?php

namespace App\Http\Controllers;

use App\Models\StockOpname;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class StockOpnameController extends Controller
{
    /**
     * Menampilkan daftar data stok opname.
     */
    public function index_opname(Request $request)
    {
        $query = StockOpname::with('book', 'user');

        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $opnames = $query->orderBy('created_at', 'desc')->get();

        return view('index_opname', compact('opnames'));
    }


    public function create_opname()
    {
        $books = Book::all();
        return view('create_opname', compact('books'));
    }

    /**
     * Menyimpan hasil stok opname dari form.
     */
    public function store_opname(Request $request)
    {
        // Validasi input array books
        $validated = $request->validate([
            'books' => 'required|array',
            'books.*.book_id' => 'required|exists:books,id',
            'books.*.actual_stock' => 'required|integer|min:0',
            'books.*.note' => 'nullable|string'
        ]);

        foreach ($validated['books'] as $bookData) {
            // Temukan buku terkait
            $book = Book::findOrFail($bookData['book_id']);

            // Buat data StockOpname tanpa mengubah stok sistem
            StockOpname::create([
                'book_id' => $book->id,
                'actual_stock' => $bookData['actual_stock'],
                'note' => $bookData['note'] ?? null,
                'user_id' => Auth::id()
            ]);
        }

        return redirect()->route('index_opname')->with('success', 'Stok opname berhasil disimpan.');
    }

    /**
     * Cetak laporan stok opname ke PDF.
     */
    public function cetak_opname(Request $request)
    {
        $query = StockOpname::with('book', 'user');

        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $opnames = $query->orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('cetak_opname', [
            'opnames'     => $opnames,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('Daftar-Opname.pdf');
    }
}
