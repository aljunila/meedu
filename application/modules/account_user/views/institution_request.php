
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo $title; ?>
    <small><?php if(isset($new_institution)) { echo '<i class="fa fa-user"></i>&nbsp;&nbsp;New Institution'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Institution'; } ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>" tooltip="Goto Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('institution/institution_crud/0-0')?>"><?php echo $title; ?></a></li>
        <li class="active"><?php if(isset($new_enduser)) { echo '<i class="fa fa-user"></i>&nbsp;&nbsp;New Institution'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Institution'; } ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-10">
        	    <!-- TABLE: LATEST ORDERS -->
            <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Institution Detail</h3>
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
						if(isset($new_institution)) {
							echo form_open_multipart('institution/add_institution_request','class="form-horizontal" role="form"');
							$hidden_data_user = array(
								'yayasan_id' => $yayasan_id,

							);
							echo form_hidden($hidden_data_user);
						} else {
							echo form_open_multipart('institution/edit_institution_request/save','class="form-horizontal" role="form"');
							$hidden_data_user = array(
								'id' => $institution->id,
								'yayasan_id' => $yayasan_id,

							);
							echo form_hidden($hidden_data_user);
						}
					?>

					<div class="form-group">
						<label class="col-sm-2 control-label">Institution</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" placeholder="Nama Sekolah"  name="name" <?php if(!isset($new_institution)){ echo 'value="'.$institution->name.'"'; } ?> autofocus>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Country</label>
						<div class="col-sm-8">
							<select name="country_id" class="form-control">
								<?php foreach($all_country as $country) { ?>
									<?php if(isset($new_institution)) { ?>
										<?php echo '<option value = "'.$country->id.'">'.$country->name.' </option>'?>
									<?php } else { ?>
										
										<?php if($country->id==$institution->country_id) { ?>
											<?php echo '<option value = "'.$country->id.'" selected="selected">'.$country->name.' </option>'?>
										<?php } else { ?>
											<?php echo '<option value = "'.$country->id.'">'.$country->name.' </option>'?>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							</select>
						</div>
					</div>



					<div class="form-group">
						<label class="col-sm-2 control-label">Classification</label>
						<div class="col-sm-8">
							<select name="classification" class="form-control">
								<?php foreach($all_classi as $classi) { ?>
									<?php if(isset($new_institution)) { ?>
										<?php echo '<option value = "'.$classi->id.'">'.$classi->name.' </option>'?>
									<?php } else { ?>
										
										<?php if($classi->id==$institution->classification) { ?>
											<?php echo '<option value = "'.$classi->id.'" selected="selected">'.$classi->name.' </option>'?>
										<?php } else { ?>
											<?php echo '<option value = "'.$classi->id.'">'.$classi->name.' </option>'?>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-8">
						<input type="email" class="form-control" placeholder="john_doe@example.com" name="email" <?php if(!isset($new_institution)){ echo 'value="'.$institution->email.'" '; } ?>>
						</div>
					</div>
			
					<div class="form-group">
						<label class="col-sm-2 control-label">Phone</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" placeholder="6281728XXX" name="phone" <?php if(!isset($new_institution)){ echo 'value="'.$institution->phone.'" '; } ?>>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Address</label>
						<div class="col-sm-8">
							<textarea type="text"class="form-control"  name="address"> <?php if(!isset($new_institution)){ echo $institution->address; } ?> </textarea>
						</div>
					</div>	

					
						
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                <!-- button save new enduser -->
					<div class="pull-right">
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>&nbsp;
							<?php if(!isset($new_enduser)){ ?>
							<button type='button' class="btn btn-danger-o" data-toggle="modal" data-target="#deleteMessage" ><i class="fa fa-trash-alt-alt"></i> Delete</button>
							<?php } else{ ?>
							<button type="reset" class="btn btn-danger-o"><i class="fa fa-eraser"></i> Cleabraserutton>
							<?php } ?>
					</div>
                </div><!-- /.box-footer -->
                <?php echo form_close(); ?>
            </div><!-- /.box -->

        </div><!-- /.col -->


        <?php if(!isset($new_institution)){ ?>
			<div class="modal modal-warning fade" id="deleteMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
						</div>
						<div class="modal-body">
							<p class="error-text"><i class="fa fa-exclamation-triangle fa-2x"></i> Are you sure you want to delete this institution?</p>
						</div>
						<div class="modal-footer">
		                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
		                    <a href="<?php echo site_url('institution/institution_crud/'.$institution->id.'-3'); ?>"><button type="button" class="btn btn-outline">Delete</button></a>
		                </div>
						
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div>
		<?php } ?>
    </div><!-- /.row -->
</section><!-- /.content -->



