<?php

require_once '../../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
    "UPDATE testimonials
    SET status='rejected'
    WHERE id='$id'"
);

$_SESSION['success'] = "Testimoni ditolak";

header("Location: index.php");
exit;