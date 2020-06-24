
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
						if(isset($new_user)) {
							echo form_open_multipart('priviledge/add_user','class="form-horizontal" role="form"');
						} else {
							echo form_open_multipart('priviledge/edit_user/save','class="form-horizontal" role="form"');
							$hidden_data_user = array(
								'id' => $datas->id
							);
							echo form_hidden($hidden_data_user);
						}
					
					if(isset($new_user)) { ?>
					<div class="form-group" id="menu_id">
						<label class="col-sm-2 control-label">Nama Staff</label>
						<div class="col-sm-6">
							 <select name="staffid" class="form-control">
							 	<option>Pilih</option>
								<?php foreach($staff as $s) { ?>
								  		<option value="<?php echo $s->id; ?>"><?php echo $s->fullname; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>	
				<?php } ?>
					<div class="form-group" id="menu_id">
						<label class="col-sm-2 control-label">Menu</label>
						<div class="col-sm-6">
							<select name="user_group" class="form-control">
							<option>Pilih</option>
								<?php foreach($all_priviledge as $as)
								 { if(isset($new_user)) { ?>
								  	<option value="<?php echo $as->id; ?>"><?php echo $as->priviledge_name; ?></option>
								<?php  } else { ?>
									 <option value="<?php echo $as->id; ?>" <?php if($datas->pvg_id == $as->id) { echo "selected='selected'"; } else { echo ""; } ?>><?php echo $as->priviledge_name; ?></option>
								<?php } }?>
							</select>
						</div>
					</div>	
							<!-- button save new enduser -->
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-5">
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>&nbsp;
									<?php if(!isset($new_user)){ ?>
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

    <script type="text/javascript">
	 $( document ).ready(function() {
        // moment.locale('id');
        // $( ".tgl_transaksi" ).each(function() {
        //   var el = $( this );
        //   var timeValue = el.text();
        //   var strTimeAgo = moment(timeValue).format('ll');
        //   el.text(strTimeAgo);
        // });
        $('#filter_search').on('change', function () {
        	 $('.itemName').select2('val','');
        	 $('.itemName').empty().trigger('change');
        	autoComplete();
		 });
        // $('#datepicker2').hide();
        // ajaxPopulate();
        autoComplete();	
    });

	 function autoComplete(){


		var fs = document.getElementById("filter_search").value;
		// alert(fs);

			urls = '<?php echo site_url('pos/get_allstudent_byname')?>';

		$('.itemName').select2({
		    placeholder: 'Klik untuk input ',
		    ajax: {
		      url: urls,
		      dataType: 'json',
		      delay: 250,
		      processResults: function (data) {
		        return {
		          results: data
		        };
		      },
		      cache: true
		    }
		});
	}
	
</script>



