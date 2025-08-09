<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // <-- WAJIB TAMBAHKAN INI

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil seeder lain jika ada (misalnya untuk data anggota)
        $this->call([
            // AnggotaSeeder::class, // Aktifkan jika Anda punya seeder ini
        ]);

        // Hapus user lama jika ada, untuk menghindari duplikat saat seeding ulang
        User::where('email', 'admin@mpk.com')->delete();

        // Membuat satu user admin dengan password yang di-hash
        User::create([
            'name' => 'Admin MPK',
            'email' => 'admin@mpk.com',
            'password' => Hash::make('admin123'), // <-- INI CARA YANG BENAR DAN AMAN
        ]);
    }
}