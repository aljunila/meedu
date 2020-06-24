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
  <h1>
    <?php echo $title; ?>
    <small>list</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>" rel="tooltip-top" title="Goto Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo site_url('course/course_crud/0-0')?>">Rombel</a></li>
    <li><a href="#"><?php echo $title; ?></a></li>
    <li class="active">List</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div id="modal-status">
    </div>      
     <div class="col-md-6" style="display: none;" id="div-soc">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title text-title">List Event
          </h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div id="print-soc"></div>
          
        </div><!-- /.box-body -->
        <div class="box-footer clearfix text-center">
          <button class="btn btn-danger btn-block" onClick="ajaxFinishAdd(<?php echo $client->id; ?>)"> Selesai</button>
        </div><!-- /.box-footer -->
      </div><!-- /.box -->
    </div><!-- /.col -->

     

    <div class="col-md-12" id ="div-sic">
      <div class="box box-default">
        <div class="box-header with-border">
         <h3 class="box-title text-title"><?php echo 'Client: '.$client->name;?>
          </h3>

         
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool btn-success-o" id="btn-add" onclick="ajaxGetPopulatePrepare(<?php echo $client->id; ?>)"  ><i class="fa fa-plus"></i>Tambah Event</button>
           <!--  <button class="btn btn-box-tool btn-success-o" id="btn-upload" data-toggle="modal" data-target="#uploadMessage" ><i class="fa fa-upload"> </i> Import CSV</button> -->
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <?php if(!empty($status)){ ?>
					<div class="<?php echo $alert; ?> alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $status; ?>
					</div>					
				  <?php } ?>
         
          <div id="print-sic">
          <div class="table-responsive">
          
          </div><!-- /.table-responsive -->
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
        </div><!-- /.box-footer -->
      </div><!-- /.box -->


      <div class="modal modal-default fade" id="mutasiMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-left"></i> Mutasi</h4>
            </div>
            <div class="modal-body">
              <input type="text" name="ks_awal" id="ks_awal" style="display: none;">
              <p class="error-text">&nbsp;&nbsp;&nbsp;Silahkan pilih kelas tujuan untuk mutasi</p>
               <select name="a_class_next" class="form-control" id="a_class_next">
                  <?php foreach($next_class as $nc) { 
                    if($nc->id != $course_id){
                    ?>
                      <?php echo '<option value = "'.$nc->id.'"';?>
                      <?php echo '>'.$nc->name.' '.$nc->level_category.' </option>'?>
                  <?php }
                } ?>
                </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-success" onClick="ajaxMutasi()">Pindahkan</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>



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
               <div id="a_id" style="display: none;"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
             <button type="button" class="btn btn-outline" onClick="ajaxDeleteStudent(<?php echo $client->id;?>)">Delete</button>
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


<script>
$(document).ready(function(){
    ajaxFinishAdd("<?php echo $client->id;?>");
});
  
function sendimg(a){
  document.getElementById("delData").href=a.id;
 
}


function ajaxGetPopulatePrepare(id){
  //alert(id);
  $.ajax({
  type: "POST",
  url: "<?php echo site_url('clients/get_event_client')?>",
  data: { client_id : id },
  success: function(response)
  {
    var getData = JSON.parse(response);
    $("#print-soc").html(getData.soc);
    $("#print-sic").html(getData.sic);
    $("#div-soc").show();
    $('#div-sic').removeClass('col-md-12').addClass('col-md-6');
    $('#btn-add').hide();
    $('#btn-up').hide();
  }
  });
}

$(function () {
     $("#data-siswa-1").DataTable();
      $('#data-siswa-2').DataTable();
  });

function refresh_page(){
   window.location = "<?php echo site_url('client/client_detail/'.$client->id) ?>";
}

function ajaxFinishAdd(id){
  //alert(id);
  $.ajax({
  type: "POST",
  url: "<?php echo site_url('clients/get_event')?>",
  data: { client_id : id },
  success: function(response)
  {
    var getData = JSON.parse(response);
    $("#div-soc").hide();
    $("#print-sic").html(getData.sic);
    $('#div-sic').removeClass('col-md-6').addClass('col-md-12');
    $('#btn-add').show();
    $('#btn-up').show();
  }
  });
}

function ajaxStudentAdd(id,client_id){
  $.ajax({
  type: "POST",
  url: "<?php echo site_url('clients/add_event_client')?>",
  data: { 
    client_id : client_id,
    event_id : id,
   },
  success: function(response)
  {
    // alert(response);
    ajaxGetPopulatePrepare(client_id);
  }
  });
}

function ajaxDeleteStudent(client_id){
    var id = $("#a_id").html();
    $.ajax({
    type: "POST",
    url: "<?php echo site_url('clients/ajax_event_delete')?>",
    data: { 
      client_id : client_id,
      id : id,
     },
    success: function(response)
    {
      $("#deleteMessageAdd").modal('hide');
      ajaxGetPopulatePrepare(client_id);
    }
    });
}

function modalDelete(id,client_id){
   $("#a_id").html(id);
   $("#deleteMessageAdd").modal('show');
}

</script>

     

