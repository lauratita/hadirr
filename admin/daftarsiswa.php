<?php

session_start();
include "../koneksi.php";


// session_start();
if (!isset($_SESSION['username'])) {
  header("location: login.php");
}

if(!empty($_GET['id_kelas'])){
  $id_kelas = $_GET['id_kelas'];
} else
{
  $id_kelas = "";
}

function selected($a, $b)
{
  if ($a == $b){
    $msg = "selected=selected";
  } else {
    $msg = "";
  }
  return $msg;
}

// INPUT SISWA
if(isset($_POST["tampilkelas"])){
  $nis = $_POST['nis'];
  $nama = $_POST['namasiswa'];
  $jenis = $_POST['jeniskelamin'];
  $alamat = $_POST['alamat'];
  $idkls = $_POST['id_kelas'];


  mysqli_query($koneksi, "INSERT INTO siswa VALUES ('$nis', '$nama', '$jenis', '$alamat')");
  // header("location: daftarsiswa.php");

}

// DELETE SISWA
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $idkls = $_GET['id_kelas'];

  mysqli_query($koneksi, "DELETE FROM siswa WHERE nis = '$id' ");
  header("location:daftarsiswa.php");
}

// UPDATE SISWA
if(isset($_POST['btnUpdate'])){
    $nis = $_POST['nis'];
    $nama = $_POST['namasiswa'];
    $jenis = $_POST['jeniskelamin'];
    $alamat = $_POST['alamat'];
    $idkls = $_POST['id_kelas'];

    mysqli_query($koneksi, "UPDATE siswa SET nama = '$nama', jenis_kelamin = '$jenis', alamat = '$alamat', id_kelas = '$idkls' WHERE nis = '$nis'");
}

// function isicari()
// {
//   if(isset($_GET['cari']))
//   {
//     echo $_GET['cari'];
//   } else
//   {
//     echo "";
//   }
// }
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

  <!-- header section ends -->

<!-- services section starts  -->

<section class="services" id="services">

  <!-- Daftar Siswa -->

  <h1 class="heading"> DAFTAR <span>SISWA</span> </h1>

  <div class="box-container">

    <div class="box">
          <form method="GET" action="" >
          <label for="pilihkelas"><h4>Pilih Kelas</h4></label>
          <select name="id_kelas" class="form-control" aria-label="Default select example" id="pilihkelas">
          <option selected>Pilih Kelas</option>
    </div>
  </div>

          <?php
          $qkat = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY kelas ASC");
          while($rkat = mysqli_fetch_array($qkat)){
          ?>
                    
          <option value="<?= $rkat['id_kelas'] ?>" <?= selected($id_kelas,$rkat['id_kelas'])?> >
          <?= $rkat['kelas']?>
          </option>
          <?php }
          ?>
          
    <div class="col-auto"></div>
      <input type="submit" class="btn btn-success" value="Tampilkan" />
      <a href="input.php" class="btn btn-warning">Tambahkan Siswa</a> 
      </form> 
    <br> 
    <br>

    <!-- Tabel Absensi -->
          <div class="card-tabel">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th> Opsi </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                   $no = 1;
                  if(isset($_GET['id_kelas'])) {
                  $idkelas = $_GET['id_kelas'];
                  $qrec = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas = '$idkelas'");
                  }
                  else {
                    $qrec = mysqli_query($koneksi, "SELECT * FROM siswa");
                  }
                  while ($rec = mysqli_fetch_array($qrec)){
                    ?>
                    <tr>
                      <th scope="row"><?= $no ?></th>
                      <td><?= $rec['nis'] ?></td>
                      <td><?= $rec['nama'] ?></td>
                      <td><?= $rec['jenis_kelamin'] ?></td>
                      <td><?= $rec['alamat'] ?></td>

                      <td>
                        <a href="daftarsiswa.php?id=<?=$rec['nis']?>"
                        onclick="return confirm('Apakah anda yakin menghapus data tersebut?');"
                        class="btn btn-danger">Delete</a>
                        <a href="update.php?id=<?=$rec['nis']?>" class="btn btn-warning">Edit</a>
                    </td>
                    </tr>
                  <?php $no++; } ?>
                </tbody>
                </table>
    <br>
    <a href="cetak.php?id_kelas=<?= $idkelas ?>" target="_blank" class="btn btn-success">EXPORT EXCEL</a>
    

          </div>
</section>
  

  
    <!-- Optional JavaScript -->
    <script src="js/script.js"></script>

    <!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- Sweetalert2 JS -->
	<script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
	<!-- Page Script -->
	<script src="../assets/js/scripts.js"></script>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>

