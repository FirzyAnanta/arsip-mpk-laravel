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
    Schema::create('anggotas', function (Blueprint $table) {
        $table->id(); // Membuat kolom 'id'
        $table->string('nama'); // <-- Menambahkan kolom 'nama'
        $table->string('jabatan'); // <-- Menambahkan kolom 'jabatan'
        $table->string('periode'); // <-- Menambahkan kolom 'periode'
        $table->string('divisi')->nullable(); // <-- Menambahkan kolom 'divisi' (boleh kosong)
        $table->string('foto')->nullable(); // <-- Menambahkan kolom 'foto' (boleh kosong)
        $table->timestamps(); // Membuat kolom 'created_at' dan 'updated_at'
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
