@extends('layouts.main')

@section('container')

    <!-- Hero Section Start -->
    <section class="hero" id="home">
        
        {{-- [PERUBAHAN] Menambahkan elemen video --}}
        <video autoplay muted loop playsinline class="hero-background-video">
            <source src="{{ asset('videos/background-video.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung tag video.
        </video>

        <main class="content">
            <h1>Majelis Perwakilan Kelas<br>SMK Telkom Lampung</h1>
            <p>Mewujudkan Aspirasi, Mengawal Prestasi. Menjadi jembatan antara siswa dan sekolah dengan integritas dan dedikasi.</p>
            
            {{-- [PERUBAHAN] Mengarahkan link tombol ke halaman kegiatan --}}
            <a href="/kegiatan" class="cta">Lihat Kegiatan Kami</a>
        </main>
    </section>
    <!-- Hero Section End -->

    {{-- Section lain bisa ditambahkan di sini jika perlu --}}

@endsection