<style type="text/css">
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo $title; ?>
    <small><?php if(isset($new_tajar)) { echo '<i class="fa fa-plus-circle"></i>&nbsp;&nbsp;New Subject'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Subject'; } ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>" tooltip="Goto Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('tajar/tajar_crud/0-0')?>"><?php echo $title; ?></a></li>
        <li class="active"><?php if(isset($new_tajar)) { echo '<i class="fa fa-clipboard"></i>&nbsp;&nbsp;New Subject'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Subject'; } ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
        	    <!-- TABLE: LATEST ORDERS -->
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Subject Detail</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
	                <?php	if(@$status){ ?>
					<div class="<?php echo $alert; ?> alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $status; ?>
					</div>
					<?php } ?>

					
                 
                 	<?php
						if(isset($new_tajar)) {
							echo form_open_multipart('tajar/add_tajar','class="form-horizontal" role="form"');
						} else {
							echo form_open_multipart('tajar/edit_tajar/save','class="form-horizontal" role="form"');
							$hidden_data_user = array(
								'id' => $tajar->id,
								'item_id'=>$tajar->item_id
							);
							echo form_hidden($hidden_data_user);
						}
					?>

					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo $this->lang->line('label_tajar');?></label>
						<div class="col-sm-1">
							<input type="text" class="form-control" maxlength="4" placeholder="2017" id="start_ta" name="start_ta" <?php if(!isset($new_tajar)){ echo 'value="'.$tajar->start_ta.'"'; } ?> onkeypress="return isNumberKey(event)" autofocus>
						</div>
						<div class="col-sm-1" style="!important; width:2px; padding-left: 5px">
							/
						</div>
						<div class="col-sm-1">
							<input type="text" class="form-control" placeholder="2018" id="end_ta" name="end_ta" <?php if(!isset($new_tajar)){ echo 'value="'.$tajar->end_ta.'"'; } ?> readonly>
						</div>
					</div>
					<div class="form-group" style="">
						<label class="col-sm-2 control-label"><?php echo $this->lang->line('label_pangkal');?></label>
						<div class="col-sm-2">
							<div class="input-group">
								<span class="input-group-addon" id="sizing-addon1">Rp</span>
								<input type="number" class="form-control form-inline number"  style="text-align: right" placeholder="5000000" id="spp" name="price" <?php if(!isset($new_tajar)){ echo 'value="'.$tajar->price.'"'; } ?> aria-describedby="sizing-addon1">
							</div>
						</div>
					</div>					
				
						
							<!-- button save new enduser -->
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-5">
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>&nbsp;
									<?php if(!isset($new_enduser)){ ?>
									<button type='button' class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteMessage" > Delete</button>
									<?php } else{ ?>
									<button type="reset" class="btn btn-danger btn-sm"> Clear</button>
									<?php } ?>
								</div>
							</div>
						
						
						<?php echo form_close(); ?>
                </div><!-- /.box-body -->

                <div class="box-footer clearfix">
                </div><!-- /.box-footer -->
            </div><!-- /.box -->

            <?php if(!isset($new_tajar)){ ?>
							<div class="modal modal-warning fade" id="deleteMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
										</div>
										<div class="modal-body">
											<p class="error-text"><i class="fa fa-exclamation-triangle fa-2x"></i> Are you sure you want to delete this tahun ajaran?</p>
										</div>
										<div class="modal-footer">
						                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
						                    <a href="<?php echo site_url('tajar/tajar_crud/'.$tajar->id.'-3'); ?>"><button type="button" class="btn btn-outline">Delete</button></a>
						                </div>
										
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div>
							<?php } ?>


        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script type="text/javascript">
	function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }else{
    	
    	return true;
	}
}
	$("#start_ta").keyup(function(){
		var start_ta = $("#start_ta").val();
    	var end_ta = parseInt(start_ta)+1;
    	$("#end_ta").val(end_ta);
	});
</script>



