<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div id="modal-form" class="modal" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="blue bigger"></h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12 col-sm-2">

							</div>

							<div class="col-xs-12 col-sm-10">

								<div class="form-group">
									<label for="form-field-password">Password baru</label>

									<div>
										<span class="input-icon col-xs-10 col-sm-7">
											<input type="password" class="form-control" id="form-field-password" placeholder="password" value="" name="password" />
											<i class="ace-icon fa fa-times red hidden" id="perror"></i>
										</span>
										<label class="middle">
											<input class="ace" type="checkbox" id="show-password" />
											<span class="lbl"> Show Password</span>
										</label>
										<input type="hidden" value="" name="idpelanggan" />
									</div>
								</div>

								<div class="space-4"></div>

								<div class="form-group">
									<label for="form-field-first">Konfirmasi Password</label>

									<div>
										<span class="input-icon col-xs-10 col-sm-7">
											<input type="password" class="form-control" id="form-field-password2" placeholder="Konfirmasi password" value="" name="kpassword" />
											<i class="ace-icon fa fa-times red hidden"  id="kperror"></i>
											<span class="middle hidden" id="kperrortext">Konfirmasi password tidak cocok</span>
										</span>
									</div>
								</div>

								<div class="space-4"></div>
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button class="btn btn-sm" data-dismiss="modal">
							<i class="ace-icon fa fa-times"></i>
							Cancel
						</button>

						<button class="btn btn-sm btn-primary" data-dismiss="modal">
							<i class="ace-icon fa fa-check"></i>
							Save
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
				<div class="btn-group btn-corner">
					<button type="button" class="btn btn-white btn-info tooltips-slide-down dropdown-toggle" title="Export ke Excel" data-toggle="dropdown" dropdown-toggle="export">
						<i class="fa fa-share bigger-110"></i>
						<span class="ace-icon fa fa-caret-down icon-on-right"></span>
					</button>
					<ul id="export" class="dropdown-menu dropdown-success hide">
						<li>
							<a href="admin/Petugas/excel/">Export semua data</a>
						</li>

						<li class="divider"></li>

						<li>
							<a href="admin/Petugas/excel?start=<?php echo $start ?>&q=<?php echo $q ?>&limit=10" target="_blank">Export Halaman ini</a>
						</li>
						
						<li>
							<a href="admin/Petugas/excel?&q=<?php echo $q ?>" target="_blank">Export semua hasil pencarian ini</a>
						</li>
					</ul>
					
					<button type="button" data-toggle="dropdown" class="btn btn-white dropdown-toggle btn-info tooltips-slide-down" title="Print" dropdown-toggle="print">
						<i class="fa fa-print bigger-110"></i>
						<span class="ace-icon fa fa-caret-down icon-on-right"></span>
					</button>
					<ul id="print" class="dropdown-menu dropdown-info hide">
						<li>
							<a href="admin/Petugas/print_page/" target="_blank">Print semua data</a>
						</li>

						<li class="divider"></li>

						<li>
							<a href="admin/Petugas/print_page?start=<?php echo $start ?>&q=<?php echo $q ?>&limit=10" target="_blank">Print Halaman ini</a>
						</li>
						
						<li>
							<a href="admin/Petugas/print_page?&q=<?php echo $q ?>" target="_blank">Print semua hasil pencarian ini</a>
						</li>
					</ul>
					
					<a href="admin/Petugas/create" class="btn btn-white btn-success tooltips-slide-down" title="Tambah data">
						<i class="fa fa-plus bigger-110"></i>
					</a>
				</div>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <form action="<?php echo site_url('admin/Petugas/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control search-query" name="q" value="<?php echo $q; ?>" placeholder="Cari data pelanggan">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/Petugas'); ?>" class="btn btn-default btn-sm">Reset</a>
                                    <?php
                                }
                            ?>
							<button class="btn btn-purple btn-sm" type="submit">
								<span class="fa fa-search"></span>
								Cari
							</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
		<div class="row">
			<div class="col-xs-12">
				<table id="simple-table" class="table  table-bordered table-hover">
					<thead>
						<tr>
							<th class="center">
								<label class="pos-rel">
									Id
								</label>
							</th>
							<th class="detail-col">Details</th>
							<th>Nama</th>
							<th>Usia</th>
							<th class="hidden-480">
								<i class="ace-icon fa fa-envelope bigger-110 hidden-480"></i>
								Email
							</th>

							<th>
								<i class="ace-icon fa fa-phone bigger-110 hidden-480"></i>
								Telepon
							</th>

							<th></th>
						</tr>
					</thead>

					<tbody>
						<?php 
						foreach($petugas_data as $petugas){
						?>
						<tr>
							<td class="center">
								<label class="pos-rel data-id"><?php echo $petugas->idpetugas ?></label>
							</td>

							<td class="center">
								<div class="action-buttons">
									<a href="#" class="green bigger-140 show-details-btn" title="Show Details" onClick="return false">
										<i class="ace-icon fa fa-angle-double-down"></i>
										<span class="sr-only">Details</span>
									</a>
								</div>
							</td>

							<td>
								<a href="" onClick="return false"><?php echo $petugas->nama ?></a>
							</td>
							<td>
								<?php echo (date("Y") - explode("-", $petugas->tgllahir)[2]) ?> Tahun
							</td>
							<td class="hidden-480"><?php echo $petugas->email ?></td>
							<td><?php echo $petugas->telepon ?></td>

							<td>
								<div class="hidden-sm hidden-xs btn-group">
									<button class="btn btn-xs btn-info tooltips-slide-down" title="Edit">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>

									<button class="btn btn-xs btn-danger tooltips-slide-down" title="DoubleClick: Hapus">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</button>

									<a href="#modal-form" role="button" data-toggle="modal" class="btn btn-xs btn-warning tooltips-slide-down" title="Ganti Password">
										<i class="ace-icon fa fa-flag bigger-120"></i>
									</a>
								</div>

								<div class="hidden-md hidden-lg">
									<div class="inline pos-rel">
										<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
											<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
										</button>

										<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
											<li>
												<button class="btn btn-xs btn-info tooltips-slide-down" title="Edit">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
												</button>
											</li>

											<li>
												<button class="btn btn-xs btn-danger tooltips-slide-down" title="DoubleClick: Hapus">
													<i class="ace-icon fa fa-trash-o bigger-120"></i>
												</button>
											</li>

											<li>
												<a href="#modal-form" role="button" data-toggle="modal" class="btn btn-xs btn-warning tooltips-slide-down" title="Ganti Password">
													<i class="ace-icon fa fa-flag bigger-120"></i>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</td>
						</tr>

						<tr class="detail-row">
							<td colspan="8">
								<div class="table-detail">
									<div class="row">
										<div class="col-xs-12 col-sm-2">
											<div class="text-center">
												<?php 
												if($petugas->fotoprofil!==NULL){
												?>
												<img height="150" class="thumbnail inline no-margin-bottom" alt="<?php echo $petugas->nama ?>" src="<?php echo $petugas->fotoprofil ?>" />
												<?php 
												}else{
												?>
												<img height="150" class="thumbnail inline no-margin-bottom" alt="<?php echo $petugas->nama ?>" src="uploads/petugas/usernoimage.png" />
												<?php 
												}
												?>
												<br />
												<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
													<div class="inline position-relative">
														<a class="user-title-label" href="#">
															<i class="ace-icon fa fa-circle light-green"></i>
															&nbsp;
															<span class="white"><?php echo str_shortened($petugas->nama, 13) ?></span>
														</a>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xs-12 col-sm-10">
											<div class="space visible-xs"></div>

											<div class="profile-user-info profile-user-info-striped">

												<div class="profile-info-row">
													<div class="profile-info-name"> Email </div>

													<div class="profile-info-value">
														<span><?php echo $petugas->email ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Telepon </div>

													<div class="profile-info-value">
														<span><?php echo $petugas->telepon ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Usia </div>

													<div class="profile-info-value">
														<span><?php echo (date("Y") - explode("-", $petugas->tgllahir)[2]) ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Tanggal Lahir </div>

													<div class="profile-info-value">
														<span><?php echo $petugas->tgllahir ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Alamat </div>

													<div class="profile-info-value">
<!--														<i class="fa fa-map-marker light-orange bigger-110"></i>-->
														<span><?php echo $petugas->alamat ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Username </div>

													<div class="profile-info-value">
														<span><?php echo $petugas->username ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Password </div>

													<div class="profile-info-value">
														<span><?php echo $petugas->password ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Jabatan/Posisi </div>

													<div class="profile-info-value">
														<span><?php echo string_level($petugas->level) ?></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<?php 
						}
						?>
					</tbody>
				</table>
			</div><!-- /.span -->
		</div><!-- /.row -->

        <div class="row">
            <div class="col-xs-6">
				<div class="dataTables_info">Showing <?php echo $start+1?> to <?php echo $start+$per_page ?> of <?php echo $total_rows ?> entries</div>
	   		</div>
            <div class="col-xs-6">
				<div class="dataTables_paginate paging_simple_numbers">
					<?php echo $pagination ?>
				</div>
            </div>
        </div>
		<div class="hr hr-18 dotted hr-double"></div>

		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->