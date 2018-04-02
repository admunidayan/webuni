<div style="margin-top: 14px; background-color: white;padding: 30px">
	<div class="media">
		<div class="media-left">
			<h5 class="text-info">Daftar Artikel</h5><hr/>
		</div>
		<div class="media-body"></div>
		<div class="media-right"><a href="<?php echo base_url('index.php/admin/artikel/create/') ?>" class="btn btn-outline-success"><i class="fa fa-plus-circle"></i> Tambah Artikel</a></div>
	</div>
	<?php if ($this->session->flashdata('message')): ?>
		<div class="alert alert-success alert-dismissible" role="alert" style="margin-top:65px;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
		</div>
	<?php endif ?>
	<?php if ($this->session->flashdata('errors')): ?>
		<div class="alert alert-success alert-dismissible" role="alert" style="margin-top:65px;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('errors');?></strong>
		</div>
	<?php endif ?>
	<form action="<?php echo base_url('index.php/admin/artikel/index') ?>" method="get">
		<input type="text" name="string" class="form-control" placeholder="Cari Artikel" style="width: 100%">
		<small id="nama_kategori" class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
	</form>
	<table class="table" style="font-size: 13px">
		<tr>
			<td>NO</td>
			<td>Judul</td>
			<td>Deskripsi</td>
			<td>Kategori</td>
			<td>Tgl dibuat</td>
			<td>Status</td>
			<td colspan="2"></td>
		</tr>
		<?php $no=$offset+1 ?>
		<?php foreach ($hasil as $data): ?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $data->jdl_artikel; ?></td>
				<td class="text-secondary"><?php echo $data->deskripsi_artikel; ?></td>
				<td class="text-secondary"><?php echo $data->judul_kategori; ?></td>
				<td class="text-secondary"><?php echo $data->tgl_upload; ?></td>
				<td class="text-secondary"><?php echo $data->status_artikel; ?></td>
				<td><a class="text-info" href="<?php echo base_url('index.php/admin/artikel/edit/'.$data->id_artikel) ?>"><i class="fa fa-pencil text-info"></i></a></td>
				<td><a class="text-info" href="<?php echo base_url('index.php/admin/artikel/delete/'.$data->id_artikel) ?>"><i class="fa fa-trash text-danger"></i></a></td>
			</tr>
			<?php $no++ ?>
		<?php endforeach ?>
	</table>
	<div class="row">
		<div class="col">
			<!--Tampilkan pagination-->
			<?php echo $pagination; ?>
		</div>
	</div>
</div>