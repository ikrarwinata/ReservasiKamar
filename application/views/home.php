<section class="section-slider">
    <h1 class="element-invisible">Slider</h1>
    <div id="slider-revolution">
        <ul>
            <li data-transition="fade">
                <img src="assets/images/slider/1.jpg" data-bgposition="left center" data-duration="14000" data-bgpositionend="right center" alt="">

                <div class="tp-caption sft fadeout slider-caption-sub slider-caption-1" data-x="center" data-y="100" data-speed="700" data-start="1500" data-easing="easeOutBack">

                </div>

                <div class="tp-caption sft fadeout slider-caption-sub slider-caption-1" data-x="center" data-y="240" data-speed="700" data-start="1500" data-easing="easeOutBack">
                    SELAMAT DATANG DI
                </div>

                <div class="tp-caption sfb fadeout slider-caption slider-caption-sub-1" data-x="center" data-y="280" data-speed="700" data-easing="easeOutBack" data-start="2000"> WEBSITE RESERVASI KAMAR </div>
                <div class="tp-caption sfb fadeout slider-caption-sub slider-caption-sub-3" data-x="center" data-y="365" data-easing="easeOutBack" data-speed="700" data-start="2200"> <?php echo ($this->config->item("app_name")) ?></div>
            </li>
        </ul>
        <ul>
            <li data-transition="fade">
                <img src="assets/images/slider/1.jpg" data-bgposition="left center" data-duration="14000" data-bgpositionend="right center" alt="">

                <div class="tp-caption sft fadeout slider-caption-sub slider-caption-1" data-x="center" data-y="100" data-speed="700" data-start="1500" data-easing="easeOutBack">

                </div>

                <div class="tp-caption sft fadeout slider-caption-sub slider-caption-1" data-x="center" data-y="240" data-speed="700" data-start="1500" data-easing="easeOutBack">
                    SELAMAT DATANG DI
                </div>

                <div class="tp-caption sfb fadeout slider-caption slider-caption-sub-1" data-x="center" data-y="280" data-speed="700" data-easing="easeOutBack" data-start="2000"> WEBSITE RESERVASI KAMAR </div>
                <div class="tp-caption sfb fadeout slider-caption-sub slider-caption-sub-3" data-x="center" data-y="365" data-easing="easeOutBack" data-speed="700" data-start="2200"> <?php echo ($this->config->item("app_name")) ?></div>
            </li>
        </ul>
    </div>
</section>

<section class="section-check-availability">
    <div class="container">
        <div class="check-availability">
            <div class="row v-align">
                <div class="col-lg-3">
                    <h2>BUAT <br> RESERVASI</h2>
                </div>
                <div class="col-lg-9">
                    <div class="availability-form">
                        <div class="vailability-submit">
                            <a href="CPublic/rooms" class="awe-btn awe-btn-13">PESAN KAMAR</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-room-detail bg-white">
    <div class="container">

        <!-- COMPARE ACCOMMODATION -->
        <div class="room-detail_compare">
            <div class="row">
                <div class="col col-xs-12 col-lg-6 col-lg-offset-3">
                    <div class="ot-heading row-20 mb30 text-center">
                        <h2 class="shortcode-heading">KAMAR TERSEDIA</h2>
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
                                    <a href="<?php echo ('CPublic/rooms_view/' . $j->idkamar); ?>"><img class="img img-responsive" src="<?php echo $j->fotokamar ?>" alt="<?php echo $j->fotokamar ?>" style="height: 190px !important;"></a>
                                </div>

                                <div class="text">
                                    <h2><a herf="room"><?php echo $j->nomorkamar; ?>s</a></h2>

                                    <ul>
                                        <h4><?php echo 'Rp ' . number_format($j->tarif); ?></h4>
                                    </ul>

                                </div>

                            </div>
                        </div>
                        <!-- END / ITEM -->

                    <?php endforeach; ?>


                </div>
                <div class="text-center">
                    <a href="CPublic/rooms" class="awe-btn awe-btn-default font-hind f12 bold btn-medium mt15">Lihat Semua</a>
                </div>
                <!-- END / COMPARE ACCOMMODATION -->
            </div>
</section>

<section class="section-blog bg-white">
    <div class="container">
        <div class="blog">
            <div class="row">

                <div class="col-md-12">
                    <div class="blog-content events-content">

                        <div class="content">
                            <div class="row">
                                <div class="col-xs-12 col-lg-6 col-lg-offset-3">
                                    <div class="ot-heading row-20 mb40 text-center">
                                        <h2 class="shortcode-heading"><?php echo ($this->config->item("app_name")) ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <p><?php echo ($this->config->item("app_name")) ?> merupakan salah satu penginapan yang elegan dan murah yang berada di koa ..... Lokasi yang berpusat di kota, memudahkan pelanggan untuk berpergian atau jalan-jalan menikmati isi kota .....</p>
                                <strong><?php echo ($this->config->item("app_name")) ?> bertempat di alamat ............</strong>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>