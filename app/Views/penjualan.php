<?= $this->extend('layout/default'); ?>

<?= $this->section('style'); ?>
<!-- DataTables -->
<link
    rel="stylesheet"
    href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
<link
    rel="stylesheet"
    href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
<link
    rel="stylesheet"
    href="/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" />

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
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h3 class="card-title"><?= $table_name ?></h3>

                                <form method="get" class="form-inline mt-2 mt-md-0">
                                    <label class="mr-2">Dari:</label>
                                    <input type="date" name="start" value="<?= esc($start ?? '') ?>" class="form-control mr-2" />

                                    <label class="mr-2">Sampai:</label>
                                    <input type="date" name="end" value="<?= esc($end ?? '') ?>" class="form-control mr-2" />

                                    <button type="submit" class="btn btn-primary mr-2">Filter</button>

                                    <!-- Tombol Clear -->
                                    <a href="<?= current_url() ?>" class="btn btn-secondary">Clear</a>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="tablePenjualan" class="table table-bordered table-striped display nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah Terjual</th>
                                        <th>Total Pendapatan</th>
                                        <th>Nama Kasir</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($penjualan as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1; ?></td>
                                            <td><?= esc($value->nama_produk); ?></td>
                                            <td><?= esc($value->total_terjual); ?></td>
                                            <td>Rp <?= number_format($value->total_pendapatan, 0, ',', '.') ?></td>
                                            <td><?= esc($value->kasir); ?></td>
                                            <td><?= date('d-m-Y', strtotime($value->tanggal)) ?></td>
                                        </tr>
                                    <?php } ?>
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
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- DataTables  & Plugins -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<!-- SweetAlert2 -->
<script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    $(function() {
        $("#tablePenjualan")
            .DataTable({
                responsive: false,
                lengthChange: false,
                autoWidth: false,
                scrollX: true,
                pageLength: 5,
                columnDefs: [{
                        targets: 0,
                        searchable: false,
                        width: '25px'
                    },
                    {
                        targets: 1,
                        searchable: true,
                    },
                    {
                        targets: 2,
                        searchable: true,
                    },
                    {
                        targets: 3,
                        searchable: true,
                    },
                    {
                        targets: 4,
                        searchable: true,
                    },
                    {
                        targets: 4,
                        searchable: true,
                    }
                ]
            })
    });
    <?= $this->endSection(); ?>