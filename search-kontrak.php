<?php
include 'koneksi.php';
session_start();

// Ambil query pencarian, kolom pengurutan, dan arah pengurutan dari parameter GET
$query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';
$column = isset($_GET['column']) ? $_GET['column'] : 'id_berkas'; // Kolom default
$direction = isset($_GET['direction']) && $_GET['direction'] === 'desc' ? 'DESC' : 'ASC'; // Arah default

// Kolom yang diizinkan untuk pengurutan
$allowed_columns = ['id_berkas', 'nama_berkas', 'kategori', 'status', 'tgl_up', 'tgl_berlaku'];
if (!in_array($column, $allowed_columns)) {
    $column = 'id_berkas';
}

// Query untuk pencarian khusus kategori "Sistem Informasi Manajemen"
$sql = "SELECT * FROM tb_berkas WHERE kategori = 'Kontrak Dan Perjanjian' AND (
        id_berkas LIKE '%$query%' OR 
        nama_berkas LIKE '%$query%' OR 
        status LIKE '%$query%'
    ) ORDER BY $column $direction";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $nomor_urut = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td class='text-center'>" . $nomor_urut++ . "</td>";
        echo "<td>{$row['id_berkas']}</td>";
        echo "<td>{$row['nama_berkas']}</td>";
        echo "<td>{$row['kategori']}</td>";
        
        $statusClass = ($row['status'] === 'Tidak Aktif') ? 'btn-danger' : 'btn-success';
        echo "<td class='text-center'><button class='btn $statusClass btn-sm' disabled>{$row['status']}</button></td>";
        
        echo "<td class='text-center'>" . date("d-m-Y", strtotime($row['tgl_up'])) . "</td>";
        echo "<td class='text-center'>" . date("d-m-Y", strtotime($row['tgl_berlaku'])) . "</td>";
        echo "<td class='text-center'>";
        
        // Tombol aksi lainnya seperti download, show, edit, delete
        echo "<a href='aksiDownload.php?url={$row['berkas']}' class='btn btn-sm btn-action' style='background-color: #3e9c35; color: white;' title='Download'><i class='fas fa-download'></i></a>";
        echo "<a href='aksiShow.php?url={$row['berkas']}' target='_blank' class='btn btn-sm btn-action' style='background-color: #a3e089; color: white;' title='Show'><i class='fas fa-eye'></i></a>";

        // Hanya tampilkan tombol edit dan delete jika role admin
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            echo "<a href='#' class='btn btn-sm btn-action' style='background-color: #cc9b34; color: white;' title='Edit' data-bs-toggle='modal' data-bs-target='#editModal' data-id='{$row['id_berkas']}' data-kode='{$row['id_berkas']}' data-nama='{$row['nama_berkas']}' data-kategori='{$row['kategori']}' data-status='{$row['status']}' data-tanggal-berlaku='{$row['tgl_berlaku']}' data-file='{$row['berkas']}'><i class='fas fa-edit'></i></a>";
            echo "<a href='#' onclick=\"return confirmDelete('aksiHapus.php?kodedelete={$row['id_berkas']}')\" class='btn btn-sm btn-action' style='background-color: #e74c3c; color: white;' title='Delete'><i class='fas fa-trash-alt'></i></a>";
        }

        echo "</td></tr>";
    }
} else {
    echo "<tr><td colspan='8' class='text-center fw-bold'>TIDAK ADA DATA</td></tr>";
}
?>
