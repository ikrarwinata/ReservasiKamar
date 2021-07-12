<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- TITLE -->
    <title>Cetak Invoice Reservasi</title>
    <base href="<?php echo base_url(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" href="theme/images/favicon.png" />
    <meta name="description" content="<?php echo ($this->config->item("app_name")) ?>">

    <!-- META FOR IOS & HANDHELD -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="HandheldFriendly" content="true" />
    <meta name="apple-mobile-web-app-capable" content="YES" />
    <!-- //META FOR IOS & HANDHELD -->

    <!-- CSS LIBRARY -->
    <link rel="stylesheet" type="text/css" href="assets/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/font-lotusicon.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="assets/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="assets/settings.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="assets/helper.css">
    <link rel="stylesheet" type="text/css" href="assets/custom.css">
    <link rel="stylesheet" type="text/css" href="assets/responsive.css">
    <link rel="stylesheet" href="assets/css/flexslider.css" type="text/css" media="screen" />

    <!-- MAIN STYLE -->
    <link rel="stylesheet" type="text/css" href="assets/style.css">

</head>

<body>
    <!-- PAGE WRAP -->
    <div id="page-wrap">
        <!-- CONTACT -->
        <section class="section-contact">
            <div class="container">
                <div class="contact">
                    <?php
                    $hoursToAdd = 5;
                    $tosecond = $hoursToAdd * (60 * 60);
                    $newTime = $timestamps + $tosecond;

                    $date = date_create();
                    $now = date_timestamp_get($date);

                    $start_date = new DateTime(date("Y-m-d H:i:s"));
                    $since_start = $start_date->diff(new DateTime(date("Y-m-d H:i:s", $newTime)));

                    $dif = $newTime - $now;
                    $status = $dif >= 3 ? $status : 0;
                    ?>
                    <div class="row">
                        <h2 align="center"><a href="#"><strong><?php echo ($this->config->item("app_name")) ?></strong></a></h2>
                        <hr class="clear-fix" style="border: 2px solid black">
                        </hr>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="contact-form">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-21 col-xs-12 text-center">
                                        <h3>INVOICE RESERVASI KAMAR <?php echo $nomorkamar ?></h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span style="color: #808080">Status</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span align="right"><strong><?php echo string_statusresv($status) ?></strong></span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span style="color: #808080">ID Transaksi</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span align="right"><strong><?php echo $id ?></strong></span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span style="color: #808080">Nama Pemesan</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span align="right"><strong><?php echo $nama ?></strong></span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span style="color: #808080">Telepon Pemesan</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span align="right"><strong><?php echo $telepon ?></strong></span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span style="color: #808080">Tanggal Checkin</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span align="right"><strong><?php echo $checkin ?></strong> (Hari <?php echo get_str_day($checkin) ?>)</span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span style="color: #808080">Lama Inap</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span align="right"><strong><?php echo $lamainap ?> Hari </strong> (Checkout pada hari <?php echo get_str_day(increase_date($checkin, $lamainap)) ?>)</span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span style="color: #808080">Tarif kamar</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span align="right"><strong>Rp.<?php echo format_number($tarif) ?> @Hari </strong> (Total Rp.<?php echo format_number($tarif * $lamainap) ?>)</span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span style="color: #808080">Jumlah</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span align="right"><strong>Rp.<?php echo format_number($tarif * $lamainap) ?></strong></span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php if ($buktipembayaran != NULL) : ?>
                                            <span style="color: #808080">Telah dibayar uang muka 20% dari jumlah Transaksi (sebesar Rp.<?php echo  format_number(($tarif * $lamainap) * 0.2) ?>)</span>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center" align="center" style="border: 1px solid black">
                                            <strong>Pembayaran melalui Bank <?php echo $namabank ?></strong><br>
                                            <img src="<?php echo $gambarbank ?>" alt="<?php echo $namabank ?>" style="height: 80px; width: auto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="clear-fix">
                            </hr>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    Mengetahui,<br><br><br><br><br><br>
                                    <hr class="clear-fix" style="border: 1px solid black">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- END / CONTACT -->


    </div>
    <!-- END / PAGE WRAP -->


    <!-- LOAD JQUERY -->
    <script type="text/javascript" src="assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-select.js"></script>
    <script type="text/javascript" src="assets/js/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="assets/js/scripts.js"></script>
    <?php
    if (isset($script)) {
        if ($script != NULL) {
            $this->load->view($script . ".php");
        }
    };
    ?>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>