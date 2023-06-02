<?php
    // Buat koneksi ke database
    include "koneksi.php";
    //Baca data dari tb_sensor
    $sql = mysqli_query($konek, "select * from tb_sensor order by id desc"); //data terakhir akan berada diatas
    // Baca data dari atas
    $data = mysqli_fetch_array($sql);
    $kelembaban = $data['kelembaban'];
    // Uji, apabila nilai kelembaban belum ada, maka anggap kelembaban = 0
    if( $kelembaban == "" ) $kelembaban = 0;
    // Cetak nilai kelembaban
    echo $kelembaban; 
?>