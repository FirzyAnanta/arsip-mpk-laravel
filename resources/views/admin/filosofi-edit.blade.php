@extends('layouts.admin')

@section('container')
    <div class="content-header">
        {{-- 1. UBAH JUDUL HALAMAN --}}
        <h1>Edit Halaman Filosofi Logo</h1>
    </div>

    {{-- Tampilkan pesan sukses jika ada --}}
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-container">
        {{-- 2. UBAH ACTION FORM --}}
        <form action="{{ route('admin.filosofi.update') }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-group">
                {{-- 3. UBAH LABEL TEKS --}}
                <label for="value">Konten Filosofi Logo</label>
                {{-- Gunakan variabel $content yang kita kirim dari controller --}}
                <textarea name="value" id="value" class="form-control @error('value') is-invalid @enderror" rows="15" required>{{ old('value', $content->value) }}</textarea>
                @error('value')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                {{-- 4. UBAH LABEL GAMBAR --}}
                <label for="image">Gambar Logo</label>
                {{-- Gunakan variabel $image yang kita kirim dari controller --}}
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