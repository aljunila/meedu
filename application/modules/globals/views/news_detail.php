<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="STEPA, Sistem Pendidikan dan Administrasi Sekolah" />
	  <meta name="keywords" content="sim, school, stepa, Administrasi" />
    <meta name="author" content="rakoon">
    <title>STEPA - Sistem Pendidikan dan Administrasi</title>
	  <link rel="shortcut icon" href="<?php echo base_url(); ?>logo.png" type="image/x-icon" />
    <link href="<?php echo base_url(); ?>themes/admin/css/bootstrap.css" rel="stylesheet">
    <!-- <link href="<?php echo base_url(); ?>themes/admin/css/login.css" rel="stylesheet"> -->
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
      
      .img-diagonal{
          -webkit-clip-path: polygon(0 0, 0 90%, 100% 100%, 100% 0);
          width: 100%;
          height: 100%;
      }

      .footer-link{
        color: #3bc190;
      }

      .img-footer{
        width: 100%;
          height: 100%;
      }
      body{
        padding: 0;
      }

    </style>
   
  </head>

  <body >

    <div class="container">
    <div class="row" style="padding: 0; margin:0;" >
      <div class="col-md-8 col-md-offset-2" style="background-color: #ffffff; padding-bottom: 30px; padding-left: 0; padding-right: 0;">
        <div style="padding: 20px 0 10px; 0; font-size: 20px;font-weight: 800; border-bottom: 1px solid #dddddd;"><?php echo $news->title; ?></div>
        <div style="padding: 0 16px 16px 16px;"> 
          
          <!--  <?php if($institution->logo!=""){?>
          <img style="width: 72px;height: 72px;" src="<?php echo base_url(); ?>data/inst_img/<?php echo $institution->logo;?>">
          <?php }else{?> -->
          <img style="width: 64px;height: 64px;" src="<?php echo base_url(); ?>themesAdmin/dist/img/tutwuri.png ">
          <!-- <?php  } ?> -->
          <div style="padding-left: 80px; margin-top: -50px;"><label>Creator</label> Admin Stepa<br>
            <span style="font-size: 12px; ">
            <?php 
              $date2 = new DateTime($news->created_date);
              $dte= $date2->format('D, d F Y'); 
              echo $dte;
              ?>
            </span>
          </div>
        </div>
        <div >

        <img class="img-responsive img-diagonal" id="print-news-img" src="<?php echo base_url(); ?>data/news/<?php echo $news->img;?>">
        <div style="padding: 0 16px 0 16px; text-align: justify;">
          <p><?php echo $news->content;?></p>
        </div>

        </div>
        <div class="text-center" style="border-top: 1px solid #dddddd; padding-top: 20px;">  
          <p><a class="footer-link" href="http://stepa.id" target="_blank" >Beranda</a> | <a class="footer-link" href="#" data-toggle="modal" data-backdrop="static" data-target="#dialogContact">Kontak</a> | <a class="footer-link" href="#" data-toggle="modal" data-backdrop="static" data-target="#dialogPrivacyPolicy">Kebijakan Privasi</a></p>
          <p>© 2018. PT Rekacipta Teknologi Indonesia.
          <br>rakoon.id</p>
        </div>
      </div>
     
    </div>

    <div class="col-md-6 col-md-offset-3 footer-content">
      <img  class="img-footer" src="<?php echo base_url(); ?>themes/admin/img/footer.png">
    </div>

 

    </div> <!-- /container -->
 


    <!-- MODAL UNTUK REGISTER -->
    <div class="modal modal-default fade" id="detailBantuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
      <div class="modal-dialog">
         <?php
          echo form_open_multipart('psb/sign_up_save/'.$institution_id.'/'.$psb_id.'','class="form-horizontal" role="form"');
        ?> 
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-key"></i>&nbsp;Register</h4>
            </div>
             <div class="modal-body">
                <div class="box-title text-register-title"><strong>Silahkan isi data awal pendaftaran dengan benar</strong></div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Lengkap</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Nama Lenkap" name="fullname" >
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-3 control-label">NIK</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="213181XXXX" name="nik" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Email</label>
                  <div class="col-sm-9">
                    <input type="email" class="form-control" placeholder="example@domain.com" name="username" >
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label">password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" placeholder="password" name="pwd1" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">retype password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" placeholder="re-type password" name="pwd2" >
                  </div>
                </div>
             </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-success-o pull-left" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-success">Simpan</button>
            </div>
          
        </div><!-- /.modal-content -->
         <?php echo form_close(); ?> 
      </div>
    </div>
    <!-- END MODAL ASAL SEKOLAH-->


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

    <!-- MODAL DIALOG PRIVACY POLICY -->
    <div class="modal modal-default fade" id="dialogPrivacyPolicy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
           
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="print-status"><i class="fa fa-info-circle"></i>&nbsp;Kebijakan Privasi</h4>
          </div>
          <div class="modal-body">
            <p id="print-message">
                 <h4 class="text-center">KEBIJAKAN PRIVASI <br>
                PT. REKACIPTA TEKNOLOGI INDONESIA
                </h4>
                
                <ol>
                <strong><u>PENDAHULUAN</u></strong>
                <li style="text-align: justify;">
                  Privasi Anda sangat penting bagi kami PT. REKACIPTA TEKNOLOGI INDONESIA (selanjutnya disebut RAKOON) adalah penyedia STEPA, SKEEP, LOTUS, SMART dan solusi manajemen berbasis web lainnya. Kebijakan privasi ini berlaku untuk situs web dan produk yang disediakan oleh dan atau terkait dengan RAKOON. Kami berharap bahwa dengan mengambil beberapa menit untuk membaca Kebijakan Privasi kami, Anda akan memiliki pemahaman yang lebih baik tentang apa yang kami lakukan dengan informasi yang Anda berikan kepada kami serta bagaimana kami menjaganya baik secara pribadi maupun mengamankannya.
                </li>
                <li style="text-align: justify;">
                Terkadang, RAKOON akan mengumpulkan informasi pribadi tertentu tentang pelanggan dan pengunjung ke situs web yang dibuat oleh kami. Informasi tersebut akan mencakup data pribadi yang dapat diidentifikasi, serta informasi pribadi yang tidak dapat diidentifikasi. Informasi pribadi yang dapat diidentifikasi akan dikumpulkan saat Anda menandatangani kontrak kerjasama untuk sebuah pelayanan dengan kami, atau menggunakan situs web kami untuk layanan transaksi atau berlangganan jasa. Informasi yang tidak dapat diidentifikasi dikumpulkan secara otomatis saat Anda mengunjungi situs web kami, dan disimpan untuk digunakan di sistem kami.
                </li >
                <li style="text-align: justify;">
                Tujuan dari kebijakan privasi ini adalah untuk menjelaskan kepada pelanggan jenis informasi apa yang akan kami kumpulkan dan bagaimana informasi itu digunakan. Dalam kebanyakan kasus, kami mengumpulkan informasi ini untuk memastikan integritas jaringan dan kami terus memberi Anda konten yang paling relevan dan layanan terbaik yang sesuai dengan kebutuhan Anda. Dalam beberapa kasus, kami diminta oleh undang-undang untuk mengumpulkan informasi pribadi tentang pelanggan. Kecuali jika undang-undang tersebut mensyaratkan sebaliknya, kami berusaha melindungi kerahasiaan data tersebut. 
                </li>
                <br>
                <strong><u>KERAHASIAAN</u></strong>
                <li style="text-align: justify;">
                RAKOON menghormati privasi pelanggan dan privasi orang-orang yang mengakses situs kami, atau aplikasi layanan yang kami sediakan. Kami berusaha melindungi kerahasiaan pelanggan dan pengguna layanan kami termasuk semua informasi pribadi yang diberikan dalam perjalanan kontrak berlangganan dengan kami untuk sebuah layanan. Kami tidak menjual informasi pribadi Anda kepada pihak ketiga untuk tujuan komersial atau pemasaran. 
                </li>
                <br>
                <strong><u>KOLEKSI DATA PRIBADI</u></strong>
                <li style="text-align: justify;">
                Klien RAKOON, termasuk namun tidak terbatas pada sekolah, perguruan tinggi, dan bisnis, pada umumnya akan mengumpulkan informasi pribadi mengenai staf, siswa, keluarga, dan pihak terkait. Informasi ini mungkin termasuk, namun tidak terbatas pada, ketenagakerjaan, identifikasi pajak,, informasi keuangan, kontak darurat, medis, asuransi, akademik, perilaku, dan demografi. Adalah tanggung jawab klien RAKOON untuk memanfaatkan layanan yang diberikan oleh RAKOON dengan cara melindungi privasi, dan mematuhi peraturan pemerintah.
                </li>

                <li style="text-align: justify;">
                RAKOON mengumpulkan data pribadi tentang pengguna kami saat Anda mengunjungi situs web yang dihosting oleh kami; mengajukan percobaan gratis untuk produk dan layanan kami; meminta kami untuk menghubungi Anda, dll, dan melalui penggunaan teknologi cookie.
                <i style="color: #E87E04; font-size: 12px;">[Kuki adalah file data yang ada pada hardisk komputer Anda. Cookie ditempatkan di sana oleh sebuah
                server web jarak jauh yang pernah Anda kunjungi menggunakan browser seperti Netscape atau Internet
                Penjelajah. Ini digunakan untuk secara unik mengidentifikasi Anda selama interaksi web dengan situs web dan
                berisi parameter data yang memungkinkan server HTML jauh untuk menyimpan catatan siapa
                Anda dan tindakan apa yang Anda ambil di situs web jarak jauh. Anda memiliki pilihan untuk menonaktifkan
                Fungsi cookie di browser Anda, namun akan dibatasi untuk mengakses banyak situs sebagai
                hasil.]</i></li>
                <br>
                <strong><u>PENGGUNAAN DATA PRIBADI</u></strong>
                <li style="text-align: justify;">
                RAKOON dapat mencatat situs web yang Anda kunjungi; mengumpulkan alamat IP dan informasi tentang Anda, sistem operasi dan jenis browser yang Anda gunakan untuk keperluan, administrasi jaringan / sistem, dan untuk mengaudit penggunaan situs kami.
                8.  Setiap informasi yang dikumpulkan RAKOON dari Anda melalui korespondensi dengan kami, baik via e-mail, telepon atau dengan surat tertulis, hanya akan digunakan untuk menangani masalah masalah yang terangkum dalam korespondensi. untuk memastikan layanan pelanggan, informasi pribadi Anda hanya akan ada diungkapkan sampai pada titik yang diperlukan untuk menjawab pertanyaan atau masalah Anda, dan sebaliknya dirahasiakan.</li>
                <br>
                <strong><u>RUANG PUBLIK</u></strong>
                <li style="text-align: justify;">
                Informasi apa pun yang diungkapkan pelanggan di ruang publik, termasuk di dalam papan buletin, artikel berita, chat room atau situs Anda, dan tersedia kepada orang lain yang mengunjungi tempat itu. RAKOON tidak dapat melindungi informasi apapun yang diungkapkan dalam situs tersebut.
                </li>
                <br>
                <strong><u>AKSES KE INFORMASI PELANGGAN</u></strong>
                <li style="text-align: justify;">
                Tujuan utama RAKOON dalam mengumpulkan informasi pribadi dari pelanggan adalah membantu pelanggan kami dalam mengelola informasi yang mereka berikan saat memanfaatkan layanan kami produk dan layanan. Kami selalu menjaga kerahasiaan informasi diberikan kepada kami oleh klien kami dan terikat oleh standar profesional kami untuk melanjutkan untuk menjaga aspek vital dari hubungan profesional kita.<br>
                <br>
                Individu berikut mungkin memiliki akses ke beberapa atau semua informasi Anda:
                <label>Karyawan Perusahaan/Guru/Orangtua/civitas academica:</label><br>Karyawan Perusahaan/Guru/Orangtua/civitas academica yang membutuhkan informasi tersebut untuk menyimpulkan sebuah transaksi atau memberikan dukungan teknis dan atau menerima sebagian atau seluruh informasi Anda.<br> 
                <label>Penyedia layanan:</label><br>Terkadang, perusahaan jasa mungkin memerlukan akses terhadap informasi tertentu dalam database dan server kami. Sebagai contoh. konsultan yang harus memiliki akses catatan klien tertentu untuk meningkatkan efisiensi pengolahan data kami. sistem Informasi apa pun yang perlu diungkapkan untuk tujuan bisnis apa pun akan dianggap rahasia dan tidak digunakan untuk tujuan selain yang spesifik kebutuhan bisnis Kebijakan kerahasiaan bisnis yang dipahami dengan baik itu akan terjadi diperkuat sesuai kesepakatan kontrak dengan penyedia layanan akses ke data Anda
                </li>
                <br>
                <strong>RESERVASI HAK</strong>
                <li style="text-align: justify;"> RAKOON selanjutnya berhak berbagi informasi dengan penegak hukum menyelidiki atau mencegah kegiatan ilegal yang dilakukan melalui jaringan dan atau website,maupun aplikasi kami.
                </li>
                <li  style="text-align: justify;">RAKOON berhak memantau lalu lintas pengguna dan jaringan untuk tujuan keamanan situs dan aplikasi serta mencegah upaya tindakan tidak sah untuk mengutak-atik situs dan aplikasi kami yang menyebabkan kerusakan properti kami
                </li>
                <li  style="text-align: justify;">
                RAKOON berhak melakukan perubahan terhadap kebijakan privasi ini atau memperbaruinya. Revisi terakhir akan diposkan secara publik di situs web RAKOON. Pelanggan dan pengunjung situs tanggung jawab untuk memastikan bahwa mereka telah membaca perubahan atau update kebijakan privasi terbaru
                </li>

                </ol>
            </p>
       
          </div>

          <div class="modal-footer">
              <button  class="btn btn-success" data-dismiss="modal" >Selesai</button>
          </div>
        </div>
        </div>
    </div>
    <!-- END MODAL DIALOG PRIVACY POLICY-->


    <!-- MODAL DIALOG TERM CONDITION -->
    <div class="modal modal-default fade" id="dialogTermCondition" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
           
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="print-status"><i class="fa fa-info-circle"></i>&nbsp;Syarat &amp; Ketentuan</h4>
          </div>
          <div class="modal-body">
            <p id="print-message">
                <strong>Nulla sit amet arcu sit amet ante porta ultricies in at libero.</strong>
                 <p>Cras magna urna, posuere at tempus lobortis, dignissim a turpis. Cras at dignissim est. Pellentesque maximus, turpis at egestas commodo, nisi neque dictum dui, sit amet tempus nibh justo vehicula lorem. Proin ac blandit velit. Sed sollicitudin mattis eros, eget vulputate nisl laoreet non. Nullam imperdiet nibh vel pellentesque egestas. Fusce nec rhoncus magna. Donec id sapien ultricies purus posuere porttitor. Quisque placerat lectus quis commodo posuere. Nulla facilisi.</p>
                 <strong>Ut vitae fermentum odio.</strong> 
                 <p>Donec diam turpis, condimentum sed euismod sed, 
                 sollicitudin vitae velit. Morbi nisi nibh, posuere quis erat et, iaculis lobortis lacus. Aenean at dolor fermentum, placerat augue eget, tristique ipsum. Nulla neque sapien, vulputate et mauris vitae, pretium consectetur lectus. Ut cursus venenatis nibh, sit amet auctor dolor congue et. Fusce a odio diam. In commodo suscipit tellus sed tristique. Duis quam velit, ornare at erat eget, accumsan scelerisque metus. Donec id sapien ultricies purus posuere porttitor. Quisque placerat lectus quis commodo posuere. Nulla facilisi. Ut vitae fermentum odio. Donec diam turpis, condimentum sed euismod sed, sollicitudin vitae velit.</p>

                <strong>Morbi nisi nibh, posuere quis erat et, iaculis lobortis lacus.</strong> 
                <p>Aenean at dolor fermentum, placerat augue eget, tristique ipsum. Nulla neque sapien, vulputate et mauris vitae, pretium consectetur lectus. Ut cursus venenatis nibh, sit amet auctor dolor congue et. Fusce a odio diam. In commodo suscipit tellus sed tristique. Duis quam velit, ornare at erat eget, accumsan scelerisque metus. Donec pulvinar massa lectus, sed lacinia elit congue vel. Integer risus ex, pulvinar et pellentesque ac, eleifend et dui. Etiam a gravida tellus. Fusce et urna magna. Ut vulputate velit in quam porta, non lacinia ex aliquet. Proin sem velit, convallis eget finibus quis, vulputate at purus. Maecenas tincidunt nisl in lacinia tempor. Maecenas quis sem eget leo laoreet tincidunt.</p>
            </p>
       
          </div>

          <div class="modal-footer">
              <button  class="btn btn-success" data-dismiss="modal" >Selesai</button>
          </div>
        </div>
        </div>
    </div>
    <!-- END MODAL DIALOG TERN CONDITION-->

    <!-- MODAL DIALOG HUBUNGI MSG -->
    <div class="modal modal-default fade" id="dialogContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
           
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="print-status"><i class="fa fa-phone"></i>&nbsp;Hubungi Kami</h4>
          </div>
          <div class="modal-body">
                 <div style="text-align: center;">
                 <img src="<?php echo base_url(); ?>rakoonlogo.png"><br>
                 <span class="text-brand">RAKOON</span><br>
                 <span class="text-tagline">make technology work</span>
                 <br>
                 <br>
                  </div>
                 <p>Untuk mendapatkan informasi lebih lanjut, Anda bisa menghubungi langsung ke nomor yang tersedia atau mengirimkan pesan dengan form yang ada pada Kirim Pesan</p>
                 <strong>PT Rekacipta Teknologi Indonesia.</strong>
                 <table>
                    <tr>
                      <td valign="top">Alamat </td>
                      <td valign="top">&nbsp;:&nbsp;</td>
                      <td>Ruko Kelapa Dua Residence No. K10, Jalan Tugu Raya, Cimanggis Depok 16541</td>
                   </tr>
                   <!-- <tr>
                      <td>Telepon </td>
                      <td>&nbsp;:&nbsp;</td>
                      <td>-</td>
                   </tr>
                   <tr>
                      <td>Fax </td>
                      <td>&nbsp;:&nbsp;</td>
                      <td>-</td>
                   </tr> -->
                   <tr>
                      <td>Email </td>
                      <td>&nbsp;:&nbsp;</td>
                      <td>info@rakoon.id</td>
                   </tr>

                 </table>
               
       
          </div>

          <div class="modal-footer">
              <button  class="btn btn-success" data-dismiss="modal" >Selesai</button>
          </div>
        </div>
        </div>
    </div>
    <!-- END MODAL DIALOG HIBUNGI MSG-->



	<!-- JavaScript -->
   <script src="<?php echo base_url(); ?>themes/admin/js/jquery-1.10.2.js"></script>
   <script src="<?php echo base_url(); ?>themes/admin/js/bootstrap.js"></script>
	 <script src="<?php echo base_url(); ?>themes/admin/js/bstretch/jquery/jquery.js"></script>
   <!-- <script src="<?php echo base_url(); ?>themes/admin/js/bstretch/jquery.backstretch.js"></script> -->

  </body>
</html>