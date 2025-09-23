<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id = htmlspecialchars($_POST['id']);
    $kode = htmlspecialchars($_POST['id_berkas']);
    $namaBerkas = htmlspecialchars($_POST['nama_berkas']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $status = htmlspecialchars($_POST['status']);
    $tgl_berlaku = htmlspecialchars($_POST['tanggal_berlaku']);

    // Koneksi ke database
    $conn = koneksiDB();

    // Periksa apakah ada file baru yang diunggah
    if (!empty($_FILES['berkas']['name'])) {
        $fileName = $_FILES['berkas']['name'];
        $fileTmpName = $_FILES['berkas']['tmp_name'];
        $uploadDir = "db_file/";
        $filePath = $uploadDir . basename($fileName);

        if (move_uploaded_file($fileTmpName, $filePath)) {
            // Query untuk update dengan file baru
            $query = "UPDATE tb_berkas 
                      SET id_berkas = ?, nama_berkas = ?, kategori = ?, status = ?, tgl_berlaku = ?, berkas = ? 
                      WHERE id_berkas = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssssss", $kode, $namaBerkas, $kategori, $status, $tgl_berlaku, $filePath, $kode);
        } else {
            echo "Error uploading file.";
            exit();
        }
    } else {
        // Query untuk update tanpa file baru
        $query = "UPDATE tb_berkas 
                  SET id_berkas = ?, nama_berkas = ?, kategori = ?, status = ?, tgl_berlaku = ? 
                  WHERE id_berkas = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssss", $kode, $namaBerkas, $kategori, $status, $tgl_berlaku, $kode);
    }

    // Eksekusi query
    if ($stmt->execute()) {
        header("Location: index-admin.php?message=Data berhasil diperbarui");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
}
?>
