@extends('layouts.admin')

@section('container')
    <div class="content-header">
        <h1>Tambah Data Pembina Baru</h1>
        <a href="{{ route('admin.pembina.index') }}" class="btn"><i data-feather="arrow-left"></i> Kembali</a>
    </div>

    <div class="form-container">
        <form action="{{ route('admin.pembina.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Lengkap Pembina</label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="periode">Periode Jabatan</label>
                <input type="text" name="periode" id="periode" class="form-control @error('periode') is-invalid @enderror" placeholder="Contoh: 2024/2025" value="{{ old('periode') }}" required>
                @error('periode') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="instagram">Username Instagram (tanpa @)</label>
                <input type="text" name="instagram" id="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram') }}">
                @error('instagram') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="foto">Upload Foto</label>
                <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" required>
                @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan Data Pembina</button>
        </form>
    </div>
@endsection