<div class="row" style="margin-bottom: 10px">
	<div class="col-md-4">
		<div class="btn-group btn-corner">
			<button type="button" class="btn btn-white btn-info tooltips-slide-down dropdown-toggle" title="Export ke Excel" data-toggle="dropdown" dropdown-toggle="export">
				<i class="fa fa-share bigger-110"></i>
				<span class="ace-icon fa fa-caret-down icon-on-right"></span>
			</button>
			<ul id="export" class="dropdown-menu dropdown-success hide">
				<li>
					<a href="admin/Pengeluaran/excel/">Export semua data</a>
				</li>

				<li class="divider"></li>

				<li>
					<a href="admin/Pengeluaran/excel?start=<?php echo $start ?>&q=<?php echo $q ?>&limit=10" target="_blank">Export Halaman ini</a>
				</li>
				
				<li>
					<a href="admin/Pengeluaran/excel?&q=<?php echo $q ?>" target="_blank">Export semua hasil pencarian ini</a>
				</li>
			</ul>
			
			<button type="button" data-toggle="dropdown" class="btn btn-white dropdown-toggle btn-info tooltips-slide-down" title="Print" dropdown-toggle="print">
				<i class="fa fa-print bigger-110"></i>
				<span class="ace-icon fa fa-caret-down icon-on-right"></span>
			</button>
			<ul id="print" class="dropdown-menu dropdown-info hide">
				<li>
					<a href="admin/Pengeluaran/print_page/" target="_blank">Print semua data</a>
				</li>

				<li class="divider"></li>

				<li>
					<a href="admin/Pengeluaran/print_page?start=<?php echo $start ?>&q=<?php echo $q ?>&limit=10" target="_blank">Print Halaman ini</a>
				</li>
				
				<li>
					<a href="admin/Pengeluaran/print_page?&q=<?php echo $q ?>" target="_blank">Print semua hasil pencarian ini</a>
				</li>
			</ul>
			
			<a href="#modal-form" data-toggle="modal" class="btn btn-white btn-success tooltips-slide-down" title="Tambah data">
				<i class="fa fa-plus bigger-110"></i>
			</a>
		</div>
	</div>
	<div class="col-md-4 text-center">
		<div style="margin-top: 8px" id="message">
			<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
		</div>
	</div>
	<div class="col-md-1 text-right">
	</div>
	<div class="col-md-3 text-right">

	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<table id="grid-table">
		
		</table>

		<div id="grid-pager">

		</div>

		<div id="modal-form" class="modal" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="blue bigger">Tambah Data Pengeluaran</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12 col-sm-2">
							</div>

							<div class="col-xs-12 col-sm-10">

								<div class="form-group">
									<label for="form-field-pengeluaran">Nominal</label>

									<div>
										<input type="number" name="pengeluaran" id="form-field-pengeluaran" placeholder="Nominal Pengeluaran (Rp.)..." value="" required="" />
									</div>
								</div>

								<div class="space-4"></div>

								<div class="form-group">
									<label for="form-field-keterangan">Keterangan</label>

									<div>
										<input type="text" maxlength="35" name="deskripsi" id="form-field-keterangan" placeholder="Keterangan/Deskripsi Pengeluaran..." value="" />
									</div>
								</div>
							</div>
						</div>

					</div>

					<div class="modal-footer">
						<button class="btn btn-sm" data-dismiss="modal">
							<i class="ace-icon fa fa-times"></i>
							Batal
						</button>

						<button id="form-submit" class="btn btn-sm btn-primary" data-loading-text="Menyimpan...">
							<i class="ace-icon fa fa-check"></i>
							Simpan
						</button>
					</div>
				</div>
			</div>
		</div>
		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->