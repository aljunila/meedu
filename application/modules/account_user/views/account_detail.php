
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo $title; ?>
    <small><?php if(isset($new_institution)) { echo '<i class="fa fa-user"></i>&nbsp;&nbsp;New Akun	'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Akun'; } ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>" tooltip="Goto Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#"><?php echo $title; ?></a></li>
        <li class="active"><?php if(isset($new_enduser)) { echo '<i class="fa fa-user"></i>&nbsp;&nbsp;New Akun'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Akun'; } ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-10">
        	    <!-- TABLE: LATEST ORDERS -->
            <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Account View</h3>
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
						echo form_open_multipart('account_user/edit_account/save','class="form-horizontal" role="form"');
						$hidden_data_user = array(
							'id' => $account->id
						);
						echo form_hidden($hidden_data_user);
					?>

					<span class="text-green">PROFIL SINGKAT</span>
					<hr style="padding:  10px 0 ! important;margin: 0 !important;">
					<div class="form-group">
						<label class="col-sm-2 control-label">Nama Lengkap</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" placeholder="Password"  name="fullname" <?php if(!isset($new_data)){ echo 'value="'.$account->fullname.'"'; } ?> >
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">NIK</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" placeholder="nomor induk kependudukan"  name="nik" <?php if(!isset($new_data)){ echo 'value="'.$account->nik.'"'; } ?> >
						</div>
					</div>

					<span class="text-green">AKUN PENGGUNA</span>
					<hr style="padding:  10px 0 ! important;margin: 0 !important;">
					<div class="form-group">
						<label class="col-sm-2 control-label">Username/email</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" placeholder="Akun User"  name="username" <?php if(!isset($new_data)){ echo 'value="'.$account->username.'"'; } ?> readonly='readonly'>
						</div>
					</div>

					
					<span class="text-green">UBAH PASSWORD</span>
					<hr style="padding:  10px 0 ! important;margin: 0 !important;">
					<div class="form-group">
						<label class="col-sm-2 control-label">Kata Sandi Lama</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" placeholder="Kata Sandi Lama"  name="old_password" >
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Kata Sandi Baru</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" placeholder="Kata Sandi Baru"  name="password" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Verifikasi Kata Sandi Baru</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" placeholder="Verifikasi Kata Sandi Baru"  name="re_password" >
						</div>
					</div>



					
			
					
					
						
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                <!-- button save new enduser -->
					<div class="pull-right">
						<a href="<?php echo site_url('dashboard/dashboard_crud/0-0'); ?>"><button type='button' class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</button></a>&nbsp;
						<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>&nbsp;
						<button type="reset" class="btn btn-danger-o"><i class="fa fa-eraser"></i> Bersihkan</button>
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



