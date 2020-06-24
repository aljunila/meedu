<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="STEPA - Sistem Pendidikan dan Administrasi" />
    <meta name="keywords" content="stepa, system, pendidikan, sistem pendidikan, keuangan, kesiswaan, kurikulum" />
    <meta name="author" content="http://rakoon.id">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>STEPA - Sistem Pendidikan dan Administrasi Sekolah</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>logo.png" type="image/x-icon" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/bootstrap/css/bootstrap.css">
   
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/dist/css/font-awesome/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datepicker2/css/datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datetimepicker/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/dist/css/skins/_all-skins.css"> 
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/dist/css/skins/skin-green.min.css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <!-- jQuery 2.1.4 -->
  
</head>
<body>
<div>

<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datatables/dataTables.bootstrap.css">
<style type="text/css">
	.text-small{
		font-size: 12px;
		font-weight: 400;
	}
	.text-title{
		font-weight: 800;
	}

</style>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 class="box-title text-title"><?php echo 'Kelas: '.$course->name;?>
    <span class="text-small">/ <?php echo $course->tingkat_name;?></span> 
    <span class="text-small">/ TA: <?php echo $course->ta_title .' '.$course->start_ta.'-'.$course->end_ta;?></span>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">

      <div>
      
      </div>

    </div>
     <div class="col-md-6" style="display: none;" id="div-soc">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title text-title">Siswa belum terdaftar
          </h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div id="print-soc"></div>
          
        </div><!-- /.box-body -->
        <div class="box-footer clearfix text-center">
          <button class="btn btn-danger btn-block" onClick="ajaxFinishAdd(<?php echo $course->id; ?>)"> Selesai</button>
        </div><!-- /.box-footer -->
      </div><!-- /.box -->
    </div><!-- /.col -->

     

     <div id="modal-status">
    </div>      
    
 
    <div class="col-md-12">
      <div id="row" >

       <div class="col-md-2 ">
           <select name="tr" class="form-control" id="type_range">
              <option value = "fnofil">-- tanpa filter --</option>
              <option value = "fsemester">Semester</option>
              <option value = "fdate">Harian</option>
              <option value = "fperiode">Periode</option>
           </select>
        </div>
        <div class="col-md-2" id="semester_panel">
          <select name="semester_id" class="form-control" id="semester_id">
              <option value="1">-- Semua --</option>
              <option value="1">Semester Ganjil</option>
              <option value="2">Semester Genap</option>
          </select>
        </div> 
        <div class="col-md-2 " id="datepicker1_panel">
            <input type="text" class="form-control" name="dt1" id="datepicker1" placeholder="tanggal">
        </div>
         <div class="col-md-2 " id = "datepicker2_panel">
            <input type="text" class="form-control" name="dt2" id="datepicker2" placeholder="tanggal akhir">
        </div>

      </div>
      
    </div>
    <div class="col-sm-12">
      <br>
      <div class="col-sm-12"><button class="btn btn-success" onClick="prepareEditPenilaianSiswa(1)"> Tambah / Ubah  </button>
      </div></div>

    <div class="col-sm-12">
      <br>
      <div id="table-data-presensi">
     
      </div>
      <div class="overlay text-center" id="loading-presensi" style="display: none;">
        <i class="fa fa-refresh fa-spin"></i>
        <span  >Memuat data...</span>
      </div>
    </div><!-- /.col -->



    <div class="col-md-12" id ="div-sic">
      <div class="modal modal-warning fade" id="deleteMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt-alt"></i> Hapus</h4>
            </div>
            <div class="modal-body">
              <p class="error-text">&nbsp;&nbsp;&nbsp;Apakah anda yakin untuk menghapus data?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
              <a id="delData" href="#"><button type="button" class="btn btn-outline">Delete</button></a>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>


       <div class="modal modal-warning fade" id="deleteMessageAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt-alt"></i> Hapus</h4>
            </div>
            <div class="modal-body">
             
              <p class="error-text">&nbsp;&nbsp;&nbsp;Apakah anda yakin untuk menghapus data?</p>
               <div id="a_profile_id" style="display: none;"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
             <button type="button" class="btn btn-outline" onClick="ajaxDeleteStudent(<?php echo $course->id;?>)">Delete</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>


        <div class="modal modal-default fade" id="uploadMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
          <?php echo form_open_multipart('student/import_csv','id="data" class="form-horizontal" role="form"');
              ?>
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel2">Upload CSV Data Siswa</h4>
            </div>

            <div class="modal-body">
              
              <div id="m_file" class="form-group">
                <label class="col-sm-2 control-label">CSV File </label>
                <div class="col-sm-8" style="background:#dddddd; padding: 6px; border-radius: 10px;" >
                  <input id="csv_file" type="file" name="csv_file"/>
                </div>
              </div>
            </div>
            <div class="overlay text-center" id="loading-overlay" style="display: none;">
              <i class="fa fa-refresh fa-spin"></i>
              <span  >Submit data...</span>
            </div>
            <div class="modal-footer" id="modal-footer">
              <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-success" onClick="uploadCsv(<?php echo $course->id;?>)">Upload</button>
            </div>
            <div>

            </div>
            <?php
                echo form_close();
              ?>  
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>


      <div class="modal modal-success fade" id="successCsvUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-check"></i>&nbsp;Success</h4>
            </div>
            <div class="modal-body">
              <p class="error-text">Data telah berhasil diunggah, silahkan tekan tombol selesai untuk menyegarkan halaman</p>
            </div>
            <div class="modal-footer">
              <button type="button" onClick="refresh_page()" class="btn btn-success">Selesai</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>

    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->


  <div class="modal modal-default fade" id="detailNilai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
     <?php echo form_open_multipart('globals/edit_presensi_walikelas','id="form-penilaian" class="form-horizontal" role="form"');
              ?>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>&nbsp;<span id="course_info"></span>/Absensi Siswa</h4>
        </div>
        <div class="modal-body">
           <input type="text" name="id_concat" id="id_concat" style="display: none;" />
           <input type="text" name="enduser_id" id="enduser_id" style="display: none;" />
           <input type="text" name="institution_id" id="institution_id" style="display: none;" />
           <input type="text" name="a_course_id" id="a_course_id" value="<?php echo $course->id;?>" style="display:none;" />
           <div id="filter"  class="row">
            <!--  <div class="col-md-2 ">
                 <select name="a_tr" class="form-control" id="a_type_range">
                    <option value = "fnofil">-- tanpa filter --</option>
                    <option value = "fsemester">Semester</option> 
                    <option value = "fdate">Harian</option>
                    <option value = "fperiode">Periode</option>
                 </select>
              </div>-->
              <div class="col-md-3" id="a_semester_panel">
                <select name="a_semester_id" class="form-control" id="a_semester_id">
                    <option value="1">Semester Ganjil</option>
                    <option value="2">Semester Genap</option>
                </select>
              </div>  
              <div class="col-md-3 " id="a_start_date_panel">
                  <input type="text" class="form-control" name="a_start_date" id="a_start_date" placeholder="tanggal">
              </div>
               <!-- <div class="col-md-2 " id = "a_end_date_panel">
                  <input type="text" class="form-control" name="a_end_date" id="a_end_date" placeholder="tanggal akhir">
              </div> -->
           </div>
           <div id="table-siswa-nilai" ></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </div><!-- /.modal-content -->
       <?php echo form_close();?>  
    </div><!-- /.modal-dialog -->
  </div>


   <div class="modal modal-default fade" id="addSettings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>&nbsp;Tambah Bahasan</h4>
        </div>
        <div class="modal-body">
           <input type="text" name="id_concat" id="id_concat" style="display: none;" />
           <input type="text" name="a_course_id" id="a_course_id" value="<?php echo $course->id;?>" style="display:none;" />
           <div id="filter"  class="row">
           
              <div class="col-md-4" id="select-category-mapel">
              </div>  
              <div class="col-md-4" id="panel-subcategory">
              </div>  
           </div>
           <div id="data-mapel-desc" ></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

   <div class="modal modal-warning fade" id="deleteSettings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt-alt"></i> Hapus</h4>
            </div>
            <div class="modal-body">
             
              <p class="error-text">&nbsp;&nbsp;&nbsp;Apakah anda yakin untuk menghapus data?</p>
               <div id="scoring_pg" style="display: none;"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
             <button type="button" class="btn btn-outline" onClick="ajaxDeleteSetting()">Delete</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>


  <div class="modal modal-default fade" id="profileSiswa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>&nbsp;Profile Siswa</h4>
        </div>
        <div class="modal-body">
           <input type="text" name="id_concat" id="id_concat" style="display: none;" />
           <input type="text" name="a_course_id" id="a_course_id" value="<?php echo $course->id;?>" style="display:none;" />
           <div id="filter"  class="row">
           
              <div class="col-md-4" id="select-category-mapel">
              </div>  
              <div class="col-md-4" id="panel-subcategory">
              </div>  
           </div>
           <div id="detail-murid" ></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Selesai</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


   <div class="modal modal-default fade" id="changeRaport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <?php
          echo form_open_multipart('course/change_pdf_raport','class="form-horizontal" role="form"');
      ?> 
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-photo"></i>&nbsp;Foto Profil</h4>
            <input type="text" class="form-control" name="img" id ="u_img_id" style="display: none;">
            <input type="text" class="form-control" name="id" id ="u_pdf_id" style="display: none;">
            <input type="text" class="form-control" name="ks_id" id ="u_ks_id" style="display: none;">
            <input type="text" class="form-control" name="smt_id" id ="u_smt_id" style="display: none;">
            <input type="text" class="form-control" name="sc_id" id ="u_sc_id" style="display: none;">
            <input type="text" class="form-control" name="kur_id" id ="u_kur_id" style="display: none;">
            <input type="text" class="form-control" name="course_id" id ="u_course_id" style="display: none;">
          </div>
          <div class="modal-body text-center">
           <!--  <p class="error-text">
            <?php if($user->photo_url==''){?>
            <img src="<?php echo base_url(); ?>themesAdmin/dist/img/img2x3.jpg" style="width: 120px; height: 120px;">
            <?php }else{ ?>
            <img src="<?php echo base_url(); ?>data/profile/<?php echo $user->photo_url;?>" style="width: 120 px; height: 120px;">
            <?php } ?>
            </p>
 -->
            <input type="file" class="form-control" name="image" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success-o pull-left" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success" >Selesai</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
       <?php echo form_close(); ?>  
    </div>

     <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Slide File</h4>
          </div>
          <div class="modal-body">
            <div id="pdf_show">
              
            </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-default" >Cancel</button> -->
            <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>

      <div class="modal modal-warning fade" id="deletePdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt-alt"></i> Hapus</h4>
            </div>
            <div class="modal-body">
             
              <p class="error-text">&nbsp;&nbsp;&nbsp;Apakah anda yakin untuk menghapus data?</p>
               <div id="file_id_d" style="display: none;"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
             <button type="button" class="btn btn-outline" onClick="ajaxDeletePdf()">Delete</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>


   <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>themesAdmin/bootstrap/js/bootstrap.min.js"></script>
  <!-- moment -->
  <script src="<?php echo base_url(); ?>themesAdmin/plugins/moment/moment.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/datatables/dataTables.bootstrap.min.js"></script>
      <script src="<?php echo base_url(); ?>themesAdmin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/chartjs/Chart.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>themesAdmin/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>themesAdmin/dist/js/demo.js"></script>
  <!-- datepicker -->
  <script src="<?php echo base_url(); ?>themesAdmin/plugins/datepicker2/js/bootstrap-datepicker.js"></script>
    <!-- datetimepicker -->
  <script src="<?php echo base_url(); ?>themesAdmin/plugins/datetimepicker/bootstrap-datetimepicker.js"></script>
  <!-- ckeditor -->
  <script src="<?php echo base_url(); ?>themesAdmin/plugins/ckeditor/ckeditor.js"></script>

