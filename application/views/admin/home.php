<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="alert alert-block alert-success">
			<button type="button" class="close" data-dismiss="alert">
				<i class="ace-icon fa fa-times"></i>
			</button>

			Selamat datang
			<strong class="green">
				<?php echo $this->session->userdata("nama") ?>
			</strong>
		</div>

		<div class="tabbable">
			<ul class="nav nav-tabs padding-18">
				<li class="active">
					<a data-toggle="tab" href="#home">
						<i class="green ace-icon fa fa-user bigger-120"></i>
						Statistik
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#feed">
						<i class="orange ace-icon fa fa-rss bigger-120"></i>
						Aktifitas Petugas
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#feed2">
						<i class="orange ace-icon fa fa-rss bigger-120"></i>
						Aktifitas Tamu
					</a>
				</li>
			</ul>

			<div class="tab-content no-border padding-24">
				<div id="home" class="tab-pane in active">
					<div class="row">
						<div class="space-6"></div>

						<div class="col-sm-12 infobox-container">
							<div class="infobox infobox-green">
								<div class="infobox-icon">
									<i class="ace-icon fa fa-check-square-o"></i>
								</div>

								<div class="infobox-data">
									<span class="infobox-data-number"><?php echo $kamardigunakan ?></span>
									<div class="infobox-content">Kamar digunakan</div>
								</div>

							</div>

							<div class="infobox infobox-blue">
								<div class="infobox-icon">
									<i class="ace-icon fa fa-users"></i>
								</div>

								<div class="infobox-data">
									<span class="infobox-data-number"><?php echo $pelanggan ?></span>
									<div class="infobox-content">Pelanggan</div>
								</div>
							</div>

							<div class="infobox infobox-pink">
								<div class="infobox-icon">
									<i class="ace-icon fa fa-list"></i>
								</div>

								<div class="infobox-data">
									<span class="infobox-data-number"><?php echo $reservasi ?></span>
									<div class="infobox-content">Reservasi menunggu</div>
								</div>
							</div>

							<div class="infobox infobox-red">
								<div class="infobox-icon">
									<i class="ace-icon fa fa-book"></i>
								</div>

								<div class="infobox-data">
									<span class="infobox-data-number"><?php echo $transaksi ?></span>
									<div class="infobox-content">Total transaksi</div>
								</div>
							</div>

							<div class="infobox infobox-orange2">
								<div class="infobox-icon">
									<i class="ace-icon fa fa-money"></i>
								</div>

								<div class="infobox-data">
									<span class="infobox-data-number"><?php echo to_number_kilo($pemasukan) ?></span>
									<div class="infobox-content">Total Pemasukan (Rp)</div>
								</div>
							</div>

							<div class="space-6"></div>
						</div>
					</div><!-- /.row -->
				</div><!-- /#home -->

				<div id="feed" class="tab-pane">
					<div class="profile-feed row">
						<div class="col-sm-6">
							<?php 
							foreach($activitys1 as $log){
							?>
							<div class="profile-activity clearfix">
								<div>
									<img class="pull-left" alt="<?php echo $log->nama ?>" src="<?php echo $log->fotoprofil ?>" />
									<a class="user" href="#"> <?php echo $log->nama ?> </a>
									<?php echo logcat($log->action, $log->displaytext, $log->controller) ?>

									<div class="time">
										<i class="ace-icon fa fa-clock-o bigger-110"></i>
										<?php echo timelog($log->tanggal, $log->jam) ?>
									</div>
								</div>

								<div class="tools action-buttons">
									<a href="" class="red" onClick="return false">
										<i class="ace-icon fa fa-times bigger-125"></i>
									</a>
								</div>
							</div>
							<?php 
							}
							?>
						</div><!-- /.col -->

						<div class="col-sm-6">
							<?php 
							foreach($activitys2 as $log){
							?>
							<div class="profile-activity clearfix">
								<div>
									<img class="pull-left" alt="<?php echo $log->nama ?>" src="<?php echo $log->fotoprofil ?>" />
									<a class="user" href="#"> <?php echo $log->nama ?> </a>
									<?php echo logcat($log->action, $log->displaytext, $log->controller) ?>

									<div class="time">
										<i class="ace-icon fa fa-clock-o bigger-110"></i>
										<?php echo timelog($log->tanggal, $log->jam) ?>
									</div>
								</div>

								<div class="tools action-buttons">
									<a href="" class="red" onClick="return false">
										<i class="ace-icon fa fa-times bigger-125"></i>
									</a>
								</div>
							</div>
							<?php 
							}
							?>
						</div><!-- /.col -->
					</div><!-- /.row -->

					<div class="space-12"></div>
					
					<div class="center">
						<button type="button" class="btn btn-sm btn-primary btn-white btn-round" onclick="window.location='admin/Aktifitasakun/index/Petugas'">
							<i class="ace-icon fa fa-rss bigger-150 middle orange2"></i>
							<span class="bigger-110">View more activities</span>

							<i class="icon-on-right ace-icon fa fa-arrow-right"></i>
						</button>
					</div>
				</div><!-- /#feed -->

				<div id="feed2" class="tab-pane">
					<div class="profile-feed row">
						<div class="col-sm-6">
							<?php 
							foreach($activitysp1 as $log){
							?>
							<div class="profile-activity clearfix">
								<div>
									<img class="pull-left" alt="<?php echo $log->nama ?>" src="<?php echo $log->fotoprofil ?>" />
									<a class="user" href="#"> <?php echo $log->nama ?> </a>
									<?php echo logcat($log->action, $log->displaytext, $log->controller) ?>

									<div class="time">
										<i class="ace-icon fa fa-clock-o bigger-110"></i>
										<?php echo timelog($log->tanggal, $log->jam) ?>
									</div>
								</div>

								<div class="tools action-buttons">
<!--
									<a href="#" class="blue">
										<i class="ace-icon fa fa-pencil bigger-125"></i>
									</a>
-->

									<a href="" class="red" onClick="return false">
										<i class="ace-icon fa fa-times bigger-125"></i>
									</a>
								</div>
							</div>
							<?php 
							}
							?>
						</div><!-- /.col -->

						<div class="col-sm-6">
							<?php 
							foreach($activitysp2 as $log){
							?>
							<div class="profile-activity clearfix">
								<div>
									<img class="pull-left" alt="<?php echo $log->nama ?>" src="<?php echo $log->fotoprofil ?>" />
									<a class="user" href="#"> <?php echo $log->nama ?> </a>
									<?php echo logcat($log->action, $log->displaytext, $log->controller) ?>

									<div class="time">
										<i class="ace-icon fa fa-clock-o bigger-110"></i>
										<?php echo timelog($log->tanggal, $log->jam) ?>
									</div>
								</div>

								<div class="tools action-buttons">
									<a href="" class="red" onClick="return false">
										<i class="ace-icon fa fa-times bigger-125"></i>
									</a>
								</div>
							</div>
							<?php 
							}
							?>
						</div><!-- /.col -->
					</div><!-- /.row -->

					<div class="space-12"></div>

					<div class="center">
						<button type="button" class="btn btn-sm btn-primary btn-white btn-round" onclick="window.location='admin/Aktifitasakun/index/Pelanggan'">
							<i class="ace-icon fa fa-rss bigger-150 middle orange2"></i>
							<span class="bigger-110">View more activities</span>

							<i class="icon-on-right ace-icon fa fa-arrow-right"></i>
						</button>
					</div>
				</div><!-- /#feed -->
			</div>
		</div>

		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->