<?php

header("Content-Type: application/json");

require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST')
{
    echo json_encode([
        'status' => false,
        'message' => 'Method tidak diizinkan'
    ]);
    exit;
}

$name     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (
    empty($name) ||
    empty($email) ||
    empty($password)
)
{
    echo json_encode([
        'status' => false,
        'message' => 'Semua field wajib diisi'
    ]);
    exit;
}

$email = mysqli_real_escape_string($conn, $email);

$check = mysqli_query($conn,
    "SELECT id FROM users
    WHERE email='$email'"
);

if (mysqli_num_rows($check) > 0)
{
    echo json_encode([
        'status' => false,
        'message' => 'Email sudah digunakan'
    ]);
    exit;
}

$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);

$insert = mysqli_query($conn,
    "INSERT INTO users
    (
        name,
        email,
        password,
        role,
        status,
        created_at
    )
    VALUES
    (
        '$name',
        '$email',
        '$hashedPassword',
        'user',
        'active',
        NOW()
    )"
);

if (!$insert)
{
    echo json_encode([
        'status' => false,
        'message' => 'Register gagal'
    ]);
    exit;
}

echo json_encode([
    'status' => true,
    'message' => 'Register berhasil'
]);