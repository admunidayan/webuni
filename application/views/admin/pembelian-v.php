<div style="margin-top: 14px; background-color: white;padding: 30px">
	<div class="media">
		<div class="media-left">
			<h5 class="text-info">Pembelian</h5>
		</div>
		<div class="media-body"></div>
		<div class="media-right"><a href="<?php echo base_url('index.php/admin/pembelian/create/'.date('Y-m-d')) ?>" class="btn btn-outline-success">Tambah Pembelian</a></div>
	</div><hr/>
	<table>
		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td><?php echo date('Y-m-d') ?></td>
		</tr>
		<tr>
			<td>Hari</td>
			<td>:</td>
			<td><?php echo date('l') ?></td>
		</tr>
		<tr>
			<td>Bulan</td>
			<td>:</td>
			<td><?php echo date('M') ?></td>
		</tr>
	</table><hr/>
	<?php if ($hasil == TRUE): ?>
		<div class="row">
			<?php foreach ($hasil as $data): ?>
				<div class="col-md-3">
					<div class="card bts-ats">
						<div class="card-body">
							<?php if ($data->id_status == '2'): ?>
								<i class="fa fa-check-circle-o text-success"></i>
								<span class="text-success"><?php echo ' Nota '.$data->id_nota; ?></span>
							<?php else: ?>
								<i class="fa fa-times-circle-o text-danger"></i>
								<span class="text-danger"><?php echo ' Nota '.$data->id_nota; ?></span>
							<?php endif ?><br/>
							<span class="text-secondary"><i class="fa fa-user-o"></i> <?php echo $data->username; ?></span><br/>
							<span class="text-secondary"><i class="fa fa-clock-o"></i> <?php echo $data->jam_nota; ?></span><hr/>
							<a href="<?php echo base_url('index.php/admin/pembelian/nota/'.$data->id_nota) ?>" class="text-info">Detail nota</a>
						</div>
					</div>
				</div>	
			<?php endforeach ?>
		</div>
		<?php else: ?>
			<div class="border border-danger" style="padding: 14px">Belum ada transaksi hari ini</div>
	<?php endif ?>
</div>