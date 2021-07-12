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
									<label for="form-field-password">Berikan alasan</label>

									<div>
										<span class="input-icon col-xs-10 col-sm-7">
											<input type="text" class="form-control" id="form-field-text" placeholder="Alasan" value="" name="messages" />
										</span>
										<input type="hidden" value="" name="idpelanggan" />
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
							Kirim
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
				
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <form action="<?php echo site_url('admin/Reservasi/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control search-query" name="q" value="<?php echo $q; ?>" placeholder="Cari reservasi">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/Reservasi'); ?>" class="btn btn-default btn-sm">Reset</a>
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
				<div class="tabbable">
					<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab">
						<li class="active">
							<a data-toggle="tab" href="#waiting" id="tabwaiting">Menunggu Konfirmasi</a>
						</li>

						<li>
							<a data-toggle="tab" href="#accepted" id="tabaccepted">Diterima</a>
						</li>

						<li>
							<a data-toggle="tab" href="#rejected" id="tabrejected">Ditolak</a>
						</li>

						<li>
							<a data-toggle="tab" href="#all" id="taball">Semua Data</a>
						</li>
					</ul>

					<div class="tab-content">
						<div id="waiting" class="tab-pane in active">
							<table id="simple-table2" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th class="center">
											<label class="pos-rel">
												Id
											</label>
										</th>
										<th class="detail-col">Details</th>
										<th>Nama Tamu</th>
										<th>Tanggal</th>
										<th>Kamar Reservasi</th>
										<th>
											<i class="ace-icon fa fa-calendar bigger-110 hidden-480"></i>
											Tanggal Checkin
										</th>
										<th>
											<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
											Lama Inap
										</th>
										<th class="hidden-480">Tarif Kamar</th>
										<th>Status</th>

										<th></th>
									</tr>
								</thead>

								<tbody>
									<?php 
									foreach($reservasi_datawaiting as $reservasiw){
									?>
									<tr>
										<td class="center">
											<label class="pos-rel data-id"><?php echo $reservasiw->idreservasi ?></label>
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
											<a href="admin/Pelanggan/read/<?php echo $reservasiw->idpelanggan ?>"><?php echo $reservasiw->namapelanggan ?></a>
										</td>
										<td><?php echo $reservasiw->tglreservasi ?></td>
										<td><?php echo $reservasiw->nomorkamar ?></td>
										<td><?php echo $reservasiw->tglcheckin ?></td>
										<td><?php echo $reservasiw->lamainap ?> Hari</td>
										<td class="hidden-480">Rp.<?php echo format_number($reservasiw->tarif) ?></td>
										<td><span class='label label-sm label-warning'><?php echo string_statusresv($reservasiw->status) ?></span></td>

										<td>
											<div class="hidden-sm hidden-xs btn-group">
												<button class="btn btn-xs btn-info tooltips-slide-down" title="Konfirmasi">
													<i class="ace-icon fa fa-check bigger-120"></i>
												</button>

												<a href="#modal-form" role="button" data-toggle="modal" class="btn btn-xs btn-warning tooltips-slide-down" title="Tolak dan berikan Alasan">
													<i class="ace-icon fa fa-flag bigger-120"></i>
												</a>

												<button class="btn btn-xs btn-danger tooltips-slide-down" title="DoubleClick: Tolak Tanpa Alasan">
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
															<button class="btn btn-xs btn-info tooltips-slide-down" title="Konfirmasi">
																<i class="ace-icon fa fa-check bigger-120"></i>
															</button>
														</li>

														<li>
															<a href="#modal-form" role="button" data-toggle="modal" class="btn btn-xs btn-warning tooltips-slide-down" title="Tolak dan berikan Alasan">
																<i class="ace-icon fa fa-flag bigger-120"></i>
															</a>
														</li>

														<li>
															<button class="btn btn-xs btn-danger tooltips-slide-down" title="DoubleClick: Tolak Tanpa Alasan">
																<i class="ace-icon fa fa-trash-o bigger-120"></i>
															</button>
														</li>
													</ul>
												</div>
											</div>
										</td>
									</tr>

									<tr class="detail-row">
										<td colspan="12">
											<div class="table-detail">
												<div class="row">
													<div class="col-xs-12 col-sm-2">
														<div class="text-center">
															<?php 
															if($reservasiw->fotoprofil!==NULL){
															?>
															<img class="thumbnail inline no-margin-bottom" alt="<?php echo $reservasiw->namapelanggan ?>" src="<?php echo $reservasiw->fotoprofil ?>" style="width: 100%; height: auto" />
															<?php 
															}else{
															?>
															<img class="thumbnail inline no-margin-bottom" alt="<?php echo $reservasiw->namapelanggan ?>" src="uploads/pelanggan/profile/usernoimage.png"  style="width: 100%; height: auto" />
															<?php 
															}
															?>
															<br />
															<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
																<div class="inline position-relative">
																	<a class="user-title-label" href="#">
																		<i class="ace-icon fa fa-circle light-green"></i>
																		&nbsp;
																		<span class="white"><?php echo str_shortened($reservasiw->namapelanggan,13) ?></span>
																	</a>
																</div>
															</div>
														</div>
													</div>

													<div class="col-xs-12 col-sm-8">
														<div class="space visible-xs"></div>

														<div class="profile-user-info profile-user-info-striped">

															<div class="profile-info-row">
																<div class="profile-info-name"> Email </div>

																<div class="profile-info-value">
																	<span><?php echo $reservasiw->email ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Telepon </div>

																<div class="profile-info-value">
																	<span><?php echo $reservasiw->telepon ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Jenis Kelamin </div>

																<div class="profile-info-value">
			<!--														<i class="fa fa-map-marker light-orange bigger-110"></i>-->
																	<span><?php echo $reservasiw->jeniskelamin ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Usia </div>

																<div class="profile-info-value">
																	<span><?php echo (date("Y") - explode("-", $reservasiw->tgllahir)[2]) ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Tanggal Lahir </div>

																<div class="profile-info-value">
																	<span><?php echo $reservasiw->tgllahir ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Bukti Pembayaran </div>

																<div class="profile-info-value">
																	<?php if (isset($reservasiw->buktipembayaran)): ?>
																		<?php if ($reservasiw->buktipembayaran!=NULL): ?>
																			<span><a href="<?php echo $reservasiw->buktipembayaran ?>"><i class="fa fa-eye"></i>&nbsp;LIHAT</a></span>
																		<?php endif ?>
																	<?php endif ?>
																</div>
															</div>
														</div>
													</div>

													<div class="col-xs-12 col-sm-2">
														<div class="text-center">
															<img class="thumbnail inline no-margin-bottom" alt="<?php echo $reservasiw->namapelanggan ?>" src="<?php echo $reservasiw->fotoktp ?>" style="width: 100%; height: auto" />
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
						</div>
						
						<div id="accepted" class="tab-pane">
							<table id="simple-table3" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th class="center">
											<label class="pos-rel">
												Id
											</label>
										</th>
										<th class="detail-col">Details</th>
										<th>Nama Tamu</th>
										<th>Tanggal</th>
										<th>Kamar Reservasi</th>
										<th>
											<i class="ace-icon fa fa-calendar bigger-110 hidden-480"></i>
											Tanggal Checkin
										</th>
										<th>
											<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
											Lama Inap
										</th>
										<th class="hidden-480">Tarif Kamar</th>
										<th>Status</th>

										<th></th>
									</tr>
								</thead>

								<tbody>
									<?php 
									foreach($reservasi_dataaccepted as $reservasiw){
									?>
									<tr>
										<td class="center">
											<label class="pos-rel data-id"><?php echo $reservasiw->idreservasi ?></label>
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
											<a href="admin/Pelanggan/read/<?php echo $reservasiw->idpelanggan ?>"><?php echo $reservasiw->namapelanggan ?></a>
										</td>
										<td><?php echo $reservasiw->tglreservasi ?></td>
										<td><?php echo $reservasiw->nomorkamar ?></td>
										<td><?php echo $reservasiw->tglcheckin ?></td>
										<td><?php echo $reservasiw->lamainap ?> Hari</td>
										<td class="hidden-480">Rp.<?php echo format_number($reservasiw->tarif) ?></td>
										<td><span class='label label-sm label-warning'><?php echo string_statusresv($reservasiw->status) ?></span></td>

										<td>
											<div class="hidden-sm hidden-xs btn-group">
												<?php if($reservasiw->status==2){ ?>
													<button class="btn btn-xs btn-success tooltips-slide-down" title="Enter Room">
														<i class="ace-icon fa fa-check bigger-120"></i>
													</button>
												<?php } ?>
												<a href="#modal-form" role="button" data-toggle="modal" class="btn btn-xs btn-warning tooltips-slide-down" title="Tolak dan berikan Alasan">
													<i class="ace-icon fa fa-flag bigger-120"></i>
												</a>

												<button class="btn btn-xs btn-danger tooltips-slide-down" title="DoubleClick: Tolak Tanpa Alasan">
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
										<td colspan="12">
											<div class="table-detail">
												<div class="row">
													<div class="col-xs-12 col-sm-2">
														<div class="text-center">
															<?php 
															if($reservasiw->fotoprofil!==NULL){
															?>
															<img class="thumbnail inline no-margin-bottom" alt="<?php echo $reservasiw->namapelanggan ?>" src="<?php echo $reservasiw->fotoprofil ?>" style="width: 100%; height: auto" />
															<?php 
															}else{
															?>
															<img class="thumbnail inline no-margin-bottom" alt="<?php echo $reservasiw->namapelanggan ?>" src="uploads/pelanggan/profile/usernoimage.png" style="width: 100%; height: auto" />
															<?php 
															}
															?>
															<br />
															<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
																<div class="inline position-relative">
																	<a class="user-title-label" href="#">
																		<i class="ace-icon fa fa-circle light-green"></i>
																		&nbsp;
																		<span class="white"><?php echo str_shortened($reservasiw->namapelanggan,13) ?></span>
																	</a>
																</div>
															</div>
														</div>
													</div>

													<div class="col-xs-12 col-sm-8">
														<div class="space visible-xs"></div>

														<div class="profile-user-info profile-user-info-striped">

															<div class="profile-info-row">
																<div class="profile-info-name"> Email </div>

																<div class="profile-info-value">
																	<span><?php echo $reservasiw->email ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Telepon </div>

																<div class="profile-info-value">
																	<span><?php echo $reservasiw->telepon ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Jenis Kelamin </div>

																<div class="profile-info-value">
			<!--														<i class="fa fa-map-marker light-orange bigger-110"></i>-->
																	<span><?php echo $reservasiw->jeniskelamin ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Usia </div>

																<div class="profile-info-value">
																	<span><?php echo (date("Y") - explode("-", $reservasiw->tgllahir)[2]) ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Tanggal Lahir </div>

																<div class="profile-info-value">
																	<span><?php echo $reservasiw->tgllahir ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Bukti Pembayaran </div>

																<div class="profile-info-value">
																	<?php if (isset($reservasiw->buktipembayaran)): ?>
																		<?php if ($reservasiw->buktipembayaran!=NULL): ?>
																			<span><a href="<?php echo $reservasiw->buktipembayaran ?>"><i class="fa fa-eye"></i>&nbsp;LIHAT</a></span>
																		<?php endif ?>
																	<?php endif ?>
																</div>
															</div>
														</div>
													</div>

													<div class="col-xs-12 col-sm-2">
														<div class="text-center">
															<img class="thumbnail inline no-margin-bottom" alt="<?php echo $reservasiw->namapelanggan ?>" src="<?php echo $reservasiw->fotoktp ?>" style="width: 100%; height: auto" />
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
						</div>

						<div id="rejected" class="tab-pane">
							<table id="simple-table4" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th class="center">
											<label class="pos-rel">
												Id
											</label>
										</th>
										<th class="detail-col">Details</th>
										<th>Nama Tamu</th>
										<th>Tanggal</th>
										<th>Kamar Reservasi</th>
										<th>
											<i class="ace-icon fa fa-calendar bigger-110 hidden-480"></i>
											Tanggal Checkin
										</th>
										<th>
											<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
											Lama Inap
										</th>
										<th class="hidden-480">Tarif Kamar</th>
										<th>Status</th>

										<th></th>
									</tr>
								</thead>

								<tbody>
									<?php 
									foreach($reservasi_datarejected as $reservasiw){
									?>
									<tr>
										<td class="center">
											<label class="pos-rel data-id"><?php echo $reservasiw->idreservasi ?></label>
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
											<a href="admin/Pelanggan/read/<?php echo $reservasiw->idpelanggan ?>"><?php echo $reservasiw->namapelanggan ?></a>
										</td>
										<td><?php echo $reservasiw->tglreservasi ?></td>
										<td><?php echo $reservasiw->nomorkamar ?></td>
										<td><?php echo $reservasiw->tglcheckin ?></td>
										<td><?php echo $reservasiw->lamainap ?> Hari</td>
										<td class="hidden-480">Rp.<?php echo format_number($reservasiw->tarif) ?></td>
										<td><span class='label label-sm label-warning'><?php echo string_statusresv($reservasiw->status) ?></span></td>

										<td>
											<div class="hidden-sm hidden-xs btn-group">
												<button class="btn btn-xs btn-info tooltips-slide-down" title="Konfirmasi">
													<i class="ace-icon fa fa-check bigger-120"></i>
												</button>

												<a href="#modal-form" role="button" data-toggle="modal" class="btn btn-xs btn-warning tooltips-slide-down" title="Tolak dan berikan Alasan">
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
															<button class="btn btn-xs btn-info tooltips-slide-down" title="Konfirmasi">
																<i class="ace-icon fa fa-check bigger-120"></i>
															</button>
														</li>

														<li>
															<a href="#modal-form" role="button" data-toggle="modal" class="btn btn-xs btn-warning tooltips-slide-down" title="Tolak dan berikan Alasan">
																<i class="ace-icon fa fa-flag bigger-120"></i>
															</a>
														</li>
													</ul>
												</div>
											</div>
										</td>
									</tr>

									<tr class="detail-row">
										<td colspan="12">
											<div class="table-detail">
												<div class="row">
													<div class="col-xs-12 col-sm-2">
														<div class="text-center">
															<?php 
															if($reservasiw->fotoprofil!==NULL){
															?>
															<img class="thumbnail inline no-margin-bottom" alt="<?php echo $reservasiw->namapelanggan ?>" src="<?php echo $reservasiw->fotoprofil ?>" style="width: 100%; height: auto" />
															<?php 
															}else{
															?>
															<img class="thumbnail inline no-margin-bottom" alt="<?php echo $reservasiw->namapelanggan ?>" src="uploads/pelanggan/profile/usernoimage.png" style="width: 100%; height: auto" />
															<?php 
															}
															?>
															<br />
															<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
																<div class="inline position-relative">
																	<a class="user-title-label" href="#">
																		<i class="ace-icon fa fa-circle light-green"></i>
																		&nbsp;
																		<span class="white"><?php echo str_shortened($reservasiw->namapelanggan,13) ?></span>
																	</a>
																</div>
															</div>
														</div>
													</div>

													<div class="col-xs-12 col-sm-8">
														<div class="space visible-xs"></div>

														<div class="profile-user-info profile-user-info-striped">

															<div class="profile-info-row">
																<div class="profile-info-name"> Email </div>

																<div class="profile-info-value">
																	<span><?php echo $reservasiw->email ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Telepon </div>

																<div class="profile-info-value">
																	<span><?php echo $reservasiw->telepon ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Jenis Kelamin </div>

																<div class="profile-info-value">
			<!--														<i class="fa fa-map-marker light-orange bigger-110"></i>-->
																	<span><?php echo $reservasiw->jeniskelamin ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Usia </div>

																<div class="profile-info-value">
																	<span><?php echo (date("Y") - explode("-", $reservasiw->tgllahir)[2]) ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Tanggal Lahir </div>

																<div class="profile-info-value">
																	<span><?php echo $reservasiw->tgllahir ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Bukti Pembayaran </div>

																<div class="profile-info-value">
																	<?php if (isset($reservasiw->buktipembayaran)): ?>
																		<?php if ($reservasiw->buktipembayaran!=NULL): ?>
																			<span><a href="<?php echo $reservasiw->buktipembayaran ?>"><i class="fa fa-eye"></i>&nbsp;LIHAT</a></span>
																		<?php endif ?>
																	<?php endif ?>
																</div>
															</div>
														</div>
													</div>

													<div class="col-xs-12 col-sm-2">
														<div class="text-center">
															<img class="thumbnail inline no-margin-bottom" alt="<?php echo $reservasiw->namapelanggan ?>" src="<?php echo $reservasiw->fotoktp ?>" style="width: 100%; height: auto"  />
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
						</div>

						<div id="all" class="tab-pane">
							<table id="simple-table" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th class="center">
											<label class="pos-rel">
												Id
											</label>
										</th>
										<th class="detail-col">Details</th>
										<th>Nama Tamu</th>
										<th>Tanggal</th>
										<th>Kamar Reservasi</th>
										<th>
											<i class="ace-icon fa fa-calendar bigger-110 hidden-480"></i>
											Tanggal Checkin
										</th>
										<th>
											<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
											Lama Inap
										</th>
										<th class="hidden-480">Tarif Kamar</th>
										<th>Status</th>

										<th></th>
									</tr>
								</thead>

								<tbody>
									<?php 
									foreach($reservasi_dataall as $reservasi){
									?>
									<tr>
										<td class="center">
											<label class="pos-rel data-id"><?php echo $reservasi->idreservasi ?></label>
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
											<a href="admin/Pelanggan/read/<?php echo $reservasiw->idpelanggan ?>"><?php echo $reservasi->namapelanggan ?></a>
										</td>
										<td><?php echo $reservasi->tglreservasi ?></td>
										<td><?php echo $reservasi->nomorkamar ?></td>
										<td><?php echo $reservasi->tglcheckin ?></td>
										<td><?php echo $reservasi->lamainap ?> Hari</td>
										<td class="hidden-480">Rp.<?php echo format_number($reservasi->tarif) ?></td>
										<td><span class='label label-sm label-warning'><?php echo string_statusresv($reservasi->status) ?></span></td>

										<td>
											<div class="hidden-sm hidden-xs btn-group">
												<button class="btn btn-xs btn-info tooltips-slide-down" title="Konfirmasi">
													<i class="ace-icon fa fa-check bigger-120"></i>
												</button>

												<a href="#modal-form" role="button" data-toggle="modal" class="btn btn-xs btn-warning tooltips-slide-down" title="Tolak dan berikan Alasan">
													<i class="ace-icon fa fa-flag bigger-120"></i>
												</a>

												<button class="btn btn-xs btn-danger tooltips-slide-down" title="DoubleClick: Tolak Tanpa Alasan">
													<i class="ace-icon fa fa-trash-o bigger-120"></i>
												</button>
												<a href="admin/CAdmin/print_transaksi/<?php echo $reservasi->idreservasi ?>" class="btn btn-xs btn-success tooltips-slide-down" title="Cetak Transaksi" target="_blank">
													<i class="ace-icon fa fa-print bigger-120"></i>
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

														<li>
															<a href="admin/CAdmin/print_transaksi/<?php echo $reservasi->idreservasi ?>" class="btn btn-xs btn-success tooltips-slide-down" title="Cetak Transaksi" target="_blank">
																<i class="ace-icon fa fa-print bigger-120"></i>
															</a>
														</li>
													</ul>
												</div>
											</div>
										</td>
									</tr>

									<tr class="detail-row">
										<td colspan="12">
											<div class="table-detail">
												<div class="row">
													<div class="col-xs-12 col-sm-2">
														<div class="text-center">
															<?php 
															if($reservasi->fotoprofil!==NULL){
															?>
															<img class="thumbnail inline no-margin-bottom" alt="<?php echo $reservasi->namapelanggan ?>" src="<?php echo $reservasi->fotoprofil ?>" style="width: 100%; height: auto" />
															<?php 
															}else{
															?>
															<img class="thumbnail inline no-margin-bottom" alt="<?php echo $reservasi->namapelanggan ?>" src="uploads/pelanggan/profile/usernoimage.png" style="width: 100%; height: auto" />
															<?php 
															}
															?>
															<br />
															<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
																<div class="inline position-relative">
																	<a class="user-title-label" href="#">
																		<i class="ace-icon fa fa-circle light-green"></i>
																		&nbsp;
																		<span class="white"><?php echo str_shortened($reservasi->namapelanggan,13) ?></span>
																	</a>
																</div>
															</div>
														</div>
													</div>

													<div class="col-xs-12 col-sm-8">
														<div class="space visible-xs"></div>

														<div class="profile-user-info profile-user-info-striped">

															<div class="profile-info-row">
																<div class="profile-info-name"> Email </div>

																<div class="profile-info-value">
																	<span><?php echo $reservasi->email ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Telepon </div>

																<div class="profile-info-value">
																	<span><?php echo $reservasi->telepon ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Jenis Kelamin </div>

																<div class="profile-info-value">
			<!--														<i class="fa fa-map-marker light-orange bigger-110"></i>-->
																	<span><?php echo $reservasi->jeniskelamin ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Usia </div>

																<div class="profile-info-value">
																	<span><?php echo (date("Y") - explode("-", $reservasi->tgllahir)[2]) ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Tanggal Lahir </div>

																<div class="profile-info-value">
																	<span><?php echo $reservasi->tgllahir ?></span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Bukti Pembayaran </div>

																<div class="profile-info-value">
																	<?php if (isset($reservasi->buktipembayaran)): ?>
																		<?php if ($reservasi->buktipembayaran!=NULL): ?>
																			<span><a href="<?php echo $reservasi->buktipembayaran ?>"><i class="fa fa-eye"></i>&nbsp;LIHAT</a></span>
																		<?php endif ?>
																	<?php endif ?>
																</div>
															</div>
														</div>
													</div>

													<div class="col-xs-12 col-sm-2">
														<div class="text-center">
															<img class="thumbnail inline no-margin-bottom" alt="<?php echo $reservasi->namapelanggan ?>" src="<?php echo $reservasi->fotoktp ?>" style="width: 100%; height: auto" />
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
						</div>
					</div>
				</div>
			</div><!-- /.span -->
		</div><!-- /.row -->
		<div class="hr hr-18 dotted hr-double"></div>

		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->