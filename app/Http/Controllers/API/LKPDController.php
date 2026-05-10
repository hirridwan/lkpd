<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LKPDResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LKPDController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'kelas'    => 'required|string|max:50',
            'skor'     => 'required|array',
            'refleksi' => 'required|array',
        ]);

        $data = LKPDResult::create($validated);

        return response()->json(['status' => 'success', 'message' => 'Laporan berhasil dikirim!'], 201);
    }

    public function getStats()
    {
        $results = LKPDResult::all();
        
        $leaderboard = $results->map(function($item) {
            // Hitung jumlah jawaban benar dari 3 misi [cite: 110]
            $correctCount = collect($item->skor)->filter(fn($val) => $val === true)->count();
            return [
                'nama' => $item->nama,
                'kelas' => $item->kelas,
                'total_benar' => $correctCount,
                'akurasi' => round(($correctCount / 3) * 100, 1)
            ];
        })->sortByDesc('total_benar')->values()->take(5); // Ambil Top 5

        $totalAkurasi = $results->count() > 0 ? $results->avg(function($item) {
            return collect($item->skor)->filter(fn($val) => $val === true)->count() / 3 * 100;
        }) : 0;

        return response()->json([
            'leaderboard' => $leaderboard,
            'rata_rata_kelas' => round($totalAkurasi, 1)
        ]);
    }
}