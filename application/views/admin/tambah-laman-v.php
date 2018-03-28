<script src='<?php echo base_url('asset/js/tinymce/tinymce.min.js'); ?>'></script>
<script type="text/javascript">
  tinymce.init({
    selector: '#isi',
    plugins: 'code media link',
    menubar: false,
    toolbar: [
    'undo redo | bold italic underline spellchecker | alignleft aligncenter alignright alignjustify | strikethrough cut copy paste pastetext link code',
    ],
  });
</script>
<div class="col-md-2 paddingnone">
	<?php $this->load->view('nav/nav-laman') ?>
</div>
<div class="col-md-10 paddingnone">
	<div class="box-panel">
		<div class="media">
			<div class="media-left media-middle">
				<i class="fa fa-plus fa-lg"></i>
			</div>
			<div class="media-body media-middle">
				<h2 class="media-heading"><?php echo $title; ?></h2>
			</div>
		</div>
		<form action="<?php echo base_url('index.php/admin/laman/proses_create'); ?>" method="post" enctype="multipart/form-data">
			<div class="bts-ats" style="margin-top: 50px;">
				<div class="col-md-8">
					<div class="form-group">
						<label class="control-label">Judul Laman</label>
						<input type="hidden" name="id_user" value="<?php echo $users->id; ?>">
						<input type="text" class="form-control" name="judul_laman" placeholder="Judul Halaman">
					</div>
					<div class="form-group">
						<label class="control-label">Link</label>
						<input type="text" class="form-control" name="link" placeholder="Link halaman website">
					</div>
					<div class="form-group">
						<label class="control-label">Deskripsi</label>
						<textarea class="form-control" name="deskripsi_laman" rows="3" placeholder="Deskripsi Halaman"></textarea>
					</div>
					<div class="form-group">
						<textarea id="isi" class="form-control" name="isi_laman" rows="20" placeholder="isi halaman"></textarea>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Status</label>
						<select class="form-control" name="status_laman">
							<option value="publish">Publish</option>
							<option value="draft">Draft</option>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Sub Laman dari</label>
						<select class="form-control" name="s_laman">
							<?php if ($detail->s_laman == 0): ?>
								<option value="0">-- Tidak Di Pasang --</option>
							<?php else: ?>
								<option value="<?php echo $detail->s_laman; ?>">-- <?php echo $detail->s_laman; ?> --</option>
							<?php endif ?>
							<?php foreach ($alllaman as $laman): ?>
							<option value="<?php echo $laman->id_laman; ?>"><?php echo $laman->judul_laman; ?></option>				
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Foto depan</label>
						<img id="preview" class="sampul" src="<?php echo base_url('asset/img/laman/default.jpg'); ?>" width="100%" alt="default.jpg">
						<input type="file" name="img_laman" id="uploadBtn">
					</div>
					<button type="submit" name="submit" value="submit" class="bts-ats btn btn-success btn-lg" style="width: 100%">Simpan</button>
				</div>
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