<script>
$( document ).ready(function() {
    $("#datepicker2_panel").hide();
    $("#datepicker1_panel").hide();
    $("#semester_panel").hide();
    $("#panel_thn_id").hide();
    $("#panel_bln_id").hide();
    ajaxPopulate();
   
     $("#datepicker1" ).datepicker({
      changeMonth: true,
      changeYear: true,
       autoclose: true,
      yearRange: "-50:+0",
      format: 'dd-mm-yyyy'
    });
   
    $("#datepicker2" ).datepicker({
      changeMonth: true,
      changeYear: true,
       autoclose: true,
      yearRange: "-50:+0",
      format: 'dd-mm-yyyy'
    });

     $("#a_start_date" ).datepicker({
      changeMonth: true,
      changeYear: true,
      autoclose: true,
      yearRange: "-50:+0",
      format: 'dd-mm-yyyy'
    }).datepicker("setDate", "0");



     $("#date_absen" ).datepicker({
      changeMonth: true,
      changeYear: true,
       autoclose: true,
      yearRange: "-50:+0",
      format: 'dd-mm-yyyy'
    });

      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1; 
      var yyyy = today.getFullYear();

      if(dd<10) {
          dd = '0'+dd
      } 

      if(mm<10) {
          mm = mm
      } 


});

  $('#semester_id').on('change', function () {
      ajaxPopulate();
  });

 $('#type_range').on('change', function () {

      if($('#type_range').val()=='fdate'){
        $("#datepicker2_panel").hide();
        $("#datepicker1_panel").show();
        $("#semester_panel").hide();

      }else if($('#type_range').val()=='fperiode'){
        $("#datepicker2_panel").show();
        $("#datepicker1_panel").show();
        $("#semester_panel").hide();
      }else if($('#type_range').val()=='fsemester'){
        $("#datepicker2_panel").hide();
        $("#datepicker1_panel").hide();
        $("#semester_panel").show();
      }else{
        $("#datepicker2_panel").hide();
        $("#datepicker1_panel").hide();
        $("#semester_panel").hide();
      }

      ajaxPopulate();
  });



 
 $('#datepicker1').on('change', function () {
      ajaxPopulate();
  });

 $('#datepicker2').on('change', function () {
      ajaxPopulate();
  });

 $('#a_start_date').on('change', function () {
      ajaxPreparePresensi();
  });

 $('#raport_smt_id').on('change', function () {
      ajaxPopulateSiswaNonTK();
  });
 $('#raport_sc_id').on('change', function () {
      ajaxPopulateSiswaNonTK();
  });
 $('#raport_kur_id').on('change', function () {
      ajaxPopulateSiswaNonTK();
  });




