<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Anggota_inap <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Idreservasi <?php echo form_error('idreservasi') ?></label>
            <input type="text" class="form-control" name="idreservasi" id="idreservasi" placeholder="Idreservasi" value="<?php echo $idreservasi; ?>" />
        </div>
	    <div class="form-group">
            <label for="ktp">Ktp <?php echo form_error('ktp') ?></label>
            <textarea class="form-control" rows="3" name="ktp" id="ktp" placeholder="Ktp"><?php echo $ktp; ?></textarea>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('anggota_inap') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>