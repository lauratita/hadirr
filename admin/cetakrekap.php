<?php
include "../koneksi.php";

$i = $_GET['id_kelas'];
$kelas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT `kelas` FROM `kelas` where `id_kelas`='$i'"));
$kelass = $kelas['kelas'];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Hasil Rekap</title>
</head>
<body>

    <?php
    header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Rekap Siswa $kelass.xls");
    ?>

    <center>
        <h2>Hasil Rekap <?= $kelass ?></h2>
    </center>
    <table border="1">
        <tr>
            <th>NO</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Hadir</th>
            <th>Sakit</th>
            <th>Izin</th>
            <th>Alpa</th>
        </tr>
        <?php
        // $tgl1 = strtotime($_GET['tgl1']);
        // $tgl2last = $_GET['tgl2'] . " 23:59:00";
        // $tgl2 = strtotime($tgl2last);

        if($_GET['id_kelas']) 
        $idkelas = $_GET['id_kelas'];
        $tgl1 = strtotime($_GET['tgl1']);
        $tgl2last = $_GET['tgl2'] . " 23:59:00";
        $tgl2 = strtotime($tgl2last);

        //echo $tgl1,$tgl2;

        $no = 1;
        $qrec = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas = '$idkelas' ");
        while($rec = mysqli_fetch_array($qrec)){
            $nis = $rec['nis'];
                $qhadir = mysqli_query($koneksi, "select count(keterangan) as hadir from absensi where keterangan = 1 and nis = '$nis' and tanggal between '$tgl1' and '$tgl2' ");
                    $hadir = mysqli_fetch_array($qhadir);

                    $qsakit = mysqli_query($koneksi, "select count(keterangan) as sakit from absensi where keterangan = 2 and  nis = '$nis' and tanggal between '$tgl1' and '$tgl2' ");
                    $sakit = mysqli_fetch_array($qsakit);

                    $qizin = mysqli_query($koneksi, "select count(keterangan) as izin from absensi where keterangan = 3 and  nis = '$nis' and tanggal between '$tgl1' and '$tgl2' ");
                    $izin = mysqli_fetch_array($qizin);

                    $qalpa = mysqli_query($koneksi, "select count(keterangan) as alpa from absensi where keterangan = 4 and  nis = '$nis' and tanggal between '$tgl1' and '$tgl2' ");
                    $alpa = mysqli_fetch_array($qalpa);
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $rec['nis']?></td>
                <td><?= $rec['nama']?></td>
                <td><?= $hadir['hadir']?></td>
                <td><?= $sakit['sakit']?></td>
                <td><?= $izin['izin']?></td>
                <td><?= $alpa['alpa']?></td>
            </tr>
            <?php
        }
            ?>
    </table>
    <script>
        window.print()
    </script>
        
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>