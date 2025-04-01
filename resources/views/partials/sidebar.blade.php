<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex flex-column align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo.jpeg') }}" width="50" class="rounded-circle">
        </div>
        <div class="sidebar-brand-text mx-3" style="white-space: nowrap; font-size: 16px; font-weight: bold;">
            Sistem Informasi Stok
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-chart-bar"></i>
            <span>Dashboard</span></a>
    </li>

    @auth
    @if (auth()->user()->role === 'admin')

    <!-- Nav Item - Dashboard -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStok"
            aria-expanded="true" aria-controls="collapseStok">
            <i class="fas fa-box"></i>
            <span>Stok</span>
        </a>
        <div id="collapseStok" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="{{route('stok-bahan-baku.show')}}">Bahan Baku</a>
                <a class="collapse-item" href="{{route('stok-barang-setengah-jadi.show')}}">Barang Setengah Jadi</a>
                <a class="collapse-item" href="{{route('stok-barang-jadi.show')}}">Barang Jadi</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePemesanan"
            aria-expanded="true" aria-controls="collapsePemesanan">
            <i class="fas fa-shopping-cart"></i>
            <span>Pemesanan</span>
        </a>
        <div id="collapsePemesanan" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('pemesanan-bahan-baku.show')}}">Bahan Baku</a>
                <a class="collapse-item" href="{{route('pemesanan-barang-jadi.show')}}">Knalpot</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBarangMasuk"
            aria-expanded="true" aria-controls="collapseBarangMasuk">
            <i class="fas fa-arrow-down"></i>
            <span>Barang Masuk</span>
        </a>
        <div id="collapseBarangMasuk" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('barang-setengah-jadi-masuk.show')}}">Barang Setengah Jadi</a>
                <a class="collapse-item" href="{{route('barang-jadi-masuk.show')}}">Barang Jadi</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBarangKeluar"
            aria-expanded="true" aria-controls="collapseBarangKeluar">
            <i class="fas fa-arrow-up"></i>
            <span>Barang Keluar</span>
        </a>
        <div id="collapseBarangKeluar" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('bahan-baku-keluar.show')}}">Bahan Baku</a>
                <a class="collapse-item" href="{{route('barang-setengah-jadi-keluar.show')}}">Barang Setengah Jadi</a>
                <a class="collapse-item" href="{{route('barang-jadi-keluar.show')}}">Barang Jadi</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dataBarang"
            aria-expanded="true" aria-controls="dataBarang">
            <i class="fas fa-clipboard-list"></i>
            <span>Data</span>
        </a>
        <div id="dataBarang" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('bahan-baku.show')}}">Bahan Baku</a>
                <a class="collapse-item" href="{{route('barang-setengah-jadi.show')}}">Barang Setengah Jadi</a>
                <a class="collapse-item" href="{{route('barang-jadi.show')}}">Barang Jadi</a>
                <a class="collapse-item" href="{{route('customer.show')}}">Customer</a>
                <a class="collapse-item" href="{{route('potongan.show')}}">Potongan</a>
            </div>
        </div>
    </li>

    @endif
    @endauth

    <li class="nav-item">
        <a class="nav-link" href="{{route('laporan.index')}}">
            <span>Download Laporan</span></a>
    </li>

    @auth
    @if (auth()->user()->role === 'manager')
    <li class="nav-item">
        <a class="nav-link" href="{{route('manager.show')}}">
            <span>Kelola User</span>
        </a>
    </li>
    @endif
    @endauth

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->