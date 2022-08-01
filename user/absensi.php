<?php
session_start();
error_reporting(0);
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


// mysqli_query($koneksi, "INSERT INTO absensi VALUES ('nisn', 'nama')");
// header("location: daftarsiswa.php");

// input presensi
 if (isset($_POST['btnAbsen'])) {
 // $idkelas = $_GET['id_kelas'];
  //$jum = mysqli_num_rows(mysqli_query($koneksi, "Select * from siswa where id_kelas =" . $_GET['id_kelas']));
   //echo $_GET['id_kelas'];
   //$nis = $_POST[''];
   $jum = mysqli_query($koneksi, "Select * from siswa where id_kelas =" . $_GET['id_kelas']);
   $idkt = $_POST['idkelas'];
  while ($sim = mysqli_fetch_array($jum)) {

     $nis = $_POST['nis'.$sim['nis']];
    // echo $nis; 
    $keterangan = $_POST['ket'.$sim['nis']];
//     $tgl = date('Y-m-d', time());
$tgl = time();
     mysqli_query($koneksi, "insert into absensi values (null, '$nis','$tgl','$keterangan' )");
   }
   header("location:absensi.php?id_kelas=$idkt&stat=1");
 }

//  update presensi
if(isset($_POST['btnUpdate'])){
  $jum = mysqli_query($koneksi, "Select * from siswa where id_kelas =" . $_GET['id_kelas']);
  $idkt = $_POST['idkelas'];
  while ($sim = mysqli_fetch_array($jum)) {

     $idabsen = $_POST['idabsen'.$sim['nis']];
    // echo $nis; 
    $keterangan = $_POST['ket'.$sim['nis']];
//     $tgl = date('Y-m-d', time());

     mysqli_query($koneksi, "update absensi set keterangan = '$keterangan' where id_absen = '$idabsen'");
  
//  echo "update absensi set keterangan = '$keterangan' where id_absen = '$idabsen'";
   }
  header("location:absensi.php?id_kelas=$idkt&stat=1");
}

// function isicari()
// {
//     if(isset($_GET['id_kelas']))
//     {
//         echo $_GET['id_kelas'];
//     } else
//     {
//         echo "";
//     }
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
        <!-- <a href="rekap.php">Rekap</a> -->
        <a href="#"></a>
        <a href="#"></a>
        <div class="action" onclick="menuToggle();">
        <div class="profile">
            <img src="../img/man.png" alt="">
        </div>
        <div class="menu">
            <h3><?=$_SESSION['username']?><br><br><span>User</span></h3>
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

  <!-- about section starts  -->

  <section class="services" id="services">

