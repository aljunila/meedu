<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datepicker/datepicker3.css">

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title; ?>
    <small>list</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>" rel="tooltip-top" title="Goto Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#"><?php echo $title; ?></a></li>
    <li class="active">List</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
	  <div class="col-md-12">
      <div id="modal-status"></div> 
    </div>     

    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li <?php if(!isset($tab) || $tab =='activity'){ echo 'class="active"';}?>>
            <a href="#activity" data-toggle="tab">List <?php echo $title; ?></a>
          </li>
        </ul>
        
        <div class="tab-content">
          <div class=" <?php if(!isset($tab) || $tab =='activity'){ echo 'active';}?> tab-pane" id="activity">
            <div class="post">
               <div class="row">
                  <div class="col-sm-12">

                    <div class="row pull-right" id="filter-search" style="min-width: 380px;display: none;" >
                      <div class="col-md-4 text-right">
                        <div style="padding-top:6px;">Filter</div>
                      </div>
                      <div class="col-md-4">
                        <select name="e_ta_id" class="form-control" id="e_ta_id">
                       
                        <?php foreach($all_tajar as $ta){ ?>
                          <option value="<?php echo $ta->id; ?>"
                              <?php  if ($ta->id ==$tajar_active){ echo 'selected="Selected"'; } ?>
                           >
                          <?php  
                            echo $ta->start_ta.'/'.$ta->end_ta;
                            if ($ta->id ==$tajar_active){  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- ACTIVE --'; 
                          }?>
                          </option>
                        <?php } ?>
                        </select>

                      </div>
                      
                      <div class="col-md-4 ">
                         <select name="e_level_id" class="form-control" id="e_level_id">
                          <option value="">Semua</option>
                          <?php foreach($all_tingkat as $tingkat) { ?>
                              <?php echo '<option value = "'.$tingkat->id.'"';?>
                              <?php echo '>'.$tingkat->name.' </option>'?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div>
                        <a href="<?php echo site_url('school/school_crud/0-1') ?>" class="btn btn-primary " role="button"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<?php echo $this->lang->line('new').' Data Baru'; ?></a> 
                      <br><br>
                    </div>     

                    <div id="table-data"></div>

                  </div>
                </div>
            </div><!-- /.post -->
          </div><!-- /.tab-pane -->

        </div><!-- /.tab-content -->
      </div><!-- /.nav-tabs-custom -->

    </div><!-- /.col -->
  </div><!-- /.row -->

  <!-- MODAL ANNOUNCE DELETE-->
   <div class="modal modal-warning fade" id="delete_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt"></i> Konfirmasi Hapus</h4>
	        </div>
	        <div class="modal-body">
	         <input type="text" name="a_id_d" id = "a_id_d" style="display: none;" >
	          <p class="error-text">apakah anda yakin ingin menghapus data ini ?</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
	          <a id="delData" href="#"><button type="button" class="btn btn-outline" onclick="delete_data()">Hapus</button></a>
	        </div>
	      </div>
	    </div>
  	</div>

     <div class="modal modal-default fade" id="ch_news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-gear"></i>&nbsp;Detail Sekolah</h4>
          </div>
          <div class="modal-body">
            <div class="row">
            <div class="col-sm-12">
            <label class="text-bold text-red col-sm-12" style="font-size: 16px;" id="print-news-name"></label>
            <div class="form-group row">
                <label class="col-sm-2 control-label">Alamat</label>
                <div class="col-sm-10" id="print-news-address"></div>
            </div> 
            <div class="form-group row">
                <label class="col-sm-2 control-label">Telp</label>
                <div class="col-sm-10" id="print-news-telp"></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label pull-left">Email</label>
                <div class="col-sm-10" id="print-news-email"></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label pull-left">Akreditasi Sekolah</label>
                <div class="col-sm-10" id="print-news-accreditation"></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label pull-left">Kurikulum</label>
                <div class="col-sm-10" id="print-news-curiculum"></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label pull-left">Penyelenggaraan</label>
                <div class="col-sm-10" id="print-news-implementation"></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label pull-left">Akses Internet</label>
                <div class="col-sm-10" id="print-news-internet"></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label pull-left">Ruang Kelas</label>
                <div class="col-sm-10" id="print-news-classroom"></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label pull-left">Laboratorium</label>
                <div class="col-sm-10" id="print-news-laboratorium"></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label pull-left">Perpustakaan</label>
                <div class="col-sm-10" id="print-news-library"></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label pull-left">Luas Tanah</label>
                <div class="col-sm-10" id="print-news-surface_area"></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label pull-left">Jumlah Guru</label>
                <div class="col-sm-10" id="print-news-teachers"></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label pull-left">Jumlah Murid Laki-laki</label>
                <div class="col-sm-10" id="print-news-m_students"></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label pull-left">Jumlah Murid Perempuan</label>
                <div class="col-sm-10" id="print-news-f_students"></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label pull-left">Management Berbasis Sekolah</label>
                <div class="col-sm-10" id="print-news-school_mng"></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label pull-left">Website</label>
                <div class="col-sm-10" id="print-news-website"></div>
            </div>
            </div>
           </div>   
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Selesai</button>
          </div> 
      </div>
    </div>

</section><!-- /.content -->



<script>
  var array_inventor=[];
  var array_ahli=[];
  var array_exp=[];
  var default_date ='0000-00-00';
  $(document).ready(function(){
    $('#a_ins').hide();
    $('#a_dob').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#d_pengajuan').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#d_buat').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#d_expired').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#d_serah').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#d_stempel').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#d_sidikjari').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#d_flight').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#d_medical').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#detail_inventor').hide();
    $('#detail_ahli').hide();
    $('#detail_exp').hide();
    populate_data();
  });

  function populate_data(){
    loadingOverlay(true);
    var id = '';
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('school/populate_data')?>",
      data: { 
        id :id,
           },
      success: function(html){
        loadingOverlay(false);
  	    var jsontext  = html;
  	    var getData = JSON.parse(jsontext);
  	    $("#table-data").html(getData.table_data);
      }
    }); 
  }

   $('#a_user_type').on('change', function () {

        if($('#a_user_type').val()=='1'){
          // $("#pdId").css({ 'display': "block" });
          $("#a_ins").hide();

        }else if($('#a_user_type').val()=='2'){
          // $("#pdId").css({ '': "none" });
          $("#a_ins").show();

        }else{
          $("#a_ins").hide();
        }

        populate_data();
    });

  function prepare_add_data(){
  	document.getElementById("a_new_data").value = "1";
    clear_modal_data();
    $('#detail_data').modal('show');
  }

  function prepare_edit_data(a){
    document.getElementById("a_new_data").value = "0";
    url ="<?php echo site_url('medical/data_detail')?>";
    var id = a;
    $.ajax({
      type: "POST",
      url: url,
      data: { 
        id : id
      },
      success: function(jsontext){
        // alert(jsontext);
        var getData = JSON.parse(jsontext);
        document.getElementById("a_name").value = getData.item.name;
        document.getElementById("a_address").value = getData.item.address;
        document.getElementById("a_phone").value = getData.item.phone;
        document.getElementById("a_country").value = getData.item.country;
        document.getElementById("a_pj").value = getData.item.pj;
        document.getElementById("a_sponsor").value = getData.item.sponsor;
        document.getElementById("a_pob").value = getData.item.pob;
        document.getElementById("a_father").value = getData.item.father;
        document.getElementById("a_gfather").value = getData.item.gfather;
        document.getElementById("a_mother").value = getData.item.mother;
        document.getElementById("a_pend").value = getData.item.pend;
        document.getElementById("a_language").value = getData.item.languange;
        $("#a_id").val(getData.item.id);
        $('#detail_data').modal('show');
      }
    });
  }

  function prepare_delete_data(id){
    $('#delete_data').modal('show');
    document.getElementById("a_id_d").value = id;
  }

  function delete_data(){
    loadingOverlay(true);
    var id= $('#a_id_d').val();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('school/delete_data')?>",
      data: { 
          id :id,
           },
      success: function(html){
        loadingOverlay(false);
        var jsontext   = html;
        var getData = JSON.parse(jsontext);
        $("#modal-status").html(getData.alert_modal);
        populate_data();
        
      }
    }); 
    $('#delete_data').modal('hide');
  }


  function clear_modal_data(){
    $('#detail_data').on('hidden.bs.modal', function (e) {
      $(this)
        .find("input,textarea,select")
           .val('')
           .end()
        .find("input[type=checkbox], input[type=radio]")
           .prop("checked", "")
           .end();
    });
  }



  $.date = function(orginaldate) { 
      var date = new Date(orginaldate);
      var day = date.getDate();
      var month = date.getMonth() + 1;
      var year = date.getFullYear();
      if (day < 10) {
          day = "0" + day;
      }
      if (month < 10) {
          month = "0" + month;
      }
      var date =  month + "/" + day + "/" + year; 
      return date;
  };

  function fetch_inventor(){
  var table = '';
  for (var arr in array_inventor) {
    console.log(array_inventor[arr]);
        table = table +
        '<tr>'+
        '<td>'+array_inventor[arr].no+'</td>'+
        '<td>'+array_inventor[arr].name+'</td>'+
        '<td class="text-right">'+
          '<button class="btn bg-teal btn-xs"><i class="fa fa-edit"></i></button>'+
          '<button class="btn btn-danger btn-xs" onClick = "delete_inventor('+arr+')"><i class="fa fa-trash-alt"></i></button>'+
        '</td>'+
        '</tr>';
  }
  console.log(table);
  $("#body-inventor").html(table);
                          
}

