<?php
    //include koneksi
    include "koneksi.php";

    //tanggap variable pos dari ajax
    $pos = $_GET['pos'];
    //Update nilai di field servo yang ada di database
    mysqli_query($konek, "UPDATE tb_kontrol SET servo ='$pos'");
    //berikan responce
    echo $pos;
?>