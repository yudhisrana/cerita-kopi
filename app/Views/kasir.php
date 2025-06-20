<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?></title>
    <link rel="icon" href="<?= base_url('assets/img/logo.jpg'); ?>" type="image/gif" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css" />
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
                        <img src="/assets/img/default-profile.png" class="img-circle elevation-2" width="30" height="30" />
                        <span class="ml-2">Admin</span>
                    </a>
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
                                <tr>
                                    <td>Americano</td>
                                    <td>Rp 15.000</td>
                                    <td>2</td>
                                    <td>Rp 30.000</td>
                                    <td><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></td>
                                </tr>
                                <!-- Tambahkan data dinamis dari session/cart -->
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
                                <input type="text" name="produk" id="produk" class="form-control" placeholder="Cari atau scan barcode" autofocus />
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

                        <h5>Total: <strong>Rp 30.000</strong></h5>
                        <form action="/menu/kasir/checkout" method="post">
                            <?= csrf_field(); ?>
                            <button class="btn btn-primary btn-block mt-2">
                                <i class="fas fa-money-bill-wave"></i> Bayar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/adminlte.js"></script>
</body>

</html>