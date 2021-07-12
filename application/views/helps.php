<!-- ROOM DETAIL -->
<section class="section-room-detail bg-white" style="padding-top: 25px">
    <div class="container">

        <!-- COMPARE ACCOMMODATION -->
        <div class="room-detail_compare">
            <div class="row">
                <div class="col col-xs-12 col-lg-6 col-lg-offset-3">
                    <div class="ot-heading row-20 mb30 text-center">
                        <h2 class="shortcode-heading">BANTUAN</h2>
                    </div>
                </div>
            </div>

            <?php
            $t = $this->db->query("SELECT telepon AS tel FROM petugas WHERE telepon <> NULL OR telepon <> '' LIMIT 1 OFfSET 0")->row()->tel;
            $t = str_replace(" ", NULL, $t);
            $t = str_replace("(", NULL, $t);
            $t = str_replace(")", NULL, $t);
            $t = str_replace("+", NULL, $t);
            $t = str_replace("-", NULL, $t);
            ?>
            <div class="room-compare_content">
                <h3>Cara Reservasi</h3>
                <hr class="clear-fix">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                            <h4>1.</h4>
                        </div>
                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                            Tamu diharuskan memiliki 1 akun untuk bisa melakukan reservasi. <a href="CPublic/register" style="color: blue">Klik disini</a> untuk membuat akun baru.
                            <ul>
                                <li>Isi data di halaman register untuk mendapatakan akun</li>
                                <li>Jika anda mempunyai akun anda bisa melanjutkan ke tahap selanjutnya</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 center text-center">
                        <img src="assets/info/register.jpg" style="width: auto; height: 250px">
                    </div>
                </div>
                <hr class="clear-fix">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 center text-center">
                        <img src="assets/info/kamar.jpg" style="width: auto; height: 250px">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                            <h4>2.</h4>
                        </div>
                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                            Setelah memiliki akun, tamu bisa memilih kamar yang ingin di reservasi pada halaman <a href="CPublic/rooms" style="color: blue">Semua Kamar</a>.
                        </div>
                    </div>
                </div>
                <hr class="clear-fix">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                            <h4>3.</h4>
                        </div>
                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                            Pada halaman ini anda dapat melihat detail kamar dan reservasi yang telah dilakukan oleh tamu lain (jika tersedia).
                            <ul>
                                <li>Pilih <strong>Reservasi</strong> untuk melanjutkan.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 center text-center">
                        <img src="assets/info/kamardetail.jpg" style="width: auto; height: 250px">
                    </div>
                </div>
                <hr class="clear-fix">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 center text-center">
                        <img src="assets/info/invoice.jpg" style="width: auto; height: 250px">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                            <h4>4.</h4>
                        </div>
                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                            Reservasi anda akan dikonfirmasi setelah anda melakukan pembayaran uang muka.
                            <ul>
                                <li>Upload bukti pembayaran anda pada halaman ini.</li>
                                <li>Uang muka yang harus dibayar adalah 20% dari jumlah tarif.</li>
                                <li>Halaman ini bisa anda buka kembali dari <strong>Menu User</strong> <small><em>(Login->Riwayat->Riwayat Reservasi->Upload Bukti Pembayaran)</em></small>.</li>
                                <li>Setelah bukti pembayaran di upload anda dapat menunggu konfirmasi petugas sebelum bisa check in. (Anda dapat <a href="https://api.whatsapp.com/send?phone=<?php echo $t ?>&text=Hallo%20Petugas%20<?php echo (urlencode($this->config->item("app_name"))) ?>%2c%0d%0a%20%0d%0aSaya%20menunggu%20konfirmasi%20kamar%20di%20yang%20telah%20saya%20pesan&source=&data=" style="color: blue">menghubungi petugas</a> untuk info lebih lanjut)</li>
                                <li>Anda juga dapat melihat status reservasi anda yang lainnya di <strong>Menu User</strong> <small><em>(Login->Riwayat->Riwayat Reservasi)</em></small>.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- END / COMPARE ACCOMMODATION -->
            </div>
        </div>
    </div>
</section>
<!-- END / SHOP DETAIL -->