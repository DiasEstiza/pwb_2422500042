<div class="content-wrapper">
    <div class="content-header"><div class="container-fluid"><div class="row mb-2">
        <div class="col-sm-6"><h1 class="m-0">Tambah Kategori</h1></div>
        <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Home</a></li><li class="breadcrumb-item"><a href="<?= site_url('administrator/kategori') ?>">Kategori</a></li><li class="breadcrumb-item active">Tambah</li></ol></div>
    </div></div></div>
    <div class="content"><div class="container-fluid"><div class="row"><div class="col-md-8">
        <div class="card card-primary"><div class="card-header"><h3 class="card-title">Form Tambah Kategori</h3></div>
            <form method="post" action="<?= site_url('administrator/kategori/tambah') ?>">
                <div class="card-body">
                    <div class="form-group"><label for="nama_kategori">Nama Kategori</label><input type="text" class="form-control" name="nama_kategori" id="nama_kategori" value="<?= set_value('nama_kategori') ?>" required maxlength="100"><small class="text-danger"><?= form_error('nama_kategori') ?></small></div>
                    <div class="form-group"><label for="deskripsi_kategori">Deskripsi</label><textarea name="deskripsi_kategori" id="deskripsi_kategori" rows="5" class="form-control" required><?= set_value('deskripsi_kategori') ?></textarea><small class="text-danger"><?= form_error('deskripsi_kategori') ?></small></div>
                </div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Tambah</button> <a href="<?= site_url('administrator/kategori') ?>" class="btn btn-danger">Kembali</a></div>
            </form>
        </div>
    </div></div></div></div>
</div>
