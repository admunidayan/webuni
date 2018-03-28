<div class="row">
	<div class="col-md-6">
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
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data->nama_menu; ?></td>
							<td><?php echo 'x'.$data->jml_menu; ?></td>
							<td><?php echo 'Rp.'.$data->total_bayar; ?></td>
						</tr>
						<?php $no++ ?>
					<?php endforeach ?>
					<tr>
						<td colspan="3">Total</td>
						<td>
							<?php $harga = 0 ?>
							<?php foreach ($beli as $data): ?>
								<?php $harga = $data->total_bayar + (int)@$harga; ?>
							<?php endforeach; ?>
							<b ><?php echo 'Rp.'.$harga; ?></b>
						</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3">Jumlah Bayar</td>
						<td colspan="2"><b><?php echo 'Rp.'.$detnota->jumlah_bayar; ?></b></td>
					</tr>
					<tr>
						<td colspan="3">Kembalian</td>
						<td colspan="2"><b><?php echo 'Rp.'.$detnota->kembalian; ?></b></td>
					</tr>
					<tr>
						<td colspan="5"><a href="<?php echo base_url('index.php/admin/pembelian/cetak_struk/'.$detnota->id_nota) ?>" class="btn btn-outline-info btn-sm" style="width: 100%" target="_blank">Cetak Struk</a></td>
					</tr>
				</table>
			<?php else: ?>
				<div class="border border-danger" style="padding: 14px">Belum ada barang di pilih</div>
			<?php endif ?>
		</div>
	</div>
</div>