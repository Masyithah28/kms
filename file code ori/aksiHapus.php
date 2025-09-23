<?php
    include 'koneksi.php';

    $id_berkas = $_GET["kodedelete"];
    // echo $id_barang;

    if (deleteData($id_berkas) == 1) {
        // echo "Hapus Data Berhasil";
        header("Location: index-admin.php", true, 301);
        exit();
    } else {
        // echo "Gagal Delete Data";
        header("Location: index-admin.php", true, 301);
        exit();
    }
?>