<!-- Baca status terakhir servo dan relay-->
<?php
//include koneksi
include "koneksi.php";

$sql = mysqli_query($konek, "SELECT * FROM tb_kontrol");
$data = mysqli_fetch_array($sql);
//ambil status relay
$relay = $data['relay'];
$relay1 = $data['relay1'];
//ambil status servo
$servo = $data['servo'];
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="grafiksensor/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./styles/global.css">
    <script type="text/javascript" src="grafiksensor/assets/js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="grafiksensor/jquery-latest.js"></script>
    <script type="text/javascript" src="grafiksensor/assets/js/mdb.min.js"></script>

    <title>IOT Kontrol Relay dan Servo</title>
    <script type="text/javascript">
        function ubahstatus(value) {
            if (value === true) {
                value = "ON"
                handleChangeImage(value, 1)
            } else {
                value = "OFF"
                handleChangeImage(value, 1)
            }
            document.getElementById('status').innerHTML = value;

            //ajax untuk merubah nilai status relay
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                //ambil respon dari web setelah berhasil merubah nilai
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById('status').innerHTML = xmlhttp.responseText;
                }
            }
            //execute file php untuk merubah nilai di database
            xmlhttp.open("GET", "relay.php?stat=" + value, true);
            //Kirim data
            xmlhttp.send();
        }

        function ubahstatus1(value) {
            // value == true ? value = "ON" : value = "OFF"
            if (value === true) {
                value = "ON"
                handleChangeImage(value, 2)
            } else {
                value = "OFF"
                handleChangeImage(value, 2)
            }
            document.getElementById('status1').innerHTML = value;

            //ajax untuk merubah nilai status relay1
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                //ambil respon dari web setelah berhasil merubah nilai
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById('status1').innerHTML = xmlhttp.responseText;
                }
            }
            //execute file php untuk merubah nilai di database
            xmlhttp.open("GET", "relay1.php?stat1=" + value, true);
            //Kirim data
            xmlhttp.send();
        }

        function ubahposisi(value) {
            document.getElementById('posisi').innerHTML = value;

            //ajax untuk merubah nilai status relay
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                //ambil respon dari web setelah berhasil merubah nilai
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById('posisi').innerHTML = xmlhttp.responseText;
                }
            }
            //execute file php untuk merubah nilai di database
            xmlhttp.open("GET", "servo.php?pos=" + value, true);
            //Kirim data
            xmlhttp.send();
        }
        const handleChangeImage = (value, index) => {
            console.log(value)
            let Image = document.getElementById(`lights-control-${index}`)
            value === "ON" ? Image.src = "./asset/svgs/light.png" : Image.src = "./asset/svgs/off-light.png";

        }
    </script>
    <script type="text/javascript" src="multisensor/multisensor/jquery/jquery.min.js"></script>
    <!-- Load Otomatis / Realtime -->
    <script type="text/javascript">
        $(document).ready(function() {

            setInterval(function() {
                $("#ceksuhu").load("ceksuhu.php");
                $("#cekkelembaban").load("cekkelembaban.php");
            }, 1000);
        });
    </script>
    <!-- Memanggil data grafik -->
    <script type="text/javascript">
        var refreshid = setInterval(function() {
            $('#responsecontainer').load('data.php');
        }, 1000);
    </script>
    <script src="https://kit.fontawesome.com/0bc7254963.js" crossorigin="anonymous"></script>
</head>

