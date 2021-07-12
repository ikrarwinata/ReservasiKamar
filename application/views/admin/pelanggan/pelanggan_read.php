
<table class="table">
	<tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	<tr><td>Jeniskelamin</td><td><?php echo $jeniskelamin; ?></td></tr>
	<tr><td>Tgllahir</td><td><?php echo $tgllahir; ?></td></tr>
	<tr><td>Telepon</td><td><?php echo $telepon; ?></td></tr>
	<tr><td>Email</td><td><?php echo $email; ?></td></tr>
	<tr><td>Idakun</td><td><?php echo $idakun; ?></td></tr>
	<tr>
		<td>
			<ul class="ace-thumbnails clearfix">
				<li>
					<a href="<?php echo $fotoprofil; ?>" data-rel="colorbox">
						<img width="150" height="150" alt="150x150" src="<?php echo $fotoprofil; ?>" />
						<div class="text">
							<div class="inner">Foto <?php echo $nama; ?></div>
						</div>
					</a>
				</li>
			</ul>
		</td>
		<td>
			<ul class="ace-thumbnails clearfix">
				<li>
					<a href="<?php echo $fotoktp; ?>" data-rel="colorbox">
						<img width="150" height="150" alt="150x150" src="<?php echo $fotoktp; ?>" />
						<div class="text">
							<div class="inner">Foto KTP <?php echo $nama; ?></div>
						</div>
					</a>
				</li>
			</ul>
		</td>
	</tr>
	<tr><td></td><td><button onClick="window.history.go(-1)" class="btn btn-default">Cancel</button></td></tr>
</table>