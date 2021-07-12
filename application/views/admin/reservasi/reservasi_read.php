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
        <h2 style="margin-top:0px">Reservasi Read</h2>
        <table class="table">
	    <tr><td>Idpelanggan</td><td><?php echo $idpelanggan; ?></td></tr>
	    <tr><td>Idkamar</td><td><?php echo $idkamar; ?></td></tr>
	    <tr><td>Tglreservasi</td><td><?php echo $tglreservasi; ?></td></tr>
	    <tr><td>Tglcheckin</td><td><?php echo $tglcheckin; ?></td></tr>
	    <tr><td>Lamainap</td><td><?php echo $lamainap; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Messages</td><td><?php echo $messages; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('reservasi') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>