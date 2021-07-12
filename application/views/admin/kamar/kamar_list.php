<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
				<div class="btn-group btn-corner">
					<button type="button" class="btn btn-white btn-info tooltips-slide-down dropdown-toggle" title="Export ke Excel" data-toggle="dropdown" dropdown-toggle="export">
						<i class="fa fa-share bigger-110"></i>
						<span class="ace-icon fa fa-caret-down icon-on-right"></span>
					</button>
					<ul id="export" class="dropdown-menu dropdown-success hide">
						<li>
							<a href="admin/Kamar/excel/">Export semua data</a>
						</li>

						<li class="divider"></li>

						<li>
							<a href="admin/Kamar/excel?start=<?php echo $start ?>&q=<?php echo $q ?>&limit=10" target="_blank">Export Halaman ini</a>
						</li>
						
						<li>
							<a href="admin/Kamar/excel?&q=<?php echo $q ?>" target="_blank">Export semua hasil pencarian ini</a>
						</li>
					</ul>
					
					<button type="button" data-toggle="dropdown" class="btn btn-white dropdown-toggle btn-info tooltips-slide-down" title="Print" dropdown-toggle="print">
						<i class="fa fa-print bigger-110"></i>
						<span class="ace-icon fa fa-caret-down icon-on-right"></span>
					</button>
					<ul id="print" class="dropdown-menu dropdown-info hide">
						<li>
							<a href="admin/Kamar/print_page/" target="_blank">Print semua data</a>
						</li>

						<li class="divider"></li>

						<li>
							<a href="admin/Kamar/print_page?start=<?php echo $start ?>&q=<?php echo $q ?>&limit=10" target="_blank">Print Halaman ini</a>
						</li>
						
						<li>
							<a href="admin/Kamar/print_page?&q=<?php echo $q ?>" target="_blank">Print semua hasil pencarian ini</a>
						</li>
					</ul>
					
					<a href="admin/Kamar/create" class="btn btn-white btn-success tooltips-slide-down" title="Tambah data">
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
                <form action="<?php echo site_url('admin/Kamar/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control search-query" name="q" value="<?php echo $q; ?>" placeholder="Cari kamar">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/Kamar'); ?>" class="btn btn-default btn-sm">Reset</a>
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
								<i class="ace-icon fa fa-clock bigger-110 hidden-480"></i>
								Status
							</th>
							<th></th>
						</tr>
					</thead>

					<tbody>
						<?php 
						function states($s){
							$result = "<span class='label label-sm label-success'>Kosong</span>";
							if($s==TRUE){
								$result = "<span class='label label-sm label-warning'>Digunakan</span>";
							};
							return $result;
						}

						foreach($kamar_data as $kamar){
						?>
						<tr>
							<td class="center">
								<label class="pos-rel data-id"><?php echo $kamar->idkamar ?></label>
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
								<?php echo number_format($kamar->tarif) ?>
							</td>
							<td class="hidden-480"><?php echo states($kamar->digunakan) ?></td>
							<td>
								<div class="hidden-sm hidden-xs btn-group">
									<button class="btn btn-xs btn-info tooltips-slide-down" title="Edit">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>

									<button class="btn btn-xs btn-danger tooltips-slide-down" title="DoubleClick: Hapus">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</button>
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
												if($kamar->fotokamar!==NULL){
												?>
												<img height="auto" width="180" class="thumbnail inline no-margin-bottom" alt="" src="<?php echo $kamar->fotokamar ?>" />
												<?php 
												}else{
												?>
												<img height="auto" width="180" class="thumbnail inline no-margin-bottom" alt="<?php echo $kamar->nama ?>" src="uploads/kamar/kamarnoimage.jpg" />
												<?php 
												}
												?>
											</div>
										</div>

										<div class="col-xs-12 col-sm-8">
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

										<div class="col-xs-12 col-sm-2">
											<div class="text-center">
												<img height="150" class="thumbnail inline no-margin-bottom" alt="<?php echo $kamar->nama ?>" src="<?php echo $kamar->fotoprofil ?>" />
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<?php 
						}
						?>

						<?php 
						foreach($kamarnotamu_data as $kamar){
						?>
						<tr>
							<td class="center">
								<label class="pos-rel data-id"><?php echo $kamar->idkamar ?></label>
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
								<?php echo number_format($kamar->tarif) ?>
							</td>
							<td class="hidden-480"><?php echo states($kamar->digunakan) ?></td>
							<td>
								<div class="hidden-sm hidden-xs btn-group">
									<button class="btn btn-xs btn-info tooltips-slide-down" title="Edit">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>

									<button class="btn btn-xs btn-danger tooltips-slide-down" title="DoubleClick: Hapus">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</button>
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
												if($kamar->fotokamar!==NULL){
												?>
												<img height="auto" width="150" class="thumbnail inline no-margin-bottom" alt="" src="<?php echo $kamar->fotokamar ?>" />
												<?php 
												}else{
												?>
												<img height="auto" width="150" class="thumbnail inline no-margin-bottom" alt="<?php echo $kamar->nama ?>" src="uploads/kamar/kamarnoimage.png" />
												<?php 
												}
												?>
												<br />
												<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
													<div class="inline position-relative">
														<a class="user-title-label" href="#">
															<i class="ace-icon fa fa-circle light-green"></i>
															&nbsp;
															<span class="white"><?php echo $kamar->nomorkamar ?></span>
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
														<span>Kosong</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Telepon </div>

													<div class="profile-info-value">
														<span>-</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Usia </div>

													<div class="profile-info-value">
														<span>-</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Tanggal Lahir </div>

													<div class="profile-info-value">
														<span>-</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Alamat </div>

													<div class="profile-info-value">
														<i class="fa fa-clock light-orange bigger-110"></i>
														<span>-</span>
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