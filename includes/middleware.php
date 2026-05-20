<?php

function isLogin()
{
    if(!isset($_SESSION['user_id']))
    {
        header("Location: ../auth/login.php");
        exit;
    }
}

function isAdmin()
{
    if(
        !isset($_SESSION['user_role']) ||
        $_SESSION['user_role'] != 'admin'
    )
    {
        die("Akses ditolak!");
    }
}