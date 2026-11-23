<div class="container mb-3 mt-4">
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-1 text-center">
            <h4>Profil Saya</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-small">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Profil
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Data Diri Pelanggan</h5>
                </div>

                <div class="card-body">
                    <?php if (!empty($pelanggan)) : ?>

                        <table class="table table-striped">
                            <tr>
                                <th width="30%">Nama Lengkap</th>
                                <td>: <?= html_escape($pelanggan['nama_pelanggan']) ?></td>
                            </tr>
                            <tr>
                                <th>Alamat Email</th>
                                <td>: <?= html_escape($pelanggan['email']) ?></td>
                            </tr>
                            <tr>
                                <th>No. Telepon</th>
                                <td>: <?= html_escape($pelanggan['telp_pelanggan']) ?></td>
                            </tr>
                            <tr>
                                <th>Alamat Jalan</th>
                                <td>: <?= html_escape($pelanggan['alamat']) ?></td>
                            </tr>
                            <tr>
                                <th>Kota</th>
                                <td>: <?= html_escape($pelanggan['kota']) ?></td>
                            </tr>
                            <tr>
                                <th>Provinsi</th>
                                <td>: <?= html_escape($pelanggan['provinsi']) ?></td>
                            </tr>
                            <tr>
                                <th>Kode Pos</th>
                                <td>: <?= html_escape($pelanggan['kode_pos']) ?></td>
                            </tr>
                        </table>

                    <?php else : ?>

                        <div class="alert alert-warning">
                            Data profil pelanggan tidak ditemukan.
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>