function prepare_add_inventor(){
  $('#detail_inventor').show();
  $('#btn-add-inv').hide();
}

function add_inventor(){
  var f_no = $('#f_no').val();
  var f_name = $('#f_name').val();
  array_inventor.push({id:null,merk_id:null,no:f_no,name:f_name});

  document.getElementById("f_no").value ='';
  document.getElementById("f_name").value ='';

  fetch_inventor();
}

function delete_inventor(idx){
  array_inventor.splice(idx, 1);
  fetch_inventor();
}

function done_inventor(){
  $('#detail_inventor').hide();
  $('#btn-add-inv').show();
}

 function fetch_ahli(){
  var table = '';
  for (var arr in array_ahli) {
    console.log(array_ahli[arr]);
        table = table +
        '<tr>'+
        '<td>'+array_ahli[arr].ahli+'</td>'+
        '<td>'+array_ahli[arr].ket+'</td>'+
        '<td class="text-right">'+
          '<button class="btn bg-teal btn-xs"><i class="fa fa-edit"></i></button>'+
          '<button class="btn btn-danger btn-xs" onClick = "delete_ahli('+arr+')"><i class="fa fa-trash-alt"></i></button>'+
        '</td>'+
        '</tr>';
  }
  console.log(table);
  $("#body-ahli").html(table);
                          
}

