<div style="margin-top: 14px; background-color: white;padding: 30px">
	<div class="bts-ats">
		<?php if ($this->session->flashdata('message')): ?>
			<div class="alert alert-success alert-dismissible" role="alert" style="margin-top:65px;">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
			</div>
		<?php endif ?>
		<?php if ($this->session->flashdata('errors')): ?>
			<div class="alert alert-success alert-dismissible" role="alert" style="margin-top:65px;">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('errors');?></strong>
			</div>
		<?php endif ?>
		<div class="addsliderbox">
			<h5 class="text-info">Tambah Slider Baru</h5><hr/>
			<form action="<?php echo base_url('index.php/admin/slider/proses_create'); ?>" method="post" enctype="multipart/form-data">
				<div class="adm-slide-box">
					<img id="preview" src="<?php echo base_url('asset/img/lembaga/sample.png'); ?>" width="100%">
					<input id="uploadBtn" type="file" name="img_slider" class="bts-ats" name="slider">
					<div>
						<label>Judul Slider</label>
						<input type="text" class="form-control" name="jdl_slider" placeholder="Judul Slider" required>
					</div>
				</div>
				<div class="bts-ats">
					<button type="submit" name="submit" value="submit" class="btn btn-success">Simpan</button>
					<div class="btn btn-info">Remove</div>
					<div class="sambungfloat"></div>
				</div>
			</form>
		</div>
		<hr/>
		<h5 class="text-info">Daftar Slider</h5>
		<div class="row">
			<?php foreach ($hasil as $data): ?>
				<div class="col-md-4">
					<div class="adm-slide-box">
						<img src="<?php echo base_url('asset/img/slider/'.$data->img_slider); ?>" width="100%">
						<div class="bts-ats">
							<h6><?php echo $data->jdl_slider; ?></h6>
						</div>
						<div class="bts-ats">
							<a href="<?php echo base_url('index.php/admin/slider/edit/'.$data->id_slider); ?>" class="btn btn-success">Edit</a>
							<a href="<?php echo base_url('index.php/admin/slider/delete/'.$data->id_slider); ?>" onClick="return confirm('Yakin menghapus data ini?')" class="btn btn-warning">Hapus</a>
							<div class="sambungfloat"></div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	document.getElementById("uploadBtn").onchange = function () {
		document.getElementById("uploadFile").value = this.value;
	};
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#preview').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#uploadBtn").change(function(){
		readURL(this);
	});
</script>