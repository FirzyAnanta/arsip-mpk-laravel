<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Judul halaman akan dinamis, dengan judul default jika tidak diisi --}}
    <title>{{ $title ?? 'Arsip Digital MPK' }} | SMK Telkom Lampung</title>
    
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    
    <!-- My CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Slot untuk CSS tambahan jika ada halaman yang butuh styling khusus --}}
    @stack('styles')
</head>
<body>

{{-- Memanggil Navbar dari file partial --}}
@include('layouts.partials.navbar')

<div class="main-content">
    {{-- Ini adalah slot konten utama yang akan diisi oleh setiap halaman --}}
    @yield('container')
</div>

{{-- Memanggil Footer dari file partial --}}
@include('layouts.partials.footer')

{{-- Slot untuk JavaScript tambahan dari halaman anak (seperti halaman generasi) --}}
@stack('scripts')

{{-- SCRIPT UTAMA UNTUK SEMUA HALAMAN --}}
<script>
    // Inisialisasi Feather Icons
    feather.replace();

    // Script untuk menangani semua dropdown (Navbar & Filter)
    document.addEventListener('DOMContentLoaded', function () {
        const dropdowns = document.querySelectorAll('.dropdown, .nav-dropdown');

        dropdowns.forEach(dropdown => {
            const toggle = dropdown.querySelector('.dropdown-toggle, .nav-dropdown-toggle');

            if (toggle) {
                toggle.addEventListener('click', function (event) {
                    // Mencegah link <a> berpindah halaman saat diklik
                    event.preventDefault(); 
                    
                    // Tutup dropdown lain yang mungkin sedang terbuka
                    dropdowns.forEach(otherDropdown => {
                        if (otherDropdown !== dropdown) {
                            otherDropdown.classList.remove('open');
                        }
                    });

                    // Buka atau tutup dropdown yang diklik
                    dropdown.classList.toggle('open');
                });
            }
        });

        // Menutup semua dropdown jika user mengklik di luar area dropdown
        window.addEventListener('click', function(e) {
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(e.target)) {
                    dropdown.classList.remove('open');
                }
            });
        });

        // Script untuk hamburger menu di mobile
        const navbarNav = document.querySelector('.navbar-nav');
        const menuToggle = document.querySelector('#menu');

        if(menuToggle) {
            menuToggle.onclick = (e) => {
                navbarNav.classList.toggle('active');
                e.preventDefault();
            };
        }
    });
</script>

</body>
</html>