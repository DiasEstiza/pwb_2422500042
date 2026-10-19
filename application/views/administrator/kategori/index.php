<<<<<<< HEAD
=======
<!-- Content Wrapper. Contains page content -->
>>>>>>> c515dea (update routes.php)
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kategori</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="<?= site_url('admin') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Kategori</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Kategori</h3>

                            <div class="card-tools">
                                <a href="<?= site_url('administrator/kategori/tambah') ?>"
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Tambah Kategori
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <?php if ($this->session->flashdata('message')) : ?>
                                <?= $this->session->flashdata('message') ?>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 60px;">No</th>
                                            <th>Nama Kategori</th>
                                            <th>Deskripsi</th>
                                            <th style="width: 180px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if (!empty($list_kategori)) : ?>
                                            <?php $no = 1; ?>
                                            <?php foreach ($list_kategori as $kategori) : ?>
                                                <?php
                                                $primary_key = $this->produk_kategori_model->get_primary_key();
                                                $id = ($primary_key !== FALSE && isset($kategori[$primary_key]))
                                                    ? $kategori[$primary_key]
                                                    : NULL;
                                                ?>

                                                <tr>
                                                    <td><?= $no++ ?></td>

                                                    <td>
                                                        <?= html_escape(isset($kategori['nama']) ? $kategori['nama'] : '') ?>
                                                    </td>

                                                    <td>
                                                        <?= html_escape(isset($kategori['deskripsi']) ? $kategori['deskripsi'] : '') ?>
                                                    </td>

                                                    <td>
                                                        <?php if ($id !== NULL) : ?>
                                                            <a href="<?= site_url('administrator/kategori/ubah/' . $id) ?>"
                                                               class="btn btn-warning btn-sm">
                                                                <i class="fas fa-edit"></i> Ubah
                                                            </a>

                                                            <a href="<?= site_url('administrator/kategori/hapus/' . $id) ?>"
                                                               class="btn btn-danger btn-sm"
                                                               onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </a>
                                                        <?php else : ?>
                                                            <span class="text-danger">
                                                                ID kategori tidak ditemukan
                                                            </span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    Belum ada data kategori.
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
