<?php
    // Koneksi ke database
    include "koneksi.php";
    // Tangkap parameter yang dikirimkan oleh node mcu  
    $suhu1 = $_GET['suhu1'];
    $kelembaban1 = $_GET['kelembaban1'];
    // Simpan ke database tb_temperature
    // Atur ID selalu dimulai dari 1
    mysqli_query($konek, "ALTER TABLE tb_temperature AUTO_INCREMENT= 1");
    //  Simpan nilai suhu dan kelembaban kedalam tb_temperature
    $simpan = mysqli_query($konek, "INSERT INTO tb_temperature(suhu1, kelembaban1) VALUES('$suhu1', '$kelembaban1')");

    //  Berikan respon ke nodeMCU
    if($simpan)
    echo "berhasil disimpan";
    else
    echo "gagal menyimpan";
?>