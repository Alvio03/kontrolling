<?php
    //Include koneksi
    include "koneksi.php";

    $sql = mysqli_query($konek, "SELECT * FROM tb_kontrol");
    $data = mysqli_fetch_array($sql);
    $servo = $data['servo'];
    // Respon balik ke nodemcu
    echo $servo; // 0 atau 1 

?>