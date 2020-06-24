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
      <div class="box box-info">
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
          <a href="<?php echo site_url('enduser/enduser_crud/0-1') ?>" class="btn btn-primary" role="button"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;New <?php echo $title; ?></a><br><br>
                 
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No&nbsp;</th>
                  <th>Fullname</th>
          				<th>Username</th>
                  <th>Status Login</th>
                  <th>Type</th>
          				<th>Institution</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               	<?php $i=1;foreach ($daftar as $row){?>
					   		<tr>
  								<td align="center"><?php echo $i; $i++;?></td>
                  <td><?php echo $row->fullname;?></td>
  								<td><?php echo $row->username;?></td>
                  <td><?php echo $row->login_status;?></td>
                  <td><?php if($row->user_group_id=='1'){
                    echo '<span class="label label-success">Admin Sekolah</span>';
                    }else{ 
                      echo '<span class="label label-warning">Admin Yayasan</span>';
                    }?>
                  </td>
                  <td><?php echo $row->sekolah;?></td>
                  <td><?php if($this->session->userdata('user_group_id')=='-1'){?>
  								  <a href="<?php echo site_url('enduser/enduser_crud/'.$row->id.'-2'); ?>" rel="tooltip-top" title="Edit">
  									   <i class="fa fa-edit"></i>
  								  </a>&nbsp;&nbsp;
  								  <a href="#" rel="tooltip-top" title="Delete"> 
  									   <i class="fa fa-trash-alt-alt" data-toggle="modal" data-target="#deleteMessage"  id="<?php echo site_url('enduser/enduser_crud/'.$row->id.'-3'); ?>" onClick="sendimg(this);"></i>
  								  </a>
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
              <p class="error-text"><i class="fa fa-exclamation-triangle fa-2x"></i>&nbsp;&nbsp;&nbsp;Are you sure you want to delete the enduser?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
              <a id="delData" href="#"><button type="button" class="btn btn-outline">Delete</button></a>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
      
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->


<script>
function sendimg(a){
  document.getElementById("delData").href=a.id;
}
</script>

     

