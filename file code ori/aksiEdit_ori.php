<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $kode = $_POST['id_berkas'];
    $namaBerkas = $_POST['nama_berkas'];
    $kategori = $_POST['kategori'];
    $status = $_POST['status'];
    $tgl_berlaku = $_POST['tanggal_berlaku'];

    // Mendapatkan koneksi menggunakan koneksiDB()
    $conn = koneksiDB();

    if (!empty($_FILES['berkas']['name'])) {
        // Jika ada file baru yang diunggah
        $fileName = $_FILES['berkas']['name'];
        $fileTmpName = $_FILES['berkas']['tmp_name'];
        $uploadDir = "db_file/";
        $filePath = $uploadDir . basename($fileName);

        if (move_uploaded_file($fileTmpName, $filePath)) {
            $query = "UPDATE tb_berkas SET id_berkas = ?, nama_berkas = ?, kategori = ?, status = ?, tgl_berlaku = ?, berkas = ? WHERE id_berkas = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssssi", $kode, $namaBerkas, $kategori, $status, $tgl_berlaku, $filePath, $id);
        } else {
            echo "Error uploading file.";
            exit();
        }
    } else {
        // Jika tidak ada file baru, biarkan file lama tetap ada
        $query = "UPDATE tb_berkas SET id_berkas = ?, nama_berkas = ?, kategori = ?, status = ?, tgl_berlaku = ? WHERE id_berkas = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssi", $kode, $namaBerkas, $kategori, $status, $tgl_berlaku, $id);
    }

    if ($stmt->execute()) {
        header("Location: index-admin.php?message=Data updated successfully");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
