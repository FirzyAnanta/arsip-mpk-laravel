@extends('layouts.admin')

@section('container')
    <div class="content-header">
        {{-- GANTI JUDUL --}}
        <h1>Tambah Kegiatan Baru</h1>
        {{-- GANTI ROUTE KEMBALI --}}
        <a href="{{ route('admin.kegiatan.index') }}" class="btn">
            <i data-feather="arrow-left"></i> Kembali
        </a>
    </div>

    <div class="form-container">
        {{-- GANTI ACTION FORM --}}
        <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                {{-- GANTI FIELD JUDUL --}}
                <label for="judul">Judul Kegiatan</label>
                <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                {{-- GANTI FIELD TANGGAL --}}
                <label for="tanggal">Tanggal Pelaksanaan</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                {{-- GANTI FIELD DESKRIPSI (gunakan textarea) --}}
                <label for="deskripsi">Deskripsi Kegiatan</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                {{-- GANTI FIELD FOTO --}}
                <label for="foto">Upload Foto Utama</label>
                <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Kegiatan</button>
        </form>
    </div>
@endsection