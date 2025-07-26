<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= site_url('admin/dashboard'); ?>" class="brand-link">
        <span class="brand-link text-center">PerpusKU</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MAIN NAVIGATION</li>
                <li class="nav-item">
                    <a href="<?= site_url('admin/dashboard'); ?>" class="nav-link <?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                    </a>
                </li>
                
                <?php $kelola_data_open = (strpos(uri_string(), 'admin/book') !== false || strpos(uri_string(), 'admin/anggota') !== false); ?>
                <li class="nav-item <?= $kelola_data_open ? 'menu-is-opening menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= $kelola_data_open ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>Kelola Data <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('admin/book'); ?>" class="nav-link <?= (strpos(uri_string(), 'admin/book') !== false) ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i><p>Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('admin/anggota'); ?>" class="nav-link <?= (strpos(uri_string(), 'admin/anggota') !== false) ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i><p>Anggota</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="<?= site_url('admin/sirkulasi'); ?>" class="nav-link <?= (strpos(uri_string(), 'admin/sirkulasi') !== false) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-sync-alt"></i><p>Sirkulasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('admin/laporan'); ?>" class="nav-link <?= (strpos(uri_string(), 'admin/laporan') !== false) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-print"></i><p>Laporan</p>
                    </a>
                </li>

                <li class="nav-header">SETTING</li>
                <li class="nav-item">
                    <a href="<?= site_url('admin/pengguna'); ?>" class="nav-link <?= (strpos(uri_string(), 'admin/pengguna') !== false) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users-cog"></i><p>Pengguna Sistem</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
