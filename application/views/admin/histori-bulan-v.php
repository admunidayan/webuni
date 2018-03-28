<div style="margin-top: 14px; background-color: white;padding: 30px">
	<?php if ($hasil == TRUE): ?>
		<div class="row">
			<?php foreach ($hasil as $data): ?>
				<div class="col-md-3">
					<div class="card bts-ats">
						<div class="card-body">
							<i class="fa fa-calendar-o text-success"></i>
							<span class="text-success"><?php echo $data->nm_bulan.' '.$thn; ?></span><br/>
							<p class="text-secondary">Riwayat kegiatan transaksi pada bulan <?php echo $data->nm_bulan.' '.$thn; ?> </p>
							<a href="<?php echo base_url('index.php/admin/histori/list_bulan/'.$thn.'-'.$data->kode_bulan) ?>" class="text-info">Detail histori</a>
						</div>
					</div>
				</div>	
			<?php endforeach ?>
		<?php else: ?>
			<div class="border border-danger" style="padding: 14px">Belum ada data tersimpan</div>
		<?php endif ?>
	</div>
</div>