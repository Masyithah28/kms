<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $con = koneksiDB();

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $role = mysqli_real_escape_string($con, $_POST['role']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password

    $query = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";
    if (mysqli_query($con, $query)) {
        $_SESSION['success'] = "Akun berhasil ditambahkan.";
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat menambahkan akun.";
    }

    header("Location: manajemen-akun.php");
    exit();
}
?>
