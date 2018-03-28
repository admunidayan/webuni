<h6 class="text-secondary">Navigator</h6>
<ul class="navbar-nav mr-auto">
	
	<?php if ($this->ion_auth->in_group('admin')): ?>
		<a href="<?php echo base_url('index.php/admin/dashboard/') ?>"><li class="linkmenu text-dark"><i class="fa fa-desktop text-info"></i> Beranda</li></a>
		<a href="<?php echo base_url('index.php/admin/artikel/') ?>"><li class="linkmenu text-dark"><i class="fa fa-list text-info"></i> Artikel</li></a>
		<a href="<?php echo base_url('index.php/admin/info/') ?>"><li class="linkmenu text-dark"><i class="fa fa-trophy text-info"></i> Info</li></a>
		<a href="<?php echo base_url('index.php/admin/dokumen/') ?>"><li class="linkmenu text-dark"><i class="fa fa-shopping-basket text-info"></i> Dokumen</li>
		</a>
		<a href="<?php echo base_url('index.php/admin/galeri/') ?>"><li class="linkmenu text-dark"><i class="fa fa-trophy text-info"></i> Galeri</li></a>
		<a href="<?php echo base_url('index.php/admin/laman/') ?>"><li class="linkmenu text-dark"><i class="fa fa-users text-info"></i> Laman</li></a>
		<a href="<?php echo base_url('index.php/admin/kategori/') ?>"><li class="linkmenu text-dark"><i class="fa fa-tags text-info"></i> Kategori</li></a>
		<a href="<?php echo base_url('index.php/admin/users/') ?>"><li class="linkmenu text-dark"><i class="fa fa-user-o text-info"></i> User</li></a>
		<a href="<?php echo base_url('index.php/admin/setting/') ?>"><li class="linkmenu text-dark"><i class="fa fa-gear text-info"></i> Setting</li></a>
	<?php else: ?>
		<a href="<?php echo base_url('index.php/admin/dashboard/') ?>"><li class="linkmenu text-dark"><i class="fa fa-desktop text-info"></i> Beranda</li></a>
		<a href="<?php echo base_url('index.php/admin/artikel/') ?>"><li class="linkmenu text-dark"><i class="fa fa-list text-info"></i> Artikel</li></a>
		<a href="<?php echo base_url('index.php/admin/info/') ?>"><li class="linkmenu text-dark"><i class="fa fa-trophy text-info"></i> Info</li></a>
		<a href="<?php echo base_url('index.php/admin/dokumen/') ?>"><li class="linkmenu text-dark"><i class="fa fa-shopping-basket text-info"></i> Dokumen</li>
		</a>
		<a href="<?php echo base_url('index.php/admin/galeri/') ?>"><li class="linkmenu text-dark"><i class="fa fa-trophy text-info"></i> Galeri</li></a>
		<a href="<?php echo base_url('index.php/admin/laman/') ?>"><li class="linkmenu text-dark"><i class="fa fa-users text-info"></i> Laman</li></a>
		<a href="<?php echo base_url('index.php/admin/kategori/') ?>"><li class="linkmenu text-dark"><i class="fa fa-tags text-info"></i> Kategori</li></a>
	<?php endif ?>
	
</ul>