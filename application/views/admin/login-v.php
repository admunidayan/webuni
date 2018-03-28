<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
  <!-- lgo -->
  <link rel="shortcut icon" href="<?php echo base_url($brand); ?>">
  <!-- css bootsrap 4.0 beta -->
  <link rel="stylesheet" href="<?php echo base_url('asset/css/bootstrap.min.css'); ?>">
  <!-- css font awesome -->
  <link rel="stylesheet" href="<?php echo base_url('asset/css/font-awesome.min.css'); ?>">
  <!-- css font css pribadi -->
  <link rel="stylesheet" href="<?php echo base_url('asset/css/custom.css'); ?>">
  <!-- jquery terlebih dahulu -->
  <script src="<?php echo base_url('asset/js/jquery-3.2.1.min.js'); ?>" type="text/javascript"></script>
  <!-- js bootstrap v.4 butuh pooper.js -->
  <script src="<?php echo base_url('asset/js/popper.min.js'); ?>" type="text/javascript"></script>
  <!-- js bootstrap v.4 -->
  <script src="<?php echo base_url('asset/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
</head>
<body>
	<div class="container">
		<div class="login-box border border-info">
			<h1 class="text-center border border-top-0 border-left-0 border-right-0 border-secondary bts-bwh">LOGIN</h1>
			<form action="<?php echo base_url('index.php/login/proses_login/') ?>" method="post">
				<div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
					<input type="email" name="username" class="form-control form-control-lg border border-info" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
					<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" name="password" class="form-control form-control-lg border border-info" id="exampleInputPassword1" placeholder="Password">
					<small id="emailHelp" class="form-text text-muted">The Password must be more than 8 caracter</small>
				</div>
				<button type="submit" style="width:100%;" class="btn btn-info btn-lg">Submit</button>
			</form>
			<div class="row bts-ats">
				<div class="col">forgot password</div>
				<div class="col" style="text-align: right">Register Now</div>
			</div>
			<div class="text-center">
				<p class="text-secondary bts-ats">Copy Right <?php echo date('Y'); ?></p>
			</div>
		</div>
	</div>
</body>
</html>