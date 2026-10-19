<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="<?= site_url('admin') ?>" class="brand-link">
        <span class="brand-text font-weight-light ml-3">SHOPI ATMA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img
                    src="<?= base_url('assets/dist/img/user2-160x160.jpg') ?>"
                    class="img-circle elevation-2"
                    alt="Admin">
            </div>

            <div class="info">
                <a href="<?= site_url('admin') ?>" class="d-block">
                    <?php
                    $nama_admin = $this->session->userdata('full_name');
                    echo html_escape($nama_admin ? $nama_admin : 'Administrator');
                    ?>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="<?= site_url('admin') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">MASTER</li>

                <li class="nav-item">
                    <a href="<?= site_url('administrator/kategori') ?>" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Kategori</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= site_url('administrator/produk') ?>" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Produk</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= site_url('admin/logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>
<!-- /.main-sidebar -->