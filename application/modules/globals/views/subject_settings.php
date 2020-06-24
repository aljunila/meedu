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
  <style type="text/css">
    .slimScrollBar{
       background: rgba(249, 161, 28, 1) !important; width: 10px !important; position: absolute; top: 56px; opacity: 0.9; display: none; border-radius: 0px; z-index: 99; right: 1px; height: 158.02px;
     }

     .loading .bullets {
        margin-top: 25%;
        margin-left: 45%;
        position:absolue;
        animation:anim 3.5s linear 0s infinite;
      }
      .loading .bullet {
          position: absolute;
          animation: animIn 3.5s ease-in 0s infinite
      }
      .loading .bullet span{
        display:block;
        padding: 5px;
        border-radius: 50%;
        background: #17fea9;
        animation: animSize 3.5s ease-out 0s infinite
      }
      .loading .bullet:nth-child(1),
      .loading .bullet:nth-child(1) span{
          -webkit-animation-delay: 0s;
          animation-delay: 0s;
      }
      .loading .bullet:nth-child(2),
      .loading .bullet:nth-child(2) span{
          -webkit-animation-delay: 0.15s;
          animation-delay: 0.15s;
      }
      .loading .bullet:nth-child(3),
      .loading .bullet:nth-child(3) span{
          -webkit-animation-delay: 0.3s;
          animation-delay: 0.3s;
      }
      .loading .bullet:nth-child(4),
      .loading .bullet:nth-child(4) span{
          -webkit-animation-delay: 0.45s;
          animation-delay: 0.45s;
      }
      .loading .bullet:nth-child(5),
      .loading .bullet:nth-child(5) span{
          -webkit-animation-delay: 0.6s;
          animation-delay: 0.6s;
      }
      .loading .bullet:nth-child(6),
      .loading .bullet:nth-child(6) span{
          -webkit-animation-delay: 0.75s;
          animation-delay: 0.75s;
      }
      .loading .bullet:nth-child(7),
      .loading .bullet:nth-child(7) span{
          -webkit-animation-delay: 0.9s;
          animation-delay: 0.9s;
      }
      .loading .bullet:nth-child(8),
      .loading .bullet:nth-child(8) span{
          -webkit-animation-delay: 1.05s;
          animation-delay: 1.05s;
      }
      @keyframes anim{
        0% {
              -webkit-transform: translateX(-120px);
              transform: translateX(-120px);
          }
        100% {
              -webkit-transform: translateX(120px);
              transform: translateX(120px);
          }
      }
      @keyframes animSize{
         0% {
              -webkit-transform:scale(1.2,1.2);
              transform:scale(1.2,1.2);
          }
         25% {
              -webkit-transform:scale(1.2,1.2);
              transform:scale(1.2,1.2);
          }
         55% {
              -webkit-transform:scale(4,4);
              transform:scale(4,4);
          }
        75% {
              -webkit-transform:scale(1.2,1.2);
              transform:scale(1.2,1.2);
          }
        100%{
              -webkit-transform:scale(1.2,1.2);
              transform:scale(1.2,1.2);
        }
      }
      @keyframes animIn {
          0% {
              -webkit-transform: translateX(-200px);
              transform: translateX(-200px);
              opacity: 0;
          }
        10% {
              -webkit-transform: translateX(-200px);
              transform: translateX(-200px);
              opacity: 0;
          }
        25% {
              opacity: 1;
              -webkit-transform: translateX(0);
              transform: translateX(0);
          }
        70% {
              opacity: 0.5;
              -webkit-transform: translateX(20px);
              transform: translateX(20px);
          }
        85% {
              -webkit-transform: translateX(200px);
              transform: translateX(200px);
              opacity: 0;
          }
          100% {
              -webkit-transform: translateX(200px);
              transform: translateX(200px);
              opacity: 0;
          }
      }
  </style>
</head>
<body>
<div>

<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datatables/dataTables.bootstrap.css">


