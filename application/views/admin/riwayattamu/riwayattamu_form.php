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
        <h2 style="margin-top:0px">Riwayattamu <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Idpetugas <?php echo form_error('idpetugas') ?></label>
            <input type="text" class="form-control" name="idpetugas" id="idpetugas" placeholder="Idpetugas" value="<?php echo $idpetugas; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Idpelanggan <?php echo form_error('idpelanggan') ?></label>
            <input type="text" class="form-control" name="idpelanggan" id="idpelanggan" placeholder="Idpelanggan" value="<?php echo $idpelanggan; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Idkamar <?php echo form_error('idkamar') ?></label>
            <input type="text" class="form-control" name="idkamar" id="idkamar" placeholder="Idkamar" value="<?php echo $idkamar; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tglmasuk <?php echo form_error('tglmasuk') ?></label>
            <input type="text" class="form-control" name="tglmasuk" id="tglmasuk" placeholder="Tglmasuk" value="<?php echo $tglmasuk; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Harimasuk <?php echo form_error('harimasuk') ?></label>
            <input type="text" class="form-control" name="harimasuk" id="harimasuk" placeholder="Harimasuk" value="<?php echo $harimasuk; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tglkeluar <?php echo form_error('tglkeluar') ?></label>
            <input type="text" class="form-control" name="tglkeluar" id="tglkeluar" placeholder="Tglkeluar" value="<?php echo $tglkeluar; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Harikeluar <?php echo form_error('harikeluar') ?></label>
            <input type="text" class="form-control" name="harikeluar" id="harikeluar" placeholder="Harikeluar" value="<?php echo $harikeluar; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Pembayaran <?php echo form_error('pembayaran') ?></label>
            <input type="text" class="form-control" name="pembayaran" id="pembayaran" placeholder="Pembayaran" value="<?php echo $pembayaran; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('riwayattamu') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>