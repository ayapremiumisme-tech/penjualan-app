<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

?>

<nav class="navbar navbar-expand-lg navbar-dark py-3">

    <div class="container">

        <!-- LOGO -->

        <a class="navbar-brand fw-bold"
            href="home.php">

            Penjualan App

        </a>

        <!-- TOGGLER -->

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- MENU -->

        <div class="collapse navbar-collapse"
            id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <!-- HOME -->

                <li class="nav-item">

                    <a class="nav-link"
                        href="home.php">

                        Home

                    </a>

                </li>

                <!-- PRODUCTS -->

                <li class="nav-item">

                    <a class="nav-link"
                        href="products.php">

                        Produk

                    </a>

                </li>

                <!-- CART -->

                <li class="nav-item position-relative">

                    <a class="nav-link"
                        href="cart.php">

                        Cart

                        <?php
                        $cartCount =
                            isset($_SESSION['cart'])
                            ? count($_SESSION['cart'])
                            : 0;
                        ?>

                        <?php if($cartCount > 0): ?>

                            <span class="badge bg-danger rounded-pill">

                                <?= $cartCount; ?>

                            </span>

                        <?php endif; ?>

                    </a>

                </li>

                <!-- WISHLIST -->

                <li class="nav-item position-relative">

                    <a class="nav-link"
                        href="wishlist.php">

                        Wishlist

                        <?php
                        $wishlistCount =
                            isset($_SESSION['wishlist'])
                            ? count($_SESSION['wishlist'])
                            : 0;
                        ?>

                        <?php if($wishlistCount > 0): ?>

                            <span class="badge bg-warning text-dark rounded-pill">

                                <?= $wishlistCount; ?>

                            </span>

                        <?php endif; ?>

                    </a>

                </li>

                <!-- TRANSACTIONS -->

                <li class="nav-item">

                    <a class="nav-link"
                        href="transactions.php">

                        Transaksi

                    </a>

                </li>

                <!-- PROFILE -->

                <li class="nav-item">

                    <a class="nav-link"
                        href="profile.php">

                        Profile

                    </a>

                </li>

                <!-- LOGOUT -->

                <li class="nav-item ms-lg-3">

                    <a href="../auth/logout.php"
                        class="btn btn-light rounded-pill px-4">

                        Logout

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>