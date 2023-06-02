<?php
    //include koneksi
    include "koneksi.php";

    //tangkap parametere stat yang dikirim dari ajax
    $stat1 = $_GET['stat1'];
    if($stat1 == "ON")
    {
        //Ubah field relay menjadi 1
        mysqli_query($konek, "UPDATE tb_kontrol SET relay1=1");
        //berikan respon
        echo "ON";
    }
    else
    {
        //Ubah field relay menjadi 0    
        mysqli_query($konek,"UPDATE tb_kontrol SET relay1=0");
        //berikan respon
        echo "OFF";
    }
?>