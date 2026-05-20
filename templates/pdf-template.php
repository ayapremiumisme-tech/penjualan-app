<?php

function pdfTemplate($title, $content)
{
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title><?= $title; ?></title>

    <style>

        body{
            font-family:Arial;
            padding:30px;
        }

        h1{
            margin-bottom:20px;
        }

    </style>

</head>

<body>

    <h1><?= $title; ?></h1>

    <div>

        <?= $content; ?>

    </div>

</body>
</html>

<?php
}
?>