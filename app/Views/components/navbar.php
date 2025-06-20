<?php $user = session()->get(); ?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
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