<div class="row">
	<div class="col-md-6">
		<div style="margin-top: 14px; background-color: white;padding: 30px">
			<h5 class="text-info">Daftar Barang</h5><hr/>
			<form action="<?php echo base_url('index.php/admin/pembelian/nota/'.$detnota->id_nota) ?>" method="post">
				<div class="row">
					<div class="col">
						<input type="text" name="string" class="form-control" placeholder="masukan Nama barang atau kode barang" style="width: 100%">
					</div>
					<div class="col">
						<select name="kategori" class="custom-select" onchange="this.form.submit()">
							<option value="">-- Pilih Kategori --</option>
							<option value="">Semua Kategori</option>
							<?php foreach ($katgor as $data): ?>
								<option value="<?php echo $data->id_kategori ?>"><?php echo $data->nama_kategori; ?></option>
							<?php endforeach ?>
						</select>	
					</div>
				</div>
				<small id="nama_kategori" class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
			</form>
			<table class="table table-sm bts-ats" style="font-size: 12px;">
				<tr>
					<td class="text-secondary">NO</td>
					<td class="text-secondary">NAMA</td>
					<td class="text-secondary">HARGA</td>
					<td class="text-secondary">STOK</td>
					<td class="text-secondary"></td>
				</tr>
				<?php $no=$offset+1 ?>
				<?php foreach ($menu as $data): ?>
					<form action="<?php echo base_url('index.php/admin/pembelian/input_menu/'.$detnota->tgl_nota.'/'.$detnota->id_nota) ?>" method="post">
						<tr>
							<td><input type="hidden" name="id_nota" value="<?php echo $detnota->id_nota ?>"><?php echo $no; ?></td>
							<td>
								<input type="hidden" name="id_menu" value="<?php echo $data->id_menu ?>"><?php echo strtoupper($data->nama_menu); ?>
								<?php if ($data->diskon !== '0'): ?>
									<span style="color: green">- dskn <?php echo $data->diskon.' %'; ?></span>
								<?php endif ?>
							</td>
							<td>
								<?php if ($detnota->id_member == '0'): ?>
									<?php echo 'Rp.'.number_format($data->harga_satuan,0,',','.'); ?>
								<?php else: ?>
									<?php echo 'Rp.'.number_format($data->harga_member,0,',','.'); ?>
								<?php endif ?>
							</td>
							<td><?php echo $data->stok; ?></td>
							<?php if ($detnota->id_status == '1'): ?>
								<td><button type="submit" name="submit" value="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-shopping-basket"></i></button></td>
							<?php else: ?>
								<td><div class="btn btn-outline-secondary btn-sm"><i class="fa fa-shopping-basket"></i></div></td>
							<?php endif ?>
						</tr>
					</form>
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
	</div>
	<div class="col-md-6">
		<?php if ($beli==TRUE): ?>
			<div style="margin-top: 14px; background-color: white;padding: 30px">
				<h5 class="text-info">Member</h5><hr/>
				<?php if ($this->session->flashdata('error2')): ?>
					<div class="alert alert-danger">
						<?php echo $this->session->flashdata('error2');?>
					</div>
				<?php endif ?>
				<?php if ($this->session->flashdata('message2')): ?>
					<div class="alert alert-info">
						<?php echo $this->session->flashdata('message2');?>
					</div>
				<?php endif ?>
				<?php if ($detnota->id_member == 0): ?>
					<form action="<?php echo base_url('index.php/admin/pembelian/insert_member_to_nota/'.$detnota->id_nota) ?>" method="post">
						<div class="form-group">
							<input type="text" class="form-control" id="idmember" name="idmember" aria-describedby="idmember" placeholder="Masukan Id Member">
							<small id="idmember" class="form-text text-muted">jika kode benar, sistem akan otomatis merubah nota menjadi nota member</small>
						</div>
					</form>
				<?php else: ?>
					<?php $member = $this->Admin_m->detail_data_order('member','id_member',$detnota->id_member); ?>
					<table style="font-size: 13px;">
						<tr>
							<td class="kirikanan">NAMA</td>
							<td class="kirikanan">:</td>
							<td class="kirikanan"><?php echo $member->nm_member; ?></td>
						</tr>
						<tr>
							<td class="kirikanan">ID Member</td>
							<td class="kirikanan">:</td>
							<td class="kirikanan"><?php echo $member->kode_member; ?></td>
						</tr>
					</table>
					<?php if ($detnota->id_status == '1'): ?>
						<a href="<?php echo base_url('index.php/admin/pembelian/delete_member_nota/'.$detnota->id_nota) ?>" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i> Hapus/ubah member</a>
					<?php endif ?>
				<?php endif ?>
			</div>
		<?php endif ?>
		<div style="margin-top: 14px; background-color: white;padding: 30px">
			<h5 class="text-info">Detail Pemesanan</h5><hr/>
			<table style="font-size: 13px;">
				<tr>
					<td class="kirikanan">Tanggal</td>
					<td class="kirikanan">:</td>
					<td class="kirikanan"><?php echo $detnota->tgl_nota; ?></td>
				</tr>
				<tr>
					<td class="kirikanan">Waktu</td>
					<td class="kirikanan">:</td>
					<td class="kirikanan"><?php echo $detnota->jam_nota; ?></td>
				</tr>
				<tr>
					<td class="kirikanan">No Nota</td>
					<td class="kirikanan">:</td>
					<td class="kirikanan"><?php echo $detnota->id_nota; ?></td>
				</tr>
				<tr>
					<td class="kirikanan">Kasir</td>
					<td class="kirikanan">:</td>
					<td class="kirikanan"><?php echo $detnota->username; ?></td>
				</tr>
				<tr>
					<td class="kirikanan">Status</td>
					<td class="kirikanan">:</td>
					<td class="kirikanan"><?php echo $detnota->nm_status; ?></td>
				</tr>
				<tr>
					<td class="kirikanan">Member</td>
					<td class="kirikanan">:</td>
					<td class="kirikanan">
						<?php if ($detnota->id_member == 0): ?>
							Non-member
						<?php else: ?>
							<?php echo $this->Admin_m->detail_data_order('member','id_member',$detnota->id_member)->nm_member ?>
						<?php endif ?>
					</td>
				</tr>
			</table>
			<?php if ($beli==TRUE): ?>
				<?php $no=1 ?>
				<table class="table table-sm" style="font-size: 12px;">
					<?php foreach ($beli as $data): ?>
						<form action="<?php echo base_url('index.php/admin/pembelian/update_menu_nota/'.$data->id_menu_to_nota.'/'.$detnota->id_nota) ?>" method="post">
							<tr>
								<td><?php echo $no; ?></td>
								<td>
									<?php echo $data->nama_menu; ?>
									<?php if ($data->diskon !== '0'): ?>
										<span style="color: green">- dskn <?php echo $data->diskon.' %'; ?></span>
									<?php endif ?>
								</td>
								<td>
									<?php if ($data->id_status == '1'): ?>
										<input type="text" name="jml_menu" value="<?php echo $data->jml_menu ?>" style="width: 30px;text-align: center;">
									<?php else: ?>
										<?php echo 'x'.$data->jml_menu; ?>
									<?php endif ?>
								</td>
								<td>
									<?php if ($data->diskon !== '0'): ?>
										<span style="color: green"><?php echo 'Rp.'.number_format($data->total_bayar,0,',','.'); ?></span>
									<?php else: ?>
										<?php echo 'Rp.'.number_format($data->total_bayar,0,',','.'); ?>
									<?php endif ?>
								</td>
								<?php if ($data->id_status == '1'): ?>
									<td><a class="btn btn-outline-danger btn-sm" href="<?php echo base_url('index.php/admin/pembelian/delete_order/'.$detnota->id_nota.'/'.$data->id_menu_to_nota) ?>"><i class="fa fa-trash"></i></a></td>
								<?php endif ?>
							</tr>
						</form>
						<?php $no++ ?>
					<?php endforeach ?>
					<tr>
						<td colspan="3">Total</td>
						<td>
							<?php $harga = 0 ?>
							<?php foreach ($beli as $data): ?>
								<?php $harga = $data->total_bayar + (int)@$harga; ?>
							<?php endforeach; ?>
							<b ><?php echo 'Rp.'.number_format($harga,0,',','.'); ?></b>
						</td>
						<td></td>
					</tr>
					<?php if ($detnota->id_status == '1'): ?>
						<tr>
							<td colspan="5"><button class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#bayar" style="width: 100%">Bayar</button></td>
						</tr>
						<tr>
							<td colspan="5"><a href="<?php echo base_url('index.php/admin/pembelian/delete_nota/'.$detnota->id_nota) ?>" class="btn btn-outline-danger btn-sm" style="width: 100%">Batalkan Nota</a></td>
						</tr>
					<?php else: ?>
						<tr>
							<td colspan="3">Jumlah Bayar</td>
							<td colspan="2"><b><?php echo 'Rp.'.number_format($detnota->jumlah_bayar,0,',','.'); ?></b></td>
						</tr>
						<tr>
							<td colspan="3">Kembalian</td>
							<td colspan="2"><b><?php echo 'Rp.'.number_format($detnota->kembalian,0,',','.'); ?></b></td>
						</tr>
						<tr>
							<td colspan="5"><a href="<?php echo base_url('index.php/admin/pembelian/cetak_struk/'.$detnota->id_nota) ?>" class="btn btn-outline-info btn-sm" style="width: 100%" target="_blank">Cetak Struk</a></td>
						</tr>
					<?php endif ?>
				</table>
			<?php else: ?>
				<div class="border border-danger" style="padding: 14px">Belum ada barang di pilih</div>
			<?php endif ?>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center" id="bayar">Pembayaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url('index.php/admin/pembelian/bayar/'.$detnota->id_nota.'/'.$harga) ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="exampleInputEmail1">Jumlah yang harus di bayar</label>
						<div class="form-control"><?php echo 'Rp.'.number_format($harga,0,',','.'); ?></div>
						<small id="emailHelp" class="form-text text-muted">Jumlah keseluruham dari jumlah biaya belanja</small>
					</div>
					<div class="form-group">
						<label for="jumlah_bayar">Jumlah yang yang diberikan</label>
						<input type="text" class="form-control" name="jumlah_bayar" id="jumlah_bayar" value="<?php echo $harga ?>" placeholder="Masukan Rupiah">
						<small id="jumlah_bayar" class="form-text text-muted">Jumlah uang yang diberikan oleh pelanggan</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="submit" value="submit" class="btn btn-success">Bayar</button>
				</div>
			</form>
		</div>
	</div>
</div>