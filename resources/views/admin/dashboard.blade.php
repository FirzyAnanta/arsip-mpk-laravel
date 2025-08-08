@extends('layouts.admin')

@section('container')
    
<div class="content-header">
    <h1>Manajemen Anggota</h1>
    <a href="{{ route('admin.anggota.create') }}" class="btn btn-primary">
        <i data-feather="plus-circle"></i> Tambah Anggota
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
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Periode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggota as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jabatan }}</td>
                <td>{{ $item->periode }}</td>
                <td class="action-buttons">
                    {{-- [PERBAIKAN] Bungkus semua tombol aksi di dalam div --}}
                    <div class="action-group">
                        <a href="{{ route('admin.anggota.edit', $item->id) }}" class="btn-action btn-edit">
                            <i data-feather="edit"></i>
                        </a>
                        
                        <form action="{{ route('admin.anggota.destroy', $item->id) }}" method="POST">
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