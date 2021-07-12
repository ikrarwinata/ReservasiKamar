    <!--BANNER -->
    <section class="section-sub-banner bg-9">
        <div></div>
        <div class="sub-banner">
            <div class="container">
                <div class="text text-center">
                </div>
            </div>

        </div>

    </section>
    <!-- END BANNER -->
    <section class="section-contact">
        <div class="container">
            <div class="contact">
                <div class="row">
                    <div class="col-md-6 col-lg-5">

                        <div class="text">
                            <h2>Contact</h2>
                            <p><?php echo ($this->config->item('app_name')) ?> merupakan salah satu penginapan yang elegan dan murah yang berada di koa ..... Lokasi yang berpusat di kota, memudahkan pelanggan untuk berpergian atau jalan-jalan menikmati isi kota .....</p>
                            <p>Jika anda memiliki masalah mengenai kami silahkan kontak kami, dengan senang hati kami melayani anda.</p>

                            <ul>
                                <li><i class="fa fa-map-marker"></i> Jln ....., Kelurahan, Kecamatan, Kota ..., Jambi 99999</li>
                                <?php foreach ($petugas_data as $petugas) { ?>
                                    <li><i class="fa fa-phone"></i> <?php echo $petugas->telepon ?></li>
                                <?php } ?>
                                <?php foreach ($petugas_data as $petugas) { ?>
                                    <li><i class="fa fa-envelope"></i> <?php echo $petugas->email ?></li>
                                <?php } ?>
                            </ul>



                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-lg-offset-1">
                        <div class="contact-form">
                            <form action="<?php echo site_url('contact/kirim'); ?>" method="post">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="field-text" name="name" placeholder="Name" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="email" class="field-text" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" class="field-text" name="subject" placeholder="Subject" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea cols="30" rows="10" name="message" class="field-textarea" placeholder="Write you message" required></textarea>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="submit" class="awe-btn awe-btn-14">SEND</button>
                                    </div>
                                </div>
                                <div id="contact-content"><?php echo $this->session->flashdata('msg'); ?></div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>