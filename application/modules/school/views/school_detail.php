
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo $title; ?>
    <small><?php if(isset($new_data)) { echo '<i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Tambah'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Ubah'; } ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>" tooltip="Goto Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('school/school_crud/0-0')?>"><?php echo $title; ?></a></li>
        <li class="active"><?php if(isset($new_data)) { echo '<i class="fa fa-clipboard"></i>&nbsp;&nbsp;Tambah'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Ubah'; } ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-10">
        	    <!-- TABLE: LATEST ORDERS -->
            <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Detail Sekolah</h3>
                 
                </div><!-- /.box-header -->
                <div class="box-body">
	                <?php	if(@$status){ ?>
					<div class="<?php echo $alert; ?> alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $status; ?>
					</div>
					<?php } ?>

					
                 
                 	<?php
						if(isset($new_data)) {
							echo form_open_multipart('school/add_school','class="form-horizontal" role="form"');
						} else {
							echo form_open_multipart('school/edit_school/save','class="form-horizontal" role="form"');
							$hidden_data_user = array(
								'id' => $data->id
							);
							echo form_hidden($hidden_data_user);
						}
					?>


					<!-- <div class="form-group">
						<label class="col-sm-2 control-label">Kode Mapel</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" placeholder="Contoh: MAT1"  name="subject_code" <?php if(!isset($new_data)){ echo 'value="'.$data->subject_code.'"'; } ?> autofocus>
						</div>
					</div> -->


					<div class="form-group">
						<label class="col-sm-2 control-label">Nama Sekolah</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="name" <?php if(!isset($new_data)){ echo 'value="'.$data->name.'"'; } ?> autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Alamat</label>
						<div class="col-sm-8">
							<textarea name="address" class="form-control"><?php if(!isset($new_data)){ echo $data->address; } ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Telephone</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="telp" <?php if(!isset($new_data)){ echo 'value="'.$data->telp.'"'; } ?> autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="email" <?php if(!isset($new_data)){ echo 'value="'.$data->email.'"'; } ?> autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Akreditasi Sekolah</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="accreditation" <?php if(!isset($new_data)){ echo 'value="'.$data->accreditation.'"'; } ?> autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Kurikulum</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="curriculum" <?php if(!isset($new_data)){ echo 'value="'.$data->curriculum.'"'; } ?> autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Penyelenggaraan</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="implementation" <?php if(!isset($new_data)){ echo 'value="'.$data->implementation.'"'; } ?> autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Akses Internet</label>
						<div class="col-sm-8">
							<select name="internet" class="form-control">
								<option value="Y"> Ada</option>
								<option value="Y"> Tidak</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Ruang Kelas</label>
						<div class="col-sm-8">
							<input type="number" class="form-control" name="classroom" <?php if(!isset($new_data)){ echo 'value="'.$data->classroom.'"'; } ?> autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Laboratorium</label>
						<div class="col-sm-8">
							<input type="number" class="form-control" name="laboratorium" <?php if(!isset($new_data)){ echo 'value="'.$data->laboratorium.'"'; } ?> autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Perpustakaan</label>
						<div class="col-sm-8">
							<input type="number" class="form-control" name="library" <?php if(!isset($new_data)){ echo 'value="'.$data->library.'"'; } ?> autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Luas Tanah</label>
						<div class="col-sm-7">
							<input type="number" class="form-control" name="s_area" <?php if(!isset($new_data)){ echo 'value="'.$data->surface_area.'"'; } ?> autofocus> 
						</div>
						<label class="col-sm-1 control-label">m2</label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Jumlah Guru</label>
						<div class="col-sm-8">
							<input type="number" class="form-control" name="teachers" <?php if(!isset($new_data)){ echo 'value="'.$data->teachers.'"'; } ?> autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Jumlah Murid Laki-laki</label>
						<div class="col-sm-8">
							<input type="number" class="form-control" name="m_students" <?php if(!isset($new_data)){ echo 'value="'.$data->m_students.'"'; } ?> autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Jumlah Murid Perempuan</label>
						<div class="col-sm-8">
							<input type="number" class="form-control" name="f_students" <?php if(!isset($new_data)){ echo 'value="'.$data->f_students.'"'; } ?> autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Management Berbasis Sekolah</label>
						<div class="col-sm-8">
							<select name="school_mng" class="form-control">
								<option value="Y"> Ada</option>
								<option value="Y"> Tidak</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Website</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="website" <?php if(!isset($new_data)){ echo 'value="'.$data->website.'"'; } ?> autofocus>
						</div>
					</div>
						<?php if(!isset($new_data)){ ?>
							<div class="modal modal-warning fade" id="deleteMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt-alt"></i>&nbsp;&nbsp;<?php echo $this->lang->line('alert_title_delete')?></h4>
										</div>
										<div class="modal-body">
											<p class="error-text"><?php echo $this->lang->line('alert_data_delete')?></p>
										</div>
										<div class="modal-footer">
						                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><?php echo $this->lang->line('alert_btn_negative')?></button>
						                    <a href="<?php echo site_url('ekskul/ekskul_crud/'.$data->id.'-3'); ?>"><button type="button" class="btn btn-outline"><?php echo $this->lang->line('alert_btn_positive_delete')?></button></a>
						                </div>
										
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div>
							<?php } ?>

							<!-- button save new enduser -->
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-5">
									
								</div>
							</div>
						
						
						
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                	<div class="pull-right">
	                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $this->lang->line('caption_btn_save')?></button>&nbsp;
					<?php if(!isset($new_data)){ ?>
					<button type='button' class="btn btn-danger-o" data-toggle="modal" data-target="#deleteMessage" ><i class="fa fa-trash-alt-alt"></i> <?php echo $this->lang->line('caption_btn_delete')?></button>
					<?php } else{ ?>
					<button type="reset" class="btn btn-danger-o	"><i class="fa fa-eraser"></i>  <?php echo $this->lang->line('caption_btn_clear')?></button>
					<?php } ?>
					</div>
                </div><!-- /.box-footer -->
                <?php echo form_close(); ?>
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->



