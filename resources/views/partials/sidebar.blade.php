<aside class="sidebar" id="sidebar">
    <!-- BRAND -->
    <div class="sidebar-brand">
        <div class="d-flex align-items-center gap-3">
            <div class="brand-icon"><i class="bi bi-building"></i></div>
            <div>
                <div class="fw-bold">SIPEMBANGUNAN</div>
                <small class="opacity-75"> Laporan Sekolah </small>
            </div>
        </div>
    </div>
    <!-- MENU -->
    <div class="sidebar-menu">
        <small class="text-uppercase opacity-50 px-3"> menu aplikasi </small>
        <nav class="nav flex-column mt-3">
            <ul class="nav flex-column sidebar-menu" id="sidebarAccordion">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a
                        href="/dashboard"
                        class="nav-link {{ request()->is('dashboard') ? 'active' : ''}}"
                    >
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Kegiatan -->
                <li class="nav-item">
                    <a
                        href="/kegiatan"
                        class="nav-link {{ request()->is('kegiatan*') ? 'active' : ''}}"
                    >
                        <i class="bi bi-chat-square-quote"></i>
                        <span>Kegiatan</span>
                    </a>
                </li>

                <!-- DATA MASTER -->
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->is(['satuan*', 'toko*', 'honor*']) ? 'active' : '' }}"
                        data-bs-toggle="collapse"
                        href="#menuMasterData"
                        role="button"
                        aria-expanded="false"
                        aria-controls="menuMasterData"
                    >
                        <i class="bi bi-list-check"></i>
                        <span>Data Master</span>

                        <i class="bi bi-chevron-down menu-arrow"></i>
                    </a>

                    <div
                        class="collapse"
                        id="menuMasterData"
                        data-bs-parent="#sidebarAccordion"
                    >
                        <div class="submenu">
                            <a
                                href="/satuan"
                                class="nav-link {{ request()->is('satuan*') ? 'active' : '' }}"
                            >
                                <span class="submenu-dot"></span>
                                Satuan
                            </a>

                            <a
                                href="/toko"
                                class="nav-link {{ request()->is('toko*') ? 'active' : '' }}"
                            >
                                <span class="submenu-dot"></span>
                                Toko
                            </a>

                            <a
                                href="/honor"
                                class="nav-link {{ request()->is('honor*') ? 'active' : '' }}"
                            >
                                <span class="submenu-dot"></span>
                                Honor
                            </a>
                        </div>
                    </div>
                </li>

                <!-- Data Pelaksana -->
                <li class="nav-item">
                    <a
                        href="/data_pelaksana"
                        class="nav-link {{ request()->is('data_pelaksana*') ? 'active' : ''}}"
                    >
                        <i class="bi bi-people"></i>
                        <span>Data Pelaksana</span>
                    </a>
                </li>

                <!-- Laporan -->
                <li class="nav-item">
                    <a
                        href="/input_laporan"
                        class="nav-link {{ request()->is('input_laporan*') ? 'active' : ''}}"
                    >
                        <i class="bi bi-graph-up-arrow"></i>
                        <span>Input Laporan</span>
                    </a>
                </li>

                <!-- Cetak Laporan -->
                <li class="nav-item">
                    <a
                        href="/cetak_laporan"
                        class="nav-link {{ request()->is('cetak_laporan*') ? 'active' : ''}}"
                    >
                        <i class="bi bi-printer"></i>
                        <span>Cetak Laporan</span>
                    </a>
                </li>

                <!-- Manajemen User -->
                {{-- <li class="nav-item">
                    <a
                        href="/manajemen_user"
                        class="nav-link {{ request()->is('manajemen_user*') ? 'active' : ''}}"
                    >
                        <i class="bi bi-person"></i>
                        <span>Manajemen User</span>
                    </a>
                </li> --}}
            </ul>
        </nav>
    </div>
</aside>
