@extends('layouts.main')

@section('container')
    <div class="page-container" data-aos="fade-up">
        <h1 class="page-title">Struktur <span>Sekolah</span></h1>

        {{-- [PERUBAHAN] Gambar ditampilkan di atas --}}
        <div class="struktur-image-container">
            @if($image && $image->value)
                <img src="{{ asset('storage/halaman/' . $image->value) }}" alt="Struktur Sekolah" class="struktur-img">
            @else
                {{-- Tampilkan placeholder jika gambar belum di-upload --}}
                <img src="{{ asset('img/placeholder-struktur.jpg') }}" alt="Struktur Sekolah" class="struktur-img">
            @endif
        </div>

        {{-- [PERUBAHAN] Teks penjelasan ditampilkan di bawah --}}
        <div class="struktur-body">
            @if($content && $content->value)
                {!! $content->value !!}
            @else
                <p class="page-description">Konten penjelasan struktur sekolah belum tersedia. Silakan isi melalui panel admin.</p>
            @endif
        </div>

    </div>
@endsection