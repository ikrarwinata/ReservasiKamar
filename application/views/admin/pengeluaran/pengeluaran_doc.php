<!doctype html>
<html>
    <head>
        <title><?php echo $title ?></title>
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
        <h2><?php echo $text ?></h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>Id Akun</th>
                <th>Nama Petugas</th>
                <th>Pengeluaran <span class="small">(Rp.)</span></th>
        		<th>Deskripsi</th>
        		<th>Tgl</th>
		
            </tr><?php
            $total = 0;
            foreach ($pengeluaran_data as $pengeluaran)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
              <td><?php echo $pengeluaran->idakun ?></td>
              <td><?php echo $pengeluaran->nama ?></td>
              <td><?php echo number_format($pengeluaran->pengeluaran) ?></td>
		      <td><?php echo $pengeluaran->deskripsi ?></td>
		      <td><?php echo $pengeluaran->tgl ?></td>	
                </tr>
                <?php
                $total += $pengeluaran->pengeluaran;
            }
            ?>
            <tr>
                <td colspan="3" style="text-align: center;">Jumlah</td>
                <td><?php echo number_format($total) ?></td>
            </tr>
        </table>
    </body>
</html>