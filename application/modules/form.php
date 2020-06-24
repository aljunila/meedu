<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Indosakti</title>

  <!-- Bootstrap Core CSS -->
  <link href="<?php echo base_url(); ?>design-website/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="<?php echo base_url(); ?>design-website/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>design-website/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="<?php echo base_url(); ?>design-website/css/stylish-portfolio.css" rel="stylesheet">

</head>

<body id="page-top">
  <style type="text/css">
    @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");

    .panel-title{
      padding: 16px 0px !important;
      color: #333 !important; 
      font-weight: 100 !important;

    }
    .panel-title > a:before {
        float: right !important;
        font-family: FontAwesome;
        content:"\f068";
        padding-right: 5px;
        font-size: 18px !important;
        font-weight: 200 !important;
    }
    .panel-title > a.collapsed:before {
        float: right !important;
        content:"\f067";
        font-size: 18px !important;
        font-weight: 200 !important; 
    }
    .panel-title > a:hover, 
    .panel-title > a:active, 
    .panel-title > a:focus  {
        text-decoration:none;
    }

     .panel-title > a{
      font-size: 24px; 
      font-weight: 800;
      color: #333 !important; 
    }

    .border-pt{
      border-top: 1px solid #e1272a;
    }
    .border-pb{
      border-bottom: 1px solid #e1272a;
    }

    .input-no-border{
        background:transparent;
        color: #fff;border: none;
        border-bottom: 1px solid #fff;
    }
     .input-no-border:hover{
        background:transparent;
        color: #fff;border: none;
        border-bottom: 1px solid #fff;
         outline: none;
    }
     .input-no-border:focus{
        background:transparent;
        color: #fff;border: none;
        border-bottom: 1px solid #fff;
         outline: none;
    }

    .btn-send{
      font-size: 36px;color: #333;
      background-color: transparent;
      border: none;
    }
    .btn-send:hover{
      font-size: 36px;color: #e1272a;
      color: #fff;
      border: none;
    }

    .select-style{
      background-color: transparent;
      border:none;
      outline: none;
    }

    .select-style:focus{
      background-color: transparent;
      border:none;
      outline: none;
    }

    .input-attached{
      width: 150px;
    }

     .about-head {
      min-height: 30rem;
      position: relative;
      display: table;
     
      padding-top: 8rem;
      padding-bottom: 8rem;
      /*background: url("../img/about.jpg");*/
      background: url("<?php echo base_url(); ?>data/section_header/<?php echo $header->img;?>");
       width: 100% !important;
      height: auto;
      background-position: center center;
      background-repeat: no-repeat;
      background-size: cover !important;
    }

    @media (min-width: 992px) {
      .masthead {
        height: 100vh;
      }

      .about-head {
        height: 100vh;
      }

      .workdetailhead {
        height: 100vh;
      }
      .masthead h1 {
        font-size: 5.5rem;
      }
    }



  </style>

<?php include 'social_white.php'; ?>

