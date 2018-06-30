<div style="margin-top: 14px; background-color: white;padding: 30px">
	<h5 class="text-info">Edit link</h5><hr/>
	<?php if ($this->session->flashdata('errors')): ?>
		<div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:65px;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong><?php echo $this->session->flashdata('errors');?></strong>
		</div>
	<?php endif ?>
	<?php if ($this->session->flashdata('message')): ?>
		<div class="alert alert-success alert-dismissible" role="alert" style="margin-top:65px;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong><?php echo $this->session->flashdata('message');?></strong>
		</div>
	<?php endif ?>
	<form action="<?php echo base_url('index.php/admin/link/proses_edit'); ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id_link" value="<?php echo $detail->id_link; ?>">
		<div class="row bts-ats" style="margin-top: 50px;">
			<div class="col-md-8">
				<div class="form-group">
					<label class="control-label">Nama link</label>
					<input type="text" class="form-control" name="nama_link" value="<?php echo $detail->nama_link; ?>" placeholder="Nama link">
				</div>
				<div class="form-group">
					<label class="control-label">Keterangan</label>
					<textarea class="form-control" name="ket_link" rows="3" placeholder="Keterangan link"><?php echo $detail->ket_link; ?></textarea>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">Image link</label>
					<img id="preview" class="sampul" src="<?php echo base_url('asset/img/link/'.$detail->img_link); ?>" width="100%" alt="<?php echo $detail->img_link; ?>">
					<input type="file" name="img_artikel" id="uploadBtn">
				</div>
				<button type="submit" name="submit" value="submit" class="bts-ats btn btn-success btn-lg" style="width: 100%">Simpan</button>
			</div>
		</div>
	</form>
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