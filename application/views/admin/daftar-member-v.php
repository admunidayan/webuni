<div style="margin-top: 14px; background-color: white;padding: 30px">
	<div class="media">
		<div class="media-left">
			<h5 class="text-info">Daftar Member</h5><hr/>
		</div>
		<div class="media-body"></div>
		<div class="media-right"><button class="btn btn-outline-success" data-toggle="modal" data-target="#addobat"><i class="fa fa-plus-circle"></i> Tambah Member</button></div>
	</div>
	<form action="<?php echo base_url('index.php/admin/member/index') ?>" method="get">
		<input type="text" name="string" class="form-control" placeholder="masukan Nama atau kode member" style="width: 100%">
		<small id="nama_kategori" class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
	</form>
	<table class="table" style="font-size: 13px">
		<tr>
			<td>NO</td>
			<td>KODE</td>
			<td>NAMA</td>
			<td>NIK</td>
			<td>TMPT LAHIR</td>
			<td>TGL LAHIR</td>
			<td>TGL CREATE</td>
			<td colspan="2">ACTION</td>
		</tr>
		<?php $no=$offset+1 ?>
		<?php foreach ($hasil as $data): ?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $data->kode_member; ?></td>
				<td><?php echo $data->nm_member; ?></td>
				<td><?php echo $data->nik_member; ?></td>
				<td><?php echo $data->tmpt_lahir_member; ?></td>
				<td><?php echo $data->tgl_lahir_member; ?></td>
				<td><?php echo $data->tgl_create; ?></td>
				<td><a class="text-info" href="<?php echo base_url('index.php/admin/member/edit/'.$data->id_member) ?>"><i class="fa fa-pencil text-info"></i></a></td>
				<td><a class="text-info" href="<?php echo base_url('index.php/admin/member/delete/'.$data->id_member) ?>"><i class="fa fa-trash text-danger"></i></a></td>
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
<div class="modal fade" id="addobat" tabindex="-1" role="dialog" aria-labelledby="addobat" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addobat">Tambah Member</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('index.php/admin/member/proses_create') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="nm_member">Nama Lengkap</label>
						<input type="text" class="form-control" name="nm_member" id="nm_member" placeholder="Nama Lengkap Member" required>
						<small id="nm_member" class="form-text text-muted">Semua jenis karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
					</div>
					<div class="form-group">
						<label for="nik_member">NIK (Nomor Induk Kependudukan) / No KTP</label>
						<input type="text" class="form-control" name="nik_member" id="nik_member" placeholder="Nomor Identitas Member">
						<small id="nik_member" class="form-text text-muted">Hanya Boleh diisi dengan angka</small>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="tmpt_lahir_member">Tempat Lahir</label>
								<input type="text" class="form-control" name="tmpt_lahir_member" id="tmpt_lahir_member" placeholder="Tempat Kelahiran" required>
								<small id="tmpt_lahir_member" class="form-text text-muted">Semua jenis karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="tgl_lahir_member">Tanggal Lahir</label>
								<div class="row">
									<div class="col">
										<input type="text" class="form-control" name="tgl_lahir_member_hr" placeholder="HH">
									</div>
									<div class="col">
										<input type="text" class="form-control" name="tgl_lahir_member_bln" placeholder="BB">
									</div>
									<div class="col">
										<input type="text" class="form-control" name="tgl_lahir_member_thn" placeholder="TTTT">
									</div>
								</div>
								<small id="tgl_lahir" class="form-text text-muted">Hanya Boleh diisi dengan angka, untuk tanggal 24 Desember 1993 di tulis 24 12 1993</small>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="hp_member">NOMOR HP</label>
						<input type="text" class="form-control" name="hp_member" id="hp_member" placeholder="nomor hp nomor yang dapat di hubungi" required>
						<small id="hp_member" class="form-text text-muted">hanya dapat menggunakan angka</small>
					</div>
					<div class="form-group">
						<label for="alamat_member">Alamat</label>
						<textarea name="alamat_member" class="form-control" placeholder="Alamat Saat Ini"></textarea>
						<small id="alamat_member" class="form-text text-muted">Masukan Alamat domisili saat ini</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>