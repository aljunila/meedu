<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="STEPA- Sistem Pendidikan dan Administrasi Sekolah" />
	  <meta name="keywords" content="pmb, ppbd, administrasi,sekolah" />
    <meta name="author" content="rakoon.id">
    <title>STEPA - Sistem Pendidikan dan Administrasi</title>
	  <link rel="shortcut icon" href="<?php echo base_url(); ?>logo.png" type="image/x-icon" />
    <link href="<?php echo base_url(); ?>themes/admin/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>themes/admin/css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datepicker/datepicker3.css">
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">

     .box-shadow{
      padding: 16px;
      border:1px solid #dddddd;
      border-radius: 4px;
      background-color: #fff;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    
    a.doc-white{ color: #fff; }
    .text-white{ color: #fff; }

    a.font-adjust{
      font-size: 16px;
    }
    .text-register-title{
      text-align: center;
      margin-bottom: 20px;

    }
    
      
      .brand-title-psb{
        font-size: 24px;
        font-weight: 800;
      }

      .text-green{
        color: #39c18f;
        font-size: 22px;
        font-weight: 800;
      }

      .text-calas{
        color: #39c18f;
        font-weight: 800;
      }
      .bs-slider{
          overflow: hidden;
          max-height: 700px;
          position: relative;
          background: #ffffff;
      }
      .bs-slider:hover {
          cursor: -moz-grab;
          cursor: -webkit-grab;
      }
      .bs-slider:active {
          cursor: -moz-grabbing;
          cursor: -webkit-grabbing;
      }
      .bs-slider .bs-slider-overlay {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          /*background-color: rgba(0, 0, 0, 0.40);*/
      }
      .bs-slider > .carousel-inner > .item > img,
      .bs-slider > .carousel-inner > .item > a > img {
          margin: auto;
          width: 100% !important;
      }

      /********************
      *****Slide effect
      **********************/

      .fade {
          opacity: 1;
      }
      .fade .item {
          top: 0;
          z-index: 1;
          opacity: 0;
          width: 100%;
          position: absolute;
          left: 0 !important;
          display: block !important;
          -webkit-transition: opacity ease-in-out 1s;
          -moz-transition: opacity ease-in-out 1s;
          -ms-transition: opacity ease-in-out 1s;
          -o-transition: opacity ease-in-out 1s;
          transition: opacity ease-in-out 1s;
      }
      .fade .item:first-child {
          top: auto;
          position: relative;
      }
      .fade .item.active {
          opacity: 1;
          z-index: 2;
          -webkit-transition: opacity ease-in-out 1s;
          -moz-transition: opacity ease-in-out 1s;
          -ms-transition: opacity ease-in-out 1s;
          -o-transition: opacity ease-in-out 1s;
          transition: opacity ease-in-out 1s;
      }






      /*---------- LEFT/RIGHT ROUND CONTROL ----------*/
      .control-round .carousel-control {
          top: 47%;
          opacity: 0;
          width: 45px;
          height: 45px;
          z-index: 100;
          color: #000000;
          display: block;
          font-size: 24px;
          cursor: pointer;
          overflow: hidden;
          line-height: 43px;
          text-shadow: none;
          position: absolute;
          font-weight: normal;
          background: transparent;
          -webkit-border-radius: 100px;
          border-radius: 100px;
      }
      .control-round:hover .carousel-control{
          opacity: 1;
      }
      .control-round .carousel-control.left {
          left: 1%;
      }
      .control-round .carousel-control.right {
          right: 1%;
      }
      .control-round .carousel-control.left:hover,
      .control-round .carousel-control.right:hover{
          color: #fdfdfd;
          background: rgba(0, 0, 0, 0.5);
          border: 0px transparent;
      }
      .control-round .carousel-control.left>span:nth-child(1){
          left: 45%;
      }
      .control-round .carousel-control.right>span:nth-child(1){
          right: 45%;
      }





      /*---------- INDICATORS CONTROL ----------*/
      .indicators-line > .carousel-indicators{
          right: 45%;
          bottom: 3%;
          left: auto;
          width: 90%;
          height: 20px;
          font-size: 0;
          overflow-x: auto;
          text-align: right;
          overflow-y: hidden;
          padding-left: 10px;
          padding-right: 10px;
          padding-top: 1px;
          white-space: nowrap;
      }
      .indicators-line > .carousel-indicators li{
          padding: 0;
          width: 15px;
          height: 15px;
          border: 1px solid rgb(158, 158, 158);
          text-indent: 0;
          overflow: hidden;
          text-align: left;
          position: relative;
          letter-spacing: 1px;
          background: rgb(158, 158, 158);
          -webkit-font-smoothing: antialiased;
          -webkit-border-radius: 50%;
          border-radius: 50%;
          margin-right: 5px;
          -webkit-transition: all 0.5s cubic-bezier(0.22,0.81,0.01,0.99);
          transition: all 0.5s cubic-bezier(0.22,0.81,0.01,0.99);
          z-index: 10;
          cursor:pointer;
      }
      .indicators-line > .carousel-indicators li:last-child{
          margin-right: 0;
      }
      .indicators-line > .carousel-indicators .active{
          margin: 1px 5px 1px 1px;
          box-shadow: 0 0 0 2px #fff;
          background-color: transparent;
          position: relative;
          -webkit-transition: box-shadow 0.3s ease;
          -moz-transition: box-shadow 0.3s ease;
          -o-transition: box-shadow 0.3s ease;
          transition: box-shadow 0.3s ease;
          -webkit-transition: background-color 0.3s ease;
          -moz-transition: background-color 0.3s ease;
          -o-transition: background-color 0.3s ease;
          transition: background-color 0.3s ease;

      }
      .indicators-line > .carousel-indicators .active:before{
          transform: scale(0.5);
          background-color: #fff;
          content:"";
          position: absolute;
          left:-1px;
          top:-1px;
          width:15px;
          height: 15px;
          border-radius: 50%;
          -webkit-transition: background-color 0.3s ease;
          -moz-transition: background-color 0.3s ease;
          -o-transition: background-color 0.3s ease;
          transition: background-color 0.3s ease;
      }



      /*---------- SLIDE CAPTION ----------*/
      .slide_style_left {
          text-align: left !important;
      }
      .slide_style_right {
          text-align: right !important;
      }
      .slide_style_center {
          text-align: center !important;
      }

      .slide-text {
          left: 0;
          top:50%;
          right: 0;
          margin: auto;
          padding: 10px;
          position: absolute;
          text-align: left;
          padding: 10px 85px;
          
      }

      .slide-text > h3 {
          
          padding: 0;
          color: #000000;
          font-style: normal;
          
          letter-spacing: 1px;
          display: inline-block;
          -webkit-animation-delay: 0.7s;
          animation-delay: 0.7s;
      }
      .slide-text > p {
          padding: 0;
          background-color: 
          color: #000000;
          font-size: 20px;
          line-height: 24px;
          font-weight: 300;
          margin-bottom: 40px;
          letter-spacing: 1px;
          -webkit-animation-delay: 1.1s;
          animation-delay: 1.1s;
      }
      .slide-text > a.btn-default{
          color: #000;
          font-weight: 400;
          font-size: 13px;
          line-height: 15px;
          margin-right: 10px;
          text-align: center;
          padding: 17px 30px;
          white-space: nowrap;
          letter-spacing: 1px;
          display: inline-block;
          border: none;
          text-transform: uppercase;
          -webkit-animation-delay: 2s;
          animation-delay: 2s;
          -webkit-transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
          transition: background 0.3s ease-in-out, color 0.3s ease-in-out;

      }
      .slide-text > a.btn-primary{
          color: #ffffff;
          cursor: pointer;
          font-weight: 400;
          font-size: 13px;
          line-height: 15px;
          margin-left: 10px;
          text-align: center;
          padding: 17px 30px;
          white-space: nowrap;
          letter-spacing: 1px;
          background: #00bfff;
          display: inline-block;
          text-decoration: none;
          text-transform: uppercase;
          border: none;
          -webkit-animation-delay: 2s;
          animation-delay: 2s;
          -webkit-transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
          transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
      }
      .slide-text > a:hover,
      .slide-text > a:active {
          color: #ffffff;
          background: #222222;
          -webkit-transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
          transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
      }

      span.highlight-text{
        color: #ffffff;
        background-color: rgba(0, 0, 0, 0.40);
      }

      h3.text-white{
        color: #ffffff;
      }



      /*------------------------------------------------------*/
      /* RESPONSIVE
      /*------------------------------------------------------*/

      @media (max-width: 991px) {
          .slide-text h1 {
              font-size: 40px;
              line-height: 50px;
              margin-bottom: 20px;
          }
          .slide-text > p {

              font-size: 18px;
          }
      }


      /*---------- MEDIA 480px ----------*/
      @media  (max-width: 768px) {
          .slide-text {
              padding: 10px 50px;
          }
          .slide-text h1 {
              font-size: 30px;
              line-height: 40px;
              margin-bottom: 10px;
          }
          .slide-text > p {
              font-size: 14px;
              line-height: 20px;
              margin-bottom: 20px;
          }
          .control-round .carousel-control{
              display: none;
          }

      }
      @media  (max-width: 480px) {
          .slide-text {
              padding: 10px 30px;
          }
          .slide-text h1 {
              font-size: 20px;
              line-height: 25px;
              margin-bottom: 5px;
          }
          .slide-text > p {
              font-size: 12px;
              line-height: 18px;
              margin-bottom: 10px;
          }
          .slide-text > a.btn-default, 
          .slide-text > a.btn-primary {
              font-size: 10px;
              line-height: 10px;
              margin-right: 10px;
              text-align: center;
              padding: 10px 15px;
          }
          .indicators-line > .carousel-indicators{
              display: none;
          }

      }
    </style>
  </head>

  <body>
    
    <div class="container">
       <p id="print-data">
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
    <!-- END MODAL DIALOG HIBUNGI MSG-->

	<!-- JavaScript -->
   <script src="<?php echo base_url(); ?>themes/admin/js/jquery-1.10.2.js"></script>
   <script src="<?php echo base_url(); ?>themes/admin/js/bootstrap.js"></script>
	 <script src="<?php echo base_url(); ?>themes/admin/js/bstretch/jquery/jquery.js"></script>
   <script src="<?php echo base_url(); ?>themesAdmin/plugins/datepicker/bootstrap-datepicker.js"></script>
   <!-- <script src="<?php echo base_url(); ?>themes/admin/js/bstretch/jquery.backstretch.js"></script> -->

    <script>
        $('#p_dob').datepicker({
          autoclose: true,
          format: 'dd/mm/yyyy'
        });
        $(function () {
          var messages = [],
              index = 0;
          messages.push('<span class="text-">Pendidikan</span>');
          messages.push('<span class="text-">Administrasi Sekolah</span>');
          messages.push('<span class="text-">Pengelolaan Resource</span>');

          function cycle() {
              $('#some-id').hide().html(messages[index]).fadeIn('slow');
              index++;

              if (index === messages.length) {
                  index = 0;
              }

              setTimeout(cycle, 5000);
          }

          cycle();
      });
        $.backstretch([
          "<?php echo base_url(); ?>themes/image/bg sinau.jpg",
          "<?php echo base_url(); ?>themes/image/bg02.jpg",
          "<?php echo base_url(); ?>themes/image/bg03.jpg"
        ], {
            fade: 750,
            duration: 4000
        });

        function ajaxRegister(){
          
          // $('#detailRegister').modal('hide');
          $('#detailRegister').modal('hide');
          loading_show(true);
          var fullname = document.getElementById("p_fullname").value;
          var nik = document.getElementById("p_nik").value;
          var dob = document.getElementById("p_dob").value;
          var phone = document.getElementById("p_phone").value;
          var username = document.getElementById("p_username").value;
          var level_masuk_id= document.getElementById("level_masuk_id").value;
          var pwd1= document.getElementById("p_pwd1").value;
          var pwd2= document.getElementById("p_pwd2").value;
          var institution_id =  document.getElementById("institution_id").value;
          var psb_id =  document.getElementById("psb_id").value;
          // alert(level_masuk_id);
          $.ajax({
            type: "POST",
            url: "<?php echo site_url('usr_msg/register_user')?>",
            data: { 
              fullname : fullname,
              nik :nik,
              dob :dob,
              phone :phone,
              username : username,
              pwd1 : pwd1,
              pwd2 : pwd2,
              institution_id : institution_id,
              level_masuk_id : level_masuk_id,
              psb_id : psb_id,
                 },
            success: function(html){

              var jsontext   = html;
              // alert(jsontext);
              

              var getData = JSON.parse(jsontext);
              $("#print-status").html(getData.status);
              $("#print-message").html(getData.msg);
              loading_show(false);
              $('#dialogAfterMsg').modal('show');
            }
          }); 
        }

      function loading_show(a){
        if(a){
          $('#loading-overlay').show();
        }else{
           $('#loading-overlay').hide();
        }
      }
        
    </script>
  </body>
</html>

