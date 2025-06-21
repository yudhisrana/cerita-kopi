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
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $dashboard_summary['transaksiHariIni'] ?></h3>
                            <p>Transaksi Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Rp <?= number_format($dashboard_summary['pendapatanHariIni'], 0, ',', '.') ?></h3>
                            <p>Total Pendapatan Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $dashboard_summary['produkTerjualHariIni'] ?></h3>
                            <p>Produk Terjual Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $dashboard_summary['StokHabis'] ?></h3>
                            <p>Stok Habis</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-triangle"></i>
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
    <?php if (session()->getFlashdata('success')) { ?>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '<?= session()->getFlashdata('success') ?>'
        });
    <?php } ?>
</script>
<?= $this->endSection(); ?>