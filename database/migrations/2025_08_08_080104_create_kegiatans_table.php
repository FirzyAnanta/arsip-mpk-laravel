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
    Schema::create('kegiatans', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->date('tanggal'); // Kolom khusus untuk tanggal
        $table->text('deskripsi'); // Kolom 'text' untuk penjelasan panjang
        $table->string('foto'); // Untuk foto utama kegiatan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
