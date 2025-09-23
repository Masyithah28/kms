<?php
include 'koneksi.php';

$id_berkas = $_POST["id_berkas"];
$nama_berkas = $_POST["nama_berkas"];
$kategori = $_POST["kategori"];
$tgl_upload = $_POST["tanggal_upload"];
$tgl_berlaku = $_POST["tanggal_berlaku"];
$status = $_POST["status"]; // Ambil nilai status dari form
$namaFile = $_FILES['berkas']['name'];
$x = explode('.', $namaFile);
$ekstensiFile = strtolower(end($x));
$ukuranFile = $_FILES['berkas']['size'];
$file_tmp = $_FILES['berkas']['tmp_name'];

$dirUpload = "db_file/";
$linkBerkas = $dirUpload . $namaFile;

// Upload file
$terupload = move_uploaded_file($file_tmp, $linkBerkas);

// Data array dengan tambahan status dan tanggal berlaku
$dataArr = array(
    'id_berkas' => $id_berkas, 
    'nama_berkas' => $nama_berkas,
    'kategori' => $kategori,
    'title' => $namaFile, 
    'size' => $ukuranFile, 
    'ekstensi' => $ekstensiFile, 
    'berkas' => $linkBerkas,
    'tgl_up' => $tgl_upload,
    'tgl_berlaku' => $tgl_berlaku,
    'status' => $status // Tambahkan status ke dalam array
);

// Insert data ke database
if (insertData($dataArr) == 1) {
    header("Location: index-admin.php", true, 301);
    exit();
} else {
    header("Location: halaman_input.php", true, 301);
    exit();
}
?>