// SETTINGS TK
$('#tk_semester_id').on('change', function () {
    ajaxPopulateSettingNilaiTK();
});
$('#tk_sc_id').on('change', function () {
    ajaxPopulateSettingNilaiTK();
});



function ajaxPopulateSettingNilaiTK(){
  var semester_id = $('#tk_semester_id').val();
  var sc_id = $('#tk_sc_id').val();
   var course_id = '<?php echo $course->id; ?>';

  loading_presensi(true);
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('course/populate_setting_nilai_tk_walikelas')?>",
    data: { 
      semester_id : semester_id,
      sc_id : sc_id,
      course_id : course_id,
     },
    success: function(html){
      // alert(html);
      var getData = JSON.parse(html);
      $("#table-data-setting-tk").html(getData.siswa_table);
      loading_presensi(false);
    }
  });
}

function prepareAddSettings(){
  $("#addSettings").modal('show');
  populate_categories();
}

function populate_categories(){
  var selected_id='';
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('course/populate_categories')?>",
    data: { 
      selected_id :selected_id
         },
    success: function(html){
      // console.log(html);
      // alert(html);
      var jsontext   = html;
      var getData = JSON.parse(jsontext);
      $("#select-category-mapel").html(getData.select_opt);
      $('#m_category').on('change', function () {
          populate_sub_categories();
      });
    }
  }); 
}

