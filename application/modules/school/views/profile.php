<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datepicker/datepicker3.css">
<!-- fullCalendar 2.2.5-->
<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/fullcalendar/fullcalendar.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/fullcalendar/fullcalendar.print.css" media="print">

<!-- Content Header (Page header) -->
<style type="text/css">
  .title-sub-modal{
  font-size: 16px; 
  border-bottom: 1px solid #dddddd; 
  margin-bottom: 8px;
}
.space-div-modal{
  margin-bottom: 16px;
}

 .widget-user .user-image {
  
    }
    .widget-user .user-image > img {
      width: 90px;
      height: auto;
      margin-top: -65px;
      border: 3px solid #fff;
    }
</style>

<script>
    $( document ).ready(function() {
       ajaxPopulate();

        //Date picker
      $('#date-dob').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
      });
      $('#date-graduate').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
      });
       $('#date-graduate-m').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
      });
         $('#date-fam').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
      });


    });

    $('#absensi-data').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        if(valueSelected=='A'){
           $('#absensita').hide();
           $('#absensismt').hide();
           $('#absensi-title-summary').html('Ringkasan Keseluruhan');
           ajaxPopulate();
        }else{
          $('#absensita').show();
           $('#absensismt').show();
           $('#absensi-title-summary').html('Ringkasan TA');
           ajaxPopulate();
        }
    });

    $('#absensi-ta').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        ajaxPopulate();
        
    });

     $('#absensi-smt').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        ajaxPopulate();
        
    });

    // function ajaxPopulate(){
    //   $.ajax({
    //     type: "POST",
    //     url: "<?php echo site_url('student/populate_presensi')?>",
    //     data: { 
    //       profile_id :'<?php echo $profile->id?>',
    //       type : $('#absensi-data').val(),
    //       ta : $('#absensi-ta').val(),
    //       smt : $('#absensi-smt').val(),
    //     },
    //     success: function(html)
    //     {
    //       $("#print-data-absensi").html(html);
    //     }
    //     });
    // }


     function deleteFam(a){
      document.getElementById("delFam").href=a.id;
    }


    function deleteEkskul(a){
      document.getElementById("delEkskul").href=a.id;
    }

    function deletePelanggaran(a){
      document.getElementById("delPelanggaran").href=a.id;
    }

   function hide_non_mutasi(){
        $("#non_mutation").hide();
        $("#mutation").show();
        $("#rd_MUT").attr('checked', true);
        $("#rd_PSB").attr('checked', false);
    };

    function show_non_mutasi(){
        $("#non_mutation").show();
        $("#mutation").hide();
         $("#rd_MUT").attr('checked', false);
        $("#rd_PSB").attr('checked', true);
    };



     $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false
            });
        });


    function asalSekolahCheck(a){
      if(a=='PSB'){
        show_non_mutasi();
      }else{
        hide_non_mutasi();
      }
    }

   

</script>

