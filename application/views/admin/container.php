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
	<?php $this->load->view("_partials/admin/header.php") ?>

	<div class="main-container ace-save-state" id="main-container">
		<!--
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>
-->

		<?php $this->load->view("_partials/admin/navbar.php") ?>

		<div class="main-content">
			<div class="main-content-inner">

				<?php $this->load->view("_partials/admin/breadcum.php") ?>

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

					<?php $this->load->view($konten) ?>

				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->

		<?php $this->load->view("_partials/admin/footer.php") ?>

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