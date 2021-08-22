<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->


    @if (auth()->user()->role == 'pimpinan')
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard.index') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/logo.png') }}" width="150px" alt="">
        </div>
        {{-- <div class="sidebar-brand-text mx-3">Nama <sup>Apilikasi</sup></div> --}}
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ Request::is('admin/kalender*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kalender') }}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Kalender Acara</span></a>
    </li>



    <li class="nav-item {{ Request::is('admin/laporan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('laporan') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Laporan</span></a>
    </li>
    @else
        <a class="sidebar-brand d-flex align-items-center justify-content-center"
            href="{{ route('dashboard.index') }}">
            <div class="sidebar-brand-icon">
                <img src="{{ asset('assets/logo.png') }}" width="150px" alt="">
            </div>
            {{-- <div class="sidebar-brand-text mx-3">Nama <sup>Apilikasi</sup></div> --}}
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/kalender*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kalender') }}">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Kalender Acara</span></a>
        </li>



        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ Request::is('admin/master-data*') ? 'active' : '' }}">
            <a class="nav-link {{ Request::is('admin/master-data/user*') ? '' : 'collapsed' }}" href="#"
                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-table"></i>
                <span>Master Data</span>
            </a>
            <div id="collapseTwo" class="collapse {{ Request::is('admin/master-data*') ? 'show' : '' }}"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @if (auth()->user()->role == 'superadmin')
                        <a class="collapse-item {{ Request::is('admin/master-data/user*') ? 'active' : '' }}"
                            href="{{ route('user') }}">Data User</a>
                    @endif
                    <a class="collapse-item {{ Request::is('admin/master-data/lokasi*') ? 'active' : '' }}"
                        href="{{ route('lokasi') }}">Data Lokasi</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item {{ Request::is('admin/event*') ? 'active' : '' }}">
            <a class="nav-link {{ Request::is('admin/event*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse"
                data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-building"></i>
                <span>Sewa Event Gathering</span>
            </a>
            <div id="collapseUtilities" class="collapse {{ Request::is('admin/event*') ? 'show' : '' }}"
                aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Request::is('admin/event') ? 'active' : '' }}"
                        href="{{ route('event') }}">Input Event Gathering</a>
                    <a class="collapse-item {{ Request::is('admin/event/data/menunggu-pembayaran') ? 'active' : '' }}"
                        href="{{ route('event.data', 'menunggu-pembayaran') }}">Menunggu Pembayaran</a>
                    <a class="collapse-item {{ Request::is('admin/event/data/lunas') ? 'active' : '' }}"
                        href="{{ route('event.data', 'lunas') }}">Lunas</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ Request::is('admin/laporan*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('laporan') }}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Laporan</span></a>
        </li>
    @endif




    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
