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
                <form action="<?php echo site_url('user/Kamar/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control search-query" name="q" value="<?php echo $q; ?>" placeholder="Cari kamar">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('user/Kamar'); ?>" class="btn btn-default btn-sm">Reset</a>
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
				<div>
					<ul class="ace-thumbnails clearfix">
						<?php foreach ($kamarnotamu_data as $kamar) {
							$fotokamar = $kamar->fotokamar==NULL?"uploads/kamar/kamarnoimage.jpg":$kamar->fotokamar;
						 ?>
							<li>
								<div>
									<img width="200" height="150" alt="150x150" src="<?php echo $fotokamar ?>" />
									<div class="text">
										<div class="inner">
											<span><?php echo $kamar->nomorkamar ?></span>

											<br />
											<a href="<?php echo $fotokamar ?>" data-rel="colorbox">
												<i class="ace-icon fa fa-search-plus"></i>
											</a>
										</div>
									</div>
								</div>

								<div class="tags">

									<span class="label-holder">
										<span class="label label-info"><?php echo $kamar->nomorkamar ?></span>
									</span>

									<span class="label-holder">
										<span class="label label-danger">Kosong<!-- <?php echo $kamar->status==TRUE?"Digunakan":"Kosong" ?> --></span>
									</span>
									
									<?php if ($kamar->digunakan==0): ?>
									<span class="label-holder">
										<span class="label label-succes"><a href="CPublic/reserv/<?php echo $kamar->idkamar ?>#main">Reservasi</a></span>
									</span>
									<?php endif ?>
								</div>
							</li>
						<?php } ?>
						<?php foreach ($kamar_data as $kamar) {
							$fotokamar = $kamar->fotokamar!==NULL?"uploads/kamar/kamarnoimage.jpg":$kamar->fotokamar;
						 ?>
							<li>
								<div>
									<img width="200" height="150" alt="150x150" src="<?php echo $fotokamar ?>" />
									<div class="text">
										<div class="inner">
											<span><?php echo $kamar->nomorkamar ?></span>

											<br />
											<a href="<?php echo $fotokamar ?>" data-rel="colorbox">
												<i class="ace-icon fa fa-search-plus"></i>
											</a>
										</div>
									</div>
								</div>

								<div class="tags">
									<span class="label-holder">
										<span class="label label-info"><?php echo $kamar->nomorkamar ?></span>
									</span>

									<span class="label-holder">
										<span class="label label-danger">Kosong<!-- <?php echo $kamar->status==TRUE?"Digunakan":"Kosong" ?> --></span>
									</span>
								</div>
							</li>
						<?php } ?>
					</ul>
				</div>
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