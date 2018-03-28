<div style="margin-top: 14px; background-color: white;padding: 30px">
	<form action="<?php echo base_url('index.php/admin/obat/update/'.$hasil->id_menu) ?>" method="post">
		<div class="form-group">
			<label for="nama_menu">Nama Obat</label>
			<input type="text" class="form-control" name="nama_menu" id="nama_menu" placeholder="Nama Obat" value="<?php echo $hasil->nama_menu ?>">
			<small id="nama_menu" class="form-text text-muted">Semua jenis karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
		</div>
		<div class="form-group">
			<label for="kode_menu">Kode Obat</label>
			<input type="text" class="form-control" name="kode_menu" id="nama_menu" placeholder="Kode Menu" value="<?php echo $hasil->kode_menu ?>">
			<small id="kode_menu" class="form-text text-muted">Hanya dapat menggunakan gabungan angka dan huruf</small>
		</div>
		<div class="form-group">
			<label for="id_kategori">Kategori Obat</label>
			<div>
				<select class="custom-select" name="id_kategori" id="id_kategori" style="width: 100%">
					<option value="<?php echo $hasil->id_kategori ?>">-- <?php echo $hasil->nama_kategori; ?> --</option>
					<?php foreach ($kategori as $data): ?>
						<option value="<?php echo $data->id_kategori ?>"><?php echo $data->nama_kategori; ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<small id="id_kategori" class="form-text text-muted">Pilih salah satu kategori obat</small>
		</div>
		<div class="form-group">
			<label for="stok">Jumlah Stok</label>
			<input type="text" class="form-control" name="stok" id="stok" placeholder="Jumlah stok tersedia" value="<?php echo $hasil->stok ?>">
			<small id="stok" class="form-text text-muted">Isikan dengan anka, tidak boleh dengan huruf</small>
		</div>
		<div class="row">
			<div class="col">
				<div class="form-group">
					<label for="harga_satuan">Harga Satuan (Reguler)</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Rp.</span>
						</div>
						<input type="text" class="form-control" name="harga_satuan" id="harga_satuan" placeholder="Masukan Jumlah Rupiah, Misal 5000" value="<?php echo $hasil->harga_satuan ?>">
					</div>
					<small id="harga_satuan" class="form-text text-muted">Penulisan ditulis dengan angka tanpa titik Misal Rp.50.000 di tulis "50000"</small>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<label for="harga_satuan">Harga Member</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Rp.</span>
						</div>
						<input type="text" class="form-control" name="harga_member" id="harga_member" placeholder="Masukan Jumlah Rupiah, Misal 5000" value="<?php echo $hasil->harga_member ?>">
					</div>
					<small id="harga_member" class="form-text text-muted">Penulisan ditulis dengan angka tanpa titik Misal Rp.50.000 di tulis "50000"</small>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="diskon">Diskon</label>
			<input type="text" class="form-control" name="diskon" id="diskon" placeholder="Jumlah stok tersedia" value="<?php echo $hasil->diskon ?>">
			<small id="diskon" class="form-text text-muted">Isikan dengan anka 1-100 digunakan untuk persenan, ditulis tanpa menggunakan %, cukup angka saja</small>
		</div>
		<div class="form-group">
			<label for="ket_menu">Keterangan Obat</label>
			<textarea class="form-control" name="ket_menu" placeholder="Masukan Keterangan"><?php echo $hasil->ket_menu; ?></textarea>
			<small id="ket_menu" class="form-text text-muted">Deskripsi obat, maksimal 144 karakter.</small>
		</div>
		<button type="submit" class="btn btn-success">Simpan</button>
	</form>
</div>