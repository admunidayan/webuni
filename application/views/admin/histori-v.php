<div style="margin-top: 14px; background-color: white;padding: 30px">
	<div class="media">
		<div class="media-left">
			<h5 class="text-info">Histori</h5>
		</div>
		<div class="media-body"></div>
	</div><hr/>
	<h4 class="text-secondary">Data Tahun</h4>
	<?php if ($hasil == TRUE): ?>
		<div class="row">
			<?php foreach ($hasil as $data): ?>
				<div class="col-md-3">
					<div class="card bts-ats">
						<div class="card-body">
							<i class="fa fa-calendar-o text-success"></i>
							<span class="text-success"><?php echo ' Nota '.$data->kode_tahun; ?></span><br/>
							<p class="text-secondary">Melihat riwayat kegiatan transaksi selama tahun <?php echo $data->kode_tahun; ?> </p>
							<a href="<?php echo base_url('index.php/admin/histori/bulan/'.$data->kode_tahun) ?>" class="text-info">Detail histori</a>
						</div>
					</div>
				</div>	
			<?php endforeach ?>
		<?php else: ?>
			<div class="border border-danger" style="padding: 14px">Belum ada data tersimpan</div>
		<?php endif ?>
	</div>
</div>