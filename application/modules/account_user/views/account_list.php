<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datatables/dataTables.bootstrap.css">
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
    <div class="col-xs-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $title; ?> List</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <?php if(!empty($status)){ ?>
					<div class="<?php echo $alert; ?> alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $status; ?>
					</div>					
				  <?php } ?>
          <?php if($this->session->userdata('user_group_id')=='1'){?>
          <a href="<?php echo site_url('settings/account_bank/0-1') ?>" class="btn btn-success" role="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;New <?php echo $title; ?></a><br><br>
          <?php } ?>


          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No&nbsp;</th>
                  <th>Bank</th>
        				  <th>Cabang</th>
                  <th>Atas Nama</th>
        				  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
               	<?php $i=1;foreach ($daftar as $row){?>
					   		<tr>
  								<td align="center"><?php echo $i; $i++;?></td>
                  <td><strong><?php echo $row->acc_bank;?></strong><br>
                      <?php echo $row->acc_number;?><br>
                  </td><td><?php echo $row->branch;?></td>
              	  <td><?php echo $row->acc_name;?></td>
        			    <td><?php if($this->session->userdata('user_group_id')=='1'){?>
  								  <a class="btn btn-success-o btn-xs" href="<?php echo site_url('settings/account_bank/'.$row->id.'-2'); ?>" rel="tooltip-top" title="Edit">
  									   <i class="fa fa-edit"></i> Edit
  								  </a>&nbsp;&nbsp;
  								  <span class="btn btn-danger-o btn-xs"><i class="fa fa-trash-alt text-danger" data-toggle="modal" data-target="#deleteMessage"  id="<?php echo site_url('settings/account_bank/'.$row->id.'-3'); ?>" onClick="sendimg(this);"><a href="#" rel="tooltip-top" title="Delete" class="text-danger"> 
  									    Delete
  								  </a></i>
                    </i>
  								  <?php } else {
  									echo "N/A";
  								  }?>
  								</td>
  							</tr>
  						  <?php } ?>
                </tbody>
              </table>
          </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
        </div><!-- /.box-footer -->
      </div><!-- /.box -->

      <div class="modal modal-warning fade" id="deleteMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
              <p class="error-text"><i class="fa fa-exclamation-triangle fa-2x"></i>&nbsp;&nbsp;&nbsp;Are you sure you want to delete this Institution?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
              <a id="delData" href="#"><button type="button" class="btn btn-outline">Delete</button></a>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>


       <!--MODAL ACTIVE STATUS-->
      <div class="modal modal-default fade" id="ch_active_status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
          <?php
            echo form_open_multipart('institution/change_status/','class="form-horizontal" role="form"');
          ?> 
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-gear"></i>&nbsp;Ubah Status</h4>
          </div>
          <div class="modal-body">
            <div class="text-center">
              <label class="text-bold text-red" style="font-size: 16px; margin-bottom: 3px;">Ubah Status Aktivasi</label> 
              <br>
              <br>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Name</label>
              <div class="col-sm-7">
                <span id="as_name"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Status</label>
              <input id ='as_user_id' type="text-red" name="id" style="display: none;">
              <div class="col-sm-7">
                <select class="form-control" name="active_status" id ="as_select" >
                  <option value="Y"  <?php if($row->id == $ek->master_ekskul_id){ echo 'selected="selected"';} ?>">
                    <?php echo $row->name; ?>
                  </option>
                </select> 
              </div>
            </div>
            
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-success-o pull-left" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
          <?php echo form_close(); ?>  
        </div><!-- /.modal-content -->
      </div>
    </div>
    <!-- END MODAL ACTIVE STATUS-->
      
    </div><!-- /.col -->
  </div><!-- /.row -->


</section><!-- /.content -->


<script>
function sendimg(a){
  document.getElementById("delData").href=a.id;
}

function active_status_change(a){
  var params = a.id;
  var param = params.split('/');
  $('#as_user_id').val(param[1]);
  document.getElementById("as_name").innerHTML=param[0];
  var as_n=''; var as_a='';
  if(param[2]=='N'){
    as_n ='selected="selected"';
  }else if(param[2]=='A'){
    as_a ='selected="selected"';
  }
  var optsel = '<option value="P" '+as_n+'>Menunggu Aktifasi</option>'+
               '<option value="A" '+as_a+'>Aktif</option>';
  document.getElementById("as_select").innerHTML=optsel;

}
</script>

     

