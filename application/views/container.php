<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- TITLE -->
    <title>Welcome to <?php echo ($this->config->item("app_name")) ?></title>
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
    <style type="text/css">
        .float {
            position: fixed;
            display: block;
            width: 60px;
            height: 60px;
            bottom: 45px;
            right: 40px;
            background-image: url("assets/images/wa.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #fff;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            box-shadow: 2px 2px 3px #999;
            z-index: 1;
        }

        .my-float {
            margin-top: 22px;
        }
    </style>

</head>

<body>

    <!-- PRELOADER -->
    <div id="preloader">
        <span class="preloader-dot"></span>
    </div>
    <!-- END / PRELOADER -->
    <?php
    $t = $this->db->query("SELECT telepon AS tel FROM petugas WHERE telepon <> NULL OR telepon <> '' LIMIT 1 OFfSET 0")->row()->tel;
    $t = str_replace(" ", "", $t);
    $t = str_replace("(", "", $t);
    $t = str_replace(")", "", $t);
    $t = str_replace("+", "", $t);
    $t = str_replace("-", "", $t);
    ?>
    <a class="float" href="https://api.whatsapp.com/send?phone=<?php echo $t ?>&text=Hallo%20Petugas%20<?php echo (urlencode($this->config->item("app_name"))) ?>%2c%0d%0a%20%0d%0aSaya%20menunggu%20konfirmasi%20kamar%20yang%20telah%20saya%20pesan&source=&data=">
        <i class="my-float"></i>
    </a>
    <!-- PAGE WRAP -->
    <div id="page-wrap">

        <!-- HEADER -->
        <header id="header" class="header-v2">

            <!-- HEADER LOGO & MENU -->
            <?php $this->load->view('_partials/header'); ?>
            <!-- END / HEADER LOGO & MENU -->

        </header>
        <!-- END / HEADER -->

        <?php $this->load->view($konten); ?>

        <!-- FOOTER -->
        <?php $this->load->view('_partials/footer'); ?>
        <!-- END / FOOTER -->

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
    <script type="text/javascript" src="assets/js/owl.carousel.js"></script>
    <script type="text/javascript" src="assets/js/jquery.appear.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.countTo.js"></script>
    <script type="text/javascript" src="assets/js/jquery.countdown.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.parallax-1.1.3.js"></script>
    <script type="text/javascript" src="assets/js/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="assets/js/scripts.js"></script>
    <script src="assets/js/jquery.flexslider.js"></script>

    <script src="assets/js/imagezoom.js"></script>

    <script>
        function validateme() {
            var formstartdate = $("#tglcheckin").val();
            var formenddate = $("#tglcheckout").val();
            var DateDiff = {

                inDays: function(d1, d2) {
                    var t2 = d2.getTime();
                    var t1 = d1.getTime();

                    return parseInt((t2 - t1) / (24 * 3600 * 1000));
                },

                inWeeks: function(d1, d2) {
                    var t2 = d2.getTime();
                    var t1 = d1.getTime();

                    return parseInt((t2 - t1) / (24 * 3600 * 1000 * 7));
                },

                inMonths: function(d1, d2) {
                    var d1Y = d1.getFullYear();
                    var d2Y = d2.getFullYear();
                    var d1M = d1.getMonth();
                    var d2M = d2.getMonth();

                    return (d2M + 12 * d2Y) - (d1M + 12 * d1Y);
                },

                inYears: function(d1, d2) {
                    return d2.getFullYear() - d1.getFullYear();
                }
            }
            var d1 = new Date(formstartdate);
            var d2 = new Date(formenddate);
            var t = DateDiff.inDays(d1, d2);

            var checkinArr = [
                <?php if (isset($data_resv)) : ?>
                    <?php foreach ($data_resv as $key => $value) : ?> '<?php echo $value->tglcheckin ?>',
                    <?php endforeach ?>
                <?php endif ?>
            ];

            var checkoutArr = [
                <?php if (isset($data_resv)) : ?>
                    <?php foreach ($data_resv as $key => $value) : ?> '<?php echo increase_date_defaultformat($value->tglcheckin, $value->lamainap) ?>',
                    <?php endforeach ?>
                <?php endif ?>
            ];
            var diffMasuk = 0;
            var diffKeluar = 0;
            var res = true;
            var msg = "";

            for (var i = 0; i < checkoutArr.length; i++) {
                diffMasuk = DateDiff.inDays(new Date(formstartdate), new Date(checkinArr[i]));
                diffKeluar = DateDiff.inDays(new Date(formenddate), new Date(checkinArr[i]));
                if (diffMasuk >= 1 && diffKeluar >= 1) {
                    msg = null;
                    res = true;
                } else if (diffMasuk >= 1) {
                    if (DateDiff.inDays(new Date(checkinArr[i]), new Date(formenddate)) >= 0) {
                        msg = "Maaf, Kamar ini sudah di reservasi pada tanggal tersebut.";
                        res = false;
                        break;
                    }
                } else if (diffMasuk <= 0) {
                    if (DateDiff.inDays(new Date(formstartdate), new Date(checkoutArr[i])) >= 0) {
                        msg = "Maaf, Kamar ini sudah di reservasi pada tanggal tersebut.";
                        res = false;
                        break;
                    }
                } else {
                    msg = "Maaf, Kamar ini sudah di reservasi pada tanggal tersebut.";
                    res = false;
                    break;
                }
            }
            if (!res) {
                alert(msg);
                return false;
            } else {
                return confirm("Anda ingin melanjutkan transaksi ?");
            };
        }

        // Can also be used with $(document).ready()
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
            });
        });

        $("#addmember").on("click", function() {
            var nm = $(".member").eq(0).clone();
            $("#membercontainer").append(nm);
        });

        function submember(selector) {
            if ($(".member").length >= 2) {
                selector.closest(".member").remove();
                return false;
            }
        }

        $(".date-picker").on("change", function() {
            var newdate = $(this).val();
            var startdate = $("#tglcheckin").val();

            var DateDiff = {

                inDays: function(d1, d2) {
                    var t2 = d2.getTime();
                    var t1 = d1.getTime();

                    return parseInt((t2 - t1) / (24 * 3600 * 1000));
                },

                inWeeks: function(d1, d2) {
                    var t2 = d2.getTime();
                    var t1 = d1.getTime();

                    return parseInt((t2 - t1) / (24 * 3600 * 1000 * 7));
                },

                inMonths: function(d1, d2) {
                    var d1Y = d1.getFullYear();
                    var d2Y = d2.getFullYear();
                    var d1M = d1.getMonth();
                    var d2M = d2.getMonth();

                    return (d2M + 12 * d2Y) - (d1M + 12 * d1Y);
                },

                inYears: function(d1, d2) {
                    return d2.getFullYear() - d1.getFullYear();
                }
            }
            var d1 = new Date(startdate);
            var d2 = new Date(newdate);
            var res = DateDiff.inDays(d1, d2);

            if (res == NaN) {
                $("#inputlamainap").val(0);
                $("#placeholderlamainap").text(0);
                return false;
            } else {
                if (res == 0) {
                    res = 1;
                };
                $("#inputlamainap").val(res);
                $("#placeholderlamainap").text(res);
            };
        })

        $(document).ready(function() {
            interval = setInterval(function() {
                var s = parseInt($("#seconds").text());
                var i = parseInt($("#minutes").text());
                var h = parseInt($("#hours").text());
                if (s <= 0) {
                    if (i <= 0) {
                        if (h <= 0) {
                            $("#hours").text("60");
                        } else {
                            $("#hours").text(h - 1);
                        }
                        $("#minutes").text("60");
                    } else {
                        $("#minutes").text(i - 1);
                    }
                    $("#seconds").text("60");
                } else {
                    $("#seconds").text(s - 1);
                }
            }, 1000); //< repeat check every 250ms
        });
    </script>
    <?php
    if (isset($script)) {
        if ($script != NULL) {
            $this->load->view($script . ".php");
        }
    };
    ?>
</body>

</html>