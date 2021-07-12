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
        <h2 style="margin-top:0px">Reservasi <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Idpelanggan <?php echo form_error('idpelanggan') ?></label>
            <input type="text" class="form-control" name="idpelanggan" id="idpelanggan" placeholder="Idpelanggan" value="<?php echo $idpelanggan; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Idkamar <?php echo form_error('idkamar') ?></label>
            <input type="text" class="form-control" name="idkamar" id="idkamar" placeholder="Idkamar" value="<?php echo $idkamar; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tglreservasi <?php echo form_error('tglreservasi') ?></label>
            <input type="text" class="form-control" name="tglreservasi" id="tglreservasi" placeholder="Tglreservasi" value="<?php echo $tglreservasi; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tglcheckin <?php echo form_error('tglcheckin') ?></label>
            <input type="text" class="form-control" name="tglcheckin" id="tglcheckin" placeholder="Tglcheckin" value="<?php echo $tglcheckin; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Lamainap <?php echo form_error('lamainap') ?></label>
            <input type="text" class="form-control" name="lamainap" id="lamainap" placeholder="Lamainap" value="<?php echo $lamainap; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Messages <?php echo form_error('messages') ?></label>
            <input type="text" class="form-control" name="messages" id="messages" placeholder="Messages" value="<?php echo $messages; ?>" />
        </div>
	    <input type="hidden" name="idreservasi" value="<?php echo $idreservasi; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('reservasi') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>