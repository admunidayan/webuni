<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="bg-white cari-box">
				<h1><?php echo $detail->jdl_artikel; ?></h1><hr/>
				<img src="<?php echo base_url('asset/img/artikel/'.$detail->image_artikel) ?>" alt="<?php echo $detail->image_artikel ?>" width="100%">
				<?php echo $detail->isi_artikel; ?>
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
			<div class="bg-white cari-box">
				Berita Terkait
				<?php foreach ($terkait as $data): ?>
					<div class="media">
						<div class="media-body">
							<a class="text-bawaan" href="<?php echo base_url('index.php/utama/artikel/'.$data->alias_artikel) ?>"><h6 class="mt-0"><?php echo $data->jdl_artikel; ?></h6></a><hr/>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>