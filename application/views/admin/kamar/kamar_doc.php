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
        <h2><?php echo $text ?></h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nomorkamar</th>
		<th>Tarif</th>
		<th>Digunakan</th>
		<th>Fotokamar</th>
		<th>Deskripsi</th>
		
            </tr><?php
            foreach ($kamar_data as $kamar)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kamar->nomorkamar ?></td>
		      <td><?php echo $kamar->tarif ?></td>
		      <td><?php echo $kamar->digunakan ?></td>
              <td style="text-align: center;"><img src="<?php echo $kamar->fotokamar ?>" style="height: 35px;width: auto;"></td> 
		      <td><?php echo $kamar->deskripsi ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>