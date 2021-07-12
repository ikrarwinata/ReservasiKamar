<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		
		<ul>
			<?php for ($i=1; $i <= 12; $i++) { ?>
				<?php if ($datas[$i]>=1): ?>
					<li style="padding-top: 8px"><a href="admin/CAdmin/rekap_print2/<?php echo ($i) ?>" target="_blank" class="btn btn-sm btn-primary"><?php echo get_str_month($i).' ('.$datas[$i].')' ?></a></li>
				<?php else: ?>
					<li style="padding-top: 8px"><a href="admin/CAdmin/rekap_print2/<?php echo ($i) ?>" target="_blank" class="btn btn-sm btn-default"><?php echo get_str_month($i).' ('.$datas[$i].')' ?></a></li>
				<?php endif ?>
			<?php } ?>
		</ul>

		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->