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
                    <a href="#" class="nav-link {{ request()->is('admin/domain*') ? 'active' : 'collapsed' }}" data-bs-target="#domain-spbe-nav" data-bs-toggle="collapse" style="cursor: pointer;">
                        <i class="bi bi-circle"></i><span>Domain SPBE</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="domain-spbe-nav" class="nav-content collapse {{ request()->is('admin/domain*') ? 'show' : '' }}" style="padding-left: 20px; border-left: 3px solid #007bff;">
                        <li>
                            <a href="{{ url('/admin/domain/kebijakan') }}" class="{{ request()->is('admin/domain/kebijakan') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Kebijakan SPBE</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/domain/tatakelola') }}" class="{{ request()->is('admin/domain/tatakelola') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Tata Kelola SPBE</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/domain/manajemen') }}" class="{{ request()->is('admin/domain/manajemen') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Manajemen SPBE</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/domain/layanan') }}" class="{{ request()->is('admin/domain/layanan') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Layanan SPBE</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="{{ url('/admin/artikel-klien') }}" class="{{ request()->is('admin/artikel-klien') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Artikel SPBE</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link {{ request()->is('admin/tentang-klien*') ? 'active' : 'collapsed' }}" data-bs-target="#tentang-spbe-nav" data-bs-toggle="collapse" style="cursor: pointer;">
                        <i class="bi bi-circle"></i><span>Tentang SPBE</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="tentang-spbe-nav" class="nav-content collapse {{ request()->is('admin/tentang-klien*') ? 'show' : '' }}" style="padding-left: 20px; border-left: 3px solid #007bff;">
                        <li>
                            <a href="{{ url('/admin/material') }}" class="{{ request()->is('admin/material') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Material</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/regulasi') }}" class="{{ request()->is('admin/regulasi') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Regulasi</span>
                            </a>
                        </li>
                    </ul>
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
