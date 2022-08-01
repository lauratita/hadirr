<?php
session_start();
include "../koneksi.php";

// session_start();
if (!isset($_SESSION['username'])) {
  header("location: login.php");
}

if (!empty($_GET['id_kelas'])) {
  $id_kelas = $_GET['id_kelas'];
} else {
  $id_kelas = "";
}

function selected($a, $b)
{

  if ($a == $b) {
    $msg = "selected=selected";
  } else {
    $msg = "";
  }

  return $msg;
}


// mysqli_query($koneksi, "INSERT INTO absensi VALUES ('nisn', 'nama')");
// header("location: daftarsiswa.php");

if (isset($_POST['btnAbsen'])) {
  // $idkelas = $_GET['id_kelas'];
  //$jum = mysqli_num_rows(mysqli_query($koneksi, "Select * from siswa where id_kelas =" . $_GET['id_kelas']));
  //echo $_GET['id_kelas'];
  //$nis = $_POST[''];
  $jum = mysqli_query($koneksi, "Select * from siswa where id_kelas =" . $_GET['id_kelas']);
  $idkls = $_POST['idkelas'];
  while ($sim = mysqli_fetch_array($jum)) {

    $nis = $_POST['nis' . $sim['nis']];
    // echo $nis; 
    $keterangan = $_POST['ket' . $sim['nis']];
    //     $tgl = date('Y-m-d', time());
    $tgl = time();
    mysqli_query($koneksi, "insert into absensi values (null, '$nis','$tgl','$keterangan' )");
  }
  header("location:absensi.php?id_kelas=$idkls&stat=1");
}
if (isset($_POST['btnUpdate'])) {
  $jum = mysqli_query($koneksi, "Select * from siswa where id_kelas =" . $_GET['id_kelas']);
  $idkls = $_POST['idkelas'];
  while ($sim = mysqli_fetch_array($jum)) {

    $idabsen = $_POST['idabsen' . $sim['nis']];
    // echo $nis; 
    $keterangan = $_POST['ket' . $sim['nis']];
    //     $tgl = date('Y-m-d', time());

    mysqli_query($koneksi, "update absensi set keterangan = '$keterangan' where id_absen = '$idabsen'");

    //  echo "update absensi set keterangan = '$keterangan' where id_absen = '$idabsen'";
  }
  header("location:absensi.php?id_kelas=$idkls&stat=1");
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
        padding-left: 0.9rem;
        padding-right: 0.9rem;
        padding-top: 0.4rem;
        padding-bottom: 0.4rem
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

      label {
        margin-left: 40%;
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

<section class="services" id="services">

<h1 class="heading">RE<span>KAP</span> </h1>

  <!-- Rekap -->
  <div class="box-container">

    <div class="box">
    <div class="">
    <div class="row justify-content-md-center">
      <div class="col col-lg-5"></div>
    </div>
          <form method="GET" action="">
          <div class="form-row">
          <div class="col-6">
            <label for="tanggal"><h4>Dari Tanggal</h4></label>
            <input type="date" name="tgl1" value="" class="form-control" id="tanggal">
          </div>
          <div class="col-6">
            <label for="tanggal2"><h4>Sampai Tanggal</h4></label>
            <input type="date" name="tgl2" value="" class="form-control" id="tanggal2">
          </div>
          </div>
    </div>
          <br>
          <h4>Pilih Kelas</h4>
          <select name="id_kelas" class="form-control" aria-label="Default select example">
            <option selected>Pilih Kelas</option>

            <?php
            $qkat = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY kelas ASC");
            while ($rkat = mysqli_fetch_array($qkat)) {
            ?>

              <option value="<?= $rkat['id_kelas'] ?>" <?= selected($id_kelas, $rkat['id_kelas']) ?>>
                <?= $rkat['kelas'] ?>
              </option>
            <?php  }
            ?>

            <!-- <input type="submit" class="btn btn-primary" value="Tampilkan" style="display: inline;" /> -->
          </select>
        <button type="submit" class="btn btn-sm btn-success">Tampilkan</button>

      <!-- <input type="submit" value="Input" class="btn btn-primary"> -->



  </form>
  <br>
  <br>

  <!-- Tabel Rekap -->


            <br>
            <form action="" method="POST">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">NO</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Hadir</th>
                    <th scope="col">Sakit</th>
                    <th scope="col">Izin</th>
                    <th scope="col">Alpa</th>
                    
                  </tr>
                </thead>

                <tbody>
                  <?php

                  $no = 1;
                  
                  if((empty($_GET['tgl1'])) || (empty($_GET['tgl2'])) || (empty($_GET['id_kelas']))){
                    // $tgl1 = strtotime($_GET['tgl1']);
                    // $tgl2last = $_GET['tgl2'] . " 23:59:00";
                    // $tgl2 = strtotime($tgl2last);
                    // echo "Pilih Tanggal dan Kelas";
                  } else
                  {

                  $tgl1 = strtotime($_GET['tgl1']);
                  $tgl2last = $_GET['tgl2'] . " 23:59:00";
                  $tgl2 = strtotime($tgl2last);

                  if(isset($_GET['id_kelas'])){
                    $idkelas = $_GET['id_kelas'];                 
                    $qrec = mysqli_query($koneksi, "select * from siswa where id_kelas =" . $_GET['id_kelas']);
                    } else {
                      $qrec = mysqli_query($koneksi, "select * from siswa");
                    }
                  while ($rec = mysqli_fetch_array($qrec)) {
                    $nis = $rec['nis'];
                    $qhadir = mysqli_query($koneksi, "select count(keterangan) as hadir from absensi where keterangan = 1 and nis = '$nis' and tanggal between '$tgl1' and '$tgl2'");
                    $hadir = mysqli_fetch_array($qhadir);

                    $qsakit = mysqli_query($koneksi, "select count(keterangan) as sakit from absensi where keterangan = 2 and  nis = '$nis' and tanggal between '$tgl1' and '$tgl2'");
                    $sakit = mysqli_fetch_array($qsakit);

                    $qizin = mysqli_query($koneksi, "select count(keterangan) as izin from absensi where keterangan = 3 and  nis = '$nis' and tanggal between '$tgl1' and '$tgl2'");
                    $izin = mysqli_fetch_array($qizin);

                    $qalpa = mysqli_query($koneksi, "select count(keterangan) as alpa from absensi where keterangan = 4 and  nis = '$nis' and tanggal between '$tgl1' and '$tgl2'");
                    $alpa = mysqli_fetch_array($qalpa);

                  // if (isset($_GET['id_kelas'])){
                  //   $idkelas = $_GET['id_kelas'];
                  //   $qrec = mysqli_query($koneksi, "select * from siswa where id_kelas = '$idkelas' ");
                  // } else {
                  //   $qrec = mysqli_query($koneksi, "select * from siswa");
                  // }
                  //   while ($rec = mysqli_fetch_array($qrec)){
                    
                    ?>
                    <tr>
                      <th scope="row"><?= $no ?></th>
                      <td><?= $rec['nis']?></td>
                      <td><?= $rec['nama']?></td>
                      <td><?= $hadir['hadir']?></td>
                      <td><?= $sakit['sakit']?></td>
                      <td><?= $izin['izin']?></td>
                      <td><?= $alpa['alpa']?></td>
                      
                      
                    </tr>
                    
                    <?php $no++;
                  } 
                }?>



                  <?php

                  // $tgl1 = strtotime($_GET['tgl1']);
                  // $tgl2last = $_GET['tgl2'] . " 23:59:00";
                  // $tgl2 = strtotime($tgl2last);

                  // $qrec = mysqli_query($koneksi, "select * from siswa where id_kelas =" . $_GET['id_kelas']);
                  // while ($rec = mysqli_fetch_array($qrec)) {
                  //   $nis = $rec['nis'];
                  //   $qsakit = mysqli_query($koneksi, "select count(keterangan) as sakit from absensi where keterangan = 2 and  nis = '$nis' and tanggal between '$tgl1' and '$tgl2'");
                  //   $sakit = mysqli_fetch_array($qsakit);

                  //   $qizin = mysqli_query($koneksi, "select count(keterangan) as izin from absensi where keterangan = 3 and  nis = '$nis' and tanggal between '$tgl1' and '$tgl2'");
                  //   $izin = mysqli_fetch_array($qizin);

                  //   $qalpa = mysqli_query($koneksi, "select count(keterangan) as alpa from absensi where keterangan = 4 and  nis = '$nis' and tanggal between '$tgl1' and '$tgl2'");
                  //   $alpa = mysqli_fetch_array($qalpa);


                  //   echo $rec['nama'] . " | s=" . $sakit['sakit'] . " i=" . $izin['izin'] . " a=" . $alpa['alpa'] . "  <br>";
                  // }

                  ?>
                </tbody>
              </table>
              </form>
              <a href="cetakrekap.php?id_kelas=<?= $idkelas ?>&tgl1=<?= $_GET['tgl1']?>&tgl2=<?= $_GET['tgl2']?>" target="_blank" class="btn btn-sm btn-success">EXPORT EXCEL</a>

          </div>
        </div>
      </div>
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