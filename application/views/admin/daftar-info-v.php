<script src='<?php echo base_url('asset/js/tinymce/tinymce.min.js'); ?>'></script>
<script type="text/javascript">
	tinymce.init({
		selector: '#isi',
		plugins: 'code media link',
		menubar: false,
		toolbar: [
		'undo redo | bold italic underline spellchecker | alignleft aligncenter alignright alignjustify | strikethrough cut copy paste pastetext link code',
		],
	});
</script>
<div style="margin-top: 14px; background-color: white;padding: 30px">
	<div class="media">
		<div class="media-left">
			<h5 class="text-info">Daftar Info Kampus</h5><hr/>
		</div>
		<div class="media-body"></div>
		<div class="media-right"><button class="btn btn-outline-success" data-toggle="modal" data-target="#add"><i class="fa fa-plus-circle"></i> Tambah Info Kampus</button></div>
	</div>
	<form action="<?php echo base_url('index.php/admin/info/index') ?>" method="get">
		<input type="text" name="string" class="form-control" placeholder="Cari Info kampus" style="width: 100%">
		<small id="nama_kategori" class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
	</form>
	<table class="table" style="font-size: 13px">
		<tr>
			<td>NO</td>
			<td>Judul Info</td>
			<td>Deskripsi</td>
			<td>Tgl dibuat</td>
			<td>Status</td>
			<td colspan="2"></td>
		</tr>
		<?php $no=$offset+1 ?>
		<?php foreach ($hasil as $data): ?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $data->judul_info_kampus; ?></td>
				<td class="text-secondary"><?php echo $data->judul_info_kampus; ?></td>
				<td class="text-secondary"><?php echo $data->tgl_info_kampus; ?></td>
				<td class="text-secondary"><?php echo $data->status_info_kampus; ?></td>
				<td><a class="text-info" href="<?php echo base_url('index.php/admin/info/edit/'.$data->id_info_kampus) ?>"><i class="fa fa-pencil text-info"></i></a></td>
				<td><a class="text-info" href="<?php echo base_url('index.php/admin/info/delete/'.$data->id_info_kampus) ?>"><i class="fa fa-trash text-danger"></i></a></td>
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
<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Info Kampus</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('index.php/admin/info/proses_create') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label>Judul Info kampus</label>
						<input type="text" name="judul_info_kampus" class="form-control" placeholder="Masukan Judul info kampus">
						<small class="form-text text-muted">hanya boleh menggunakan gabungan huruf dan angka</small>
					</div>
					<div class="form-group">
						<label>Isi Info Kampus</label>
						<textarea class="form-control" id="isi" name="isi_info_kampus" rows="20" placeholder="Isi info kampus disini"></textarea>
						<small class="form-text text-muted">Maksimal 114 karakter</small>
					</div>
					<div class="form-group">
						<label>Status</label>
						<select class="form-control" name="status_info_kampus">
							<option value="publish">Publish</option>
							<option value="draft">Draft</option>
						</select>
						<small class="form-text text-muted">pilih salah satu item diatas</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="submit" value="submit" class="btn btn-success">Simpan Info</button>
				</div>
			</form>
		</div>
	</div>
</div>