<div style="margin-top: 14px; background-color: white;padding: 30px">
	<div class="media">
		<div class="media-left">
			<h5 class="text-info">Daftar Video</h5><hr/>
		</div>
		<div class="media-body"></div>
		<div class="media-right"><button class="btn btn-outline-success" data-toggle="modal" data-target="#add"><i class="fa fa-plus-circle"></i> Tambah video</button></div>
	</div>
	<form action="<?php echo base_url('index.php/admin/info/index') ?>" method="get">
		<input type="text" name="string" class="form-control" placeholder="Cari video" style="width: 100%">
		<small id="nama_kategori" class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
	</form>
	<table class="table" style="font-size: 13px">
		<tr>
			<td>NO</td>
			<td>Judul Video</td>
			<td>Keterangan Video</td>
			<td>Tgl dibuat</td>
			<td colspan="2"></td>
		</tr>
		<?php if (!empty($hasil)): ?>
			<?php $no=$offset+1 ?>
			<?php foreach ($hasil as $data): ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td class="text-secondary"><?php echo $data->judul_video; ?></td>
					<td class="text-secondary"><?php echo $data->ket_video; ?></td>
					<td class="text-secondary"><?php echo $data->tgl_buat; ?></td>
					<td><a class="text-info" href="<?php echo base_url('index.php/admin/video/edit/'.$data->id_video) ?>"><i class="fa fa-pencil text-info"></i></a></td>
					<td><a class="text-info" href="<?php echo base_url('index.php/admin/video/delete/'.$data->id_video) ?>"><i class="fa fa-trash text-danger"></i></a></td>
				</tr>
				<?php $no++ ?>
			<?php endforeach ?>
			<?php else: ?>
				<tr>
					<td colspan="6" class="text-center">Tidak ada video</td>
				</tr>
		<?php endif ?>
	</table>
	<div class="row">
		<div class="col">
			<!--Tampilkan pagination-->
			<?php echo $pagination; ?>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah video</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('index.php/admin/video/proses_create') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label>Judul video</label>
						<input type="text" name="judul_video" class="form-control" placeholder="Masukan Judul video">
						<small class="form-text text-muted">hanya boleh menggunakan gabungan huruf dan angka</small>
					</div>
					<div class="form-group">
						<label>Isi video</label>
						<textarea class="form-control" id="isi" name="isi_video" rows="3" placeholder="Link frame video disini"></textarea>
						<small class="form-text text-muted">Maksimal 114 karakter</small>
					</div>
					<div class="form-group">
						<label>Keterangan/Deskripsi video</label>
						<textarea class="form-control" name="ket_video" rows="3" placeholder="Keterangan/Deskripsi video disini"></textarea>
						<small class="form-text text-muted">Maksimal 114 karakter</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="submit" value="submit" class="btn btn-success">Simpan Video</button>
				</div>
			</form>
		</div>
	</div>
</div>