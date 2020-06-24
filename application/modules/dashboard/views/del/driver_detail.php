
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
                  	<h3 class="profile-username text-center"><?php echo $driver->name;?></h3>
                  	<p class="text-muted text-center">username: <?php echo $driver->username;?></p>
					<ul class="list-group list-group-unbordered">
                   		<li class="list-group-item">
                      		<b>Username</b> <a class="pull-right"><?php echo $driver->username;?></a>
                    	</li>
                    	<li class="list-group-item">
                      		<b>Password</b> <a class="pull-right"><?php echo "**********";?></a>
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
                	<ul class="nav nav-stacked">
		                <li><strong><i class="fa fa-map-marker margin-r-5"></i>  Address</strong>
                  			<p class="text-muted"><?php echo $driver->address;?>.</p>
                  		</li>
		                <li>
			                <strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>
		                  	<p class="text-muted"><?php echo $driver->phone;?></p>
	                  	</li>
		                <li>
		                	<strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                  			<p class="text-muted"><?php echo $driver->email;?></p>
		                </li>
		                <li>
		                	<strong><i class="fa fa-calendar-o margin-r-5"></i> Member Since</strong>
                  			<p><?php $date=date_create($driver->createdDate);
							echo date_format($date,"M d, Y");	?>.</p>
		                </li>
		            </ul>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-9">
        	
	    <div class="box box-success">
	        <div class="box-header with-border">
		          	<h3 class="box-title">Document</h3>
		          	
		        </div><!-- /.box-header -->
		        <div class="box-body">
		        	<div class="row">
						<div class="col-md-4">
		          			<div class="box box-default">
				                <div class="box-header with-border">
				                  	<h3 class="box-title">NPWP</h3>
				                </div><!-- /.box-header -->
				                <div class="box-body">
				                  	<img class="img-responsive pad" src="<?php echo base_url(); ?>themesAdmin/dist/img/photo2.png" alt="Photo">
									<ul class="nav nav-stacked">
						                <li><strong><i class="fa fa-calendar-o margin-r-5"></i>  Expired Date</strong>
				                  			<p class="text-muted"><?php echo $driver->address;?>.</p>
				                  		</li>
						                <li>
							               <button type="button" class="btn btn-default btn-block"><i class="fa fa-edit"></i>&nbsp;Edit</button>
					                  	</li>
						            </ul>
				                </div><!-- /.box-body -->
				            </div><!-- /.box -->
		            	</div>
		            	<div class="col-md-4">
		          			<div class="box box-default">
				                <div class="box-header with-border">
				                  	<h3 class="box-title">SIM</h3>
				                </div><!-- /.box-header -->
				                <div class="box-body">
				                  	<img class="img-responsive pad" src="<?php echo base_url(); ?>themesAdmin/dist/img/photo2.png" alt="Photo">
									<ul class="nav nav-stacked">
						                <li><strong><i class="fa fa-calendar-o margin-r-5"></i>  Expired Date</strong>
				                  			<p class="text-muted"><?php echo $driver->address;?>.</p>
				                  		</li>
						                <li>
							               <button type="button" class="btn btn-default btn-block"><i class="fa fa-edit"></i>&nbsp;Edit</button>
					                  	</li>
						            </ul>
				                </div><!-- /.box-body -->
				            </div><!-- /.box -->
		            	</div>
		            	<div class="col-md-4">
		          			<div class="box box-default">
				                <div class="box-header with-border">
				                  	<h3 class="box-title">SKCK</h3>
				                </div><!-- /.box-header -->
				                <div class="box-body">
				                  	<img class="img-responsive pad" src="<?php echo base_url(); ?>themesAdmin/dist/img/photo2.png" alt="Photo">
									<ul class="nav nav-stacked">
						                <li><strong><i class="fa fa-calendar-o margin-r-5"></i>  Expired Date</strong>
				                  			<p class="text-muted"><?php echo $driver->address;?>.</p>
				                  		</li>
						                <li>
							               <button type="button" class="btn btn-default btn-block"><i class="fa fa-edit"></i>&nbsp;Edit</button>
					                  	</li>
						            </ul>
				                </div><!-- /.box-body -->
				            </div><!-- /.box -->
		            	</div>
		            </div>
		        </div><!-- /.box-body -->
		        <div class="box-footer clearfix">
		        </div><!-- /.box-footer -->
		    </div><!-- /.box -->



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





