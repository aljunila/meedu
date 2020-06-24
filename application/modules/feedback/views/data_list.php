<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datepicker/datepicker3.css">
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
      <div id="modal-status">
      </div>  
    </div>
        
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li <?php if(!isset($tab) || $tab =='activity'){ echo 'class="active"';}?>>
            <a href="#activity" data-toggle="tab">List Data</a>
          </li>

          
        </ul>
        
        <div class="tab-content">
          <!-- TAB BILLBOARD-->
          <div class=" <?php if(!isset($tab) || $tab =='activity'){ echo 'active';}?> tab-pane" id="activity">
            <div class="row">
              <div class="col-sm-12">
                <div></div>   
                <div id="table-data"></div>
              </div>
            </div>
          </div><!-- /.tab-pane -->

        </div><!-- /.tab-content -->
      </div><!-- /.nav-tabs-custom -->

    </div><!-- /.col -->
  </div><!-- /.row -->

   <!-- MODAL DETAIL ANNOUNCEMENT-->
  <div class="modal modal-default fade" id="detailData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-md"></i>&nbsp;&nbsp;Detail <?php echo $title;?></h4>
        </div>
        <div class="modal-body">
          	<input type="text" name="a_new_data" id ="a_new_data" style="display: none;">
          	<input type="text" name="a_id" id = "a_id" style="display: none;" >
        	
            <div class="row">
        			<div class="col-sm-12">
                <div class="form-group row">
                  <div class="col-sm-12 text-green text-bold">
                    Akun Pengguna
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Akun Pengguna"  name="a_username" id="a_username" autofocus>
                  </div>
                </div>
                 <div class="form-group row">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-9 ">
                    <input type="password" class="form-control" placeholder="password anda"  name="a_pwd" id="a_pwd">
                  </div>
                </div>
                 <div class="form-group row">
                  <label class="col-sm-2 control-label">Ulangi Password</label>
                  <div class="col-sm-9 ">
                    <input type="password" class="form-control" placeholder="Ulangi Kata Sandi Anda"  name="a_r_pwd" id="a_r_pwd" >
                  </div>
                </div> 
                 <div class="form-group row">
                  <hr>
                  <div class="col-sm-12 text-green text-bold">
                    Profil Singkat
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label">Nama Dirjen</label>
                  <div class="col-sm-9 ">
                      <select name="a_unit" id ="a_unit" class="form-control" >
                        <option value="">-- Pilih Dirjen --</option>
                        <?php foreach ($data_dirjen as $dt_dirjen) {?>
                            <option value="<?php echo $dt_dirjen->id;?>"> <?php echo $dt_dirjen->name;?></option>
                        <?php } ?>
                      
                       
                      </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label">Nama Direktorat</label>
                  <div class="col-sm-9 ">
                      <div id="direktorat-data">
                        <select name="a_sub_unit" id ="a_sub_unit" class="form-control" >
                          <option value="">-- Pilih Satuan Kerja --</option>
                        </select>
                      </div>
                  </div>
                </div>

                 <div class="form-group row">
                  <label class="col-sm-2 control-label">NIK</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Nomor induk kependudukan"  name="a_nik" id="a_nik">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label">NIP</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Nomor induk pegawai"  name="a_nip" id="a_nip">
                  </div>
                </div>

                <div class="form-group row">
        					<label class="col-sm-2 control-label">Nama</label>
        					<div class="col-sm-9 ">
        						<input type="text" class="form-control" placeholder="Nama"  name="a_name" id="a_name">
        					</div>
        				</div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Tgl Lahir</label>
                  <div class="col-sm-9 ">
                      <input type="text" class="form-control" placeholder="klik untuk mendapatkan tgl"  name="a_date" id="a_date">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Jenis Kelamin</label>
                  <div class="col-sm-9 ">
                      <select name="a_gender" id ="a_gender" class="form-control" >
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Nomor Hp</label>
                  <div class="col-sm-9 ">
                      <input type="text" class="form-control" placeholder="No Hp"  name="a_phone" id="a_phone">
                  </div>
                </div>
                 <div class="form-group row">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-9 ">
                      <input type="email" class="form-control" placeholder="Alamat Email"  name="a_email" id="a_email">
                  </div>
                </div>
            </div>
    			</div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo $this->lang->line('alert_btn_negative')?></button>
          <button type="button" class="btn btn-success" onClick ="detailData()"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <!-- MODAL ANNOUNCE DELETE-->
   <div class="modal modal-warning fade" id="deleteData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt-alt"></i> Konfirmasi Hapus</h4>
	        </div>
	        <div class="modal-body">
	         <input type="text" name="a_id_d" id = "a_id_d" style="display: none;" >
	          <p class="error-text">apakah anda yakin ingin menghapus data ini ?</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
	          <a id="delData" href="#"><button type="button" class="btn btn-outline" onclick="ajaxDeleteData()">Hapus</button></a>
	        </div>
	      </div>
	    </div>
  	</div>

  <!-- MODAL NEWS DELETE-->
   <div class="modal modal-warning fade" id="deleteNews" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt-alt"></i> Konfirmasi Hapus</h4>
	        </div>
	        <div class="modal-body">
	        <input type="text" name="a_id_d" id = "n_id_d" style="display: none;" >
	          <p class="error-text">apakah anda yakin ingin menghapus berita ini ?</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
	          <a id="delData" href="#"><button type="button" class="btn btn-outline" onclick="ajaxDeleteNews()">Hapus</button></a>
	        </div>
	      </div>
	    </div>
  	</div>


   <!--MODAL NEWS PREVIEW-->
    <div class="modal modal-default fade" id="ch_news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-gear"></i>&nbsp;Tinjau Berita</h4>
          </div>
          <div class="modal-body">
            <div class="text-justify">
              <img class="img-responsive" id="print-news-img">
              <label class="text-bold text-red" style="font-size: 16px; margin-bottom: 3px;" id="print-news-title"></label> 
              <div id="print-news-content"></div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Selesai</button>
          </div> 
        </div>
      </div>
    </div>

</section><!-- /.content -->




<script>
$(document).ready(function(){
    populateData();
    $('#a_date').datepicker({
      autoclose: true,
       format: 'dd/mm/yyyy'
    });
});


function populateData(){
  var id = '';
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('feedback/populate_data')?>",
    data: { 
      id :id,
         },
    success: function(response){
	    var jsontext  = response;
	    var getData = JSON.parse(jsontext);
	    $("#table-data").html(getData.table_data);
    }
  }); 
}



</script>

     

