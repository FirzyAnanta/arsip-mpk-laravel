<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Beritahu Laravel bahwa tidak ada kolom yang perlu dilindungi.
    // Ini mengizinkan mass assignment untuk semua kolom di tabel ini.
    protected $guarded = ['id'];
}