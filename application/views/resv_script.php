<section class="section-sub-banner bg-9">
    <div></div>
    <div class="sub-banner">
        <div class="container">
            <div class="text text-center">
            </div>
        </div>

    </div>

</section>
<!-- CONTACT -->
<section class="section-contact">
    <div class="container">
        <div class="contact">
        	<?php 
			$hoursToAdd = 5;
			$tosecond = $hoursToAdd * (60 * 60);
			$newTime = $timestamps + $tosecond;

			$date = date_create();
			$now = date_timestamp_get($date);

			$start_date = new DateTime(date("Y-m-d H:i:s"));
			$since_start = $start_date->diff(new DateTime(date("Y-m-d H:i:s", $newTime)));

			$dif = $newTime - $now;
			$status = $dif>=3?$status:0;
			 ?>
            <div class="row">
                <h2 align="center"><a href="#"><strong>DETAIL RESERVASI</strong></a></h2>
                <hr class="clear-fix">
                <div class="col-md-12 col-lg-12">
                    <div class="contact-form">
                        <div class="row">
                        	<div class="col-lg-2 text-center">
                        		<img src="<?php echo $fotokamar ?>" alt="kamar" height="auto" width="100%" align="center">
                        	</div>
                        	<div class="col-lg-10">
                        		<h3><?php echo $nomorkamar ?></h3>
                        	</div>
                        </div>
                        <hr>
                        <div class="row">
                        	<div class="col-lg-6">
                        		<span style="color: #808080">Status</span>
                        	</div>
                        	<div class="col-lg-6">
                        		<span align="right"><strong><?php echo string_statusresv($status) ?></strong></span>
                        	</div>
                        	<hr>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6">
                        		<span style="color: #808080">ID Transaksi</span>
                        	</div>
                        	<div class="col-lg-6">
                        		<span align="right"><strong><?php echo $id ?></strong></span>
                        	</div>
                        	<hr>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6">
                        		<span style="color: #808080">Nama Pemesan</span>
                        	</div>
                        	<div class="col-lg-6">
                        		<span align="right"><strong><?php echo $nama ?></strong></span>
                        	</div>
                        	<hr>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6">
                        		<span style="color: #808080">Telepon Pemesan</span>
                        	</div>
                        	<div class="col-lg-6">
                        		<span align="right"><strong><?php echo $telepon ?></strong></span>
                        	</div>
                        	<hr>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6">
                        		<span style="color: #808080">Tanggal Checkin</span>
                        	</div>
                        	<div class="col-lg-6">
                        		<span align="right"><strong><?php echo $checkin ?></strong> (Hari <?php echo get_str_day($checkin) ?>)</span>
                        	</div>
                        	<hr>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6">
                        		<span style="color: #808080">Lama Inap</span>
                        	</div>
                        	<div class="col-lg-6">
                        		<span align="right"><strong><?php echo $lamainap ?> Hari </strong> (Checkout pada hari <?php echo get_str_day(increase_date($checkin, $lamainap)) ?>)</span>
                        	</div>
                        	<hr>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6">
                        		<span style="color: #808080">Tarif kamar</span>
                        	</div>
                        	<div class="col-lg-6">
                        		<span align="right"><strong>Rp.<?php echo format_number($tarif) ?> @Hari </strong> (Total Rp.<?php echo format_number($tarif*$lamainap) ?>)</span>
                        	</div>
                        	<hr>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6">
                        		<span style="color: #808080">Jumlah</span>
                        	</div>
                        	<div class="col-lg-6">
                        		<span align="right"><strong>Rp.<?php echo format_number($tarif*$lamainap) ?></strong></span>
                        	</div>
                        	<hr>
                        </div>
                        <div class="row">
                        	<div class="col-lg-12">
                        		<span style="color: #808080">Uang muka yang harus dibayar minimal 20% dari jumlah Transaksi (Rp.<?php echo  format_number(($tarif*$lamainap)*0.2) ?>)</span>
                        	</div>
                        </div>
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="text-center" align="center" style="border: 1px solid black">
                        			<strong>Pembayaran melalui Bank <?php echo $namabank ?></strong><br>
                        			<img src="<?php echo $gambarbank ?>" alt="<?php echo $namabank ?>" style="height: 80px; width: auto"><br>
                        			Rekening : <strong><?php echo $rekening ?></strong><br>
                        			Atas Nama : <strong><?php echo $namanasabah ?></strong>
                        		</div>
                        	</div>
                        </div>
                        <?php if ($buktipembayaran == NULL && $status==4): ?>
                        <div class="row">
                        	<hr>
                        	<div class="col-lg-12">
                        		<div class="text-center" align="center">

                        			<?php echo(form_open_multipart('user/CUser/bukti_pembayaran/'.$id)) ?>
                        			<strong>Pembayaran valid sebelum <span id="hours" style="font-size: 82"><?php echo $since_start->h ?></span>:<span id="minutes" style="font-size: 82"><?php echo $since_start->i ?></span>:<span id="seconds" style="font-size: 82"><?php echo $since_start->s ?></span></strong>
                        			<hr>
                    				<input type="hidden" name="id" value="<?php echo $id ?>">
                    				<div class="col-lg-4">
                    				</div>
                    				<div class="col-lg-4">
                    					<input type="file" name="bukti" class="form-control">
                    				</div>
                    				<div class="col-lg-4">
                    				</div>
                    				<div class="col-lg-12">
                        			<br>
                    					<button type="submit" class="btn btn-lg btn-primary">Upload Bukti Pembayaran</button>
                    				</div>
                        			</form>
                        		</div>
                        	</div>
                        </div>
                        <?php else: ?>
                            <?php if ($buktipembayaran!=NULL): ?>
                                <div class="row">
                                    <hr>
                                    <div class="col-lg-12">
                                        <div class="text-center" align="center">
                                            <a href="user/CUser/print_invoice/<?php echo $id ?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i>&nbsp;Cetak</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        <?php endif ?>
                    </div>
                </div>

            </div>  
        </div>
    </div>
</section>

<!-- END / CONTACT -->
