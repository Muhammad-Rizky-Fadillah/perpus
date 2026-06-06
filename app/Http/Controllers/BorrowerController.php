<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrower;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BorrowerApproved;
use App\Notifications\NewBorrowerRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReturnReminderMail;

class BorrowerController extends Controller
{
    public function index_borrower(Request $request)
    {
        $books = Book::all();

        // Query awal dengan relasi
        $borrowers = Borrower::with('books', 'user')
            // Filter berdasarkan buku jika diberikan
            ->when($request->book_id, function ($query) use ($request) {
                $query->whereHas('books', function ($q) use ($request) {
                    $q->where('id', $request->book_id);
                });
            })
            // Filter berdasarkan rentang tanggal pinjam jika diberikan
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                $query->whereBetween('tgl_pinjam', [$request->start_date, $request->end_date]);
            })
            // Filter untuk user non-admin
            ->when(!Auth::user()->is_admin, function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        return view('index_borrower', compact('borrowers', 'books'));
    }


    public function create_borrower(Request $request)
    {
        $books = Book::where('stock', '>', 0)->get();
        $selectedBookIds = $request->query('books', []);
        $selectedBookIds = array_map('intval', $selectedBookIds);

        return view('create_borrower', compact('books', 'selectedBookIds'));
    }

    public function store_borrower(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'exists:books,id',
            'tgl_pinjam' => 'required|date',
        ]);

        $tgl_pinjam = \Carbon\Carbon::parse($request->tgl_pinjam);
        $tgl_kembali = $tgl_pinjam->copy()->addDays(7);

        $borrower = Borrower::create([
            'user_id' => $user->id,
            'tgl_pinjam' => $tgl_pinjam,
            'tgl_kembali' => $tgl_kembali,
            'is_confirm' => false,
        ]);

        $borrower->books()->attach($request->book_ids);

        // Notifikasi ke admin
        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewBorrowerRequest($borrower));
        }

        return redirect()->route('confirm_borrower')->with('success', 'Permohonan peminjaman berhasil dikirim.');
    }

    public function confirm_borrower()
    {
        $borrowers = Borrower::with('books', 'user')
            ->where('is_confirm', false)
            ->orderBy('created_at', 'asc')
            ->get();

        $books = Book::all();
        return view('confirm_borrower', compact('borrowers', 'books'));
    }

    public function approve_borrower($id)
    {
        $borrower = Borrower::with('books', 'user')->findOrFail($id);

        if ($borrower->is_confirm) {
            return redirect()->back()->with('info', 'Peminjaman sudah dikonfirmasi sebelumnya.');
        }

        $borrower->is_confirm = true;
        $borrower->save();

        foreach ($borrower->books as $book) {
            $quantity = $book->pivot->quantity ?? 1;
            $book->stock -= $quantity;
            $book->stock = max($book->stock, 0);
            $book->save();
        }
        return redirect()->back()->with('success', 'Peminjaman berhasil dikonfirmasi dan stok buku telah dikurangi.');
    }

    public function show_borrower()
    {
        $borrowers = Borrower::with('books', 'user')->get();
        $books = Book::all();
        $users = User::all();

        return view('index_borrower', compact('borrowers', 'books', 'users'));
    }

    public function delete_borrower(Borrower $borrower)
    {
        $borrower->delete();
        return Redirect::route('show_borrower')->with('success', 'Data peminjaman berhasil dihapus.');
    }

    public function cetak_borrower(Request $request)
    {
        $query = Borrower::with('books', 'user');

        // Filter berdasarkan tanggal pinjam jika diberikan
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tgl_pinjam', [$request->start_date, $request->end_date]);
        } elseif ($request->start_date) {
            $query->whereDate('tgl_pinjam', '>=', $request->start_date);
        } elseif ($request->end_date) {
            $query->whereDate('tgl_pinjam', '<=', $request->end_date);
        }

        $borrowers = $query->get();

        $pdf = Pdf::loadView('cetak_borrower', compact('borrowers'))
            ->setPaper('A4', 'landscape');

        // Nama file PDF dinamis berdasarkan tanggal
        $fileName = 'Peminjam-Buku';
        if ($request->start_date && $request->end_date) {
            $fileName .= '-' . str_replace('-', '', $request->start_date) . '_s.d_' . str_replace('-', '', $request->end_date);
        } elseif ($request->start_date) {
            $fileName .= '-mulai-' . str_replace('-', '', $request->start_date);
        } elseif ($request->end_date) {
            $fileName .= '-sampai-' . str_replace('-', '', $request->end_date);
        }
        $fileName .= '.pdf';

        return $pdf->stream($fileName);
    }

    public function confirmReturn($id)
    {
        $borrower = Borrower::with('books', 'user')->findOrFail($id);

        if ($borrower->tgl_kembali_confirm) {
            return back()->with('info', 'Buku sudah dikembalikan sebelumnya.');
        }

        $borrower->tgl_kembali_confirm = now();
        $borrower->save();

        foreach ($borrower->books as $book) {
            $book->stock += 1;
            $book->save();
        }

        return back()->with('success', 'Pengembalian dikonfirmasi.');
    }
}
