<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?></title>
    <link rel="icon" href="<?= base_url('assets/img/logo.jpg'); ?>" type="image/gif" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="/assets/plugins/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="/assets/css/adminlte.min.css" />

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .kasir-wrapper {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .kasir-body {
            flex: 1;
            display: flex;
            overflow: hidden;
        }

        .kasir-left,
        .kasir-right {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .kasir-left {
            flex: 2;
            padding: 1rem;
        }

        .kasir-right {
            flex: 1;
            padding: 1rem 1rem 1rem 0;
        }

        .card {
            flex: 1;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .card-body {
            overflow-y: auto;
        }

        .navbar {
            background-color: #343a40;
        }

        .brand-link img {
            height: 35px;
        }
    </style>
</head>

<body>
    <div class="kasir-wrapper">
        <!-- Navbar -->
        <?php $user = session()->get(); ?>
        <nav class="navbar navbar-expand navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item d-flex align-items-center">
                    <div class="brand-link">
                        <img src="/assets/img/logo.jpg" alt="Logo" class="img-circle elevation-2 mr-2" style="width: 35px" />
                        <span class="text-white">Kasir Cerita Kopi</span>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown">
                        <img src="/assets/img/default-profile.png" class="img-circle elevation-2" alt="User Image" width="30" height="30">
                        <span class="ml-2"><?= $user['name'] ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mt-1">
                        <form action="/logout" method="post" class="px-4 py-2">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-danger btn-block">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Konten Kasir -->
        <div class="kasir-body">
            <!-- Kiri: Tabel -->
            <div class="kasir-left">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Item</h3>
                    </div>
                    <div class="card-body">
                        <?php $cart = session()->get('kasir_cart') ?? []; ?>
                        <table class="table table-striped m-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart as $item) { ?>
                                    <tr>
                                        <td><?= esc($item['nama']) ?></td>
                                        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                        <td><?= $item['jumlah'] ?></td>
                                        <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                                        <td>
                                            <form action="/menu/kasir/remove" method="post" style="display:inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="produk_id" value="<?= $item['id'] ?>">
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Kanan: Form -->
            <div class="kasir-right">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Input Produk</h3>
                    </div>
                    <div class="card-body">
                        <form action="/menu/kasir/add" method="post">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="produk">Produk</label>
                                <select class="form-control" name="produk" id="produk">
                                    <option></option>
                                    <?php foreach ($produk as $produk) { ?>
                                        <option value="<?= $produk->id ?>">
                                            <?= $produk->nama_produk ?> - [ jumlah stok <?= $produk->stok ?> ]
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" value="1" />
                            </div>
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-cart-plus"></i> Tambah
                            </button>
                        </form>

                        <hr />

                        <?php
                        $total = array_sum(array_column($cart, 'subtotal'));
                        $ppnPercent = 0; // default value
                        $ppn = ($ppnPercent / 100) * $total;
                        $diskon = 0;
                        $grandTotal = $total + $ppn - $diskon;
                        ?>

                        <div class="container-fluid px-2">
                            <form action="/menu/kasir/checkout" method="post">
                                <?= csrf_field(); ?>

                                <dl class="row mb-0">
                                    <dt class="col-6">Total</dt>
                                    <dd class="col-6 text-right">Rp <?= number_format($total, 0, ',', '.') ?></dd>

                                    <dt class="col-6">PPN (%)</dt>
                                    <dd class="col-6 text-right">
                                        <input type="number" id="ppn_percent" name="ppn_percent" class="form-control form-control-sm text-right" min="0" value="<?= $ppnPercent ?>">
                                    </dd>

                                    <dt class="col-6">Diskon (Rp)</dt>
                                    <dd class="col-6 text-right">
                                        <input type="number" id="diskon" name="diskon" class="form-control form-control-sm text-right" min="0" value="0">
                                    </dd>

                                    <hr class="col-12 my-2" />

                                    <dt class="col-6 font-weight-bold">Grand Total</dt>
                                    <dd class="col-6 text-right font-weight-bold text-primary" id="grandTotalDisplay">
                                        Rp <?= number_format($grandTotal, 0, ',', '.') ?>
                                    </dd>
                                </dl>

                                <input type="hidden" name="grand_total" id="inputGrandTotal" value="<?= $grandTotal ?>">
                                <input type="hidden" name="ppn" id="inputPPN" value="<?= $ppn ?>">
                                <input type="hidden" name="metode_pembayaran" id="metodePembayaranInput">

                                <?php $cart = session()->get('kasir_cart') ?? []; ?>
                                <button type="button"
                                    id="btnCheckout"
                                    class="btn btn-primary btn-block mt-3"
                                    <?= empty($cart) ? 'disabled title="Cart masih kosong"' : '' ?>>
                                    <i class="fas fa-money-bill-wave"></i> Bayar
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <script src="/assets/plugins/select2/js/select2.min.js"></script>
    <script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/adminlte.js"></script>

    <script>
        $(function() {
            $('#produk').select2({
                placeholder: {
                    id: '',
                    text: 'Pilih Produk'
                },
                allowClear: true
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const total = <?= $total ?>;

            const ppnPercentInput = document.getElementById("ppn_percent");
            const diskonInput = document.getElementById("diskon");
            const grandTotalDisplay = document.getElementById("grandTotalDisplay");
            const inputGrandTotal = document.getElementById("inputGrandTotal");
            const inputPPN = document.getElementById("inputPPN");

            function updateGrandTotal() {
                const ppnPercent = parseFloat(ppnPercentInput.value) || 0;
                const diskon = parseInt(diskonInput.value) || 0;

                const ppn = (ppnPercent / 100) * total;
                const grandTotal = total + ppn - diskon;

                grandTotalDisplay.textContent = formatRupiah(grandTotal);
                inputGrandTotal.value = grandTotal;
                inputPPN.value = ppn;
            }

            function formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(number);
            }

            ppnPercentInput.addEventListener("input", updateGrandTotal);
            diskonInput.addEventListener("input", updateGrandTotal);
            updateGrandTotal();
        });

        document.getElementById("btnCheckout").addEventListener("click", function() {
            Swal.fire({
                title: 'Pilih Metode Pembayaran',
                input: 'select',
                inputOptions: {
                    cash: 'Cash',
                    transfer: 'Transfer'
                },
                inputPlaceholder: 'Pilih metode',
                showCancelButton: true,
                confirmButtonColor: "#c67c4e",
                confirmButtonText: 'Lanjut Bayar',
                cancelButtonColor: "#5A6268",
                cancelButtonText: 'Batal',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Silakan pilih metode pembayaran!'
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('metodePembayaranInput').value = result.value;
                    document.querySelector('form[action="/menu/kasir/checkout"]').submit();
                }
            });
        });

        <?php if (session()->getFlashdata('success')) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '<?= session()->getFlashdata('success') ?>'
            });
        <?php } ?>
    </script>
</body>

</html>