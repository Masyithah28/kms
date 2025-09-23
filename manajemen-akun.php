<?php
session_start();
include 'koneksi.php';

// Hanya izinkan akses jika user adalah admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Ambil koneksi dari fungsi koneksiDB
$con = koneksiDB();

// Hitung total data
$queryCount = "SELECT COUNT(*) as total FROM users";
$resultCount = mysqli_query($con, $queryCount);
$dataCount = mysqli_fetch_assoc($resultCount);
$totalData = $dataCount['total'];

$perPage = 10; // Jumlah data per halaman
$page = isset($_GET['p']) ? (int) $_GET['p'] : 1;
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
$totalPages = ceil($totalData / $perPage);
$prevPage = $page - 1;
$nextPage = $page + 1;

// Ambil data pengguna dengan limit dan offset untuk pagination
$query = "SELECT * FROM users LIMIT $start, $perPage";
$result = mysqli_query($con, $query);

$roles = [
    'admin' => 'Super Admin',
    'user'  => 'User',
    'alber1' => 'Alber 1',
    'alber2' => 'Alber 2',
    'alber3' => 'Alber 3',
    'angkutan_dalam' => 'Angkutan Dalam',
    'angkutan_luar' => 'Angkutan Luar',
    'pergudangan_pengantongan' => 'Pergudangan & Pengantongan',
    'perdagangan' => 'Perdagangan',
    'pemeliharaan' => 'Pemeliharaan',
    'keuangan' => 'Keuangan',
    'perencanaan_pengendalian' => 'Perencanaan & Pengendalian',
    'pengadaan' => 'Pengadaan',
    'sdm_hukum' => 'SDM & Hukum',
    'umum_it' => 'Umum & IT',
    'k3l' => 'K3L',
    'audit_internal' => 'Audit Internal',
    'pengembangan_usaha' => 'Pengembangan Usaha',
];

