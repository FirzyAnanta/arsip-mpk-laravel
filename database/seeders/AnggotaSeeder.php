<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anggota; // <-- INI PENTING

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Anggota::create([
        'nama' => 'Ahmad Prasetyo',
        'jabatan' => 'Ketua MPK',
        'periode' => '2023/2024',
        'divisi' => 'Badan Pengurus Harian',
        'foto' => 'ahmad.jpg' // <-- Sesuaikan dengan nama file asli
    ]);

    Anggota::create([
        'nama' => 'Bunga Citra Lestari',
        'jabatan' => 'Sekretaris Umum',
        'periode' => '2023/2024',
        'divisi' => 'Badan Pengurus Harian',
        'foto' => 'bunga.jpg' // <-- Sesuaikan dengan nama file asli
    ]);

    Anggota::create([
        'nama' => 'Candra Wijaya',
        'jabatan' => 'Anggota',
        'periode' => '2023/2024',
        'divisi' => 'Komisi A - Aspirasi',
        'foto' => 'candra.jpg' // <-- Sesuaikan dengan nama file asli
    ]);
    
    Anggota::create([
        'nama' => 'Dian Sastro',
        'jabatan' => 'Ketua MPK',
        'periode' => '2022/2023',
        'divisi' => 'Badan Pengurus Harian',
        'foto' => 'dian.jpg' // <-- Sesuaikan dengan nama file asli
    ]);

    Anggota::create([
        'nama' => 'Eko Patrio',
        'jabatan' => 'Anggota',
        'periode' => '2022/2023',
        'divisi' => 'Komisi B - Acara',
        'foto' => 'eko.jpg' // <-- Sesuaikan dengan nama file asli, PASTIKAN EKSTENSINYA BENAR (.jpg / .png)
    ]);
    }
}