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
        <h2 style="margin-top:0px">Kamar Read</h2>
        <table class="table">
	    <tr><td>Nomorkamar</td><td><?php echo $nomorkamar; ?></td></tr>
	    <tr><td>Tarif</td><td><?php echo $tarif; ?></td></tr>
	    <tr><td>Digunakan</td><td><?php echo $digunakan; ?></td></tr>
	    <tr><td>Fotokamar</td><td><?php echo $fotokamar; ?></td></tr>
	    <tr><td>Deskripsi</td><td><?php echo $deskripsi; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('kamar') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>