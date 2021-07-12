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
        <h2 style="margin-top:0px">Aktifitasakun Read</h2>
        <table class="table">
	    <tr><td>Idakun</td><td><?php echo $idakun; ?></td></tr>
	    <tr><td>Datavalue</td><td><?php echo $datavalue; ?></td></tr>
	    <tr><td>Displaytext</td><td><?php echo $displaytext; ?></td></tr>
	    <tr><td>Controller</td><td><?php echo $controller; ?></td></tr>
	    <tr><td>Action</td><td><?php echo $action; ?></td></tr>
	    <tr><td>Tanggal</td><td><?php echo $tanggal; ?></td></tr>
	    <tr><td>Jam</td><td><?php echo $jam; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('aktifitasakun') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>