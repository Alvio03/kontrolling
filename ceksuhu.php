<?php
    // Buat koneksi ke database
    include "koneksi.php";
    //Baca data dari tb_sensor
    $sql = mysqli_query($konek, "select * from tb_sensor order by id desc"); //data terakhir akan berada diatas
    // Baca data dari atas
    $data = mysqli_fetch_array($sql);
    $suhu = $data['suhu'];
    // Uji, apabila nilai suhu belum ada, maka anggap suhu = 0
    if( $suhu == "" ) $suhu = 0;
    // Cetak nilai suhu
    echo $suhu; 
?>