<div style="margin-top: 14px; background-color: white;padding: 30px">
	<h5 class="text-info">Edit Video</h5><hr/>
	<form action="<?php echo base_url('index.php/admin/video/proses_edit') ?>" method="post">
		<input type="hidden" name="id_video" value="<?php echo $hasil->id_video ?>">
		<div class="modal-body">
			<div class="form-group">
				<label>Judul Video</label>
				<input type="text" name="judul_video" class="form-control" placeholder="Masukan Judul Video" value="<?php echo $hasil->judul_video ?>">
				<small class="form-text text-muted">hanya boleh menggunakan gabungan huruf dan angka</small>
			</div>
			<div class="form-group">
				<label>Isi Video</label>
				<textarea class="form-control" id="isi" name="isi_video" rows="3" placeholder="Link frame video disini"><?php echo $hasil->isi_video; ?></textarea>
				<small class="form-text text-muted">Maksimal 114 karakter</small>
			</div>
			<div class="form-group">
				<label>Keterangan / Deskripsi video</label>
				<textarea class="form-control" name="ket_video" rows="3" placeholder="Keterangan/Deskripsi video disini"><?php echo $hasil->ket_video; ?></textarea>
				<small class="form-text text-muted">Maksimal 114 karakter</small>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" name="submit" value="submit" class="btn btn-success">Update Video</button>
		</div>
	</form>
</div>