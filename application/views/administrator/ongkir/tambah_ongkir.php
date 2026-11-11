<div class="content-wrapper">
    <div class="content-header"><div class="container-fluid"><div class="row mb-2">
        <div class="col-sm-6"><h1 class="m-0">Tambah Ongkir</h1></div>
        <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Home</a></li><li class="breadcrumb-item"><a href="<?= site_url('administrator/ongkir') ?>">Ongkir</a></li><li class="breadcrumb-item active">Tambah</li></ol></div>
    </div></div></div>
    <div class="content"><div class="container-fluid"><div class="row"><div class="col-md-8">
        <div class="card card-primary"><div class="card-header"><h3 class="card-title">Form Tambah Ongkir</h3></div>
            <form method="post" action="<?= site_url('administrator/ongkir/tambah') ?>">
                <div class="card-body">
                    <div class="form-group"><label for="nama_ekspedisi042">Nama Ekspedisi</label><input type="text" class="form-control" name="nama_ekspedisi042" id="nama_ekspedisi042" value="<?= set_value('nama_ekspedisi042') ?>" required maxlength="100"><small class="text-danger"><?= form_error('nama_ekspedisi042') ?></small></div>
                    <textarea name="jenis_layanan042"><?=set_value('jenis_layanan'); ?></textarea> <? form_error('jenis_layanan'); ?>
                    <div class="form-group"><label for="tarif_per_kg042">Tarif Per Kg</label><textarea name="tarif_per_kg042" id="dtarif_per_kg042" rows="5" class="form-control" required><?= set_value('tarif_per_kg042') ?></textarea><small class="text-danger"><?= form_error('tarif_per_kg042') ?></small></div>
                    <div class="form-group"><label for="status042">Status</label><?= set_value('status042') ?></textarea><small class="text-danger"><?= form_error('status042') ?></small></div>
                    <select name="status042">
                        <option value="aktif">Aktif</option>
                        <option value="tidak aktif">Tidak Aktif</option>
                    </select>
                </div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Tambah</button> <a href="<?= site_url('administrator/ongkir') ?>" class="btn btn-danger">Kembali</a></div>
            </form>
        </div>
    </div></div></div></div>
</div>
