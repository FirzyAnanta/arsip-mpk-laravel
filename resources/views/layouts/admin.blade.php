<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} | Admin Arsip MPK</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    
    <script src="https://unpkg.com/feather-icons"></script>
    
    {{-- Kita akan buat file CSS terpisah untuk admin --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
    @stack('styles')
</head>
<body>

<div class="admin-layout">
    <!-- Sidebar Start -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="/admin/dashboard" class="sidebar-logo">
                <span>ADMIN</span> PANEL
            </a>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="/admin/dashboard" class="menu-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                    <i data-feather="grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="menu-item">
                    <i data-feather="settings"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
            <ul class="sidebar-menu">
    <li>
        <a href="{{ route('admin.dashboard') }}" class="menu-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <i data-feather="users"></i> {{-- Ganti ikonnya jadi users --}}
            <span>Anggota</span>
        </a>
    </li>
    <li>
    <a href="{{ route('admin.pembina.index') }}" class="menu-item {{ Request::is('admin/pembina*') ? 'active' : '' }}">
        <i data-feather="user-check"></i>
        <span>Pembina</span>
    </a>
</li>
    {{-- MENU BARU --}}
    <li>
        <a href="{{ route('admin.kegiatan.index') }}" class="menu-item {{ Request::is('admin/kegiatan*') ? 'active' : '' }}">
            <i data-feather="camera"></i>
            <span>Kegiatan</span>
        </a>
    </li>
    <li>
    <a href="{{ route('admin.sejarah.edit') }}" class="menu-item {{ Request::is('admin/sejarah*') ? 'active' : '' }}">
        <i data-feather="book-open"></i>
        <span>Halaman Sejarah</span>
    </a>
</li>
<li>
    <a href="{{ route('admin.filosofi.edit') }}" class="menu-item {{ Request::is('admin/filosofi*') ? 'active' : '' }}">
        <i data-feather="shield"></i>
        <span>Filosofi Logo</span>
    </a>
</li>
<li>
    <a href="{{ route('admin.struktur.edit') }}" class="menu-item {{ Request::is('admin/struktur*') ? 'active' : '' }}">
        <i data-feather="sitemap"></i>
        <span>Struktur Sekolah</span>
    </a>
</li>
    <li>...</li> {{-- Menu Pengaturan --}}
</ul>
        </ul>
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i data-feather="log-out"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>
    <!-- Sidebar End -->

    <!-- Main Content Start -->
    <main class="main-content">
        <header class="main-header">
            <h3>Selamat Datang, {{ auth()->user()->name }}</h3>
        </header>

        <div class="content-wrapper">
            @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
            @yield('container')
        </div>
    </main>
    <!-- Main Content End -->
</div>

<script>
    feather.replace();
</script>

@stack('scripts')
</body>
</html>