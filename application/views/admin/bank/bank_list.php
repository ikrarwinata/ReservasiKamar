<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->

		<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
				<div class="btn-group btn-corner">
					<a href="admin/Bank/create" class="btn btn-white btn-success tooltips-slide-down" title="Tambah data">
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
                <form action="<?php echo site_url('admin/Bank/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control search-query" name="q" value="<?php echo $q; ?>" placeholder="Cari Rekening">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/Bank'); ?>" class="btn btn-default btn-sm">Reset</a>
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
							<th>Nama Bank</th>
							<th>Rekening</th>
							<th>Nama</th>
							<th>Image</th>
							<th></th>
						</tr>
					</thead>

					<tbody>
						<?php 
						foreach($bank_data as $bank){
						?>
						<tr>
							<td class="center">
								<label class="pos-rel data-id"><?php echo $bank->idbank ?></label>
							</td>

							<td>
								<a href="" onClick="return false"><?php echo $bank->namabank ?></a>
							</td>
							<td><?php echo $bank->rekening ?></td>
							<td><?php echo $bank->namanasabah ?></td>
							<td class="hidden-480 center"><img src="<?php echo $bank->gambar ?>" alt="" width="auto" height="50px"></td>
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