<div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
	
	<ul class="nav nav-list">
		<li class="<?php echo (strrpos($konten,"user/home")!==FALSE?"active open":NULL) ?> hover">
			<a href="User">
				<i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text"> Dashboard </span>
			</a>

			<b class="arrow"></b>
		</li>

		<li class="hover">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-list"></i>
				<span class="menu-text">
					Kamar
				</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">

				<li class="hover">
					<a href="user/Kamar">
						<i class="menu-icon fa fa-caret-right"></i>
						Semua Kamar
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="user/Kamar/kosong">
						<i class="menu-icon fa fa-caret-right"></i>
						Kamar Kosong
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="user/Kamar/tamu">
						<i class="menu-icon fa fa-caret-right"></i>
						Kamar Digunakan
					</a>

					<b class="arrow"></b>
				</li>
			</ul>
		</li>

		<li class="hover">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-clock-o"></i>
				<span class="menu-text"> Riwayat </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="hover">
					<a href="user/Riwayat">
						<i class="menu-icon fa fa-caret-right"></i>
						Riwayat Kamar
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="user/Riwayat/reservasi">
						<i class="menu-icon fa fa-caret-right"></i>
						Riwayat Reservasi
					</a>

					<b class="arrow"></b>
				</li>
			</ul>
		</li>

		<li class="hover">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-feed"></i>
				<span class="menu-text"> Aktifitas </span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="hover">
					<a href="user/Aktifitasakun/index/Petugas">
						<i class="menu-icon fa fa-caret-right"></i>
						Aktifitas Petugas
					</a>

					<b class="arrow"></b>
				</li>

				<li class="hover">
					<a href="user/Aktifitasakun/index/Tamu">
						<i class="menu-icon fa fa-caret-right"></i>
						Aktifitas Tamu
					</a>

					<b class="arrow"></b>
				</li>
			</ul>
		</li>
	</ul><!-- /.nav-list -->
</div>