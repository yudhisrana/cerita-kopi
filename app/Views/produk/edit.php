<?= $this->extend('layout/default'); ?>

<?= $this->section('style'); ?>
<!-- SweetAlert2 -->
<link
    rel="stylesheet"
    href="/assets/plugins/sweetalert2/sweetalert2.min.css" />
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="card-title"><?= $form_name; ?></h3>
                                <a href="/master-data/produk" type="button" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php $validation = session()->get('validation') ?? \Config\Services::validation(); ?>
                            <form action="<?= '/master-data/produk/update/' . $produk->id; ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label for="produk">Produk</label>
                                    <input type="text" class="form-control <?= $validation->hasError('produk') ? 'is-invalid' : '' ?>" id="produk" name="produk" placeholder="Nama produk" value="<?= old('produk', $produk->nama_produk) ?>">
                                    <span id="produk-error" class="error invalid-feedback">
                                        <?= $validation->getError('produk') ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" class="form-control <?= $validation->hasError('harga') ? 'is-invalid' : '' ?>" id="harga" name="harga" placeholder="Contoh: 10000 atau 10000.50" value="<?= old('harga', $produk->harga) ?>">
                                    <span id="harga-error" class="error invalid-feedback">
                                        <?= $validation->getError('harga') ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="text" class="form-control <?= $validation->hasError('stok') ? 'is-invalid' : '' ?>" id="stok" name="stok" placeholder="Masukan jumlah stok produk" value="<?= old('stok', $produk->stok) ?>">
                                    <span id="stok-error" class="error invalid-feedback">
                                        <?= $validation->getError('stok') ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-control <?= $validation->hasError('kategori') ? 'is-invalid' : '' ?>" name="kategori" id="kategori">
                                        <?php foreach ($kategori as $kategori) { ?>
                                            <option value="<?= $kategori->id; ?>" <?= old('kategori', $produk->kategori_id) == $kategori->id ? 'selected' : '' ?>>
                                                <?= $kategori->nama_kategori; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <span id="kategori-error" class="error invalid-feedback">
                                        <?= $validation->getError('kategori') ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <select class="form-control <?= $validation->hasError('satuan') ? 'is-invalid' : '' ?>" name="satuan" id="satuan">
                                        <?php foreach ($satuan as $satuan) { ?>
                                            <option value="<?= $satuan->id; ?>" <?= old('satuan', $produk->satuan_id) == $satuan->id ? 'selected' : '' ?>>
                                                <?= $satuan->nama_satuan; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <span id="satuan-error" class="error invalid-feedback">
                                        <?= $validation->getError('satuan') ?>
                                    </span>
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <button type="submit" id="submitModal" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- SweetAlert2 -->
<script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    <?php if (session()->getFlashdata('error')) { ?>
        Swal.fire({
            icon: 'error',
            title: 'Opss..',
            text: '<?= session()->getFlashdata('error') ?>'
        });
    <?php } ?>
</script>
<?= $this->endSection(); ?>