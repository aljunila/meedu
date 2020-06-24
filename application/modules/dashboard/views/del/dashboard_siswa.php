  
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Siswa
    <small><i class="fa fa-chevron-right"></i>&nbsp;&nbsp;Rangkuman</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>" tooltip="Goto Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>"><?php echo $title; ?></a></li>
        
    </ol>
</section>

<!-- Main content --> 
<section class="content">
    <?php if(@$status){ ?>
          <div class="<?php echo $alert; ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $status; ?>
          </div>
          <?php } ?>
    <div class="row">

      <div class="col-md-3">
      <!-- Profile Image -->
            <div class="box box-success">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>themesAdmin/dist/img/user1-128x128.jpg" alt="User profile picture">
                    <h3 class="profile-username text-center"><?php echo $user->nama;?></h3>
                    <p class="text-muted text-center">username: <?php echo $user->username;?></p>
                                   
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- About Me Box -->
              <?php if(isset($profile)){?>
              <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Profile</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="nav nav-stacked">
                    <li><strong><i class="fa fa-map-marker margin-r-5"></i>  Address</strong>
                        <p class="text-muted"><?php if(isset($profile)){
                            echo $profile->address;
                            }else{
                              echo "-";
                            }
                            ?>.</p>
                      </li>
                    <li>
                      <strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>
                        <p class="text-muted"><?php if(isset($profile)){echo $profile->phone;}else{echo "-";}?></p>
                      </li>
                    <li>
                      <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                        <p class="text-muted"><?php echo $user->email;?></p>
                    </li>
                    <li>
                      <strong><i class="fa fa-calendar-o margin-r-5"></i> Status </strong>
                        <p class="text-muted"><?php 
                        if(isset($profile)){
                            if($profile->activeStatus =='A'){ 
                              echo "ACTIVE";
                            }else{
                              echo "NOT ACTIVE";
                            }
                        }else{ 
                          echo "NOT ACTIVE";
                        } ?>                      
                    </li>
                </ul>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            <?php }?>

        </div><!-- /.col -->
        <div class="col-md-9">
          
        <?php if (!isset($profile)) {?>
          <div class="box box-warning">
          <div class="box-header with-border text-orange">
                <i class="fa fa-bullhorn "></i> <h3 class="box-title">Profile Belum Dilengkapi</h3>
            </div><!-- /.box-header -->
            <div class="box-body ">
                <h3>Hi,<?php echo $this->session->userdata('nama')?></h3>
                <h5>Anda belum mengisi profil. mohon isi profil pribadi anda untuk melanjutkan proses pendaftaran. 
                </h5>
                <br>
                

                
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="<?php echo site_url('profile/profile_crud/0-0')?>"><button type="button" class="btn btn-warning pull-right"><i class="fa fa-user"></i>&nbsp;Lengkapi Profil</button></a>
            </div><!-- /.box-footer -->
        </div><!-- /.box -->

        <?php }else if(isset($profile) && ($profile->activeStatus=='N')){ ?>
        <div class="box box-danger">
          <div class="box-header with-border text-red">
                <i class="fa fa-bullhorn"></i> <h3 class="box-title">Akun Belum Diaktifkan</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                Hi,<?php echo $this->session->userdata('nama')?><br>
                Status akun anda belum aktif. Anda dapat mengaktifkan akun dengan cara melakukan pembayaran formulir pada lokasi sekolah atau bisa melalui non tunai melalui transfer bank. 
                <br>
               

                
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <a href="<?php echo site_url('dashboard/aktivasi_siswa');?>"><button type="button" class="btn btn-danger pull-right"><i class="fa fa-edit"></i>&nbsp;Aktifkan Akun</button></a>
            </div><!-- /.box-footer -->
        </div><!-- /.box -->
        <?php }  ?>

        <? if (isset($profile) && ($profile->activeStatus=='A')) {?>
        <div class="box box-info">
            <div class="box-header with-border">
              <i class="fa fa-exclamation-triangle"></i><h3 class="box-title">Kekurangan Dokumen</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
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
                    <td><a href="<?php echo site_url('profile/profile_crud/0-0')?>">Data Registrasi Calon Siswa</a></td>
                    <td>
                    <?php if(isset($profile)){?><span class="label label-success">Telah Terisi</span>
                    <?php }else{ ?> <span class="label label-warning">Belum Diisi</span><?php }?>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><a href="<?php echo site_url('akademik/akademik_crud/0-0')?>">Data Akademik</a></td>
                    <?php if($akademik_nilai==0){?>
                      <td><span class="label label-danger">Belum Terisi</span></td>
                    <?php } else if ($akademik == $akademik_nilai ) { ?>
                      <td><span class="label label-success">Telah Terisi</span></td>

                    <?php } else {?>
                      <td><span class="label label-warning">Belum Lengkap</span></td>

                    <?php } ?>

                    <td><?php echo $akademik_nilai.'/'.$akademik; ?> Matapelajaran</td>

                    
                  </tr>
                  <tr>
                    <td><a href="<?php echo site_url('familys/familys_crud/0-0')?>">Data Keluarga</a></td>
                      
                    <?php if($keluarga!=0){?>
                    <td><span class="label label-success">Telah Diisi</span></td>
                    <td><?php echo $keluarga.' Orang' ?></td>
                    <?php }else{ ?>
                    <td><span class="label label-danger">Belum terisi</span></td>
                    <td></td>
                    <?php }?>

                  </tr>
                  <tr>
                    <td>Data Wali</td>
                    <td><span class="label label-danger">Belum terisi</span></td>
                  </tr>
                  
                 
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
             <div class="progress-group">
                    <span class="progress-text">Status Kelengkapan dokumen</span>
                    <span class="progress-number"><b>0</b>/4</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: 0%"></div>
                    </div>
                  </div>


            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
          <?php }?>

          <?if (isset($profile) && ($profile->activeStatus=='A')) {?>
        <div class="box box-success">
          <div class="box-header with-border">
                <h3 class="box-title">Document</h3>
                
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <?php $i=1;foreach ($document as $rdoc){?>
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $rdoc->name;?></h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <!--IMAGE PRINT-->
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
                                  'documentId' => $rdoc->documentId,
                                  'categoryId' => $rdoc->categoryId,
                                  'new_document'=>false
                                );
                                echo form_hidden($hidden_data_user);
                              } else {
                                echo form_open_multipart('dashboard/do_upload','class="form-horizontal" role="form"');
                                $hidden_data_user = array(
                                  'documentId' => $rdoc->documentId,
                                  'categoryId' => $rdoc->categoryId,
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
                    </div><!-- /.box -->
                  </div>
                  <?php } ?>

                  
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
            </div><!-- /.box-footer -->
        </div><!-- /.box -->
        <?php }?>


        </div><!-- /.col -->
    </div><!-- /.row -->
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


function deleteD(a){
 // window.location.href='b.html#id='+a.id+'&src='+a.src;
 document.getElementById("delDataD").href=a.id;
}


function deleteV(a){
 // window.location.href='b.html#id='+a.id+'&src='+a.src;
 document.getElementById("delDataV").href=a.id;
}
</script>





