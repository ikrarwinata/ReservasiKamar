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
        <h2>Petugas List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
        		<th>Password</th>
        		<th>Tgllahir</th>
        		<th>Alamat</th>
        		<th>Telepon</th>
        		<th>Email</th>
        		<th>Fotoprofil</th>
		
            </tr><?php
            foreach ($petugas_data as $petugas)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
              <td><?php echo $petugas->nama ?></td>
              <td><?php echo $petugas->username ?></td>
		      <td><?php echo $petugas->password ?></td>
		      <td><?php echo $petugas->tgllahir ?></td>
		      <td><?php echo $petugas->alamat ?></td>
		      <td><?php echo $petugas->telepon ?></td>
		      <td><?php echo $petugas->email ?></td>
		      <td style="text-align: center;"><img src="<?php echo $petugas->fotoprofil ?>" style="height: 35px;width: auto;"></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>