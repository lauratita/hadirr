<?php
$server="localhost";
$dbusername="root";
$dbpassword="";

$dbname="hadirr";

$koneksi = mysqli_connect($server,$dbusername,$dbpassword,$dbname);
date_default_timezone_set("Asia/Bangkok");
if (!($koneksi)) {
    die("<script>alert('Connestion Failed')</script>");
}

function cekabsen($koneksi,$nis,$status)
{
    $hariini = strtotime(date('Y-m-d 00:00:00', time()));
    $harinanti = strtotime(date('Y-m-d 24:00:00', time()));

    $q=mysqli_query($koneksi,"select * from absensi where nis = $nis and tanggal between '$hariini' and '$harinanti' limit 1");
    $dt = mysqli_fetch_array($q);

    if (!empty($dt['keterangan']))
    {
        if($dt['keterangan'] == $status)
        {
            echo "checked";
        }else
        {
            echo "";
        }
    }else
    {
        echo "";
    }

    
    

}

function cekidabsen($koneksi,$nis)
{
    $hariini = strtotime(date('Y-m-d 00:00:00', time()));
    $harinanti = strtotime(date('Y-m-d 24:00:00', time()));

    $q=mysqli_query($koneksi,"select * from absensi where nis = $nis and tanggal between '$hariini' and '$harinanti' limit 1");
    $dt = mysqli_fetch_array($q);
    
    return $dt['id_absen'];
}

?>
