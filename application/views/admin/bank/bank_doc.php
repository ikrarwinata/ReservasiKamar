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
        <h2>Bank List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Namabank</th>
		<th>Rekening</th>
		<th>Gambar</th>
		
            </tr><?php
            foreach ($bank_data as $bank)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $bank->namabank ?></td>
		      <td><?php echo $bank->rekening ?></td>
		      <td><?php echo $bank->gambar ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>