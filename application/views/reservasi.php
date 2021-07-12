        <!-- ROOM DETAIL -->
        <section class="section-room-detail bg-white" style="padding-top: 25px">
            <div class="container">
                
				<!-- COMPARE ACCOMMODATION -->
                <div class="room-detail_compare">
                    <div class="row">
                        <div class="col col-xs-12 col-lg-6 col-lg-offset-3">
                            <div class="ot-heading row-20 mb30 text-center">
                                <h2 class="shortcode-heading">Kamar Telah di Reservasi</h2>
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
                                       <a href="<?php echo ('CPublic/reservasi_view/'.$j->idreservasi) ;?>"><img class="img img-responsive" src="<?php echo $j->fotokamar ?>" alt=""></a>
                                    </div>  
                                
                                    <div class="text">
                                        <h2><a herf="rooms"><?php echo $j->nomorkamar;?></a></h2>
                                		
										<div class="row">
                                            <div class="col col-sm-8">
                                                <small style="color: red;"><?php echo $j->namapelanggan ?></small>
                                            </div>
                                            <div class="col col-sm-4 right">
                                                @<small style="color: red;"><?php echo format_date($j->tglcheckin) ?></small>
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                            <!-- END / ITEM -->
                            
							<?php endforeach; ?>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="dataTables_info">Showing <?php echo $start+1?> to <?php echo $start+$per_page ?> of <?php echo $total_rows ?> entries</div>
                            </div>
                            <div class="col-xs-6">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    <?php echo $pagination ?>
                                </div>
                            </div>
                        </div>
                    <!-- END / COMPARE ACCOMMODATION -->
                    </div>
                </div>
            </div>
        </section>
        <!-- END / SHOP DETAIL -->