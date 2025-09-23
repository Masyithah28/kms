<?php
session_start();
include 'koneksi.php';

if (isset($_GET['id'])) {
    $con = koneksiDB();

    $id = mysqli_real_escape_string($con, $_GET['id']);
    $query = "DELETE FROM users WHERE id='$id'";

    if (mysqli_query($con, $query)) {
        $_SESSION['success'] = "Akun berhasil dihapus.";
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat menghapus akun.";
    }

    header("Location: manajemen-akun.php");
    exit();
}
?>
