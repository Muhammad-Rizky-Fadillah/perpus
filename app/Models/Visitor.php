<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'tahun_ajaran',
        'tujuan',
        'tanda_tangan'
    ];
}