function populate_sub_categories(){
  var selected_id= $('#m_category').val();
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('course/populate_sub_categories')?>",
    data: { 
      id_category :selected_id
         },
    success: function(html){
     
      console.log(html);
      var jsontext   = html;
      var getData = JSON.parse(jsontext);
       // alert(html);
      $("#panel-subcategory").html(getData.select_opt);
      $('#m_category_sub').on('change', function () {
          populate_mapel_description();
      });
      populate_mapel_description();
    }
  }); 
}

function populate_mapel_description(){
  var selected_id= $('#m_category').val();
  var selected_sub_id= $('#m_category_sub').val();
  var course_id = '<?php echo $course->id; ?>';
  var semester_id = $('#tk_semester_id').val();
  var sc_id = $('#tk_sc_id').val();
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('course/populate_mapel_description')?>",
    data: { 
      category :selected_id,
      sub_category :selected_sub_id,
      course_id :course_id,
      sc_id :sc_id,
      semester_id :semester_id,
         },
    success: function(html){
     
      // console.log(html);
      var jsontext   = html;
      var getData = JSON.parse(jsontext);
       // alert(html);
      $("#data-mapel-desc").html(getData.mapel_table);
      
    }
  }); 
}

function ajaxAddSettingMapel(id){
  var selected_id= $('#m_category').val();
  var selected_sub_id= $('#m_category_sub').val();
  var course_id = '<?php echo $course->id; ?>';
  var semester_id = $('#tk_semester_id').val();
  var sc_id = $('#tk_sc_id').val();
  var subject_id = id;

  $.ajax({
    type: "POST",
    url: "<?php echo site_url('course/add_setting_nilai_tk_ajax')?>",
    data: { 
      category :selected_id,
      sub_category :selected_sub_id,
      course_id :course_id,
      sc_id :sc_id,
      semester_id :semester_id,
      subject_id :subject_id,
         },
    success: function(html){
      var jsontext   = html;
      var getData = JSON.parse(jsontext);
      $("#modal-status").html(getData.alert_modal);
      $('#addSettings').modal('hide');
      ajaxPopulateSettingNilaiTK();
      
    }
  }); 
}

