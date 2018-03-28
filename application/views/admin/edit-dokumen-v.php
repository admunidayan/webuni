<div style="margin-top: 14px; background-color: white;padding: 30px">
	<h5 class="text-info">Tambah Dokumen Baru</h5><hr/>
	<form action="<?php echo base_url('index.php/admin/dokumen/proses_edit') ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id_dokumen" value="<?php echo $hasil->id_dokumen ?>">
		<div class="modal-body">
			<div class="form-group">
				<label>Judul dokumen</label>
				<input type="text" name="nama_dokumen" class="form-control" placeholder="Masukan nama dokumen" value="<?php echo $hasil->nama_dokumen ?>">
				<small class="form-text text-muted">hanya boleh menggunakan gabungan huruf dan angka</small>
			</div>
			<div class="form-group">
				<label>Masukan File dokumen</label><br/>
				File Saat ini : <span class="text-primary"><?php echo $hasil->file_dokumen; ?></span>
				<input type="file" name="file_dokumen" class="form-control">
				<small class="form-text text-muted">Hanya boleh file bertype <span class="text-success">pdf, doc, xls, xlsx, ppt, pptx, docx.</span> Serta ukuran file maksimal <span class="text-success">2 MB</span></small>
			</div>
			<div class="form-group">
				<label>Status</label>
				<select class="form-control" name="status_dokumen">
					<option value="publish">-- <?php echo $hasil->status_dokumen; ?> --</option>
					<option value="publish">Publish</option>
					<option value="draft">Draft</option>
				</select>
				<small class="form-text text-muted">pilih salah satu item diatas</small>
			</div>
			<div class="form-group">
				<label>Keterangan</label>
				<textarea name="ket_dokumen" placeholder="Masukan keterangan" class="form-control"><?php echo $hasil->ket_dokumen; ?></textarea>
				<small class="form-text text-muted">hanya boleh menggunakan gabungan huruf dan angka</small>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" name="submit" value="submit" class="btn btn-success">Simpan dokumen</button>
		</div>
	</form>
</div>