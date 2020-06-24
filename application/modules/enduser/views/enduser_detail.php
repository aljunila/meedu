
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo $title; ?>
    <small><?php if(isset($new_enduser)) { echo '<i class="fa fa-user"></i>&nbsp;&nbsp;New End User'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit End User'; } ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>" tooltip="Goto Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('enduser/enduser_crud/0-0')?>"><?php echo $title; ?></a></li>
        <li class="active"><?php if(isset($new_enduser)) { echo '<i class="fa fa-user"></i>&nbsp;&nbsp;New End User'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit End User'; } ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
        	    <!-- TABLE: LATEST ORDERS -->
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">End User's Detail</h3>
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
						if(isset($new_enduser)) {
							echo form_open_multipart('enduser/add_enduser','class="form-horizontal" role="form"');
						} else {
							echo form_open_multipart('enduser/edit_enduser/save','class="form-horizontal" role="form"');
							$hidden_data_user = array(
								'id' => $datas->id
							);
							echo form_hidden($hidden_data_user);
						}
					?>

					<div class="form-group">
						<div class="col-sm-2 control-label"></div>
						<div class="col-sm-5">
							<h4 class="text-green">User Profile</h4>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Type Admin</label>
						<div class="col-sm-5">
							<select class="form-control" name="user_group_id" id="ugi">
								<option value="1" 
								<?php	if(!isset($new_enduser)){ 
									if($datas->user_group_id=='1'){echo 'selected="selected"'; }
								}?>
								>Admin Sekolah</option>
								<option value="5" 
								<?php	if(!isset($new_enduser)){ 
									if($datas->user_group_id=='5'){echo 'selected="selected"'; }
								}?>
								>Admin Yayasan</option>
							</select>
						</div>
					</div>	

					<div class="form-group" id="institution_id">
						<label class="col-sm-2 control-label">Nama Sekolah</label>
						<div class="col-sm-5">
							<select class="form-control" name="institution_id" >
								<?php foreach($all_sekolah as $as){  ?>
									<option value="<?php echo $as->id; ?>"
									<?php if(!isset($new_enduser)){ if($as->id == $datas->institution_id){echo 'selected="selected"';} } ?>"
									><?php echo $as->name; ?></option>
								<?php } ?>
								
							</select>
						</div>
					</div>	

					<div class="form-group" id="yayasan_id">
						<label class="col-sm-2 control-label">Yayasan</label>
						<div class="col-sm-5">
							<select class="form-control" name="yayasan_id" >
								<?php foreach($all_yayasan as $ys){ ?>
									<option value="<?php echo $ys->id; ?>" <?php if(!isset($new_enduser)){ if($ys->id == $datas->institution_id){echo 'selected="selected"';} } ?>"><?php echo $ys->name; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>	
					

					<div class="form-group">
						<label class="col-sm-2 control-label">Fullname</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" placeholder="John Doe"  name="fullname" <?php if(!isset($new_enduser)){ echo 'value="'.$datas->fullname.'"'; } ?> autofocus>
						</div>
					</div>							

					<div class="form-group">
						<label class="col-sm-2 control-label">NIK</label>
						<div class="col-sm-5">
						<input type="text" class="form-control" placeholder="nomor induk kependudukan" name="nik" <?php if(!isset($new_enduser)){ echo 'value="'.$datas->nik.'" '; } ?>>
						</div>
					</div>
			
					

					<div class="form-group">
					<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-5">
							<input type="email" class="form-control" place="account name" name="username" <?php if(!isset($new_enduser)){ echo 'value="'.$datas->username.'" '; } ?>>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-5">
							<input type="password" class="form-control" name="password">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Re-type Password</label>
						<div class="col-sm-5">
							<input type="password" class="form-control" name="re_password">
						</div>
					</div>
				
						<?php if(!isset($new_enduser)){ ?>
							<div class="modal modal-warning fade" id="deleteMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
										</div>
										<div class="modal-body">
											<p class="error-text"><i class="fa fa-exclamation-triangle fa-2x"></i> Are you sure you want to delete the enduser?</p>
										</div>
										<div class="modal-footer">
						                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
						                    <a href="<?php echo site_url('enduser/enduser_crud/'.$datas->id.'-3'); ?>"><button type="button" class="btn btn-outline">Delete</button></a>
						                </div>
										
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div>
							<?php } ?>

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

        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

<script type="text/javascript">
	$( document ).ready(function() {
    	selectedUgi();
	});

	$( "#ugi" ).change(function() { selectedUgi(); });

	function selectedUgi(){
		var category_id = $('#ugi').val();
	    if(category_id==1){
	    	document.getElementById('institution_id').style.display = "block";
	    	document.getElementById('yayasan_id').style.display = "none";
	    }else{
	    	document.getElementById('institution_id').style.display = "none";
	    	document.getElementById('yayasan_id').style.display = "block";
	    }
		
    }


	
</script>



