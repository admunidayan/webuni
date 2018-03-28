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
	<h5 class="text-info">Edit Info Kampus</h5><hr/>
	<form action="<?php echo base_url('index.php/admin/info/proses_create') ?>" method="post">
		<input type="hidden" name="id_info_kampus" value="<?php echo $hasil->id_info_kampus ?>">
		<div class="modal-body">
			<div class="form-group">
				<label>Judul Info kampus</label>
				<input type="text" name="judul_info_kampus" class="form-control" placeholder="Masukan Judul info kampus" value="<?php echo $hasil->judul_info_kampus ?>">
				<small class="form-text text-muted">hanya boleh menggunakan gabungan huruf dan angka</small>
			</div>
			<div class="form-group">
				<label>Isi Info Kampus</label>
				<textarea class="form-control" id="isi" name="isi_info_kampus" rows="10" placeholder="Isi info kampus disini"><?php echo $hasil->isi_info_kampus; ?></textarea>
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