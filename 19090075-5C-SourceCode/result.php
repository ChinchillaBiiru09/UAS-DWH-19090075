<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">

    <title>SPK Forecast - DWH 5C</title>
<!--
SOFTY PINKO
https://templatemo.com/tm-535-softy-pinko
-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-softy-pinko.css">

    </head>
    
    <body>
        
    <?php include "koneksi.php"; ?>
    
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="#" class="logo">
                            <img src="assets/images/logo_forecasting.png" style="height: 35px; width: 150px;" alt="Softy Pinko"/>
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="showdata.php">Data Table</a></li>
                            <li><a href="prediction.php">Prediction</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Welcome Area Start ***** -->
    <div class="banner-area" id="welcome">
        <!-- ***** Header Text Start ***** -->
        <div class="header-text">
            <div class="container">
                <!-- ***** Section Title Start ***** -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="center-heading">
                            <h1 class="section-title">Prediction Result</h1>
                        </div>
                    </div>
                    <div class="offset-lg-3 col-lg-6">
                        <div class="center-text">
                            <p>Forecasting results can be seen here.</p>
                            <a href="#result" class="main-button-slider">Show Result</a>
                        </div>
                    </div>
                </div>
                <!-- ***** Section Title End ***** -->
            </div>
        </div>
        <!-- ***** Header Text End ***** -->
    </div>
    <!-- ***** Welcome Area End ***** -->

    <!-- ***** Table Data Start ***** -->
    <section class="section colored" id="pricing-plans">
    <!-- ***** Table Data Start ***** -->
        <div class="container">
            <!-- Table Start -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="headtab">
                        <tr>
                            <td>No.</td>
                            <td>Date</td>
                            <td>Amount</td>
                            <td>X</td>
                            <td>Y</td>
                            <td>XX</td>
                            <td>XY</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = mysqli_query($con, "SELECT * FROM fact") or die (mysqli_error($con));
                            if (mysqli_num_rows($sql) > 0) {
                                $x = 0;
                                $jumlah_x = 0;
                                $jumlah_y = 0;
                                $jumlah_xx = 0;
                                $jumlah_xy = 0;
                                while ($data = mysqli_fetch_array($sql)) {
                                    $jumlah_x += $x;
                                    $jumlah_y += $data['amount'];
                                    $jumlah_xx += ($x * $x);
                                    $jumlah_xy += ($x * $data['amount']);
                                    ?>
                                    <tr>
                                        <td><?= $x+1; ?></td>
                                        <td><?= $data['time_sc']; ?></td>
                                        <td align="center"><?= $data['amount']; ?></td>
                                        <td align="center"><?= $x; ?></td>
                                        <td align="center"><?= $data['amount']; ?></td>
                                        <td align="center"><?= $x * $x; ?></td>
                                        <td align="center"><?= $x * $data['amount']; ?></td>
                                    </tr>
                                    <?php
                                        $x++;
                                }
                                ?>
                                <tr>
                                    <td colspan = "2">Jumlah</td>
                                    <td></td>
                                    <td><?= $jumlah_x; ?></td>
                                    <td><?= $jumlah_y; ?></td>
                                    <td><?= $jumlah_xx; ?></td>
                                    <td><?= $jumlah_xy; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Rata2</td>
                                    <td></td>
                                    <td>
                                        <?php 
                                            $rata2_x = $jumlah_x/$x;
                                            echo $rata2_x;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $rata2_y = $jumlah_y/$x;
                                            echo $rata2_y;
                                        ?>
                                    </td>
                                    <td colspan="2"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">B1</td>
                                    <td colspan="5">
                                        <?php
                                            $b1 = ($jumlah_xy - (($jumlah_x * $jumlah_y) / $x)) / ($jumlah_xx - ($jumlah_x * $jumlah_x) / $x);
                                            echo $b1;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">B0</td>
                                    <td colspan="5">
                                        <?php
                                            $b0 = $rata2_y - $b1 * $rata2_x;
                                            echo $b0;
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Table End -->
        </div> 
        <!-- ***** Table Data End ***** -->
    </section>

    <!-- ***** Result Predicion Start ***** -->
    <section class="section colored" id="result">
        <div class="container">
            <!-- ***** Section Title Start ***** -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-heading">
                        <h2 class="section-title">Prediction</h2>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->

            <div class="row">
                <!-- ***** formula Start ***** -->
                <div class="col-md-6 col-sm-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                    <div class="pricing-item">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Formula</h3>
                        </div>
                        <div class="pricing-body">
                            <div class="price-wrapper">
                                <span class="price"> Linear Regression </span>
                            </div>
                            <ul class="list">
                                <li class="active">
                                    <?php
                                        $y = $b0." + ".$b1.".x";
                                        echo $y;
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ***** formula End ***** -->

                <!-- ***** result Start ***** -->
                <div class="col-md-6 col-sm-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.6s">
                    <div class="pricing-item">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Result</h3>
                        </div>
                        <div class="pricing-body">
                            <div class="price-wrapper">
                                <span class="price">Prediction</span>
                            </div>
                            <ul class="list">
                                <?php
                                    if (isset($_POST['predict'])) {
                                        $tahun = $_POST['tahun'];
                                        $thn = ($x - 1) + $tahun;
                                        $prediksi = $b0 + ($b1 * $thn);
                                        ?>
                                        <li class="active">predictions for the next <?= $tahun; ?> years is <strong><?= $prediksi; ?></strong></li>
                                    <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ***** result End ***** -->
            </div>
        </div>
        <!-- ***** Result Predicion End ***** -->

        <!-- ***** Re-predict Start ***** -->
        <div class="container">
            <center>
                <a href="prediction.php" class="main-button">Re-predict</a>
            </center>
        </div>
        <!-- ***** Re-predict End ***** -->
    </section>
    <!-- ***** Pricing Plans End ***** -->


    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <ul class="social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p class="copyright">Copyright &copy; 2022 Nur Khafidah - 19090075 - Design: TemplateMo</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>
</body>
</html>