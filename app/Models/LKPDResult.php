<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LKPDResult extends Model
{
    use HasFactory;

    protected $table = 'sorting_results';

    protected $fillable = ['nama', 'kelas', 'skor', 'refleksi'];

    protected $casts = [
        'skor' => 'array',
        'refleksi' => 'array',
    ];
}