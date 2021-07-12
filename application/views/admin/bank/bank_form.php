<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="hide">
			<span class="profile-picture">
				<img id="avatar" class="editable img-responsive" alt="" src="<?php echo $gambar ?>" />
			</span>
		</div>
		<?php echo(form_open_multipart($action, "class='form-horizontal' role='form' id='form-user-profile'")) ?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-tanggalm"> Nama BANK </label>

				<div class="col-sm-9">
					<input type="text" class="form-control" name="namabank" id="namabank" placeholder="Nama Bank" value="<?php echo $namabank; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-idkamar"> Nomor Rekening </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-2" placeholder="Rekening" name="rekening" class="col-xs-10 col-sm-5" value="<?php echo $rekening; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-idkamar"> Nama </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-2" placeholder="Nama Pemilik Rekening" name="namanasabah" class="col-xs-10 col-sm-5" value="<?php echo $namanasabah; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-image"> Foto Profil </label>

				<div class="col-sm-9">
					<input class="col-xs-10 col-sm-4" type="file" id="form-field-image" name="image"/>
					<input type="hidden" name="removeimage" value="false">
				</div>
			</div>

	    	<input type="hidden" name="idbank" value="<?php echo $idbank ?>" />

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