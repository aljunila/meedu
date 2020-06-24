
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo $title; ?>
    <small><i class="fa fa-chevron-right"></i>&nbsp;&nbsp;detail</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('settings/settings_crud/0-0')?>" tooltip="Goto Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('partner/partner_crud/0-0')?>"><?php echo $title; ?></a></li>
        <li class="active"><?php if(isset($new_partner)) { echo '<i class="fa fa-user"></i>&nbsp;&nbsp;New partner'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit partner'; } ?></li>
    </ol>
</section>

<!-- Main content --> 
<section class="content">
    <div class="row">

    	<div class="col-md-3">
			<!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                  	<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>themesAdmin/dist/img/user1-128x128.jpg" alt="User profile picture">
                  	<h3 class="profile-username text-center"><?php echo $partner->name;?></h3>
                  	<p class="text-muted text-center">CODE: <?php echo $partner->clientCode;?></p>
					<ul class="list-group list-group-unbordered">
                   		<li class="list-group-item">
                      		<b>Username</b> <a class="pull-right"><?php echo $partner->username;?></a>
                    	</li>
                    	<li class="list-group-item">
                      		<b>Vehicles</b> <a class="pull-right"><?php echo count($vehicle);?></a>
                    	</li>
                    	
                   	</ul>                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- About Me Box -->
              <div class="box box-warning">
                <div class="box-header with-border">
                  	<h3 class="box-title">Profile</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  	<strong><i class="fa fa-map-marker margin-r-5"></i>  Address</strong>
                  	<p class="text-muted"><?php echo $partner->address;?>.</p>
					<hr>
                  	<strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>
                  	<p class="text-muted"><?php echo $partner->phone;?></p>
                    <hr>

                 	<strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                  	<p class="text-muted"><?php echo $partner->email;?></p>
                 	<hr>
                 
                  	<strong><i class="fa fa-calendar-o margin-r-5"></i> Member Since</strong>
                  	<p><?php $date=date_create($partner->createdDate);
								echo date_format($date,"M d, Y");	?>.</p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-9">
        	


		    <div class="box box-success">
		        <div class="box-header with-border">
		          	<h3 class="box-title">Vehicles List</h3>
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
		          	    
		          	<div class="table-responsive">
		            	<table id="example2" class="table table-bordered table-striped">
			              	<thead>
				                <tr>
				                 	<th>No&nbsp;</th>
				                  	<th>Name</th>
				          			<th>Type</th>
				                 	<th>Police No</th>
				          			<th>Fuel Type</th>
				                </tr>
				            </thead>
				            <tbody>
				               	<?php $i=1;foreach ($vehicle as $row){?>
								<tr>
				  					<td align="center"><?php echo $i; $i++;?></td>
				            	    <td><?php echo $row->name;?></td>
				  					<td><?php echo $row->type;?></td>
				                	<td><?php echo $row->lisenceNumber;?></td>
				                  	<td><?php echo $row->fuelType;?></td>
				                 	
            	                 
	  							</tr>
	  						  	<?php } ?>
                			</tbody>
		              	</table>
		          	</div><!-- /.table-responsive -->
		        </div><!-- /.box-body -->
		        <div class="box-footer clearfix">
		        </div><!-- /.box-footer -->
		    </div><!-- /.box -->

		    <div class="modal modal-warning fade" id="deleteMessageVehicle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		        <div class="modal-dialog">
		          <div class="modal-content">
		            <div class="modal-header">
		              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		              <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
		            </div>
		            <div class="modal-body">
		              <p class="error-text"><i class="fa fa-exclamation-triangle fa-2x"></i>&nbsp;&nbsp;&nbsp;Are you sure you want to delete this Vehicle?</p>
		            </div>
		            <div class="modal-footer">
		              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
		              <a id="delDataV" href="#"><button type="button" class="btn btn-outline">Delete</button></a>
		            </div>
		          </div><!-- /.modal-content -->
		        </div><!-- /.modal-dialog -->
		    </div>


		    <div class="box box-danger">
		        <div class="box-header with-border">
		          	<h3 class="box-title">User List</h3>
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
		          	
		            <div class="table-responsive">
		            	<table id="example1" class="table table-bordered table-striped">
			              	<thead>
			                	<tr>
				                  	<th>No&nbsp;</th>
                  					<th>Name</th>
			          				<th>Username</th>
			          				<th>Phone</th>
					                <th>Online Status</th>
			                	</tr>
			              	</thead>
		              		<tbody>
				            	<?php $i=1;foreach ($endusers as $row){?>
						   		<tr>
	  								<td align="center"><?php echo $i; $i++;?></td>
	                  				<td><?php echo $row->name;?></td>
	  								<td><?php echo $row->username;?></td>
	                  				<td><?php echo $row->phone;?></td>
				                  	<?php if($row->loginStatus=='O'){?> 
				                    <td class="text-green">
				                    <?php echo 'Online'; ?>
				                    </td>
				                  	<?php }else{ ?>
				                    <td class="text-orange">
				                    <?php echo 'Offline';?>
				                    </td>
				                  	<?php }?>

				                  	
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
		              <p class="error-text"><i class="fa fa-exclamation-triangle fa-2x"></i>&nbsp;&nbsp;&nbsp;Are you sure you want to delete the driver?</p>
		            </div>
		            <div class="modal-footer">
		              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
		              <a id="delDataD" href="#"><button type="button" class="btn btn-outline">Delete</button></a>
		            </div>
		          </div><!-- /.modal-content -->
		        </div><!-- /.modal-dialog -->
		    </div>

        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->


<script>
function deleteD(a){
 // window.location.href='b.html#id='+a.id+'&src='+a.src;
 document.getElementById("delDataD").href=a.id;
}


function deleteV(a){
 // window.location.href='b.html#id='+a.id+'&src='+a.src;
 document.getElementById("delDataV").href=a.id;
}
</script>





