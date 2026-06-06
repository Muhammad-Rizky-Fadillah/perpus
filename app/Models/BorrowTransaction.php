<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowTransaction extends Model
{
    protected $fillable = ['user_id', 'tgl_pinjam', 'tgl_kembali', 'is_confirm'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function borrowers()
    {
        return $this->hasMany(Borrower::class);
    }
}
