<!doctype html>
<html>
    <head>
        <title><?php echo $title ?></title>
        <base href="<?php echo base_url();?>">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
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
        <div class="container">
            <br>
            <h2 align="center"><strong><?php echo ($this->config->item("app_name")) ?></strong></h2>
            <hr class="clear-fix" style="border: 2px solid black"></hr>
            <h4 align="center">Data Tamu</h4>
            <table class="word-table" style="margin-bottom: 10px">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Jeniskelamin</th>
                    <th>Tgllahir</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Fotoktp</th>
                    <th>Fotoprofil</th>
            
                </tr><?php
                foreach ($pelanggan_data as $pelanggan)
                {
                    ?>
                    <tr>
                  <td><?php echo ++$start ?></td>
                  <td><?php echo $pelanggan->nama ?></td>
                  <td><?php echo $pelanggan->username ?></td> 
                  <td><?php echo $pelanggan->password ?></td> 
                  <td><?php echo $pelanggan->jeniskelamin ?></td>
                  <td><?php echo $pelanggan->tgllahir ?></td>
                  <td><?php echo $pelanggan->telepon ?></td>
                  <td><?php echo $pelanggan->email ?></td>
                  <td style="text-align: center;"><img src="<?php echo $pelanggan->fotoktp ?>" style="height: 35px; width: auto"></td>
                  <td style="text-align: center;"><img src="<?php echo $pelanggan->fotoprofil ?>" style="height: 35px; width: auto"></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <hr class="clear-fix"></hr>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    Mengetahui,<br><br><br><br><br><br>
                    <hr class="clear-fix" style="border: 1px solid black">
                </div>
            </div>
        </div>
    </body>
</html>