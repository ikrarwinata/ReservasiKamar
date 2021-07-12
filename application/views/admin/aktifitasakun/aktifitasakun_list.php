<div id="timeline-2">
	<div class="row center">
		<?php echo $this->session->userdata("message") ?>
	</div>
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
            <div class="align-right">
                <div class="btn-group btn-corner">                    
                    <a href="admin/Aktifitasakun/clear/<?php echo $akunlevel ?>" class="btn btn-white btn-danger tooltips-slide-down" title="Bersihkan Aktifitas" onClick="return confirm('Anda yakin ingin menghapus semua data aktifitas ?')">
                        <i class="fa fa-trash bigger-110"></i>
                    </a>
                </div>
            </div>
            <div class="timeline-container timeline-style2">
                <span class="timeline-label">
                    <b><?php echo($judul[count($judul)-1]) ?></b>
                </span>

                <div class="timeline-items">
                <?php 
                    foreach($aktifitasakun_data as $aktifitas){ 
                ?>
                    <div class="timeline-item clearfix">
                        <div class="timeline-info">
                            <span class="timeline-date"><?php echo timelog($aktifitas->tanggal,$aktifitas->jam) ?></span>

                            <i class="timeline-indicator btn btn-grey no-hover"></i>
                        </div>
                        <div class="widget-box transparent">
                            <div class="widget-body">
                                <div class="widget-main no-padding">
                                    <span class="bolder orange"><?php echo $aktifitas->nama ?></span>
                                    <?php echo logcat($aktifitas->action, $aktifitas->displaytext, $aktifitas->controller) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div><!-- /.timeline-items -->
            </div><!-- /.timeline-container -->
        </div>
    </div>
</div>

<div class="hr hr-18 dotted hr-double"></div>

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