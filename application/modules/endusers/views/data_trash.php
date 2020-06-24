<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datepicker/datepicker3.css">
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
    <small>list</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>" rel="tooltip-top" title="Goto Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#"><?php echo $title; ?></a></li>
    <li class="active">List</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
	  <div class="col-md-12">
     <div id="modal-status"></div>      
    </div>
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li <?php if(!isset($tab) || $tab =='activity'){ echo 'class="active"';}?>>
            <a href="#activity" data-toggle="tab">Data Terhapus</a>
          </li>
        </ul>

        <div class="tab-content">
          <div class=" <?php if(!isset($tab) || $tab =='activity'){ echo 'active';}?> tab-pane" id="activity">
            <div class="post">
              <div class="row">
                <div class="col-sm-12">
                   <div id="table-data"></div>
                </div>
              </div>
            </div><!-- /.post -->
          </div><!-- /.tab-pane -->

        </div><!-- /.tab-content -->
      </div><!-- /.nav-tabs-custom -->

    </div><!-- /.col -->
  </div><!-- /.row -->


  <!-- MODAL NEWS DELETE-->
   <div class="modal modal-danger fade" id="delete_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt"></i> Konfirmasi Hapus</h4>
	        </div>
	        <div class="modal-body">
	        <input type="text" name="a_id_d" id = "n_id_d" style="display: none;" >
	          <p class="error-text">apakah anda yakin ingin menghapus secara permanen data ini ?</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
	          <a id="delData" href="#"><button type="button" class="btn btn-outline" onclick="ajax_delete_data()">Hapus</button></a>
	        </div>
	      </div>
	    </div>
  	</div>

</section><!-- /.content -->




<script>
$(document).ready(function(){
    populate_data();
});

function populate_data(){
  loadingOverlay(true);
  var id = '';
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('clients/populate_data_deactive')?>",
    data: { 
      id :id,
         },
    success: function(html){
      loadingOverlay(false);
	    var jsontext  = html;
	    var getData = JSON.parse(jsontext);
	    $("#table-data").html(getData.table_data);
    }
  }); 
}


function prepare_delete_data(id){
  $('#delete_data').modal('show');
  document.getElementById("n_id_d").value = id;
}

function ajax_delete_data(){
  loadingOverlay(true);
  var id= $('#n_id_d').val();
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('clients/delete_data_permanent')?>",
    data: { 
        id :id,
         },
    success: function(html){
      loadingOverlay(false);
      var jsontext   = html;
      var getData = JSON.parse(jsontext);
      $("#modal-status").html(getData.alert_modal);
      populate_data();
      
    }
  }); 
  $('#delete_data').modal('hide');
}


function ajax_restore_data(id){
  loadingOverlay(true);
  var id= id;
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('clients/restore_data')?>",
    data: { 
        id :id,
         },
    success: function(html){
      loadingOverlay(false);
      var jsontext   = html;
      var getData = JSON.parse(jsontext);
      $("#modal-status").html(getData.alert_modal);
      populate_data();
      
    }
  }); 
  $('#delete_data').modal('hide');
}


</script>

     

