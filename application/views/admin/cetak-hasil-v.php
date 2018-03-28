<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
</head>
<body onload="window.print();">
	<table width="100%" style="border-bottom: 1px solid">
		<tr>
			<td colspan="2" style="text-align: center;border:1px solid"><h1>Hasil Pemasaran pada tanggal <?php echo $tanggal; ?></h1></td>
		</tr>
		<tr>
			<td width="50%" style="vertical-align: top; border-left: 1px solid;">
				<h5 class="text-info">Daftar Nota</h5>
				<table width="100%">
					<tr>
						<td style="border-bottom: 1px solid">No</td>
						<td style="border-bottom: 1px solid;border-left: 1px solid">Nota</td>
						<td style="border-bottom: 1px solid;border-left: 1px solid">Kasir</td>
						<td style="border-bottom: 1px solid;border-left: 1px solid">Total</td>
					</tr>
					<?php $harga_nota = 0 ?>
					<?php $no = 1 ?>
					<?php foreach ($hasil as $data): ?>
						<tr>
							<td style="border-bottom: 1px solid"><?php echo $no; ?></td>
							<td style="border-bottom: 1px solid;border-left: 1px solid"><?php echo $data->id_nota; ?></td>
							<td style="border-bottom: 1px solid;border-left: 1px solid"><?php echo $data->username ?></td>
							<td style="border-bottom: 1px solid;border-left: 1px solid"><?php echo 'Rp.'.number_format($data->total_bayar_nota,0,',','.') ?></td>
						</tr>
						<?php $harga_nota = $data->total_bayar_nota + (int)@$harga_nota; ?>
						<?php $no++ ?>
					<?php endforeach ?>
					<tr>
						<td colspan="3"><b>Total</b></td>
						<td colspan="2"><b><?php echo 'Rp.'.number_format($harga_nota,0,',','.'); ?></b></td>
					</tr>
				</table><hr/>
				<h5 class="text-info">Daftar Pemasukan</h5>
				<table width="100%">
					<tr>
						<td style="border-bottom: 1px solid">No</td>
						<td style="border-bottom: 1px solid;border-left: 1px solid">Keterangan</td>
						<td style="border-bottom: 1px solid;border-left: 1px solid">Total</td>
					</tr>
					<?php if ($umasuk == TRUE): ?>
						<?php $harga_masuk = 0 ?>
						<?php $no = 1 ?>
						<?php foreach ($umasuk as $data): ?>
							<tr>
								<td style="border-bottom: 1px solid"><?php echo $no; ?></td>
								<td style="border-bottom: 1px solid;border-left: 1px solid"><?php echo $data->keterangan; ?></td>
								<td style="border-bottom: 1px solid;border-left: 1px solid"><?php echo 'Rp.'.number_format($data->jumlah,0,',','.') ?></td>
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
							<td colspan="3" style="text-align: center;">Tidak ada uang masuk</td>
						</tr>
					<?php endif ?>
				</table><hr/>
				<h5 class="text-info">Daftar Pengeluaran</h5>
				<table width="100%">
					<tr>
						<td style="border-bottom: 1px solid">No</td>
						<td style="border-bottom: 1px solid;border-left: 1px solid">Keterangan</td>
						<td style="border-bottom: 1px solid;border-left: 1px solid">Total</td>
					</tr>
					<?php if ($ukeluar == TRUE): ?>
						<?php $harga_keluar = 0 ?>
						<?php $no = 1 ?>
						<?php foreach ($ukeluar as $data): ?>
							<tr>
								<td style="border-bottom: 1px solid"><?php echo $no; ?></td>
								<td style="border-bottom: 1px solid;border-left: 1px solid"><?php echo $data->keterangan; ?></td>
								<td style="border-bottom: 1px solid;border-left: 1px solid"><?php echo 'Rp.'.number_format($data->jumlah,0,',','.') ?></td>
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
							<td colspan="3" style="text-align: center;">Tidak ada uang keluar</td>
						</tr>
					<?php endif ?>
				</table>
			</td>
			<td width="50%" style="vertical-align: top;border-right: 1px solid;border-left: 1px solid;">
				<h5 class="text-info">Jumlah Barang Terjual</h5>
				<table width="100%">
					<tr>
						<td style="border-bottom: 1px solid">No</td>
						<td style="border-bottom: 1px solid;border-left: 1px solid">Nama Barang</td>
						<td style="border-bottom: 1px solid;border-left: 1px solid">Jml</td>
					</tr>
					<?php $no = 1 ?>
					<?php foreach ($brglaku as $barang): ?>
						<tr>
							<td style="border-bottom: 1px solid"><?php echo $no; ?></td>
							<td style="border-bottom: 1px solid;border-left: 1px solid"><?php echo strtoupper($barang->nama_menu); ?></td>
							<td style="border-bottom: 1px solid;border-left: 1px solid"><?php echo $barang->jml_laku; ?></td>
						</tr>
						<?php $no++ ?>
					<?php endforeach ?>
				</table><hr/>
				<h5 class="text-info">Total Penghasilan</h5>
				<table width="100%">
					<tr>
						<td style="border-bottom: 1px solid">No</td>
						<td style="border-bottom: 1px solid;border-left: 1px solid">Asal</td>
						<td style="border-bottom: 1px solid;border-left: 1px solid">Jumlah</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid">1</td>
						<td style="border-bottom: 1px solid;border-left: 1px solid">Uang Nota</td>
						<td style="border-bottom: 1px solid;border-left: 1px solid"><?php echo 'Rp.'.number_format(@$harga_nota,0,',','.'); ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid">2</td>
						<td style="border-bottom: 1px solid;border-left: 1px solid">Uang Masuk</td>
						<td style="border-bottom: 1px solid;border-left: 1px solid"><?php echo 'Rp.'.number_format(@$harga_masuk,0,',','.'); ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid">3</td>
						<td style="border-bottom: 1px solid">Uang Keluar</td>
						<td style="border-bottom: 1px solid"><?php echo 'Rp.'.number_format(@$harga_keluar,0,',','.'); ?></td>
					</tr>
					<tr>
						<td colspan="2"><b>Total</b></td>
						<td>
							<?php $totalhasil=@$harga_nota+@$harga_masuk-@$harga_keluar ?>
							<b><?php echo 'Rp.'.number_format($totalhasil,0,',','.'); ?></b>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>