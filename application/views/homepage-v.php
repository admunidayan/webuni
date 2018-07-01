<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<!-- lgo -->
	<link rel="shortcut icon" href="<?php echo base_url($brand); ?>">
	<!-- css bootsrap 4.0 beta -->
	<link rel="stylesheet" href="<?php echo base_url('asset/css/bootstrap.min.css'); ?>">
	<!-- css font awesome -->
	<link rel="stylesheet" href="<?php echo base_url('asset/css/font-awesome.min.css'); ?>">
	<!-- css font css pribadi -->
	<link rel="stylesheet" href="<?php echo base_url('asset/css/custom.css'); ?>">
	<!-- jquery terlebih dahulu -->
	<script src="<?php echo base_url('asset/js/jquery-3.2.1.min.js'); ?>" type="text/javascript"></script>
	<!-- js bootstrap v.4 butuh pooper.js -->
	<script src="<?php echo base_url('asset/js/popper.min.js'); ?>" type="text/javascript"></script>
	<!-- js bootstrap v.4 -->
	<script src="<?php echo base_url('asset/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
</head>
<body>
	<div class="menav">
		<div class="container-fluid text-light">
			<div class="row">
				<div class="col">
					<div class="row">
						<div class="col"><i class="fa fa-envelope-square"></i> <?php echo $infopt->kontak_4; ?></div>
						<div class="col"><i class="fa fa-phone"></i> <?php echo $infopt->kontak_3; ?></div>
					</div>
				</div>
				<div class="col">
					<div class="row">
						<div class="col"></div>
						<div class="col text-right"><a href="<?php echo base_url('index.php/login') ?>" class="text-light"><i class="fa fa-sign-out"></i> Login atau Pendaftaran</a></div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-dark nbbg2">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="<?php echo base_url($brand); ?>" width="30" height="30" alt="<?php echo $title ?>">
			</a>
			<a class="navbar-brand" href="<?php echo base_url() ?>"><?php echo $infopt->nama_info_pt; ?></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto"></ul>
				<div class="form-inline my-2 my-lg-0">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url() ?>">Home</a>
						</li>
						<li class="nav-item dropdown">
							<?php foreach ($halaman as $data): ?>
							<?php if ($this->Homepage_m->subpage($data->id_laman) == FALSE): ?>
								<?php if ($data->link =='none'): ?>
									<li class="nav-item"><a class="nav-link" href="<?php echo base_url('index.php/utama/laman/'.$data->alias_laman); ?>"><?php echo $data->judul_laman; ?></a></li>
								<?php else: ?>
									<li class="nav-item"><a class="nav-link" href="<?php echo $data->link; ?>"><?php echo $data->judul_laman; ?></a></li>
								<?php endif ?>
								<?php else: ?>
									<li class="dropdown">
										<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $data->judul_laman; ?> <span class="glyphicon glyphicon-chevron-down"></span></a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdown">
											<?php foreach ($this->Homepage_m->subpage($data->id_laman) as $sub): ?>
												<?php if ($sub->link =='none'): ?>
													<a class="dropdown-item" href="<?php echo base_url('index.php/utama/laman/'.$sub->alias_laman); ?>"><?php echo $sub->judul_laman; ?></a>
												<?php else: ?>
													<a class="dropdown-item" class="dropdown-item" href="<?php echo $sub->link; ?>"><?php echo $sub->judul_laman; ?></a>
												<?php endif ?>
											<?php endforeach ?>
										</div>
									</li>
							<?php endif ?>
						<?php endforeach ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<?php $this->view($page); ?>
	<footer class="bg-white cari-box" style="border-top:2px solid #267871">
		<div class="container-fluid">
			<div class="row">
				<div class="col">
					<img src="<?php echo base_url($brand); ?>" width="80px"><?php echo $infopt->nama_info_pt; ?><br/>
					<?php echo $infopt->footer_pt; ?>
				</div>
				<div class="col"></div>
				<div class="col">
					Link
					<div class="row">
						<?php foreach ($link2 as $data): ?>
							<div class="col text-center">
								<img src="<?php echo base_url('asset/img/link/'.$data->img_link) ?>" width="92px">
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
	</footer>
</body>
</html>