<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title><?php echo ($this->config->item("app_name")) ?> | Administrator</title>
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

<body class="skin-3 no-skin">
	<div class="main-container ace-save-state" id="main-container">

		<div class="main-content">
			<div class="main-content-inner">

				<div class="page-content">

					<!-- <div class="row">
							<div class="col-xs-12">
								
								<div id="right-menu" class="modal aside" data-body-scroll="false" data-offset="true" data-placement="right" data-fixed="true" data-backdrop="false" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header no-padding">
												<div class="table-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														<span class="white">&times;</span>
													</button>
													Based on Modal boxes
												</div>
											</div>

											<div class="modal-body">
												<h3 class="lighter">Live Chat</h3>

												>
											</div>
										</div>

										<button class="aside-trigger btn btn-info btn-app btn-xs ace-settings-btn" data-target="#right-menu" data-toggle="modal" type="button">
											<i data-icon1="fa-plus" data-icon2="fa-minus" class="ace-icon fa fa-plus bigger-110 icon-only"></i>
										</button>
									</div>
								</div>
							</div>
						</div> -->
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center text-center">
									<h3><?php echo ($this->config->item("app_name")) ?></h3>
									<h2>JAMBI</h2>
									<small>Sungai Putri, Telanai Pura, Sungai Putri, Jambi, Kota Jambi, Jambi 36361</small>
								</div>
							</div>
							<hr class="clear-fix" style="border: 2px solid black">
							</hr>

							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center text-center" style="text-align: center;">
									<h4 style="align-content: center;">LAPORAN TRANSAKSI</h4>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<?php $tglmulai = format_date_from_string($tanggalmulai, "m/d/Y");
									$tglakhir = format_date_from_string($tanggalakhir, "m/d/Y"); ?>
									Rentang Tanggal : <?php echo get_str_day($tglmulai) . " " . $tglmulai; ?>&nbsp;<strong>s/d</strong>&nbsp;<?php echo get_str_day($tglakhir) . " " . $tglakhir; ?>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									Tanggal Cetak : <?php echo get_str_day(date("d-m-Y")) . ", " . date("d") . " " . get_str_month(date("m")) . " " . date("Y") ?>
								</div>
							</div>

							<hr class="clear-fix">
							</hr>
							<div class="table">
								<table class="table table-bordered table-responsive">
									<thead>
										<tr>
											<th>Total Transaksi</th>
											<td>: <?php echo $totaltransaksi ?></td>
										</tr>
										<tr>
											<th>Transaksi Ditolak</th>
											<td>: <?php echo $transaksiditolak ?></td>
										</tr>
										<tr>
											<th>Transaksi Dikonfirmasi</th>
											<td>: <?php echo $transaksidikonfirmasi ?></td>
										</tr>
										<tr>
											<th>Transaksi Pending</th>
											<td>: <?php echo $transaksipending ?></td>
										</tr>
										<tr>
											<th>Total Transaksi Pembayaran</th>
											<td>: Rp<?php echo format_number($total) ?></td>
										</tr>
										<tr>
											<th colspan="2" class="right text-right"><small><?php echo $terbilang ?></small></th>
										</tr>
									</thead>
								</table>
							</div>
							<br><br><br><br><br><br>
							<div class="row" style="margin-top: 105px">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
									&nbsp;
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
									&nbsp;
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
									Mengetahui
									<br><br><br><br><br>
									<?php echo $this->session->userdata("nama") ?>
								</div>
							</div>
							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->

				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->
	</div><!-- /.main-container -->

	<!-- basic scripts -->

	<!--[if !IE]> -->
	<script src="assets/js/jquery-2.1.4.min.js"></script>

	<!-- <![endif]-->

	<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
	<script src="assets/js/bootstrap.min.js"></script>

	<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
	<script src="assets/js/jquery-ui.custom.min.js"></script>

	<!-- ace scripts -->
	<script src="assets/js/ace-elements.min.js"></script>
	<script src="assets/js/ace.min.js"></script>
	<script type="text/javascript">
		jQuery(function($) {

			$('#link-read-user-profile').on('click', function() {
				$.ajax({
					type: "POST",
					url: "admin/Petugas/set_update",
					data: {
						id: "<?php echo $this->session->userdata('id') ?>",
						idakun: "<?php echo $this->session->userdata('idakun') ?>"
					},
					success: function(e) {
						window.location = "admin/Petugas/update/" + e;
					}
				});
				return false;
			});


			$('.modal.aside').ace_aside();

			$('#aside-inside-modal').addClass('aside').ace_aside({
				container: '#my-modal > .modal-dialog'
			});

			//$('#top-menu').modal('show')

			$(document).one('ajaxloadstart.page', function(e) {
				//in ajax mode, remove before leaving page
				$('.modal.aside').remove();
				$(window).off('.aside')
			});


			//make content sliders resizable using jQuery UI (you should include jquery ui files)
			//$('#right-menu > .modal-dialog').resizable({handles: "w", grid: [ 20, 0 ], minWidth: 200, maxWidth: 600});
		})
		window.print();
	</script>
	<?php
	if (isset($script)) {
		if ($script != NULL) {
			$this->load->view($script);
		}
	};
	?>
</body>

</html>