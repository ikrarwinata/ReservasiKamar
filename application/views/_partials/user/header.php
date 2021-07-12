<div id="navbar" class="navbar navbar-default    navbar-collapse       h-navbar ace-save-state">
	<div class="navbar-container ace-save-state" id="navbar-container">
		<div class="navbar-header pull-left">
			<a href="index.html" class="navbar-brand">
				<small>
					<small><?php echo ($this->config->item("app_name")) ?></small>
				</small>
			</a>

			<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
				<span class="sr-only">Toggle user menu</span>

				<img src="assets/images/avatars/user.jpg" alt="Jason's Photo" />
			</button>

			<button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
				<span class="sr-only">Toggle sidebar</span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>
			</button>
		</div>

		<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
			<ul class="nav ace-nav">

				<li class="light-blue dropdown-modal user-min">
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
							<a href="" onclick="return profil_callback()" id="link-read-user-profile" role="button">
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