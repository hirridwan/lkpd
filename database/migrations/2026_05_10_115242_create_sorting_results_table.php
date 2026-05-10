<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sorting_results', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Menyimpan Nama Peserta Didik [cite: 3, 108]
            $table->string('kelas'); // Menyimpan Kelas/Absen [cite: 3, 108]
            $table->json('skor'); // Menyimpan status ketepatan algoritma (Bubble, Selection, Insertion) 
            $table->json('refleksi'); // Menyimpan emoji dan teks refleksi [cite: 112]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorting_results');
    }
};
