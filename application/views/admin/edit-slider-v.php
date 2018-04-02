<div style="margin-top: 14px; background-color: white;padding: 30px">
	<div class="bts-ats">
		<h5 class="text-info">Edit Slider</h5><hr/>
		<?php if ($this->session->flashdata('message')): ?>
			<div class="alert alert-success alert-dismissible" role="alert" style="margin-top:65px;">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
			</div>
		<?php endif ?>
		<form action="<?php echo base_url('index.php/admin/slider/proses_edit'); ?>" method="post" enctype="multipart/form-data">
			<div class="adm-slide-box">
				<img id="preview" src="<?php echo base_url('asset/img/slider/'.$detail->img_slider); ?>" width="100%"><br/>
				<input type="hidden" name="id_slider" value="<?php echo $detail->id_slider; ?>">
				<input id="uploadBtn" type="file" name="img_slider" class="bts-ats" name="slider">
				<div>
					<label>Judul Slider</label>
					<input type="text" class="form-control" name="jdl_slider" placeholder="Judul Slider" value="<?php echo $detail->jdl_slider; ?>">
				</div>
			</div>
			<div class="bts-ats">
				<button type="submit" name="submit" value="submit" class="btn btn-success">Simpan</button>
				<div class="sambungfloat"></div>
			</div>
		</form>
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