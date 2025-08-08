@extends('layouts.main')

@section('container')

    <div class="page-container">
        <article class="kegiatan-detail" data-aos="fade-up">

            {{-- Bagian Judul dan Tombol Kembali --}}
            <a href="/kegiatan" class="back-link">&laquo; Kembali ke Daftar Kegiatan</a>
            <h1 class="detail-title">{{ $kegiatan->judul }}</h1>
            <p class="detail-date">Dipublikasikan pada {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d F Y') }}</p>

            {{-- [PERUBAHAN] Bungkus gambar dan deskripsi dalam satu div --}}
            <div class="detail-content-wrapper">

                {{-- KOLOM KIRI: GAMBAR --}}
                @if($kegiatan->foto)
                    <img src="{{ asset('storage/kegiatan-foto/' . $kegiatan->foto) }}" alt="{{ $kegiatan->judul }}" class="detail-img">
                @endif

                {{-- KOLOM KANAN: DESKRIPSI --}}
                <div class="detail-body">
                    {!! $kegiatan->deskripsi !!}
                </div>

            </div>

        </article>
    </div>

@endsection