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
        <h2>Reservasi List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Idpelanggan</th>
		<th>Idkamar</th>
		<th>Tglreservasi</th>
		<th>Tglcheckin</th>
		<th>Lamainap</th>
		<th>Status</th>
		<th>Messages</th>
		
            </tr><?php
            foreach ($reservasi_data as $reservasi)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $reservasi->idpelanggan ?></td>
		      <td><?php echo $reservasi->idkamar ?></td>
		      <td><?php echo $reservasi->tglreservasi ?></td>
		      <td><?php echo $reservasi->tglcheckin ?></td>
		      <td><?php echo $reservasi->lamainap ?></td>
		      <td><?php echo $reservasi->status ?></td>
		      <td><?php echo $reservasi->messages ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>