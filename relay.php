<?php
    //include koneksi
    include "koneksi.php";

    //tangkap parametere stat yang dikirim dari ajax
    $stat = $_GET['stat'];
    if($stat == "ON")
    {
        //Ubah field relay menjadi 1
        mysqli_query($konek, "UPDATE tb_kontrol SET relay=1");
        //berikan respon
        echo "ON";
    }
    else
    {
        //Ubah field relay menjadi 0    
        mysqli_query($konek,"UPDATE tb_kontrol SET relay=0");
        //berikan respon
        echo "OFF";
    }
?>