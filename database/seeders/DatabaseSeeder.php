<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Memanggil seeder lain untuk mengisi data anggota
        $this->call([
            AnggotaSeeder::class,
        ]);

        // Membuat satu user admin
        User::factory()->create([
            'name' => 'Admin MPK',
            'email' => 'admin@mpk.com',
            'password' => 'password', // <-- Breeze akan otomatis hash password ini
        ]);
    }
}