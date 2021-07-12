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
                                <a href="" onClick="return false"><img src="<?php echo $fotokamar ?>" alt=""></a>
                            </div>

                            <div class="text">
                                <h2><a href="#"><?php echo $nomorkamar;?></a></h2>
                                <span class="price">Tarif <span class="amout"><b><?php echo 'Rp '.number_format($tarif);?></b></span> per hari</span>
                                <hr>
                                <ul class="list-unstyled spaced">
                                    <li>
                                        <i class="ace-icon fa fa-user bigger-110 purple"></i>
                                        Tamu : <strong><?php echo $namapelanggan ?></strong>
                                    </li>
                                    <li>
                                        <i class="ace-icon fa fa-calendar bigger-110 purple"></i>
                                        Pada tanggal : <strong><?php echo format_date($tglcheckin) ?></strong>
                                    </li>
                                    <li>
                                        <i class="ace-icon fa fa-clock-o bigger-110 purple"></i>
                                        Selama : <strong><?php echo $lamainap ?></strong> Hari
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>   
                    <!-- END / ITEM -->

                    
    </div>
</section>