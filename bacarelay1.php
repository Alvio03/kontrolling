<?php
    //Include koneksi
    include "koneksi.php";

    $sql = mysqli_query($konek, "SELECT * FROM tb_kontrol");
    $data = mysqli_fetch_array($sql);
    $relay1 = $data['relay1'];
    // Respon balik ke nodemcu
    echo $relay1; // 0 atau 1 

?>