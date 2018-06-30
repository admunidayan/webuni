<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="bg-white cari-box">
				<h1><?php echo $detail->judul_info_kampus; ?></h1><hr/>
				<?php echo $detail->isi_info_kampus; ?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="bg-white cari-box">
				Info
				<?php foreach ($infor as $data): ?>
					<div class="media">
						<div class="media-body">
							<a class="text-bawaan" href="<?php echo base_url('index.php/utama/info/'.$data->alias_info_kampus) ?>"><h6 class="mt-0"><?php echo $data->judul_info_kampus; ?></h6></a><hr/>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>