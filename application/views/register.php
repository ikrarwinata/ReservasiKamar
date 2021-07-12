<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Register Page</title>
	<base href="<?php echo base_url(); ?>">

	<meta name="description" content="User login page" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- page specific plugin styles -->
	<link rel="stylesheet" href="assets/css/jquery-ui.min.css" />

	<!-- text fonts -->
	<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="assets/css/ace.min.css" />

	<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
	<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

	<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

	<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

	<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body class="login-layout light-login">
	<div class="main-container">
		<div class="main-content">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="login-container">
						<div class="center">
							<a href="">
								<h1><i class="ace-icon fa fa-home green"></i>
									<span class="red">Reservasi</span>
									<span class="grey" id="id-text2">Kamar</span>
								</h1>
							</a>
							<h4 class="blue" id="id-company-text">&copy; <?php echo ($this->config->item("app_name")) ?></h4>
						</div>

						<div class="space-6"></div>

						<div class="position-relative">
							<div id="login-box" class="login-box visible widget-box no-border">
								<div class="widget-body">
									<div class="widget-main">
										<h4 class="header green lighter bigger">
											<i class="ace-icon fa fa-users blue"></i>
											Register
										</h4>

										<div class="space-6"></div>
										<p> Silahkan isi data berikut: </p>
										<?php echo (form_open_multipart('CPublic/register_action')) ?>
										<fieldset>
											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="text" class="form-control" placeholder="Nama" name="nama" required="true" />
													<i class="ace-icon fa fa-user"></i>
												</span>
											</label>

											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<select name="jeniskelamin" class="form-control" placeholder="Jenis Kelamin" required="true">
														<option value="Pria">Pria</option>
														<option value="Wanita">Wanita</option>
													</select>
													<i class="ace-icon fa fa-user"></i>
												</span>
											</label>

											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="date" class="form-control" name="tgllahir" required="true" />
													<i class="ace-icon fa fa-calendar"></i>
												</span>
											</label>

											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="tel" class="form-control" placeholder="Telepon" name="telepon" required="true" />
													<i class="ace-icon fa fa-phone"></i>
												</span>
											</label>

											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="email" class="form-control" placeholder="Email" name="email" required="true" />
													<i class="ace-icon fa fa-envelope"></i>
												</span>
											</label>

											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="text" class="form-control" placeholder="Username" name="username" required="true" />
													<i class="ace-icon fa fa-user"></i>
												</span>
											</label>

											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="password" id="p1" class="form-control" placeholder="Password" name="password" required="true" />
													<i class="ace-icon fa fa-lock"></i>
												</span>
											</label>

											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="password" id="p2" class="form-control" placeholder="Ulangi password" required="true" />
													<i class="ace-icon fa fa-retweet"></i>
												</span>
											</label>

											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<label>Foto KTP</label>
													<input type="file" name="ktp" id="img" class="form-control" placeholder="Pilih foto KTP" required="true" accept="image/*" />
													<i class="ace-icon fa fa-image"></i>
												</span>
											</label>

											<label class="block">
												<input type="checkbox" class="ace" required="true" />
												<span class="lbl">
													Saya setuju
													<a href="#" id="id-btn-dialog1">Syarat dan Ketentuan</a>
												</span>
											</label>

											<div id="dialog-message" class="hide">
												<p>
												<p>
													Akun yang saya daftarkan di situs ini sesuai data asli saya, dan akan digunakan oleh saya sendiri.
												</p>

												<div class="hr hr-12 hr-double"></div>

												<ul>
													<li>Saya siap menerima konsekuensi jika data yang saya masukan terbukti data palsu.</li>
													<li>Saya siap menerima konsekuensi jika saya terbukti meng-eksploitasi kesalahan sistem secara sengaja.</li>
													<li>Saya siap menerima konsekuensi jika saya memperjual-belikan akun situs ini kepada pihak lain.</li>
													<li>Saya siap menerima hukuman seberat-beratnya jika saya terbukti melanggar syarat diatas.</li>
												</ul>
												</p>
											</div><!-- #dialog-message -->

											<div class="space-24"></div>

											<div class="clearfix">
												<a href="CPublic/login" class="width-25 pull-left btn btn-sm">
													<i class="ace-icon fa fa-arrow-left"></i>
													<span class="bigger-110">Login</span>
												</a>

												<button type="reset" class="width-30 btn btn-sm">
													<i class="ace-icon fa fa-refresh"></i>
													<span class="bigger-110">Reset</span>
												</button>

												<button type="submit" onclick="if($('#p1').val()!=$('#p2').val()){alert('Konfirmasi password anda tidak cocok !');return false;}" class="width-35 pull-right btn btn-sm btn-success">
													<span class="bigger-110">Daftar</span>

													<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
												</button>
											</div>
										</fieldset>
										</form>
									</div>
								</div><!-- /.widget-body -->
							</div><!-- /.login-box -->
						</div><!-- /.position-relative -->


						<!-- <div class="navbar-fixed-top align-right">
								<br />
								&nbsp;
								<a id="btn-login-dark" href="#">Dark</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-blur" href="#">Blur</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-light" href="#">Light</a>
								&nbsp; &nbsp; &nbsp;
							</div> -->

					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.main-content -->
	</div><!-- /.main-container -->

	<!-- basic scripts -->

	<!--[if !IE]> -->
	<script src="assets/js/jquery-2.1.4.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- page specific plugin scripts -->
	<script src="assets/js/jquery-ui.min.js"></script>

	<!-- <![endif]-->

	<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
	<script type="text/javascript">
		if ('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
	</script>

	<!-- inline scripts related to this page -->
	<script type="text/javascript">
		jQuery(function($) {
			$(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible'); //hide others
				$(target).addClass('visible'); //show target
			});
		});



		//you don't need this, just used for changing background
		jQuery(function($) {
			$("#id-btn-dialog1").on('click', function(e) {
				e.preventDefault();

				var dialog = $("#dialog-message").removeClass('hide').dialog({
					modal: true,
					title: "S & K",
					title_html: true,
					buttons: [{
							text: "Cancel",
							"class": "btn btn-minier",
							click: function() {
								$(this).dialog("close");
							}
						},
						{
							text: "OK",
							"class": "btn btn-primary btn-minier",
							click: function() {
								$(this).dialog("close");
							}
						}
					]
				});

				/**
				dialog.data( "uiDialog" )._title = function(title) {
					title.html( this.options.title );
				};
				**/
			});

			$('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');

				e.preventDefault();
			});
			$('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');

				e.preventDefault();
			});
			$('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');

				e.preventDefault();
			});

		});
	</script>
</body>

</html>