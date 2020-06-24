
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
						if(isset($new_priviledge)) {
							echo form_open_multipart('priviledge/add_priviledge','class="form-horizontal" role="form"');
						} else {
							echo form_open_multipart('priviledge/edit_priviledge/save','class="form-horizontal" role="form"');
							$hidden_data_user = array(
								'id' => $datas->id
							);
							echo form_hidden($hidden_data_user);
						}
					?>

					<div class="form-group">
						<label class="col-sm-2 control-label">Nama Priviledge</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" placeholder="John Doe"  name="name" <?php if (!isset($new_priviledge)) { echo "value='".$datas->priviledge_name."'"; } ?>">
						</div>
					</div>	

					<div class="form-group" id="menu_id">
						<label class="col-sm-2 control-label">Menu</label>
						<div class="col-sm-10">
								<?php 
								foreach ($menu_group as $mg) { ?>
								<div class="col-sm-10">
								<label><span class='text-green text-bold'><?php echo $mg->name; ?></span></label>	<br>
								<?php 
								$sql = "SELECT DISTINCT(a.menu_id), a.title, a.action_url, a.icon, a.nav_type, a.order FROM menu as a
										LEFT JOIN priviledges as b 
										ON (a.menu_id = b.menu_id)
										WHERE a.nav_type = '".$mg->id."' AND a.parent_id=0 
										AND user_group_id=1 AND b.pvg_id=0";
								$query = $this->db->query($sql)->result();
								foreach($query as $as) {
								  if (isset($new_priviledge)) { ?>
									<div class="col-sm-12"><input type="checkbox" name="menu[]" value="<?php echo $as->menu_id; ?>">&nbsp;&nbsp;
									<label><?php echo $as->title; ?> </label></div><br>
									
								<?php }  else { 
									 ?>
									<div class="col-sm-12"><input type="checkbox" name="menu[]" value="<?php echo $as->menu_id; ?>"
									<?php 
			                        foreach ($menu as $m) {
			                          $menu_id = $m->menu_id; 
									if($menu_id==$as->menu_id) { echo "checked='checked'"; } else { echo ""; } } ?>>&nbsp;&nbsp;
									<label><?php echo $as->title; ?></label></div><br>
								
								<?php  } 
									$sqlsubmenu = "SELECT DISTINCT(a.menu_id), a.title, a.action_url, a.icon, a.nav_type, a.order
													FROM menu as a
													LEFT JOIN priviledges as b 
													ON (a.menu_id = b.menu_id)
													WHERE a.nav_type = '".$mg->id."'
													AND user_group_id=1 AND b.pvg_id=0 AND a.parent_id='".$as->menu_id."'";
									$querysubmenu = $this->db->query($sqlsubmenu)->result();
									foreach($querysubmenu as $sm) { ?>
									  <?php if (isset($new_priviledge)) { ?>
										<div class="col-sm-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="menu[]" value="<?php echo $sm->menu_id; ?>">&nbsp;&nbsp;
										<?php echo $sm->title; ?> </div>
										
									<?php }  else { 
										 ?>
										<div class="col-sm-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="menu[]" value="<?php echo $sm->menu_id; ?>"
										<?php 
										foreach ($menu as $m) { 
										$menu_id = $m->menu_id; 
										if($menu_id==$sm->menu_id) { echo "checked='checked'"; } else { echo ""; } } ?>>&nbsp;&nbsp;
										<?php echo $sm->title; ?></div>
									
									<?php  } 
										$sqlssmenu = "SELECT DISTINCT(a.menu_id), a.title, a.action_url, a.icon, a.nav_type, a.order
													FROM menu as a
													LEFT JOIN priviledges as b 
													ON (a.menu_id = b.menu_id)
													WHERE a.nav_type = '".$mg->id."'
													AND user_group_id=1 AND b.pvg_id=0 AND a.parent_id='".$sm->menu_id."'";
									$queryssmenu = $this->db->query($sqlssmenu)->result();
									foreach($queryssmenu as $ss) { ?>
									  <?php if (isset($new_priviledge)) { ?>
										<div class="col-sm-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="menu[]" value="<?php echo $ss->menu_id; ?>">&nbsp;&nbsp;
										<?php echo $ss->title; ?> </div>
										
									<?php }  else { 
										 ?>
										<div class="col-sm-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="menu[]" value="<?php echo $ss->menu_id; ?>"
										<?php 
										foreach ($menu as $m) { 
										$menu_id = $m->menu_id; 
										if($menu_id==$ss->menu_id) { echo "checked='checked'"; } else { echo ""; } } ?>>&nbsp;&nbsp;
										<?php echo $ss->title; ?></div>
									
									<?php  } 


									 } 	}
								 } ?>
								<br></div>
								 <?php } ?>
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



