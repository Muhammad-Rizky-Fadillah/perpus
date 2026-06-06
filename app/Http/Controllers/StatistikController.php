<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrower;
use Illuminate\Support\Facades\DB; 

class StatistikController extends Controller
{
    public function getPeminjamanBuku()
    {
        $data = Borrower::selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        return response()->json($data);
    }

    public function kunjungan()
    {
        $data = DB::table('visitors')
            ->selectRaw('MONTH(visited_at) as bulan, COUNT(*) as jumlah')
            ->whereYear('visited_at', date('Y'))
            ->groupBy('bulan')
            ->get();

        return response()->json($data);
    }
}
