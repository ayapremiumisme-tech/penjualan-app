<?php
session_start();
include 'navbar.php';
include '../includes/header.php';
?>

<div class="container mt-4">
    <h3 class="fw-bold mb-4">Keranjang Belanja</h3>

    <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <form action="update-cart.php" method="POST">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; foreach($_SESSION['cart'] as $item): ?>
                        <tr>
                            <td><?= $item['name']; ?></td>
                            <td>Rp <?= number_format($item['price']); ?></td>
                            <td>
                                <input type="number" name="qty" value="<?= $item['qty']; ?>" class="form-control" min="1">
                                <input type="hidden" name="id" value="<?= $item['id']; ?>">
                            </td>
                            <td>Rp <?= number_format($item['price'] * $item['qty']); ?></td>
                            <td>
                                <a href="delete-cart.php?id=<?= $item['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php $total += $item['price'] * $item['qty']; endforeach; ?>
                </tbody>
            </table>
            <p class="fw-bold">Total: Rp <?= number_format($total); ?></p>
            <button type="submit" class="btn btn-primary">Update Keranjang</button>
        </form>
    <?php else: ?>
        <div class="alert alert-warning">Keranjang masih kosong</div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>