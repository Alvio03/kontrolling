<?php
    //Include koneksi
    include "koneksi.php";

    //baca yang dikirim data esp8266
    $suhu =$_GET['suhu'];
    $kelembaban = $_GET['kelembaban'];

    //simpan ke table tb_sensor
    //auto increment  1 / mengembalikan id menjadi 1 apabila dikosongkan
    mysqli_query($konek, "ALTER TABLE tb_sensor AUTO_INCREMENT=1");
    $simpan = mysqli_query($konek, "UPDATE tb_sensor SET suhu = '$suhu', kelembaban = '$kelembaban' WHERE id = 1");
    // $simpan = mysqli_query($konek, "insert into tb_sensor(suhu, kelembaban) values ('$suhu', '$kelembaban')");
    $r = mysqli_query($konek, "SELECT * FROM tb_sensor");
    $red = mysqli_fetch_array($r);
    if ($red >= 2) {
        mysqli_query($konek, "DELETE FROM tb_sensor WHERE id >=2 ");
    }

    // Uji simpan untuk memberikan Respon balik ke nodemcu  
    if($simpan)
        echo "Berhasil terkirim";
    else
        echo "Gagal Terkirim";

        
?>