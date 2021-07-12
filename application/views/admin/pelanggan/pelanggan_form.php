<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="hide">
			<span class="profile-picture">
				<img id="avatar" class="editable img-responsive" alt="" src="<?php echo $fotoprofil ?>" />
				<img id="ktp" class="editable img-responsive" alt="" src="<?php echo $fotoktp ?>" />
			</span>
		</div>
		
		<?php echo(form_open_multipart($action, "class='form-horizontal' role='form' id='form-user-profile'")) ?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-nama"> Nama </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-nama" name="nama" maxlength="35" placeholder="Nama..." class="form-control" value="<?php echo $nama; ?>"/>
				</div>
			</div>
		
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-jeniskelamin"> Jenis Kelamin </label>

				<div class="col-sm-9">
					<span class="btn-toolbar inline middle no-margin">
						<span id="chosen-multiple-style" data-toggle="buttons" class="btn-group no-margin">
							<input type="hidden" name="jeniskelamin" value="<?php echo $jeniskelamin ?>">
							<label class="btn btn-xs btn-yellow <?php echo $jeniskelamin=="Pria"?"active":NULL ?>">
								Pria
								<input type="radio" value="Pria" />
							</label>

							<label class="btn btn-xs btn-yellow <?php echo $jeniskelamin=="Wanita"?"active":NULL ?>">
								Wanita
								<input type="radio" value="Wanita" />
							</label>
						</span>
					</span>
				</div>
			</div>
		
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-telepon"> Telepon </label>

				<div class="col-sm-9">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="ace-icon fa fa-phone"></i>
						</span>

						<input class="input-mask-phone col-xs-10 col-sm-4" type="text" id="form-field-telepon" placeholder="Nomor yang dapat dihubungi..." name="telepon" value="<?php echo $telepon; ?>"/>
					</div>
				</div>
			</div>
		
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"  for="id-date-picker-1"> Tanggal Lahir </label>

				<div class="col-sm-9">
					<span class="input-icon input-icon-right">
						<input class="form-control date-picker" autocomplete="off" id="id-date-picker-1" name="tgllahir" type="text" data-date-format="dd-mm-yyyy" value="<?php echo $tgllahir; ?>"/>
						<i class="ace-icon fa fa-calendar blue"></i>
					</span>
				</div>
			</div>
		
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-email"> Email </label>

				<div class="col-sm-9">
					<span class="input-icon input-icon-right">
						<input class="form-control input-large" type="mail" id="form-field-email" placeholder="@..." name="email" maxlength="50" value="<?php echo $email; ?>"/>
						<i class="ace-icon fa fa-envelope blue"></i>
					</span>
				</div>
			</div>
		
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-ktp"> Foto KTP </label>

				<div class="col-sm-9">
					<input class="col-xs-10 col-sm-4" type="file" id="form-field-ktp" name="ktp"/>
					<input type="hidden" name="removektp" value="false">
				</div>
			</div>
		
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-image"> Foto Profil </label>

				<div class="col-sm-9">
					<input class="col-xs-10 col-sm-4" type="file" id="form-field-image" name="image"/>
					<input type="hidden" name="removeimage" value="false">
				</div>
			</div>

	    	<input type="hidden" name="idpelanggan" value="<?php echo $idpelanggan; ?>" /> 
		
			<div class="space-4"></div>

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