function prepare_add_ahli(){
  $('#detail_ahli').show();
  $('#btn-add-ahli').hide();
}

function add_ahli(){
  var f_ahli = $('#f_ahli').val();
  var f_ket = $('#f_ket').val();
  array_ahli.push({id:null,ahli:f_ahli,ket:f_ket});

  document.getElementById("f_ahli").value ='';
  document.getElementById("f_ket").value ='';

  fetch_ahli();
}

function delete_ahli(idx){
  array_ahli.splice(idx, 1);
  fetch_ahli();
}

function done_ahli(){
  $('#detail_ahli').hide();
  $('#btn-add-ahli').show();
}

function ajaxSendMsg(id){
  // alert(id);
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('school/get_school_detail')?>",
    data: { 
      id:id,
         },
    success: function(html){
      var jsontext   = html;
      var getData = JSON.parse(jsontext);
      $("#print-news-name").html(getData.name);
      $("#print-news-address").html(getData.address);
      $("#print-news-telp").html(getData.telp);
      $("#print-news-email").html(getData.email);
      $("#print-news-website").html(getData.website);
      $("#print-news-library").html(getData.library);
      $("#print-news-implementation").html(getData.implementation);
      $("#print-news-curiculum").html(getData.curriculum);
      $("#print-news-accreditation").html(getData.accreditation);
      $("#print-news-internet").html(getData.internet);
      $("#print-news-classroom").html(getData.classroom);
      $("#print-news-laboratorium").html(getData.laboratorium);
      $("#print-news-surface_area").html(getData.surface_area);
      $("#print-news-f_students").html(getData.f_students);
      $("#print-news-m_students").html(getData.m_students);
      $("#print-news-teachers").html(getData.teachers);
      $("#print-news-school_mng").html(getData.school_mng);
      $('#ch_news').modal('show');
    }
  }); 
}
</script>

     

