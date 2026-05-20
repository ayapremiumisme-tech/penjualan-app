<?php

require_once '../../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
    "UPDATE notifications
    SET is_read=1
    WHERE id='$id'"
);

$_SESSION['success'] = "Notifikasi sudah dibaca";

header("Location: index.php");
exit;