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
	<div class="container-fluid nbbg">
   <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <img class="align-self-center mr-3" src="<?php echo base_url('asset/img/lembaga/'.$this->Admin_m->info_pt(1)->logo_pt) ?>" alt="Generic placeholder image" width="40px">
          </li>
          <li class="nav-item">
            <div class="nav-link text-light"><?php echo $this->Admin_m->info_pt(1)->nama_info_pt ; ?></div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $users->username; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?php echo base_url('index.php/login/logout') ?>"><span class="text-danger">Logout</span></a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-2">
      <div class="navstyle">
        <?php $this->load->view($aside) ?>
      </div>
    </div>
    <div class="col-md-10">
        <?php $this->load->view($page) ?>
    </div>
  </div>
</div>
</body>
</html>