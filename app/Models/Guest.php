<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nama',
        'alamat',
        'jabatan',
        'pesan',
        'tanda_tangan'
    ];
}
