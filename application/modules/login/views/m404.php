<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>STEPA - 404</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/bootstrap/css/bootstrap.min.css">
    <!-- Demo page code -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/dist/css/font-awesome.min.css">

    <style type="text/css">
		/*Error Pages*/
		body {
		  background-image: url('<?php echo base_url()?>themesAdmin/dist/img/awan.png');
		  background-position: initial initial;
		  background-repeat: no-repeat;
		  background-color: #fff;
		  background-size: 100%;
		  margin: 0px;
		  padding: 0px;
		}

		.caption-404{
			width: 35%;
			text-align: center;
			position: absolute;
			bottom: 275px;
			left: 0;
			z-index: 150;
		}

		.error-caption{
			font-style: bold;
			font-size: 230px;
			font-weight: 900;
			width: 100%;
			padding: 10px;
			color: #47bb8e;
			margin-bottom: -75px;
			margin-left:  auto;
			margin-right: auto;
			z-index: 150;
		}

		.error-message{
			font-size: 20px;
			font-weight: 200;
		}
		
		.img-pulau{
			position: absolute;
			right:    0;
			bottom:   0;
		}

		.air-pulau{
			position: absolute;
			height: 232px;
			width: 2000px;
			background-color: #3f96dd;
			bottom: 0;
			right: 0;
			z-index: -1;
		}

		.btn-inline{
			position: absolute;
			color: #ffffff;
			z-index: 100;
			background: transparent;
			border:1px solid #ddd;
			border-radius: 5px;
			bottom: 20%;
			left: 15%;
			padding-top: 8px;
			padding-bottom: 8px;
			padding-left: 16px;
			padding-right: 16px;
		}
    </style>


  </head>

  <body > 
	<div class="row-fluid">
		<div class="http-error">
			<div class="caption-404">
				<div class="error-caption">
					<span>404</span>
				</div>
				<div class="error-message">
				Halaman yang anda cari tidak ditemukan!
				</div>
				
			</div>
			<div class="img-pulau">
				<div class="air-pulau">
				</div>
			    <img style="width: 1024px;height: 728px;" src="<?php echo base_url(); ?>themesAdmin/dist/img/pulau.png">
			</div>
			<a href="<?php echo site_url('dashboard/dashboard/0-0') ?>"><button class="btn-inline"><i class="fa fa-chevron-left"></i> Kembali</button></a>


		</div>
	</div>
  </body>
</html>


