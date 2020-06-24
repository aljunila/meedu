<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Stepa" />
	  <meta name="keywords" content="Sistem Administrasi dan Akademik Sekolah" />
    <meta name="author" content="rakoon">
    <title>STEPA - Sistem Pendidikan dan Administrasi</title>
	  <link rel="shortcut icon" href="<?php echo base_url(); ?>logo.png" type="image/x-icon" />
    <link href="<?php echo base_url(); ?>themes/admin/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>themes/admin/css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container bg-login">
    <div class="row">
      <div>
        <div class="pull-right">
          <img class="img-brander" src="<?php echo base_url(); ?>themes/admin/img/rakoon-mid.png">
        </div>
        <div>
          <img class="img-brander" src="<?php echo base_url(); ?>logo.png">
        </div>
      </div>
    </div>
    <div class="row login-container" >
      <div class="col-md-12">
        <?php echo form_open('admin/check','class="form-signin" role="form"');
          $false_login = $this->session->flashdata('false_login');
          $username = $this->session->flashdata('username');
        ?> 
        
        <div class="remark-brand text-center">
          <span class="brand-title">STEPA</span><br>
          <span class="tagline">Administrator Rakoon</span>
        </div>
        <div class="form-background text-center">
          <div class="header-login"></div>
          <?php if(!empty($false_login)){ ?>
          <div class="alert alert-danger">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
            <?php echo $false_login; ?>
          </div>
          <?php } ?>
          <div class="">
            <div class="icon-input"><i class="fa fa-user"></i></div>
            <div >
            <input type="text" class="input-login-rakoon" placeholder="Username" name="username" required autofocus>
            </div>
          </div>
          <div class="">
            <div class="icon-input"><i class="fa fa-key"></i></div>
            <div >
            <input type="password" class="input-login-rakoon" placeholder="Password" name="password" required>
            </div>
          </div>
        <button class="btn btn-danger btn-block" type="submit">Masuk</button>
        <div class="forgot-content text-left ">
          <a href="">Lupa Pasword ?</a>
        </div>
        
        </div>
        </form>
      </div>
      
    </div>

    <div class="col-md-12 footer-content">
      <!-- <img class = "pull-right" src="<?php echo base_url(); ?>themes/admin/img/footer.png"> -->
    </div>
    <div class="col-md-12 footer-info">
      
      <div class="menu-footer text-center">
      <label><?php echo $this->lang->line('author_company')?></label><br>
      <a href="http://rakoon.id" target="_blank">www.rakoon.id</a>
      </div>
    </div>
    </div> <!-- /container -->

	<!-- JavaScript -->
   <script src="<?php echo base_url(); ?>themes/admin/js/jquery-1.10.2.js"></script>
   <script src="<?php echo base_url(); ?>themes/admin/js/bootstrap.js"></script>

  </body>
</html>