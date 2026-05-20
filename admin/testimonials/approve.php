<?php

require_once '../../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
    "UPDATE testimonials
    SET status='approved'
    WHERE id='$id'"
);

$_SESSION['success'] = "Testimoni berhasil disetujui";

header("Location: index.php");
exit;