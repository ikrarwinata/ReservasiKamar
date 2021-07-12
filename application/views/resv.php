<section class="section-sub-banner bg-9">
    <div></div>
    <div class="sub-banner">
        <div class="container">
            <div class="text text-center">
            </div>
        </div>

    </div>

</section>
<!-- CONTACT -->
<section class="section-contact">
    <div class="container">
        <div class="contact">
			<div class="row">
				<div class="col col-md-4">
				
				</div>
				<div class="col col-md-4 center text-center">
					<span class="text-danger" align="center"><?php echo $this->session->userdata("message") ?></span>
				</div>
				<div class="col col-md-4">
				
				</div>
			</div>
            <div class="row">
                <h2 align="center"><a href="#"><strong><?php echo $nomorkamar;?></strong></a></h2>
                <div class="col-md-6 col-lg-5 text-center" style="border: 3px solid rgba(217, 141, 61, 0.96)">
                    
                    <div class="grid images_3_of_2">
                        <div class="flexslider">
                            <ul class="slides">
                                <li data-thumb="<?php echo $fotokamar ?>">
                                    <div class="thumb-image" id="main">
                                        <img src="<?php echo $fotokamar ?>" class="img-responsive" alt=""> </div>
                                </li>
                                <?php if (isset($foto2)): ?>
                                    <li data-thumb="<?php echo $foto2 ?>">
                                        <div class="thumb-image">
                                            <img src="<?php echo $foto2 ?>" class="img-responsive" alt=""> </div>
                                    </li>
                                <?php endif ?>
                                <?php if (isset($foto3)): ?>
                                    <li data-thumb="<?php echo $foto3 ?>">
                                        <div class="thumb-image">
                                            <img src="<?php echo $foto3 ?>" class="img-responsive" alt=""> </div>
                                    </li>
                                <?php endif ?>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-lg-offset-1">
                    <div class="contact-form">
                        <?php echo(form_open_multipart('CPublic/reservation_action/'.$idkamar, 'onsubmit="return validateme()"')) ?>
                            <div class="row">
                                <div class="col-sm-6" style="padding-top: 40px;">
                                    <label> Username</label>
                                    <input type="text" class="field-text form-control"  name="username" placeholder="Username" id="uname" required="true">
                                </div>
                                <div class="col-sm-6" style="padding-top: 40px;">
                                    <label> Password</label>
                                    <input type="password" class="field-text form-control" name="password" placeholder="Password" id="psw" required="true">
                                </div>
                                <div class="col-sm-12" style="padding-top: 10px;">
                                    <label> Belum punya akun? Silahkan mendaftar <em><a href="CPublic/register">disini</a></em></label>
                                </div>
                                <hr class="clear-fix">
                                <div class="col-sm-4" style="padding-top: 50px;">
                                    <label> Tanggal Check In</label>
                                    <input type="date" class="field-text form-control date-picker" id="tglcheckin" name="tglcheckin" placeholder="Pilih Tanggal Check In" required="true">
                                </div>
                                <div class="col-sm-4" style="padding-top: 50px;">
                                    <label> Tanggal Check Out</label>
                                    <input type="date" class="field-text form-control date-picker" name="tglcheckout" id="tglcheckout" required="true">
                                    <input type="hidden" name="lamainap" id="inputlamainap" value="0">
                                </div>
                                <div class="col-sm-4" style="padding-top: 50px;">
                                    <label> Lama Inap</label>
                                    <label class="field-text form-control"> <span id="placeholderlamainap">0</span> Hari</label>
                                </div>

                                <div class="row">
                                    <hr class="clear-fix">
                                    <div class="row">
                                        <div class="col-sm-4 col-lg-4" style="padding-top: 50px;">
                                            <label> Foto KTP anggota menginap</label>
                                        </div>
                                        <div class="col-sm-8 col-lg-8" style="padding-top: 50px;">
                                            <button type="button" class="btn btn-sm btn-success" title="Tambah KTP" id="addmember"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <br class="clear-fix">
                                    <div id="membercontainer">
                                        <div class="row member">
                                            <div class="col-lg-10">
                                                <div class="form-group">
                                                    <input type="file" class="field-text form-control" name="member[]" accept="image/*" placeholder="Pilih foto ktp anggota yang ikut menginap">
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="btn btn-sm btn-danger field-text form-control" title="HAPUS KTP" onclick="return submember(this)"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12" style="padding-top: 50px;">
                                        <label> Pilih Rekening Pembayaran Uang Muka</label>
                                    </div>
                                    <?php foreach ($bank_data as $key => $value): ?>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="rek"><img src="<?php echo $value->gambar ?>" height="150px" width="auto"></label>
                                                <input type="radio" name="rek" class="form-control field-text" value="<?php echo $value->idbank ?>">
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>

                                <div class="col-sm-12" style="padding-top: 10px;">
                                    <button type="submit" id="subm" class="awe-btn awe-btn-14 pull-right">Reservasi</button>
                                </div>
                            </div>
                            <div id="contact-content"><?php echo $this->session->flashdata('msg');?></div>
                        </form>
                    </div>
                </div>

            </div>  
        </div>
    </div>
</section>

<!-- END / CONTACT -->
