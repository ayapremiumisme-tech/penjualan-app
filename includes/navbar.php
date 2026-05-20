<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <div class="container">

        <a class="navbar-brand" href="<?= APP_URL; ?>">
            <i class="fas fa-store"></i>
            Penjualan App
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a href="<?= APP_URL; ?>" class="nav-link">Home</a>
                </li>

                <li class="nav-item">
                    <a href="<?= APP_URL; ?>/user/products.php" class="nav-link">Produk</a>
                </li>

                <?php if(isset($_SESSION['user_id'])) : ?>

                    <li class="nav-item">
                        <a href="<?= APP_URL; ?>/auth/logout.php" class="nav-link">
                            Logout
                        </a>
                    </li>

                <?php else : ?>

                    <li class="nav-item">
                        <a href="<?= APP_URL; ?>/auth/login.php" class="nav-link">
                            Login
                        </a>
                    </li>

                <?php endif; ?>

            </ul>

        </div>

    </div>

</nav>