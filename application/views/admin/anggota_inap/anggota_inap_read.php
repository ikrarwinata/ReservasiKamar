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
        <h2 style="margin-top:0px">Anggota_inap Read</h2>
        <table class="table">
	    <tr><td>Idreservasi</td><td><?php echo $idreservasi; ?></td></tr>
	    <tr><td>Ktp</td><td><?php echo $ktp; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('anggota_inap') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>