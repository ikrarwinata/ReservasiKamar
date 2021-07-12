<section class="section-sub-banner bg-9">
    <div></div>
    <div class="sub-banner">
        <div class="container">
            <div class="text text-center">
            </div>
        </div>

    </div>

</section>
<!-- ROOM DETAIL -->
<section class="section-room-detail bg-white" style="padding-top: 25px">
    <div class="container">

        <!-- COMPARE ACCOMMODATION -->
        <div class="room-detail_compare">
            <div class="row">
                <div class="col col-xs-12 col-lg-6 col-lg-offset-3">
                    <div class="ot-heading row-20 mb30 text-center">
                        <h2 class="shortcode-heading">Semua Kamar</h2>
                    </div>
                </div>
            </div>

            <div class="room-compare_content">

                <div class="row">
                    <!-- ITEM -->

                    <?php
                    foreach ($kamar_data as $j) :
                    ?>


                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <div class="room-compare_item">
                                <div class="img">
                                    <a href="<?php echo ('CPublic/rooms_view/' . $j->idkamar); ?>#main"><img class="img img-responsive" src="<?php echo $j->fotokamar ?>" alt="" style="border-radius: 25px;height: 190px !important;"></a>
                                </div>

                                <div class="text">
                                    <h2><a herf="<?php echo ('CPublic/rooms_view/' . $j->idkamar); ?>#main"><?php echo $j->nomorkamar; ?></a></h2>

                                    <h6><?php echo "Rp." . format_number($j->tarif) ?></h6>
                                    <small style="color: red;"><?php echo $j->digunakan == 1 ? "Tidak tersedia" : NULL; ?></small>

                                </div>

                            </div>
                        </div>
                        <!-- END / ITEM -->

                    <?php endforeach; ?>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="dataTables_info">Showing <?php echo $start + 1 ?> to <?php echo $start + $per_page ?> of <?php echo $total_rows ?> entries</div>
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