<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class=""><!-- box -->
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo '<label>'.$view_teacher->subject.'</label> / '.$view_teacher->start_ta.'-'.$view_teacher->end_ta.' / '.$view_teacher->level; ?> </h3>
          <div>
            <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#detailGrade" onClick="prepareAddGrade();"><i class="fa fa-plus"></i> Tambah Indikator</button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <?php if(!empty($status)){ ?>
            <div class="<?php echo $alert; ?> alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo $status; ?>
            </div>          
          <?php } ?>

          <div id="modal-status">
          </div>    
    
          <div id="table-data">
          </div> 

        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
        </div><!-- /.box-footer -->
      </div><!-- /.box -->

      <div class="modal modal-danger fade" id="deleteMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt-alt"></i>&nbsp;&nbsp;<?php echo $this->lang->line('alert_title_delete_permanent');?></h4>
            </div>
            <div class="modal-body">
              <p class="error-text"><?php echo $this->lang->line('alert_data_delete_permanent');?></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><?php echo $this->lang->line('alert_btn_negative');?></button>
              <a id="delData" href="#"><button type="button" class="btn btn-outline"><?php echo $this->lang->line('alert_btn_positive_delete');?></button></a>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
    </div><!-- /.col -->
  </div><!-- /.row -->


  <!-- MODAL DETAIL MAPEL-->
  <div class="modal modal-default fade" id="detailST" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Detail Penilaian</h4>
        </div>
        <div class="modal-body">
          <input type="text" name="st_new" id ="st_new" style="display: none;">
          <input type="text" name="sc_id" id = "sc_id"  style="display: none;" >
          <input type="text" name="si_id" id = "si_id" style="display: none;" >
          <input type="text" name="st_id" id = "st_id"  style="display: none;">
          <div class="form-group">
            <label control-label">Nama</label>
            <input type="text" class="form-control" placeholder="Contoh: Ulangan Harian 1"  name="st_name" id="st_name" autofocus>
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger-o pull-left" data-dismiss="modal"><?php echo $this->lang->line('alert_btn_negative')?></button>
          <button type="button" class="btn btn-success-o" onClick ="detailST()">Simpan</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <!-- MODAL DETAIL GRADE-->
  <div class="modal modal-default fade" id="detailGrade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Indikator Mapel</h4>
        </div>
        <div class="modal-body">
          <input type="text" name="g_new_grade" id ="g_new_grade" style="display: none;">
          <input type="text" name="g_id" id = "g_id" style="display: none;" >
          <div class="form-group">
            <label class="control-label">Nama</label>
            <input type="text" class="form-control" placeholder="Contoh: KD1"  name="g_name" id="g_name" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">Deskripsi</label>
            <textarea type="text" class="form-control"  name="g_description" id="g_description" > </textarea>
          </div>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger-o pull-left" data-dismiss="modal"><?php echo $this->lang->line('alert_btn_negative')?></button>
          <button type="button" class="btn btn-success-o" onClick ="detailGrade()">Simpan</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <!-- MODAL DETAIL RAPORT-->
  <div class="modal modal-default fade" id="detailRaport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Detail Grading Raport</h4>
        </div>
        <div class="modal-body">
     
          <input type="text" name="r_new_grade" id ="r_new_grade" style="display: none;">
          <input type="text" name="r_id" id ="r_id" style="display: none;">
          <div class="form-group">
            <label class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-5  input-group">
              <input type="text" class="form-control" placeholder="Contoh: Grade A"  name="r_name" id="r_name" autofocus>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Deskripsi</label>
            <div class="col-sm-8  input-group">
              <textarea type="text" class="form-control"  name="r_description" id="r_description" > </textarea>
            </div>
          </div>  
          <div class="form-group">
            <label class="col-sm-2 control-label">Rentang</label>
            <div class="col-sm-8  input-group">
              <div class="col-sm-4">
                <label>Minimum</label>
                <input type="text" class="form-control" placeholder="Exp: 80"  name="r_score_min" id="r_score_min"  >
              </div>
              <div class="col-sm-4">
                <label>Maksimum</label>
                <input type="text" class="form-control" placeholder="Exp: 100" name="r_score_max" id="r_score_max"   >
              </div>
            </div>
           
          </div>


            <div class="form-group">
            <label class="col-sm-2 control-label">Tahun Ajaran </label>
            <div class="col-sm-8 input-group">
              <select class="form-control" name="r_ta_id" id="r_ta_id">
                <?php foreach($all_tajar as $row){ ?>
                  <option value="<?php echo $row->id; ?>" >
                  <?php 
                  echo $row->start_ta.'/'.$row->end_ta;
                  if ($row->id ==$tajar_active){
                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- ACTIVE --';
                  }?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>   


          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $this->lang->line('label_tingkat');?></label>
            <div class="col-sm-9 input-group">
              <select name="r_level_id" id="r_level_id" class="form-control">
                <?php foreach($all_tingkat as $tingkat) { ?>
                    <?php echo '<option value = "'.$tingkat->id.'"';?>
                    <?php echo '>'.$tingkat->name.' </option>'?>
                <?php } ?>
              </select>
            </div>
          </div>      

          <div class="form-group">
            <label class="col-md-2 control-label">Kategori</label>
            <div class="col-md-10 input-group">
              <div id ="select-data">
                <select class="form-control" name="r_category" id="r_category">
                  <option value="">tidak berkategori</option>
                  <?php foreach($categories as $row){ ?>
                    <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="input-group-addon">
                <a class="btn btn-success-o btn-xs" data-toggle="modal" data-backdrop="static" data-target="#add_category"><i class="fa fa-plus"></i></a>
                <a class="btn btn-success-o btn-xs"><i class="fa fa-eye"></i></a>
              </div>
            </div>
          </div>  
          <div id="alert-category" ></div>  

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger-o pull-left" data-dismiss="modal"><?php echo $this->lang->line('alert_btn_negative')?></button>
          <button type="button" class="btn btn-success-o" onClick ="detailRaport()">Simpan</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <!-- MODAL DELETE MAPEL-->
  <div class="modal modal-warning fade" id="deleteMapel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt-alt fa-blink"></i>&nbsp;&nbsp;<?php echo $this->lang->line('alert_title_delete')?></h4>
        </div>
        <div class="modal-body">
          <input class="text-green" type="text" name="id_delete" id ="id_delete" style="display: none;">
          <p class="error-text"><?php echo $this->lang->line('alert_data_edit')?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><?php echo $this->lang->line('alert_btn_negative')?></button><button type="button" class="btn btn-outline" onClick="deleteMapelAjax()"><?php echo $this->lang->line('alert_btn_positive_delete')?></button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <!-- MODAL DELETE GRADE-->
  <div class="modal modal-warning fade" id="deleteGrade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt-alt fa-blink"></i>&nbsp;&nbsp;<?php echo $this->lang->line('alert_title_delete')?></h4>
        </div>
        <div class="modal-body">
          <input class="text-green" type="text" name="id_delete" id ="id_delete_grade" style="display: none;">
          <p class="error-text"><?php echo $this->lang->line('alert_data_edit')?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><?php echo $this->lang->line('alert_btn_negative')?></button><button type="button" class="btn btn-outline" onClick="deleteGradeAjax()"><?php echo $this->lang->line('alert_btn_positive_delete')?></button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


  <!-- MODAL DELETE GRADE-->
  <div class="modal modal-warning fade" id="deleteST" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt-alt fa-blink"></i>&nbsp;&nbsp;<?php echo $this->lang->line('alert_title_delete')?></h4>
        </div>
        <div class="modal-body">
          <input class="text-green" type="text" name="id_delete" id ="id_delete_st" style="display: none;" >
          <p class="error-text"><?php echo $this->lang->line('alert_data_edit')?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><?php echo $this->lang->line('alert_btn_negative')?></button><button type="button" class="btn btn-outline" onClick="deleteSTAjax()"><?php echo $this->lang->line('alert_btn_positive_delete')?></button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


</section><!-- /.content -->




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
    </script>

    <script>
    function logoutJS(a){
      // alert(a);
      document.getElementById("logoutLink").href=a.id;
      $('#detailGrade').on('shown.bs.modal', function () {
          $('#g_name').focus();
      });  
    }

    function ajaxChangeBtn(a){
      if(a){
        $('#btn-change').show();
      }else{
         $('#btn-change').hide();
      }
    }


    function stepaLoading(a){
      if(a){
        $('#stepa-global-loading').show();
      }else{
        $('#stepa-global-loading').hide();
      }

    }
    </script>

    <script>

$( document ).ready(function() {
  ajaxPopulate();
});

function prepareAddGrade(a){ 
  document.getElementById("g_new_grade").value = "1";
   


}



function detailGrade(){
  var new_grade = $('#g_new_grade').val();
  var name = $('#g_name').val();
  var description = $('#g_description').val();
  var vt_id ='<?php echo $view_teacher->id;?>';
  var ta_id ='<?php echo $view_teacher->ta_id;?>';
  var institution_id ='<?php echo $view_teacher->institution_id;?>';
  var username="GLOBALS";



  if(new_grade=='1'){
    datas = { 
      name : name,
      description : description,
      ta_id : ta_id,
      vt_id : vt_id,
      institution_id : institution_id,
      username : username,
      new_grade : new_grade
    };
    url ="<?php echo site_url('globals/add_indikator_ajax')?>";
  } else {
    var id = $('#g_id').val();
    datas = { 
      id : id,
      name : name,
      description : description,
      ta_id : ta_id,
      vt_id : vt_id,
      institution_id : institution_id,
      username : username,
      new_grade : new_grade
    };
    url ="<?php echo site_url('globals/edit_indikator_ajax')?>";
  }


  $.ajax({
    type: "POST",
    url: url,
    data: datas,
    success: function(jsontext){
      // alert(jsontext);
      var getData = JSON.parse(jsontext);
      $('#detailGrade').modal('hide');
      $("#modal-status").html(getData.alert_modal);
      // $("#fg_ta_id").val(ta_id);
      // clearModalGrade();
      ajaxPopulate();
    }
  });

}



function prepareEditIndikator(a){
  document.getElementById("g_new_grade").value = "0";
  url ="<?php echo site_url('globals/indikator_detail')?>";
  var id = a;
   var institution_id ='<?php echo $view_teacher->institution_id;?>';
  $.ajax({
    type: "POST",
    url: url,
    data: { 
      id : id,
      institution_id :institution_id
    },
    success: function(jsontext){
      // alert(jsontext);
      var getData = JSON.parse(jsontext);
      document.getElementById("g_name").value = getData.indikator.name;
      document.getElementById("g_id").value = getData.indikator.id;
      document.getElementById("g_description").value = getData.indikator.description;
      $('#detailGrade').modal('show');
    }
  });
}

function ajaxPopulate(){
  var vt_id = '<?php echo $view_teacher->id;?>';
  var level_id = '<?php echo $view_teacher->level_id;?>';
  var ta_id = '<?php echo $view_teacher->ta_id;?>';
  var institution_id = '<?php echo $view_teacher->institution_id;?>';
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('globals/indikator_populate')?>",
    data: { 
      vt_id : vt_id,
      level_id: level_id,
      institution_id: institution_id,
      ta_id: ta_id
     },
    success: function(html){
      $("#table-data").html(html);
    }
  });
}

