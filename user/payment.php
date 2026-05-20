<?php
session_start();

require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';
include 'navbar.php';

// HITUNG TOTAL PEMBAYARAN
$total = 0;
if(isset($_SESSION['cart']))
{
    foreach($_SESSION['cart'] as $item)
    {
        $price = isset($item['price']) ? floatval($item['price']) : 0;
        $qty = isset($item['qty']) ? intval($item['qty']) : 1;
        $total += $price * $qty;
    }
}
?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <!-- HEADER -->
                <div class="bg-dark text-white p-4">
                    <h2 class="fw-bold mb-1">Pembayaran</h2>
                    <p class="mb-0 text-light">Selesaikan pembayaran pesanan anda</p>
                </div>

                <div class="card-body p-5">

                    <!-- TOTAL -->
                    <div class="alert alert-success rounded-4 text-center mb-4">
                        <h5 class="mb-2">Total Pembayaran</h5>
                        <h1 class="fw-bold">Rp <?= number_format($total); ?></h1>
                    </div>

                    <!-- FORM PEMBAYARAN -->
                    <form action="process-payment.php" method="POST" enctype="multipart/form-data">

                        <!-- METODE PEMBAYARAN -->
                        <div class="mb-4">
                            <label class="fw-semibold mb-2">Pilih Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" class="form-select rounded-3" required>
                                <option value="">-- Pilih Pembayaran --</option>
                                <option value="qris">QRIS</option>
                                <option value="ewallet">E-Wallet</option>
                                <option value="bank">Transfer Bank</option>
                            </select>
                        </div>

                        <!-- QRIS -->
                        <div id="qrisBox" style="display:none;">
                            <div class="card border-0 bg-light rounded-4 mb-4 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <h4 class="fw-bold mb-3">Scan QRIS</h4>
                                    <p class="text-muted">Scan QR di bawah menggunakan aplikasi pembayaran anda</p>
                                    <img src="../uploads/qris/qris.jpg"
                                         class="img-fluid border rounded-4 p-3 bg-white shadow-sm"
                                         width="280" alt="QRIS">
                                    <div class="mt-4">
                                        <h3 class="fw-bold text-success">Rp <?= number_format($total); ?></h3>
                                        <small class="text-muted">Nominal yang harus dibayar</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- E-WALLET -->
                        <div id="ewalletBox" style="display:none;">
                            <div class="alert alert-primary rounded-4 mb-4">
                                <h5 class="fw-bold mb-3">Pembayaran E-Wallet</h5>
                                <hr>
                                <p>DANA : <strong>08123456789</strong></p>
                                <p>OVO : <strong>08123456789</strong></p>
                                <p class="mb-0">GOPAY : <strong>08123456789</strong></p>
                            </div>
                        </div>

                        <!-- BANK -->
                        <div id="bankBox" style="display:none;">
                            <div class="alert alert-warning rounded-4 mb-4">
                                <h5 class="fw-bold mb-3">Transfer Bank</h5>
                                <hr>
                                <p>BCA : <strong>1234567890</strong></p>
                                <p>BRI : <strong>1234567890</strong></p>
                                <p class="mb-0">Mandiri : <strong>1234567890</strong></p>
                            </div>
                        </div>

                        <!-- UPLOAD BUKTI -->
                        <div class="mb-4">
                            <label class="fw-semibold mb-2">Upload Bukti Pembayaran</label>
                            <input type="file" name="payment_proof" class="form-control rounded-3" required>
                            <small class="text-muted">Format: JPG, PNG, JPEG</small>
                        </div>

                        <!-- BUTTON -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg rounded-3">
                                <i class="fas fa-paper-plane"></i> Kirim Pembayaran
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- SCRIPT TAMPILKAN METODE PEMBAYARAN -->
<script>
const paymentMethod = document.getElementById('payment_method');

paymentMethod.addEventListener('change', function() {
    document.getElementById('qrisBox').style.display = 'none';
    document.getElementById('ewalletBox').style.display = 'none';
    document.getElementById('bankBox').style.display = 'none';

    if(this.value == 'qris') document.getElementById('qrisBox').style.display = 'block';
    if(this.value == 'ewallet') document.getElementById('ewalletBox').style.display = 'block';
    if(this.value == 'bank') document.getElementById('bankBox').style.display = 'block';
});
</script>

<?php include '../includes/footer.php'; ?>