<section class="content-header">
    <h1>
    <?php echo $title; ?>
    <small><?php if(isset($new_student)) { echo '<i class="fa fa-user"></i>&nbsp;&nbsp;New End User'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit End User'; } ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>" tooltip="Goto Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('student/student_crud/0-0')?>"><?php echo $title; ?></a></li>
        <li class="active"><?php if(isset($new_student)) { echo '<i class="fa fa-user"></i>&nbsp;&nbsp;New End User'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit End User'; } ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- <?php if(@$status){ ?>
      <div class="<?php echo $alert; ?> alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $status; ?>
      </div>
    <?php } ?> -->
	<!-- <div><button class="btn btn-success-o"> Export</button></div> -->
    <div class="row">
    	<div class="col-sm-8">
    		<div class="box box-widget widget-user">
    			<div class="widget-user-header bg-green">
               	<div class="pull-right">
           		<!-- <a  class="btn btn-default btn-xs" href="<?php echo site_url('student/pdf_profil_murid').'/'.$user->id;?>"><i class="fa fa-download"></i> Export PDF </span></a> -->
           		<a class="btn btn-warning btn-xs" 
           		data-toggle="modal" data-backdrop="static" data-target="#detailProfilPrimer"><i class="fa fa-edit"></i> Ubah Profil</span></a>
               	</div>
                  <h3 class="widget-user-username"><?php echo $profil->name; ?></h3>
                  
                </div>
                 <div class="user-image text-center" onmouseover="ajaxChangeBtn(true)" onmouseout="ajaxChangeBtn(false)">
                   <?php if($profil->photo_url==''){?>
                  <img class="" src="<?php echo base_url(); ?>themesAdmin/dist/img/img2x3.jpg" >
                  <?php }else{ ?>
                  <img class="" src="<?php echo base_url(); ?>data/profile/<?php echo $profil->photo_url;?>">
                  <?php } ?>
                  <div id="btn-change" class="text-center" style=""><a class="btn btn-outline btn-xs text-blue" data-toggle="modal" data-backdrop="static" data-target="#changePP"><i class="fa fa-edit"></i> Ubah Photo</a></div>

                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">Negara Tujuan</h5>
                        <span class=""><?php echo $profil->tujuan;?></span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">Tempat tgl lahir</h5>
                        <span class=""><?php if($profil){ 
                          $sdob =  $profil->dob; 
                          $date = date('d-m-Y', strtotime($sdob));
                          $dateofbirth = str_replace('-', '/', $date);
                          echo $profil->pob.', '.$dateofbirth;} else{ echo "Not Set";} ?></span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">Tgl Registrasi Data</h5>
                        <span class=""><?php $date = new DateTime($profil->created_date);
                              echo  $date->format('d F Y');?></span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div>
              </div><!-- /.widget-user -->
    	</div>
    	<div class="col-sm-4">
    		 <div class="box box-success">
                <div class="box-header bg-green">
                  <h3 class="box-title">Statistik Pengguna</h3>
                  <div class="box-tools">
                   
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <td>Proses</td>
                      <!-- <td>11-7-2014</td> -->
                      <td>
                        <?php if ($profil->proses!='CC'){ ?>
                      <span class="label label-success"><?php echo $profil->statusname; ?></span>
                      <?php } else {?>
                        <span class="label label-danger"><?php echo $profil->statusname; ?></span>
                      <?php }?>
                      </td>
                    </tr>
                    <tr>
                      <td>Pembaruan Terakhir</td>
                      <td> <span class=""><?php $date = new DateTime($profil->changed_date);
                              echo  $date->format('d F Y');?></span></td>
                    </tr>
                  </table>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
    	</div>

    	<!-- kondisi jika ada profile -->
    	<?php if($profil){?>
        <div class="col-md-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li <?php if(!isset($tab) || $tab =='activity'){ echo 'class="active"';}?>>
                  <a href="#activity" data-toggle="tab">Data Diri</a>
                </li>

               <!--  <li <?php if(isset($tab)) if($tab =='akademik'){ echo 'class="active"';}?>>
                  <a href="#timeline" data-toggle="tab">Akademik</a>
                </li> -->

                <li <?php  if(isset($tab)) if($tab =='ekskul'){ echo 'class="active"';}?>>
                  <a href="#ekstrakulikuler" data-toggle="tab">File Data Diri</a>
                </li>

                <li <?php  if(isset($tab)) if($tab =='absensi'){ echo 'class="active"';}?>>
                  <a href="#absensi" data-toggle="tab">Riwayat Transaksi</a>
                </li>

                <!-- <li  <?php  if(isset($tab)) if($tab =='behavior'){ echo 'class="active"';}?>>
                  <a href="#behavior" data-toggle="tab">Perilaku</a>
                </li> -->

               <!--  <li  <?php  if(isset($tab)) if($tab =='biaya'){ echo 'class="active"';}?>> 
                  <a href="#settings" data-toggle="tab">Biaya</a>
                </li>

                <li  <?php  if(isset($tab)) if($tab =='setting'){ echo 'class="active"';}?>>
                  <a href="#settings" data-toggle="tab">Akun Setting</a>
                </li> -->
              </ul>
              <div class="tab-content">
                <div class=" <?php if(!isset($tab) || $tab =='activity'){ echo 'active';}?> tab-pane" id="activity">
                  <div class="post">
                    <?php if($profil){?>
                    <div class="row">

                      <!-- Personalisasi -->
                      <div class="col-sm-12">
                        <div>
                            <div class="box-header with-border">
                              <a class="pull-right btn btn-success-o btn-xs" onclick="prepare_edit_data(<?php echo $profil->id; ?>)"><i class="fa fa-edit"></i> ubah</a>
                              <h3 class="box-title text-green text-bold">DATA PRIBADI</h3>
                            </div><!-- /.box-header -->
                            <div>
                                <div class="col-sm-6 ">
                                  <table class="table table-condensed">
                                    <!--<tr>
                                      <td><label>Nama Lengkap</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->full_name; ?></td>
                                    </tr> -->
                                    <tr>
                                      <td><label>Nama</label></td>
                                      <td>:</td>
                                      <td><?php echo $profil->name; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Alamat</label></td>
                                      <td>:</td>
                                      <td><?php echo $profil->address; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>No Telp</label></td>
                                      <td>:</td>
                                      <td><?php echo $profil->phone; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Tempat Tanggal Lahir</label></td>
                                      <td>:</td>
                                      <td><?php $sdob =  $profil->dob; 
                                          $date = date('d-m-Y', strtotime($sdob));
                                          $dateofbirth = str_replace('-', '/', $date);
                                          echo $profil->pob.', '.$dateofbirth; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Pendidikan</label></td>
                                      <td>:</td>
                                      <td><?php echo $profil->pend; ?></td>
                                    </tr>
                                      <tr>
                                      <td><label>Pemahaman Bahasa Arab</label></td>
                                      <td>:</td>
                                      <td><?php echo $profil->language; ?></td>
                                    </tr>
                                  </table>
                                </div>
                                <div class="col-sm-offset-1 col-sm-5">
                                  <table class="table table-condensed">
                                    <tr>
                                      <td><label>Sponsor</label></td>
                                      <td>:</td>
                                      <td><?php echo $profil->sponsor; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Penanggung Jawab</label></td>
                                      <td>:</td>
                                      <td><?php echo $profil->pj; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Nama Ayah</label></td>
                                      <td>:</td>
                                      <td><?php echo $profil->father; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Nama Ibu</label></td>
                                      <td>:</td>
                                      <td><?php echo $profil->mother; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Nama Kakek</label></td>
                                      <td>:</td>
                                      <td><?php echo $profil->gfather; ?></td>
                                    </tr>
                                    <!-- <tr>
                                      <td><label>Email</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->email; ?></td>
                                    </tr> -->
                                    
                                  </table>
                                </div>
                                
                            </div>

                            <div class="clearfix text-right">
                              <!-- <i><label class="text-orange">Note : </label>data asal sekolah digunakan untuk identifikasi murid, sedangkan mutasi jika murid masuk dengan cara berpindah dari sekolah lain</i> -->
                              
                              <br>
                            </div><!-- /.box-footer -->
                        </div><!-- /.box -->
                      </div>
                      <div class="col-sm-12">
                        <div>
                            <div class="col-sm-12">
                              <div class="box-header with-border">
                                <a class="pull-right btn btn-success-o btn-xs" onclick="prepare_edit_proses(<?php echo $profil->id; ?>)"><i class="fa fa-edit"></i> ubah</a>
                              </div><!-- /.box-header -->
                              <div class="box-body no-padding">
                                <div class="col-sm-6">
                                 <table class="table table-condensed">
                                    <!--<tr>
                                      <td><label>Nama Lengkap</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->full_name; ?></td>
                                    </tr> -->
                                    <tr>
                                      <td><label>Tanggal Medical</label></td>
                                      <td>:</td>
                                      <td><?php  
                                          $date = date('d-m-Y', strtotime($profil->tgl_medical));
                                          $tgl_medical = str_replace('-', '/', $date);
                                          echo $tgl_medical; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Hasil Medical</label></td>
                                      <td>:</td>
                                      <td><?php echo $profil->medical; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Tanggal Pengajuan Paspor</label></td>
                                      <td>:</td>
                                      <td><?php  
                                          $date = date('d-m-Y', strtotime($profil->tgl_pengajuan));
                                          $tgl_pengajuan = str_replace('-', '/', $date);
                                          echo $tgl_pengajuan; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Tempat Buat Paspor</label></td>
                                      <td>:</td>
                                      <td><?php
                                          $date = date('d-m-Y', strtotime($profil->tgl_buat));
                                          $tgl_buat = str_replace('-', '/', $date);
                                          echo $tgl_buat; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Tanggal Expired Paspor</label></td>
                                      <td>:</td>
                                      <td><?php  
                                          $date = date('d-m-Y', strtotime($profil->tgl_expired));
                                          $tgl_expired = str_replace('-', '/', $date);
                                          echo $tgl_expired; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Tanggal Penyerahan Paspor</label></td>
                                      <td>:</td>
                                      <td><?php  
                                          $date = date('d-m-Y', strtotime($profil->tgl_serah));
                                          $tgl_serah = str_replace('-', '/', $date);
                                          echo $tgl_serah; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>No Paspor</label></td>
                                      <td>:</td>
                                      <td><?php echo $profil->no_paspor; ?></td>
                                    </tr>
                                  </table>
                                </div>
                                <div class="col-sm-offset-1 col-sm-5">
                                  <table class="table table-condensed">
                                   <tr>
                                      <td><label>Tanggal Panggilan Sidik Jari</label></td>
                                      <td>:</td>
                                      <td><?php  
                                          $date = date('d-m-Y', strtotime($profil->tgl_psj));
                                          $tgl_psj = str_replace('-', '/', $date);
                                          echo $tgl_psj; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Tanggal Sidik Jari</label></td>
                                      <td>:</td>
                                      <td><?php  
                                          $date = date('d-m-Y', strtotime($profil->tgl_sidikjari));
                                          $tgl_sidikjari = str_replace('-', '/', $date);
                                          echo $tgl_sidikjari; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Tanggal Penyerahan Stampel Kedutaan</label></td>
                                      <td>:</td>
                                      <td><?php  
                                          $date = date('d-m-Y', strtotime($profil->tgl_stempel));
                                          $tgl_stempel = str_replace('-', '/', $date);
                                          echo $tgl_stempel; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Tanggal Terbang</label></td>
                                      <td>:</td>
                                      <td><?php  
                                          $date = date('d-m-Y', strtotime($profil->tgl_terbang));
                                          $tgl_terbang = str_replace('-', '/', $date);
                                          echo $tgl_terbang; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Penerbangan dari Kota</label></td>
                                      <td>:</td>
                                      <td><?php echo $profil->call_from; ?></td>
                                    </tr>
                                    <!-- <tr>
                                      <td><label>Email</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->email; ?></td>
                                    </tr> -->
                                    
                                  </table>
                                </div>
                              </div><!-- /.box-body -->
                            </div>
                        </div>
                        <div class="clearfix text-right">
                            <!-- <i><label class="text-orange">Note : </label>data asal sekolah digunakan untuk identifikasi murid, sedangkan mutasi jika murid masuk dengan cara berpindah dari sekolah lain</i> -->
                            <br>
                        </div><!-- /.box-footer -->
                      </div>
                      <!-- Asal Sekolah -->
                      <div class="col-sm-12">
                        <div>
                            <div class="col-sm-12">
                              <div class="box-header with-border">
                                <a class="pull-right btn btn-success-o btn-xs" data-toggle="modal" data-backdrop="static" data-target="#detailAsalSekolah" onClick="asalSekolahCheck('PSB')"><i class="fa fa-edit"></i> ubah</a>
                                <h3 class="box-title text-green text-bold">DATA ANAK</h3>
                              </div><!-- /.box-header -->
                              <div class="box-body no-padding">
                                <div class="col-sm-12">
                                  <?php
                                  if($children){
                                  ?>
                                <table class="table table-condensed">
                                  <tr>
                                    <th>Anak Ke</th>
                                    <th>Nama Anak</th>
                                  </tr>
                                  <?php foreach ($children as $c) { ?>
                                  <tr>
                                    <td><?php echo $c->anak_ke; ?> </td>
                                    <td><?php echo $c->name; ?></td>
                                  </tr>
                                  <?php } ?>
                                </table>
                                <?php } ?>
                                </div>
                              </div><!-- /.box-body -->
                            </div>
                        </div>
                        <div class="clearfix text-right">
                            <!-- <i><label class="text-orange">Note : </label>data asal sekolah digunakan untuk identifikasi murid, sedangkan mutasi jika murid masuk dengan cara berpindah dari sekolah lain</i> -->
                            <br>
                        </div><!-- /.box-footer -->
                      </div>

                      <!-- familys -->
                      <div class="col-sm-12">
                        <div>
                          <div class="col-sm-12">
                            <div class="box-header with-border">
                              <h3 class="box-title text-green text-bold">KELUARGA & PENGALAMAN</h3>
                              <div class="box-tools pull-right">
                                
                              </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                              <!-- DATA AYAH -->
                              <div class="col-sm-4 no-padding">
                                  <div class="box-header with-border">
                                    <a class="pull-right btn btn-success-o btn-xs " href="<?php echo site_url('familys/primary_edit/A.'.$profil->id) ?>"><i class="fa fa-edit"></i> Tambah Data</a>
                                      <h3 class="box-title  text-bold">KEAHLIAN</h3>
                                  </div><!-- /.box-header -->
                                  <div class="box-body no-padding">
                                <?php if($ahli){?>
                                <table class="table table-condensed">
                                  <tr>
                                    <th>Keahlian</th>
                                    <th>Keterangan</th>
                                  </tr>
                                  <?php foreach ($ahli as $h) { ?>
                                  <tr>
                                    <td><?php echo $h->ahli; ?> </td>
                                    <td><?php echo $h->ket; ?></td>
                                  </tr>
                                  <?php } ?>
                                </table>
                                <?php  } ?>
                                  </div><!-- /.box-body -->
                              </div>

                              <!-- DATA IBU -->
                              <div class="col-sm-8">
                                  <div class="box-header with-border">
                                    <a class="pull-right btn btn-success-o btn-xs" href="<?php echo site_url('familys/primary_edit/I.'.$profil->id) ?>"><i class="fa fa-edit"></i> Tambah Data</a>
                                      <h3 class="box-title  text-bold">PENGALAMAN</h3>
                                  </div><!-- /.box-header -->
                                  <div class="box-body no-padding">
                                 <?php if($exp){?>
                                  <table class="table table-condensed">
                                  <tr>
                                    <th>Negara/Kota</th>
                                    <th>Waktu</th>
                                    <th>Periode</th>
                                    <th>Selesai</th>
                                    <th>Masalah</th>
                                    <th>Keterangan</th>
                                  </tr>
                                  <?php foreach ($exp as $e) { ?>
                                  <tr>
                                    <td><?php echo $e->country; ?> </td>
                                    <td><?php echo $e->time; ?></td>
                                    <td><?php echo $e->period ?></td>
                                    <td><?php echo $e->end; ?></td>
                                    <td><?php echo $e->problem; ?></td>
                                    <td><?php echo $e->des; ?></td>
                                  </tr>
                                  <?php } ?>
                                </table>
                                <?php  } ?>
                                  </div><!-- /.box-body -->
                              </div>

                            </div><!-- /.box-body -->
                            <div class="box-footer clearfix text-right">
                             <!--  <i><label class="text-orange">Note : </label>data asal sekolah digunakan untuk identifikasi murid, sedangkan mutasi jika murid masuk dengan cara berpindah dari sekolah lain</i> -->
                            </div><!-- /.box-footer -->
                          </div>
                        </div>
                      </div>

                    </div>
                    <?php } ?>
                  </div><!-- /.post -->
                </div><!-- /.tab-pane -->

                <div class="<?php  if(isset($tab)) if($tab =='ekskul'){ echo 'active';}?> tab-pane" id="ekstrakulikuler">
                  <div class="row">
                      <div class="col-sm-12">
                              <div class="box-header with-border">
                                <a class="pull-right btn btn-success-o btn-xs" data-toggle="modal" data-backdrop="static" data-target="#detailAsalSekolah" onClick="uploadfile()"><i class="fa fa-edit"></i> Upload</a>
                                <h3 class="box-title text-green text-bold">FILE DATA DIRI</h3>
                              </div><!-- /.box-header -->
                              <div class="box-body no-padding">
                                <div class="col-sm-12">
                                  <?php
                                  if($fileupload){
                                  ?>
                                <table class="table table-condensed">
                                  <tr>
                                    <th>No</th>
                                    <th>Jenis File</th>
                                    <th align="center">Lihat/Unduh</th>
                                  </tr>
                                  <?php foreach ($fileupload as $f) { ?>
                                  <tr>
                                    <td><?php echo $f->namefile; ?> </td>
                                    <td><?php echo $f->file_url; ?></td>
                                    <td > <a href="<?php echo base_url('data/doc/'.$f->file_url)?>"><i class="fa fa-download"></i></a></li>
                                    </td>
                                  </tr>
                                  <?php } ?>
                                </table>
                                <?php } ?>
                                </div>
                              </div><!-- /.box-body -->
                            </div>
                  </div>
                </div><!-- /.tab-pane -->

                 <div class="<?php  if(isset($tab)) if($tab =='absensi'){ echo 'active';}?> tab-pane" id="absensi">
                  <div class="row">
                      <div class="col-sm-12">
                              <div class="box-header with-border">
                                 <a class="pull-right btn btn-success-o btn-xs" onClick="prepare_add_data();"><i class="fa fa-edit"></i> Tambah Data</a>
                                <h3 class="box-title text-green text-bold">RIWAYAT TRANSAKSI</h3>
                              </div><!-- /.box-header -->
                              <div class="box-body no-padding">
                                <div class="col-sm-12">
                                  <?php
                                  if($jurnal){
                                  ?>
                                <table class="table table-condensed">
                                  <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Nominal</th>
                                  </tr>
                                  <?php $a=0;
                                  $total=0;
                                  foreach ($jurnal as $j) {
                                  $a++;
                                  $total = $total+$j->nominal; 
                                   $date = date('d-m-Y', strtotime($j->date));
                                    $dateoftrans = str_replace('-', '/', $date);?>
                                  <tr>
                                    <td><?php echo $a; ?> </td>
                                    <td><?php echo $dateoftrans; ?> </td>
                                    <td><?php echo $j->description; ?></td>
                                    <td>Rp <?php echo number_format($j->nominal, 0, ',', '.'); ?></td>
                                  </tr>
                                  <?php } ?>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><strong>Total</strong></td>
                                    <td>Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
                                  </tr>
                                </table>
                                <?php } ?>
                                </div>
                              </div><!-- /.box-body -->
                            </div>
                  </div>
                </div><!-- /.tab-pane -->
              <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                  <form class="form-horizontal">
                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputName" placeholder="Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" placeholder="Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputExperience" class="col-sm-2 control-label">Experience</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputSkills" class="col-sm-2 control-label">Skills</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Submit</button>
                      </div>
                    </div>
                  </form>
                </div><!-- /.tab-pane -->


              </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->

    <!-- DELETE EKSKUL-->
    <div class="modal modal-warning fade" id="deleteEkskul" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-trash-alt-alt"></i>&nbsp;&nbsp;Hapus</h4>
            </div>
            <div class="modal-body">
              <p class="error-text">Apakah anda yakin untuk menghapus data ini?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
              <a id="delEkskul" href="#"><button type="button" class="btn btn-outline">Delete</button></a>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>



    <!-- DELETE PELANGGARAN-->
    <div class="modal modal-warning fade" id="deletePelanggaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-trash-alt-alt"></i>&nbsp;&nbsp;Hapus</h4>
            </div>
            <div class="modal-body">
              <p class="error-text">Apakah anda yakin untuk menghapus data pelanggaran ini?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
              <a id="delPelanggaran" href="#"><button type="button" class="btn btn-outline">Delete</button></a>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

        <!-- DELETE EKSKUL-->
    <div class="modal modal-warning fade" id="deleteFam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-trash-alt-alt"></i>&nbsp;&nbsp;Hapus</h4>
            </div>
            <div class="modal-body">
              <p class="error-text">Apakah anda yakin untuk menghapus data ini?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
              <a id="delFam" href="#"><button type="button" class="btn btn-outline">Delete</button></a>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>



    <?php } ?>

    </div><!-- /.row -->

    <div class="modal modal-default fade" id="upload_file" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Unggah Dokumen</h4>
            </div>
             <form class="form-horizontal" action="<?php echo base_url('pendaftaran/upload_doc')?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
              <input class="text-green" type="text" name="m_id" id ="m_id" style="display: none;">
              <div class="row">
                <div class="col-sm-12">
                  <?php 
                          $a=0;
                          foreach ($doc as $n) {
                          $a++; ?>
                              <div class="form-group">
                                  <label class="col-lg-2 col-sm-2 control-label"><?php echo "$n->name"; ?></label>
                                  <div class="col-lg-10">
                                    <input type="file" name="upload<?php echo $a;?>" id="file" class="form-control">
                                      <input type="hidden" class="form-control" name="kid<?php echo $a;?>" value="<?php echo "$n->id"; ?>" >
                                  </div>
                              </div>
                          <?php } ?>
                          <input type="hidden" class="form-control" name="jum" value="<?php echo $a;?>" >
                          <input type="hidden" class="form-control" name="idx" value="<?php echo "$profil->id"; ?>" >
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
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Detail Data</h4>
        </div>
        <div class="modal-body">
            <input type="text" name="a_new_data" id ="a_new_data" style="display: none;">
            <input type="text" name="a_id" id = "a_id" style="display: none;" >
            <input type="text" name="a_anggota_id" id = "a_anggota_id" value="<?php echo $profil->id; ?>" style="display: none;" >
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Account Asal</label>
                  <div class="col-sm-9 ">
                    <select class="form-control" name="acc_source" id="acc_source">
                      <?php
                        foreach($account as $a) { ?>
                        <option value="<?php echo $a->id; ?>"> <?php echo $a->name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Account Tujuan</label>
                  <div class="col-sm-9 ">
                      <select class="form-control" name="acc_target" id="acc_target">
                      <?php
                        foreach($account as $a) { ?>
                        <option value="<?php echo $a->id; ?>"> <?php echo $a->name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                 <div class="form-group row">
                  <label class="col-sm-2 control-label">Nominal</label>
                  <div class="col-sm-9 ">
                      <input type="text" class="form-control" placeholder="Nominal"  name="nominal" id="nominal">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Keterangan</label>
                  <div class="col-sm-9 ">
                      <input type="email" class="form-control" placeholder="Ketarangan"  name="des" id="des">
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
  </div>

   <!-- MODAL DETAIL ANNOUNCEMENT-->
  <div class="modal modal-default fade" id="detail_pribadi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Form Pendaftaran</h4>
        </div>
        <div class="modal-body">
            <input type="text" name="a_new_data" id ="a_new_data" style="display: none;">
            <input type="text" name="a_id_profil" id = "a_id_profil" style="display: none;" >
          
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
                            <option value="<?php echo $c->id; ?>" <?php if($profil->country==$c->id) { echo "selected='selected'"; } ?>><?php echo $c->name; ?></option>
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
                      <option value="">Pilih Pendidikan</option>
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
                      <option value="">Pilih </option>
                      <option value="LC">Lancar</option>
                      <option value="KLC">Kurang Lancar</option>
                      <option value="TB">Tidak bisa</option>
                    </select>
                  </div>
                </div>
                <!-- <div class="form-group row">
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
                </div> -->
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger-o pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo $this->lang->line('alert_btn_negative')?></button>
          <button type="button" class="btn btn-success-o" onClick ="detail_pribadi_save()"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
</div>

 <!-- MODAL DETAIL ANNOUNCEMENT-->
  <div class="modal modal-default fade" id="detail_proses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Form Pendaftaran</h4>
        </div>
        <div class="modal-body">
            <input type="text" name="a_new_data" id ="a_new_data" style="display: none;">
            <input type="text" name="a_profil" id = "a_profil" style="display: none;" >
          
            <div class="row">
              <div class="col-sm-12">
                 <div class="form-group row">
                  <label class="col-sm-2 control-label">Tanggal Medical</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Tanggal Medical"  name="date_medical" id="date_medical">
                  </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label">Hasil Medical</label>
                    <div class="col-sm-9 ">
                       <!-- <div id="table-status"></div> -->
                        <select name='a_medical' id='a_medical' class="form-control">
                          <option value="FIT" <?php if($profil->medical='FIT') { echo "selected='selected'"; } ?>>Fit</option>
                          <option value="UNFIT" <?php if($profil->medical='UNFIT') { echo "selected='selected'"; } ?>>Unfit</option>
                    </select>
                    </div>
                  </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Tanggal Pengajuan</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Tanggal Pengajuan"  name="date_pengajuan" id="date_pengajuan">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Tanggal Buat</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Tanggal Buat" name="date_buat" id="date_buat">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Tanggal Expired</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Tanggal Expired"  name="date_expired" id="date_expired">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Tanggal Serah</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Tanggal Serah"  name="date_serah" id="date_serah">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Nomor Paspor</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Nomor Paspor"  name="a_no_paspor" id="a_no_paspor">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Tanggal Panggilan Sidik Jari</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Tanggal Panggilan Sidik Jari"  name="date_psj" id="date_psj">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Tanggal Sidik Jari</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Tanggal Sidik Jari"  name="date_sidikjari" id="date_sidikjari">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">Tanggal Stempel Kedutaan</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Tanggal Stempel Kedutaan"  name="date_stempel" id="date_stempel">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label">Tanggal Terbang</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Tanggal Terbang"  name="date_terbang" id="date_terbang">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label">Penerbangan dari Kota</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" placeholder="Penerbangan dari Kota"  name="a_call_from" id="a_call_from">
                  </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger-o pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo $this->lang->line('alert_btn_negative')?></button>
          <button type="button" class="btn btn-success-o" onClick ="detail_proses_save()"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
</div>
</section><!-- /.content -->



<script src="<?php echo base_url(); ?>themesAdmin/plugins/datepicker/bootstrap-datepicker.js"></script>

 <!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?php echo base_url(); ?>themesAdmin/plugins/fullcalendar/fullcalendar.min.js"></script>


<script>
  var default_date ='0000-00-00';
      $(function () {

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();

        $('#calendar').fullCalendar({
          header: {
            left: 'prev',
            center: 'title',
            right: 'today, next'
          },
          buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
          },
          //Random default events
          events: [
            {
              title: 'Sakit',
              start: new Date(y, 7, 3),
              backgroundColor: "#f56954", //red
              borderColor: "#f56954", //red
              allDay:true
            },
            {
              title: 'All Day Event',
              start: new Date(y, m, 1),
              backgroundColor: "#f56954", //red
              borderColor: "#f56954" //red
            },
            {
              title: 'Long Event',
              start: new Date(y, m, d - 5),
              end: new Date(y, m, d - 2),
              backgroundColor: "#f39c12", //yellow
              borderColor: "#f39c12" //yellow
            },
            {
              title: 'Meeting',
              start: new Date(y, m, d, 10, 30),
              allDay: false,
              backgroundColor: "#0073b7", //Blue
              borderColor: "#0073b7" //Blue
            },
            {
              title: 'Lunch',
              start: new Date(y, m, d, 12, 0),
              end: new Date(y, m, d, 14, 0),
              allDay: false,
              backgroundColor: "#00c0ef", //Info (aqua)
              borderColor: "#00c0ef" //Info (aqua)
            },
            // {
            //   title: 'Birthday Party',
            //   start: new Date(y, m, d + 1, 19, 0),
            //   end: new Date(y, m, d + 1, 22, 30),
            //   allDay: false,
            //   backgroundColor: "#00a65a", //Success (green)
            //   borderColor: "#00a65a" //Success (green)
            // },
            {
              title: 'Click for Google',
              start: new Date(y, m, 28),
              end: new Date(y, m, 29),
              url: 'http://google.com/',
              backgroundColor: "#3c8dbc", //Primary (light-blue)
              borderColor: "#3c8dbc" //Primary (light-blue)
            }
          ],
          editable: false,
          droppable: false, 
        
        });

      });
       function ajaxChangeBtn(a){
      if(a){
        $('#btn-change').show();
      }else{
         $('#btn-change').hide();
      }
    }

     $(document).ready(function(){
    $('#a_ins').hide();
    $('#a_dob').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#date_pengajuan').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#date_buat').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#date_expired').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#date_serah').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#date_stempel').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#date_sidikjari').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#date_terbang').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    $('#date_medical').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
    // $('#detail_inventor').hide();
    // $('#detail_ahli').hide();
    // $('#detail_exp').hide();
    // populate_data();
  });
    function uploadfile(){
    $('#upload_file').modal('show');
  }

   function prepare_add_data(){
    document.getElementById("a_new_data").value = "1";
    clear_modal_data();
    $('#detail_data').modal('show');
  }

  function detail_data(){
    // tinyMCE.triggerSave();
    var new_data = $('#a_new_data').val();
    var acc_target = document.getElementById("acc_target").value ;
    var acc_source= document.getElementById("acc_source").value ;
    var nominal= document.getElementById("nominal").value ;
    var anggota_id= document.getElementById("a_anggota_id").value ;
    var des = document.getElementById("des").value ;
    //alert(acc_source);
    if(new_data == '1'){
      datas = { 
        acc_source : acc_source,
        acc_target : acc_target,
        nominal : nominal,
        des : des,
        anggota_id : anggota_id,
        new_data : new_data,
      };
      url ="<?php echo site_url('transaction/add_data')?>";
    } else {
      var id = $('#a_id').val();
      datas = { 
        id : id,
        acc_source : acc_source,
        acc_target : acc_target,
        nominal : nominal,
        des : des,
        anggota_id : anggota_id,
        new_data : new_data,
      };
      url ="<?php echo site_url('transaction/edit_data')?>";
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

  function prepare_edit_data(a){
    document.getElementById("a_new_data").value = "0";
    url ="<?php echo site_url('pendaftaran/data_detail')?>";
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
         document.getElementById("a_dob").value = getData.item.dob;

        //  p_date ='';
        // if(getData.item.dob != default_date){
        //   var dates = $.date(getData.item.dob);
        //   p_date = dates;
        //   $('#a_dob').datepicker("setDate", new Date(dates));
        // }else{
        //   document.getElementById("a_dob").value = p_date;
        // }

        $("#a_id_profil").val(getData.item.id);
        $('#detail_pribadi').modal('show');
      }
    });
  }

  function detail_pribadi_save(){
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
        new_data : new_data,
      };
      url ="<?php echo site_url('pendaftaran/add_data')?>";
    } else {
      var id = $('#a_id_profil').val();
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
        new_data : new_data,
      };
      url ="<?php echo site_url('pendaftaran/edit_data')?>";
    }


    $.ajax({
      type: "POST",
      url: url,
      data: datas,
      success: function(jsontext){
        var getData = JSON.parse(jsontext);
        $("#modal-status").html(getData.alert_modal);
        clear_modal_data();
         $('#detail_pribadi').modal('hide');
      }
    });
  }

  function prepare_edit_proses(a){
    document.getElementById("a_new_data").value = "0";
    url ="<?php echo site_url('pendaftaran/data_detail')?>";
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
        document.getElementById("date_medical").value = getData.item.tgl_medical;
        document.getElementById("a_medical").value = getData.item.medical;
        document.getElementById("date_pengajuan").value = getData.item.tgl_pengajuan;
        document.getElementById("date_buat").value = getData.item.tgl_buat;
        document.getElementById("date_expired").value = getData.item.tgl_expired;
        document.getElementById("date_serah").value = getData.item.tgl_serah;
        document.getElementById("a_no_paspor").value = getData.item.no_paspor;
        document.getElementById("date_stempel").value = getData.item.tgl_stempel;
        document.getElementById("date_psj").value = getData.item.tgl_psj;
        document.getElementById("date_sidikjari").value = getData.item.tgl_sidikjari;
        document.getElementById("date_terbang").value = getData.item.tgl_terbang;
        document.getElementById("a_call_from").value = getData.item.call_from;

        $("#a_profil").val(getData.item.id);
        $('#detail_proses').modal('show');
      }
    });
  }

  function detail_proses_save(){
    // tinyMCE.triggerSave();
    var new_data = $('#a_new_data').val();
    var date_pengajuan = $('#date_pengajuan').val();
    var date_medical = $('#date_medical').val();
    var a_medical = $('#a_medical').val();
    var date_buat = $('#date_buat').val();
    var date_expired = $('#date_expired').val();
    var date_serah = $('#date_serah').val();
    var date_psj = $('#date_psj').val();
    var date_sidikjari = $('#date_sidikjari').val();
    var date_stempel = $('#date_stempel').val();
    var date_terbang = $('#date_terbang').val();
    var a_call_from = $('#a_call_from').val();
    var a_no_paspor = $('#a_no_paspor').val();
    if(new_data == '1'){
      datas = { 
        date_pengajuan : date_pengajuan,
        date_medical : date_medical,
        medical : a_medical,
        date_buat : date_buat,
        date_expired : date_expired,
        date_serah : date_serah,
        date_psj : date_psj,
        date_sidikjari : date_sidikjari,
        date_stempel : date_stempel,
        no_paspor : a_no_paspor,
        date_terbang : date_terbang,
        call_from : a_call_from,
        new_data : new_data,
      };
      url ="<?php echo site_url('pendaftaran/add_data')?>";
    } else {
      var id = $('#a_profil').val();
      datas = { 
        id : id,
        date_pengajuan : date_pengajuan,
        date_medical : date_medical,
        medical : a_medical,
        date_buat : date_buat,
        date_expired : date_expired,
        date_serah : date_serah,
        date_psj : date_psj,
        date_sidikjari : date_sidikjari,
        date_stempel : date_stempel,
        no_paspor : a_no_paspor,
        date_terbang : date_terbang,
        call_from : a_call_from,
        new_data : new_data,
      };
      url ="<?php echo site_url('pendaftaran/edit_proses')?>";
    }


    $.ajax({
      type: "POST",
      url: url,
      data: datas,
      success: function(jsontext){
        var getData = JSON.parse(jsontext);
        $("#modal-status").html(getData.alert_modal);
        clear_modal_data();
         $('#detail_proses').modal('hide');
      }
    });
  }
</script> 

