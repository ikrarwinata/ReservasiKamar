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
        <h2>Tamu List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Idpetugas</th>
		<th>Idpelanggan</th>
		<th>Idkamar</th>
		<th>Tglmasuk</th>
		<th>Harimasuk</th>
		<th>Tglkeluar</th>
		<th>Harikeluar</th>
		<th>Pembayaran</th>
		
            </tr><?php
            foreach ($tamu_data as $tamu)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tamu->idpetugas ?></td>
		      <td><?php echo $tamu->idpelanggan ?></td>
		      <td><?php echo $tamu->idkamar ?></td>
		      <td><?php echo $tamu->tglmasuk ?></td>
		      <td><?php echo $tamu->harimasuk ?></td>
		      <td><?php echo $tamu->tglkeluar ?></td>
		      <td><?php echo $tamu->harikeluar ?></td>
		      <td><?php echo $tamu->pembayaran ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>