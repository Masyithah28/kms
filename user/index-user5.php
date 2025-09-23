<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dokumen Sistem Informasi Manajemen</title>
    <link rel="icon" type="image/x-icon" href="../css/icon.jpeg">
    <link rel="stylesheet" href="../css/all-user.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<h1>DAFTAR DOKUMEN SISTEM INFORMASI MANAJEMEN </h1>

<?php
include '../koneksi.php';
?>

<table class="fl-table">
              <tr style="font-size: 20px;">
                <th style="width: 50px;">NO</th>
                <th style="width: 400px;">KODE</th>
                <th style="width: 1700px;">NAMA</th>
                <th style="width: 400px;">KATEGORI</th>
                <th style="width: 100px;">TANGGAL UPLOAD</th>
                <th style="width: 650px;">AKSI</th>
              </tr>
              <?php

$nomor_urut = 0;
$result = selectOnlydokumen5();
$countData = mysqli_num_rows($result);

$batas = 10;
$page = isset($_GET['p']) ? (int) $_GET['p'] :1;
$startpage = ($page>1) ? ($page * $batas) - $batas : 0;
$totalpage = ceil($countData / $batas);

$prev = $page -1;
$next = $page + 1;

$result = selectPageData($startpage, $batas);

if ($countData < 1){
    ?>
    <tr>
        <td colspan="7" style="text-align: center; font-weight: bold; font-size: 20px; padding: 5px; color: red;">TIDAK ADA DATA</td>
    </tr>
    <?php
}
else{
  $nomor_urut = $startpage + 1;
while ($row = mysqli_fetch_assoc($result)) {


    ?>
        <tr>
            <td><?php echo $nomor_urut++; ?></td>
            <td><?php echo $row['id_berkas']; ?></td>
            <td><?php echo $row['nama_berkas']; ?></td>
            <td><?php echo $row['kategori']; ?></td>
            <td><?php echo $row['tgl_up']; ?></td>
            <td><button class="buttonDownload" onclick="document.location='../aksiDownload.php?url=<?php echo $row['berkas'] ?>'">Download</button>
            
                        <a class="Show" href="../aksiShow.php?url=<?php echo $row['berkas'] ?>" target="_blank">Show</a>                  
                </td>
        </tr>

<?php }}

?>
</table>

<div style="margin-left: 900px; text-align: center;">
<p class="page_link">
<a <?php if ($page > 1) echo "href='?p=$prev'" ?>>
      &laquo; Previous
</a>
</p>
<?php for ($i = 1; $i <= $totalpage; $i++) {?>
  <p class="page_link <?php if ($page==$i) echo "selected_item"?>">
    <a href="?p=<?php echo $i ?>">
      <?=$i ?>
    </a>
  </p>
<?php } ?>

<P class="page_link">
  <a <?php if ($page < $totalpage) echo "href='?p=$next'"?>>
      next &raquo;
  </a>
</P>
</div>

<div class="sidenav">
        <img src="../css/LOGO-CORP.png" alt="logo pcs">
        <br /> <br />
        <a class="aktivsearch" href="pencarian-user.php">PENCARIAN</a>
        <br /> 
        <a href="index.php">DAFTAR DOKUMEN</a>
        <a href="index-user1.php">DOKUMEN KEBIJAKAN</a>
        <a href="index-user2.php">DOKUMEN PROSEDUR</a>
        <a href="index-user3.php">DOKUMEN INSTRUKSI KERJA</a>
        <a href="index-user4.php">DOKUMEN MANAJEMEN RISIKO</a>
        <a class="aktiv" href="index-user5.php">DOKUMEN SISTEM INFORMASI MANAJEMEN</a>
        <a href="index-user6.php">DOKUMEN HASIL INOVASI & BENCHMARKING</a>
        <a href="index-user7.php">DOKUMEN LAINNYA</a>
           <br /> <br /> <br /> <br /> 
        <a class="aktivlogin" href="../Login.php">LOGIN</a>
</div>

</body>
</html>