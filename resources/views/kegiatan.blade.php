{{-- PASTIKAN BARIS INI ADA DI PALING ATAS --}}
@extends('layouts.main')

{{-- PASTIKAN KONTEN DIBUNGKUS OLEH SECTION INI --}}
@section('container')

    <div class="page-container">
        <h1 class="page-title">{{ $title }} <span>MPK</span></h1>
        
        <p class="page-description">
            Dokumentasi berbagai program kerja dan acara yang telah diselenggarakan oleh Majelis Perwakilan Kelas (MPK) SMK Telkom Lampung.
        </p>

        <div class="kegiatan-grid">
            
            {{-- Cek jika ada data kegiatan --}}
            @if($kegiatan->count())
                @foreach ($kegiatan as $item)
                    {{-- Nanti link ini akan mengarah ke halaman detail --}}
                   <a href="/kegiatan/{{ $item->id }}" class="kegiatan-card" data-aos="fade-up">
                        <img src="{{ asset('storage/kegiatan-foto/' . $item->foto) }}" alt="{{ $item->judul }}">
                        <div class="kegiatan-title">
                            <h3>{{ $item->judul }}</h3>
                            <p>{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</p>
                        </div>
                    </a>
                @endforeach
            @else
                {{-- Tampil jika tidak ada data sama sekali --}}
                <p class="page-description" style="grid-column: 1 / -1;">Belum ada kegiatan yang dipublikasikan.</p>
            @endif

        </div>
    </div>

@endsection