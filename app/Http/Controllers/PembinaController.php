<?php

namespace App\Http\Controllers;

use App\Models\Pembina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembinaController extends Controller
{
    /**
     * Menampilkan halaman daftar pembina (tabel).
     */
    public function index()
    {
        return view('admin.pembina.index', [
            'title' => 'Manajemen Pembina',
            'pembina' => Pembina::orderBy('periode', 'desc')->get()
        ]);
    }

    /**
     * Menampilkan halaman form untuk menambah pembina baru.
     */
    public function create()
    {
        return view('admin.pembina.create', [
            'title' => 'Tambah Pembina Baru'
        ]);
    }

    /**
     * Menyimpan data pembina baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'periode' => 'required|max:255',
            'instagram' => 'nullable|string|max:255',
            'foto' => 'required|image|file|max:5120' // Batas 5MB
        ]);

        if ($request->file('foto')) {
            $path = $request->file('foto')->store('pembina-foto', 'public');
            $validatedData['foto'] = basename($path);
        }

        Pembina::create($validatedData);

        return redirect()->route('admin.pembina.index')->with('success', 'Data pembina baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman form untuk mengedit pembina.
     */
    public function edit(Pembina $pembina)
    {
        return view('admin.pembina.edit', [
            'title' => 'Edit Data Pembina',
            'pembina' => $pembina
        ]);
    }

    /**
     * Memproses update data pembina.
     */
    public function update(Request $request, Pembina $pembina)
    {
        $rules = [
            'nama' => 'required|max:255',
            'periode' => 'required|max:255',
            'instagram' => 'nullable|string|max:255',
            'foto' => 'nullable|image|file|max:5120'
        ];
        $validatedData = $request->validate($rules);

        if ($request->file('foto')) {
            if ($pembina->foto) {
                Storage::disk('public')->delete('pembina-foto/' . $pembina->foto);
            }
            $path = $request->file('foto')->store('pembina-foto', 'public');
            $validatedData['foto'] = basename($path);
        }

        $pembina->update($validatedData);

        return redirect()->route('admin.pembina.index')->with('success', 'Data pembina berhasil diupdate!');
    }

    /**
     * Menghapus data pembina dari database.
     */
    public function destroy(Pembina $pembina)
    {
        if ($pembina->foto) {
            Storage::disk('public')->delete('pembina-foto/' . $pembina->foto);
        }
        $pembina->delete();
        return redirect()->route('admin.pembina.index')->with('success', 'Data pembina berhasil dihapus!');
    }
}