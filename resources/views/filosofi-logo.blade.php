@extends('layouts.main')

@section('container')
    <div class="page-container" data-aos="fade-up">
        <h1 class="page-title">Filosofi <span>Logo</span></h1>
        
        {{-- Tampilkan gambar logo di tengah --}}
        @if($image && $image->value)
            <img src="{{ asset('storage/halaman/' . $image->value) }}" alt="Filosofi Logo" class="detail-img" style="max-width: 300px; margin: 0 auto 2.5rem; display: block;">
        @endif

        {{-- Tampilkan konten penjelasan --}}
        <div class="detail-body" style="max-width: 800px; margin: auto; text-align: left;">
            @if($content && $content->value)
                {!! $content->value !!}
            @else
                {{-- Teks ini akan muncul jika konten di admin masih kosong --}}
                <p class="page-description">Konten filosofi logo belum tersedia. Silakan isi melalui panel admin.</p>
            @endif
        </div>
    </div>
@endsection