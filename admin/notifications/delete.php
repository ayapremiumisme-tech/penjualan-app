<?php

require_once '../../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
    "DELETE FROM notifications
    WHERE id='$id'"
);

$_SESSION['success'] = "Notifikasi berhasil dihapus";

header("Location: index.php");
exit;