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
									<label for="form-field-password">Pembayaran</label>

									<div>
										<div class="input-icon col-xs-12 col-sm-12">
											<input name="bayar" id="bayar" class="ace ace-switch ace-switch-6" type="checkbox" />
											<span class="lbl"> &nbsp; Lunas</span>
										</div>
										<input type="hidden" value="" id="idtamu" />
										<input type="hidden" id="bb" value="0">
									</div>
								</div>

								<div class="space-4"></div>

								<div class="form-group">
									<label for="form-field-password">Tanggal Keluar</label>

									<div>
										<span class="input-icon col-xs-10 col-sm-7">
											<input type="text" class="form-control date-picker" id="tglc" placeholder="Tanggal checkout" data-date-format="dd-mm-yyyy" value="" name="tglkeluar" />
											<i class="ace-icon fa fa-times red hidden" id="terror"></i>
										</span>
										<input type="hidden" value="" name="id" />
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
					<a href="admin/Tamu/excel" class="btn btn-white btn-info tooltips-slide-down" title="Export ke Excel">
						<i class="fa fa-share bigger-110"></i>
						<span class="ace-icon fa fa-caret-down icon-on-right"></span>
					</a>
					
					<button type="button" data-toggle="dropdown" class="btn btn-white dropdown-toggle btn-info tooltips-slide-down" title="Print" dropdown-toggle="print">
						<i class="fa fa-print bigger-110"></i>
						<span class="ace-icon fa fa-caret-down icon-on-right"></span>
					</button>
					<ul id="print" class="dropdown-menu dropdown-info hide">
						<li>
							<a href="admin/Tamu/print_page/" target="_blank">Print semua data</a>
						</li>

						<li class="divider"></li>

						<li>
							<a href="admin/Tamu/print_page?start=<?php echo $start ?>&q=<?php echo $q ?>&limit=10" target="_blank">Print Halaman ini</a>
						</li>
						
						<li>
							<a href="admin/Tamu/print_page?&q=<?php echo $q ?>" target="_blank">Print semua hasil pencarian ini</a>
						</li>
					</ul>
					
					<a href="admin/Tamu/create" class="btn btn-white btn-success tooltips-slide-down" title="Tambah data">
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
                <form action="<?php echo site_url('admin/Tamu/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control search-query" name="q" value="<?php echo $q; ?>" placeholder="Cari Tamu">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/Tamu'); ?>" class="btn btn-default btn-sm">Reset</a>
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
							<th>Nomor Kamar</th>
							<th>Tarif <span class="small">(Rp.)</span></th>
							<th>
								<i class="ace-icon fa fa-user bigger-110 hidden-480"></i>
								Tamu
							</th>
							<th>Terbayar <span class="small">(Rp.)</span></th>
							<th></th>
						</tr>
					</thead>

					<tbody>
						<?php 
						foreach($tamu_data as $kamar){
						?>
						<tr>
							<td class="center">
								<label class="pos-rel data-id"><?php echo $kamar->id ?></label>
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
								<a href="" onClick="return false"><?php echo $kamar->nomorkamar ?></a>
							</td>
							<td>
								<?php echo format_number($kamar->tarif) ?>
							</td>
							<td class="hidden-480"><?php echo $kamar->nama ?></td>
							<td><?php echo format_number($kamar->pembayaran) ?></td>
							<td>
								<div class="hidden-sm hidden-xs btn-group">
									<button class="btn btn-xs btn-info tooltips-slide-down" title="Edit">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>

									<button class="btn btn-xs btn-danger tooltips-slide-down" title="DoubleClick: Hapus">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</button>

									<a href="#modal-form" role="button" data-toggle="modal" class="btn btn-xs btn-warning tooltips-slide-down" title="Tandai telah CheckOut">
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
												<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
													<span class="blue">
														<i class="ace-icon fa fa-search-plus bigger-120"></i>
													</span>
												</a>
											</li>

											<li>
												<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
													<span class="green">
														<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
													</span>
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
												if($kamar->fotoprofil!==NULL){
												?>
												<img height="auto" width="150" class="thumbnail inline no-margin-bottom" alt="" src="<?php echo $kamar->fotoprofil ?>" />
												<?php 
												}else{
												?>
												<img height="auto" width="150" class="thumbnail inline no-margin-bottom" alt="<?php echo $kamar->nama ?>" src="uploads/pelanggan/profile/usernoimage.png" />
												<?php 
												}
												?>
												<br />
												<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
													<div class="inline position-relative">
														<a class="user-title-label" href="#">
															<i class="ace-icon fa fa-circle light-green"></i>
															&nbsp;
															<span class="white"><?php echo $kamar->nama ?></span>
														</a>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xs-12 col-sm-10">
											<div class="space visible-xs"></div>

											<div class="profile-user-info profile-user-info-striped">

												<div class="profile-info-row">
													<div class="profile-info-name"> Tamu saat ini </div>

													<div class="profile-info-value">
														<span><a href="admin/Pelanggan/read/<?php echo $kamar->idpelanggan ?>"><?php echo $kamar->nama ?></a></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Telepon </div>

													<div class="profile-info-value">
														<span><?php echo $kamar->telepon ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Usia </div>

													<div class="profile-info-value">
														<span><?php echo (date("Y") - explode("-", $kamar->tgllahir)[2]) ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Tanggal Lahir </div>

													<div class="profile-info-value">
														<span><?php echo $kamar->tgllahir ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Alamat </div>

													<div class="profile-info-value">
														<i class="fa fa-clock light-orange bigger-110"></i>
														<span><?php echo $kamar->tglmasuk ?></span>
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