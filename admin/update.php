<?php
session_start();
include "../koneksi.php";

// session_start();
if (!isset($_SESSION['username'])) {
  header("location: login.php");
}


if(isset($_GET['id'])){
    $id = $_GET['id'];

    $qSiswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis = '$id' ");
    $rec = mysqli_fetch_array($qSiswa);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../css/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="jquery.datetimepicker.min.css" class="">

    <!--My CSS-->
    <style>
      section {
        min-height: 500px;
        padding-top: 10rem;
      }

      .btn {
        border-radius: 0.50rem;
        font-size: 1rem;
      }

      .form-control {
        height: calc(3rem + 2px);
        border: 2px solid #28a745;
        border-radius: 0.50rem;
        font-size: 1.3rem;
      }

      .header .logo{
        color: #28a745;
      }

      body {
        background: #f5f5f5;
      }
    </style>
    <title>Official Website Hadirr</title>
  </head>
  <body>

  <!-- Navbar -->
  <!-- <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="background-color: #06bf00;">
  <h4>Hadirr</h4>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="daftarsiswa.php">Daftar Siswa <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="absensi.php">Absensi <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="rekap.php">Rekap <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Bantuan <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="logout.php">Log Out <span class="sr-only"></span></a>
      </li>
    </ul>
  </div>
</nav>
<br> -->

<header class="header">

    <a href="#" class="logo"> <i class=""></i> Hadirr </a>

    <nav class="navbar">
        <!-- <a href="#home">Home</a> -->
        <a href="daftarsiswa.php">Daftar Siswa</a>
        <a href="absensi.php">Presensi</a>
        <a href="rekap.php">Rekap</a>
        <a href="#"></a>
        <a href="#"></a>
        <div class="action" onclick="menuToggle();">
        <div class="profile">
            <img src="../img/man.png" alt="">
        </div>
        <div class="menu">
            <h3><?=$_SESSION['username']?><br><br><span>Admin</span></h3>
            <ul>
                <li><img src="../img/logout.png"><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
    </div>
    <script>
        function menuToggle(){
            const toggleMenu = document.querySelector('.menu')
            toggleMenu.classList.toggle('active')
        }
    </script>
    </nav>

    <div id="menu-btn" class="fas fa-bars"></div>

</header>

<section class="services" id="services">


<!-- Input Siswa -->
<!-- <br>
<div class="container-fluid">
  <div class="row justify-content-md-center">
    <div class="col-md-8 mt-2">
    <h2 class="alert text-center">Update Siswa</h2>   -->

    <h1 class="heading">UPDATE<span> SISWA </span> </h1>
    <div class="box-container">

    <div class="box">

      <form action="input.php" method="POST">
        <!-- <div class="card"> -->
          <!-- <div class="card-header">
            Input Siswa
          </div> -->
          <div class="form-group">
            <h4>NIS</h4>
            <input type="text" name="nis" readonly="readonly" class="form-control"  value="<?= $rec['nis'] ?>">
          </div>

          <div class="form-group">
            <h4>Nama</h4>
            <input type="text" name="namasiswa" class="form-control" value="<?= $rec['nama'] ?>">
          </div>

          <div class="md-3">
            <h4>Jenis Kelamin</h4>
            <select name="jeniskelamin" class="form-control">
              <option selected>Pilih Jenis Kelamin</option>
              <option value="L" <?php if($rec['jenis_kelamin'] == 'L') { ?> selected <?php } ?> >Laki-laki</option>
              <option value="P" <?php if($rec['jenis_kelamin'] == 'P') { ?> selected <?php } ?>> Perempuan</option>
              
            </select>
          </div>
          <br>


          <div class="form-group">
            <h4>Alamat</h4>
            <textarea name="alamat" rows="5" class="form-control" value=""><?= $rec['alamat'] ?></textarea>
          </div>

          <div class="mb-3">
            <h4>Kelas</h4>
            <select name="id_kelas" class="form-control" aria-label="Default select example">
                    <option selected>Pilih Kelas</option>
                    
                    <?php
                    $qkat = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY kelas ASC");
                    while($rkat = mysqli_fetch_array($qkat)){
                     ?>
                    <option value="<?= $rkat['id_kelas'] ?>" 
                    
                    <?php if($rec['id_kelas'] == $rkat['id_kelas']) { ?> selected=selected 
                    <?php } ?> >
                        
                    <?= $rkat['kelas']?></option>
                    <?php }
                    ?>
                    
                </select>
          </div>

          <!-- <div class="card-footer"> -->
          <input type="submit" class="btn btn-success" name="btnUpdate" value="Update" />
          </div>
          <!-- <input type="submit" class="btn btn-primary" value="Tambahkan" name="tampilkelas" /> -->
        
        <!-- <input type="submit" class="btn btn-primary" value="Tambahkan" name="tampilkelas" /> -->
      </form>
    </div>
  </div>
</div>
</section>
  
  
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>

