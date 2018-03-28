<div style="margin-top: 14px; background-color: white;padding: 30px">
	<form action="<?php echo base_url('index.php/admin/kategori/update/'.$hasil->id_kategori) ?>" method="post">
		<div class="form-group">
			<label for="nama_kategori">Nama kategori</label>
			<input type="text" class="form-control" name="nama_kategori" id="nama_kategori" placeholder="Nama kategori" value="<?php echo $hasil->judul_kategori ?>">
			<small id="nama_kategori" class="form-text text-muted">Semua jenis karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
		</div>
		<div class="form-group">
			<label for="ket_kategori">Keterangan kategori</label>
			<textarea class="form-control" name="isi_kategori" placeholder="Masukan Keterangan"><?php echo $hasil->isi_kategori; ?></textarea>
			<small id="ket_kategori" class="form-text text-muted">Deskripsi kategori, maksimal 144 karakter.</small>
		</div>
		<button type="submit" class="btn btn-success">Simpan</button>
	</form>
</div>