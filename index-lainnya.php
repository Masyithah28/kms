<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dokumen Lainnya - PT Petrokopindo Cipta Selaras</title>
    <link rel="icon" type="image/x-icon" href="css/icon-corp.png">
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
        
        <!-- Dropdown Menu for Dokumen -->
        <a href="#dokumenDropdown" class="nav-link dropdown-toggle" data-bs-toggle="collapse" aria-expanded="false">
            <i class="fas fa-file-alt icon"></i>Arsip Dokumen
        </a>
        <div class="collapse" id="dokumenDropdown">
            <ul class="list-unstyled ms-3">
               <li><a href="index-kebijakan-arsip.php" class="dropdown-item">Kebijakan</a></li>
                <li><a href="index-prosedur-arsip.php" class="dropdown-item">Prosedur</a></li>
                <li><a href="index-instruksi-arsip.php" class="dropdown-item">Instruksi Kerja</a></li>
                <li><a href="index-manajemen-arsip.php" class="dropdown-item">Manajemen Risiko</a></li>
                <li><a href="index-sistem-arsip.php" class="dropdown-item">Sistem Informasi Manajemen</a></li>
                <li><a href="index-inovasi-arsip.php" class="dropdown-item">Hasil Inovasi & Benchmarking</a></li>
                <li><a href="index-kontrak-arsip.php" class="dropdown-item">Kontrak / Perjanjian</a></li>
                <li><a href="index-lainnya-arsip.php" class="dropdown-item">Lainnya</a></li>
            </ul>
        </div>

        <a href="#dokumenDropdown1" class="nav-link active dropdown-toggle" data-bs-toggle="collapse" aria-expanded="false">
            <i class="fas fa-file-alt icon"></i>Dokumen
            
        </a>
        <div class="collapse" id="dokumenDropdown1">
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
          <a href="halaman_input.php" class="nav-link"><i class="fas fa-upload icon"></i>Input Dokumen</a>
          <a href="manajemen-akun.php" class="nav-link"><i class="fas fa-user-cog icon"></i>Manajemen Akun</a> <!-- New Menu for Admin -->
        <?php endif; ?>

        <a href="logout.php" class="nav-link logout"><i class="fas fa-sign-out-alt icon"></i>Logout</a>
    </div>
    
    <!-- Main Content -->
    <div class="content-container">
        <!-- Wrapper untuk judul dan search bar -->
        <div class="header-container d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="fw-bold mb-0">DAFTAR DOKUMEN</h2>
                <h2 class="fw-bold mb-0">DOKUMEN LAIN-LAIN</h2>
            </div>
            <!-- Input Group untuk Field Pencarian -->
            <div class="input-group" style="width: 340px; margin-top: 6vh;">
                <span class="input-group-text" id="search-label">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" id="searchInput" class="form-control" placeholder="Cari dokumen..." aria-label="Search" aria-describedby="search-label">
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr class="text-center">
                        <th style="width: 75px;">No </i></th>
                        <th onclick="sortTable(1)" class="sortable" style="width: 90px; white-space: normal;">Kode <i class="fas fa-sort sort-icon"></i></th>
                        <th onclick="sortTable(2)" class="sortable" style="width: 200px; white-space: normal; word-wrap: break-word;">Nama <i class="fas fa-sort sort-icon"></i></th>
                        <th onclick="sortTable(3)" class="sortable" style="width: 150px; white-space: normal; word-wrap: break-word;">Kategori <i class="fas fa-sort sort-icon"></i></th>
                        <th onclick="sortTable(4)" class="sortable" style="width: 120px;">Status <i class="fas fa-sort sort-icon"></i></th>
                        <th onclick="sortTable(5)" class="sortable" style="width: 130px;">Tanggal Upload <i class="fas fa-sort sort-icon"></i></th>
                        <th onclick="sortTable(6)" class="sortable" style="width: 130px;">Tanggal Masa Berlaku <i class="fas fa-sort sort-icon"></i></th>
                        <th onclick="sortTable(7)" class="sortable" style="width: 190px;">Bidang <i class="fas fa-sort sort-icon"></i></th>
                        <th style="width: 190px;">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once 'koneksi.php';

                    $nomor_urut = 0;
                    $result = selectLainnyaDataTDokumen();
                    $countData = mysqli_num_rows($result);

                    $batas = 15;
                    $page = isset($_GET['p']) ? (int) $_GET['p'] : 1;
                    $startpage = ($page > 1) ? ($page * $batas) - $batas : 0;
                    $totalpage = ceil($countData / $batas);

                    $prev = $page - 1;
                    $next = $page + 1;

                    $result = selectPageLainnyaTDokumen($startpage, $batas);

                    if ($countData < 1) {
                        echo "<tr><td colspan='9' class='text-center fw-bold'>TIDAK ADA DATA</td></tr>";
                    } else {
                        $nomor_urut = $startpage + 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='text-center'>" . $nomor_urut++ . "</td>";
                            echo "<td>{$row['id_dokumen']}</td>";
                            echo "<td>{$row['nama_dokumen']}</td>";
                            echo "<td>{$row['kategori']}</td>";
                            $statusClass = ($row['status'] === 'Tidak Aktif') ? 'btn-danger' : 'btn-success';
                            echo "<td class='text-center'>";
                            echo "<button class='btn $statusClass btn-sm' disabled>{$row['status']}</button>";
                            echo "</td>";
                            echo "<td class='text-center'>" . date("d-m-Y", strtotime($row['tgl_up'])) . "</td>";
                            echo "<td class='text-center'>" . date("d-m-Y", strtotime($row['tgl_berlaku'])) . "</td>";
                            echo "<td class='text-center'>{$row['nama_bidang']}</td>"; 
                            echo "<td class='text-center'>";
                            echo "<a href='aksiDownload.php?url={$row['dokumen']}' class='btn btn-sm btn-action' style='background-color: #3e9c35; color: white;' title='Download'><i class='fas fa-download'></i></a>";
                            echo "<a href='aksiShow.php?url={$row['dokumen']}' target='_blank' class='btn btn-sm btn-action' style='background-color: #a3e089; color: white;' title='Show'><i class='fas fa-eye'></i></a>"; // Warna show bebas, contoh menggunakan abu-abu

                            // Batasi tombol delete hanya untuk admin
                            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                                echo "<a href='#' 
                                        class='btn btn-sm btn-action' 
                                        style='background-color: #cc9b34; color: white;' 
                                        title='Edit' 
                                        data-bs-toggle='modal' 
                                        data-bs-target='#editModal' 
                                        data-id='{$row['id_dokumen']}' 
                                        data-kode='{$row['id_dokumen']}'
                                        data-nama='{$row['nama_dokumen']}' 
                                        data-kategori='{$row['kategori']}' 
                                        data-status='{$row['status']}' 
                                        data-tanggal-berlaku='{$row['tgl_berlaku']}'
                                        data-file='{$row['dokumen']}'>
                                        <i class='fas fa-edit'></i>
                                    </a>";  
                                    echo "<a href='#' 
                                            class='btn btn-sm btn-action' 
                                            style='background-color: #e74c3c; color: white;' 
                                            title='Delete' 
                                            onclick=\"return confirmDelete('aksiHapus.php?kodedelete={$row['id_dokumen']}')\">
                                            <i class='fas fa-trash-alt'></i>
                                        </a>";                             
                            }
                            echo "</td>"; 
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="aksiEdit.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Dokumen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="editId" name="id">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="editKode" class="form-label">Kode</label>
                                    <input type="text" class="form-control" id="editKode" name="id_berkas" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="editNamaBerkas" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="editNamaBerkas" name="nama_berkas" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="editKategori" class="form-label">Kategori</label>
                                    <select class="form-select" id="editKategori" name="kategori" required>
                                        <option value="Kebijakan">Kebijakan</option>
                                        <option value="Prosedur">Prosedur</option>
                                        <option value="Instruksi Kerja">Instruksi Kerja</option>
                                        <option value="Manajemen Risiko">Manajemen Risiko</option>
                                        <option value="Sistem Informasi Manajemen">Sistem Informasi Manajemen</option>
                                        <option value="Hasil Inovasi dan Benchmarking">Hasil Inovasi & Benchmarking</option>
                                        <option value="Kontrak dan Perjanjian">Kontrak / Perjanjian</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="editStatus" class="form-label">Status</label>
                                    <select class="form-select" id="editStatus" name="status" required>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="editTanggalBerlaku" class="form-label">Tanggal Masa Berlaku</label>
                                    <input type="date" class="form-control" id="editTanggalBerlaku" name="tanggal_berlaku" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="editFile" class="form-label">File Dokumen</label>
                                    <input type="file" class="form-control" id="editFile" name="berkas" accept="application/pdf">
                                    <div id="currentFileContainer" class="mt-2">
                                        <small>File saat ini: <a href="#" id="currentFileLink" target="_blank">Tidak ada file</a></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="<?php if ($page > 1) echo "?p=$prev"; else echo '#'; ?>">&laquo; Previous</a>
                </li>
                <?php for ($i = 1; $i <= $totalpage; $i++) : ?>
                    <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                        <a class="page-link" href="?p=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php if ($page >= $totalpage) echo 'disabled'; ?>">
                    <a class="page-link" href="<?php if ($page < $totalpage) echo "?p=$next"; else echo '#'; ?>">Next &raquo;</a>
                </li>
            </ul>
        </nav>

        <p class="footer-text">IT PT Petrokopindo Cipta Selaras © 2024</p>
    </div>

    <script>
        // Attach event listeners to edit buttons
        document.querySelectorAll('.btn-action[data-bs-target="#editModal"]').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                // Retrieve data attributes from the button
                const id = button.getAttribute('data-id');
                const kode = button.getAttribute('data-kode');
                const namaBerkas = button.getAttribute('data-nama');
                const kategori = button.getAttribute('data-kategori');
                const status = button.getAttribute('data-status');
                const tanggalBerlaku = button.getAttribute('data-tanggal-berlaku');
                const filePath = button.getAttribute('data-file');

                // Assign data to modal elements
                document.getElementById('editId').value = id;
                document.getElementById('editKode').value = kode;
                document.getElementById('editNamaBerkas').value = namaBerkas;
                document.getElementById('editKategori').value = kategori;
                document.getElementById('editStatus').value = status;
                document.getElementById('editTanggalBerlaku').value = tanggalBerlaku;

                // Handle file display
                const currentFileLink = document.getElementById('currentFileLink');
                if (filePath) {
                    currentFileLink.href = 'path/to/files/' + filePath; // Adjust the path as necessary
                    currentFileLink.textContent = filePath.split('/').pop(); // Display file name
                    currentFileLink.parentElement.style.display = 'inline';
                } else {
                    currentFileLink.textContent = 'Tidak ada file';
                    currentFileLink.parentElement.style.display = 'none';
                }

                // Show the modal
                const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                editModal.show();
            });
        });

        document.getElementById('editModal').addEventListener('hidden.bs.modal', function () {
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove(); // Menghapus elemen backdrop dari DOM
            }
            
            // Mengembalikan scroll
            document.body.style.overflow = "auto";
            document.body.classList.remove('modal-open'); // Menghapus kelas modal-open
            
            // Mengembalikan padding body untuk mengatasi pergeseran
            document.body.style.paddingRight = "0px"; // Atur padding ke 0 untuk reset
        });

        function confirmDelete(url) {
            if (confirm("Apakah Anda yakin ingin menghapus dokumen ini?")) {
                window.location.href = url;
            }
            return false;
        }

        // Fungsi untuk mencari secara real-time
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const query = this.value;

            // Create an AJAX request
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'search-lainnya.php?query=' + encodeURIComponent(query), true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Replace table body with the response
                    document.querySelector('table tbody').innerHTML = xhr.responseText;
                }
            };

            xhr.send();
        });

        function sortTable(n) {
        // Define the column names corresponding to each index
        const columnMap = {
            1: 'id_berkas',
            2: 'nama_berkas',
            3: 'kategori',
            4: 'status',
            5: 'tgl_up',
            6: 'tgl_berlaku'
        };

        // Get the current direction of sorting
        let currentDirection = document.querySelectorAll('th')[n].getAttribute('data-direction') || 'asc';
        let newDirection = currentDirection === 'asc' ? 'desc' : 'asc';

        // Set the new direction attribute for the column header
        document.querySelectorAll('th')[n].setAttribute('data-direction', newDirection);

        // Get the column name based on the index
        const column = columnMap[n];
        if (!column) return; // Exit if the column is not defined

        // Perform AJAX request to fetch sorted data
        const xhr = new XMLHttpRequest();
        const query = document.getElementById('searchInput').value; // Get current search input value
        xhr.open('GET', `search-lainnya.php?query=${encodeURIComponent(query)}&column=${encodeURIComponent(column)}&direction=${encodeURIComponent(newDirection)}`, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Replace table body with the sorted data from the server
                document.querySelector('table tbody').innerHTML = xhr.responseText;

                // Update the icons for sorting indication
                updateSortIcons(n, newDirection);
            }
        };

        xhr.send();
    }

    function updateSortIcons(columnIndex, direction) {
        // Reset icons for all columns
        document.querySelectorAll('.sort-icon').forEach(icon => {
            icon.classList.remove("fa-sort-up", "fa-sort-down");
            icon.classList.add("fa-sort");
        });

        // Set the icon for the sorted column
        const icon = document.querySelectorAll('th')[columnIndex].querySelector('.sort-icon');
        if (direction === 'asc') {
            icon.classList.add("fa-sort-up");
        } else {
            icon.classList.add("fa-sort-down");
        }
    }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menandai nav-link dan dropdown-item aktif berdasarkan URL saat ini
        document.addEventListener("DOMContentLoaded", function() {
            // Cari semua link di dalam dropdown dan nav
            const currentPath = window.location.pathname.split("/").pop(); // Ambil nama file saat ini

            // Untuk menandai dropdown terbuka jika halaman ini di dalamnya
            if (currentPath === "index-lainnya.php") {
                const dokumenDropdown1 = document.querySelector("#dokumenDropdown1");
                const lainnyaLink = document.querySelector("a[href='index-lainnya.php']");

                // Menambah kelas 'show' pada dropdown untuk tetap terbuka
                if (dokumenDropdown1 && lainnyaLink) {
                    dokumenDropdown1.classList.add("show");
                    lainnyaLink.classList.add("active");
                }
            }
        });
    </script>
    <script>
        // Menandai nav-link dan dropdown-item aktif berdasarkan URL saat ini
        document.addEventListener("DOMContentLoaded", function() {
            // Cari semua link di dalam dropdown dan nav
            const currentPath = window.location.pathname.split("/").pop(); // Ambil nama file saat ini

            // Untuk menandai dropdown terbuka jika halaman ini di dalamnya
            if (currentPath === "index-kebijakan.php") {
                const dokumenDropdown1 = document.querySelector("#dokumenDropdown1");
                const kebijakanLink = document.querySelector("a[href='index-kebijakan.php']");

                // Menambah kelas 'show' pada dropdown untuk tetap terbuka
                if (dokumenDropdown1 && kebijakanLink) {
                    dokumenDropdown1.classList.add("show");
                    kebijakanLink.classList.add("active");
                }
            }
        });
    </script>
</body>
</html>