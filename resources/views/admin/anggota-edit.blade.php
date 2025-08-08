@extends('layouts.admin')

@section('container')
    <div class="content-header">
        <h1>Edit Data Anggota</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn">
            <i data-feather="arrow-left"></i> Kembali
        </a>
    </div>

    <div class="form-container">
        {{-- Form action mengarah ke rute update, dengan ID anggota --}}
        <form action="{{ route('admin.anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
            @method('put') {{-- Method spoofing untuk UPDATE --}}
            @csrf
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                {{-- 'value' diisi dengan data lama --}}
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $anggota->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $anggota->jabatan) }}" required>
                @error('jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="periode">Periode</label>
                <input type="text" name="periode" id="periode" class="form-control @error('periode') is-invalid @enderror" placeholder="Contoh: 2024/2025" value="{{ old('periode', $anggota->periode) }}" required>
                @error('periode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="divisi">Divisi / Komisi</label>
                <input type="text" name="divisi" id="divisi" class="form-control @error('divisi') is-invalid @enderror" value="{{ old('divisi', $anggota->divisi) }}">
                @error('divisi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
    <label for="instagram">Username Instagram (tanpa @)</label>
    <input type="text" name="instagram" id="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram', $anggota->instagram) }}">
    @error('instagram')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

            <div class="form-group">
                <label for="foto">Upload Foto Baru (Opsional)</label>
                {{-- Tampilkan foto lama jika ada --}}
                @if ($anggota->foto)
                    <img src="{{ asset('storage/anggota-foto/' . $anggota->foto) }}" class="img-preview" alt="Foto Lama">
                @endif
                <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Update Data</button>
        </form>
    </div>
@endsection