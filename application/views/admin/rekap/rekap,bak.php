<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="row">
			<div class="col-lg-8">
				<div class="row">
					<form class="form-inline" action="admin/CAdmin/rekap_transaksi" method="post">
						<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
							<label  class="inline">Pilih Rentang Tanggal</label>
						</div>
						<div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
							<div class="input-daterange input-group">
								<input type="text" autocomplete="off" class="input-sm input-small form-control" name="tglstart" value="<?php echo $tanggalmulai ?>" />
								<span class="input-group-addon">
									<i class="fa fa-exchange"></i>
								</span>
								<input type="text" autocomplete="off" class="input-sm input-small form-control" name="tglend" value="<?php echo $tanggalakhir ?>" />
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
							<button type="submit" class="btn btn-info btn-sm">Tampilkan</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-4 right text-right">
				<?php echo $tanggalmulai;$tglmulai = format_date_from_string($tanggalmulai, "m/d/Y");$tglakhir = format_date_from_string($tanggalakhir, "m/d/Y"); ?>
				<small><?php echo get_str_day($tglmulai)." ".$tglmulai; ?>&nbsp;<strong>s/d</strong>&nbsp;<?php echo get_str_day($tglakhir)." ".$tglakhir; ?></small>
			</div>
		</div>

		<hr class="clear-fix"></hr>
		<div class="table">
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th>Total Transaksi</th>
						<td>: <?php echo $totaltransaksi ?></td>
					</tr>
					<tr>
						<th>Transaksi Ditolak</th>
						<td>: <?php echo $transaksiditolak ?></td>
					</tr>
					<tr>
						<th>Transaksi Dikonfirmasi</th>
						<td>: <?php echo $transaksidikonfirmasi ?></td>
					</tr>
					<tr>
						<th>Transaksi Pending</th>
						<td>: <?php echo $transaksipending ?></td>
					</tr>
					<tr>
						<th>Total Transaksi Pembayaran</th>
						<td>: Rp<?php echo format_number($total) ?></td>
					</tr>
					<tr>
						<th colspan="2" class="right text-right"><small><?php echo $terbilang ?></small></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="2"><a href="admin/CAdmin/rekap_print?tglstart=<?php echo $stampstart.'&tglend='.$stampend ?>" class="btn btn-sm btn-primary" target="_blank">Cetak</a></td>
					</tr>
				</tbody>
			</table>
		</div>

		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->