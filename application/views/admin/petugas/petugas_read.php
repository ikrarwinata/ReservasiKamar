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
        <h2 style="margin-top:0px">Petugas Read</h2>
        <table class="table">
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Tgllahir</td><td><?php echo $tgllahir; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>Telepon</td><td><?php echo $telepon; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>Fotoprofil</td><td><?php echo $fotoprofil; ?></td></tr>
	    <tr><td>Idakun</td><td><?php echo $idakun; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('petugas') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>