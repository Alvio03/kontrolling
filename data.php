<?php
//Include koneksi
include "koneksi.php";

//baca data dari table tb_temperature
// Baca id tertinggi
$sql_id = mysqli_query($konek, "SELECT MAX(id) FROM tb_temperature");
// tanggap data
$data_id = mysqli_fetch_array($sql_id);
// ambil id terakhir atau ambil id terbesar
$id_akhir = $data_id['MAX(id)'];
$id_awal = $id_akhir - 4;
// baca tanggal untuk 5 data teakhir
$tanggal = mysqli_query($konek, "SELECT tanggal FROM tb_temperature WHERE id>='$id_awal'and id<='$id_akhir' ORDER BY id ASC");
// baca informasi suhu untuk 5 data terakhir 
$suhu1 = mysqli_query($konek, "SELECT suhu1 FROM tb_temperature WHERE id>='$id_awal'and id<='$id_akhir' ORDER BY id ASC");
// baca informasi kelembaban untuk 5 data terakhir
$kelembaban1 = mysqli_query($konek, "SELECT kelembaban1 FROM tb_temperature WHERE id>='$id_awal'and id<='$id_akhir' ORDER BY id ASC");
?>

<!-- Tampilan grafik -->
<div class="panel panel-primary">
    <div class="panel-heading">
        Grafik Sensor
    </div>
    <div class="panel-body">
        <!-- siapkan canvas untuk grafik -->
        <canvas id="myChart"></canvas>
        <!-- gambar grafik -->
        <script type="text/javascript">
            // baca id canvas tempat grafik diletakkan
            var canvas = document.getElementById('myChart');
            // letakkan data tanggal dan suhu untuk grafik
            var data = {
                labels: [
                    <?php
                    while ($data_tanggal = mysqli_fetch_array($tanggal)) {
                        echo '"' . $data_tanggal['tanggal'] . '",';
                    }
                    ?>
                ],
                datasets: 
                [
                    {
                        label: "Suhu",
                        fill: true,
                        backgroundColor: "rgba(52, 231, 43, 0.5)",
                        borderColor: "rgba(52, 231, 43, 1)",
                        lineTension: 0.5,
                        pointRadius: 5,
                        data: 
                        [
                            <?php
                                while ($data_suhu = mysqli_fetch_array($suhu1)) 
                                {
                                    echo $data_suhu['suhu1'] . ',';
                                }
                            ?>
                        ]
                    },
                    {
                        label: "Kelembaban",
                        fill: true,
                        backgroundColor: "rgba(239, 82, 93, 0.2)",
                        borderColor: "rgba(239, 82, 93, 1)",
                        lineTension: 0.5,
                        pointRadius: 5,
                        data: 
                        [
                            <?php
                                while ($data_kelembaban = mysqli_fetch_array($kelembaban1)) 
                                {
                                    echo $data_kelembaban['kelembaban1'] . ',';
                                }
                            ?>
                        ]
                    }
                ]
            };
            // option grafik
            var option = {
                showLines: true,
                animation: {
                    duration: 0
                }
            };
            // cetak grafik kedalam canvas
            var myLineChart = Chart.Line(canvas, {
                data: data,
                options: option
            });
        </script>
    </div>
</div>