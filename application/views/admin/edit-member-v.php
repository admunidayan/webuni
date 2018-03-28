<div style="margin-top: 14px; background-color: white;padding: 30px">
	<form action="<?php echo base_url('index.php/admin/member/proses_edit/') ?>" method="post">
		<div class="form-group">
			<label for="nm_member">Nama Lengkap</label>
			<input type="text" class="form-control" name="nm_member" id="nm_member" placeholder="Nama Lengkap Member" value="<?php echo $detail->nm_member ?>" required>
			<small id="nm_member" class="form-text text-muted">Semua jenis karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
		</div>
		<div class="form-group">
			<label>Kode Member</label>
			<input type="hidden" name="id_member" value="<?php echo $detail->id_member ?>">
			<div class="form-control border border-success"><?php echo $detail->kode_member; ?></div>
			<small class="form-text text-muted text-success">Tidak dapat di edit.</small>
		</div>
		<div class="form-group">
			<label for="nik_member">NIK (Nomor Induk Kependudukan) / No KTP</label>
			<input type="text" class="form-control" name="nik_member" id="nik_member" placeholder="Nomor Identitas Member" value="<?php echo $detail->nik_member ?>">
			<small id="nik_member" class="form-text text-muted">Hanya Boleh diisi dengan angka</small>
		</div>
		<div class="row">
			<div class="col">
				<div class="form-group">
					<label for="tmpt_lahir_member">Tempat Lahir</label>
					<input type="text" class="form-control" name="tmpt_lahir_member" id="tmpt_lahir_member" value="<?php echo $detail->tmpt_lahir_member ?>" placeholder="Tempat Kelahiran" required>
					<small id="tmpt_lahir_member" class="form-text text-muted">Semua jenis karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<label for="tgl_lahir_member">Tanggal Lahir</label>
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" name="tgl_lahir_member_hr" value="<?php echo substr($detail->tgl_lahir_member,8,2);?>" placeholder="HH">
						</div>
						<div class="col">
							<input type="text" class="form-control" name="tgl_lahir_member_bln" value="<?php echo substr($detail->tgl_lahir_member,5,2);?>" placeholder="BB">
						</div>
						<div class="col">
							<input type="text" class="form-control" name="tgl_lahir_member_thn" value="<?php echo substr($detail->tgl_lahir_member,0,4);?>" placeholder="TTTT">
						</div>
					</div>
					<small id="tgl_lahir" class="form-text text-muted">Hanya Boleh diisi dengan angka, untuk tanggal 24 Desember 1993 di tulis 24 12 1993</small>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="hp_member">NOMOR HP</label>
			<input type="text" class="form-control" name="hp_member" id="hp_member" value="<?php echo $detail->hp_member ?>" placeholder="nomor hp nomor yang dapat di hubungi" required>
			<small id="hp_member" class="form-text text-muted">hanya dapat menggunakan angka</small>
		</div>
		<div class="form-group">
			<label for="alamat_member">Alamat</label>
			<textarea name="alamat_member" class="form-control" placeholder="Alamat Saat Ini"><?php echo $detail->alamat_member; ?></textarea>
			<small id="alamat_member" class="form-text text-muted">Masukan Alamat domisili saat ini</small>
		</div>
		<button type="submit" class="btn btn-success">Simpan</button>
	</form>
</div>