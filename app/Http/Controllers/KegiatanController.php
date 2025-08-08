<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    /**
     * Menampilkan halaman daftar kegiatan (tabel).
     */
    public function index()
    {
        return view('admin.kegiatan.index', [
            'title' => 'Manajemen Kegiatan',
            'kegiatan' => Kegiatan::orderBy('tanggal', 'desc')->get()
        ]);
    }

    /**
     * Menampilkan halaman form untuk menambah kegiatan baru.
     */
    public function create()
    {
        return view('admin.kegiatan.create', [
            'title' => 'Tambah Kegiatan Baru'
        ]);
    }

    /**
     * Menyimpan data kegiatan baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required',
            'foto' => 'required|image|file|max:5000'
        ]);

        if ($request->file('foto')) {
            $path = $request->file('foto')->store('kegiatan-foto', 'public');
            $validatedData['foto'] = basename($path);
        }

        Kegiatan::create($validatedData);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman form untuk mengedit kegiatan.
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', [
            'title' => 'Edit Kegiatan',
            'kegiatan' => $kegiatan
        ]);
    }

    /**
     * Memproses update data kegiatan.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $rules = [
            'judul' => 'required|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|file|max:5000'
        ];
        $validatedData = $request->validate($rules);

        if ($request->file('foto')) {
            if ($kegiatan->foto) {
                Storage::disk('public')->delete('kegiatan-foto/' . $kegiatan->foto);
            }
            $path = $request->file('foto')->store('kegiatan-foto', 'public');
            $validatedData['foto'] = basename($path);
        }

        $kegiatan->update($validatedData);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Data kegiatan berhasil diupdate!');
    }

    /**
     * Menghapus data kegiatan dari database.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->foto) {
            Storage::disk('public')->delete('kegiatan-foto/' . $kegiatan->foto);
        }
        $kegiatan->delete();
        return redirect()->route('admin.kegiatan.index')->with('success', 'Data kegiatan berhasil dihapus!');
    }
}