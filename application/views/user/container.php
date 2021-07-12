<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title><?php echo ($this->config->item("app_name")) ?> | User</title>
	<base href="<?php echo base_url(); ?>">

	<meta name="description" content="overview &amp; stats" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- page specific plugin styles -->
	<link rel="stylesheet" href="assets/css/jquery-ui.min.css" />
	<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
	<link rel="stylesheet" href="assets/css/ui.jqgrid.min.css" />
	<link rel="stylesheet" href="assets/css/select2.min.css" />

	<!-- additional bootstrap -->
	<?php
	if (isset($bootstrap)) {
		foreach ($bootstrap as $link) {
	?>
			<link rel="stylesheet" href="<?php echo $link ?>" />
	<?php
		}
	}
	?>

	<!-- text fonts -->
	<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

	<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
	<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

	<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

	<!-- inline styles related to this page -->

	<!-- ace settings handler -->
	<script src="assets/js/ace-extra.min.js"></script>

	<!-- date input settings script -->
	<script src="assets/js/date.js"></script>

	<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

	<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body class="skin-2">
	<?php $this->load->view("_partials/user/header.php") ?>

	<div class="main-container ace-save-state" id="main-container">
		<!--
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>
-->

		<?php $this->load->view("_partials/user/navbar.php") ?>

		<div class="main-content">
			<div class="main-content-inner">

				<?php $this->load->view("_partials/user/breadcum.php") ?>

				<div class="page-content">


					<div class="page-header">
						<h1>
							<?php
							echo $judul[0];
							$index = 0;
							foreach ($judul as $title) {
								if ($index++ >= 1) {
							?>
									<small>
										<i class="ace-icon fa fa-angle-double-right"></i>
										<?php echo $title ?>
									</small>
							<?php
								}
							}
							?>

						</h1>
					</div><!-- /.page-header -->

					<?php $this->load->view($konten . ".php") ?>

				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->

		<?php $this->load->view("_partials/user/footer.php") ?>

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>
	</div><!-- /.main-container -->

	<!-- basic scripts -->

	<!--[if !IE]> -->
	<script src="assets/js/jquery-2.1.4.min.js"></script>

	<!-- <![endif]-->

	<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
	<script type="text/javascript">
		if ('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
	</script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
	<script src="assets/js/jquery-ui.custom.min.js"></script>

	<!-- ace scripts -->
	<script src="assets/js/ace-elements.min.js"></script>
	<script src="assets/js/ace.min.js"></script>

	<script type="text/javascript">
		$('#link-read-user-profile').on('click', function() {
			$.ajax({
				type: "POST",
				url: "user/Pelanggan/set_update",
				data: {
					id: "<?php echo $this->session->userdata('id') ?>",
					idakun: "<?php echo $this->session->userdata('idakun') ?>"
				},
				success: function(e) {
					window.location = "user/Pelanggan/update/" + e;
				}
			});
			return false;
		});

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