function clearModalGrade(){
  $('#detailGrade').on('hidden.bs.modal', function (e) {
    $(this)
      .find("input,textarea,select")
         .val('')
         .end()
      .find("input[type=checkbox], input[type=radio]")
         .prop("checked", "")
         .end();
  });
}

function ajaxAddST(sc,si){
  document.getElementById("st_new").value = "1";
  document.getElementById("sc_id").value = sc;
  document.getElementById("si_id").value = si;
  $('#detailST').modal('show');
  $('#st_name').focus();
}

function prepareEditST(a){
  document.getElementById("st_new").value = "0";
  var institution_id ='<?php echo $view_teacher->institution_id;?>';
  var username="GLOBALS";

  url ="<?php echo site_url('globals/score_teacher_detail')?>";
  var id = a;
  $.ajax({
    type: "POST",
    url: url,
    data: { 
      id : id,
      institution_id:institution_id,
    },
    success: function(jsontext){
      // alert(jsontext);
      var getData = JSON.parse(jsontext);
      document.getElementById("st_name").value = getData.sc_data.name;
      document.getElementById("st_id").value = getData.sc_data.id;
      document.getElementById("sc_id").value = getData.sc_data.sc_id;
      document.getElementById("si_id").value = getData.sc_data.si_id;
      $('#detailST').modal('show');
    }
  });
}

