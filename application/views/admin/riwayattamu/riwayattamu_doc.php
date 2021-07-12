<!doctype html>
<html>
    <head>
        <title><?php echo $title ?></title>
        <base href="<?php echo base_url() ?>"></base>
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
        <h2>Riwayattamu List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Petugas</th>
		<th>Nama Tamu</th>
		<th>Kamar</th>
		<th>Tglmasuk</th>
		<th>Harimasuk</th>
		<th>Tglkeluar</th>
		<th>Harikeluar</th>
		<th>Pembayaran</th>
		
            </tr><?php
            foreach ($riwayattamu_data as $riwayattamu)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $riwayattamu->namapetugas ?></td>
		      <td><?php echo $riwayattamu->namapelanggan ?></td>
		      <td><?php echo $riwayattamu->nomorkamar ?></td>
		      <td><?php echo $riwayattamu->tglmasuk ?></td>
		      <td><?php echo $riwayattamu->harimasuk ?></td>
		      <td><?php echo $riwayattamu->tglkeluar ?></td>
		      <td><?php echo $riwayattamu->harikeluar ?></td>
		      <td><?php echo $riwayattamu->pembayaran ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>