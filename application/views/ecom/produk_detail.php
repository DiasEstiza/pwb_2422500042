<style>
    .image-produk {
        width: 100%;
        height: 350px;
        object-fit: contain;
        background: #f5f5f5;
    }

    .image-nav {
        width: 100%;
        height: 90px;
        padding: 5px;
        object-fit: contain;
        cursor: pointer;
    }

    .produk-detail {
        padding: 5px 15px;
    }

    .produk-detail h2 {
        font-size: 25px;
        margin-bottom: 8px;
    }

    .produk-detail h5 {
        margin-bottom: 12px;
    }

    .produk-detail p {
        margin-bottom: 8px;
    }

    .produk-order {
        margin-top: 20px;
    }

    .produk-order input {
        margin-top: 8px;
    }

    .product-buttons {
        margin-top: 20px;
    }

    .deskripsi {
        margin-top: 25px;
    }

    .slider-nav {
        margin-top: 10px;
    }

    .slider-nav .slick-slide {
        padding: 5px;
    }

    @media (max-width: 767px) {
        .image-produk {
            height: 280px;
        }

        .produk-detail {
            padding: 20px 5px;
        }
    }
</style>

<?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="container mt-5 mb-5">

    <div class="row align-items-start">

        <!-- Gambar Produk -->
        <div class="col-md-5 col-sm-12">

            <div class="product-slick mb-2">

                <?php foreach ($list_gambar as $gambar) : ?>
                    <div>
                        <img
                            src="<?= base_url('uploads/produk/' . $gambar['nama_gambar']) ?>"
                            alt="<?= $produk['nama'] ?>"
                            class="image-produk img-fluid">
                    </div>
                <?php endforeach; ?>

            </div>

            <!-- Thumbnail Gambar -->
            <div class="row">
                <div class="col-12">

                    <div class="slider-nav">

                        <?php foreach ($list_gambar as $gambar) : ?>
                            <div>
                                <img
                                    src="<?= base_url('uploads/produk/' . $gambar['nama_gambar']) ?>"
                                    alt="<?= $produk['nama'] ?>"
                                    class="image-nav img-fluid">
                            </div>
                        <?php endforeach; ?>

                    </div>

                </div>
            </div>

        </div>

        <!-- Informasi Produk -->
        <div class="col-md-7 col-sm-12">

            <div class="produk-detail">

                <h2><?= $produk['nama'] ?></h2>

                <h5>
                    Rp <?= number_format($produk['harga'], 0, ',', '.') ?>
                </h5>

                <p>
                    ID Produk: <?= $produk['id_produk'] ?>
                </p>

                <p>
                    STOK: <?= $produk['stok'] ?>
                </p>

                <!-- Form Pembelian -->
                <div class="produk-order mb-0">

                    <h6 class="product-title">jumlah beli</h6>

                    <form action="<?= base_url('keranjang/tambah') ?>" method="post">

                        <input
                            type="hidden"
                            name="id_produk"
                            value="<?= $produk['id_produk'] ?>">

                        <div class="input-group">

                            <input
                                class="form-control"
                                name="jumlah"
                                type="number"
                                value="1"
                                min="1"
                                max="<?= $produk['stok'] ?>"
                                required>

                        </div>

                        <div class="product-buttons">

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-shopping-cart"></i>
                                Tambah ke Keranjang
                            </button>

                        </div>

                    </form>

                </div>

                <!-- Deskripsi Produk -->
                <div class="deskripsi">

                    <h4>Deskripsi:</h4>

                    <p><?= $produk['deskripsi'] ?></p>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    $(document).ready(function() {

        $('.product-slick').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });

        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.product-slick',
            dots: true,
            centerMode: true,
            focusOnSelect: true,
            arrows: false
        });

    });
</script>