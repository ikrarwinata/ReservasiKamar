<form action="<?php echo $action; ?>" method="post">
    <div class="form-group">
        <label for="int">Pengeluaran <?php echo form_error('pengeluaran') ?></label>
        <input type="text" class="form-control" name="pengeluaran" id="pengeluaran" placeholder="Pengeluaran" value="<?php echo $pengeluaran; ?>" />
    </div>
    <div class="form-group">
        <label for="varchar">Tgl <?php echo form_error('tgl') ?></label>
        <input type="date" class="form-control" name="tgl" id="tgl" placeholder="Tgl" value="<?php echo $tgl; ?>" />
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi <?php echo form_error('deskripsi') ?></label>
        <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder="Deskripsi"><?php echo $deskripsi; ?></textarea>
    </div>
    <input type="hidden" name="idpengeluaran" value="<?php echo $idpengeluaran; ?>" /> 
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    <a href="<?php echo site_url('pengeluaran') ?>" class="btn btn-default">Cancel</a>
</form>