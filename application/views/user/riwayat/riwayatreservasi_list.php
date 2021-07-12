<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <!-- <form action="<?php echo site_url('user/Riwayat/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control search-query" name="q" value="<?php echo $q; ?>" placeholder="Cari Riwayattamu">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('user/Riwayat'); ?>" class="btn btn-default btn-sm">Reset</a>
                                    <?php
                                }
                            ?>
							<button class="btn btn-purple btn-sm" type="submit">
								<span class="fa fa-search"></span>
								Cari
							</button>
                        </span>
                    </div>
                </form> -->
            </div>
        </div>
		<div class="row">
			<div class="col-xs-12">
				<table id="simple-table" class="table  table-bordered table-hover">
					<thead>
						<tr>
							<th class="center">
								<label class="pos-rel">
									No.
								</label>
							</th>
							<th class="detail-col">Details</th>
							<th>Nomor Kamar</th>
							<th>Tarif <span class="small">(Rp.)</span></th>
							<th>
								<i class="ace-icon fa fa-clock bigger-110 hidden-480"></i>
								Tanggal Check In
							</th>
							<th>
								<i class="ace-icon fa fa-clock bigger-110 hidden-480"></i>
								Tanggal Keluar
							</th>
							<th>Nama Tamu</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>

					<tbody>
						<?php 
						$no = $start + 1;
						foreach($riwayattamu_data as $kamar){
						?>
						<tr>
							<td class="center">
								<label class="pos-rel data-id hidden"><?php echo $kamar->id ?></label>
								<label class="pos-rel"><?php echo $no++ ?></label>
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
							<td class="hidden-480"><?php echo format_date($kamar->tglcheckin) ?></td>
							<td class="hidden-480"><?php echo increase_date($kamar->tglcheckin, $kamar->lamainap) ?></td>
							<td class="hidden-480"><?php echo $kamar->namapelanggan ?></td>
							<?php 
							$color = "label-warning";
							$s = "Menunggu Bukti Pembayaran";
							$dp = FALSE;
							if (isset($kamar->buktipembayaran)) {
								if ($kamar->buktipembayaran != NULL) {
									$s = string_statusresv($kamar->status);
									$dp = TRUE;
									$color = "label-success";
								}
							}
							 ?>
							<td class="hidden-480"><span class="label label-sm <?php echo $color ?>"><?php echo $s ?></span></td>
							<td>
								<div class="hidden-sm hidden-xs btn-group">
									<!-- <button class="btn btn-xs btn-info tooltips-slide-down" title="Edit">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button> -->

									<!-- <button class="btn btn-xs btn-danger tooltips-slide-down" title="DoubleClick: Hapus">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</button> -->
								</div>

								<div class="hidden-md hidden-lg">
									<div class="inline pos-rel">
										<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
											<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
										</button>

										<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

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
							<td colspan="9">
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

										<div class="col-xs-12 col-sm-8">
											<div class="space visible-xs"></div>

											<div class="profile-user-info profile-user-info-striped">

												<div class="profile-info-row">
													<div class="profile-info-name"> Tamu </div>

													<div class="profile-info-value">
														<span><?php echo $kamar->namapelanggan ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Telepon Tamu </div>

													<div class="profile-info-value">
														<span><?php echo $kamar->telepon ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Tanggal </div>

													<div class="profile-info-value">
														<span><?php echo $kamar->tglreservasi ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Hari Masuk </div>

													<div class="profile-info-value">
														<i class="fa fa-clock light-orange bigger-110"></i>
														<span><?php echo get_str_day($kamar->tglcheckin) ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Hari Keluar </div>

													<div class="profile-info-value">
														<i class="fa fa-clock light-orange bigger-110"></i>
														<span><?php echo get_str_day(increase_date($kamar->tglcheckin, $kamar->lamainap)) ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Pesan </div>

													<div class="profile-info-value">
														<i class="fa fa-clock light-orange bigger-110"></i>
														<span><?php echo $kamar->messages ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Bukti Pembayaran </div>

													<div class="profile-info-value">
														<i class="fa fa-clock light-orange bigger-110"></i>
														<span>
															<?php if ($dp): ?>
																<a href="<?php echo $kamar->buktipembayaran ?>" class="btn btn-sm btn-primary" target="_blank">Lihat Bukti Pembayaran</a>
																&nbsp;
																<a href="user/CUser/print_invoice/<?php echo $kamar->idreservasi ?>" class="btn btn-sm btn-success" target="_blank">Cetak Invoice</a>
															<?php else: ?>
																<span class="text-danger">Tidak ada bukti pembayaran :</span>&nbsp;<a href="user/CUser/invoice/<?php echo $kamar->idreservasi ?>" class="btn btn-sm btn-primary">Upload Bukti Pembayaran</a>
															<?php endif ?>
														</span>
													</div>
												</div>
											</div>
										</div>

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
															<span class="white"><?php echo $kamar->namapelanggan ?></span>
														</a>
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