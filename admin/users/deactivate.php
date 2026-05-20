<?php

require_once '../../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
    "UPDATE users
    SET status='inactive'
    WHERE id='$id'"
);

$_SESSION['success'] = "User berhasil dinonaktifkan";

header("Location: index.php");
exit;