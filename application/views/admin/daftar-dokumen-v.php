<div style="margin-top: 14px; background-color: white;padding: 30px">
	<div class="media">
		<div class="media-left">
			<h5 class="text-info">Daftar Dokumen</h5><hr/>
		</div>
		<div class="media-body"></div>
		<div class="media-right"><a href="<?php echo base_url('index.php/admin/dokumen/create/') ?>" class="btn btn-outline-success"><i class="fa fa-plus-circle"></i> Tambah dokumen baru</a></div>
	</div>
	<form action="<?php echo base_url('index.php/admin/dokumen/index') ?>" method="get">
		<input type="text" name="string" class="form-control" placeholder="Cari Dokumen" style="width: 100%">
		<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
	</form>
	<table class="table" style="font-size: 13px">
		<tr>
			<td>No</td>
			<td>Nama File</td>
			<td>Alamat file</td>
			<td>type</td>
			<td>Tgl dibuat</td>
			<td>Status</td>
			<td colspan="2"></td>
		</tr>
		<?php $no=$offset+1 ?>
		<?php foreach ($hasil as $data): ?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $data->nama_dokumen; ?></td>
				<td class="text-secondary"><?php echo base_url('asset/dokumen/'.$data->file_dokumen); ?></td>
				<td class="text-secondary"><?php echo $data->type_dokumen; ?></td>
				<td class="text-secondary"><?php echo $data->tgl_upload_dokumen; ?></td>
				<td class="text-secondary"><?php echo $data->status_dokumen; ?></td>
				<td><a class="text-info" href="<?php echo base_url('index.php/admin/dokumen/edit/'.$data->id_dokumen) ?>"><i class="fa fa-pencil text-info"></i></a></td>
				<td><a class="text-info" href="<?php echo base_url('index.php/admin/dokumen/delete/'.$data->id_dokumen) ?>"><i class="fa fa-trash text-danger"></i></a></td>
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