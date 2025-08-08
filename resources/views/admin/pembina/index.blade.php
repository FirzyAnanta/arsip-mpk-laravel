@extends('layouts.admin')

@section('container')
    
<div class="content-header">
    <h1>Manajemen Pembina</h1>
    <a href="{{ route('admin.pembina.create') }}" class="btn btn-primary">
        <i data-feather="plus-circle"></i> Tambah Pembina
    </a>
</div>

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
                <th>Foto</th>
                <th>Nama Pembina</th>
                <th>Periode Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($pembina as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><img src="{{ asset('storage/pembina-foto/' . $item->foto) }}" alt="{{ $item->nama }}" width="80"></td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->periode }}</td>
                <td class="action-buttons">
                    <div class="action-group">
                        <a href="{{ route('admin.pembina.edit', $item->id) }}" class="btn-action btn-edit">
                            <i data-feather="edit"></i>
                        </a>
                        <form action="{{ route('admin.pembina.destroy', $item->id) }}" method="POST">
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