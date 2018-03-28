<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
</head>
<body onload="window.print();">
	<div style="width: 297px">
		<table width="100%" style="font-size: 13px">
			<tr>
				<td style="text-align: center;"><?php echo $infopt->nama_info_pt; ?></td>
			</tr>
			<tr>
				<td style="text-align: center;"><?php echo $infopt->alamat_pt; ?></td>
			</tr>
		</table><hr/>
		<table width="100%" style="font-size: 13px">
			<tr>
				<td style="padding: 1px 3px">Tanggal</td>
				<td style="padding: 1px 3px">:</td>
				<td style="padding: 1px 3px"><?php echo $detnota->tgl_nota; ?></td>
			</tr>
			<tr>
				<td style="padding: 1px 3px">Waktu</td>
				<td style="padding: 1px 3px">:</td>
				<td style="padding: 1px 3px"><?php echo $detnota->jam_nota; ?></td>
			</tr>
			<tr>
				<td style="padding: 1px 3px">No Nota</td>
				<td style="padding: 1px 3px">:</td>
				<td style="padding: 1px 3px"><?php echo $detnota->id_nota; ?></td>
			</tr>
			<tr>
				<td style="padding: 1px 3px">Kasir</td>
				<td style="padding: 1px 3px">:</td>
				<td style="padding: 1px 3px"><?php echo $detnota->username; ?></td>
			</tr>
			<tr>
				<td style="padding: 1px 3px">Status</td>
				<td style="padding: 1px 3px">:</td>
				<td style="padding: 1px 3px"><?php echo $detnota->nm_status; ?></td>
			</tr>
			<tr>
				<td style="padding: 1px 3px">Member</td>
				<td style="padding: 1px 3px">:</td>
				<td style="padding: 1px 3px">
					<?php if ($detnota->id_member == 0): ?>
						Non-member
					<?php else: ?>
						<?php echo $this->Admin_m->detail_data_order('member','id_member',$detnota->id_member)->nm_member ?>
					<?php endif ?>
				</td>
			</tr>
		</table><hr/>
		<?php if ($beli==TRUE): ?>
			<?php $no=1 ?>
			<div style="text-align: center;"><b>Detail Pesanan</b></div>
			<table width="100%" border="1" style="font-size: 13px;">
				<?php foreach ($beli as $data): ?>
					<form action="<?php echo base_url('index.php/admin/pembelian/update_menu_nota/'.$data->id_menu_to_nota) ?>" method="post">
						<tr>
							<td style="padding: 3px 3px"><?php echo $no; ?></td>
							<td style="padding: 3px 3px">
								<?php echo $data->nama_menu; ?>
								<?php if ($data->diskon !== '0'): ?>
									<span style="color: green">- dskn <?php echo $data->diskon.' %'; ?></span>
								<?php endif ?>
							</td>
							<td style="padding: 3px 3px">
								<?php if ($data->id_status == '1'): ?>
									<input type="text" name="jml_menu" value="<?php echo $data->jml_menu ?>" style="width: 30px;text-align: center;">
								<?php else: ?>
									<?php echo 'x'.$data->jml_menu; ?>
								<?php endif ?>
							</td>
							<td style="padding: 3px 3px" colspan="2">
								<?php if ($data->diskon !== '0'): ?>
									<span style="color: green"><?php echo 'Rp.'.$data->total_bayar; ?></span>
								<?php else: ?>
									<?php echo 'Rp.'.$data->total_bayar; ?>
								<?php endif ?>
							</td>
						</tr>
					</form>
					<?php $no++ ?>
				<?php endforeach ?>
				<tr>
					<td style="padding: 3px 3px" colspan="3">Total</td>
					<td style="padding: 3px 3px" colspan="2">
						<?php $harga = 0 ?>
						<?php foreach ($beli as $data): ?>
							<?php $harga = $data->total_bayar + (int)@$harga; ?>
						<?php endforeach; ?>
						<b ><?php echo 'Rp.'.$harga; ?></b>
					</td>
				</tr>
				<tr>
					<td style="padding: 3px 3px" colspan="3">Jumlah Bayar</td>
					<td style="padding: 3px 3px" colspan="2"><b><?php echo 'Rp.'.$detnota->jumlah_bayar; ?></b></td>
				</tr>
				<tr>
					<td style="padding: 3px 3px" colspan="3">Kembalian</td>
					<td style="padding: 3px 3px" colspan="2"><b><?php echo 'Rp.'.$detnota->kembalian; ?></b></td>
				</tr>
			</table>
		<?php else: ?>
			<div class="border border-danger" style="padding: 14px">Belum ada barang di pilih</div>
		<?php endif ?>
		<hr/>
		<table width="100%">
		<tr>
			<td style="text-align: center;"><?php echo $infopt->footer_pt; ?></td>
		</tr>
	</table>
	</div>
</body>
</html>