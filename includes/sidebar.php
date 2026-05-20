<div class="sidebar bg-dark text-white p-3"
    style="width:250px; min-height:100vh;">

    <!-- LOGO -->

    <h4 class="mb-4">

        <i class="fas fa-store"></i>

        Admin Panel

    </h4>

    <!-- MENU -->

    <ul class="nav flex-column">

        <li class="nav-item mb-2">

            <a href="<?= APP_URL; ?>/admin/dashboard.php"
                class="nav-link text-white">

                <i class="fas fa-home"></i>

                Dashboard

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="<?= APP_URL; ?>/admin/products/index.php"
                class="nav-link text-white">

                <i class="fas fa-box"></i>

                Produk

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="<?= APP_URL; ?>/admin/categories/index.php"
                class="nav-link text-white">

                <i class="fas fa-tags"></i>

                Kategori

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="<?= APP_URL; ?>/admin/transactions/index.php"
                class="nav-link text-white">

                <i class="fas fa-shopping-cart"></i>

                Transaksi

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="<?= APP_URL; ?>/admin/users/index.php"
                class="nav-link text-white">

                <i class="fas fa-users"></i>

                Users

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="<?= APP_URL; ?>/admin/banners/index.php"
                class="nav-link text-white">

                <i class="fas fa-image"></i>

                Banners

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="<?= APP_URL; ?>/admin/reports/daily.php"
                class="nav-link text-white">

                <i class="fas fa-chart-line"></i>

                Reports

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="<?= APP_URL; ?>/admin/settings/general.php"
                class="nav-link text-white">

                <i class="fas fa-cog"></i>

                Settings

            </a>

        </li>

        <li class="nav-item mt-4">

            <a href="<?= APP_URL; ?>/auth/logout.php"
                class="btn btn-danger w-100">

                <i class="fas fa-sign-out-alt"></i>

                Logout

            </a>

        </li>

    </ul>

</div>