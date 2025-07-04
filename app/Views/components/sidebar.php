<?php $user = session()->get(); ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/assets/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Cerita Kopi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar py-3">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link <?= $page == 'dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">MASTER DATA</li>
                <li class="nav-item">
                    <a href="/master-data/produk" class="nav-link <?= $page == 'produk' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-coffee"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/master-data/kategori" class="nav-link <?= $page == 'kategori' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Kategori
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/master-data/satuan" class="nav-link <?= $page == 'satuan' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>
                            Satuan
                        </p>
                    </a>
                </li>
                <li class="nav-header">MENU</li>
                <li class="nav-item">
                    <a href="/menu/kasir" target="_blank" class="nav-link">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Kasir
                        </p>
                    </a>
                </li>
                <li class="nav-header">LAPORAN</li>
                <li class="nav-item">
                    <a href="/laporan/penjualan" class="nav-link <?= $page == 'penjualan' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Laporan Penjualan
                        </p>
                    </a>
                </li>
                <li class="nav-header">SETTING</li>
                <li class="nav-item">
                    <a href="/setting/user" class="nav-link <?= $page == 'user' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>