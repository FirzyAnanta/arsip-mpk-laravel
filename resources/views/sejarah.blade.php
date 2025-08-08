@extends('layouts.main')

@section('container')

    <div class="page-container" data-aos="fade-up">
        <h1 class="page-title">Sejarah <span>MPK</span></h1>
        
        {{-- [PERBAIKAN] Menggunakan struktur yang sama dengan halaman detail --}}
        <div class="detail-content-wrapper">
            
            {{-- KOLOM KIRI: GAMBAR --}}
            <div class="about-img">
                @if($sejarah && $sejarah->image)
                    <img src="{{ asset('storage/halaman/' . $sejarah->image) }}" alt="Sejarah MPK" class="detail-img">
                @else
                    {{-- Gambar default jika belum ada yang di-upload --}}
                    <img src="{{ asset('img/placeholder-sejarah.jpg') }}" alt="Sejarah MPK" class="detail-img">
                @endif
            </div>
            
            {{-- KOLOM KANAN: KONTEN TEKS --}}
            <div class="detail-body">
                @if($sejarah)
                    {!! $sejarah->value !!}
                @else
                    <p>Konten sejarah belum tersedia.</p>
                @endif
            </div>
        </div>
    </div>

@endsection