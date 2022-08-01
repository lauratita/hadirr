<?php
include "../koneksi.php";
if(isset($_POST["inputidkelas"])){

    $idkelas = $_POST['kelas'];

    mysqli_query($koneksi, "INSERT INTO kelas VALUES ('', '$idkelas')");

}


?>

<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <!-- <tittle> Input Id Kelas </tittle> -->
    </head>
    <body>

    <!-- Input Id Kelas -->
    <div class="container-fluid" style="width: 800px; margin-top: 30px;">
    <h3>Input Id Kelas</h3>
    <form action="" method="POST">

    <div class="mb-3">
        <label for="" class="">Kelas</label>

        <input type="text" class="form-control" name="kelas"></div>
        <input type="submit" name="inputidkelas" value="Input" class="btn btn-primary" />
    </div>
    </form>
    <br>

    <!-- Data Id Kelas -->
    <div class="container-fluid" style="width: 800px; margin-top: 25px;">
    <h3>Id Kelas</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">NO</th>
                <th scope="col">Kelas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $qrec = mysqli_query($koneksi, "SELECT * FROM kelas");
            while ($rec = mysqli_fetch_array($qrec)){
                ?>
                <tr>
                    <th scope="row"><?= $no ?></th>
                    <td><?= $rec['kelas'] ?></td>
                </tr>
            <?php $no++; } ?>
        </tbody>
    </table>
    </div>
    </div>
    </body>
</html>