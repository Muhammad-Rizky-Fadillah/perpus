<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Borrower extends Model
{
    protected $fillable = [
        'user_id',
        'tgl_pinjam',
        'tgl_kembali',
        'is_confirm',
        'fine',
        'tgl_kembali_confirm'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_borrower'); // Nama pivot table
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateFine()
    {
        $today = Carbon::today();
        $tglKembali = Carbon::parse($this->tgl_kembali);

        if ($today->lessThanOrEqualTo($tglKembali)) {
            return 0;
        }

        $daysLate = $today->diffInDays($tglKembali);
        $finePerDay = 1000; // Sesuaikan dengan kebijakan
        return $daysLate * $finePerDay;
    }
}
