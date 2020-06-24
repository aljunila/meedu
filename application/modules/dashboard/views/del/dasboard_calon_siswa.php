<style type="text/css">
  .bg-header{
    margin: 0px;
    background-color: #00a65a;
    padding:  16px 10px 16px 10px;
    background-image:  url(../../themes/admin/img/gr01.jpg);
    color: #fff;
  }

  a.doc-white{
    color: #fff;
  }
  .text-white{
    color: #fff;
  }

  input.disabled-normal:read-only{
      color: black;
    -webkit-text-fill-color: black;
      background-color: #ffffff !important;
      border:0px solid;
  }

  .bg-upload{
    margin-top: 8px;
    margin-left: 8px;
    margin-right: 8px;
    border-radius: 5px;
    border: 1px solid #666666;
    padding: 8px;
  }

  .profile-user{
    width: 320px;
    height: 320px;
    min-height: 80px;
    min-width: 80px;
    margin: auto;
  }

  .profile-dokumen{
    height: 240px;
    width:  320px;
    min-height: 20px;
    min-width: 30px;
    margin: auto;
  }

</style>
<!-- Main content --> 
<section class="content">
    <!-- ALERT -->
    <?php if(@$status){ ?>
    <div class="<?php echo $alert; ?> alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <?php echo $status; ?>
    </div>
    <?php } ?>

    <!-- HEADER INFO -->
    <div class="row">
      <div class="col-md-12">
        <div class="row bg-header">
          <div class="col-md-3">
              <img class="profile-user-img img-responsive img-circle" src="<?php if(!empty($user->pathUrl)){echo base_url().'data/document/'.$user->pathUrl;} else {echo base_url().'themesAdmin/dist/img/user1-128x128.jpg' ;} ?>" alt="User profile picture">
              <h3 class="profile-username text-center"><?php echo $user->nama;?></h3>
              <p class=" text-center">
              Username: <?php echo $user->username;?>
              <br><?php echo $this->lang->line('caption_category');?>: 
                    <?php if($user->regType=='D'){
                      echo "DEWASA";
                      }else if($user->regType=='A'){
                        echo "ANAK";
                      }else if($user->regType=='P'){
                        echo "PRIVATE";
                      }
                    ?>
               </p>
          </div>
          <div class="col-md-3">
            <!-- About Me Box -->
            <?php if(isset($profile)){?>
              <ul class="nav nav-stacked">
                <li><strong><i class="fa fa-map-marker margin-r-5"></i>  <?php echo $this->lang->line('caption_address');?></strong>
                    <p class=""><?php if(isset($profile)){
                        echo $profile->address;
                        }else{
                          echo "-";
                        }
                        ?>.</p>
                </li>
                <li>
                  <strong><i class="fa fa-phone margin-r-5"></i> <?php echo $this->lang->line('caption_phone');?></strong>
                    <p class=""><?php if(isset($profile)){echo $profile->phone;}else{echo "-";}?></p>
                </li>
                <li>
                  <strong><i class="fa fa-envelope margin-r-5"></i> <?php echo $this->lang->line('caption_email');?></strong>
                    <p class=""><?php echo $user->email;?></p>
                </li>
                <li>
                  <strong><i class="fa fa-calendar-o margin-r-5"></i> Status </strong>
                    <p class=""><?php 
                    if(isset($profile)){
                        if($profile->activeStatus =='A'){ 
                          echo "AKTIF";
                        }else{
                          echo "BELUM AKTIF";
                        }
                    }else{ 
                      echo "BELUM AKTIF";
                    } ?>    
                    </p>                  
                </li>
              </ul>
            <?php }?>
          </div>

          <div class="col-md-6">
            <br>
            <? $dokcek =0; if (isset($profile) && ($profile->activeStatus=='A')) {?>
            
              <div class="box-header with-border text-white">
                <i class="fa fa-exclamation-triangle"></i><h3 class="box-title ">Kekurangan Dokumen</h3>
                <div class="box-tools pull-right">
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                    <tr>
                      <th>Dokumen</th>
                      <th>Status</th>
                      <th>Keterangan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>
                        <a class="doc-white" href="<?php echo site_url('profile/profile_crud/0-0')?>">Data Registrasi Calon Siswa</a>
                      </td>
                      <td> 
                        <?php if(isset($profile)){  $dokcek++; ?><span class="label label-success">Telah Terisi</span>
                        <?php }else{ ?> <span class="label label-warning">Belum Diisi</span><?php }?>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><a class="doc-white" href="<?php echo site_url('profile/profile_crud/0-0')?>">Photo</a></td>
                        
                      <?php if($user->pathUrl!=''){  $dokcek++;  ?>
                      <td><span class="label label-success">Telah Diisi</span></td>
                      <?php }else{ ?>
                      <td><span class="label label-danger">Belum terisi</span></td>
                      
                      <?php }?>
                      <td></td>

                    </tr>
                   
                   <?php if($profile->category!=3){?>
                    <tr>
                      <td>Data Dokumen</td>
                      <?php  $datadoc='';
                      foreach ($document as $rdoc){
                        $datadoc= $rdoc->pathUrl;
                      }
                      if($datadoc!=''){  $dokcek++;  ?>
                      <td><span class="label label-success">Telah Diisi</span></td>
                      <?php }else{ ?>
                      <td><span class="label label-danger">Belum terisi</span></td>
                      <?php }?>
                      <td></td>
                    </tr>
                    <?php } ?>


                    <?php if($profile->category==1){?>
                    <tr>
                      <td><a class="doc-white" href="<?php echo site_url('familys/familys_crud/0-0')?>">Data Keluarga</a></td>

                      <?php if($keluarga>0 && $keluarga<2){   ?>
                      <td><span class="label label-warning">Data Ayah/ Ibu Belum Lengkap</span></td>
                      <td><?php echo $keluarga.' Orang' ?></td>
                      <?php }else if($keluarga==2){  $dokcek++;  ?>
                      <td><span class="label label-success">Telah Diisi</span></td>
                      <td><?php echo $keluarga.' Orang' ?></td>
                      <?php }else{ ?>
                      <td><span class="label label-danger">Belum terisi</span></td>
                      
                      <?php }?>
                      <td></td>
                    </tr>
                    <?php } ?>


                    <?php if($profile->category==3){?>

                    
                     <tr>
                      <td><a class="doc-white" href="<?php echo site_url('familys/familys_crud/0-0')?>">Data Anggota</a></td>

                      <?php if($keluarga>0 && $keluarga<4){   ?>
                      <td><span class="label label-warning">Batas Minimal 4</span></td>
                      <td><?php echo $keluarga.' Orang' ?></td>
                      <?php }else if($keluarga>=4){  $dokcek++;  ?>
                      <td><span class="label label-success">Telah Diisi</span></td>
                      <td><?php echo $keluarga.' Orang' ?></td>
                      <?php }else{ ?>
                      <td><span class="label label-danger">Belum terisi</span></td>
                      
                      <?php }?>
                      <td></td>
                    </tr>
                    <?php }?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.box-body -->

              <?php 
                $nDoc=0;
                if($profile->category==1){ 
                  $nDoc=4;
                }else{
                  $nDoc =3;
                }
              ?>
              <div class=" clearfix">
                <div class="progress-group">
                  <span class="progress-text">Status Kelengkapan dokumen</span>
                  <span class="progress-number"><b><?php echo $dokcek;?></b>/<?php echo $nDoc;?></span>

                  <div class="progress sm">
                    <div class="progress-bar progress-bar-yellow" style="width: <?php if($dokcek!=0){ echo $dokcek/$nDoc*100; }else{echo '0';}?>%"></div>
                  </div>
                </div>


              </div>
              <!-- /.box-footer -->
            <!-- /.box -->
            <?php }?>
          </div><!-- /.col -->

        </div>
      </div><!-- /.col -->
    </div>
    <div class="row">
      <div class="col-md-12">
        
      </div>
    <div>
    </div>

 
