<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="bg-white cari-box">
				<h1>Semua Dokumen</h1><hr/>
				<form action="<?php echo base_url('index.php/utama/alldoc/') ?>" method="get">
					<div class="form-group">
						<label>Pencarian berita</label>
						<input type="text" name="string" class="form-control" placeholder="Cari dokumen">
						<small class="form-text text-muted">cari dokumen yang inginkan disini</small>
					</div>
				</form>
				<table class="table" style="font-size: 13px">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Dokumen</th>
							<th>Tipe File</th>
							<th>Tgl upload</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $no=$offset+1 ?>
						<?php foreach ($hasil as $data): ?>
							<tr>
								<td><?php echo $no; ?></td>
								<td class="text-bawaan"><?php echo $data->nama_dokumen; ?></td>
								<td class="text-secondary"><?php echo $data->type_dokumen; ?></td>
								<td class="text-secondary"><?php echo $data->tgl_upload_dokumen; ?></td>
								<td><a href="<?php echo base_url('asset/dokumen/'.$data->file_dokumen) ?>" class="text-bawaan">Download</a></td>
							</tr>
							<?php $no++ ?>
						<?php endforeach ?>
					</tbody>
				</table>
				<div class="row">
					<div class="col">
						<!--Tampilkan pagination-->
						<?php echo $pagination; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="bg-white cari-box">
				Info
				<?php foreach ($infor as $data): ?>
					<div class="media">
						<div class="media-body">
							<a class="text-bawaan" href="<?php echo base_url('index.php/utama/info/'.$data->alias_info_kampus) ?>"><h6 class="mt-0"><?php echo $data->judul_info_kampus; ?></h6></a><hr/>
						</div>
					</div>
				<?php endforeach ?>
			</div>
			<div class="bg-white cari-box">
				Berita Terkait
				<?php foreach ($terkait as $data): ?>
					<div class="media">
						<div class="media-body">
							<a class="text-bawaan" href="<?php echo base_url('index.php/utama/artikel/'.$data->alias_artikel) ?>"><h6 class="mt-0"><?php echo $data->jdl_artikel; ?></h6></a><hr/>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>