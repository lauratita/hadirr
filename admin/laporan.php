<?php
include "../koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekap</title>
</head>
<body>

<div class="container">
    <h2>Hasil Rekap</h2>
    <div class="data-tables datatable-dark">
        <table class="table table-bordered" id="export">
            <thead>
            <tr>
            <th>NO</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Hadir</th>
            <th>Sakit</th>
            <th>Izin</th>
            <th>Alpa</th>
        </tr>
            </thead>
            <tbody>
            <?php
        if($_GET['id_kelas']) $idkelas = $_GET['id_kelas'];
        $no = 1;
        $qrec = mysqli_query($koneksi, "SELECT * FROM siswa  WHERE id_kelas = '$idkelas' ");
        while($rec = mysqli_fetch_array($qrec)){
            $nis = $rec['nis'];
                    $qhadir = mysqli_query($koneksi, "select count(keterangan) as hadir from absensi where keterangan = 1 and nis = '$nis' ");
                    $hadir = mysqli_fetch_array($qhadir);

                    $qsakit = mysqli_query($koneksi, "select count(keterangan) as sakit from absensi where keterangan = 2 and  nis = '$nis' ");
                    $sakit = mysqli_fetch_array($qsakit);

                    $qizin = mysqli_query($koneksi, "select count(keterangan) as izin from absensi where keterangan = 3 and  nis = '$nis' ");
                    $izin = mysqli_fetch_array($qizin);

                    $qalpa = mysqli_query($koneksi, "select count(keterangan) as alpa from absensi where keterangan = 4 and  nis = '$nis' ");
                    $alpa = mysqli_fetch_array($qalpa);
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $rec['nis'] ?></td>
                <td><?php echo $rec['nama'] ?></td>
                <td><?php echo $hadir['hadir']?></td>
                <td><?php echo $sakit['sakit']?></td>
                <td><?php echo $izin['izin']?></td>
                <td><?php echo $alpa['alpa']?></td>
            </tr>
            <?php
        }
            ?>
            </tbody>
        </table>



    </div>
</div>

<script>
    $(document).ready(function() {
        $('#export').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ]
        }) ;
    }) ;
</script>
    
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>