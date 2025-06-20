<?= $this->extend('layout/auth'); ?>

<?= $this->section('content'); ?>
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1>Cerita Kopi</h1>
        </div>
        <div class="card-body">
            <form action="/login/attempt" method="post">
                <?= csrf_field(); ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        placeholder="Password" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>