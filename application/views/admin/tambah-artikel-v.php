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
<div style="margin-top: 14px; background-color: white;padding: 30px">
	<h5 class="text-info">Tambah Artikel</h5><hr/>
	<form action="<?php echo base_url('index.php/admin/artikel/proses_create') ?>" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label>judul Artikel</label>
					<input type="text" class="form-control" name="judul_artikel" placeholder="Masukan judul artikel" required>
					<small class="form-text text-muted">Maksimal 144 karekter</small>
				</div>
				<div class="form-group">
					<label>Deskripsi Artikel</label>
					<textarea name="deskripsi_artikel" class="form-control" placeholder="masukan deskripsi artikel disini" required></textarea>
					<small class="form-text text-muted">Maksimal 144 karekter</small>
				</div>
				<div class="form-group">
					<label>Isi Artikel</label>
					<textarea id="isi" name="isi_artikel" class="form-control" rows="20"></textarea>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">Status Artikel</label>
					<select class="form-control" name="status_artikel">
						<option value="publish">Publish</option>
						<option value="draft">Draft</option>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Kategori</label>
					<select class="form-control" name="id_kategori">
						<?php foreach ($kategori as $kat): ?>
							<option value="<?php echo $kat->id_kategori; ?>"><?php echo $kat->judul_kategori; ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label>Gambar Utama</label><br/>
					<img id="preview" class="sampul" src="<?php echo base_url('asset/img/artikel/default.jpg'); ?>" width="100%" alt="default.jpg">
					<input type="file" name="img_artikel" id="uploadBtn">
				</div>
				<button class="btn btn-success" type="submit" name="submit" value="submit">Simpan data</button>
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