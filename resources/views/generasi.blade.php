@extends('layouts.main')

@section('container')

    <div class="page-container">

        {{-- Section untuk Sejarah Pembina --}}
        @if(isset($pembina) && $pembina->count())
            <section class="pembina-section" data-aos="fade-up">
                <h2 class="section-title">Sejarah Pembina MPK</h2>
                <div class="pembina-list">
                    @foreach ($pembina as $item)
                        <div class="pembina-item pembina-trigger"
                             data-nama="{{ $item->nama }}"
                             data-periode="{{ $item->periode }}"
                             data-foto="{{ $item->foto ? asset('storage/pembina-foto/' . $item->foto) : asset('img/placeholder.png') }}"
                             data-instagram="{{ $item->instagram }}">
                            <img src="{{ $item->foto ? asset('storage/pembina-foto/' . $item->foto) : asset('img/placeholder.png') }}" alt="{{ $item->nama }}">
                            <div class="pembina-info">
                                <p class="pembina-nama">{{ $item->nama }}</p>
                                <p class="pembina-periode">{{ $item->periode }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <h1 class="page-title">{{ $title }} <span>MPK</span></h1>
        
        <p class="page-description">
            Pilih periode kepengurusan untuk melihat arsip anggota Majelis Perwakilan Kelas (MPK) SMK Telkom Lampung.
        </p>

        {{-- Filter Dropdown --}}
        <div class="filter-dropdown-container">
            <div class="dropdown">
                <button class="dropdown-toggle" type="button">
                    {{ $periode_aktif ? str_replace('-', '/', $periode_aktif) : 'Pilih Periode' }}
                    <i data-feather="chevron-down"></i>
                </button>
                <div class="dropdown-menu">
                    @foreach ($semua_periode as $p)
                        <a class="dropdown-item" href="/generasi/{{ str_replace('/', '-', $p->periode) }}">{{ $p->periode }}</a>
                    @endforeach
                    <hr class="dropdown-divider">
                    <a class="dropdown-item" href="/generasi">Tampilkan Semua</a>
                </div>
            </div>
        </div>

        {{-- Menampilkan periode yang sedang aktif, jika ada --}}
        @if(isset($periode_aktif))
            <h2 class="periode-title">Periode: {{ str_replace('-', '/', $periode_aktif) }}</h2>
        @endif

        <div class="anggota-grid">
            @foreach ($anggota as $item)
                <div class="anggota-card profile-trigger" 
                    data-nama="{{ $item->nama }}"
                    data-jabatan="{{ $item->jabatan }}"
                    data-divisi="{{ $item->divisi }}"
                    data-periode="{{ $item->periode }}"
                    data-foto="{{ $item->foto ? asset('storage/anggota-foto/' . $item->foto) : asset('img/placeholder.png') }}"
                    data-instagram="{{ $item->instagram }}">
                    
                    <img src="{{ $item->foto ? asset('storage/anggota-foto/' . $item->foto) : asset('img/placeholder.png') }}" alt="{{ $item->nama }}" class="anggota-img">
                    <h3 class="anggota-nama">{{ $item->nama }}</h3>
                    <p class="anggota-jabatan">{{ $item->jabatan }}</p>
                    <p class="anggota-divisi">{{ $item->divisi }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- HTML untuk Modal Profil Anggota --}}
    <div class="profile-modal" id="profileModal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <img src="" alt="Foto Anggota" id="modal-img">
            <h2 id="modal-nama"></h2>
            <p id="modal-jabatan"></p>
            <p id="modal-divisi"></p>
            <p id="modal-periode"></p>
            <div id="modal-instagram-link"></div>
        </div>
    </div>

    {{-- HTML untuk Modal Pembina --}}
    <div class="profile-modal" id="pembinaModal">
        <div class="modal-content">
            <span class="close-button-pembina">&times;</span>
            <img src="" alt="Foto Pembina" id="modal-pembina-img">
            <h2 id="modal-pembina-nama"></h2>
            <p id="modal-pembina-periode"></p>
            <div id="modal-pembina-instagram-link"></div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        // Script untuk Modal Profil Anggota
        const profileTriggers = document.querySelectorAll('.profile-trigger');
        const modal = document.getElementById('profileModal');
        const closeModal = document.querySelector('.close-button');

        if (modal) {
            profileTriggers.forEach(trigger => {
                trigger.addEventListener('click', function() {
                    document.getElementById('modal-img').src = this.dataset.foto;
                    document.getElementById('modal-nama').textContent = this.dataset.nama;
                    document.getElementById('modal-jabatan').textContent = this.dataset.jabatan;
                    document.getElementById('modal-divisi').textContent = this.dataset.divisi;
                    document.getElementById('modal-periode').textContent = `Angkatan ${this.dataset.periode}`;
                    
                    const igLinkContainer = document.getElementById('modal-instagram-link');
                    if (this.dataset.instagram) {
                        igLinkContainer.innerHTML = `<a href="https://instagram.com/${this.dataset.instagram}" target="_blank" rel="noopener noreferrer"><i data-feather="instagram"></i> ${this.dataset.instagram}</a>`;
                        feather.replace();
                    } else {
                        igLinkContainer.innerHTML = '';
                    }
                    modal.classList.add('active');
                });
            });

            const closeTheModal = () => modal.classList.remove('active');
            if(closeModal) closeModal.addEventListener('click', closeTheModal);
            modal.addEventListener('click', e => { if (e.target === modal) closeTheModal(); });
            document.addEventListener('keydown', e => { if (e.key === "Escape") closeTheModal(); });
        }

        // Script untuk Modal Pembina
        const pembinaTriggers = document.querySelectorAll('.pembina-trigger');
        const pembinaModal = document.getElementById('pembinaModal');
        const closePembinaModal = document.querySelector('.close-button-pembina');

        if (pembinaModal) {
            pembinaTriggers.forEach(trigger => {
                trigger.addEventListener('click', function() {
                    document.getElementById('modal-pembina-img').src = this.dataset.foto;
                    document.getElementById('modal-pembina-nama').textContent = this.dataset.nama;
                    document.getElementById('modal-pembina-periode').textContent = `Periode Jabatan ${this.dataset.periode}`;
                    
                    const igLinkContainer = document.getElementById('modal-pembina-instagram-link');
                    if (this.dataset.instagram) {
                        igLinkContainer.innerHTML = `<a href="https://instagram.com/${this.dataset.instagram}" target="_blank" rel="noopener noreferrer"><i data-feather="instagram"></i> ${this.dataset.instagram}</a>`;
                        feather.replace();
                    } else {
                        igLinkContainer.innerHTML = '';
                    }
                    pembinaModal.classList.add('active');
                });
            });

            const closeThePembinaModal = () => pembinaModal.classList.remove('active');
            if(closePembinaModal) closePembinaModal.addEventListener('click', closeThePembinaModal);
            pembinaModal.addEventListener('click', e => { if (e.target === pembinaModal) closeThePembinaModal(); });
            document.addEventListener('keydown', e => { if (e.key === "Escape") closeThePembinaModal(); });
        }
    </script>
@endpush