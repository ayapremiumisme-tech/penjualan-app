<?php

function emailTemplate($title, $message)
{
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title><?= $title; ?></title>

</head>

<body style="
    font-family:Arial;
    background:#f4f6f9;
    padding:30px;
">

    <div style="
        max-width:600px;
        margin:auto;
        background:#fff;
        padding:30px;
        border-radius:10px;
    ">

        <h2 style="color:#0d6efd;">
            <?= $title; ?>
        </h2>

        <p>
            <?= $message; ?>
        </p>

        <hr>

        <p style="font-size:12px; color:#888;">

            Email otomatis dari Penjualan App

        </p>

    </div>

</body>
</html>

<?php
}
?>