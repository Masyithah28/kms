<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dokumen Audit</title>
    <link rel="icon" type="image/x-icon" href="../css/icon.jpeg">
    <link rel="stylesheet" href="../css/all-user.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
<?php include '../koneksi.php';?>

<h1>PENCARIAN DAFTAR DOKUMEN</h1>

<div class="pencarian">
<form action="pencarian-user.php" method="get">
 <input class="pencarian2" type="text" name="cari" placeholder="Search Kode... Nama... Kategori ...">
</form>
</div>

<div class="sidenav">
        <img href="index-admin.php" src="../css/LOGO-CORP.png" alt="logo pcs">
        <br /> <br />  
        <a class="aktivsearch" href="pencarian-user.php">PENCARIAN</a>
        <br /> 
        <a href="home-user.php">HOME MENU</a> 
        <a href="index.php">DAFTAR DOKUMEN</a>
        <a href="index-user1.php">DOKUMEN KEBIJAKAN</a>
        <a href="index-user2.php">DOKUMEN PROSEDUR</a>
        <a href="index-user3.php">DOKUMEN INSTRUKSI KERJA</a>
        <a href="index-user4.php">DOKUMEN MANAJEMEN RISIKO</a>
        <a href="index-user5.php">DOKUMEN SISTEM INFORMASI MANAJEMEN</a>
        <a href="index-user6.php">DOKUMEN HASIL INOVASI & BENCHMARKING</a>
        <a href="index-user7.php">DOKUMEN LAINNYA</a>
           <br /> <br /> <br /> <br /> 
        <a class="aktivlogin" href="Login.php">LOGIN</a>
</div>

<?php 
if(isset($_GET['cari'])){
 $cari = $_GET['cari'];
}
?>

    <table class="fl-table">
              <tr style="font-size: 20px;">
                <th style="width: 50px;">NO</th>
                <th style="width: 400px;">KODE</th>
                <th style="width: 1700px;">NAMA</th>
                <th style="width: 400px;">KATEGORI</th>
                <th style="width: 100px;">TANGGAL UPLOAD</th>
                <th style="width: 150px;">TYPE</th>
                <th style="width: 150px;">UKURAN</th>
                <th style="width: 650px;">AKSI</th>
              </tr>
<?php
$result = selectAllData();

        if (isset($_GET['cari'])){
            $cari = $_GET['cari'];
            $data = searchData($cari);
        }else{
                return $result;
        }


        $nomor_urut = 1;
        while($row = mysqli_fetch_array($data)){
                ?>
        
                <tr>
                    <td><?php echo $nomor_urut++; ?></td>
                    <td><?php echo $row['id_berkas']; ?></td>
                    <td><?php echo $row['nama_berkas']; ?></td>
                    <td><?php echo $row['kategori']; ?></td>
                    <td><?php echo $row['tgl_up']; ?></td>
                    <td><?php echo strtoupper($row['ekstensi']) ?></td>
                    <td><?php echo number_format($row['size']/(1024*1024), 2) ?>MB</td> 
                    <td><button class="buttonDownload" onclick="document.location='../aksiDownload.php?url=<?php echo $row['berkas'] ?>'">Download</button>
                        
                        <a class="Show" href="../aksiShow.php?url=<?php echo $row['berkas'] ?>" target="_blank">Show</a>                  
                    </td>
                </tr>
        <?php }
?>        
    </table>
    

</body>
</html>