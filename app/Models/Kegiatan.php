<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- INI YANG KURANG
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
}