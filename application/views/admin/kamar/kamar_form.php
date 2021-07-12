<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="hide">
			<span class="profile-picture">
				<img id="avatar" class="editable img-responsive" alt="" src="<?php echo $fotokamar ?>" />
			</span>

			<span class="profile-picture2">
				<img id="avatar2" class="editable img-responsive" alt="" src="<?php echo $foto2 ?>" />
			</span>

			<span class="profile-picture3">
				<img id="avatar3" class="editable img-responsive" alt="" src="<?php echo $foto3 ?>" />
			</span>
		</div>
		
		<?php echo(form_open_multipart($action, "class='form-horizontal' role='form' id='form-user-profile'")) ?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-nomorkamar"> Nomor Kamar </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-nomorkamar" name="nomorkamar" maxlength="35" placeholder="Nomor Kamar" class="form-control" value="<?php echo $nomorkamar; ?>"/>
				</div>
			</div>
		
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-tarif"> Tarif </label>

				<div class="col-sm-9">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="ace-icon fa fa-money"></i>
						</span>

						<input class="col-xs-10 col-sm-4" type="number" id="form-field-tarif" placeholder="Tarif kamar..." name="tarif" value="<?php echo $tarif; ?>"/>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-deskripsi"> Deskripsi </label>

				<div class="col-sm-9">
					<textarea id="form-field-deskripsi" data-provide="markdown" data-iconlibrary="fa" name="deskripsi" placeholder="Deskripsi Kamar..." class="form-control" cols="30" rows="5"><?php echo $deskripsi; ?></textarea>
				</div>
			</div>
		
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-image"> Foto Kamar </label>

				<div class="col-sm-9">
					<input class="col-xs-10 col-sm-4" type="file" id="form-field-image" name="image"/>
					<input type="hidden" class="removeimage" name="removeimage" value="false">
					<label><span class="text-danger">* Diperlukan</span></label>
				</div>
			</div>
		
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-image"> Foto Kamar 2 </label>

				<div class="col-sm-9">
					<input class="col-xs-10 col-sm-4" type="file" id="form-field-image" name="image2"/>
					<input type="hidden" class="removeimage" name="removeimage2" value="false">
					<label><span class="text-success">* Optional</span></label>
				</div>
			</div>
		
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-image"> Foto Kamar 3 </label>

				<div class="col-sm-9">
					<input class="col-xs-10 col-sm-4" type="file" id="form-field-image" name="image3"/>
					<input type="hidden" class="removeimage" name="removeimage3" value="false">
					<label><span class="text-success">* Optional</span></label>
				</div>
			</div>

	    	<input type="hidden" name="idkamar" value="<?php echo $idkamar; ?>" /> 

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