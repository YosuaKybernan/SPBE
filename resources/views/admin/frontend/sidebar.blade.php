<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/dashboard') ? '' : 'collapsed' }}" href="{{ url('/admin/dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/tugas-penilaian-mandiri') ? '' : 'collapsed' }}" href="{{ url('/admin/tugas-penilaian-mandiri') }}">
                <i class="bi bi-card-list"></i>
                <span>Tugas Penilaian Mandiri</span>
            </a>
        </li><!-- End Register Page Nav -->
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/beranda-klien') || request()->is('admin/domain-klien') || request()->is('admin/artikel-klien') || request()->is('admin/tentang-klien') ? '' : 'collapsed' }}" data-bs-target="#tables-nav" data-bs-toggle="collapse" style="cursor: pointer;">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Konten Klien</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse {{ request()->is('admin/beranda-klien') || request()->is('admin/domain-klien') || request()->is('admin/artikel-klien') || request()->is('admin/tentang-klien') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('/admin/beranda-klien') }}" class="{{ request()->is('admin/beranda-klien') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Beranda</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/domain-klien') }}" class="{{ request()->is('admin/domain-klien') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Domain SPBE</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/artikel-klien') }}" class="{{ request()->is('admin/artikel-klien') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Artikel SPBE</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/tentang-klien') }}" class="{{ request()->is('admin/tentang-klien') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Tentang SPBE</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/aplikasi') ? '' : 'collapsed' }}" href="{{ url('/admin/aplikasi') }}">
                <i class="bi bi-card-list"></i>
                <span>Aplikasi</span>
            </a>
        </li><!-- End Register Page Nav -->
    </ul>
</aside><!-- End Sidebar-->