function ajaxPrepareDeleteSetting(id){
  $('#deleteSettings').modal('show');
  document.getElementById("scoring_pg").value = id;
}

function ajaxDeleteSetting(){
  var id= $('#scoring_pg').val();
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('course/delete_setting_nilai_tk_ajax')?>",
    data: { 
        id :id,
         },
    success: function(html){
      var jsontext   = html;
      var getData = JSON.parse(jsontext);
      $("#modal-status").html(getData.alert_modal);
      $('#addSettings').modal('hide');
      ajaxPopulateSettingNilaiTK();
      
    }
  }); 
  $('#deleteSettings').modal('hide');
  // document.getElementById("scoring_pg").value = id;
}



function sendimg(a){
  document.getElementById("delData").href=a.id;
}


function ajaxStudentAdd(profile_id,course_id){
  $.ajax({
  type: "POST",
  url: "<?php echo site_url('course/add_sudent_course')?>",
  data: { 
    course_id : course_id,
    profile_id : profile_id,
   },
  success: function(response)
  {
    ajaxGetPopulatePrepare(course_id);
  }
  });
}

function modalDelete(profile_id,course_id){
   $("#a_profile_id").html(profile_id);
   $("#deleteMessageAdd").modal('show');
}

function ajaxDeleteStudent(course_id){
    var id = $("#a_profile_id").html();
    $.ajax({
    type: "POST",
    url: "<?php echo site_url('course/ajax_student_delete')?>",
    data: { 
      course_id : course_id,
      id : id,
     },
    success: function(response)
    {
      $("#deleteMessageAdd").modal('hide');
      ajaxGetPopulatePrepare(course_id);
    }
    });
}


function ajaxGetPopulatePrepare(id){
  $.ajax({
  type: "POST",
  url: "<?php echo site_url('course/get_view_student_not_assign')?>",
  data: { course_id : id },
  success: function(response)
  {
    var getData = JSON.parse(response);
    $("#print-soc").html(getData.soc);
    $("#print-sic").html(getData.sic);
    $("#div-soc").show();
    $('#div-sic').removeClass('col-md-12').addClass('col-md-6');
    $('#btn-add').hide();
  }
  });
}

