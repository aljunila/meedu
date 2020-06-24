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
                       <a href="#" onClick="prepare_add_data();" class="btn btn-warning" role="button"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<?php echo $this->lang->line('new').' Admin'; ?></a> 
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


   <!-- MODAL DETAIL ANNOUNCEMENT-->
  <div class="modal modal-default fade" id="detail_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Detail Data</h4>
        </div>
        <div class="modal-body">
          	<input type="text" name="a_new_data" id ="a_new_data" style="display: none;">
            <input type="text" name="a_id" id = "a_id" style="display: none;" >
          
            <div class="row">
              <div class="col-sm-12">
                 <div class="form-group row">
                  <hr>
                  <div class="col-sm-12 text-green text-bold">
                    Profil Singkat
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Nama"  name="a_name" id="a_name">
                  </div>
                </div>
                 <div class="form-group row">
                  <label class="col-sm-2 control-label">Nomor Telp</label>
                  <div class="col-sm-9 ">
                      <input type="text" class="form-control" placeholder="No Hp"  name="a_phone" id="a_phone">
                  </div>
                </div><br>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-9 ">
                      <input type="name" class="form-control" placeholder="Username"  name="a_username" id="a_username">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Pasword</label>
                  <div class="col-sm-9 ">
                      <input type="password" class="form-control" placeholder="Password"  name="a_password" id="a_password">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Ulangi Password</label>
                  <div class="col-sm-9 ">
                      <input type="password" class="form-control" placeholder="Ulangi password"  name="a_retype" id="a_retype">
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger-o pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo $this->lang->line('alert_btn_negative')?></button>
          <button type="button" class="btn btn-success-o" onClick ="detail_data()"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

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


</section><!-- /.content -->



<script>
  var default_date ='0000-00-00';
  $(document).ready(function(){
    $('#a_ins').hide();
    populate_data();
  });

  function populate_data(){
    loadingOverlay(true);
    var id = '';
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('endusers/populate_data')?>",
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
    url ="<?php echo site_url('endusers/data_detail')?>";
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
        document.getElementById("a_name").value = getData.item.fullname;
        document.getElementById("a_username").value = getData.item.username;
        document.getElementById("a_phone").value = getData.item.phone;
        $("#a_id").val(getData.item.id);
        $('#detail_data').modal('show');
      }
    });
  }

  function detail_data(){
    // tinyMCE.triggerSave();
    var new_data = $('#a_new_data').val();
    var a_name = $('#a_name').val();
    var a_phone = document.getElementById("a_phone").value ;
    var a_username= document.getElementById("a_username").value ;
    var a_password = document.getElementById("a_password").value ;
    var a_retype = document.getElementById("a_retype").value ;
    //alert(a_password);
    if(new_data == '1'){
      datas = { 
        fullname : a_name,
        phone : a_phone,
        username : a_username,
        Password : a_password,
        retype : a_retype,
        new_data : new_data,
      };
      url ="<?php echo site_url('endusers/add_data')?>";
    } else {
      var id = $('#a_id').val();
      datas = { 
        id : id,
        fullname : a_name,
        phone : a_phone,
        username : a_username,
        Password : a_password,
        retype : a_retype,
        new_data : new_data,
      };
      url ="<?php echo site_url('endusers/edit_data')?>";
    }


    $.ajax({
      type: "POST",
      url: url,
      data: datas,
      success: function(jsontext){
        var getData = JSON.parse(jsontext);
        $("#modal-status").html(getData.alert_modal);
        clear_modal_data();
         $('#detail_data').modal('hide');
        populate_data();
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
      url: "<?php echo site_url('endusers/delete_data')?>",
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



</script>

     

