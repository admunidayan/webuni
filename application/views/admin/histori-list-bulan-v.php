<div class="row">
	<div class="col-md-7">
		<div style="margin-top: 14px; background-color: white;padding: 30px">
			<h5 class="text-info">Detail Bulan</h5><hr/>
			<?php if ($hasil == TRUE): ?>
				<div class="row">
					<?php foreach ($hasil as $data): ?>
						<div class="col-md-4">
							<div class="card bts-ats">
								<div class="card-body">
									<i class="fa fa-calendar-o text-success"></i> <span class="text-secondary">Tanggal</span><br/>
									<span class="text-success"><?php echo $data->kode; ?></span><br/>
									<a href="<?php echo base_url('index.php/admin/histori/hari/'.$data->kode) ?>" class="text-info">Detail histori</a>
								</div>
							</div>
						</div>	
					<?php endforeach ?>
				<?php else: ?>
					<div class="border border-danger" style="padding: 14px">Belum ada data tersimpan</div>
				<?php endif ?>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div style="margin-top: 14px; background-color: white;padding: 30px">
			<h5 class="text-info">Penghasilan di bulan ini</h5>
			<table class="table" style="font-size: 12px">
				<tr>
					<td>No</td>
					<td>Tanggal</td>
					<td>Total</td>
				</tr>
				<?php if ($hasil == TRUE): ?>
					<?php $no =1 ?>
					<?php foreach ($hasil as $data): ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data->kode;?></td>
							<td><?php echo 'Rp.'.number_format($data->total,0,',','.');?></td>
						</tr>
						<?php $no++; ?>
					<?php endforeach ?>
					<?php $harga = 0 ?>
					<?php foreach ($hasil as $data): ?>
						<?php $harga = $data->total + (int)@$harga; ?>
					<?php endforeach; ?>
					<tr>
						<td colspan="2"><b>Total</b></td>
						<td><b ><?php echo 'Rp.'.number_format($harga,0,',','.'); ?></b></td>
					</tr>
				<?php else: ?>
					<tr>
						<td colspan="3">Belum ada data tersimpan</td>
					</tr>
				<?php endif ?>
			</table>
		</div>
	</div>
</div>