<!-- Navbar Start -->
<nav class="navbar">
    <a href="/" class="navbar-logo">
        <img src="{{ asset('img/mpk.png') }}" alt="Logo MPK">
        <div class="logo-text">
            <span class="line-1">MPK SMK</span>
            <span class="line-2">Telkom Lampung</span>
        </div>
    </a>
   <div class="navbar-nav">
    <a href="/">Beranda</a>

    {{-- [BARU] Dropdown untuk Profil --}}
    <div class="nav-dropdown">
        <a href="#" class="nav-dropdown-toggle">Profil <i data-feather="chevron-down" style="width:16px; height:16px;"></i></a>
        <div class="nav-dropdown-content">
            <a href="/sejarah">Sejarah MPK</a>
            <a href="/filosofi-logo">Filosofi Logo</a>
            <a href="/struktur-sekolah">Struktur Sekolah</a>
        </div>
    </div>
    
    <a href="/generasi">Struktur & Generasi</a>
    <a href="/kegiatan">Kegiatan</a>
</div>
    <div class="navbar-extra">
        <a href="#" id="menu"><i data-feather="menu"></i></a>
    </div>
</nav>
<!-- Navbar End -->