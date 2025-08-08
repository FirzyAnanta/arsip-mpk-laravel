@extends('layouts.admin')

@section('container')
    <div class="content-header">
        <h1>Edit Halaman Sejarah</h1>
    </div>

    {{-- Tampilkan pesan sukses jika ada --}}
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-container">
        <form action="{{ route('admin.sejarah.update') }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="value">Konten Halaman Sejarah</label>
                <textarea name="value" id="value" class="form-control @error('value') is-invalid @enderror" rows="15" required>{{ old('value', $sejarah->value) }}</textarea>
                @error('value')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- [BARU] Input untuk Upload Gambar --}}
            <div class="form-group">
                <label for="image">Gambar Halaman Sejarah</label>
                {{-- Tampilkan gambar lama jika ada --}}
                @if ($sejarah->image)
                    <img src="{{ asset('storage/halaman/' . $sejarah->image) }}" class="img-preview" alt="Gambar Lama">
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