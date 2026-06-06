<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\DamagedBook;
use Barryvdh\DomPDF\Facade\Pdf;

class DamagedBookController extends Controller
{
    public function index_damaged(Request $request)
    {
        $query = DamagedBook::with('book')->orderBy('tanggal', 'desc');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $data = $query->get();

        return view('index_damaged', compact('data'))
            ->with([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);
    }

    public function create_damaged()
    {
        $books = Book::all();
        return view('create_damaged', compact('books'));
    }

    public function store_damaged(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok buku tidak mencukupi untuk dicatat sebagai rusak.');
        }

        $book->stock -= $request->jumlah;
        $book->save();

        DamagedBook::create($request->all());

        return redirect()->route('index_damaged')->with('success', 'Laporan buku rusak berhasil disimpan dan stok buku dikurangi.');
    }

    public function cetak_damaged(Request $request)
    {
        $query = DamagedBook::with('book')->orderBy('tanggal', 'desc');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $data = $query->get();

        $pdf = PDF::loadView('cetak_damaged', compact('data'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('laporan_buku_rusak.pdf');
    }

    public function edit_damaged($id)
    {
        $data = DamagedBook::findOrFail($id);
        $books = Book::all();
        return view('edit_damaged', compact('data', 'books'));
    }

    public function update_damaged(Request $request, $id)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $rusak = DamagedBook::findOrFail($id);
        $book = Book::findOrFail($request->book_id);

        $selisih = $request->jumlah - $rusak->jumlah;

        if ($selisih > 0 && $book->stock < $selisih) {
            return redirect()->back()->with('error', 'Stok buku tidak mencukupi untuk pembaruan jumlah rusak.');
        }

        $book->stock -= $selisih;
        $book->save();

        $rusak->update($request->all());

        return redirect()->route('index_damaged')->with('success', 'Data berhasil diperbarui dan stok buku disesuaikan.');
    }

    public function delete_damaged($id)
    {
        DamagedBook::findOrFail($id)->delete();
        return redirect()->route('index_damaged')->with('success', 'Data berhasil dihapus.');
    }
}
