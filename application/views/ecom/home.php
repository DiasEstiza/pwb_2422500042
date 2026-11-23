<style>
    .diskon {
        position: absolute;
        top: 8px;
        right: 16px;
    }
</style>

<div class="container mb-3" id="daftar-produk">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">

        <?php if (!empty($list_produk)) : ?>

            <?php foreach ($list_produk as $key => $value) : ?>

                <div class="col">
                    <div class="card shadow-sm h-100 position-relative">

                        <?php
                        $gambar = $gambar_model->get_by_produk_id($value['id_produk']);
                        ?>

                        <a href="<?= base_url('produk/') . $value['id_produk'] ?>">

                            <?php if (!empty($gambar)) : ?>

                                <img
                                    src="<?= base_url('uploads/produk/') . $gambar[0]['nama_gambar'] ?>"
                                    class="d-block w-100"
                                    alt="<?= html_escape($value['pd_nama']) ?>"
                                >

                            <?php else : ?>

                                <div class="text-center p-4">
                                    Gambar belum tersedia
                                </div>

                            <?php endif; ?>

                        </a>

                        <div class="card-body">

                            <a href="<?= base_url('produk/') . $value['id_produk'] ?>"
                               class="text-decoration-none text-dark">

                                <h5 class="card-title">
                                    <?= html_escape($value['pd_nama']) ?>
                                </h5>

                            </a>

                            <div class="d-flex justify-content-between align-items-center">

                                <div class="harga d-flex" style="color: dark">

                                    <small>Rp</small>

                                    <h4>
                                        <?= number_format((float)$value['harga'], 0, ',', '.') ?>
                                    </h4>

                                </div>

                                <small>
                                    <p><?= (int)$value['stok'] ?> tersedia</p>
                                </small>

                            </div>

                            <a href="<?= base_url('produk/') . $value['id_produk'] ?>"
                               class="btn btn-outline-primary btn-sm w-100">

                                Lihat Detail

                            </a>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php else : ?>

            <div class="col-12">
                <div class="alert alert-info">
                    Belum ada produk yang tersedia.
                </div>
            </div>

        <?php endif; ?>

    </div>
</div>

<div class="container mt-4 text-center">

    <a href="#daftar-produk" class="btn btn-outline-primary">
        Lihat Semua Produk
    </a>

</div>