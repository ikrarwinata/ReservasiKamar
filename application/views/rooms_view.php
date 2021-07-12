<section class="section-room bg-white">
    <div class="container">

        <div class="room-wrap-3">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">

                    <!-- ITEM -->
                    <div class="room_item-3 thumbs-right">

                        <div class="img">
                            <a href="">
                                <img src="assets/logo.jpg" alt="">
                            </a>
                        </div>

                        <div class="text-thumbs">
                            <div class="thumbs">
                                <div class="grid images_3_of_2">
                                    <div class="flexslider">
                                        <ul class="slides">
                                            <li data-thumb="<?php echo $fotokamar ?>">
                                                <div class="thumb-image">
                                                    <img src="<?php echo $fotokamar ?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
                                            </li>
                                            <li data-thumb="<?php echo $foto2 ?>">
                                                <div class="thumb-image">
                                                    <img src="<?php echo $foto2 ?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
                                            </li>
                                            <li data-thumb="<?php echo $foto3 ?>">
                                                <div class="thumb-image">
                                                    <img src="<?php echo $foto3 ?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="text" id="main">
                                <h2><a href="#"><?php echo $nomorkamar;?></a></h2>
                                <span class="price">Tarif <span class="amout"><b><?php echo 'Rp '.number_format($tarif);?></b></span> per hari</span>
                                <br><?php echo $deskripsi;?><br>
                                <br>
                                Status Saat Ini: <span class="amout"><b><?php echo $strdigunakan;?></b></span>
                                <br>
                                <br>
                                <?php if (count($data_resv)>=1): ?>
                                    Telah direservasi pada tanggal :
                                <?php endif ?>
                                <ul>
                                    <?php foreach ($data_resv as $key => $value): ?>
                                        <li><?php 
                                        $tglcheckin=format_date($value->tglcheckin);
                                        $tglcheckout=format_date(increase_date_defaultformat($value->tglcheckin, $value->lamainap));
                                        echo get_str_day($tglcheckin).", ".get_day($tglcheckin)." ".get_str_month(get_month($tglcheckin))." ".get_year($tglcheckin)." <strong>s/d</strong> ".get_str_day($tglcheckout).", ".get_day($tglcheckout)." ".get_str_month(get_month($tglcheckout))." ".get_year($tglcheckout) ?></li>
                                    <?php endforeach ?>
                                </ul>
                                <?php 
                                echo (!$digunakan?"<a href='".site_url('CPublic/reserv/'.$idkamar)."#main' class='awe-btn awe-btn-13'>Reservasi</a>":NULL);
                                 ?>
                            </div>

                        </div>

                    </div>   
                    <!-- END / ITEM -->

                    
    </div>
</section>