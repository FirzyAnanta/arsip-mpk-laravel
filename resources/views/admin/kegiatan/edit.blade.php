@extends('layouts.admin')

@section('container')
    <div class="content-header">
        <h1>Edit Data Kegiatan</h1>
        <a href="{{ route('admin.kegiatan.index') }}" class="btn">
            <i data-feather="arrow-left"></i> Kembali
        </a>
    </div>

    <div class="form-container">
        {{-- Mengarah ke rute update, dengan ID kegiatan --}}
        <form action="{{ route('admin.kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
            @method('put') {{-- Method spoofing untuk UPDATE --}}
            @csrf
            <div class="form-group">
                <label for="judul">Judul Kegiatan</label>
                <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $kegiatan->judul) }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal Pelaksanaan</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $kegiatan->tanggal) }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Kegiatan</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="foto">Upload Foto Baru (Opsional)</label>
                @if ($kegiatan->foto)
                    <img src="{{ asset('storage/kegiatan-foto/' . $kegiatan->foto) }}" class="img-preview" alt="Foto Lama">
                @endif
                <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Update Data Kegiatan</button>
        </form>
    </div>
@endsection