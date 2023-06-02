<?php
    //Include koneksi
    include "koneksi.php";

    $sql = mysqli_query($konek, "SELECT * FROM tb_kontrol");
    $data = mysqli_fetch_array($sql);
    $relay = $data['relay'];
    // Respon balik ke nodemcu
    echo $relay; // 0 atau 1 

?>