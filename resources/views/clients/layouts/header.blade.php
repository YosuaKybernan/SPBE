<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <a href="{{ url('/') }}" class="logo me-auto"><img src="{{ asset('clients/assets/img/logo.png') }}" alt="" class="img-fluid"></a>
        {{-- <h1 class="logo me-auto">
            <a href="{{ url('/') }}">SPBE</a>
            <a href="{{ url('/') }}">Dinas Komunikasi dan Informatika</a>
            <a href="{{ url('/') }}">Pemerintah Kota Batu</a>
        </h1> --}}
        
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="dropdown">
                    <a href="#"
                        class="nav-link {{ Request::is('kebijakan-spbe', 'tata-kelola-spbe', 'manajemen-spbe', 'layanan-spbe') ? 'active' : '' }}">
                        <span>Domain SPBE</span> <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul>
                        <li><a class="nav-link {{ Request::is('kebijakan-spbe') ? 'active' : '' }}"
                                href="{{ url('/kebijakan-spbe') }}">Kebijakan SPBE</a></li>
                        <li><a class="nav-link {{ Request::is('tata-kelola-spbe') ? 'active' : '' }}"
                                href="{{ url('/tata-kelola-spbe') }}">Tata Kelola SPBE</a></li>
                        <li><a class="nav-link {{ Request::is('manajemen-spbe') ? 'active' : '' }}"
                                href="{{ url('/manajemen-spbe') }}">Manajemen SPBE</a></li>
                        <li><a class="nav-link {{ Request::is('layanan-spbe') ? 'active' : '' }}"
                                href="{{ url('/layanan-spbe') }}">Layanan SPBE</a></li>
                    </ul>
                </li>
                <li><a class="nav-link {{ Request::is('artikel-spbe') ? 'active' : '' }}"
                        href="{{ url('/artikel-spbe') }}">Artikel SPBE</a></li>
                <li class="dropdown">
                    <a href="#"
                        class="nav-link {{ Request::is('materi-spbe', 'visi-misi', 'tujuan-sasaran', 'regulasi-spbe', 'faq') ? 'active' : '' }}">
                        <span>Tentang SPBE</span> <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul>
                        <li><a class="nav-link {{ Request::is('materi-spbe') ? 'active' : '' }}"
                                href="{{ url('/materi-spbe') }}">Materi SPBE</a></li>
                        <li><a class="nav-link {{ Request::is('visi-misi') ? 'active' : '' }}"
                                href="{{ url('/visi-misi') }}">Visi dan Misi</a></li>
                        <li><a class="nav-link {{ Request::is('tujuan-sasaran') ? 'active' : '' }}"
                                href="{{ url('/tujuan-sasaran') }}">Tujuan dan Sasaran</a></li>
                        <li><a class="nav-link {{ Request::is('regulasi-spbe') ? 'active' : '' }}"
                                href="{{ url('/regulasi-spbe') }}">Regulasi</a></li>
                    </ul>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
