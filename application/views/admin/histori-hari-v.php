<div class="row">
	<div class="col">
		<div style="margin-top: 14px; background-color: white;padding: 30px">
			<h5 class="text-info">Daftar Nota di tanggal <?php echo $tanggal; ?></h5>
			<table class="table table-sm" style="font-size: 13px">
				<tr>
					<td class="text-secondary">No</td>
					<td class="text-secondary">Nota</td>
					<td class="text-secondary">Kasir</td>
					<td class="text-secondary">Total</td>
					<td class="text-secondary"></td>
				</tr>
				<?php $harga_nota = 0 ?>
				<?php $no = 1 ?>
				<?php foreach ($hasil as $data): ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data->id_nota; ?></td>
						<td><?php echo $data->username ?></td>
						<td><?php echo 'Rp.'.number_format($data->total_bayar_nota,0,',','.') ?></td>
						<td><a href="<?php echo base_url('index.php/admin/histori/nota/'.$data->id_nota) ?>">Detail</a></td>
					</tr>
					<?php $harga_nota = $data->total_bayar_nota + (int)@$harga_nota; ?>
					<?php $no++ ?>
				<?php endforeach ?>
				<tr>
					<td colspan="3"><b>Total</b></td>
					<td colspan="2"><b><?php echo 'Rp.'.number_format($harga_nota,0,',','.'); ?></b></td>
				</tr>
			</table>
		</div>
		<div style="margin-top: 14px; background-color: white;padding: 30px">
			<h5 class="text-info">Daftar Pemasukan</h5>
			<table class="table table-sm" style="font-size: 13px">
				<tr>
					<td class="text-secondary">No</td>
					<td class="text-secondary">Keterangan</td>
					<td class="text-secondary">Total</td>
				</tr>
				<?php if ($umasuk == TRUE): ?>
					<?php $harga_masuk = 0 ?>
					<?php $no = 1 ?>
					<?php foreach ($umasuk as $data): ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data->keterangan; ?></td>
							<td><?php echo 'Rp.'.number_format($data->jumlah,0,',','.') ?></td>
						</tr>
						<?php $harga_masuk = $data->jumlah + (int)@$harga_masuk; ?>
						<?php $no++ ?>
					<?php endforeach ?>
					<tr>
						<td colspan="2"><b>Total</b></td>
						<td><b><?php echo 'Rp.'.number_format($harga_masuk,0,',','.'); ?></b></td>
					</tr>
				<?php else: ?>
					<tr>
						<td colspan="3" class="text-center">Tidak ada uang masuk</td>
					</tr>
				<?php endif ?>
				<tr>
					<td colspan="3" class="text-center">
						<button class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#masuk" style="width: 100%">Tambah uang masuk</button>
					</td>
				</tr>
			</table>
		</div>
		<div style="margin-top: 14px; background-color: white;padding: 30px">
			<h5 class="text-info">Daftar Pengeluaran</h5>
			<table class="table table-sm" style="font-size: 13px">
				<tr>
					<td class="text-secondary">No</td>
					<td class="text-secondary">Keterangan</td>
					<td class="text-secondary">Total</td>
				</tr>
				<?php if ($ukeluar == TRUE): ?>
					<?php $harga_keluar = 0 ?>
					<?php $no = 1 ?>
					<?php foreach ($ukeluar as $data): ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data->keterangan; ?></td>
							<td><?php echo 'Rp.'.number_format($data->jumlah,0,',','.') ?></td>
						</tr>
						<?php $harga_keluar = $data->jumlah + (int)@$harga_keluar; ?>
						<?php $no++ ?>
					<?php endforeach ?>
					<tr>
						<td colspan="2"><b>Total</b></td>
						<td><b><?php echo 'Rp.'.number_format($harga_keluar,0,',','.'); ?></b></td>
					</tr>
				<?php else: ?>
					<tr>
						<td colspan="3" class="text-center">Tidak ada uang keluar</td>
					</tr>
				<?php endif ?>
				<tr>
					<td colspan="3" class="text-center">
						<button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#keluar" style="width: 100%">Tambah uang keluar</button>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="col">
		<div style="margin-top: 14px; background-color: white;padding: 30px">
			<h5 class="text-info">Jumlah Barang Terjual</h5>
			<table class="table table-sm" style="font-size: 13px">
				<tr>
					<td class="text-secondary text-center">No</td>
					<td class="text-secondary">Nama Barang</td>
					<td class="text-secondary text-center">Jml</td>
				</tr>
				<?php $no = 1 ?>
				<?php foreach ($brglaku as $barang): ?>
					<tr>
						<td class="text-center"><?php echo $no; ?></td>
						<td><?php echo strtoupper($barang->nama_menu); ?></td>
						<td class="text-center"><?php echo $barang->jml_laku; ?></td>
					</tr>
					<?php $no++ ?>
				<?php endforeach ?>
			</table>
		</div>
		<div style="margin-top: 14px; background-color: white;padding: 30px">
			<h5 class="text-info">Total Penghasilan</h5>
			<table class="table" style="font-size: 13px">
				<tr>
					<td class="text-secondary">No</td>
					<td class="text-secondary">Asal</td>
					<td class="text-secondary">Jumlah</td>
				</tr>
				<tr>
					<td>1</td>
					<td>Uang Nota</td>
					<td><?php echo 'Rp.'.number_format(@$harga_nota,0,',','.'); ?></td>
				</tr>
				<tr>
					<td>2</td>
					<td>Uang Masuk</td>
					<td><?php echo 'Rp.'.number_format(@$harga_masuk,0,',','.'); ?></td>
				</tr>
				<tr>
					<td>3</td>
					<td>Uang Keluar</td>
					<td><?php echo 'Rp.'.number_format(@$harga_keluar,0,',','.'); ?></td>
				</tr>
				<tr>
					<td colspan="2"><b>Total</b></td>
					<td>
						<?php $totalhasil=@$harga_nota+@$harga_masuk-@$harga_keluar ?>
						<b><?php echo 'Rp.'.number_format($totalhasil,0,',','.'); ?></b>
					</td>
				</tr>
				<tr>
					<td colspan="3" class="text-center">
						<a href="<?php echo base_url('index.php/admin/histori/cetak_hasil/'.$tanggal) ?>" target="_blank" class="btn btn-outline-info btn-sm" style="width: 100%">Cetak hasil</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="keluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center" id="bayar">Tambah Uang Keluar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('index.php/admin/histori/create_uang_keluar/'.$tanggal) ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label>Nama Pengeluaran</label>
						<input type="text" class="form-control" name="keterangan" placeholder="Masukan Nama Pengeluaran">
						<small class="form-text text-muted">Hanya dapat menggunakan gabungan angka, huruf dan spasi</small>
					</div>
					<div class="form-group">
						<label>Jumlah Pengeluaran</label>
						<input type="text" class="form-control" name="jumlah" placeholder="Masukan Rupiah">
						<small class="form-text text-muted">Gunakan angka, tanpa menggunakan titik (.) misal 100000 untuk 100.000</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="submit" value="submit" class="btn btn-success">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="masuk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center">Tambah Uang Masuk</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('index.php/admin/histori/create_uang_masuk/'.$tanggal) ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label>Nama Pemasukan</label>
						<input type="text" class="form-control" name="keterangan" placeholder="Masukan Nama Pemasukan">
						<small class="form-text text-muted">Hanya dapat menggunakan gabungan angka, huruf dan spasi</small>
					</div>
					<div class="form-group">
						<label>Jumlah Pemasukan</label>
						<input type="text" class="form-control" name="jumlah" placeholder="Masukan Rupiah">
						<small class="form-text text-muted">Gunakan angka, tanpa menggunakan titik (.) misal 100000 untuk 100.000</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="submit" value="submit" class="btn btn-success">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
