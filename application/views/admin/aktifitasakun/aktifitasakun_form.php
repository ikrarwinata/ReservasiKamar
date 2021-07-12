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
        <h2 style="margin-top:0px">Aktifitasakun <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Idakun <?php echo form_error('idakun') ?></label>
            <input type="text" class="form-control" name="idakun" id="idakun" placeholder="Idakun" value="<?php echo $idakun; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Datavalue <?php echo form_error('datavalue') ?></label>
            <input type="text" class="form-control" name="datavalue" id="datavalue" placeholder="Datavalue" value="<?php echo $datavalue; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Displaytext <?php echo form_error('displaytext') ?></label>
            <input type="text" class="form-control" name="displaytext" id="displaytext" placeholder="Displaytext" value="<?php echo $displaytext; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Controller <?php echo form_error('controller') ?></label>
            <input type="text" class="form-control" name="controller" id="controller" placeholder="Controller" value="<?php echo $controller; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Action <?php echo form_error('action') ?></label>
            <input type="text" class="form-control" name="action" id="action" placeholder="Action" value="<?php echo $action; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tanggal <?php echo form_error('tanggal') ?></label>
            <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jam <?php echo form_error('jam') ?></label>
            <input type="text" class="form-control" name="jam" id="jam" placeholder="Jam" value="<?php echo $jam; ?>" />
        </div>
	    <input type="hidden" name="token" value="<?php echo $token; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('aktifitasakun') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>