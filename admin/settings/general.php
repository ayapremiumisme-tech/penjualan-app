<?php

require_once '../../config/config.php';
require_once '../../includes/middleware.php';

isLogin();
isAdmin();

include '../../includes/header.php';
include '../../includes/navbar.php';

?>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-2 p-0">

            <?php include '../../includes/sidebar.php'; ?>

        </div>

        <div class="col-md-10 p-4">

            <h3 class="mb-4">

                General Settings

            </h3>

            <div class="card">

                <div class="card-body">

                    <form>

                        <div class="mb-3">

                            <label>Nama Aplikasi</label>

                            <input
                                type="text"
                                class="form-control"
                                value="Penjualan App">

                        </div>

                        <div class="mb-3">

                            <label>Email</label>

                            <input
                                type="email"
                                class="form-control"
                                value="admin@gmail.com">

                        </div>

                        <button
                            class="btn btn-primary">

                            Simpan Settings

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>