<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="bg-white cari-box">
				<h1>Semua Galeri</h1><hr/>
				<form action="<?php echo base_url('index.php/utama/alldoc/') ?>" method="get">
					<div class="form-group">
						<label>Pencarian Galeri</label>
						<input type="text" name="string" class="form-control" placeholder="Cari galeri">
						<small class="form-text text-muted">cari galeri yang inginkan disini</small>
					</div>
				</form>
				<div class="row">
					<?php foreach ($hasil as $data): ?>
						<div class="col-md-4">
							<img src="<?php echo base_url('asset/img/galeri/'.$data->isi_galeri) ?>" alt="<?php echo $data->isi_galeri ?>" width="100%"><br/>
							<h6 class="text-bawaan"><?php echo $data->nama_galeri; ?></h6>
						</div>
					<?php endforeach ?>
				</div>
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