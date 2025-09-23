<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Input Dokumen - PT Petrokopindo Cipta Selaras</title>
    <link rel="icon" type="image/x-icon" href="css/icon-corp.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/index-admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inria+Sans:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap">
</head>

<body>

    <!-- Sidebar Navigation -->
    <div class="sidenav">
    <div class="logo-card">
        <img src="css/LOGO-CORP.png" alt="logo pcs">
    </div>
      <div class="account-info">
          <p>Anda telah login sebagai<br><strong><?php echo $_SESSION['username']; ?></strong></p>
      </div>
      <a href="index-admin.php" class="nav-link"><i class="fas fa-home icon"></i>Master Dokumen</a>
        
        <!-- Dropdown Menu for Arsip Dokumen -->
        <a href="#dokumenDropdown" class="nav-link dropdown-toggle" data-bs-toggle="collapse" aria-expanded="false">
            <i class="fas fa-file-alt icon"></i>Arsip Dokumen
        </a>
        <div class="collapse" id="dokumenDropdown">
            <ul class="list-unstyled ms-3">
            <li><a href="index-kebijakan.php" class="dropdown-item">Kebijakan</a></li>
                <li><a href="index-prosedur.php" class="dropdown-item">Prosedur</a></li>
                <li><a href="index-instruksi.php" class="dropdown-item">Instruksi Kerja</a></li>
                <li><a href="index-manajemen.php" class="dropdown-item">Manajemen Risiko</a></li>
                <li><a href="index-sistem.php" class="dropdown-item">Sistem Informasi Manajemen</a></li>
                <li><a href="index-inovasi.php" class="dropdown-item">Hasil Inovasi & Benchmarking</a></li>
                <li><a href="index-kontrak.php" class="dropdown-item">Kontrak / Perjanjian</a></li>
                <li><a href="index-lainnya.php" class="dropdown-item">Lainnya</a></li>
            </ul>
        </div>

        <!-- Dropdown Menu for Dokumen -->
        <a href="#dokumenDropdown" class="nav-link dropdown-toggle" data-bs-toggle="collapse" aria-expanded="false">
            <i class="fas fa-file-alt icon"></i>Dokumen
        </a>
        <div class="collapse" id="dokumenDropdown">
            <ul class="list-unstyled ms-3">
            <li><a href="index-kebijakan.php" class="dropdown-item">Kebijakan</a></li>
                <li><a href="index-prosedur.php" class="dropdown-item">Prosedur</a></li>
                <li><a href="index-instruksi.php" class="dropdown-item">Instruksi Kerja</a></li>
                <li><a href="index-manajemen.php" class="dropdown-item">Manajemen Risiko</a></li>
                <li><a href="index-sistem.php" class="dropdown-item">Sistem Informasi Manajemen</a></li>
                <li><a href="index-inovasi.php" class="dropdown-item">Hasil Inovasi & Benchmarking</a></li>
                <li><a href="index-kontrak.php" class="dropdown-item">Kontrak / Perjanjian</a></li>
                <li><a href="index-lainnya.php" class="dropdown-item">Lainnya</a></li>
            </ul>
        </div>
        
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <a href="halaman_input.php" class="nav-link active"><i class="fas fa-upload icon"></i>Input Dokumen</a>
          <a href="manajemen-akun.php" class="nav-link"><i class="fas fa-user-cog icon"></i>Manajemen Akun</a> <!-- New Menu for Admin -->
        <?php endif; ?>

        <a href="logout.php" class="nav-link logout"><i class="fas fa-sign-out-alt icon"></i>Logout</a>
    </div>

    <!-- Form Container -->
    <div class="content-container">
        <div class="header-container">
            <h2 class="fw-bold">INPUT DOKUMEN</h2>
        </div>
        <div class="container mt-4">
            <form action="aksiInsert.php" method="post" enctype="multipart/form-data" class="p-4" style="background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kodeBuku" class="form-label">Kode</label>
                        <input type="text" id="kodeBuku" name="id_berkas" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="namaBuku" class="form-label">Nama</label>
                        <input type="text" id="namaBuku" name="nama_berkas" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tanggalUpload" class="form-label">Tanggal Upload</label>
                        <input type="date" id="tanggalUpload" name="tanggal_upload" class="form-control" required readonly 
                            value="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tanggalBerlaku" class="form-label">Tanggal Masa Berlaku</label>
                        <input type="date" id="tanggalBerlaku" name="tanggal_berlaku" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select id="kategori" name="kategori" class="form-select">
                            <option value="Kebijakan">Kebijakan</option>
                            <option value="Prosedur">Prosedur</option>
                            <option value="Instruksi Kerja">Instruksi Kerja</option>
                            <option value="Manajemen Risiko">Manajemen Risiko</option>
                            <option value="Sistem Informasi Manajemen">Sistem Informasi Manajemen</option>
                            <option value="Hasil Inovasi Dan Benchmarking">Hasil Inovasi & Benchmarking</option>
                            <option value="Kontrak dan Perjanjian">Kontrak / Perjanjian</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="berkas" class="form-label">Upload Dokumen</label>
                            <input type="file" id="berkas" name="berkas" class="form-control" accept="application/pdf">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-success w-100 fw-bold">UPLOAD</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
