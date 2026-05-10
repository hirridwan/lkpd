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
        Schema::create('lkpd_results', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('kelas_absen');
            $table->json('jawaban'); // Menyimpan detail Misi 1, 2, dan 3
            $table->string('refleksi_emoji')->nullable();
            $table->text('refleksi_teks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lkpd_results');
    }
};
