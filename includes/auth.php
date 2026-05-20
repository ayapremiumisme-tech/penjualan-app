<?php

require_once __DIR__ . '/../config/database.php';

function login($email, $password)
{
    global $conn;

    $email = mysqli_real_escape_string($conn, $email);

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name']    = $user['name'];
            $_SESSION['role']    = $user['role'];

            return true;
        }
    }

    return false;
}