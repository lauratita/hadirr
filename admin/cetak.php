<?php
include "../koneksi.php";
$i = $_GET['id_kelas'];
$kelas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT `kelas` FROM `kelas` where `id_kelas`='$i'"));
$kelass = $kelas['kelas'];
// echo $kelass;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Daftar Siswa</title>
</head>
<body>

    <?php
    header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Siswa $kelass.xls");
    ?>

    <center>
        <h2>Daftar Siswa <?= $kelass ?></h2>
    </center>
    <table border="1">
        <tr>
            <th>NO</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
        </tr>
        <?php
        if($_GET['id_kelas']) $idkelas = $_GET['id_kelas'];
        $no = 1;
        $qrec = mysqli_query($koneksi, "SELECT * FROM siswa  WHERE id_kelas = '$idkelas' ");
        while($rec = mysqli_fetch_array($qrec)){
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $rec['nis'] ?></td>
                <td><?= $rec['nama'] ?></td>
                <td><?= $rec['jenis_kelamin'] ?></td>
                <td><?= $rec['alamat'] ?></td>
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