<?php

include "koneksi.php";
echo date("d - F - Y H:i:s");
echo "<br/>";
$tampil = mysqli_query($koneksi, "SELECT * FROM absensi order by id_absen limit 2");
while($rec = mysqli_fetch_array($tampil)){
echo date("d - F H:i:s", $rec['tanggal']);
echo "<br/>".$rec['tanggal']."<br/>";

}
?>