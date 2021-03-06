<div style="margin-top: 14px; background-color: white;padding: 30px">
	<div class="media">
		<div class="media-left">
			<h5 class="text-info">Daftar Galeri</h5><hr/>
		</div>
		<div class="media-body"></div>
		<div class="media-right"><a href="<?php echo base_url('index.php/admin/galeri/create') ?>" class="btn btn-outline-success"><i class="fa fa-plus-circle"></i> Tambah Galeri</a></div>
	</div>
	<div class="bts-ats">
		<?php if ($this->session->flashdata('message')): ?>
			<div class="alert alert-success alert-dismissible" role="alert" style="margin-top:65px;">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
			</div>
		<?php endif ?>
		<form action="<?php echo base_url('index.php/admin/galeri/index') ?>" method="get">
		<input type="text" name="string" class="form-control" placeholder="Cari Galeri" style="width: 100%">
		<small id="nama_kategori" class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
	</form>
		<table class="table bts-ats" style="font-size: 13px">
			<thead>
				<tr>
					<th class="text-center ">No</th>
					<th class="">Nama Galeri</th>
					<th class="">Keterangan</th>
					<th class="text-center " colspan="2">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($hasil)): ?>
					<?php $no=$nomor+1 ?>
					<?php foreach ($hasil as $data): ?>
						<tr>
							<td class="text-center"><?php echo $no; ?></td>
							<td><?php echo $data->nama_galeri; ?></td>
							<td><?php echo $data->ket_galeri; ?></td>
							<td class="text-center">
								<a href="<?php echo base_url('index.php/admin/galeri/edit/'.$data->id_galeri); ?>">
									edit
								</a>
							</td>
							<td>
								<a href="<?php echo base_url('index.php/admin/galeri/delete/'.$data->id_galeri); ?>" class="text-danger">
									delete
								</a>
							</td>
						</tr>
						<?php $no++ ?>
					<?php endforeach ?>
				<?php else: ?>
					<tr>
						<td colspan="4"><i>Tidak ada data ditemukan</i></td>
					</tr>
				<?php endif ?>
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