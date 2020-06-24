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
    font-size: 16px !important;
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
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
        </ul>
        <div class="tab-content">
          <div>
            <div class="row">
              <div class="col-sm-12">
                <label>Semester</label>
                <select name="semester_id" class="form-control" id="semester_id">
                    <option value="1">Ganjil</option>
                    <option value="2">Genap</option>
                </select>
                <label>Matapelajaran</label>
                <select name="f_vt_id" class="form-control" id="f_vt_id">
                  <?php foreach($view_teacher as $vt) { ?>
                      <?php echo '<option value = "'.$vt->id.'"';?>
                      <?php echo '>'.$vt->subject.' </option>'?>
                  <?php } ?>
                </select>
                <div id="table-data"> <!-- Index Penilaian-->
                </div>
              </div>
            </div>
          </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
      </div><!-- /.nav-tabs-custom -->
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
     <?php echo form_open_multipart('globals/edit_penilaian_score','id="form-penilaian" class="form-horizontal" role="form"');
              ?>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>&nbsp;<span id="subject_info"></span></h4>
        </div>
        <div class="modal-body">
           <input type="text" name="id_concat" id="id_concat" style="display: none;" />
           <input type="text" name="enduser_id" id="enduser_id" style="display: none;" />
           <div id="course_info" ></div>
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



  <div class="modal modal-default fade" id="detailNilaiNR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
     <?php echo form_open_multipart('globals/edit_penilaian_score_nr','id="form-penilaian" class="form-horizontal" role="form"');
              ?>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>&nbsp;<span id="subject_info_nr"></span></h4>
        </div>
        <div class="modal-body">
           <input type="text" name="id_concat_nr" id="id_concat_nr" style="display: none;" />
           <input type="text" name="enduser_id_nr" id="enduser_id_nr" style="display: none;" />
           <div id="course_info_nr" ></div>
           <div id="table-siswa-nilai-nr" ></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </div><!-- /.modal-content -->
       <?php echo form_close();?>  
    </div><!-- /.modal-dialog -->
  </div>


 </div><!-- ./wrapper -->

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
    ajaxPopulateIndikator();
});

 $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
      $('#datatable-scroll-x').DataTable({
        
        "scrollX": true
      });


      $('#data-table-1').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });

      $('#data-table-2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
  });


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


  function refresh_page(){
     window.location = "<?php echo site_url('course/view_student/'.$course->id) ?>";
  }



$( "#f_vt_id" ).change(function() {
   ajaxPopulateIndikator();
});

function ajaxPopulateIndikator(){
  var vt_id = $('#f_vt_id').val();
  var course_id = '<?php echo $course->id; ?>';
  var institution_id = '<?php echo $course->institution_id; ?>';
  // alert(institution_id);
  document.getElementById("enduser_id").value  = '<?php echo $enduser_id; ?>';
  document.getElementById("enduser_id_nr").value  = '<?php echo $enduser_id; ?>';
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('globals/indikator_populate_nilai')?>",
    data: { 
      vt_id : vt_id,
      course_id : course_id,
      institution_id :institution_id
     },
    success: function(html){
      console.log(html);
      
      $("#table-data").html(html);
    }
  });
}
  
function prepareEditPenilaianSiswa(a){
  $("#detailNilai").modal('show');
  var sc_id = a;
  var course_id = '<?php echo $course->id; ?>';
  var institution_id = '<?php echo $course->institution_id; ?>';
  var vt_id = $('#f_vt_id').val();
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('globals/populate_siswa_nilai')?>",
    data: { 
      sc_id : sc_id,
      course_id : course_id,
      vt_id : vt_id,
      institution_id :institution_id
     },
    success: function(response){
      // alert(response);
      var getData = JSON.parse(response);
      var concat_id = sc_id+"-"+course_id+"-"+vt_id;
      document.getElementById("id_concat").value = concat_id;
      $("#table-siswa-nilai").html(getData.siswa_table);
      $("#course_info").html(getData.course.name);
      $("#subject_info").html(getData.subject);
    }
  });
}


function prepareEditPenilaianSiswaNoRepeat(a){
  $("#detailNilaiNR").modal('show');
  var sc_id = a;
  var course_id = '<?php echo $course->id; ?>';
  var vt_id = $('#f_vt_id').val();
  var institution_id = '<?php echo $course->institution_id; ?>';
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('globals/populate_siswa_nilai_no_repeat')?>",
    data: { 
      sc_id : sc_id,
      course_id : course_id,
      vt_id : vt_id,
      institution_id :institution_id
     },
    success: function(response){
      // alert(response);
      var getData = JSON.parse(response);
      var concat_id = sc_id+"-"+course_id+"-"+vt_id;
      document.getElementById("id_concat_nr").value = concat_id;
      $("#table-siswa-nilai-nr").html(getData.siswa_table);
      $("#course_info_nr").html(getData.course.name);
      $("#subject_info_nr").html(getData.subject);
    }
  });
}
</script>
  </body>
</html>


     




     

