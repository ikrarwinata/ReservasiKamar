<?php 
$d = date("d");
$m = date("m");
$y = date("Y");
$rsv = $this->db->query("SELECT reservasi.idreservasi, pelanggan.idpelanggan, kamar.idkamar, reservasi.tglreservasi, reservasi.lamainap, reservasi.status, reservasi.tglcheckin, pelanggan.nama, kamar.nomorkamar, pelanggan.fotoprofil FROM reservasi INNER JOIN pelanggan ON reservasi.idpelanggan=pelanggan.idpelanggan INNER JOIN kamar ON reservasi.idkamar=kamar.idkamar WHERE reservasi.status='1'")->result();
$kmr = $this->db->query("SELECT * FROM kamar INNER JOIN reservasi ON kamar.idkamar=reservasi.idkamar INNER JOIN pelanggan ON reservasi.idpelanggan=pelanggan.idpelanggan WHERE reservasi.status = '2' AND reservasi.tglcheckin LIKE '%".date("Y")."-_%'")->result();
 ?>

<div id="navbar" class="navbar navbar-default ace-save-state navbar-fixed-top">
	<div class="navbar-container ace-save-state" id="navbar-container">
		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
			<span class="sr-only">Toggle sidebar</span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>
		</button>

		<div class="navbar-header pull-left">
			<a href="Admin" class="navbar-brand">
				<small>
					<small><?php echo ($this->config->item('app_name')) ?></small>
				</small>
			</a>
		</div>

		<div class="navbar-buttons navbar-header pull-right" role="navigation">
			<ul class="nav ace-nav">
			<?php if(count($kmr) > 0){ ?>
				<li class="red dropdown-modal">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<i class="ace-icon fa fa-tasks"></i>
						<span class="badge badge-grey"><?php echo count($kmr) ?></span>
					</a>

					<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
						<li class="dropdown-header">
							<i class="ace-icon fa fa-check"></i>
							<?php echo count($kmr) ?> Kamar menunnggu konfirmasi
						</li>

						<li class="dropdown-content">
							<ul class="dropdown-menu dropdown-navbar">
								<?php foreach ($kmr as $kamar) {?>
								<li>
									<a href="admin/Reservasi/index?tab=accepted" class="clearfix">
										<img src="<?php echo $kamar->fotoprofil ?>" class="msg-photo" alt="" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue"><?php echo $kamar->nama ?></span>
												Seharusnya memasuki kamar <span class="blue"><?php echo $kamar->nomorkamar ?></span> pada tanggal <span class="red"><?php echo format_date($kamar->tglcheckin) ?></span>
											</span>

											<span class="msg-time">
												<i class="ace-icon fa fa-clock-o"></i>
												<span><?php echo timelog($kamar->tglcheckin, "06:00") ?></span>
											</span>
										</span>
									</a>
								<?php } ?>
							</ul>
						</li>

						<li class="dropdown-footer">
							<a href="admin/Kamar">
								Lihat semua kamar
								<i class="ace-icon fa fa-arrow-right"></i>
							</a>
						</li>
					</ul>
				</li>
			<?php }
			if(count($rsv) > 0){ ?>
				<li class="purple dropdown-modal">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<i class="ace-icon fa fa-bell icon-animated-bell"></i>
						<span class="badge badge-important"><?php echo count($rsv) ?></span>
					</a>

					<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
						<li class="dropdown-header">
							<i class="ace-icon fa fa-exclamation-triangle"></i>
							<?php echo count($rsv) ?> Reservasi Menunggu
						</li>

						<li class="dropdown-content">
							<ul class="dropdown-menu dropdown-navbar">
							<?php foreach ($rsv as $reservasi) { ?>
								<li>
									<a href="admin/Reservasi/index?tab=waiting" class="clearfix">
										<img src="<?php echo $reservasi->fotoprofil ?>" class="msg-photo" alt="" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue"><?php echo $reservasi->nama ?>:</span>
												Reservasi kamar <?php echo $reservasi->nomorkamar.", untuk ".$reservasi->lamainap ?> Hari
											</span>

											<span class="msg-time">
												<i class="ace-icon fa fa-clock-o"></i>
												<span><?php echo format_date($reservasi->tglcheckin) ?></span>
											</span>
										</span>
									</a>
								</li>
							<?php } ?>
							</ul>
						</li>

						<li class="dropdown-footer">
							<a href="Admin/Reservasi">
								Lihat semua
								<i class="ace-icon fa fa-arrow-right"></i>
							</a>
						</li>
					</ul>
				</li>
			<?php } ?>

				<li class="light-blue dropdown-modal">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle">
						<img class="nav-user-photo" src="<?php echo $this->session->userdata("fotoprofil") ?>" alt="" />
						<span class="user-info">
							<small><?php echo $this->session->userdata("username") ?>,</small>
							<?php echo $this->session->userdata("nama") ?>
						</span>

						<i class="ace-icon fa fa-caret-down"></i>
					</a>

					<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
	
						<li>
							<a href="#" id="link-read-user-profile">
								<i class="ace-icon fa fa-user"></i>
								Profile
							</a>
						</li>

						<li class="divider"></li>

						<li>
							<a href="Logout">
								<i class="ace-icon fa fa-power-off"></i>
								Logout
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div><!-- /.navbar-container -->
</div>