<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Metode untuk Manajemen Anggota
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        return view('admin.dashboard', [
            'title' => 'Dashboard Anggota',
            'anggota' => Anggota::orderBy('periode', 'desc')->get()
        ]);
    }

    public function create()
    {
        return view('admin.anggota-create', [
            'title' => 'Tambah Anggota'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'periode' => 'required|max:255',
            'divisi' => 'nullable|max:255',
            'foto' => 'nullable|image|file|max:5000', // <-- Koma ditambahkan
            'instagram' => 'nullable|string|max:255'
        ]);

        if ($request->file('foto')) {
            $path = $request->file('foto')->store('anggota-foto', 'public');
            $validatedData['foto'] = basename($path);
        }

        Anggota::create($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Anggota baru berhasil ditambahkan!');
    }

    public function edit(Anggota $anggota)
    {
        return view('admin.anggota-edit', [
            'title' => 'Edit Anggota',
            'anggota' => $anggota
        ]);
    }

    public function update(Request $request, Anggota $anggota)
    {
        $rules = [
            'nama' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'periode' => 'required|max:255',
            'divisi' => 'nullable|max:255',
            'foto' => 'nullable|image|file|max:5000',
            'instagram' => 'nullable|string|max:255' // <-- Aturan validasi ditambahkan
        ];
        $validatedData = $request->validate($rules);

        if ($request->file('foto')) {
            if ($anggota->foto) {
                Storage::disk('public')->delete('anggota-foto/' . $anggota->foto);
            }
            $path = $request->file('foto')->store('anggota-foto', 'public');
            $validatedData['foto'] = basename($path);
        }

        $anggota->update($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Data anggota berhasil diupdate!');
    }

    public function destroy(Anggota $anggota)
    {
        if ($anggota->foto) {
            Storage::disk('public')->delete('anggota-foto/' . $anggota->foto);
        }
        $anggota->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Data anggota berhasil dihapus!');
    }

    /*
    |--------------------------------------------------------------------------
    | Metode untuk Halaman Statis
    |--------------------------------------------------------------------------
    */

    public function editSejarah()
    {
        return view('admin.sejarah-edit', [
            'title' => 'Edit Halaman Sejarah',
            'sejarah' => Setting::where('key', 'sejarah_content')->firstOrFail()
        ]);
    }

    public function updateSejarah(Request $request)
    {
        $setting = Setting::where('key', 'sejarah_content')->firstOrFail();
        $validatedData = $request->validate([
            'value' => 'required',
            'image' => 'nullable|image|file|max:3072'
        ]);

        if ($request->file('image')) {
            if ($setting->image) {
                Storage::disk('public')->delete('halaman/' . $setting->image);
            }
            $path = $request->file('image')->store('halaman', 'public');
            $validatedData['image'] = basename($path);
        }
        $setting->update($validatedData);

        return redirect()->route('admin.sejarah.edit')->with('success', 'Halaman Sejarah berhasil diupdate!');
    }
    
    public function editFilosofi()
    {
        return view('admin.filosofi-edit', [
            'title' => 'Edit Filosofi Logo',
            'content' => Setting::where('key', 'filosofi_logo_content')->firstOrFail(),
            'image' => Setting::where('key', 'filosofi_logo_image')->firstOrFail()
        ]);
    }

    public function updateFilosofi(Request $request)
    {
        $validated = $request->validate([ 'value' => 'required', 'image' => 'nullable|image|max:5120' ]);
        Setting::where('key', 'filosofi_logo_content')->update(['value' => $validated['value']]);
        if ($request->file('image')) {
            $imageSetting = Setting::where('key', 'filosofi_logo_image')->firstOrFail();
            if ($imageSetting->value) Storage::disk('public')->delete('halaman/' . $imageSetting->value);
            $path = $request->file('image')->store('halaman', 'public');
            $imageSetting->update(['value' => basename($path)]);
        }
        return redirect()->route('admin.filosofi.edit')->with('success', 'Halaman Filosofi Logo berhasil diupdate!');
    }

    public function editStruktur()
    {
        return view('admin.struktur-edit', [
            'title' => 'Edit Struktur Sekolah',
            'content' => Setting::where('key', 'struktur_sekolah_content')->firstOrFail(),
            'image' => Setting::where('key', 'struktur_sekolah_image')->firstOrFail()
        ]);
    }

    public function updateStruktur(Request $request)
    {
        $validated = $request->validate([ 'value' => 'required', 'image' => 'nullable|image|max:5120' ]);
        Setting::where('key', 'struktur_sekolah_content')->update(['value' => $validated['value']]);
        if ($request->file('image')) {
            $imageSetting = Setting::where('key', 'struktur_sekolah_image')->firstOrFail();
            if ($imageSetting->value) Storage::disk('public')->delete('halaman/' . $imageSetting->value);
            $path = $request->file('image')->store('halaman', 'public');
            $imageSetting->update(['value' => basename($path)]);
        }
        return redirect()->route('admin.struktur.edit')->with('success', 'Halaman Struktur Sekolah berhasil diupdate!');
    }
}