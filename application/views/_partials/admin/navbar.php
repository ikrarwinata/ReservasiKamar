<div id="sidebar" class="sidebar responsive ace-save-state sidebar-fixed sidebar-scroll">
	<script type="text/javascript">
		try{ace.settings.loadState('sidebar')}catch(e){}
	</script>
	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<a href="CPublic" target="_blank" class="btn btn-success">
				<i class="ace-icon fa fa-eye"></i>
			</a>

			<a href="admin/Kamar" class="btn btn-info">
				<i class="ace-icon fa fa-list"></i>
			</a>

			<a href="admin/Tamu" class="btn btn-warning">
				<i class="ace-icon fa fa-check-square-o"></i>
			</a>

			<a href="admin/Reservasi" class="btn btn-danger">
				<i class="ace-icon fa fa-money"></i>
			</a>
		</div>

		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<a href="CPublic" target="_blank" class="btn btn-success">
				<i class="ace-icon fa fa-eye"></i>
			</a>

			<a href="admin/Kamar" class="btn btn-info">
				<i class="ace-icon fa fa-list"></i>
			</a>

			<a href="admin/Tamu" class="btn btn-warning">
				<i class="ace-icon fa fa-check-square-o"></i>
			</a>

			<a href="admin/Reservasi" class="btn btn-danger">
				<i class="ace-icon fa fa-money"></i>
			</a>
		</div>
	</div><!-- /.sidebar-shortcuts -->

	<ul class="nav nav-list">
		<li class="">
			<a href="Admin">
				<i class="menu-icon fa fa-home"></i>
				<span class="menu-text"> Dashboard </span>
			</a>
		</li>
		
		<li class="">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-list"></i>

				<span class="menu-text">
					Kamar
				</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="">
					<a href="admin/Kamar">
						<i class="menu-icon fa fa-caret-right"></i>
						Data Kamar
					</a>

					<b class="arrow"></b>
				</li>
				
				<li class="">
					<a href="admin/Tamu">
						<i class="menu-icon fa fa-caret-right"></i>
						Kamar Digunakan Tamu
					</a>

					<b class="arrow"></b>
				</li>

			</ul>
		</li>
		
		<?php if($this->session->userdata("level")>=2){ ?>
		<li class="">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-money"></i>

				<span class="menu-text">
					Transaksi
				</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="">
					<a href="admin/Reservasi">
						<i class="menu-icon fa fa-caret-right"></i>
						Reservasi
					</a>

					<b class="arrow"></b>
				</li>

				<li class="">
					<a href="admin/Riwayattamu">
						<i class="menu-icon fa fa-caret-right"></i>
						Riwayat Tamu
					</a>

					<b class="arrow"></b>
				</li>

				<?php if($this->session->userdata("level")>=4): ?>
				<li class="">
					<a href="admin/CAdmin/rekap">
						<i class="menu-icon fa fa-caret-right"></i>
						Laporan Transaksi
					</a>

					<b class="arrow"></b>
				</li>
				<?php endif ?>

				<li class="">
					<a href="admin/Pengeluaran">
						<i class="menu-icon fa fa-caret-right"></i>
						Pengeluaran
					</a>

					<b class="arrow"></b>
				</li>
			</ul>
		</li>
		<?php } ?>
		
		<?php if($this->session->userdata("level")>=4){ ?>
		<li class="">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-money"></i>

				<span class="menu-text">
					Rekening BANK
				</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="">
					<a href="admin/Bank/create">
						<i class="menu-icon fa fa-caret-right"></i>
						Tambah Rekening
					</a>

					<b class="arrow"></b>
				</li>

				<li class="">
					<a href="admin/Bank">
						<i class="menu-icon fa fa-caret-right"></i>
						Data Rekening
					</a>

					<b class="arrow"></b>
				</li>
			</ul>
		</li>
		<?php } ?>
		
		<li class="">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-feed"></i>

				<span class="menu-text">
					Riwayat Aktifitas
				</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="">
					<a href="admin/Aktifitasakun/index/Petugas">
						<i class="menu-icon fa fa-caret-right"></i>
						Aktifitas Petugas
					</a>

					<b class="arrow"></b>
				</li>
				
				<li class="">
					<a href="admin/Aktifitasakun/index/Tamu">
						<i class="menu-icon fa fa-caret-right"></i>
						Aktifitas Tamu
					</a>

					<b class="arrow"></b>
				</li>

			</ul>
		</li>

		<li class="">
			<a href="admin/Pelanggan">
				<i class="menu-icon fa fa-users"></i>
				<span class="menu-text"> Data Tamu </span>
			</a>

			<b class="arrow"></b>
		</li>

		<?php if($this->session->userdata("level")>=4){ ?>
		<li class="">
			<a href="admin/Petugas">
				<i class="menu-icon fa fa-users"></i>
				<span class="menu-text"> Data Petugas </span>
			</a>

			<b class="arrow"></b>
		</li>
		<?php } ?>
	</ul><!-- /.nav-list -->

	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>
</div>