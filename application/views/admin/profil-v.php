<div style="margin-top: 14px; background-color: white;padding: 30px">
	<h5 class="text-info">Profil-ID</h5><hr/>
	<div class="main-box mybgcolor rounded clearfix bts-bwh2">
		<div class="float-left">
			<div class="text-secondary">Nama Lengkap</div>
			<div><?php echo $users->first_name; ?></div>
		</div>
	</div>
	<div class="main-box mybgcolor rounded clearfix bts-ats">
		<div class="text-secondary">Nomor Hadphone</div>
		<div class="main-box mybgcolor rounded bts-bwh2 bts-ats bg-light clearfix">
			<span class="float-left"><?php echo $users->first_name; ?></span>
			<span class="float-right text-primary">ubah</span>
		</div>
		<p class="text-secondary">No. handphone untuk menerima notifikasi terkait akun.</p>
		<div class="pembatas">
			<div class="text-secondary bts-ats">Alamat Email</div>
			<div class="main-box mybgcolor rounded bts-bwh2 bts-ats bg-light clearfix">
				<span class="float-left"><?php echo $users->email; ?></span>
				<span class="float-right text-primary">ubah</span>
			</div>
			<p class="text-secondary">Alamat email untuk menerima notifikasi terkait akun.</p>
		</div>
	</div>
</div>