function ajaxFinishAdd(id){
  $.ajax({
  type: "POST",
  url: "<?php echo site_url('course/get_view_student')?>",
  data: { course_id : id },
  success: function(response)
  {
    var getData = JSON.parse(response);
    $("#div-soc").hide();
    $("#print-sic").html(getData.sic);
    $('#div-sic').removeClass('col-md-6').addClass('col-md-12');
    $('#btn-add').show();
  }
  });
}


$(function () {
      $("#data-siswa-1").DataTable();
      $('#data-siswa-2').DataTable();
  });


function uploadCsv(course_id){
  // alert(course_id);
  loading_show(true);
  var csv_file = $('#csv_file')[0].files[0];
  var formData = new FormData(this);
  formData.append('csv_file', csv_file);
  formData.append('course_id',course_id);

  $.ajax({
    type:'POST',
    url: '<?php echo site_url('course/upload_csv_student');?>',
    data: formData,
    cache:false,
    contentType: false,
    processData: false,
    success:function(response){
      var jsontext   = response;
      loading_show(false);
      $('#uploadMessage').modal('hide');
      // alert(jsontext);
      var getData = JSON.parse(jsontext);
      $('#successCsvUpload').modal('show');
      // $('#table-upload').html(getData.table);
      // $('#print-upload').show();
      // $('#data-siswa').hide();
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

function loading_presensi(a){
  if(a){
    $('#loading-presensi').show();
  }else{
     $('#loading-presensi').hide();
  }
}


function refresh_page(){
   window.location = "<?php echo site_url('course/view_student_walikelas/'.$course->id) ?>";
}


function ajaxPopulate(){
  loading_presensi(true);
  var type_range = $('#type_range').val();
  var semester_id= $('#semester_id').val();
  var course_id = '<?php echo $course->id; ?>';
  var date_start = $('#datepicker1').val();
  var date_end = $('#datepicker2').val();
  var institution_id= '<?php echo $course->institution_id; ?>';
  var enduser_id= '<?php echo $enduser_id; ?>';
  document.getElementById("institution_id").value = institution_id;
  document.getElementById("enduser_id").value = enduser_id;

  $.ajax({
    type: "POST",
    url: "<?php echo site_url('globals/populate_presensi_walikelas')?>",
    data: { 
      semester_id : semester_id,
      type_range: type_range,
      course_id : course_id,
      date_start : date_start,
      date_end : date_end,
      institution_id : institution_id,
     },
    success: function(html){
      // alert(html);
      var getData = JSON.parse(html);
      $("#table-data-presensi").html(getData.siswa_table);
      loading_presensi(false);
    }
  });
}

function prepareEditPenilaianSiswa(a){
  $("#detailNilai").modal('show');
  var course_id = '<?php echo $course->id; ?>';
  var institution_id = '<?php echo $course->institution_id; ?>';
  var start_date= $('#a_start_date').val();
  document.getElementById("institution_id").value = institution_id;

  $.ajax({
    type: "POST",
    url: "<?php echo site_url('globals/populate_siswa_prepare_absensi')?>",
    data: { 
      course_id : course_id,
      start_date :start_date,
      institution_id : institution_id
     },
    success: function(response){
      // alert(response);
      var getData = JSON.parse(response);
      var concat_id = "";
      document.getElementById("id_concat").value = concat_id;
      $("#table-siswa-nilai").html(getData.siswa_table);
      
      var info_course = getData.course.name+"/"+getData.course.start_ta+"-"+getData.course.end_ta; 
      $("#course_info").html(info_course);
      $("#subject_info").html(getData.subject);
    }
  });
}

function ajaxPreparePresensi(){
  var course_id = '<?php echo $course->id; ?>';
  var start_date= $('#a_start_date').val();
   var institution_id = '<?php echo $course->institution_id; ?>';

  $.ajax({
    type: "POST",
    url: "<?php echo site_url('globals/populate_siswa_prepare_absensi')?>",
    data: { 
      course_id : course_id,
      start_date :start_date,
      institution_id:institution_id
     },
    success: function(response){
      var getData = JSON.parse(response);
      var concat_id = "";
      document.getElementById("id_concat").value = concat_id;
      $("#table-siswa-nilai").html(getData.siswa_table);
      
      var info_course = getData.course.name+"/"+getData.course.start_ta+"-"+getData.course.end_ta; 
      $("#course_info").html(info_course);
      $("#subject_info").html(getData.subject);
    }
  });
}

function ajaxPopulateSiswa(){
  var course_id = '<?php echo $course->id; ?>';
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('course/get_course_student')?>",
    data: { 
      course_id : course_id,
     },
    success: function(html){
      var getData = JSON.parse(html);
      $("#table-data-siswa-input").html(getData.sic);
    }
  });
}


function ajaxPrepareJumpPenilaian(ks_id){
  var semester_id = $('#tk_semester_id_i').val();
  var sc_id = $('#tk_sc_id_i').val();
  var course_id = '<?php echo $course->id; ?>';
  window.location = "<?php echo site_url('course/view_detail_penilaian_tk')?>"+'/'+ks_id+'/'+course_id+'/'+semester_id+'/'+sc_id;
}


function ajaxPrepareJumpPenilaianTahfidz(ks_id){
  var semester_id = $('#tk_semester_id_i_t').val();
  var sc_id = $('#tk_sc_id_i_t').val();
  var course_id = '<?php echo $course->id; ?>';
  window.location = "<?php echo site_url('course/view_detail_penilaian_tk_tahfidz')?>"+'/'+ks_id+'/'+course_id+'/'+semester_id+'/'+sc_id;
}




function ajaxPreparePrintPenilaian(ks_id){
  var semester_id = $('#tk_semester_id_i').val();
  var sc_id = $('#tk_sc_id_i').val();
  var course_id = '<?php echo $course->id; ?>';
  window.location = "<?php echo site_url('course/view_raport_tk')?>"+'/'+ks_id+'/'+course_id+'/'+semester_id+'/'+sc_id;
}


function ajaxPopulateSiswaTahfidz(){
  var course_id = '<?php echo $course->id; ?>';
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('course/get_course_student_tahfidz')?>",
    data: { 
      course_id : course_id,
     },
    success: function(html){
      var getData = JSON.parse(html);
      $("#table-data-siswa-input-tahfidz").html(getData.sic);
    }
  });
}


