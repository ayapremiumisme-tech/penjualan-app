<?php

header("Content-Type: application/json");

session_start();

require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST')
{
    echo json_encode([
        'status' => false,
        'message' => 'Method tidak diizinkan'
    ]);
    exit;
}

$email    = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($email) || empty($password))
{
    echo json_encode([
        'status' => false,
        'message' => 'Email dan password wajib diisi'
    ]);
    exit;
}

$email = mysqli_real_escape_string($conn, $email);

$query = mysqli_query($conn,
    "SELECT * FROM users
    WHERE email='$email'
    LIMIT 1"
);

if (mysqli_num_rows($query) < 1)
{
    echo json_encode([
        'status' => false,
        'message' => 'User tidak ditemukan'
    ]);
    exit;
}

$user = mysqli_fetch_assoc($query);

if (!password_verify($password, $user['password']))
{
    echo json_encode([
        'status' => false,
        'message' => 'Password salah'
    ]);
    exit;
}

if ($user['status'] != 'active')
{
    echo json_encode([
        'status' => false,
        'message' => 'Akun tidak aktif'
    ]);
    exit;
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['name']    = $user['name'];
$_SESSION['role']    = $user['role'];

echo json_encode([
    'status' => true,
    'message' => 'Login berhasil',
    'data' => [
        'id'    => $user['id'],
        'name'  => $user['name'],
        'email' => $user['email'],
        'role'  => $user['role']
    ]
]);