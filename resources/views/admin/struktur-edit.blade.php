@extends('layouts.admin') {{-- <-- INI PERBAIKANNYA --}}

@section('container')
    <div class="content-header">
        <h1>Edit Halaman Struktur Sekolah</h1>
        {{-- Tombol kembali opsional tapi bagus untuk UX --}}
        <a href="{{ url()->previous() }}" class="btn">
            <i data-feather="arrow-left"></i> Kembali
        </a>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-container">
        <form action="{{ route('admin.struktur.update') }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="value">Penjelasan Struktur Sekolah</label>
                <textarea name="value" id="value" class="form-control @error('value') is-invalid @enderror" rows="15" required>{{ old('value', $content->value) }}</textarea>
                @error('value')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Gambar Bagan Struktur</label>
                @if ($image->value)
                    <img src="{{ asset('storage/halaman/' . $image->value) }}" class="img-preview" alt="Gambar Lama">
                @endif
                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Konten</button>
        </form>
    </div>
@endsection