function ajaxPreparePrintPenilaianTahfidz(ks_id){
  var semester_id = $('#tk_semester_id_i_t').val();
  var sc_id = $('#tk_sc_id_i_t').val();
  var course_id = '<?php echo $course->id; ?>';
  window.location = "<?php echo site_url('course/view_raport_tk_tahfidz')?>"+'/'+ks_id+'/'+course_id+'/'+semester_id+'/'+sc_id;
}


function get_profile_siswa(enduser_id, profile_id){
  // alert(enduser_id);
  // var selected_id='';
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('course/get_profile_siswa')?>",
    data: { 
      enduser_id :enduser_id,
      profile_id :profile_id
         },
    success: function(html){
      // console.log(html);
      $("#detail-murid").html(html);
      $("#profileSiswa").modal('show');
      // var jsontext   = html;
      // var getData = JSON.parse(jsontext);
      // $("#select-category-mapel").html(getData.select_opt);
      // $('#m_category').on('change', function () {
      //     populate_sub_categories();
      // });
    }
  }); 
}


/// NON TK 
function ajaxPopulateSiswaNonTK(){

  var course_id = '<?php echo $course->id; ?>';
  var semester_id = $('#raport_smt_id').val();
  var sc_id = $('#raport_sc_id').val();
  var kur_id = $('#raport_kur_id').val();
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('course/get_course_student_non_tk_v2')?>",
    data: { 
      course_id : course_id,
      smt_id : semester_id,
      sc_id : sc_id,
      kur_id : kur_id,
     },
    success: function(html){
      // alert(html);
      var getData = JSON.parse(html);
      $("#table-data-raport").html(getData.sic);
    }
  });
}