$currentRole = $row['role'] ?? '';

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Akun - PT Petrokopindo Cipta Selaras</title>
    <link rel="icon" type="image/x-icon" href="css/icon-corp.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/index-admin.css">
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
                <li><a href="index-dokumen1.php" class="dropdown-item">Kebijakan</a></li>
                <li><a href="index-dokumen2.php" class="dropdown-item">Prosedur</a></li>
                <li><a href="index-dokumen3.php" class="dropdown-item">Instruksi Kerja</a></li>
                <li><a href="index-dokumen4.php" class="dropdown-item">Manajemen Risiko</a></li>
                <li><a href="index-dokumen5.php" class="dropdown-item">Sistem Informasi Manajemen</a></li>
                <li><a href="index-dokumen6.php" class="dropdown-item">Hasil Inovasi & Benchmarking</a></li>
                <li><a href="index-dokumen7.php" class="dropdown-item">Dokumen Lainnya</a></li>
            </ul>
        </div>

        <!-- Dropdown Menu for Dokumen -->
        <a href="#dokumenDropdown" class="nav-link dropdown-toggle" data-bs-toggle="collapse" aria-expanded="false">
            <i class="fas fa-file-alt icon"></i>Dokumen
        </a>
        <div class="collapse" id="dokumenDropdown">
            <ul class="list-unstyled ms-3">
                <li><a href="index-dokumen1.php" class="dropdown-item">Kebijakan</a></li>
                <li><a href="index-dokumen2.php" class="dropdown-item">Prosedur</a></li>
                <li><a href="index-dokumen3.php" class="dropdown-item">Instruksi Kerja</a></li>
                <li><a href="index-dokumen4.php" class="dropdown-item">Manajemen Risiko</a></li>
                <li><a href="index-dokumen5.php" class="dropdown-item">Sistem Informasi Manajemen</a></li>
                <li><a href="index-dokumen6.php" class="dropdown-item">Hasil Inovasi & Benchmarking</a></li>
                <li><a href="index-dokumen7.php" class="dropdown-item">Dokumen Lainnya</a></li>
            </ul>
        </div>
        
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <a href="halaman_input.php" class="nav-link"><i class="fas fa-upload icon"></i>Input Dokumen</a>
          <a href="manajemen-akun.php" class="nav-link active"><i class="fas fa-user-cog icon"></i>Manajemen Akun</a> <!-- New Menu for Admin -->
        <?php endif; ?>

        <a href="logout.php" class="nav-link logout"><i class="fas fa-sign-out-alt icon"></i>Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content-container">
        <!-- Header Title -->
        <div class="header-container mb-4">
            <h2 class="fw-bold">MANAJEMEN AKUN</h2>
        </div>

        <!-- Search Bar and Add Button -->
        <div class="header-container d-flex justify-content-between align-items-center mb-4">
            <div class="input-group" style="width: 300px;">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" id="searchInput" class="form-control" placeholder="Cari pengguna...">
            </div>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">Tambah Akun</button>
        </div>
        
        <!-- User Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr class="text-center">
                        <th>No</th>
                        <th onclick="sortTable(1)" class="sortable">Username <i class="fas fa-sort"></i></th>
                        <th onclick="sortTable(2)" class="sortable">Email <i class="fas fa-sort"></i></th>
                        <th onclick="sortTable(3)" class="sortable">Role <i class="fas fa-sort"></i></th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = $start + 1; // Menentukan nomor urut berdasarkan halaman
                        while ($row = mysqli_fetch_assoc($result)): 
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td> <!-- Nomor urut -->
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td class="text-center"><?php echo ucfirst($row['role']); ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm edit-btn" 
                                    data-id="<?php echo $row['id']; ?>"
                                    data-username="<?php echo $row['username']; ?>"
                                    data-email="<?php echo $row['email']; ?>"
                                    data-role="<?php echo $row['role']; ?>"
                                    data-bs-toggle="modal" data-bs-target="#editUserModal">
                                    Edit
                                </button>
                                <a href="aksiHapusUser.php?id=<?php echo $row['id']; ?>" 
                                class="btn btn-danger btn-sm" 
                                onclick="return confirm('Anda yakin ingin menghapus akun ini?');">
                                Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="<?php if ($page > 1) echo "?p=$prevPage"; else echo '#'; ?>">&laquo; Previous</a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                        <a class="page-link" href="?p=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                    <a class="page-link" href="<?php if ($page < $totalPages) echo "?p=$nextPage"; else echo '#'; ?>">Next &raquo;</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="aksiAddUser.php" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Tambah Akun Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <?php foreach ($roles as $value => $label): ?>
                                    <option value="<?= $value; ?>"><?= $label; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah Akun</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="aksiEditUser.php" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label for="edit_username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="edit_username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_role" class="form-label">Role</label>
                            <select class="form-control" id="edit_role" name="role" required>
                                <?php foreach ($roles as $value => $label): ?>
                                    <option value="<?= $value; ?>" <?= ($currentRole === $value) ? 'selected' : ''; ?>>
                                        <?= $label; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                       <!-- <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <?php foreach ($roles as $value => $label): ?>
                                    <option value="<?= $value; ?>"><?= $label; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> -->
                        <div class="mb-3">
                            <label for="edit_password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="edit_password" name="password" placeholder="Kosongkan jika tidak ingin diubah">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility()">
                                    <i id="passwordIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Script to pass data to the edit modal
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                // Get data from button attributes
                const id = this.getAttribute('data-id');
                const username = this.getAttribute('data-username');
                const email = this.getAttribute('data-email');
                const role = this.getAttribute('data-role');

                // Set data in modal fields
                document.getElementById('edit_id').value = id;
                document.getElementById('edit_username').value = username;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_role').value = role;
                document.getElementById('edit_password').value = ''; // Clear password field
            });
        });
    </script>
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('edit_password');
            const passwordIcon = document.getElementById('passwordIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Search functionality
        document.getElementById("searchInput").addEventListener("keyup", function() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector(".table");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        });

        // Sort functionality
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.querySelector(".table");
            switching = true;
            dir = "asc";
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    if (dir == "asc") {
                        if (x.textContent.toLowerCase() > y.textContent.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.textContent.toLowerCase() < y.textContent.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
        
    </script>
</body>
</html>
