<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="bg-white cari-box">
				<h1>Semua Berita</h1><hr/>
				<form action="<?php echo base_url('index.php/utama/allnews/') ?>" method="get">
					<div class="form-group">
						<label>Pencarian berita</label>
						<input type="text" name="string" class="form-control" placeholder="Cari berita">
						<small class="form-text text-muted">cari berita yang inginkan disini</small>
					</div>
				</form>
				<?php foreach ($hasil as $data): ?>
					<div class="media">
						<a href="<?php echo base_url('index.php/utama/artikel/'.$data->alias_artikel) ?>"><img class="mr-3" src="<?php echo base_url('asset/img/artikel/'.$data->image_artikel) ?>" alt="<?php echo $data->image_artikel ?>" width="150px"></a>
						<div class="media-body">
							<a href="<?php echo base_url('index.php/utama/artikel/'.$data->alias_artikel) ?>"><h5 class="mt-0 text-bawaan"><?php echo $data->jdl_artikel; ?></h5></a>
							<p class="text-secondary"><?php echo $data->deskripsi_artikel; ?></p>
						</div>
					</div><hr/>
				<?php endforeach ?>
				<div class="row">
					<div class="col">
						<!--Tampilkan pagination-->
						<?php echo $pagination; ?>
					</div>
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