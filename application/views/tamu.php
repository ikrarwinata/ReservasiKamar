        <!-- ROOM DETAIL -->
        <section class="section-room-detail bg-white" style="padding-top: 25px">
            <div class="container">
                
                <!-- COMPARE ACCOMMODATION -->
                <div class="room-detail_compare">
                    <div class="row">
                        <div class="col col-xs-12 col-lg-6 col-lg-offset-3">
                            <div class="ot-heading row-20 mb30 text-center">
                                <h2 class="shortcode-heading">Tamu Saat Ini</h2>
                            </div>
                        </div>
                    </div>

                    <div class="room-compare_content">
                        
                        <div class="row">
                            <!-- ITEM -->
                            
                            <?php 
                                foreach($kamar_data as $j):
                            ?>
                            
                            
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="room-compare_item">
                                    <div class="img">
                                       <a href="<?php echo site_url('rooms');?>"><img class="img img-responsive" src="<?php echo $j->fotokamar ?>" alt=""></a>
                                    </div>  
                                
                                    <div class="text">
                                        <h2><a herf="rooms"><?php echo $j->nomorkamar;?></a></h2>
                                
										<small style="color: green"><?php echo $j->nama;?></small>
                                
                                    </div>
                                
                                </div>
                            </div>
                            <!-- END / ITEM -->
                            
                            <?php endforeach; ?>
                        </div>
                        <div class="text-center">
                            <?php if(count($kamar_data)>=1){ ?>
                            <a href="CPublic/rooms" class="awe-btn awe-btn-default font-hind f12 bold btn-medium mt15">View More</a>
                            <?php } ?>
                        </div>
                    <!-- END / COMPARE ACCOMMODATION -->
                    </div>
                </div>
            </div>
        </section>
        <!-- END / SHOP DETAIL -->