function detailST(){
  var name = $('#st_name').val();
  var si_id = $('#si_id').val();
  var sc_id = $('#sc_id').val();
  var st_new= $('#st_new').val();
  var institution_id ='<?php echo $view_teacher->institution_id;?>';
  var username="GLOBALS";

  if(st_new =='1'){
    datas = { 
      name : name,
      si_id : si_id,
      sc_id : sc_id,
      st_new : st_new,
      institution_id : institution_id,
      username : username,
    };
    url ="<?php echo site_url('globals/add_score_teacher_ajax')?>";
  } else {
    var id = $('#st_id').val();
    datas = { 
      id : id,
      name : name,
      si_id : si_id,
      sc_id : sc_id,
      st_new : st_new,
      institution_id : institution_id,
      username : username,
    };
    url ="<?php echo site_url('globals/edit_score_teacher_ajax')?>";
  }


  $.ajax({
    type: "POST",
    url: url,
    data: datas,
    success: function(jsontext){
      // alert(jsontext);
      var getData = JSON.parse(jsontext);
      $('#detailST').modal('hide');
      $("#modal-status").html(getData.alert_modal);
      ajaxPopulate();
    }
  });

}

function prepareDeleteST(a){
  document.getElementById("id_delete_st").value = a;
  $('#deleteST').modal('show');
}

function deleteSTAjax(){
  var institution_id ='<?php echo $view_teacher->institution_id;?>';
  var username="GLOBALS";
  var id = $('#id_delete_st').val();
  datas = { 
    id : id
  };
  url="<?php echo site_url('globals/delete_score_teacher_ajax')?>";
  $.ajax({
    type: "POST",
    url: url,
    data: datas,
    success: function(jsontext){
      var getData = JSON.parse(jsontext);
      $('#deleteST').modal('hide');
      $("#modal-status").html(getData.alert_modal);
      ajaxPopulate();
    }
  });
}





</script>
  </body>
</html>


     

