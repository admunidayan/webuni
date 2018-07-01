<div class="mainslide">
	<div class="">
		<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100" src="<?php echo base_url('asset/img/slider/'.$ftslider->img_slider) ?>" alt="First slide">
				</div>	
				<?php foreach ($scslider as $data): ?>
					<div class="carousel-item">
						<img class="d-block w-100" src="<?php echo base_url('asset/img/slider/'.$data->img_slider) ?>" alt="First slide">
					</div>	
				<?php endforeach ?>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
</div>
<div class="container">
	<div class="bg-white cari-box">
		<h2 class="text-center">Cari Sesuatu disini . . .</h2><hr/>
		<div class="row">
			<div class="col">
				<a href="<?php echo base_url('index.php/utama/allnews') ?>"><img src="<?php echo base_url('asset/img/news.gif') ?>" width="100%"></a><hr/>
				<a href="<?php echo base_url('index.php/utama/allnews') ?>" class="text-bawaan text-center"><h4>Berita</h4></a>
			</div>
			<div class="col">
				<a href="<?php echo base_url('index.php/utama/alldoc') ?>"><img src="<?php echo base_url('asset/img/document.gif') ?>" width="100%"></a><hr/>
				<a href="<?php echo base_url('index.php/utama/alldoc') ?>" class="text-bawaan text-center"><h4>Dokumen</h4></a>
			</div>
			<div class="col">
				<a href="<?php echo base_url('index.php/utama/allgalery') ?>"><img src="<?php echo base_url('asset/img/galeri.gif') ?>" width="100%"></a><hr/>
				<a href="<?php echo base_url('index.php/utama/allgalery') ?>" class="text-bawaan text-center"><h4>Galeri</h4></a>
			</div>
		</div>
	</div>
	<div class="bg-white cari-box">
		<h5>Berita</h5>
		<div class="row">
			<?php foreach ($artikel as $data): ?>
				<div class="col-md-4">
					<a href="<?php echo base_url('index.php/utama/artikel/'.$data->alias_artikel) ?>"><img src="<?php echo base_url('asset/img/artikel/'.$data->image_artikel) ?>" width="100%"></a>
					<a class="text-bawaan" href="<?php echo base_url('index.php/utama/artikel/'.$data->alias_artikel) ?>"><h5 class="bts-ats"><?php echo $data->jdl_artikel; ?></h5></a>
					<p><?php echo $data->deskripsi_artikel.' ...'; ?></p>
					<hr/>
					<a class="text-secondary" href="<?php echo base_url('index.php/utama/artikel/'.$data->alias_artikel) ?>">Selengkapnya <i class="fa fa-caret-right"></i></a>
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<div class="bg-white cari-box">
		<h5>Video</h5>
		<div class="row">
			<?php foreach ($video as $data): ?>
				<div class="col-md-4">
					<div><?php echo $data->isi_video; ?></div>
					<a class="text-bawaan" href="<?php echo base_url('index.php/utama/video/'.$data->alias_video) ?>"><h5 class="bts-ats"><?php echo $data->judul_video; ?></h5></a>
					<p><?php echo $data->ket_video.' ...'; ?></p>
					<hr/>
					<a class="text-secondary" href="<?php echo base_url('index.php/utama/video/'.$data->alias_video) ?>">Selengkapnya <i class="fa fa-caret-right"></i></a>
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<div class="bg-white cari-box">
		<h5>Link</h5>
		<div class="row">
			<?php foreach ($link as $data): ?>
				<div class="col text-center">
					<img src="<?php echo base_url('asset/img/link/'.$data->img_link) ?>" width="92px">
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>