@extends('layouts.admin')

@section('container')
    
<div class="content-header">
    <h1>Manajemen Kegiatan</h1>
    {{-- Perbaikan 1: Ubah teks tombol --}}
    <a href="{{ route('admin.kegiatan.create') }}" class="btn btn-primary">
        <i data-feather="plus-circle"></i> Tambah Kegiatan
    </a>
</div>

{{-- Tampilkan pesan sukses jika ada --}}
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="data-table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Tanggal</th>
                {{-- Perbaikan 2: Hapus header kolom Periode --}}
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($kegiatan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                {{-- Perbaikan 3: Hapus kolom data Periode --}}
                <td class="action-buttons">
                    <div class="action-group">
                        <a href="{{ route('admin.kegiatan.edit', $item->id) }}" class="btn-action btn-edit">
                            <i data-feather="edit"></i>
                        </a>
                        
                        {{-- Perbaikan 4: Ubah action form ke route destroy kegiatan --}}
                        <form action="{{ route('admin.kegiatan.destroy', $item->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i data-feather="trash-2"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection