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
        <h2 style="margin-top:0px">Tamu Read</h2>
        <table class="table">
	    <tr><td>Idpetugas</td><td><?php echo $idpetugas; ?></td></tr>
	    <tr><td>Idpelanggan</td><td><?php echo $idpelanggan; ?></td></tr>
	    <tr><td>Idkamar</td><td><?php echo $idkamar; ?></td></tr>
	    <tr><td>Tglmasuk</td><td><?php echo $tglmasuk; ?></td></tr>
	    <tr><td>Harimasuk</td><td><?php echo $harimasuk; ?></td></tr>
	    <tr><td>Tglkeluar</td><td><?php echo $tglkeluar; ?></td></tr>
	    <tr><td>Harikeluar</td><td><?php echo $harikeluar; ?></td></tr>
	    <tr><td>Pembayaran</td><td><?php echo $pembayaran; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tamu') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>