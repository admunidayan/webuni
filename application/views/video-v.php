<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="bg-white cari-box">
				<div><?php echo $detail->isi_video; ?></div>
				<h1><?php echo $detail->judul_video; ?></h1><hr/>
				<?php echo $detail->ket_video; ?>
			</div>
			<div class="bg-white cari-box">
				Video lainya
				<div class="row">
					<?php foreach ($videor as $data): ?>
						<div class="col-md-4">
							<div><?php echo $data->isi_video; ?></div>
							<a href="<?php echo base_url('index.php/utama/video/'.$data->alias_video) ?>"><h6 class="text-bawaan"><?php echo $data->judul_video; ?></h6></a>
						</div>
					<?php endforeach ?>
				</div>
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