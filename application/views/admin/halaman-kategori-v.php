<div style="margin-top: 14px; background-color: white;padding: 30px">
	<div class="media">
		<div class="media-left">
			<h5 class="text-info">Kategori</h5><hr/>
		</div>
		<div class="media-body"></div>
		<div class="media-right"><button class="btn btn-outline-success" data-toggle="modal" data-target="#addkategori"><i class="fa fa-plus-circle"></i> Tambah Kategori</button></div>
	</div>
	<table class="table">
		<tr class="bg-info text-light">
			<td class="text-center">No</td>
			<td>Nama Kategori</td>
			<td>Kode</td>
			<td colspan="2" class="text-center">Action</td>
		</tr>
		<?php $no = 1 ?>
		<?php foreach ($hasil as $data): ?>
			<tr>
				<td class="text-center"><?php echo $no; ?></td>
				<td><?php echo $data->nama_kategori; ?></td>
				<td><?php echo $data->kode_kategori; ?></td>
				<td class="text-center"><a class="text-info" href="<?php echo base_url('index.php/admin/kategori/edit/'.$data->id_kategori) ?>"><i class="fa fa-pencil"></i> edit</a></td>
				<td class="text-center"><a class="text-danger" href="<?php echo base_url('index.php/admin/kategori/delete/'.$data->id_kategori) ?>"><i class="fa fa-trash"></i> hapus</a></td>
			</tr>
			<?php $no++ ?>
		<?php endforeach ?>
	</table>
</div>
<!-- Modal -->
<div class="modal fade" id="addkategori" tabindex="-1" role="dialog" aria-labelledby="addkategori" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addkategori">Tambah kategori</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('index.php/admin/kategori/create') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_kategori">Nama kategori</label>
						<input type="text" class="form-control" name="nama_kategori" id="nama_kategori" placeholder="Nama kategori">
						<small id="nama_kategori" class="form-text text-muted">Semua jenis karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
					</div>
					<div class="form-group">
						<label for="kode_kategori">Kode Kategori</label>
						<input type="text" class="form-control" name="kode_kategori" id="kode_kategori" placeholder="Kode kategori">
						<small id="kode_kategori" class="form-text text-muted">Hanya dapat menggunakan gabungan angka dan huruf</small>
					</div>
					<div class="form-group">
						<label for="ket_kategori">Keterangan kategori</label>
						<textarea class="form-control" name="ket_kategori" placeholder="Masukan Keterangan"></textarea>
						<small id="ket_kategori" class="form-text text-muted">Deskripsi kategori, maksimal 144 karakter.</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>