</section><!-- /.content -->





<!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Formulir
            <small>pendaftaran</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- row -->
          <div class="row">
            <div class="col-md-12">

          <ul class="timeline">
              <!-- timeline item -->
                <?php if (isset($profile) &&($profile->category=='3')) {?>
                <li>
                  <i class="fa bg-orange">4</i>
                  <div class="timeline-item">
                    <!-- <span class="time"><i class="fa fa-clock-o"></i> 5 days ago</span> -->
                    <h3 class="timeline-header"><a href="#">ANGGOTA KELOMPOK</a></h3>
                    <div class="timeline-body">
                    <div class="row">
                    <!-- DATA TANGGUNGAN ORANG TUA-->
                      <div class="col-xs-12">
                        <div class="box-shadow">
                          <div class="box-header with-border text-right">
                              <?php if(count($datafam)<8){?>

                              <a href="<?php echo site_url('familys/familys_crud/0-1') ?>" class="btn btn-primary" role="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
                              <?php } ?>
                          </div>
                          <div class="box-body">
                            
                            <div class="table-responsive">
                              <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th>No&nbsp;</th>
                                    <th>Profil</th>
                                    <th>Foto</th>
                                    <!-- <th>NIK</th>
                                    <th>Pekerjaan</th>
                                    <th>Pendidikan</th>
                                    <th>Tanggal Lahir</th> -->
                                    
                                    <th>Dokumen</th>
                                    <th>Control Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $i=1;foreach ($datafam as $row){?>
                                  <tr>
                                    <td align="center"><?php echo $i; $i++;?></td>
                                    
                                    <!-- <td><?php echo $row->name;?></td>
                                    <td><?php echo $row->nik;?></td>
                                    <td><?php echo $row->job;?></td>
                                    <td><?php echo $row->graduate;?></td>
                                    <td><?php echo $row->dob;?></td> -->
                                    <td>
                                    <table>
                                    <tr><td><strong>Name</strong></td><td>&nbsp;<strong>:</strong></td><td>&nbsp;<strong><?php echo $row->name;?></strong></td></tr>
                                    <tr><td>Tanggal Lahir</td><td>&nbsp;:</td><td>&nbsp;<?php echo $row->dob;?></td></tr>
                                    <tr><td>NIK</td><td>&nbsp;:</td><td>&nbsp;<?php echo $row->nik;?></td></tr>
                                    <tr><td>Pekerjaan</td><td>&nbsp;:</td><td>&nbsp;<?php echo $row->job;?></td></tr>
                                    <tr><td>Pendidikan</td><td>&nbsp;:</td><td>&nbsp;<?php echo $row->graduate;?></td></tr>
                                    </table>
                                    </td>

                                    <td>
                                      <a href="#" rel="tooltip-top" title="Photo">
                                      <i class="fa fa-image text-orange" data-toggle="modal" data-target="#uploadMsg"  id="<?php echo $row->parentId.'#'.$row->pathUrl; ?>" onClick="uploadPhoto(this);"> Lihat &amp; Ubah</i>
                                      </a>
                                    </td>
                                   
                                   <td>
                                      <a href="#" rel="tooltip-top" title="Delete">
                                      <i class="fa fa-file-o text-orange" data-toggle="modal" data-target="#uploadDoc"  id="<?php echo $row->parentId.'#'.$row->docUrl; ?>" onClick="uploadDoc(this);"> Lihat &amp; Ubah</i>
                                      </a>
                                    </td>
                                   
                                    <td><?php if($this->session->userdata('priviledge')=='3'){?>
                                      <a href="<?php echo site_url('familys/familys_crud/'.$row->parentId.'-2'); ?>" rel="tooltip-top" title="Edit">
                                      <i class="fa fa-edit"> Ubah</i>
                                      </a>&nbsp;
                                      <a href="#" rel="tooltip-top" title="Delete">
                                      <i class="fa fa-trash-alt text-orange" data-toggle="modal" data-target="#deleteAnggota"  id="<?php echo site_url('familys/familys_crud/'.$row->parentId.'-6'); ?>" onClick="deleteAnggota(this);"> Hapus</i>
                                      </a>
                                      <?php } else {
                                      echo "N/A";
                                      }?>
                                    </td>
                                  </tr>
                                  <?php } ?>
                                  </tbody>
                                </table>
                            </div><!-- /.table-responsive -->
                          </div>
                          <div class="box-footer clearfix">
                          </div>
                        </div>

                        <div class="modal modal-warning fade" id="deleteMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus</h4>
                              </div>
                              <div class="modal-body">
                                <p class="error-text"><i class="fa fa-exclamation-triangle fa-2x"></i>&nbsp;&nbsp;&nbsp;Apakah anda yakin ingin menghapus data ini?</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                                <a id="delData" href="#"><button type="button" class="btn btn-outline">Hapus</button></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                    </div>
                    <div class="timeline-footer">
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                <?php } ?>



                <?if (isset($profile) &&($profile->category=='3')) {?>
                <li>
                  <i class="fa  bg-green">3</i>
                  <div class="timeline-item">
                    <h3 class="timeline-header"><a href="#">JADWAL</a></h3>
                    <div class="timeline-body">
                      <div class="row">

                        <?php if($jadwal){?>
                        <div class="col-md-12">
                        <div class="table-responsive">
                          <table id="" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>No&nbsp;</th>
                                <th>Kelas</th>
                                <th>Hari Belajar</th>
                                <th>Jam</th>
                                <th>Pengajar</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                               <?php $i=1;
                               foreach ($jadwal as $rdoc){?>

                              <tr>
                                <td align="center"><?php echo $i; $i++;?></td>
                                <td><?php echo $rdoc->tsName;?></td>
                                <td><?php echo $rdoc->cHari;?></td>
                                <td><?php echo $rdoc->cJam;?></td>
                                <td><?php if($rdoc->pengajar=='null' || $rdoc->pengajar=='0'){ echo "menunggu konfirmasi"; } else { echo $rdoc->pengajar;} ?></td>
                                </td>
                                <td><?php if($this->session->userdata('priviledge')=='3'){?>
                                  <a href="#" rel="tooltip-top" title="Delete">
                                  <i class="fa fa-trash-alt text-orange" data-toggle="modal" data-target="#deleteMessage"  id="<?php echo site_url('jadwaltfz/jadwaltfz_crud/'.$rdoc->tsId.'-3'); ?>" onClick="deleteJ(this);"></i>
                                  </a>
                                  <?php } else {
                                  echo "N/A";
                                  }?>
                                </td>
                              </tr>
                              <?php } ?>
                              </tbody>
                            </table>
                        </div><!-- /.table-responsive -->
                           
                          
                        </div>
                        <?php } else {?>
                         <div class="col-md-12">
                         
                          <div class="box-body">
                              Jadwal Belum di atur
                          </div><!-- /.box-body -->
                          <div class="box-footer clearfix">
                              <a href="<?php echo site_url('jadwaltfz/jadwaltfz_crud/0-1')?>"><button type="button" class="btn btn-warning pull-right"><i class="fa fa-calendar-o"></i>&nbsp;Pilih Jadwal</button></a>
                            </div><!-- /.box-footer -->
                          </div
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </li>
                <?php }else if(isset($profile) && ($profile->activeStatus=='A') &&($profile->category!='3')){?>
                   <li>
                    <i class="fa  bg-green">3</i>
                    <div class="timeline-item">
                      <h3 class="timeline-header"><a href="#">JADWAL</a></h3>
                      <div class="timeline-body">
                        <div class="row">

                          <?php if($jadwal){?>
                          <div class="col-md-12">
                          <div class="table-responsive">
                            <table id="" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th>No&nbsp;</th>
                                  <th>Kelas</th>
                                  <th>Hari</th>
                                  <th>Jam</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                 <?php $i=1;

                                 foreach ($jadwal as $rdoc){?>

                                <tr>
                                  <td align="center"><?php echo $i; $i++;?></td>
                                  <td><?php echo $rdoc->tsName;?></td>
                                  <td><?php echo $rdoc->hari;?></td>
                                  <td><?php echo $rdoc->waktu;?></td>
                                  </td>
                                  <td><?php if($this->session->userdata('priviledge')=='3'){?>
                                    <a href="#" rel="tooltip-top" title="Delete">
                                    <i class="fa fa-trash-alt text-orange" data-toggle="modal" data-target="#deleteMessage"  id="<?php echo site_url('jadwaltfz/jadwaltfz_crud/'.$rdoc->tsId.'-3'); ?>" onClick="deleteJ(this);"></i>
                                    </a>
                                    <?php } else {
                                    echo "N/A";
                                    }?>
                                  </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                          </div><!-- /.table-responsive -->
                             
                            
                          </div>
                          <?php } else {?>
                           <div class="col-md-12">
                           
                            <div class="box-body">
                                Jadwal Belum di pilih
                            </div><!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <a href="<?php echo site_url('jadwaltfz/jadwaltfz_crud/0-1')?>"><button type="button" class="btn btn-warning pull-right"><i class="fa fa-calendar-o"></i>&nbsp;Pilih Jadwal</button></a>
                              </div><!-- /.box-footer -->
                            </div
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </li>
                <?php } ?>
                <!-- END timeline item -->


              <!-- The time line -->
              <ul class="timeline">
                <?if (isset($profile) && ($profile->activeStatus=='A') && $profile->category!=3) {?>
                <li>
                  <i class="fa  bg-purple">2</i>
                  <div class="timeline-item">
                    <h3 class="timeline-header"><a href="#">DOKUMEN PENUNJANG </a></h3>
                    <div class="timeline-body">
                      <div class="row">
                        <?php if($document){?>
                        <?php $i=1;foreach ($document as $rdoc){?>
                        <div class="col-md-4">
                          <div class="box-header with-border">
                              <?php if($profile->category!=1){?>
                              <h3 class="box-title"><?php echo $rdoc->name;?></h3>
                              <?php } else {?>
                              <h3 class="box-title">KARTU KELUARGA</h3>
                              <?php } ?>
                          </div><!-- /.box-header -->
                                
                          <div class="box-body">
                              <?php if($rdoc->pathUrl=='' || empty($rdoc->pathUrl)){ ?>
                                <img class="img-responsive pad" src="<?php echo base_url(); ?>themesAdmin/dist/img/photoNull.png" alt="Photo">                            
                              <?php }else{?>
                                <img class="img-responsive pad" src="<?php echo base_url(); ?>data/document/<?php echo $rdoc->pathUrl; ?>" alt="Photo"> 
                              <?php } ?>

                            <ul class="nav nav-stacked">
                              <div id="collapseUpload<?php echo $rdoc->categoryId;?>" class="panel-collapse collapse">
                              <?php
                               if(empty($rdoc->pathUrl)) {
                                  echo form_open_multipart('dashboard/do_upload','class="form-horizontal" role="form"');
                                  $hidden_data_user = array(
                                    'categoryId' => "4",
                                    'new_document'=>true
                                  );
                                  echo form_hidden($hidden_data_user);
                                } else {
                                  echo form_open_multipart('dashboard/do_upload','class="form-horizontal" role="form"');
                                  $hidden_data_user = array(
                                    'documentId' => $rdoc->documentId,
                                    'categoryId' => "4",
                                    'new_document'=>false
                                  );
                                  echo form_hidden($hidden_data_user);
                                }
                              ?>
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <input type="file" name="userfile"/>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <button id="submitUpload<?php echo $rdoc->categoryId;?>" type="submit" class="btn btn-primary" data-toggle="collapse"  data-target="#collapseUpload<?php echo $rdoc->categoryId;?>"><i class="fa fa-upload"></i> Upload</button>&nbsp;
                                    <button type="reset" class="btn btn-danger"><i class="fa fa-eraser"></i> Clear</button>
                                  </div>
                                </div>
                                <?php echo form_close(); ?>
                                <hr>
                                </div>

                                <?php if($rdoc->pathUrl=='' || empty($rdoc->pathUrl)){ ?>
                                  <div id ="button-upload">
                                  <a href="#"  data-toggle="collapse"  data-target="#collapseUpload<?php echo $rdoc->categoryId;?>" class="btn btn-warning btn-block" role="button"><i class="fa fa-upload"></i> Upload</a><br><br>
                                  </div>
                                <?php } else { ?>
                                  <li><strong><i class="fa fa-calendar-o margin-r-5"></i>  Diperbaharui tanggal</strong>
                                    <p class="text-muted"><?php echo $rdoc->dateModify;?>.</p>
                                  </li>
                                <li>
                                <div id ="button-upload">
                                  <a href="#"  data-toggle="collapse"  data-target="#collapseUpload<?php echo $rdoc->categoryId;?>" class="btn btn-default btn-block" role="button"><i class="fa fa-edit"></i> Edit</a><br><br>
                                  </div>
                                </li>
                              <?php } ?>

                              
                            </ul>
                          </div><!-- /.box-body -->
                        </div>
                        <?php } ?>

                        <?php } else{?>
                           <div class="col-md-4">
                          <div class="box-header with-border">
                              <h3 class="box-title">KTP</h3>
                          </div><!-- /.box-header -->
                                
                          <div class="box-body">
                                <img class="img-responsive pad" src="<?php echo base_url(); ?>themesAdmin/dist/img/photoNull.png" alt="Photo">                            
                             
                            <ul class="nav nav-stacked">
                              <div id="collapseUpload" class="panel-collapse collapse">
                              <?php
                               
                                  echo form_open_multipart('dashboard/do_upload','class="form-horizontal" role="form"');
                                  $hidden_data_user = array(
                                    'categoryId' => "4",
                                    'new_document'=>true
                                  );
                                  echo form_hidden($hidden_data_user);
                                
                              ?>
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <input type="file" name="userfile"/>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <button id="submitUpload" type="submit" class="btn btn-primary" data-toggle="collapse"  data-target="#collapseUpload"><i class="fa fa-upload"></i> Upload</button>&nbsp;
                                    <button type="reset" class="btn btn-danger"><i class="fa fa-eraser"></i> Clear</button>
                                  </div>
                                </div>
                                <?php echo form_close(); ?>
                                <hr>
                                </div>
                                  <div id ="button-upload">
                                  <a href="#"  data-toggle="collapse"  data-target="#collapseUpload" class="btn btn-warning btn-block" role="button"><i class="fa fa-upload"></i> Upload</a><br><br>
                                  </div>
                               
                              
                            </ul>
                          </div><!-- /.box-body -->
                        </div>
                        <?php }?>
                      </div>
                    </div>
                  </div>
                </li>
                <?php }?>
                <!-- END timeline item -->

<!--Data KELUARGA-->
                 <!-- timeline item -->
                <?if (isset($profile) && ($profile->activeStatus=='A') && ($profile->category==1)) {?>
                <li>
                  <i class="fa  bg-yellow">2</i>
                  <div class="timeline-item">
                    <!-- <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span> -->
                    <h3 class="timeline-header"><a href="#"><?php echo strtoupper($this->lang->line('caption_family_data'));?></a></h3>
                    <div class="timeline-body">
                      
                      <div class="row">
                        <?php if (!isset($profile)) {?>
                          <div class="col-xs-12">
                            <div class="box box-warning">
                              <div class="box-header with-border text-orange">
                                    <i class="fa fa-bullhorn "></i> <h3 class="box-title">Profil Belum Dilengkapi</h3>
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body ">
                                    <h3>Hi,<?php echo $this->session->userdata('nama')?></h3>
                                    <h5>Anda belum mengisi profil. Mohon isi profil pribadi anda untuk melanjutkan proses pendaftaran. 
                                    </h5>
                                    <br>
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                  <a href="<?php echo site_url('profile/profile_crud/0-1')?>"><button type="button" class="btn btn-warning pull-right"><i class="fa fa-user"></i>&nbsp;Lengkapi Profil</button></a>
                                </div><!-- /.box-footer -->
                            </div><!-- /.box -->
                          </div>

                        <?php }else if(isset($profile) && ($profile->activeStatus=='N')){ ?>
                          <div class="col-xs-12">
                            <div class="box box-info">
                            <div class="box-header with-border text-blue">
                                <i class="fa fa-bullhorn "></i> <h3 class="box-title">Administrasi formulir</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body ">
                                 <strong>
                                <h4>Hi,<?php echo $this->session->userdata('nama'); ?> </h4>
                                Anda dapat melanjutkan pengisian data setelah menyelesaikan administrasi formulir pendaftaran :)
                                </strong>
                                <br>
                                
                            </div><!-- /.box-body -->
                            <div class="box-footer clearfix">
                              <a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>"><button type="button" class="btn btn-success pull-right"><i class="fa fa-user"></i>&nbsp;Aktifkan akun</button></a>
                            </div><!-- /.box-footer -->
                            </div>
                          </div>
                        <?php } else { ?>
                          <!-- DATA AYAH IBU-->
                          <div class="col-xs-6">
                              <div class="box-header with-border">
                                <h3 class="box-title"><?php echo $this->lang->line('parent_primary_f');?></h3>
                                <div class="box-tools pull-right">
                                  <?php if(empty($ayah)){?>
                                       <a href="<?php echo site_url('familys/primary_add/A-1') ?>"> <button class="btn btn-box-tool" ><?php echo $this->lang->line('data_add');?>&nbsp;<i class="fa fa-plus"></i></button></a>
                                  <?php } else {?>
                                      <a href="<?php echo site_url('familys/primary_edit/A-'.$ayah->parentId ) ?>" ><button class="btn btn-box-tool" ><?php echo $this->lang->line('data_edit');?>&nbsp;<i class="fa fa-edit"></i></button></a>
                                  <?php }?>
                                </div>
                              </div><!-- /.box-header -->
                              <div class="box-body">
                                <div class="col-md-12">
                                  <?php 
                                  if($ayah){?>
                                  <ul class="nav nav-stacked">
                                    <li>
                                      <strong><i class="fa fa-user margin-r-8"></i> <?php echo $this->lang->line('caption_name');?></strong>
                                      <p class="text-muted"><h5><?php if(isset($ayah)){echo $ayah->name;}else{echo "-";}?></h5></p>
                                    </li>
                                    <li><strong><i class="fa fa-file-o margin-r-8"></i> <?php echo $this->lang->line('caption_job');?></strong>
                                      <p class="text-muted">
                                          <h5><?php if(isset($ayah)){ echo $ayah->job; }else{ echo "-"; }?>.</h5>
                                      </p>
                                    </li>
                                  </ul>
                                  <?php } else {?>
                                  <?php echo $this->lang->line('caption_parent_f_not_set');?>
                                  <?php }?>
                                </div>
                              </div><!-- /.box-body -->
                          </div><!-- /.col -->
                          <!-- DATA IBU-->
                           <!-- DATA AYAH IBU-->
                          <div class="col-xs-6">
                              <div class="box-header with-border">
                                <h3 class="box-title"><?php echo $this->lang->line('parent_primary_m');?></h3>
                                <div class="box-tools pull-right">
                                  <?php if(empty($ibu)){?>
                                  <div class="box-footer clearfix">
                                    <a href="<?php echo site_url('familys/primary_add/I-1') ?>" ><button class="btn btn-box-tool"><?php echo $this->lang->line('data_add');?>&nbsp;<i class="fa fa-plus"></i></button>
                                    </a>
                                  </div><!-- /.box-footer -->
                                  <?php } else {?>
                                    <a href="<?php echo site_url('familys/primary_edit/I-'.$ibu->parentId ) ?>" ><button class="btn btn-box-tool" ><?php echo $this->lang->line('data_edit');?>&nbsp;<i class="fa fa-edit"></i></button>
                                    </a>
                                  <?php }?>
                                </div>
                              </div><!-- /.box-header -->
                              <div class="box-body">
                                <div class="col-md-12">
                                  <?php 
                                  if($ibu){?>
                                  <ul class="nav nav-stacked">
                                    <li>
                                      <strong><i class="fa fa-user margin-r-8"></i> <?php echo $this->lang->line('caption_name');?></strong>
                                      <p class="text-muted"><h5><?php if(isset($ibu)){echo $ibu->name;}else{echo "-";}?></h5></p>
                                    </li>
                                    
                                    <li><strong><i class="fa fa-file-o margin-r-8"></i> <?php echo $this->lang->line('caption_job');?></strong>
                                      <p class="text-muted">
                                          <h5><?php if(isset($ibu)){ echo $ibu->job; }else{ echo "-"; }?>.</h5>
                                      </p>
                                    </li>
                                  </ul>
                                  <?php } else {?>
                                  <?php echo $this->lang->line('caption_parent_m_not_set');?>
                                  <?php }?>
                                </div>
                              </div><!-- /.box-body -->
                          </div><!-- /.col -->

                        <?php } ?>
                      </div><!-- /.row -->


                    </div>
                  </div>
                </li>
                <?php }?>
                <!-- END timeline item -->
               
<!-- PROFILE -->
              <!-- timeline item -->
                <li>
                  <i class="fa bg-red">1</i>
                  <div class="timeline-item">
                    <!-- <span class="time"><i class="fa fa-clock-o"></i> 5 days ago</span> -->
                    <h3 class="timeline-header"><a href="#"><?php echo strtoupper($this->lang->line('caption_reg_info'));?></a></h3>
                    <div class="timeline-body">
                      
                      <?php if (!isset($profile)) {?>
                        <div class="box-header with-border text-orange text-center">
                            <i class="fa fa-bullhorn "></i> <h3 class="box-title">Profil Belum Dilengkapi</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body ">
                            <h3>Hi,<?php echo $this->session->userdata('nama')?></h3>
                            <h5>Anda belum mengisi profil. Mohon isi profil pribadi anda untuk melanjutkan proses pendaftaran. 
                            </h5>
                            <br>
                        </div><!-- /.box-body -->
                        <div class="box-footer clearfix">
                          <a href="<?php echo site_url('profile/profile_crud/0-0')?>"><button type="button" class="btn btn-warning pull-right"><i class="fa fa-user"></i>&nbsp;Lengkapi Profil</button></a>
                        </div><!-- /.box-footer -->

                      <?php } else if(isset($profile) && ( ($profile->activeStatus=='N')  || ($profile->activeStatus=='A')) && $profile->category!=3){ ?>
                        <div class="box box-default">
                          <div class="box-header with-border text-orange">
                              <i class="fa fa-list "></i> <h3 class="box-title">Riwayat Transaksi</h3>
                          </div><!-- /.box-header -->
                          <div class="box-body ">


                           
                                <div class="table-responsive">
                                <table id="" class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th>No&nbsp;</th>
                                      <th>Nomor Transaksi</th>
                                      <th>Tgl Transaksi</th>
                                      <th>Total</th>
                                      <th>Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                     <?php $i=1;
                                     foreach ($trans as $ts){?>
                                    <tr>
                                      <td align="center"><?php echo $i; $i++;?></td>
                                      <td><?php echo $ts->tsNumb;?> </td>
                                      <td><?php echo $ts->tsDate;?></td>
                                      <td><?php echo $ts->total;?></td>
                                   
                                      <td>
                                      <a href="<?php echo site_url('dashboard/transaction_detail/'.$ts->tsId.'-'.$user->id); ?>"><i class="fa fa-eye"></i>&nbsp; Lihat detail</a>
                                      </td>
                                    </tr>
                                    <?php } ?>


                                    </tbody>
                                  </table>
                              </div><!-- /.table-responsive -->

                          </div><!-- /.box-body -->
                          <div class="box-footer clearfix">
                          </div><!-- /.box-footer -->
                        </div><!-- /.box -->

                        <div class="box box-warning">
                          <div class="box-header with-border text-orange">
                              <i class="fa fa-bullhorn "></i> <h3 class="box-title">Kekurangan Biaya</h3>
                          </div><!-- /.box-header -->
                          <div class="box-body ">


                              <?php echo form_open_multipart('dashboard/add_pembayaran/'.$user->id,'class="form-horizontal" role="form"');
                              
                                $hidden_data_user = array(
                                  'idUser' => $user->id,
                                  'category' => $profile->category
                                );
                                echo form_hidden($hidden_data_user);
                              ?>
                              <h5>Detail yang harus dibayar 
                              </h5>
                              

                                <div class="table-responsive">
                                <table id="" class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th>No&nbsp;</th>
                                      <th>Item</th>
                                      <th>Biaya</th>
                                      <th>Status</th>
                                      <!-- <th>Aksi</th> -->
                                    </tr>
                                  </thead>
                                  <tbody>
                                     <?php $i=1;
                                     foreach ($biaya as $rb){?>
                                    <tr>
                                      <td align="center"><?php echo $i; $i++;?></td>
                                      <td><?php echo $rb->catName;?> </td>
                                      <td><?php echo $rb->nominal;?></td>
                                      <td><?php if($rb->item=='null' || $rb->item==''){ ?>
                                          <span class="label label-warning">Belum Dibayar</span> 
                                          <?php } else { ?>
                                          <span class="label label-success">Sudah Dibayar</span>
                                          <?php }?>
                                      </td>
                                      <!-- <td>
                                      
                                      <?php if($rb->item=='null' || $rb->item==''){?>
                                        <input type="checkbox" name="<?php echo $rb->detailId;?>">
                                      <?php }else{?>

                                      <?php  } ?>

                                      </td> -->
                                    </tr>
                                    <?php } ?>


                                    </tbody>
                                  </table>
                              </div><!-- /.table-responsive -->

                          </div><!-- /.box-body -->
                          <div class="box-footer clearfix">

                          <!-- <div class="form-group pull-right">
                            <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Bayar</button>&nbsp;
                            <button type="reset" class="btn btn-danger"><i class="fa fa-clear"></i>  <?php echo $this->lang->line('caption_clear');?></button>
                          </div> -->
                            
                          </div><!-- /.box-footer -->
                        </div><!-- /.box -->
                       
                      <?php } else if(isset($profile) && ($profile->activeStatus=='A') && $profile->category==3){ ?>
                      
                        <div class="box box-default">
                          <div class="box-header with-border text-orange">
                              <i class="fa fa-list "></i> <h3 class="box-title">Riwayat Transaksi</h3>
                          </div><!-- /.box-header -->
                          <div class="box-body ">


                           
                                <div class="table-responsive">
                                <table id="" class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th>No&nbsp;</th>
                                      <th>Nomor Transaksi</th>
                                      <th>Tgl Transaksi</th>
                                      <th>Total</th>
                                      <th>Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                     <?php $i=1;
                                     foreach ($trans as $ts){?>
                                    <tr>
                                      <td align="center"><?php echo $i; $i++;?></td>
                                      <td><?php echo $ts->tsNumb;?> </td>
                                      <td><?php echo $ts->tsDate;?></td>
                                      <td><?php echo $ts->total;?></td>
                                   
                                      <td>
                                      <a href="<?php echo site_url('dashboard/transaction_detail/'.$ts->tsId.'-'.$user->id); ?>"><i class="fa fa-eye"></i>&nbsp; Lihat detail</a>
                                      </td>
                                    </tr>
                                    <?php } ?>


                                    </tbody>
                                  </table>
                              </div><!-- /.table-responsive -->

                          </div><!-- /.box-body -->
                          <div class="box-footer clearfix">
                          </div><!-- /.box-footer -->
                        </div><!-- /.box -->

                        <div class="box box-warning">
                          <div class="box-header with-border text-orange">
                              <i class="fa fa-bullhorn "></i> <h3 class="box-title">Kekurangan Biaya</h3>
                          </div><!-- /.box-header -->
                          <div class="box-body ">


                              <?php echo form_open_multipart('dashboard/add_pembayaran/'.$user->id,'class="form-horizontal" role="form"');
                              
                                $hidden_data_user = array(
                                  'idUser' => $user->id,
                                  'category' => $profile->category
                                );
                                echo form_hidden($hidden_data_user);
                              ?>
                              <h5>Detail yang harus dibayar 
                              </h5>
                              

                                <div class="table-responsive">
                                <table id="" class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th>No&nbsp;</th>
                                      <th>Item</th>
                                      <th>Biaya</th>
                                      <th>Status</th>
                                      <th>Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                     <?php $i=1;
                                     foreach ($biaya as $rb){?>
                                    <tr>
                                      <td align="center"><?php echo $i; $i++;?></td>
                                      <td><?php echo $rb->catName;?> </td>
                                      <td><?php echo $rb->nominal;?></td>
                                      <td><?php if($rb->item=='null' || $rb->item==''){ ?>
                                          <span class="label label-warning">Belum Dibayar</span> 
                                          <?php } else { ?>
                                          <span class="label label-success">Sudah Dibayar</span>
                                          <?php }?>
                                      </td>
                                      <td>
                                      
                                      <?php if($rb->item=='null' || $rb->item==''){?>
                                        <input type="checkbox" name="<?php echo $rb->detailId;?>">
                                      <?php }else{?>

                                      <?php  } ?>

                                      </td>
                                    </tr>
                                    <?php } ?>


                                    </tbody>
                                  </table>
                              </div><!-- /.table-responsive -->

                          </div><!-- /.box-body -->
                          <div class="box-footer clearfix">

                          <div class="form-group pull-right">
                            <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Bayar</button>&nbsp;
                            <button type="reset" class="btn btn-danger"><i class="fa fa-clear"></i>  <?php echo $this->lang->line('caption_clear');?></button>
                          </div>
                            
                          </div><!-- /.box-footer -->
                        </div><!-- /.box -->
                      
                      <?php } else if(isset($profile) && ($profile->activeStatus=='N') && $profile->category==3){ ?>
                          <div class="text-blue text-center">
                            <strong>
                            <h4><i class="fa fa-bullhorn"></i> Hi,<?php echo $this->session->userdata('nama'); ?> </h4>
                            Anda dapat melanjutkan pengisian data setelah mengisi formulir registrasi
                            </strong>
                          </div>
                      <?php }?>


                    </div>
                    <div class="timeline-footer">
                      <!-- <a href="#" class="btn btn-xs bg-maroon">See comments</a> -->
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
              </ul>
            </div><!-- /.col -->
          </div><!-- /.row -->
           <div class="modal modal-warning fade" id="deleteMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus</h4>
                      </div>
                      <div class="modal-body">
                        <p class="error-text"><i class="fa fa-exclamation-triangle fa-2x"></i>&nbsp;&nbsp;&nbsp;Apakah anda yakin ingin menghapus data ini?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                        <a id="delDataJ" href="#"><button type="button" class="btn btn-outline">Hapus</button></a>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div>


               <div class="modal modal-default fade" id="uploadMsg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Foto Anggota</h4>
                      </div>
                      <div class="modal-body">
                        <img id="img_profiles" class="profile-user img-responsive img-circle" src="" alt="User profile picture">
                         <?php if($this->session->userdata('priviledge')=='3'){?>
                          <?php
                              echo form_open_multipart('dashboard/family_upload_foto','class="form-horizontal" role="form"');
                            
                          ?>
                            <div class="form-group" style="display: none;">
                              <div class="col-sm-12">
                                <input type="text" name="id" id="parentIdPhoto"/>
                              </div>
                            </div>
                            <div class="text-center bg-gray bg-upload">
                                <input type="file" name="userfile"/>
                            </div>

                      <?php }?>
                      </div>
                      <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle-o "></i>&nbsp;Batal</button>
                        <button  type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                  <?php echo form_close(); ?>
                </div>



                 <div class="modal modal-default fade" id="uploadDoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Dokumen Anggota</h4>
                      </div>
                      <div class="modal-body">
                        <img id="img_document" class="profile-dokumen img-responsive " src="" alt="User profile picture">
                         <?php if($this->session->userdata('priviledge')=='3'){?>
                          <?php
                              echo form_open_multipart('dashboard/family_upload_document','class="form-horizontal" role="form"');
                            
                          ?>
                            <div class="form-group" style="display: none;">
                              <div class="col-sm-12">
                                <input type="text" name="id" id="parentIdDocument"/>
                              </div>
                            </div>
                            <div class="text-center bg-gray bg-upload">
                                <input type="file" name="userfile"/>
                            </div>

                      <?php }?>
                      </div>
                      <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle-o "></i>&nbsp;Batal</button>
                        <button  type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                  <?php echo form_close(); ?>
                </div>


                <div class="modal modal-warning fade" id="deleteAnggota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus</h4>
                              </div>
                              <div class="modal-body">
                                <p class="error-text"><i class="fa fa-exclamation-triangle fa-2x"></i>&nbsp;&nbsp;&nbsp;Apakah anda yakin ingin menghapus data ini?</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                                <a id="delAnggota" href="#"><button type="button" class="btn btn-outline">Hapus</button></a>
                              </div>
                            </div>
                          </div>
                        </div>

        </section><!-- /.content -->


<script>
    $("#submitUpload1").click(function(){
        $("collapseUpload1").show("fast");
    });

     $("#submitUpload2").click(function(){
        $("collapseUpload2").show("fast");
    });

      $("#submitUpload3").click(function(){
        $("collapseUpload3").show("fast");
    });


function deleteAnggota(a){
 // window.location.href='b.html#id='+a.id+'&src='+a.src;
 document.getElementById("delAnggota").href=a.id;
}



function deleteD(a){
 // window.location.href='b.html#id='+a.id+'&src='+a.src;
 document.getElementById("delDataD").href=a.id;
}

function deleteJ(a){
 // window.location.href='b.html#id='+a.id+'&src='+a.src;
 document.getElementById("delDataJ").href=a.id;
}

function uploadPhoto(a){
 // window.location.href='b.html#id='+a.id+'&src='+a.src;
 // document.getElementById("delDataJ").href=a.id;
 var aval = a.id;
 var valFix = aval.split("#");
 

 document.getElementById("parentIdPhoto").value=valFix[0];

 var imgProfile ='';
 if(valFix[1] == '' ){
    imgProfile = '<?php echo base_url().'themesAdmin/dist/img/user1-128x128.jpg'; ?>';
 }else{
    imgProfile='<?php echo base_url().'data/document/';?>'+valFix[1];
 }
 document.getElementById("img_profiles").src=imgProfile;
 document.getElementById("parentIdPhoto").value=valFix[0];
}


function uploadDoc(a){
 var aval = a.id;
 var valFix = aval.split("#");
 document.getElementById("parentIdDocument").value=valFix[0];

 var imgProfile ='';
 if(valFix[1] == '' ){
    imgProfile = '<?php echo base_url().'themesAdmin/dist/img/photoNull.png'; ?>';
 }else{
    imgProfile='<?php echo base_url().'data/document/';?>'+valFix[1];
 }
 document.getElementById("img_document").src=imgProfile;
}


function deleteV(a){
 // window.location.href='b.html#id='+a.id+'&src='+a.src;
 document.getElementById("delDataV").href=a.id;
}
</script>





