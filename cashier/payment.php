<?php

require_once '../config/config.php';
require_once '../config/database.php';

if(isset($_POST['pay']))
{
    $invoice = 'INV-' . time();

    $total = 0;

    foreach($_SESSION['cart'] as $item)
    {
        $total += $item['price'] * $item['qty'];
    }

    mysqli_query($conn,
        "INSERT INTO transactions
        (
            invoice_number,
            user_id,
            total,
            payment_status,
            created_at
        )
        VALUES
        (
            '$invoice',
            '1',
            '$total',
            'paid',
            NOW()
        )"
    );

    unset($_SESSION['cart']);

    $_SESSION['success'] = "Pembayaran berhasil";

    header("Location: receipt.php?invoice=$invoice");
    exit;
}

include '../includes/header.php';

?>

<div class="container mt-4">

    <div class="card">

        <div class="card-body">

            <h3>Pembayaran</h3>

            <form method="POST">

                <div class="mb-3">

                    <label>Metode Pembayaran</label>

                    <select name="method"
                        class="form-control">

                        <option value="cash">
                            Cash
                        </option>

                        <option value="qris">
                            QRIS
                        </option>

                        <option value="transfer">
                            Transfer Bank
                        </option>

                    </select>

                </div>

                <button type="submit"
                    name="pay"
                    class="btn btn-primary">

                    Bayar

                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>