<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $con = koneksiDB();

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $role = mysqli_real_escape_string($con, $_POST['role']);
    $password = $_POST['password'];

    // Cek apakah password diisi
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET username='$username', email='$email', password='$hashedPassword', role='$role' WHERE id='$id'";
    } else {
        // Jika password kosong, jangan update field password
        $query = "UPDATE users SET username='$username', email='$email', role='$role' WHERE id='$id'";
    }

    if (mysqli_query($con, $query)) {
        $_SESSION['success'] = "Akun berhasil diperbarui.";
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat memperbarui akun.";
    }

    header("Location: manajemen-akun.php");
    exit();
}
?>
