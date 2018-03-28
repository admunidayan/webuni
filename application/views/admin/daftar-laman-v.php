<div style="margin-top: 14px; background-color: white;padding: 30px">
	<div class="media">
		<div class="media-left">
			<h5 class="text-info">Laman</h5><hr/>
		</div>
		<div class="media-body"></div>
		<div class="media-right"><a href="<?php echo base_url('index.php/admin/laman/create') ?>" class="btn btn-outline-success"><i class="fa fa-plus-circle"></i> Tambah Laman</a></div>
	</div>
	<?php if ($this->session->flashdata('message')): ?>
		<div class="alert alert-success alert-dismissible" role="alert" style="margin-top:65px;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
		</div>
	<?php endif ?>
	<form action="<?php echo base_url('index.php/admin/laman/index') ?>" method="get">
		<input type="text" name="string" class="form-control" placeholder="Cari laman" style="width: 100%">
		<small id="nama_kategori" class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
	</form>
	<table class="table" style="vertical-align: middle">
		<thead>
			<tr>
				<td class="text-center ">No</td>
				<td class="">Nama Laman</td>
				<td class="">Deskripsi</td>
				<td class="">User</td>
				<td class="">Status</td>
				<td colspan="2" class="text-center ">Action</td>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($hasil)): ?>
				<?php $no=$nomor+1 ?>
				<?php foreach ($hasil as $data): ?>
					<tr>
						<td class="text-center"><?php echo $no; ?></td>
						<td><?php echo $data->judul_laman; ?></td>
						<td class="text-secondary">
							<?php $string =$data->deskripsi_laman; $string = character_limiter($string, 50) ; ?>
							<?php echo $string; ?>

						</td>
						<td class="text-secondary"><?php echo $this->ion_auth->user($data->id_user)->row()->username; ?></td>
						<td class="text-center">
							<?php if ($data->status_laman=='publish'): ?>
								<i class="fa fa-globe"></i>
							<?php else: ?>
								<i class="fa fa-exclamation-circle"></i>
							<?php endif ?>
						</td>
						<td class="text-center">
							<a href="<?php echo base_url('index.php/admin/laman/edit/'.$data->alias_laman); ?>">edit</a>
						</td>
						<td class="text-center">
							<a href="<?php echo base_url('index.php/admin/laman/delete/'.$data->alias_laman); ?>">delete</a>
						</td>
					</tr>
					<?php $no++ ?>
				<?php endforeach ?>
			<?php else: ?>
				<tr>
					<td colspan="7"><i>Tidak ada data ditemukan</i></td>
				</tr>
			<?php endif ?>
		</tbody>
	</table>
	<div class="row">
		<div class="col">
			<!--Tampilkan pagination-->
			<?php echo $pagination; ?>
		</div>
	</div>
</div>