<body class="">
    <!-- Tampilan Judul -->
    <section class="container">
        <div class="header-wrapper text-center py-5" style="font-weight: 800;">
            <h2 class="custom-title">
                Kontrol Relay dan Servo
            </h2>
        </div>

        <!-- SECTION RELAY -->
        <section class="content-wrapper">
            <div class="row justify-content-center mx-auto">
                <div class="col-md-6 col-lg-3 gx-0 mb-5">
                    <div class="card shadow" style="border-left: 6px solid #DD58D6; border-radius: 8px;">
                        <div class="custom-card-body py-2 px-5">
                            <div class="left-content">
                                <div class="wrapper">
                                    <div class="content">
                                        <h1 class="custom-title">Relay</h1>
                                        <div class="form-check form-switch py-3" style="font-size:20px;">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onchange="ubahstatus(this.checked)" <?php if ($relay == 1) echo "checked"; ?>>
                                            <label class="form-check-label" for="flexSwitchCheckDefault"> <span id="status">
                                                    <?php if ($relay == 1) echo "ON";
                                                    else echo "OFF" ?></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <img id="lights-control-1" src="./asset/svgs/off-light.png" />
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 gx-0 mb-5">
                    <div class="card shadow" style="border-left: 6px solid #FFE79B; border-radius: 8px;">
                        <div class="custom-card-body py-2 px-5">
                            <div class="left-content">
                                <div class="wrapper">
                                    <div class="content">
                                        <h1 class="custom-title">Relay 1</h1>
                                        <div class="form-check form-switch py-3" style="font-size : 20px;">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onchange="ubahstatus1(this.checked)" <?php if ($relay1 == 1) echo "checked"; ?>>
                                            <label class="form-check-label" for="flexSwitchCheckDefault"> <span id="status1"><?php if ($relay1 == 1) echo "ON";
                                                                                                                                else echo "OFF" ?></span> </label>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <img id="lights-control-2" src="./asset/svgs/off-light.png" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 gx-0 mb-5">
                    <div class="card shadow" style="border-left: 6px solid #9336B4; border-radius: 8px;">
                        <div class="custom-card-body py-2 px-5">
                            <div class="left-content">
                                <div class="wrapper">
                                    <div class="content">
                                        <h1 class="custom-title">Relay 2</h1>
                                        <div class="form-check form-switch py-3" style="font-size : 20px;">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onchange="ubahstatus1(this.checked)" <?php if ($relay1 == 1) echo "checked"; ?>>
                                            <label class="form-check-label" for="flexSwitchCheckDefault"> <span id="status1"><?php if ($relay1 == 1) echo "ON";
                                                                                                                                else echo "OFF" ?></span> </label>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <img src="./asset/svgs/light.png" />
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 gx-0 mb-5">
                    <div class="card shadow" style="border-left: 6px solid #40128B; border-radius: 8px;">
                        <div class="custom-card-body py-2 px-5">
                            <div class="left-content">
                                <div class="wrapper">
                                    <div class="content">
                                        <h1 class="custom-title">Servo</h1>
                                      <div style="text-align :center; font-size : 18px">
                                <label for="customRange1" class="form-label fw-light py-2">Posisi Servo <span id="posisi"> <?php echo $servo; ?> </span> Derajat</label>
                                <input type="range" class="form-range" id="customRange1" min="0" max="180" step="1" value="<?php echo $servo; ?>" onchange="ubahposisi(this.value)">
                            </div>
                                    </div>
                                  

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        
        <!-- AKHIR SECTION RELAY -->

        <!-- SECTION GRAFIK AND TEMP -->
      <div class="row">
        <div class="col-md-7 order-1 order-md-0">
             <div class="">
            <h3>Grafik sensor secara realtime</h3>
            <p>(Data yang ditampilkan adalah 5 data terakhir)</p>
        </div>
         <div class="">
            <div class="" id="responsecontainer"></div>
        </div>
        </div>
        <div class="col-md-5 order-0 order-md-1">
             <h3 class="text-center mb-5">
                Monitoring Suhu, Kelembaban
            </h3>
         <div class="row d-flex gap-5 justify-items-center">
            <div class="col-12">
                    <div class="card shadow" style="border-left: 6px solid #40128B; border-radius: 8px; width:100%;">
                        <div class="custom-card-body py-2 px-5">   
                        <h3 style=" font-weight: 600;" class="text-center">Suhu</h3>
                        <h1 class="text-center fw-bold"> 
                            <span id="ceksuhu" class="text-center">0</span> 
                        </h1>    
                        </div>
                    </div>           
            </div>

            <div class="col-12">
                  <div class="card shadow" style="border-left: 6px solid #40128B; border-radius: 8px; width:100%;">
                        <div class="custom-card-body py-2 px-5">   
                        <h3 style=" font-weight: 600;" class="text-center">Kelembapan</h3>
                        <h1 class="text-center fw-bold"> 
                           <span id="cekkelembaban" class="text-center">0</span> 
                        </h1>    
                        </div>
                    </div>           
                 </div>
            </div>
         </div>
        </div>
        </div>
        </div>
      </div>
        <!-- END GRAFIK AND TEMP -->
     

        <!-- tampilan menampilkan relay dan servo -->
        <!-- <div class="card text-black mb-3" style="width: 20rem; margin-right : 10px">
                <div class="card-header" style="font-size : 30px; text-align : center; background-color: red; color : white">Relay</div>
                <div class="card-body">
                    <div class="form-check form-switch" style="font-size : 50px;">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onchange="ubahstatus(this.checked)" <?php if ($relay == 1) echo "checked"; ?>>
                        <label class="form-check-label" for="flexSwitchCheckDefault"> <span id="status">
                            <?php if ($relay == 1) echo "ON";
                            else echo "OFF" ?></span> </label>
                    </div>
                </div>
            </div> -->
        <!-- akhir kartu relay-->

        <!-- <div class="card text-black mb-3" style="width: 20rem; margin-right : 10px">
                <div class="card-header" style="font-size : 30px; text-align : center; background-color: red; color : white">Relay 1</div>
                <div class="card-body">
                    <div class="form-check form-switch" style="font-size : 50px;">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onchange="ubahstatus1(this.checked)" <?php if ($relay1 == 1) echo "checked"; ?>>
                        <label class="form-check-label" for="flexSwitchCheckDefault"> <span id="status1"><?php if ($relay1 == 1) echo "ON";
                                                                                                            else echo "OFF" ?></span> </label>
                    </div>
                </div>
            </div> -->
        <!-- akhir kartu relay-->
        <!-- kartu Servo-->

        <!-- akhir kartu Servo-->
        <!--Akhir tampilan menampilkan relay dan servo -->
        <!--Judul tulisan monitoring suhu kelembaban ldr -->
        <div class="container" style="text-align: center; padding-top: 20px">
            <h2>
                Monitoring Suhu, Kelembaban
            </h2>
        </div>
        <!--Akhir Judul tulisan monitoring suhu kelembaban ldr -->
        <!-- tampilan menampilkan suhu kelembaban dan ldr -->
        <div class="container" style="display : flex;">
            <!-- Menampilkan nilai suhu -->
            <div class="card text-center" style="width : 33.33%">
                <div class="card-header" style="font-size : 30px; font-weight : bold; background-color : yellow">
                    Suhu
                </div>
                <div class="card-body">
                    <h1> <span id="ceksuhu">0</span> </h1>
                </div>
            </div>
            <!-- akhir menampilkan nilai suhu -->
            <!-- Menampilkan nilai kelembaban -->
            <div class="card text-center" style="width : 33.33%">
                <div class="card-header" style="font-size : 30px; font-weight : bold;  background-color : blue; color : white">
                    Kelembaban
                </div>
                <div class="card-body">
                    <h1> <span id="cekkelembaban">0</span> </h1>
                </div>
            </div>
            <!-- akhir menampilkan nilai kelembaban -->
        </div>
        <!-- tampilan grafik -->
        <div class="container" style="text-align : center;">
            <h2>Grafik sensor secara realtime</h2>
            <p>(Data yang ditampilkan adalah 5 data terakhir)</p>
        </div>
        <!-- menampilkan grafik -->

        <div class="container">
            <div class="container" id="responsecontainer" style="width : 90%; text-align : center;"></div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0bc7254963.js" crossorigin="anonymous"></script>
</body>

</html>