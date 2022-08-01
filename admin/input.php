<?php
session_start();
include "../koneksi.php";

// session_start();
if (!isset($_SESSION['username'])) {
  header("location: login.php");
}


// INPUT SISWA
if(isset($_POST["tampilkelas"])){
    $nis = $_POST['nis'];
    $nama = $_POST['namasiswa'];
    $jenis = $_POST['jeniskelamin'];
    $alamat = $_POST['alamat'];
    $idkls = $_POST['id_kelas'];

    // echo "$nis, $nama, $jenis, $alamat, $idkls";
    mysqli_query($koneksi, "INSERT INTO siswa VALUES ('$nis', '$nama', '$jenis', '$alamat','$idkls')");
    echo "<script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>";
    // header("location: index.php");

}

// DELETE SISWA
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $idkls = $_GET['id_kelas'];
    mysqli_query($koneksi, "DELETE FROM siswa WHERE nis = '$id' ");
    echo "<script>
                alert('data berhasil dihapus!');
                document.location.href = 'index.php?id_kelas=$idkls';
            </script>";
    // header("location:index.php");
  }

// UPDATE SISWA
if(isset($_POST['btnUpdate'])){

    $nis = $_POST['nis'];
    $nama = $_POST['namasiswa'];
    $jenis = $_POST['jeniskelamin'];
    $alamat = $_POST['alamat'];
    $idkls = $_POST['id_kelas'];

    // echo "$nis,$nama,$jenis,$alamat,$idkls";
    mysqli_query($koneksi, "UPDATE siswa SET
    id_kelas = '$idkls', nama = '$nama', jenis_kelamin = '$jenis', alamat = '$alamat' WHERE nis = '$nis' ");
    echo "<script>
        alert('data berhasil diubah!');
        document.location.href = 'index.php?id_kelas=$idkls';
        </script>";
    // header("location:index.php");
    
}

?>


<!doctype html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Website Hadirr</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
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
   
  </head>
  <body>


  <!-- header section starts  -->

  <header class="header">

<a href="" class="logo"> <i class=""></i> Hadirr </a>

<nav class="navbar">
        <!-- <a href="#home">Home</a> -->
        <a href="index.php">Daftar Siswa</a>
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

<!-- header section ends -->


  <section class="services" id="services">
<!-- Input Siswa -->
<h1 class="heading">TAMBAH<span> SISWA </span> </h1>

<div class="box-container">

<div class="box"> 
      <form action="" method="POST">
          <div class="form-group">
          <label for="nis"><h4>NIS</h4></label>
            <input type="text" name="nis" class="form-control" placeholder="NIS" id="nis" required>
          </div>

          <div class="form-group">
          <label for="nmsiswa"><h4>Nama</h4></label>
            <input type="text" name="namasiswa" class="form-control" placeholder="Nama Siswa" id="nmsiswa">
          </div>

          <div class="md-3">
          <label for="jnsklmn"><h4>Jenis Kelamin</h4></label>
            <select name="jeniskelamin" class="form-control" id="jnsklmn">
              <option selected>Pilih Jenis Kelamin</option>
              <option value="L">Laki-laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>
          <br>
          
          <div class="form-group">
          <label for="alamat"><h4>Alamat</h4></label>
            <textarea name="alamat" rows="5" class="form-control" id="alamat"></textarea>
          </div>

          <div class="mb-3">
          <label for="kelas"><h4>Kelas</h4></label>
            <select name="id_kelas" class="form-control" id="kelas">
              <option selected>Pilih Kelas</option>

              <?php 
              $qkat = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY kelas ASC");
              while($rkat = mysqli_fetch_array($qkat)){
                ?>
                <option value="<?= $rkat['id_kelas'] ?>" >
                    <?= $rkat['kelas']?>
                    </option>
              <?php }
              ?>
            </select>
          </div>

          <input type="submit" class="btn btn-success" value="Tambahkan" name="tampilkelas" />

          <!-- <input type="submit" class="btn btn-primary" value="Tambahkan" name="tampilkelas" /> -->
        </div>
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