<h1 class="heading"> <span>Pres</span>ensi</h1>


  <!-- Absensi -->
  
  <div class="box-container">
    <div class="box">
    <form method="GET" action="">
        <h4>Tanggal</h4>
        <input type="" value="<?= date('Y-m-d', time()) ?>" class="form-control" readonly>
        <br>
        <!-- <h4>Pilih Kelas</h4>
          <select name="id_kelas" class="form-control" aria-label="Default select example">
            <option selected>Pilih Kelas</option>
            <?php
            $qkat = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY kelas ASC");
            while ($rkat = mysqli_fetch_array($qkat)) {
            ?>

              <option value="<?= $rkat['id_kelas'] ?>" <?= selected($id_kelas,$rkat['id_kelas'])?> >
                <?= $rkat['kelas'] ?>
              </option>
            <?php  }
            ?>
          </select>
        <button type="submit" class="btn btn-success">Tampilkan</button> -->
    </form>
  <br>


  <!-- Tabel Absensi -->
          <div class="card-table">
            <br>
            <table class="table table-bordered">
            <form action="" method="post">
              <thead>
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">NIS</th>
                  <th scope="col">Nama</th>
                  <th colspan="4"> Keterangan </th>
                </tr>
              </thead>
          </div>
              <tbody>

                <?php
                $no = 1;
                $sesi = $_SESSION['username'];
                // if(isset($_GET['id_ketua'])){
                //   $kt = $_GET['id_ketua'];
                // }
                   $kelas = mysqli_query($koneksi, "SELECT id_kelas FROM ketua WHERE username = '$sesi' ");
                   $qkelas = mysqli_fetch_assoc($kelas);
                   $ketkel = $qkelas['id_kelas'];
                    //echo $ketkel;
                   $ketua = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas = '$ketkel' ");
                   while($qketua = mysqli_fetch_array($ketua)) {
                // if (isset($_GET['id_kelas'])) {
                //   $idkelas = $_GET['id_kelas'];
                  
                //   $qrec = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas = '$idkelas' ");
                // } else {
                //   $qrec = mysqli_query($koneksi, "SELECT * FROM siswa");
                // }
                // while ($rec = mysqli_fetch_array($qrec)) {
                ?>
                
                  <tr id=<?= $qketua['nis'] ?>>
                    <th scope="row"><?= $no ?></th>
                    <td>
                      <?= $qketua['nis'] ?>
                      <input type="hidden" name="nis<?=$qketua['nis']?>" value="<?= $qketua['nis'] ?>">
                      <input type="hidden" value="<?= cekidabsen($koneksi,$qketua['nis']) ?>" name="idabsen<?= $qketua['nis'] ?>" />
                      <?php $set = cekidabsen($koneksi,$qketua['nis']); ?>
                    </td>
                    <td><?= $qketua['nama'] ?> </td>
                    <td>
                      <div class="form-check form-check-inline">
                        <input value="1" <?=cekabsen($koneksi,$qketua['nis'],"1")?> class="form-check-input" type="radio" name="ket<?= $qketua['nis'] ?>" id="" value="hadir" onclick="warna('#FFFFFF','<?= $qketua['nis'] ?>')" checked>
                        <label class="form-check-label" for="">
                          Hadir
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check form-check-inline">
                        <input value ="2" <?=cekabsen($koneksi,$qketua['nis'],"2")?> class="form-check-input" type="radio" name="ket<?= $qketua['nis'] ?>" id="" value="sakit" onclick="warna('#8CC0DE','<?= $qketua['nis'] ?>')">
                        <label class="form-check-label" for="">
                          Sakit
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check form-check-inline">
                        <input value="3" <?=cekabsen($koneksi,$qketua['nis'],"3")?>  class="form-check-input" type="radio" name="ket<?= $qketua['nis'] ?>" id="" value="izin" onclick="warna('#FBC687','<?= $qketua['nis'] ?>')">
                        <label class="form-check-label" for="">
                          Izin
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="form-check form-check-inline">
                        <input value="4" <?=cekabsen($koneksi,$qketua['nis'],"4")?> class="form-check-input" type="radio" name="ket<?= $qketua['nis'] ?>" id="" value="alpha" onclick="warna('#EF9F9F','<?= $qketua['nis'] ?>')">
                        <label class="form-check-label" for="">
                          Alpa
                        </label>
                      </div>
                    </td>
                  </tr>
                <?php $no++;
                } ?>
              </tbody>

            </table>
            <input type="hidden" value="<?= $ketkel ?>" name="idkelas" />
            
                <?php
                if(!empty($set)){
                  ?>
                    <input type="submit" class="btn btn-warning" value="Update Data" name="btnUpdate" /> 
                  <?php 
                } else {
                ?>
            <input type="submit" class="btn btn-success" value="Simpan Data" name="btnAbsen" /> 
            <?php } ?>
            </form>
            </div>
  </div>
</section>

<script>
  function warna(color,idsiswa){
    document.getElementById(idsiswa).style.background=color;
  }
</script>

  <!-- about section ends  -->

    <!-- Optional JavaScript -->
    <script src="js/script.js"></script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


  </body>
</html>