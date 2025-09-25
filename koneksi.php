    <?php

    function koneksiDB()
    {
        $host = "localhost";
        $username = "root";
        $password = "";
        $db = "db_pcs";
        $db_port = 3306;

        $conn = mysqli_connect($host, $username, $password, $db, $db_port);

        if (!$conn) {
            die("Koneksi Database Gagal : " . mysqli_connect_error());
        } else {
            return $conn;
        }
    }

    function countVisitor()
    {
        // Koneksi ke database
        $ip = $_SERVER['REMOTE_ADDR'];
        $conn = koneksiDB();

        // Mendapatkan tanggal hari ini
        $today = date('Y-m-d');

        // Query untuk memeriksa apakah tanggal hari ini sudah ada di tabel
        $queryCheck = "SELECT * FROM visitor_counter WHERE visit_date = '$today' AND ip_address = '$ip'";
        $result = mysqli_query($conn, $queryCheck);


        if (mysqli_num_rows($result) == 0) {
            // Tambahkan entri baru jika IP belum ada
            $queryInsert = "INSERT INTO visitor_counter (visit_date, visit_count, ip_address) VALUES ('$today', 1, '$ip')";
            mysqli_query($conn, $queryInsert);
        } else {
            echo "IP Address Perangkat Anda sudah dihitung untuk hari ini.";
        }
    }

    function getTotalVisitors()
    {
        // Koneksi ke database
        $conn = koneksiDB();

        // Query untuk menghitung total pengunjung
        $query = "SELECT SUM(visit_count) as total_visitors FROM visitor_counter";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);

        return $data['total_visitors'];
    }

    //tb_berkas
    function selectAllData()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_berkas ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectKebijakanData()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Kebijakan' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }
    function selectProsedurData()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Prosedur' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectInovasiData()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Hasil Inovasi Dan Benchmarking' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectInstruksiData()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Instruksi Kerja' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectKontrakData()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Kontrak Dan Perjanjian' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectLainnyaData()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Lainnya' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectManajemenData()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Manajemen Risiko' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectSistemData()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Sistem Informasi Manajemen' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function getKebijakanData($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_berkas WHERE kategori = 'Kebijakan' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getProsedurData($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_berkas WHERE kategori = 'Prosedur' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getInstruksiData($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_berkas WHERE kategori = 'Instruksi Kerja' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getManajemenData($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_berkas WHERE kategori = 'Manajemen Risiko' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getSistemData($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_berkas WHERE kategori = 'Sistem Informasi Manajemen' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getInovasiData($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_berkas WHERE kategori = 'Hasil Inovasi Dan Benchmarking' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getKontrakData($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_berkas WHERE kategori = 'Kontrak Dan Perjanjian' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getLainnyaData($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_berkas WHERE kategori = 'Lainnya' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function insertData($data)
    {
        // Menambahkan kolom tgl_berlaku dalam query INSERT
        $query = "INSERT INTO tb_berkas (id_berkas, nama_berkas, kategori, size, ekstensi, berkas, tgl_up, tgl_berlaku) 
                VALUES ('" . $data['id_berkas'] . "','" . $data['nama_berkas'] . "','" . $data['kategori'] . "','" . $data['size'] . "','" . $data['ekstensi'] . "','" . $data['berkas'] . "','" . $data['tgl_up'] . "','" . $data['tgl_berlaku'] . "')";

        $result = mysqli_query(koneksiDB(), $query);

        if (!$result) {
            return 0;
        } else {
            return 1;
        }
    }

    function deleteData($kodedelete)
    {
        $query = "DELETE FROM tb_berkas WHERE id_berkas = '$kodedelete'";
        $result = mysqli_query(koneksiDB(), $query);

        if (!$result) {
            return 0;
        } else {
            return 1;
        }
    }

    function selectPageData($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT * FROM tb_berkas ORDER BY tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectPageKebijakan($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Kebijakan' ORDER BY tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }
    function selectPageProsedur($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Prosedur' ORDER BY tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectPageInovasi($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Hasil Inovasi dan Benchmarking' ORDER BY tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectPageInstruksi($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Instruksi Kerja' ORDER BY tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectPageKontrak($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Kontrak Dan Perjanjian' ORDER BY tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectPageLainnya($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Lainnya' ORDER BY tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectPageManajemen($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Manajemen Risiko' ORDER BY tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectPageSistem($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT * FROM tb_berkas WHERE kategori = 'Sistem Informasi Manajemen' ORDER BY tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }
    function searchData($cari)
    {
        $query = "SELECT * FROM tb_berkas WHERE CONCAT(id_berkas, nama_berkas, kategori, tgl_up) LIKE '%" . $cari . "%'";
        $result = mysqli_query(koneksiDB(), $query);
        return $result;
    }

    function countTotalDocuments()
    {
        $query = "SELECT COUNT(*) as total FROM tb_berkas";
        $result = mysqli_query(koneksiDB(), $query);
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    }

    function countActiveDocuments()
    {
        $query = "SELECT COUNT(*) as total FROM tb_berkas WHERE status = 'Aktif'";
        $result = mysqli_query(koneksiDB(), $query);
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    }

    function countInactiveDocuments()
    {
        $query = "SELECT COUNT(*) as total FROM tb_berkas WHERE status = 'Tidak Aktif'";
        $result = mysqli_query(koneksiDB(), $query);
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    }


    //tb_dokumen
    function selectAllDataTDokumen()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_dokumen ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectKebijakanDataTDokumen()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_dokumen WHERE kategori = 'Kebijakan' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }
    function selectProsedurDataTDokumen()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_dokumen WHERE kategori = 'Prosedur' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectInovasiDataTDokumen()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_dokumen WHERE kategori = 'Hasil Inovasi Dan Benchmarking' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectInstruksiDataTDokumen()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_dokumen WHERE kategori = 'Instruksi Kerja' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectKontrakDataTDokumen()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_dokumen WHERE kategori = 'Kontrak Dan Perjanjian' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectLainnyaDataTDokumen()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_dokumen WHERE kategori = 'Lainnya' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectManajemenDataTDokumen()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_dokumen WHERE kategori = 'Manajemen Risiko' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectSistemDataTDokumen()
    {
        $conn = koneksiDB(); // Pastikan fungsi koneksiDB() benar dan mengembalikan koneksi yang valid
        $query = "SELECT * FROM tb_dokumen WHERE kategori = 'Sistem Informasi Manajemen' ORDER BY tgl_up DESC"; // Menambahkan ORDER BY untuk pengurutan
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function getKebijakanDataTDokumen($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_dokumen WHERE kategori = 'Kebijakan' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getProsedurDataTDokumen($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_dokumen WHERE kategori = 'Prosedur' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getInstruksiDataTDokumen($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_dokumen WHERE kategori = 'Instruksi Kerja' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getManajemenDataTDokumen($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_dokumen WHERE kategori = 'Manajemen Risiko' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getSistemDataTDokumen($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_dokumen WHERE kategori = 'Sistem Informasi Manajemen' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getInovasiDataTDokumen($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_dokumen WHERE kategori = 'Hasil Inovasi Dan Benchmarking' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getKontrakDataTDokumen($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_dokumen WHERE kategori = 'Kontrak Dan Perjanjian' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function getLainnyaDataTDokumen($startpage, $batas)
    {
        $conn = koneksiDB(); // Assuming koneksiDB() is a function that returns a database connection
        $stmt = $conn->prepare("SELECT * FROM tb_dokumen WHERE kategori = 'Lainnya' ORDER BY tgl_up DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $startpage, $batas); // Bind the integer type 'ii' to the placeholders
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function insertDataTDokumen($data)
    {
        // Menambahkan kolom tgl_berlaku dalam query INSERT
        $query = "INSERT INTO tb_dokumen (id_berkas, nama_berkas, kategori, size, ekstensi, berkas, tgl_up, tgl_berlaku) 
                VALUES ('" . $data['id_berkas'] . "','" . $data['nama_berkas'] . "','" . $data['kategori'] . "','" . $data['size'] . "','" . $data['ekstensi'] . "','" . $data['berkas'] . "','" . $data['tgl_up'] . "','" . $data['tgl_berlaku'] . "')";

        $result = mysqli_query(koneksiDB(), $query);

        if (!$result) {
            return 0;
        } else {
            return 1;
        }
    }

    function deleteDataTDokumen($kodedelete)
    {
        $query = "DELETE FROM tb_dokumen WHERE id_berkas = '$kodedelete'";
        $result = mysqli_query(koneksiDB(), $query);

        if (!$result) {
            return 0;
        } else {
            return 1;
        }
    }

    function selectPageDataTDokumen($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT * FROM tb_dokumen ORDER BY tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectPageKebijakanTDokumen($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT d.id_dokumen, d.nama_dokumen, d.kategori, d.status, 
                        d.tgl_up, d.tgl_berlaku, b.nama_bidang, d.dokumen
                    FROM tb_dokumen d
                    JOIN tb_bidang b ON d.id_bidang = b.id
                    WHERE d.kategori = 'KEBIJAKAN'
                    ORDER BY d.tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }
    function selectPageProsedurTDokumen($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT d.id_dokumen, d.nama_dokumen, d.kategori, d.status, 
                        d.tgl_up, d.tgl_berlaku, b.nama_bidang, d.dokumen
                    FROM tb_dokumen d
                    JOIN tb_bidang b ON d.id_bidang = b.id
                    WHERE d.kategori = 'PROSEDUR'
                    ORDER BY d.tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectPageInovasiTDokumen($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT d.id_dokumen, d.nama_dokumen, d.kategori, d.status, 
                        d.tgl_up, d.tgl_berlaku, b.nama_bidang, d.dokumen
                    FROM tb_dokumen d
                    JOIN tb_bidang b ON d.id_bidang = b.id
                    WHERE d.kategori = 'HASIL INOVASI DAN BENCHMARKING'
                    ORDER BY d.tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectPageInstruksiTDokumen($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT d.id_dokumen, d.nama_dokumen, d.kategori, d.status, 
                        d.tgl_up, d.tgl_berlaku, b.nama_bidang, d.dokumen
                    FROM tb_dokumen d
                    JOIN tb_bidang b ON d.id_bidang = b.id
                    WHERE d.kategori = 'INSTRUKSI KERJA'
                    ORDER BY d.tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectPageKontrakTDokumen($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT d.id_dokumen, d.nama_dokumen, d.kategori, d.status, 
                        d.tgl_up, d.tgl_berlaku, b.nama_bidang, d.dokumen
                    FROM tb_dokumen d
                    JOIN tb_bidang b ON d.id_bidang = b.id
                    WHERE d.kategori = 'KONTRAK DAN PERJANJIAN'
                    ORDER BY d.tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectPageLainnyaTDokumen($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT d.id_dokumen, d.nama_dokumen, d.kategori, d.status, 
                        d.tgl_up, d.tgl_berlaku, b.nama_bidang, d.dokumen
                    FROM tb_dokumen d
                    JOIN tb_bidang b ON d.id_bidang = b.id
                    WHERE d.kategori = 'LAINNYA'
                    ORDER BY d.tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectPageManajemenTDokumen($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT d.id_dokumen, d.nama_dokumen, d.kategori, d.status, 
                        d.tgl_up, d.tgl_berlaku, b.nama_bidang, d.dokumen
                    FROM tb_dokumen d
                    JOIN tb_bidang b ON d.id_bidang = b.id
                    WHERE d.kategori = 'MANAJEMEN RISIKO'
                    ORDER BY d.tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function selectPageSistemTDokumen($awal, $batas)
    {
        $conn = koneksiDB();
        $query = "SELECT d.id_dokumen, d.nama_dokumen, d.kategori, d.status, 
                        d.tgl_up, d.tgl_berlaku, b.nama_bidang, d.dokumen
                    FROM tb_dokumen d
                    JOIN tb_bidang b ON d.id_bidang = b.id
                    WHERE d.kategori = 'SISTEM INFORMASI MANAJEMEN'
                    ORDER BY d.tgl_up DESC LIMIT $awal, $batas"; // Menambahkan ORDER BY sebelum LIMIT
        $result = mysqli_query($conn, $query);
        return $result;
    }
    function searchDataTDokumen($cari)
    {
        $query = "SELECT * FROM tb_dokumen WHERE CONCAT(id_berkas, nama_berkas, kategori, tgl_up) LIKE '%" . $cari . "%'";
        $result = mysqli_query(koneksiDB(), $query);
        return $result;
    }

    function countTotalDocumentsTDokumen()
    {
        $query = "SELECT COUNT(*) as total FROM tb_dokumen";
        $result = mysqli_query(koneksiDB(), $query);
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    }

    function countActiveDocumentsTDokumen()
    {
        $query = "SELECT COUNT(*) as total FROM tb_dokumen WHERE status = 'Aktif'";
        $result = mysqli_query(koneksiDB(), $query);
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    }

    function countInactiveDocumentsTDokumen()
    {
        $query = "SELECT COUNT(*) as total FROM tb_dokumen WHERE status = 'Tidak Aktif'";
        $result = mysqli_query(koneksiDB(), $query);
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    }

    $conn = koneksiDB();
    ?>
