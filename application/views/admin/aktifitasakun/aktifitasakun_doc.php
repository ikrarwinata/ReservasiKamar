<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Aktifitasakun List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Idakun</th>
		<th>Datavalue</th>
		<th>Displaytext</th>
		<th>Controller</th>
		<th>Action</th>
		<th>Tanggal</th>
		<th>Jam</th>
		
            </tr><?php
            foreach ($aktifitasakun_data as $aktifitasakun)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $aktifitasakun->idakun ?></td>
		      <td><?php echo $aktifitasakun->datavalue ?></td>
		      <td><?php echo $aktifitasakun->displaytext ?></td>
		      <td><?php echo $aktifitasakun->controller ?></td>
		      <td><?php echo $aktifitasakun->action ?></td>
		      <td><?php echo $aktifitasakun->tanggal ?></td>
		      <td><?php echo $aktifitasakun->jam ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>