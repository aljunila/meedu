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
      <div id="modal-status"></div> 
    </div>     

    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li <?php if(!isset($tab) || $tab =='activity'){ echo 'class="active"';}?>>
            <a href="#activity" data-toggle="tab">List <?php echo $title; ?></a>
          </li>
        </ul>
        
        <div class="tab-content">
          <div class=" <?php if(!isset($tab) || $tab =='activity'){ echo 'active';}?> tab-pane" id="activity">
            <div class="post">
               <div class="row">
                  <div class="col-sm-12">

                    <div class="row pull-right" id="filter-search" style="min-width: 380px;display: none;" >
                      <div class="col-md-4 text-right">
                        <div style="padding-top:6px;">Filter</div>
                      </div>
                      <div class="col-md-4">
                        <select name="e_ta_id" class="form-control" id="e_ta_id">
                       
                        <?php foreach($all_tajar as $ta){ ?>
                          <option value="<?php echo $ta->id; ?>"
                              <?php  if ($ta->id ==$tajar_active){ echo 'selected="Selected"'; } ?>
                           >
                          <?php  
                            echo $ta->start_ta.'/'.$ta->end_ta;
                            if ($ta->id ==$tajar_active){  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- ACTIVE --'; 
                          }?>
                          </option>
                        <?php } ?>
                        </select>

                      </div>
                      
                      <div class="col-md-4 ">
                         <select name="e_level_id" class="form-control" id="e_level_id">
                          <option value="">Semua</option>
                          <?php foreach($all_tingkat as $tingkat) { ?>
                              <?php echo '<option value = "'.$tingkat->id.'"';?>
                              <?php echo '>'.$tingkat->name.' </option>'?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div>
                     <!--  <?php if($this->session->userdata('user_group_id')=='1'){?>
                       <a href="#" onClick="prepare_add_data();" class="btn btn-warning" role="button"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<?php echo $this->lang->line('new').' Pendaftaran'; ?></a> 
                      <br><br>
                      <?php } ?> -->
                    </div>     

                    <div id="table-data"></div>

                  </div>
                </div>
            </div><!-- /.post -->
          </div><!-- /.tab-pane -->

        </div><!-- /.tab-content -->
      </div><!-- /.nav-tabs-custom -->

    </div><!-- /.col -->
  </div><!-- /.row -->

    <div class="modal modal-default fade" id="ubahmdc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Ubah Proses</h4>
            </div>
             <form class="form-horizontal" action="<?php echo base_url('terbang/ubah_medical')?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
              <input class="text-green" type="text" name="m_id" id ="m_id" style="display: none;">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group row">
                    <label class="col-sm-2 control-label">Hasil Medical</label>
                    <div class="col-sm-9 ">
                       <!-- <div id="table-status"></div> -->
                        <select name='medical' id='medical' class="form-control">
                          <option value="FIT">Fit</option>
                          <option value="FIT">Unfit</option>
                    </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label">Upload File</label>
                    <div class="col-sm-9 ">
                        <input class="form-control" type="file" name="image[]" id ="image[]">
                    </div>
                  </div>
                </div>
              </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-o pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo $this->lang->line('alert_btn_negative')?></button>
                <button type="submit" class="btn btn-success-o" ><i class="fa fa-save"></i> Simpan</button>
            </div>
          </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>

    <div class="modal modal-default fade" id="ubahpsp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Ubah Proses</h4>
            </div>
             <form class="form-horizontal" action="<?php echo base_url('terbang/ubah_paspor')?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
              <input class="text-green" type="text" name="p_id" id ="p_id" style="display: none;">
              <div class="row">
                <div class="col-sm-12">
                   <div class="form-group row">
                        <label class="col-sm-3 control-label">Tanggal Pengajuan</label>
                        <div class="col-sm-9 ">
                          <input type="text" class="form-control" name="d_pengajuan" id="d_pengajuan">
                        </div>
                  </div>
                  <div class="form-group row">
                        <label class="col-sm-3 control-label">Tanggal Buat</label>
                        <div class="col-sm-9 ">
                          <input type="text" class="form-control" name="d_buat" id="d_buat">
                        </div>
                  </div>
                  <div class="form-group row">
                        <label class="col-sm-3 control-label">Tanggal Expired</label>
                        <div class="col-sm-9 ">
                          <input type="text" class="form-control" name="d_expired" id="d_expired">
                        </div>
                  </div>
                  <div class="form-group row">
                        <label class="col-sm-3 control-label">Tanggal Penyerahan</label>
                        <div class="col-sm-9 ">
                          <input type="text" class="form-control" name="d_serah" id="d_serah">
                        </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 control-label">Upload File</label>
                    <div class="col-sm-9 ">
                        <input class="form-control" type="file" name="image[]" id ="image[]">
                    </div>
                  </div>
                </div>
              </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-o pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo $this->lang->line('alert_btn_negative')?></button>
                <button type="submit" class="btn btn-success-o" ><i class="fa fa-save"></i> Simpan</button>
            </div>
          </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>

      <div class="modal modal-default fade" id="ubahpsj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Ubah Proses</h4>
            </div>
             <form class="form-horizontal" action="<?php echo base_url('terbang/ubah_psj')?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
              <input class="text-green" type="text" name="s_id" id ="s_id" style="display: none;">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group row">
                        <label class="col-sm-3 control-label">Ubah Status</label>
                        <div class="col-sm-9 ">
                         <select name="status" id="status" class="form-control">
                            <option value='TB'>Terbang</option>
                          </select>
                        </div>
                  </div>
                </div>
              </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-o pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo $this->lang->line('alert_btn_negative')?></button>
                <button type="submit" class="btn btn-success-o" ><i class="fa fa-save"></i> Simpan</button>
            </div>
          </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>

     <div class="modal modal-default fade" id="ubahsj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Ubah Proses</h4>
            </div>
             <form class="form-horizontal" action="<?php echo base_url('terbang/ubah_sj')?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
              <input class="text-green" type="text" name="j_id" id ="j_id" style="display: none;">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group row">
                        <label class="col-sm-3 control-label">Tanggal Stempel</label>
                        <div class="col-sm-9 ">
                          <input type="text" class="form-control" name="d_stempel" id="d_stempel">
                        </div>
                  </div>
                  <div class="form-group row">
                        <label class="col-sm-3 control-label">Tanggal Sidik Jari</label>
                        <div class="col-sm-9 ">
                          <input type="text" class="form-control" name="d_sidikjari" id="d_sidikjari">
                        </div>
                  </div>
                </div>
              </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-o pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo $this->lang->line('alert_btn_negative')?></button>
                <button type="submit" class="btn btn-success-o" ><i class="fa fa-save"></i> Simpan</button>
            </div>
          </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
      
      <div class="modal modal-default fade" id="ubahrtb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Ubah Proses</h4>
            </div>
             <form class="form-horizontal" action="<?php echo base_url('terbang/ubah_ptb')?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
              <input class="text-green" type="text" name="t_id" id ="t_id" style="display: none;">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group row">
                        <label class="col-sm-3 control-label">Ubah Status</label>
                        <div class="col-sm-9 ">
                         <select name="status" id="status" class="form-control">
                            <option value='PTB'>Panggilan Terbang</option>
                          </select>
                        </div>
                  </div>
                </div>
              </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-o pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo $this->lang->line('alert_btn_negative')?></button>
                <button type="submit" class="btn btn-success-o" ><i class="fa fa-save"></i> Simpan</button>
            </div>
          </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>

      <div class="modal modal-default fade" id="ubahcall" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Ubah Proses</h4>
            </div>
             <form class="form-horizontal" action="<?php echo base_url('terbang/ubah_call')?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
              <input class="text-green" type="text" name="b_id" id ="b_id" style="display: none;">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group row">
                        <label class="col-sm-3 control-label">Tanggal Terbang</label>
                        <div class="col-sm-9 ">
                          <input type="text" class="form-control" name="d_flight" id="d_flight">
                        </div>
                  </div>
                  <div class="form-group row">
                        <label class="col-sm-3 control-label">Dari Kota</label>
                        <div class="col-sm-9 ">
                          <input type="text" class="form-control" name="p_flight" id="p_flight">
                        </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 control-label">Upload File</label>
                    <div class="col-sm-9 ">
                        <input class="form-control" type="file" name="image[]" id ="image[]">
                    </div>
                  </div>
                </div>
              </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-o pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo $this->lang->line('alert_btn_negative')?></button>
                <button type="submit" class="btn btn-success-o" ><i class="fa fa-save"></i> Simpan</button>
            </div>
          </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
      

   <!-- MODAL DETAIL ANNOUNCEMENT-->
  <div class="modal modal-default fade" id="detail_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Form Pendaftaran</h4>
        </div>
        <div class="modal-body">
          	<input type="text" name="a_new_data" id ="a_new_data" style="display: none;">
            <input type="text" name="a_id" id = "a_id" style="display: none;" >
          
            <div class="row">
              <div class="col-sm-12">
                 <div class="form-group row">
                  <hr>
                  <div class="col-sm-12 text-green text-bold">
                    Profil Singkat
                  </div>
                </div>
                 <div class="form-group row">
                  <label class="col-sm-2 control-label">Negara Tujuan</label>
                  <div class="col-sm-9 ">
                    <select name="a_country" id="a_country" class="form-control">
                      <option>Pilih Negara Tujuan</option>
                      <?php 
                        foreach ($country as $c) { ?>
                            <option value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Nama Penanggungjawab</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Penanggungjawab"  name="a_pj" id="a_pj">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Sponsor</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Sponsor"  name="a_sponsor" id="a_sponsor">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Nama Lengkap</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Nama"  name="a_name" id="a_name">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Tempat Lahir</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Tempat Lahir"  name="a_pob" id="a_pob">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Tanggal Lahir</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Tanggal Lahir"  name="a_dob" id="a_dob">
                  </div>
                </div>
                 <div class="form-group row">
                  <label class="col-sm-2 control-label">Nomor Telp TKI</label>
                  <div class="col-sm-9 ">
                      <input type="text" class="form-control" placeholder="No Hp"  name="a_phone" id="a_phone">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Alamat Lengkap</label>
                  <div class="col-sm-9 ">
                      <textarea class="form-control" placeholder="Alamat"  name="a_address" id="a_address"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <hr>
                  <div class="col-sm-12 text-green text-bold">
                    Data Keluarga
                  </div>
              </div>
               <div class="form-group row">
                  <label class="col-sm-2 control-label">Nama Bapak</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Nama Bapak"  name="a_father" id="a_father">
                  </div>
                </div>
                 <div class="form-group row">
                  <label class="col-sm-2 control-label">Nama Kakek</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Nama Kakek"  name="a_gfather" id="a_gfather">
                  </div>
                </div>
                 <div class="form-group row">
                  <label class="col-sm-2 control-label">Nama Ibu Kandung</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Nama Ibu Kandung"  name="a_mother" id="a_mother">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Data Anak</label>
                  <div class="col-sm-7 ">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Anak Ke</th>
                          <th>Nama</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="body-inventor">
                      </tbody>
                    </table>
                    <div class="text-right">
                      <button id="btn-add-inv" class="btn btn-success btn-xs" onclick="prepare_add_inventor()"><i class="fa fa-user-plus"></i> Tambah Data</button>
                    </div>
                    <div id="detail_inventor">
                      <hr>
                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Anak Ke</label>
                        <div class="col-sm-9 ">
                           <input type="text" class="form-control" placeholder="Tanggal Prioritas"  name="f_no" id="f_no">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Nama Anak</label>
                        <div class="col-sm-9 ">
                          <input type="text" class="form-control" placeholder="Nama Anak"  name="f_name" id="f_name">
                        </div>
                      </div>
                      <div class="text-right">
                        <button class="btn btn-danger btn-xs" onclick="done_inventor()"><i class="fa fa-caret-up"></i> Tutup</button>
                        <button class="btn btn-success btn-xs" onclick="add_inventor()"><i class="fa fa-user-plus"></i> Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <hr>
                  <div class="col-sm-12 text-green text-bold">
                    Data Kelengkapan
                  </div>
              </div>
              <!-- <div class="form-group row">
                  <div class="col-sm-9 ">
                      <table class="table">
                        <tbody>
                          <?php foreach ($doc as $d) { ?>
                          <tr>
                            <td><?php echo $d->name?> </td>
                            <td class="text-right">
                               <input type="checkbox" id="id_doc" name="id_doc" value="<?php echo $d->id;?>">
                            </td>
                          </tr>
                         <?php } ?>
                        </tbody>

                      </table>
                  </div>
                </div> -->
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Pendidikan</label>
                  <div class="col-sm-9 ">
                    <select name="a_pend" id="a_pend" class="form-control">
                      <option>Pilih Pendidikan</option>
                      <option value="SD">SD</option>
                      <option value="SMP">SMP</option>
                      <option value="SMA/SMK">SMA/SMK</option>
                      <option value="Universitas">Universitas</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Pemahaman Bahasa Arab</label>
                  <div class="col-sm-9 ">
                    <select name="a_language" id="a_language" class="form-control">
                      <option value="LC">Lancar</option>
                      <option value="KLC">Kurang Lancar</option>
                      <option value="TB">Tidak bisa</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Masakan Arab yg dikuasai</label>
                  <div class="col-sm-9 ">
                      <table class="table">
                        <tbody>
                          <tr>
                          <?php foreach ($masakan as $m) { 
                            if($m->id<=7) { ?>
                            <td><input type="checkbox" id="id_cook" name="id_cook" value="<?php echo $m->id;?>"><?php echo $m->name?> </td>
                         <?php } } ?>
                          </tr>
                          <tr>
                          <?php foreach ($masakan as $m) { 
                            if($m->id>=7) { ?>
                            <td><input type="checkbox" id="id_cook" name="id_cook" value="<?php echo $m->id;?>"><?php echo $m->name?> </td>
                         <?php } } ?>
                          </tr>
                        </tbody>

                      </table>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Keahlian Lain</label>
                  <div class="col-sm-7 ">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Keahlian</th>
                          <th>Ket</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="body-ahli">
                      </tbody>
                    </table>
                    <div class="text-right">
                      <button id="btn-add-ahli" class="btn btn-success btn-xs" onclick="prepare_add_ahli()"><i class="fa fa-user-plus"></i> Tambah Data</button>
                    </div>
                    <div id="detail_ahli">
                      <hr>
                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Keahlian</label>
                        <div class="col-sm-9 ">
                           <input type="text" class="form-control" placeholder="Membaca / Menulis / Menjahit / Salon"  name="f_ahli" id="f_ahli">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-9 ">
                          <input type="text" class="form-control" placeholder=""  name="f_ket" id="f_ket">
                        </div>
                      </div>
                      <div class="text-right">
                        <button class="btn btn-danger btn-xs" onclick="done_ahli()"><i class="fa fa-caret-up"></i> Tutup</button>
                        <button class="btn btn-success btn-xs" onclick="add_ahli()"><i class="fa fa-user-plus"></i> Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Pengalaman Kerja ke Luar Negri</label>
                  <div class="col-sm-7 ">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Negara/Kota</th>
                          <th>Lama/Waktu</th>
                          <th>Periode</th>
                          <th>Selesai</th>
                          <th>Kasus/Masalah</th>
                          <th>Keterangan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="body-exp">
                      </tbody>
                    </table>
                    <div class="text-right">
                      <button id="btn-add-exp" class="btn btn-success btn-xs" onclick="prepare_add_exp()"><i class="fa fa-user-plus"></i> Tambah Data</button>
                    </div>
                    <div id="detail_exp">
                      <hr>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label">Negara/Kota</label>
                        <div class="col-sm-9 ">
                           <input type="text" class="form-control"  name="f_country" id="f_country">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label">Lama/Waktu</label>
                        <div class="col-sm-9 ">
                          <input type="text" class="form-control" name="f_time" id="f_time">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label">Periode</label>
                        <div class="col-sm-9 ">
                          <input type="text" class="form-control" name="f_period" id="f_period">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label">Selesai</label>
                        <div class="col-sm-9 ">
                          <input type="text" class="form-control" name="f_end" id="f_end">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label">Kasus/Masalah</label>
                        <div class="col-sm-9 ">
                          <input type="text" class="form-control" name="f_prob;em" id="f_problem">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label">Keterangan</label>
                        <div class="col-sm-9 ">
                          <input type="text" class="form-control" name="f_des" id="f_des">
                        </div>
                      </div>
                      <div class="text-right">
                        <button class="btn btn-danger btn-xs" onclick="done_exp()"><i class="fa fa-caret-up"></i> Tutup</button>
                        <button class="btn btn-success btn-xs" onclick="add_exp()"><i class="fa fa-user-plus"></i> Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger-o pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo $this->lang->line('alert_btn_negative')?></button>
          <button type="button" class="btn btn-success-o" onClick ="detail_data()"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>detail_data

  <!-- MODAL ANNOUNCE DELETE-->
   <div class="modal modal-warning fade" id="delete_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt"></i> Konfirmasi Hapus</h4>
	        </div>
	        <div class="modal-body">
	         <input type="text" name="a_id_d" id = "a_id_d" style="display: none;" >
	          <p class="error-text">apakah anda yakin ingin menghapus data ini ?</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
	          <a id="delData" href="#"><button type="button" class="btn btn-outline" onclick="delete_data()">Hapus</button></a>
	        </div>
	      </div>
	    </div>
  	</div>

</section><!-- /.content -->



<script>
  var array_inventor=[];
  var array_ahli=[];
  var array_exp=[];
  var default_date ='0000-00-00';
  $(document).ready(function(){
    $('#a_ins').hide();
    $('#a_dob').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#d_pengajuan').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#d_buat').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#d_expired').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#d_serah').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#d_stempel').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#d_sidikjari').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#d_flight').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#detail_inventor').hide();
    $('#detail_ahli').hide();
    $('#detail_exp').hide();
    populate_data();
  });

  function populate_data(){
    loadingOverlay(true);
    var id = '';
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('terbang/populate_data_pt')?>",
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

   $('#a_user_type').on('change', function () {

        if($('#a_user_type').val()=='1'){
          // $("#pdId").css({ 'display': "block" });
          $("#a_ins").hide();

        }else if($('#a_user_type').val()=='2'){
          // $("#pdId").css({ '': "none" });
          $("#a_ins").show();

        }else{
          $("#a_ins").hide();
        }

        populate_data();
    });

  function prepare_add_data(){
  	document.getElementById("a_new_data").value = "1";
    clear_modal_data();
    $('#detail_data').modal('show');
  }

  function prepare_edit_data(a){
    document.getElementById("a_new_data").value = "0";
    url ="<?php echo site_url('terbang/data_detail')?>";
    var id = a;
    $.ajax({
      type: "POST",
      url: url,
      data: { 
        id : id
      },
      success: function(jsontext){
        // alert(jsontext);
        var getData = JSON.parse(jsontext);
        document.getElementById("a_name").value = getData.item.name;
        document.getElementById("a_address").value = getData.item.address;
        document.getElementById("a_phone").value = getData.item.phone;
        document.getElementById("a_country").value = getData.item.country;
        document.getElementById("a_pj").value = getData.item.pj;
        document.getElementById("a_sponsor").value = getData.item.sponsor;
        document.getElementById("a_pob").value = getData.item.pob;
        document.getElementById("a_father").value = getData.item.father;
        document.getElementById("a_gfather").value = getData.item.gfather;
        document.getElementById("a_mother").value = getData.item.mother;
        document.getElementById("a_pend").value = getData.item.pend;
        document.getElementById("a_language").value = getData.item.languange;
        $("#a_id").val(getData.item.id);
        $('#detail_data').modal('show');
      }
    });
  }

  function detail_data(){
    // tinyMCE.triggerSave();
    var new_data = $('#a_new_data').val();
    var a_country = $('#a_country').val();
    var a_pj = $('#a_pj').val();
    var a_sponsor = $('#a_sponsor').val();
    var a_name = $('#a_name').val();
    var a_pob = $('#a_pob').val();
    var a_dob = $('#a_dob').val();
    var a_phone = $('#a_phone').val();
    var a_father = $('#a_father').val();
    var a_gfather = $('#a_gfather').val();
    var a_mother = $('#a_mother').val();
    var a_pend = $('#a_pend').val();
    var a_language = $('#a_language').val();
    var a_address = document.getElementById("a_address").value ;
    if(new_data == '1'){
      datas = { 
        country : a_country,
        address : a_address,
        phone : a_phone,
        pj : a_pj,
        sponsor : a_sponsor,
        name : a_name,
        pob : a_pob,
        dob : a_dob,
        father : a_father,
        gfather : a_gfather,
        mother : a_mother,
        pend : a_pend,
        language : a_language,
        anak : array_inventor,
        ahli : array_ahli,
        exp : array_exp,
        new_data : new_data,
      };
      url ="<?php echo site_url('terbang/add_data')?>";
    } else {
      var id = $('#a_id').val();
      datas = { 
        id : id,
        country : a_country,
        address : a_address,
        phone : a_phone,
        pj : a_pj,
        sponsor : a_sponsor,
        name : a_name,
        pob : a_pob,
        dob : a_dob,
        father : a_father,
        gfather : a_gfather,
        mother : a_mother,
        pend : a_pend,
        language : a_language,
        anak : array_inventor,
        ahli : array_ahli,
        exp : array_exp,
        new_data : new_data,
      };
      url ="<?php echo site_url('terbang/edit_data')?>";
    }


    $.ajax({
      type: "POST",
      url: url,
      data: datas,
      success: function(jsontext){
        var getData = JSON.parse(jsontext);
        $("#modal-status").html(getData.alert_modal);
        clear_modal_data();
         $('#detail_data').modal('hide');
        populate_data();
      }
    });
  }

  function prepare_delete_data(id){
    $('#delete_data').modal('show');
    document.getElementById("a_id_d").value = id;
  }

  function delete_data(){
    loadingOverlay(true);
    var id= $('#a_id_d').val();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('clients/delete_data')?>",
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


  function clear_modal_data(){
    $('#detail_data').on('hidden.bs.modal', function (e) {
      $(this)
        .find("input,textarea,select")
           .val('')
           .end()
        .find("input[type=checkbox], input[type=radio]")
           .prop("checked", "")
           .end();
    });
  }



  $.date = function(orginaldate) { 
      var date = new Date(orginaldate);
      var day = date.getDate();
      var month = date.getMonth() + 1;
      var year = date.getFullYear();
      if (day < 10) {
          day = "0" + day;
      }
      if (month < 10) {
          month = "0" + month;
      }
      var date =  month + "/" + day + "/" + year; 
      return date;
  };

  function fetch_inventor(){
  var table = '';
  for (var arr in array_inventor) {
    console.log(array_inventor[arr]);
        table = table +
        '<tr>'+
        '<td>'+array_inventor[arr].no+'</td>'+
        '<td>'+array_inventor[arr].name+'</td>'+
        '<td class="text-right">'+
          '<button class="btn bg-teal btn-xs"><i class="fa fa-edit"></i></button>'+
          '<button class="btn btn-danger btn-xs" onClick = "delete_inventor('+arr+')"><i class="fa fa-trash-alt"></i></button>'+
        '</td>'+
        '</tr>';
  }
  console.log(table);
  $("#body-inventor").html(table);
                          
}

function prepare_add_inventor(){
  $('#detail_inventor').show();
  $('#btn-add-inv').hide();
}

function add_inventor(){
  var f_no = $('#f_no').val();
  var f_name = $('#f_name').val();
  array_inventor.push({id:null,merk_id:null,no:f_no,name:f_name});

  document.getElementById("f_no").value ='';
  document.getElementById("f_name").value ='';

  fetch_inventor();
}

function delete_inventor(idx){
  array_inventor.splice(idx, 1);
  fetch_inventor();
}

function done_inventor(){
  $('#detail_inventor').hide();
  $('#btn-add-inv').show();
}

 function fetch_ahli(){
  var table = '';
  for (var arr in array_ahli) {
    console.log(array_ahli[arr]);
        table = table +
        '<tr>'+
        '<td>'+array_ahli[arr].ahli+'</td>'+
        '<td>'+array_ahli[arr].ket+'</td>'+
        '<td class="text-right">'+
          '<button class="btn bg-teal btn-xs"><i class="fa fa-edit"></i></button>'+
          '<button class="btn btn-danger btn-xs" onClick = "delete_ahli('+arr+')"><i class="fa fa-trash-alt"></i></button>'+
        '</td>'+
        '</tr>';
  }
  console.log(table);
  $("#body-ahli").html(table);
                          
}

function prepare_add_ahli(){
  $('#detail_ahli').show();
  $('#btn-add-ahli').hide();
}

function add_ahli(){
  var f_ahli = $('#f_ahli').val();
  var f_ket = $('#f_ket').val();
  array_ahli.push({id:null,ahli:f_ahli,ket:f_ket});

  document.getElementById("f_ahli").value ='';
  document.getElementById("f_ket").value ='';

  fetch_ahli();
}

function delete_ahli(idx){
  array_ahli.splice(idx, 1);
  fetch_ahli();
}

function done_ahli(){
  $('#detail_ahli').hide();
  $('#btn-add-ahli').show();
}

function fetch_exp(){
  var table = '';
  for (var arr in array_exp) {
    console.log(array_exp[arr]);
        table = table +
        '<tr>'+
        '<td>'+array_exp[arr].country+'</td>'+
        '<td>'+array_exp[arr].time+'</td>'+
        '<td>'+array_exp[arr].period+'</td>'+
        '<td>'+array_exp[arr].end+'</td>'+
        '<td>'+array_exp[arr].problem+'</td>'+
        '<td>'+array_exp[arr].des+'</td>'+
        '<td class="text-right">'+
          '<button class="btn bg-teal btn-xs"><i class="fa fa-edit"></i></button>'+
          '<button class="btn btn-danger btn-xs" onClick = "delete_exp('+arr+')"><i class="fa fa-trash-alt"></i></button>'+
        '</td>'+
        '</tr>';
  }
  console.log(table);
  $("#body-exp").html(table);
                          
}

function prepare_add_exp(){
  $('#detail_exp').show();
  $('#btn-add-exp').hide();
}

function add_exp(){
  var f_country = $('#f_country').val();
  var f_time = $('#f_time').val();
  var f_period = $('#f_period').val();
  var f_end = $('#f_end').val();
  var f_problem = $('#f_problem').val();
  var f_des = $('#f_des').val();
  array_exp.push({id:null,country:f_country,time:f_time,period:f_period,end:f_end,problem:f_problem,des:f_des});

  document.getElementById("f_country").value ='';
  document.getElementById("f_time").value ='';
  document.getElementById("f_period").value ='';
  document.getElementById("f_end").value ='';
  document.getElementById("f_problem").value ='';
  document.getElementById("f_des").value ='';

  fetch_exp();
}

function delete_exp(idx){
  array_exp.splice(idx, 1);
  fetch_exp();
}

function done_exp(){
  $('#detail_exp').hide();
  $('#btn-add-exp').show();
}

function ubahmedical(a){
  var id = a.id;
   $("#m_id").val(id);
   $('#ubahmdc').modal('show');
}

function ubahpasport(a){
  var id = a.id;
   $("#p_id").val(id);
   $('#ubahpsp').modal('show');
}

function ubahpanggilan(a){
  var id = a.id;
   $("#s_id").val(id);
   $('#ubahpsj').modal('show');
}

function ubahsidikjari(a){
  var id = a.id;
   $("#j_id").val(id);
   $('#ubahsj').modal('show');
}

function ubahready(a){
  var id = a.id;
   $("#t_id").val(id);
   $('#ubahrtb').modal('show');
}

function ubahcall(a){
  var id = a.id;
   $("#b_id").val(id);
   $('#ubahcall').modal('show');
}
</script>

     