function ajax_print_nilai(ks_id){
  var semester_id = $('#raport_smt_id').val();
  var sc_id = $('#raport_sc_id').val();
  var kur_id = $('#raport_kur_id').val();
  var course_id = '<?php echo $course->id; ?>';
  window.location = "<?php echo site_url('course/view_raport_normal')?>"+'/'+ks_id+'/'+course_id+'/'+semester_id+'/'+sc_id+'/'+kur_id;
}

function ajaxPrepareJumpPenilaianNonTK(ks_id){
  var semester_id = $('#raport_smt_id').val();
  var sc_id = $('#raport_sc_id').val();
  var kur_id = $('#raport_kur_id').val();
  var course_id = '<?php echo $course->id; ?>';

  // alert(sc_id);
  window.location = "<?php echo site_url('course/view_detail_penilaian_normal')?>"+'/'+ks_id+'/'+course_id+'/'+semester_id+'/'+sc_id+'/'+kur_id;;
}

function ajaxPrepareUploadPDF(ks_id,file_id, img){
  // alert(img);
  console.log(img);
  $('#changeRaport').modal('show');
  document.getElementById("u_pdf_id").value = file_id;
  document.getElementById("u_img_id").value = img;
  document.getElementById("u_ks_id").value = ks_id;
  document.getElementById("u_smt_id").value = $('#raport_smt_id').val();
  document.getElementById("u_sc_id").value = $('#raport_sc_id').val();
  document.getElementById("u_kur_id").value  = $('#raport_kur_id').val();
  document.getElementById("u_course_id").value  = '<?php echo $course->id; ?>';
}

function ajaxPrepareDeletePDF(c,file_id){
  document.getElementById("file_id_d").value = file_id;
  $('#deletePdf').modal('show');
}

function ajaxDeletePdf(){
  var id= $('#file_id_d').val();
  // alert(id);
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('course/delete_raport_pdf')?>",
    data: { 
        id :id,
         },
    success: function(html){
      var jsontext   = html;
      var getData = JSON.parse(jsontext);
      $("#modal-status").html(getData.alert_modal);
      $('#deletePdf').modal('hide');
      ajaxPopulateSiswaNonTK();
      
    }
  }); 
  // document.getElementById("scoring_pg").value = id;
}


function show_data_pdf(c,a){
  var objs='<object width="100%" height="500" type="application/pdf" data="<?php echo base_url();?>data/raport/'+a+'?#zoom=85&scrollbar=0&toolbar=0&navpanes=0" id="pdf_content"></object>';
  $("#pdf_show").html(objs);
}

function filter_absen_rekap(){
   var absen_tipe = $('#absen_tipe').val();
   if(absen_tipe=='1'){
      $('#panel_date_absen').show();
      $('#panel_bln_id').hide();
      $('#panel_thn_id').hide();
   }else if(absen_tipe=='2'){
      $('#panel_bln_id').show();
      $('#panel_thn_id').show();
      $('#panel_date_absen').hide();
     
   }
}

function ajaxExport(){
  var absen_tipe = $('#absen_tipe').val();
  var course_id = '<?php echo $course->id; ?>';
  var date= $('#date_absen').val();
  var thn_id = $('#absen_thn_id').val();
  var bln_id = $('#absen_bln_id').val();
  var tipe = $('#absen_tipe').val();



  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; 
  var yyyy = today.getFullYear();

  if(dd<10) {
      dd = '0'+dd
  } 

  if(mm<10) {
      mm = '0'+mm
  } 

  today = dd + '-' + mm + '-' + yyyy;


  if(date==''){
    date=today;
  }
  // alert(today);

  if(absen_tipe=='1'){
    window.location = "<?php echo site_url('course/rekap_export_csv_harian') ?>"+"/"+course_id+"/"+date;
  }else if(absen_tipe=='2'){
    window.location = "<?php echo site_url('course/rekap_export_csv_bulanan') ?>"+"/"+course_id+"/"+bln_id+"/"+thn_id;
  }

}

// function ajaxPrepareSalin(){
//   alert("testdata");
// }



</script>

  </body>
</html>

     

