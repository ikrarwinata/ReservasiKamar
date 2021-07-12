<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		
		<?php echo(form_open_multipart($action, "class='form-horizontal' role='form' id='form-user-profile'")) ?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-tanggalm"> Tanggal Masuk </label>

				<div class="col-sm-3 col-sm-9">
					<div class="input-group">
						<input class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" name="tglmasuk" required="true" value="<?php echo $tglmasuk ?>" />
						<span class="input-group-addon">
							<i class="fa fa-calendar bigger-110"></i>
						</span>
					</div>
				</div>

				<label class="col-sm-2 control-label no-padding-left" for="form-field-tanggalk"> Tanggal Keluar </label>

				<div class="col-sm-3 col-sm-9">
					<div class="input-group">
						<input class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" name="tglkeluar" value="<?php echo $tglkeluar ?>" />
						<span class="input-group-addon">
							<i class="fa fa-calendar bigger-110"></i>
						</span>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-idkamar"> Pembayaran </label>

				<div class="col-sm-9">
					<input type="number" min="0" id="form-field-2" placeholder="Nilai pembayaran" name="pembayaran" class="col-xs-10 col-sm-5" value="<?php echo $pembayaran; ?>" />
				</div>
			</div>

			<hr>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-idkamar"> Nomor Kamar </label>

				<div class="col-sm-4">
					<select class="chosen-select col-xs-10 col-sm-5" id="select-kamar" data-placeholder="Pilih kamar..." name="idkamar" required="true">
						<option value="<?php echo $idkamar ?>"><?php echo $nomorkamar ?></option>
						<?php foreach ($kamar_data as $kamar) { ?>
						<option value="<?php echo $kamar->idkamar ?>"><?php echo $kamar->nomorkamar ?></option>
						<?php } ?>
					</select>
					
				</div>
				<div class="col-sm-5">
					<span class="help-inline col-xs-12 col-sm-7">
						<span class="middle hide" id="tarif">Tarif : </span>
					</span>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-idpelanggan"> Nama Tamu </label>

				<div class="col-sm-4 col-sm-9">
					<select class="chosen-select form-control" id="select-tamu" data-placeholder="Pilih tamu..." name="idpelanggan" required="true">
						<option value="<?php echo $idpelanggan ?>"><?php echo $namapelanggan ?></option>
						<?php foreach ($pelanggan_data as $pelanggan) { ?>
						<option value="<?php echo $pelanggan->idpelanggan ?>"><?php echo $pelanggan->nama ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-sm-5">
					<span class="profile-picture hide">
						<img id="avatar" class="editable img-responsive" alt="" src="" />
					</span>
				</div>
			</div>

	    	<input type="hidden" name="idpetugas" value="<?php echo $this->session->userdata('id'); ?>" /> 
	    	<input type="hidden" name="id" value="<?php echo $id ?>" /> 

			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<button class="btn btn-info" type="submit">
						<i class="ace-icon fa fa-check bigger-110"></i>
						<?php echo $button ?>
					</button>

					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						Reset
					</button>
				</div>
			</div>
		</form>
	</div><!-- /.col -->
</div><!-- /.row -->