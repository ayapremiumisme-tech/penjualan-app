<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

include '../../includes/header.php';

if(isset($_POST['save']))
{
    $qris = $_POST['qris'];
    $bank = $_POST['bank'];
    $cod  = isset($_POST['cod']) ? 1 : 0;

    mysqli_query($conn,
        "UPDATE settings
        SET setting_value='$qris'
        WHERE setting_key='qris_number'"
    );

    mysqli_query($conn,
        "UPDATE settings
        SET setting_value='$bank'
        WHERE setting_key='bank_account'"
    );

    mysqli_query($conn,
        "UPDATE settings
        SET setting_value='$cod'
        WHERE setting_key='cod_status'"
    );

    $_SESSION['success'] = "Payment setting berhasil disimpan";

    header("Location: payment.php");
    exit;
}

?>

<div class="container mt-4">

    <div class="card">

        <div class="card-body">

            <h3>Payment Settings</h3>

            <form method="POST">

                <div class="mb-3">

                    <label>QRIS Number</label>

                    <input type="text"
                        name="qris"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Bank Account</label>

                    <input type="text"
                        name="bank"
                        class="form-control">

                </div>

                <div class="mb-3 form-check">

                    <input type="checkbox"
                        name="cod"
                        class="form-check-input">

                    <label class="form-check-label">
                        Aktifkan COD
                    </label>

                </div>

                <button type="submit"
                    name="save"
                    class="btn btn-success">

                    Simpan

                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>