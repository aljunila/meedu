<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datepicker/datepicker3.css">
<link href="<?php echo base_url(); ?>themesFront/css/prettyPhoto.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/colorpicker/bootstrap-colorpicker.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>themes/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,|,ltr,rtl,|,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		content_css : "<?php echo base_url(); ?>themes/tinymce/examples/css/word.css",
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "<?php echo base_url(); ?>themes/tinymce/examples/lists/template_list.js",
		external_link_list_url : "<?php echo base_url(); ?>themes/tinymce/examples/lists/link_list.js",
		external_image_list_url : "<?php echo base_url(); ?>themes/tinymce/examples/lists/image_list.js",
		media_external_list_url : "<?php echo base_url(); ?>themes/tinymce/examples/lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
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
                  <h3 class="box-title">Detail Berita</h3>
                 
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
							echo form_open_multipart('news/add_news','class="form-horizontal" role="form"');
							$hidden_data_user = array(
								'new_news_config'=>true
							);
							echo form_hidden($hidden_data_user);
						} else {
							echo form_open_multipart('news/add_news','class="form-horizontal" role="form"');
							$hidden_data_user = array(
								'id' => $data->id,
								'new_news_config'=> false,
								'img' => $data->image
								
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
						<label class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="title" id="title" <?php if(!isset($new_data)){ echo 'value="'.$data->title.'"'; } ?> autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Isi Berita</label>
						<div class="col-sm-8">
							<textarea type="text" name="content" id="content" class="form-control"><?php if(!isset($new_data)){ echo $data->content; } ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Mulai dipublikasikan</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" autocomplete="off" placeholder="Tanggal mulai dipublikasikan" id="datepicker3" name="p_date" <?php if(!isset($new_data)){ 
								$fStartDate = date("d/m/Y", strtotime($data->publish_date));
								echo 'value="'.$fStartDate.'"'; 
								} ?> >
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Selesai Dipublikasikan</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" autocomplete="off" placeholder="Tanggal selesai dipublikasikan"  id="datepicker4" name="u_date" <?php if(!isset($new_data)){ 
								$fEndDate = date("d/m/Y", strtotime($data->unpublish_date));
								echo 'value="'.$fEndDate.'"'; 
								} ?> >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Gambar</label>
						<div class="col-sm-5">
							<?php if(!isset($new_data)){?>

							<div heigh="100%">
							<?php if($data->image!=''){?>
								<!-- <a class="preview" href="<?php echo base_url(); ?>data/kajian/img/<?php echo $news_config->img;?>" rel="prettyPhoto"> -->
                                <img src="<?php echo base_url(); ?>data/news/<?php echo $data->image;?>" alt="" width="192px" height="128px">
                                <!-- </a> -->
                                <br> 
                             <?php }?>
                             Untuk ubah gambar
                            </div>
                            <?php } ?>
							<input type="file" class="form-control" name="image" <?php if(!isset($new_data)){ echo 'value="'.$data->image.'"'; } ?> >
							<span><em><span class="text-bold">format:</span> jpg, png, gif</em></span>
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

<script type="text/javascript">

$(document).ready(function(){

    $('#datepicker3').datepicker({
      autoclose: true,
       format: 'dd/mm/yyyy'
    });

     $('#datepicker4').datepicker({
      autoclose: true,
       format: 'dd/mm/yyyy'
    });

     //color picker with addon
    $(".my-colorpicker2").colorpicker();

    populateSelect();

});
</script>



