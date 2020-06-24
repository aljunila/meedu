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
          <?php if($this->session->userdata('user_group_id')=='1'){?>
          <a href="<?php echo site_url('tajar/tajar_crud/0-1') ?>" class="btn btn-primary" role="button"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<?php echo $this->lang->line('new').' '.$title; ?></a><br><br>
          <?php } ?>
                 
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No&nbsp;</th>
                  <th><?php echo $this->lang->line('th_tajar');?></th>
				          <th>ID Tahun Ajaran</th>
				          <th><?php echo $this->lang->line('th_actions');?></th>
                </tr>
              </thead>
              <tbody>
               	<?php $i=1;foreach ($daftar as $row){?>
					   		<tr>
  								<td align="center"><?php echo $i; $i++;?></td>
                  <td><?php echo $row->start_ta.'/'.$row->end_ta;?></td>
                  <td><?php echo $row->id;?></td>
                  <td><?php if($this->session->userdata('user_group_id')=='1'){?>
  								  <a href="<?php echo site_url('tajar/tajar_crud/'.$row->id.'-2'); ?>" rel="tooltip-top" title="Edit">
  									   <i class="fa fa-edit"></i>
  								  </a>&nbsp;&nbsp;
  								  <a href="#" rel="tooltip-top" title="Delete"> 
  									   <i class="fa fa-trash-alt" data-toggle="modal" data-target="#deleteMessage"  id="<?php echo site_url('tajar/tajar_crud/'.$row->id.'-3'); ?>" onClick="sendimg(this);"></i>
  								  </a>
                    <?php if($row->active_status === 'N'){ ?>
                    <a href="#" rel="tooltip-top" title="Pilih Sebagai Tahun Ajaran Aktif"> 
                      &nbsp;<span class="label label-info" data-toggle="modal" data-target="#setActiveMessage"  id="<?php echo site_url('tajar/set_active_tajar/'.$row->id); ?>" onClick="confirmActivation(this);">aktifkan</span>
                     </a> 
                    <?php } else { ?>
                      &nbsp;<label class="text-green">aktif</label>
                    <?php } ?>
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
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt-alt"></i>Hapus</h4>
            </div>
            <div class="modal-body">
              <p class="error-text">Apakah anda yakin untuk menghapus data tersebut?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
              <a id="delData" href="#"><button type="button" class="btn btn-outline">Hapys</button></a>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>

      <div class="modal modal-warning fade" id="setActiveMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel2">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
              <p class="error-text"><i class="fa fa-exclamation-triangle fa-2x"></i>&nbsp;&nbsp;&nbsp;Apa Anda yakin ingin mengubah tahun ajaran yang sedang aktif saat ini?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
              <a id="setActive" href="#"><button type="button" class="btn btn-outline">Ubah</button></a>
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
function confirmActivation(a){
  document.getElementById("setActive").href=a.id;
}
</script>

     

