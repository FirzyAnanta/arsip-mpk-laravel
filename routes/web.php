<?php

use Illuminate\Support\Facades\Route;
use App\Models\Anggota; 
use App\Models\Kegiatan;
use App\Models\Setting;
use App\Models\Pembina;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PembinaController; 

/*
|--------------------------------------------------------------------------
| Rute Halaman Publik
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sejarah', function () {
    return view('sejarah', [
        'title' => 'Sejarah',
        'sejarah' => Setting::where('key', 'sejarah_content')->firstOrFail()
    ]);
});

Route::get('/filosofi-logo', function () {
    return view('filosofi-logo', [
        'title' => 'Filosofi Logo',
        'content' => Setting::where('key', 'filosofi_logo_content')->firstOrNew(),
        'image' => Setting::where('key', 'filosofi_logo_image')->firstOrNew()
    ]);
});

Route::get('/struktur-sekolah', function () {
    return view('struktur-sekolah', [
        'title' => 'Struktur Sekolah',
        'content' => Setting::where('key', 'struktur_sekolah_content')->firstOrNew(),
        'image' => Setting::where('key', 'struktur_sekolah_image')->firstOrNew()
    ]);
});

Route::get('/kegiatan', function () {
    return view('kegiatan', [
        'title' => 'Kegiatan',
        'kegiatan' => Kegiatan::orderBy('tanggal', 'desc')->get()
    ]);
});

Route::get('/kegiatan/{kegiatan}', function (Kegiatan $kegiatan) {
    return view('kegiatan-detail', [
        'title' => $kegiatan->judul,
        'kegiatan' => $kegiatan
    ]);
});

Route::get('/generasi/{periode?}', function ($periode = null) {
    $semua_periode = Anggota::select('periode')->distinct()->orderBy('periode', 'desc')->get();
    $query = Anggota::query();
    if ($periode) {
        $periode_format_db = str_replace('-', '/', $periode);
        $query->where('periode', $periode_format_db);
    }
    
    $pembina = Pembina::orderBy('periode', 'desc')->get();

    return view('generasi', [
        "title" => "Struktur & Generasi",
        "anggota" => $query->get(),
        "semua_periode" => $semua_periode,
        "periode_aktif" => $periode,
        "pembina" => $pembina
    ]);
});


/*
|--------------------------------------------------------------------------
| Rute Autentikasi Bawaan Breeze
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Grup Route KHUSUS ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    
    // Rute CRUD untuk Anggota
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/anggota/create', [AdminController::class, 'create'])->name('anggota.create');
    Route::post('/anggota/store', [AdminController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/{anggota}/edit', [AdminController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{anggota}', [AdminController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{anggota}', [AdminController::class, 'destroy'])->name('anggota.destroy');

    // Resource Route untuk Kegiatan
    Route::resource('/kegiatan', KegiatanController::class);

    // Resource Route untuk Pembina
    Route::resource('/pembina', PembinaController::class);
    
    // Rute untuk Halaman Statis
    Route::get('/sejarah/edit', [AdminController::class, 'editSejarah'])->name('sejarah.edit');
    Route::put('/sejarah', [AdminController::class, 'updateSejarah'])->name('sejarah.update');
    Route::get('/filosofi/edit', [AdminController::class, 'editFilosofi'])->name('filosofi.edit');
    Route::put('/filosofi', [AdminController::class, 'updateFilosofi'])->name('filosofi.update');
    Route::get('/struktur/edit', [AdminController::class, 'editStruktur'])->name('struktur.edit');
    Route::put('/struktur', [AdminController::class, 'updateStruktur'])->name('struktur.update');
});


require __DIR__.'/auth.php';