<?php include 'header_layout.php'; ?>
<?php include 'sidebar.php'; ?>

 

  <!-- Header -->
  <!-- <header class="about-head d-flex text-white">
    <div class="container text-left my-auto" style="z-index: 100;">
      <div class="mb-1 ml-4" style="font-size: 54px; font-weight: 800; line-height:  54px;"><?php echo $header->title;?></div>
      
    </div>
    <div class="overlay"></div> 
  </header> -->

  <!-- Services -->
 <!--  <section class="content-section text-center" id="job-opening">
    <div class="container">
      <div class="content-section-heading text-left">
        <div class="row">
          <div class="col-md-12 mb-5"><h2 class="">Job Opening</h2>
            <p>Check our job openings and apply or send us your CV, Anyway. We are always quest for talent.</p></div>
          
        </div>
        
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <?php 
              $s = 0;
              foreach ($jobs as $js) { ?>
                <div class="panel panel-default text-left border-pt <?php if(($s+1)==sizeof($jobs)){ echo "border-pb";}?>">
                    <div class="panel-heading " role="tab" id="heading<?php echo $js->id;?>">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $js->id;?>" aria-expanded="true" aria-controls="collapse<?php echo $js->id;?>">
                          <?php echo $js->title; ?>
                        </a>
                      </h4>
                    </div>
                    <div id="collapse<?php echo $js->id;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?php echo $js->id;?>">
                        <div class="panel-body">
                         <?php echo $js->description; ?>
                          <div class="text-right text-primary text-bold mb-3"><span onclick="apply_go(<?php echo $js->id;?>)">APPLY NOW ___</span></div>
                        </div>
                    </div>
                </div>
             <?php $s++; } ?>
 -->

             <!--  <div class="panel panel-default text-left border-pt">
                  <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Business Development
                      </a>
                    </h4>

                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                       <div class="panel-body">
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sed dignissim felis, nec eleifend mi. Donec sit amet elementum nunc. In pellentesque lectus consectetur, dignissim magna vel, suscipit mauris.
                        </p>
                        <p>
                          Key Responsibility:
                          <ul>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>consectetur adipiscing elit.</li>
                            <li>Quisque sed dignissim felis</li>
                            <li>nec eleifend mi</li>
                            <li>Donec sit amet elementum nunc</li>

                          </ul>
                        </p>
                        <div class="text-right text-primary text-bold mb-3"><span onclick="apply_go(2)">APPLY NOW ___</span></div>
                      </div>
                  </div>
              </div>
              <div class="panel panel-default text-left border-pt border-pb">
                  <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Sales Promotion Girl
                      </a>
                    </h4>

                  </div>
                  <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                       <div class="panel-body">
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sed dignissim felis, nec eleifend mi. Donec sit amet elementum nunc. In pellentesque lectus consectetur, dignissim magna vel, suscipit mauris.
                        </p>
                        <p>
                          Key Responsibility:
                          <ul>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>consectetur adipiscing elit.</li>
                            <li>Quisque sed dignissim felis</li>
                            <li>nec eleifend mi</li>
                            <li>Donec sit amet elementum nunc</li>

                          </ul>
                        </p>
                        <div class="text-right text-primary text-bold mb-3"><span onclick="apply_go(3)">APPLY NOW ___</span></div>
                      </div>
                  </div>
              </div> -->
        <!--   </div>
          </div>
      </div>
      
    </div>
  </section> -->

  <section class="content-section bg-primary text-left text-white" id="form-career">
    <div class="container">
      <div class="content-section-heading text-left">
        <div class="row">
          <div class="col-md-10, offset-md-1 mb-5"><h5 class="">Biodata</h5>
            
        </div>
        
      </div>

      <div class="row">
        <div class="col-md-12 offset-md-1" style="line-height: 25px;">
          <p style="font-size: 25px;">Nama Lengkap</p>
          <p> <input type="text" name="name" class="input-no-border"></p> 
        </div>
        <div class="col-md-12 offset-md-1" style="line-height: 25px;">
          <p style="font-size: 25px;">No Identitas</p>
          <p> <input type="text" name="no_identitas" class="input-no-border"></p> 
        </div>
          <div class="col-md-3 offset-md-1" style="line-height: 25px;">
            <p style="font-size: 25px;">Tempat Lahir</p>
            <p style="font-size: 25px;"><input type="text" name="no_identitas" class="input-no-border"> 
          </div>
          <div class="col-md-3 offset-md-1" style="line-height: 25px;">
            <p style="font-size: 25px;">Tempat Lahir</p>
            <p style="font-size: 25px;"><input type="text" name="no_identitas" class="input-no-border"> 
          </div>
         <div class="col-md-12 offset-md-1" style="line-height: 25px;">
          <p style="font-size: 25px;">Nama Ibu Kandung</p>
          <p> <input type="text" name="ibu" class="input-no-border"></p> 
        </div> 
          <div class="col-md-3 offset-md-1" style="line-height: 25px;">
            <p style="font-size: 25px;">Jenis Kelamin</p>
            <p style="font-size: 25px;"><select class="select-style">
                <option selected class="option-style">Pria</option>
                <option class="option-style">Wanita</option>
            </select> </p> 
          </div>
          <div class="col-md-4 offset-md-1" style="line-height: 25px;">
            <p style="font-size: 25px;">Agama</p>
             <p style="font-size: 25px;"><select class="select-style">
                <option selected class="option-style">Islam</option>
                <option class="option-style">Kristen</option>
                <option class="option-style">Hindu</option>
                <option class="option-style">Budha</option>
            </select> </p>  
          </div>
          <div class="col-md-4 offset-md-1" style="line-height: 25px;">
            <p style="font-size: 25px;">Status Nikah</p>
            <p style="font-size: 25px;"><select class="select-style">
                <option selected class="option-style">Menikah</option>
                <option class="option-style">Belum</option>
                <option class="option-style">Janda/Duda</option>
            </select> </p> 
          </div>
          <div class="col-md-4 offset-md-1" style="line-height: 25px;">
            <p style="font-size: 25px;">Jumlah Anak</p>
             <p style="font-size: 25px;"><input type="text" name="ibu" class="input-no-border"></p>  
          </div>
          <div class="col-md-4 offset-md-1" style="line-height: 25px;">
            <p style="font-size: 25px;">Tinggi Badan</p>
             <p style="font-size: 25px;"><input type="text" name="ibu" class="input-no-border"></p>  
          </div>
          <div class="col-md-4 offset-md-1" style="line-height: 25px;">
            <p style="font-size: 25px;">Berat Badan</p>
             <p style="font-size: 25px;"><input type="text" name="ibu" class="input-no-border"></p>  
          </div>
          <div class="col-md-12 offset-md-1" style="line-height: 25px;">
            <p style="font-size: 25px;">Foto</p>
             <p style="font-size: 25px;"><input type="file" name="ibu" class="input-no-border"></p>  
          </div>  
        </div>
      </div>
      
   <br>
      <div class="content-section-heading text-left">
        <div class="row">
          <div class="col-md-10, offset-md-1 mb-5"><h5 class="">Informasi Kontak</h5>
            
        </div>
        
      </div>

      <div class="row">
        <div class="col-md-12 offset-md-1" style="line-height: 25px;">
          <p style="font-size: 25px;">Alamat</p>
          <p> <input type="text" name="name" class="input-no-border"></p> 
        </div>
        <div class="col-md-4 offset-md-1" style="line-height: 25px;">
            <p style="font-size: 25px;">No. Handphone</p>
             <p style="font-size: 25px;"><input type="text" name="ibu" class="input-no-border"></p>  
          </div>
          <div class="col-md-4 offset-md-1" style="line-height: 25px;">
            <p style="font-size: 25px;">Email</p>
             <p style="font-size: 25px;"><input type="text" name="ibu" class="input-no-border"></p>  
          </div>
        </div>
      </div>
     <br>
      <div class="content-section-heading text-left">
        <div class="row">
          <div class="col-md-10, offset-md-1 mb-5"><h5 class="">Informasi Tambahan</h5>
            
        </div>
        
      </div>

      <div class="row">
        <div class="col-md-4 offset-md-1" style="line-height: 25px;">
            <p style="font-size: 25px;">Pendidikan Terakhir</p>
             <p style="font-size: 25px;"><input type="text" name="ibu" class="input-no-border"></p>  
          </div>
          <div class="col-md-4 offset-md-1" style="line-height: 25px;">
            <p style="font-size: 25px;">Nama Sekolah/Universitas</p>
             <p style="font-size: 25px;"><input type="text" name="ibu" class="input-no-border"></p>  
          </div>
        <div class="col-md-4 offset-md-1" style="line-height: 25px;">
            <p style="font-size: 25px;">Kategori/Grade</p>
             <p style="font-size: 25px;"><input type="text" name="ibu" class="input-no-border"></p>  
          </div>
          <div class="col-md-4 offset-md-1" style="line-height: 25px;">
            <p style="font-size: 25px;">Provinsi</p>
             <p style="font-size: 25px;"><input type="text" name="ibu" class="input-no-border"></p>  
          </div>
        </div>
      </div>
      
    </div>
  </section>

  <?php include 'footer_black.php'; ?>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top js-scroll-trigger" href="#page-top">
    <span class="rotate">GO TO TOP&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></span>
  </a>

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url(); ?>design-website/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>design-website/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="<?php echo base_url(); ?>design-website/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="<?php echo base_url(); ?>design-website/js/stylish-portfolio.min.js"></script>
  <script type="text/javascript">
    function bigImg(x) {
      switch(x) {
        case 1:
          document.getElementById('img-peo').src='img/people/m1.jpg';
          break;
        case 2:
          document.getElementById('img-peo').src='img/people/m2.jpg';
          break;
        case 3:
          document.getElementById('img-peo').src='img/people/m3.jpg';
          break;
        case 4:
          document.getElementById('img-peo').src='img/people/m4.jpg';
          break;
        case 5:
          document.getElementById('img-peo').src='img/people/m1.jpg';
          break;
          case 6:
          document.getElementById('img-peo').src='img/people/m2.jpg';
          break;
          case 7:
          document.getElementById('img-peo').src='img/people/f1.jpg';
          break;
          case 8:
          document.getElementById('img-peo').src='img/people/f2.jpg';
          break;
          case 9:
          document.getElementById('img-peo').src='img/people/f3.jpg';
          break;
          case 10:
          document.getElementById('img-peo').src='img/people/f4.jpg';
          break;
          case 11:
          document.getElementById('img-peo').src='img/people/f1.jpg';
          break;
        default:
          // code block
      }
      
      
    }

    function normalImg(x) {
      document.getElementById('img-peo').src='img/people/def_1.jpg';
    }

    function apply_go(x){
      $('html, body').animate({
            scrollTop: $('#form-career').offset().top
        }, 1000);

      $("#position-job").val(x);
    }
  </script>

</body>

</html>

