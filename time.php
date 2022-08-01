<?php
include('koneksi.php');
//hari ini 










$q=mysqli_query($koneksi, "select * from siswa where id_kelas = 1");
while($dt = mysqli_fetch_array($q))
{
    echo $dt['nama']." | " .cekabsen($koneksi,$dt['nis'],"1")."<br>";
}

?>


