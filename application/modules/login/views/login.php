<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="STEPA, Sistem Pendidikan dan Administrasi Sekolah" />
	  <meta name="keywords" content="sim, school, stepa, Administrasi" />
    <meta name="author" content="rakoon">
    <title>Meedu</title>
	  <link rel="shortcut icon" href="<?php echo base_url(); ?>logo.png" type="image/x-icon" />
    <link href="<?php echo base_url(); ?>themes/admin/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>themes/admin/css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" media="all">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .form-background{
        background: #ffffff;
        border: 1px solid #ddd;
      }
      .content-login{
        padding: 15px;
      }

      .header-login{
        background: #fff;
      }
      .text-brand{
        font-size: 18px;
      }
      .text-tagline{
        font-weight: 700;
      }
      .text-white{
        color: #fff !important;
      }
     
      span.highlight-text{
        color: #ffffff;
        background-color: rgba(0, 0, 0, 0.40);
      }

      h3.text-white{
        color: #ffffff;
      }

      .remark-brand{
      }

    </style>
  </head>

  <body>
    <div class="container">
      <div class="row login-container" >
        <div class="col-md-6 text-center">
        </div>
        <div class="col-md-6">
          <?php echo form_open('login/check','class="form-signin" role="form"');
            $false_login = $this->session->flashdata('false_login');
            $username = $this->session->flashdata('username');
          ?> 
          <div class="remark-brand">
          <div class="form-background text-center">
            <div class="content-login">
                <?php if(!empty($false_login)){ ?>
                <div class="alert alert-danger">
                  <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
                  <?php echo $false_login; ?>
                </div>
                <?php } ?>
                <div class="">
                  <div class="icon-input"><i class="fa fa-user"></i></div>
                  <div >
                 
                  <input type="text" class="input-login" placeholder="Username" name="username" required autofocus>
                  </div>
                </div>
                <div class="">
                  <div class="icon-input"><i class="fa fa-key"></i></div>
                  <div >
                  <input type="password" class="input-login" placeholder="Password" name="password" required>
                  </div>
                </div>
              <button class="btn btn-success btn-block" type="submit">Masuk</button>
            </div>
          <div class="forgot-content text-left ">
            <!-- <a href="#" data-toggle="modal" data-backdrop="static" data-target="#forgotPass">Lupa Pasword ?</a> -->
          </div>
          
          </div>
          </div>
          </form>
        </div>
      </div>
   


       <!-- MODAL UNTUK EDIT DAN ADD ASAL SEKOLAH -->
      <div class="modal modal-default fade" id="detailMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
             
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-envelope"></i>&nbsp;Kirimkan Pesan</h4>
            </div>
            <div class="modal-body">
              <div class="box-title text-register-title text-center" id ="print-title"><strong>Silahkan isi data pesan yang anda ingin kirimkan</strong><br><br></div>
              <div class="row">
              <div class="form-group">
                <div class="col-sm-12">
                  <label class="control-label">Nama Lengkap</label>
                  <input type="text" class="form-control" placeholder="Nama Lenkap" id ="m_fullname" name="fullname" >
                </div>
              </div>
             
              <div class="form-group">
                <div class="col-sm-12">
                  <label class="control-label">Email</label>
                  <input type="email" class="form-control" placeholder="example@domain.com" id="m_email" name="email" >
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-sm-12">
                  <label class="ontrol-label">Pesan</label>
                  <textarea class="form-control" id="m_message" name="message"></textarea>
                </div>

              </div> 
              </div>
            </div>

            <div class="modal-footer">
                <button  id ="btn_cancel" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                <button  class="btn btn-success" onClick="ajaxSendMsg()">Simpan</button>
                <div id ="print-btn"></div>
            </div>
          </div>
          </div>
      </div>
      <!-- END MODAL MESSAGE-->


       <!-- MODAL RESET PASSWORD -->
      <div class="modal modal-default fade" id="forgotPass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
             
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-envelope"></i>&nbsp;Lupa Password</h4>
            </div>
            <div class="modal-body">
              <div class="box-title text-register-title text-center" id ="print-title"><strong>Silahkan isi email/username yang anda miliki. password yang sudah direset akan dikirim ke email anda.</strong><br><br></div>
              <div class="row">
              <div class="form-group">
                <div class="col-sm-12">
                  <label class="control-label">Email</label>
                  <input type="email" class="form-control" placeholder="example@domain.com" id="forgot_email" name="forgot_email" >
                </div>
              </div>
              
              </div>
            </div>

            <div class="modal-footer">
                <button  id ="btn_cancel" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                <button  class="btn btn-success" onClick="ajaxProsesForgot()">Proses</button>
                <div id ="print-btn"></div>
            </div>
          </div>
          </div>
      </div>
      <!-- END MODAL RESET PASSWORD-->


      <!-- MODAL DIALOG AFTER MSG -->
      <div class="modal modal-default fade" id="dialogAfterMsg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
             
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="print-status"><i class="fa fa-envelope"></i>&nbsp;Status</h4>
            </div>
            <div class="modal-body">
              <p id="print-message"></p>
           
            </div>

            <div class="modal-footer">
               
                <button  class="btn btn-success" data-dismiss="modal">Simpan</button>
            </div>
          </div>
          </div>
      </div>
      <!-- END MODAL DIALOG AFTER MSG-->

    </div> <!-- /container -->

  


	  <!-- JavaScript -->
    <script src="<?php echo base_url(); ?>themes/admin/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url(); ?>themes/admin/js/bootstrap.js"></script>

    <script>
    function ajaxSendMsg(){
      $('#detailMessage').modal('hide');
        var fullname = document.getElementById("m_fullname").value;
        var email = document.getElementById("m_email").value;
        var msg = document.getElementById("m_message").value;

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('usr_msg/msg_push')?>",
        data: { 
          fullname : fullname,
          email :email,
          msg : msg,
          msg_type :'1'
             },
        success: function(html){
          var jsontext   = html;
          var getData = JSON.parse(jsontext);
          $("#print-status").html(getData.status);
          $("#print-message").html(getData.message);
          $('#dialogAfterMsg').modal('show');
        }
      }); 
    }

    function ajaxProsesForgot(){
      $('#forgotPass').modal('hide');
        var email = document.getElementById("forgot_email").value;
        
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('usr_msg/forgot_password')?>",
        data: { 
          email :email
             },
        success: function(html){
          var jsontext   = html;
          alert(jsontext);
          // var getData = JSON.parse(jsontext);
          // $("#print-status").html(getData.status);
          // $("#print-message").html(getData.message);
          // $('#dialogAfterMsg').modal('show');
        }
      }); 
    }
  
    </script>
  </body>
</html>