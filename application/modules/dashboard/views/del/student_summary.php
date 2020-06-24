<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datepicker/datepicker3.css">
<!-- fullCalendar 2.2.5-->
<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/fullcalendar/fullcalendar.min.css">
<<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/bootstrap/css/formValidation.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/fullcalendar/fullcalendar.print.css" media="print">

<!-- Content Header (Page header) -->
<style>
    #datePicker{z-index:1151 !important;}
    .date-picker-control{z-index:1151 !important;}

    .fc-sat, .fc-sun {
    background-color: #bbbbbb !important;
    }

    .blink_me {
      animation: blinker 1s linear infinite;
    }

    .se_style{
      padding: 60px;
    }

    @keyframes blinker {  
      50% { opacity: 0; }
    }
</style>
<script type="text/javascript">
  // Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
<script>
    $( document ).ready(function() {
       ajaxPopulate();



      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#blah').attr('src', e.target.result);
                  $('#blah').show();

              }

              reader.readAsDataURL(input.files[0]);
          }
      }

      $("#imgInp").change(function(){
          readURL(this);
      });

      var next_step ='<?php echo $next_step;?>';
      // alert(next_step);

      if(next_step=='asal_sekolah'){
         $('#detailAsalSekolah').modal('show');
      }else if(next_step='step_ayah'){
       
        window.location = "<?php echo site_url('familys/primary_add/A.'.$profile->id.'-1') ?>";
      }else if(next_step='step_ibu'){
       
        window.location = "<?php echo site_url('familys/primary_add/A.'.$profile->id.'-1') ?>";
      }


    

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

    function clearScr(){
        $('#blah').hide();

    };

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

    function ajaxPopulate(){
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('dashboard/populate_presensi')?>",
        data: { 
          profile_id :'<?php echo $profile->id?>',
          type : $('#absensi-data').val(),
          ta : $('#absensi-ta').val(),
          smt : $('#absensi-smt').val(),
        },
        success: function(html)
        {
          $("#print-data-absensi").html(html);
        }
        });
    }



   
    //Date picker
    
</script>
<script>
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
    </script> 

  <script type="text/javascript">   
      $( document ).ready(function() {
        $('#surat_pemberitahuan').hide();

          $('#datePicker').datepicker({
          autoclose: true,
          format: 'dd/mm/yyyy'
        });

        $('#datePicker2').datepicker({
          autoclose: true,
          format: 'dd/mm/yyyy'
        });

        $('#datePicker3').datepicker({
          autoclose: true,
          format: 'dd/mm/yyyy'
        });
        $('#datePicker33').datepicker({
          autoclose: true,
          format: 'dd/mm/yyyy'
        });

        $('#dateStartPicker').datepicker({
          autoclose: true
        });





      });
      function showDetailSE(){
        // document.getElementById("surat_pemberitahuan").show();
         $('#surat_pemberitahuan').show();
      }  

      function deleteFam(a){
        // alert(a.id);
        document.getElementById("delFam").href=a.id;
      }

        function closeSE(){
          // document.getElementById("surat_pemberitahuan").show();
           $('#surat_pemberitahuan').hide();
        }  
        function PrintDiv() {    
           var divToPrint = document.getElementById('divToPrint');
           var popupWin = window.open('', '_blank', 'width=100%,height=300');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                };


        function hide_non_mutasi(){
        $("#non_mutation").hide();
        $("#mutation").show();
    };

    function show_non_mutasi(){
        $("#non_mutation").show();
        $("#mutation").hide();
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

  </script>

<section class="content-header">
    <h1>
    <?php echo $title; ?>
    <small><?php if(isset($new_student)) { echo '<i class="fa fa-user"></i>&nbsp;&nbsp;New End User'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit End User'; } ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>" tooltip="Goto Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>"><?php echo $title; ?></a></li>
        <li class="active"><?php if(isset($new_student)) { echo '<i class="fa fa-user"></i>&nbsp;&nbsp;New End User'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit End User'; } ?></li>
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
	<!-- <div><button class="btn btn-success-o"> Export</button></div> -->
    <div class="row">
    	<div class="col-sm-8">
    		<div class="box box-widget widget-user">
    			<div class="widget-user-header bg-green">
               	<div class="pull-right">
           		<?php if($this->session->userdata('user_group_id')!='3'){ ?> <a  class="btn btn-default btn-xs" ><i class="fa fa-download"></i> Export PDF </span></a> <?php } ?>
              <?php if($user->active_status!='N'){ ?>
           	<!-- 	<a class="btn btn-warning btn-xs" 
           		data-toggle="modal" data-backdrop="static" data-target="#detailProfilPrimer"><i class="fa fa-edit"></i> Ubah Profil</span></a> -->
              <?php }?>
               	</div>
                  <h3 class="widget-user-username"><?php if($user && $user->fullname!='') {echo $user->fullname; } else { echo "Profile belum di isi";}?></h3>
                  <h5 class="widget-user-desc">NIK: 
                  <?php if($profile){ 
                  	if ($user->nik==''){
						          echo 'Not Set'; 
                  	}else{ 
                  		echo $user->nik;
                  	} 
                  } else { 
                  	echo "Not Set";
                  }?>
                  </h5>

                </div>
                <div class="widget-user-image">
                  <!-- <img class="img-circle" src="<?php echo base_url(); ?>themesAdmin/dist/img/user1-128x128.jpg" alt="User Avatar"> -->

                    <div class="text-center" 
                    <?php if(isset($user)){?>
                    onmouseover="ajaxChangeBtn(true)" onmouseout="ajaxChangeBtn(false)" <?php } ?>

                    >

                      <?php if(isset($user)){?>
                       <?php if($user->photo_url==''){?>
                        <img  class="img-circle" src="<?php echo base_url(); ?>themesAdmin/dist/img/user1-128x128.jpg" style="width: 90px;height: 90px;">
                        <?php }else{ ?>
                        <img class="img-circle" src="<?php echo base_url(); ?>data/profile/<?php echo $user->photo_url;?>" style="width: 90px;height: 90px;">
                        <?php } ?>
                      <?php } else{?>
                      <img class="img-circle" src="<?php echo base_url(); ?>themesAdmin/dist/img/user3-128x128.jpg" alt="User Image" style="width: 90px;height: 90px;">
                      <?php }?>

                       <div id="btn-change" class="text-center" style="position: absolute; top: 35%; left: 35%; display: none;"><a class="btn btn-default btn-xs" data-toggle="modal" data-backdrop="static" data-target="#changePP">Ubah Photo</a></div>

                    </div>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">Username</h5>
                        <span class=""><?php echo $user->username;?></span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">Tempat tgl lahir</h5>
                        <span class=""><?php if($profile){ 

                        	$date = new DateTime($profile->dob);
                            $bdformat = $date->format('d F Y');
                        	echo $profile->pob.', '. 
                        $bdformat;} else{

                          $date = new DateTime($user->dob);
                            $bdformat = $date->format('d F Y');
                          echo $bdformat;

                          } ?></span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">Tanggal Daftar</h5>
                        <span class=""><?php $date = new DateTime($user->created_date);
                              echo  $date->format('d F Y h:i:s');?></span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div>
              </div><!-- /.widget-user -->
    	</div>
      <!-- INFO STATUS -->
    	<div class="col-sm-4">
    		 <div class="box box-success">
            <div class="box-header bg-green">
              <h3 class="box-title">Info Status</h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Konten</th>
                  <th>Status</th>
                </tr>
                <tr>
                  <td>Status Aktivasi</td>
                  <td>
                    <?php if ($user->active_status=='N'){?>
                      <span class="label label-warning">Belum Aktif</span>
                    <?php }else if($user->active_status=='A'){?>
                      <span class="label label-success">Aktif</span>
                    <?php }?>
                  </td>
                </tr>
                <tr>
                  <td>Status Proses</td>
                  <td>
                    <?php if($user->progress_status==0){ ?>
                      <span class="label label-primary">Menunggu Proses</span>
                      <?php }else{?>
                        <?php foreach ($all_status as $as) {
                            if($user->progress_status==$as->id){?>
                            <span class="label label-info"><?php echo $as->name; ?></span> 
                            <?php if($user->message!=''){?>
                              <br>
                              <br>
                              <div onClick="showDetailSE()">
                             <a class="btn btn-danger blink_me" ><i class="fa fa-file"></i> Surat Pemberitahuan</a>
                             <br> </div>

                            <?php }?>

                        <?php }
                            } ?> 
                    <?php } ?>
                  </td>

                </tr>
                
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
    	</div>


       <div class="col-md-12" id="surat_pemberitahuan" >
          <div class="box box-default">
            <div class="box-body">
              <span class="btn btn-danger-o btn-xs pull-right" onClick="closeSE()"><i class="fa fa-times-circle"></i></span>
              <div class="se_style">
                <?php $msg =  $user->message;

                  $msg = str_replace("*|STEPA-NAME|*",$user->fullname, $msg);
                  $msg = str_replace('*|STEPA-NIK|*', $user->nik, $msg);
                
                  echo $msg;
                ?>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
      </div>


    	<!-- kondisi jika ada profile -->
      <?php if($user->active_status=='N'){ ?>
        <div class="col-md-12">
          <div class="box box-default">
           
            <div class="box-body">
              <div class="text-center">

                <?php foreach ($anno as $an) {
                  if($an->id=='3'){
                  ?>
                  <?php echo $an->content;?>
                <?php } } ?>

              </div>

              <div id="divToPrint">
                <table class="table table-responsive">
                  <tr style="padding-bottom: 20px;">
                    <td colspan="2">
                    <strong>INVOICE <i><?php if($pendaftaran){echo $pendaftaran->name;}else{echo 'Pengguna tidak memiliki data pendaftaran online, mohon hubungin customer care kami.';}?></i></strong>
                    </td>
                    <td style="text-align: right;">
                      <small class="pull-right">Tanggal: <?php $date = new DateTime($user->created_date);
                      echo  $date->format('d F Y');?></small>
                    </td>
                  </tr>
                  <tr>
                    <td width="35%">
                      Dari:
                        <table>
                        <tr>
                          <td style="padding-right:10px; vertical-align: top;">
                            <?php if($profile_sekolah->logo!=""){?>
                            <img style="width: 64px;height: 64px;" src="<?php echo base_url(); ?>data/inst_img/<?php echo $profile_sekolah->logo;?>">
                            <?php }else{?>
                             <img style="width: 64px;height: 64px;" src="<?php echo base_url(); ?>themesAdmin/dist/img/tutwuri.png ">
                            <?php  } ?>
                          </td>
                          <td><strong><?php echo $profile_sekolah->name;?></strong><br>
                          <?php echo $profile_sekolah->address;?><br>
                          Phone : <?php echo $profile_sekolah->phone;?><br>
                          Email : <?php echo $profile_sekolah->email;?>
                          </td>
                        </tr>
                        </table>
                    </td>
                    <td width="35%" style="vertical-align: top">
                      Kepada:<br>
                        <strong><?php echo $user->fullname;?></strong><br>
                        NIK: <?php echo $user->nik;?><br>
                        Email: <?php echo $user->username;?>
                    </td>
                    <td width="30%" style="text-align: right; vertical-align: top;">
                      <b>Invoice #007612</b><br>
                      <b>Jatuh Tempo:</b>
                      <?php  
                          $date = $user->created_date;
                          // $date1 = str_replace('-', '/', $date);
                          $tomorrow = date('d F Y',strtotime($date . "+3 days"));
                          echo $tomorrow;

                       ?>
                      <br>
                      <!-- <b>Account:</b> 968-34567 -->
                    </td>
                  </tr>
                  <tr>
                  </tr>
                </table>
                <hr>
                <table class="table table-striped "  width="100%">
                  <thead >
                    <tr bgcolor="#f8f8f8">
                      <th style="text-align: left;">No</th>
                      <th style="text-align: left;">Item</th>
                      <th style="text-align: right;">Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; $total=0; foreach ($keuangan as $keu) {
                      if($keu->id_cat==3){
                        if($user->level_masuk_id!=0){
                          if($user->level_masuk_id==$keu->tingkat_id){
                            ?>
                            <tr>
                              <td width="10%"><?php echo $i; ?></td>
                              <td width="60%">
                                    <strong><?php echo $keu->item_category;?></strong><br>
                                    <?php echo $keu->name;?></td>
                              
                              <td width="30%" style="text-align: right;">Rp <?php echo number_format($keu->nominal, 0, ',', '.');?></td>
                            </tr>
                            <?php 
                            $total = $total +$keu->nominal;
                             $i++;
                           }
                         }else{?>

                          <tr>
                            <td width="10%"><?php echo $i; ?></td>
                            <td width="60%">
                                  <strong><?php echo $keu->item_category;?></strong><br>
                                  <?php echo $keu->name;?></td>
                            
                            <td width="30%" style="text-align: right;">Rp <?php echo number_format($keu->nominal, 0, ',', '.');?></td>
                          </tr>
                          <?php 
                          $total = $total +$keu->nominal;
                           $i++;
                         }
                        }
                      } ?>
                   
                   
                  </tbody>
                </table>
                <table class="table" width="100%" style="display: none;">
                  <tbody>
                     <tr>
                      <td width="70%" style="text-align: right;"><strong><h4>Total:</h4></strong></td>
                      <td width="30%" style="text-align: right;"><strong><h4><?php echo 'Rp. '.number_format($total, 0, ',', '.');?></h4></strong></td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <div class="no-print">
                <table class="table table-striped">
                  <tr>
                    <td>
                      <p class="lead">Metode Pembayaran:</p>
                      <div>
                         <?php foreach ($note as $not) {
                          if($not->id=='3'){
                          ?>
                          <?php echo $not->content;?>
                        <?php } } ?>
                      </div>
                      <div class="text-muted well well-sm no-shadow" ><p style="margin-top: 10px;">
                      <div class="row no-padding no-margin">
                        <?php $a=0; foreach ($account_bank as $ab) {

                          if(($a%3)==0){ echo '</div><br><div class="row no-padding no-margin">'; }
                          ?>
                        <div class="col-md-4">
                          <strong><?php echo $ab->acc_bank;?></strong><br>
                          <?php echo $ab->acc_number;?><br>
                          An: <?php echo $ab->acc_name;?><br>
                          <?php echo $ab->branch;?><br>

                        </div>

                        <?php  $a++; } ?>
                      </div>
                        <br>
                        Metode pembayaran dapat dilakukan dengan cara:
                        <ol>
                        <li> transfer dan upload bukti pendaftaran</li>
                        <li> Pembayaran melalui offline kasir sekolah </li>
                        </ol>
                      </p>
                      </div>
                    </td>
                    <td>
                      <!-- <p class="lead" style="text-align: right;">Amount Due 2/22/2014</p> -->
                      <!-- <div class="table-responsive">
                        <table class="table">
                       
                          <tr>
                            <th>Total:</th>
                            <td>$265.24</td>
                          </tr>
                        </table>
                      </div> -->
                    </td><!-- /.col -->
                  </tr>
                </table>
                <br>
                <?php if(!empty($confirm)) { ?>
                  <table class="table table-striped">
                  <tr> 
                    <th>No</th>
                    <th>Item</th>
                    <th>Nominal</th>
                    <th>Tanggal Upload</th>
                    <th>File Upload</th>
                  </tr>
                    <?php $a=0;
                    foreach ($confirm as $c) $a++; { ?>
                    <tr>
                      <td><?php echo $a; ?></td>
                      <td><?php echo $c->name; ?></td>
                      <td><?php echo $c->nominal; ?></td>
                      <td><?php echo $c->trans_date; ?></td>
                      <td><a href="<?php echo base_url(); ?>data/invoice/<?php echo $c->file_url;?>" terget="_blank"><?php echo $c->file_url; ?></a></td>
                    </tr>
                    <?php } ?>
                  </table>
                <?php } ?>
                <div class="col-xs-12">
                  <a href="#" class="btn btn-default" onClick="PrintDiv()"><i class="fa fa-print"></i> Print</a>
                  <?php if(!empty($confirm)) { ?>
                      <button class="btn btn-warning pull-right" data-toggle="modal" data-backdrop="static"><i class="fa fa-credit-card"></i> Menunggu Konfirmasi</button>
                  <?php } else { ?>
                    <button class="btn btn-success pull-right" data-toggle="modal" data-backdrop="static" data-target="#dialogPembayaran"><i class="fa fa-credit-card"></i> Konfirmasi Pembayaran</button>
                  <?php } ?>
                </div>
              </div>
            </div><!-- /.box-body -->
                
          </div><!-- /.box -->

            
          
        </div>
      <?php } else if($user->pass_status=='Y' && $user->pass_verified=='N') { ?>
         <div class="col-md-12">
          <div class="box box-default">
            <div class="box-body">
               <div class="text-center">
                <?php foreach ($anno as $an) {
                  if($an->id=='4'){
                  ?>
                  <?php echo $an->content;?>
                <?php } } ?>
              </div>
              <div id="divToPrint">
                <table class="table table-responsive">
                  <tr style="padding-bottom: 20px;">
                    <td colspan="2">
                    <strong>INVOICE <i><?php if($pendaftaran){echo $pendaftaran->name;}else{echo 'Pengguna tidak memiliki data pendaftaran online, mohon hubungin customer care kami.';}?></i></strong>
                    </td>
                    <td style="text-align: right;">
                      <small class="pull-right">Tanggal: <?php $date = new DateTime($user->created_date);
                      echo  $date->format('d F Y');?></small>
                    </td>
                  </tr>
                  <tr>
                    <td style="padding-right:10px; vertical-align: top;">
                      <?php if($profile_sekolah->logo!=""){?>
                      <img style="width: 64px;height: 64px;" src="<?php echo base_url(); ?>data/inst_img/<?php echo $profile_sekolah->logo;?>">
                      <?php }else{?>
                       <img style="width: 64px;height: 64px;" src="<?php echo base_url(); ?>themesAdmin/dist/img/tutwuri.png ">
                      <?php  } ?>
                    </td>
                    <td width="35%">
                      Dari:
                      <address>
                        <strong><?php echo $profile_sekolah->name;?></strong><br>
                        <?php echo $profile_sekolah->address;?><br>
                        Phone : <?php echo $profile_sekolah->phone;?><br>
                        Email : <?php echo $profile_sekolah->email;?>
                      </address>
                    </td>
                    <td width="35%" style="vertical-align: top">
                      Kepada:
                      <address>
                        <strong><?php echo $user->fullname;?></strong><br>
                        NIK: <?php echo $user->nik;?><br>
                        Email: <?php echo $user->username;?>
                      </address>
                    </td>
                    <td width="30%" style="text-align: right; vertical-align: top;">
                      <b>Invoice #007612</b><br>
                      <b>Jatuh Tempo:</b>
                      <?php  
                          $date = $user->created_date;
                          $tomorrow = date('d F Y',strtotime($date . "+3 days"));
                          echo $tomorrow;
                       ?>
                      <br>
                      <!-- <b>Account:</b> 968-34567 -->
                    </td>
                  </tr>
                  <tr>
                  </tr>
                </table>
                <hr>
                <table class="table table-striped "  width="100%">
                  <thead >
                    <tr bgcolor="#f8f8f8">
                      <th style="text-align: left;">Qty</th>
                      <th style="text-align: left;">Item</th>
                      <th style="text-align: right;">Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; $total=0; foreach ($keuangan as $keu) {
                      if($keu->id_cat==4){
                      ?>
                      <tr>
                        <td width="10%">1</td>
                        <td width="60%"><strong><?php echo $keu->item_category;?></strong><br>
                              <?php echo $keu->name;?></td>
                        <td width="30%" style="text-align: right;">Rp <?php echo number_format($keu->nominal, 0, ',', '.');?></td>
                      </tr>
                    <?php 
                       $total = $total +$keu->nominal;  $i++;
                      }
                      } ?>
                  </tbody>
                </table>
             <!--    <table class="table" width="100%">
                  <tbody>
                     <tr>
                      <td width="70%" style="text-align: right;"><strong><h4>Total:</h4></strong></td>
                      <td width="30%" style="text-align: right;"><strong><h4><?php echo 'Rp. '.number_format($total, 0, ',', '.');?></h4></strong></td>
                      </tr>
                  </tbody>
                </table> -->
              </div>
              <div class="no-print">
                <table class="table table-striped">
                  <tr>
                    <td>
                      <p class="lead">Metode Pembayaran:</p>
                      <div>
                         <?php foreach ($note as $not) {
                          if($not->id=='4'){
                          ?>
                          <?php echo $not->content;?>
                        <?php } } ?>
                      </div>
                      <div class="text-muted well well-sm no-shadow" ><p style="margin-top: 10px;">
                        <div class="row no-padding no-margin">
                        <?php foreach ($account_bank as $ab) {?>
                        <div class="col-md-6">
                          <strong><?php echo $ab->acc_bank;?></strong><br>
                          <?php echo $ab->acc_number;?><br>
                          An: <?php echo $ab->acc_name;?><br>
                          <?php echo $ab->branch;?><br>
                          

                        </div>
                        <?php } ?>
                      </div>
                      <br>
                        Metode pembayaran dapat dilakukan dengan cara:
                        <ol>
                        <li> transfer dan upload bukti pendaftaran</li>
                        <li> Pembayaran melalui offline kasir sekolah </li>
                        </ol>
                      </p>
                      </div>
                    </td>
                    <td>
                      <!-- <p class="lead" style="text-align: right;">Amount Due 2/22/2014</p> -->
                      <!-- <div class="table-responsive">
                        <table class="table">
                       
                          <tr>
                            <th>Total:</th>
                            <td>$265.24</td>
                          </tr>
                        </table>
                      </div> -->
                    </td><!-- /.col -->
                  </tr>
                </table>
                <br>
                <?php if(!empty($confirm)) { ?>
                  <table class="table table-striped">
                  <tr> 
                    <th>No</th>
                    <th>Item</th>
                    <th>Nominal</th>
                    <th>Tanggal Upload</th>
                    <th>File Upload</th>
                  </tr>
                    <?php $a=0;
                    foreach ($confirm as $c) $a++; { ?>
                    <tr>
                      <td><?php echo $a; ?></td>
                      <td><?php echo $c->name; ?></td>
                      <td><?php echo $c->nominal; ?></td>
                      <td><?php echo $c->trans_date; ?></td>
                      <td><a href="<?php echo base_url(); ?>data/invoice/<?php echo $c->file_url;?>" terget="_blank"><?php echo $c->file_url; ?></a></td>
                    </tr>
                    <?php } ?>
                  </table>
                <?php } ?>
                <div class="col-xs-12">
                  <a href="#" class="btn btn-default" onClick="PrintDiv()"><i class="fa fa-print"></i> Print</a>
                  <?php if(!empty($confirm)) { ?>
                      <button class="btn btn-warning pull-right" data-toggle="modal" data-backdrop="static"><i class="fa fa-credit-card"></i> Menunggu Konfirmasi</button>
                  <?php } else { ?>
                    <button class="btn btn-success pull-right" data-toggle="modal" data-backdrop="static" data-target="#dialogPembayaran"><i class="fa fa-credit-card"></i> Konfirmasi Pembayaran</button>
                  <?php } ?>
                </div>
              </div>
            </div><!-- /.box-body -->
                
          </div><!-- /.box -->
        </div>
      <?php } ?>
      <?php if($user->active_status=='A'){ ?>
    	<?php if($profile){ ?>
        <div class="col-md-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li <?php if(!isset($tab) || $tab =='activity'){ echo 'class="active"';}?>>
                  <a href="#activity" data-toggle="tab">Data Diri</a>
                </li>

                <!-- <li <?php if(isset($tab)) if($tab =='akademik'){ echo 'class="active"';}?>>
                  <a href="#timeline" data-toggle="tab">Akademik</a>
                </li> -->

             <!--    <li <?php  if(isset($tab)) if($tab =='ekskul'){ echo 'class="active"';}?>>
                  <a href="#ekstrakulikuler" data-toggle="tab">Ekstrakulikuler</a>
                </li> -->

              <!--   <li <?php  if(isset($tab)) if($tab =='absensi'){ echo 'class="active"';}?>>
                  <a href="#absensi" data-toggle="tab">Presensi</a>
                </li> -->

                <!-- <li  <?php  if(isset($tab)) if($tab =='behavior'){ echo 'class="active"';}?>>
                  <a href="#behavior" data-toggle="tab">Perilaku</a>
                </li> -->

               <!--  <li  <?php  if(isset($tab)) if($tab =='biaya'){ echo 'class="active"';}?>> 
                  <a href="#settings" data-toggle="tab">Biaya</a>
                </li> -->

                <!-- <li  <?php  if(isset($tab)) if($tab =='dokumen'){ echo 'class="active"';}?>>
                  <a href="#dokumen" data-toggle="tab">Dokumen</a>
                </li>  -->
               <!--  <li  <?php  if(isset($tab)) if($tab =='setting'){ echo 'class="active"';}?>>
                  <a href="#settings" data-toggle="tab">Akun Setting</a>
                </li> -->
              </ul>
              <div class="tab-content">
                <div class=" <?php if(!isset($tab) || $tab =='activity'){ echo 'active';}?> tab-pane" id="activity">
                  <div class="post">
                    <?php if($profile){?>
                    <div class="row">

                      <!-- Personalisasi -->
                      <div class="col-sm-12">
                        <div>
                            <div class="box-header with-border">
                              <a class="pull-right" data-toggle="modal" data-backdrop="static" data-target="#detailProfilPrimer"><i class="fa fa-edit"></i> ubah</a>
                              <h3 class="box-title text-green text-bold">DATA PRIBADI</h3>
                            </div><!-- /.box-header -->
                            <div>
                              <?php if($profile){?>
                                <div class="col-sm-4 ">
                                  <table class="table table-condensed">
                                   <!--  <tr>
                                      <td><label>Nama Lengkap</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->full_name; ?></td>
                                    </tr> -->
                                    <tr>
                                      <td><label>Nama Panggilan</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->nick_name; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Kewarganegaraan </label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->nationality; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>No NIK</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->nik; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>No Akte </label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->no_akte; ?></td>
                                    </tr>
                                     <tr>
                                      <td><label>No KK</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->no_kk; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Tempat, Tgl Lahir</label></td>
                                      <td>:</td>
                                      <td>

                                      	<?php 

                                    	$date = new DateTime($profile->dob);
					                    echo $profile->pob .", ". $date->format('d F Y');?>
					                    </td>
                                    </tr>
                                    <tr>
                                      <td><label>Jenis Kelamin</label></td>
                                      <td>:</td>
                                      <td><?php if($profile->gender=='M'){ echo 'Laki-laki';} else { echo 'Perempuan';}?></td>
                                    </tr>
                                      <tr>
                                      <td><label>Agama</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->religion; ?></td>
                                    </tr>
                                  </table>
                                </div>
                                <div class="col-sm-offset-1 col-sm-7">
                                  <table class="table table-condensed">
                                    <tr>
                                      <td><label>Anak Ke</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->anak_ke; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Saudara Kandung</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->saudara_kandung_total; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Saudara Tiri</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->saudara_tiri_total; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Saudara Angkat</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->saudara_angkat_total; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Tinggal Bersama</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->tinggal_bersama; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Telp Orang Tua</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->phone_parent; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Telp Rumah</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->phone_home; ?></td>
                                    </tr>
                                    <tr>
                                      <td><label>Alamat</label></td>
                                      <td>:</td>
                                      <td><?php echo $profile->address. ', RT '.$profile->rt.' RW ' .$profile->rt.', Kelurahan '.$profile->kelurahan. ',<br> Kecamatan '.$profile->kecamatan.', '.$profile->kota; ?></td>
                                    </tr>
                                  </table>
                                </div>
                              <?php } else { ?>
                              <div class="col-sm-12"  >
                              <div class="text-center">
                                <img  src="<?php echo base_url(); ?>themesAdmin/dist/img/personality.png" alt="User Avatar">
                                <br>
                                <h4 class="text-bold">Personalitas</h4>
                                Data Asal Sekolah Belum diatur.<br>Silahkan klik tambahkan untuk menambah data asal sekolah digunakan untuk identifikasi murid,<br>sedangkan mutasi jika murid masuk dengan cara berpindah dari sekolah lain
                                <br><br>
                                <a class="btn btn-success-o" data-toggle="modal" data-backdrop="static" data-target="#detailProfilPrimer">
                                Tambahkan</a>
                              </div>
                              </div>
                              <?php } ?>
                            </div>
                            <div class="clearfix text-right">
                              <!-- <i><label class="text-orange">Note : </label>data asal sekolah digunakan untuk identifikasi murid, sedangkan mutasi jika murid masuk dengan cara berpindah dari sekolah lain</i> -->
                              
                              <br>
                            </div><!-- /.box-footer -->
                        </div><!-- /.box -->
                      </div>
                      <!-- Asal Sekolah -->
                      <div class="col-sm-12">
                        <div>
                          <?php if($asal_sekolah==false){?>
                            <div class="col-sm-12 text-center"  >
                              <img  src="<?php echo base_url(); ?>themesAdmin/dist/img/school.png" alt="User Avatar">
                              <br>
                              <h4 class="text-bold">Sekolah</h4>
                              Data Asal Sekolah Belum diatur.<br>Silahkan klik tambahkan untuk menambah data asal sekolah digunakan untuk identifikasi murid,<br>sedangkan mutasi jika murid masuk dengan cara berpindah dari sekolah lain
                              <br><br>
                              <a class="btn btn-danger-o" data-toggle="modal" data-backdrop="static" data-target="#detailAsalSekolah">
                              Tambahkan</a>
                            </div>
                          <?php } else { 
                            if($asal_sekolah->entry_status=='PSB'){
                            ?>
                            <div class="col-sm-12">
                              <div class="box-header with-border">
                                <a class="pull-right" data-toggle="modal" data-backdrop="static" data-target="#detailAsalSekolah"><i class="fa fa-edit"></i> ubah</a>
                                <h3 class="box-title text-green text-bold">ASAL SEKOLAH</h3>
                              </div><!-- /.box-header -->
                              <div class="box-body no-padding">
                                <div class="col-sm-4">
                                <table class="table table-condensed">
                                  <tr>
                                    <td><label>Nama Sekolah</label></td>
                                    <td>:</td>
                                    <td><?php echo $asal_sekolah->name; ?></td>
                                  </tr>
                                  <tr>
                                    <td><label>NISN</label></td>
                                    <td>:</td>
                                    <td><?php echo $asal_sekolah->nisn; ?></td>
                                  </tr>
                                  <tr>
                                    <td><label>No Ijazah</label></td>
                                    <td>:</td>
                                    <td><?php echo $asal_sekolah->cert_qualify_no; ?></td>
                                  </tr>
                                  <tr>
                                    <td><label>Tgl Lulus</label></td>
                                    <td>:</td>
                                    <td><?php 

                                    	$date = new DateTime($asal_sekolah->graduation_date);
					                    echo  $date->format('d F Y');?></td>
                                  </tr>
                                </table>
                                </div>
                                <div class="col-sm-7 col-sm-offset-1">
                                <table class="table table-condensed">
                                  <tr>
                                    <td><label>Lamanya Belajar</label></td>
                                    <td>:</td>
                                    <td><?php echo $asal_sekolah->year_start.'-'.$asal_sekolah->year_end; ?></td>
                                  </tr>
                                  <tr>
                                    <td><label>Nilai UASBN</label></td>
                                    <td>:</td>
                                    <td><?php echo $asal_sekolah->uasbn; ?></td>
                                  </tr>
                                  <tr>
                                    <td><label>UAN</label></td>
                                    <td>:</td>
                                    <td><?php echo $asal_sekolah->uan; ?></td>
                                  </tr>
                                </table>
                                </div>
                              </div><!-- /.box-body -->
                            </div>
                            <?php } else { ?>
                            <div class="col-sm-12">
                              <div class="box-header with-border">
                                <a class="pull-right" data-toggle="modal" data-backdrop="static" data-target="#detailAsalSekolah"><i class="fa fa-edit"></i> ubah</a>
                                  <h3 class="box-title text-green text-bold">MUTASI SEKOLAH</h3>
                              </div><!-- /.box-header -->
                              <div class="box-body no-padding">
                                <table class="table table-condensed">
                                 
                                  <tr>
                                    <td><label>Nama Sekolah</label></td>
                                    <td>:</td>
                                    <td><?php echo $asal_sekolah->name; ?></td>
                                  </tr>
                                  <tr>
                                    <td><label>No Ijazah</label></td>
                                    <td>:</td>
                                    <td><?php echo $asal_sekolah->cert_qualify_no; ?></td>
                                  </tr>
                                  <tr>
                                    <td><label>Tgl Lulus</label></td>
                                    <td>:</td>
                                    <td><?php 

                                    	$date = new DateTime($asal_sekolah->graduation_date);
					                    echo  $date->format('d F Y');?></td>
                                  </tr>
                                  <tr>
                                    <td><label>Lamanya Belajar</label></td>
                                    <td>:</td>
                                    <td><?php echo $asal_sekolah->year_start.' - '.$asal_sekolah->year_end; ?></td>
                                  </tr>
                                  <tr>
                                    <td><label>Alasan Berpindah</label></td>
                                    <td>:</td>
                                    <td><?php echo $asal_sekolah->entry_recent; ?></td>
                                  </tr>
                                  <tr>
                                    <td><label>Mutasi Ke Kelas</label></td>
                                    <td>:</td>
                                    <td><?php echo $asal_sekolah->entry_level; ?></td>
                                  </tr>
                                </table>
                              </div><!-- /.box-body -->
                            </div>
                          <?php }
                          } ?>
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
                              <h3 class="box-title text-green text-bold">DATA KELUARGA</h3>
                              <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                
                              </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                              <!-- DATA AYAH -->
                              <div class="col-sm-6">
                                <?php if($ayah){?>
                                  <div class="box-header with-border">
                                    <a class="pull-right" href="<?php echo site_url('familys/primary_edit/A.'.$profile->id.'-'.$ayah->family_id ) ?>"><i class="fa fa-edit"></i> ubah</a>
                                      <h3 class="box-title  text-bold">DATA AYAH</h3>
                                  </div><!-- /.box-header -->
                                  <div class="box-body no-padding">
                                    <table class="table table-condensed">
                                     
                                      <tr>
                                        <td><label>Nama Ayah </label></td>
                                        <td>:</td>
                                        <td><?php echo $ayah->name; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>NIK </label></td>
                                        <td>:</td>
                                        <td><?php echo $ayah->nik; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>TTL</label></td>
                                        <td>:</td>
                                        <td><?php 

                                        $date = new DateTime($ayah->dob);
					                    echo $ayah->pob .', '. $date->format('d F Y');
					                    ?>



                                       </td>
                                      </tr>
                                      <tr>
                                        <td><label>No Hp</label></td>
                                        <td>:</td>
                                        <td><?php echo $ayah->tel_mobile; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>Email</label></td>
                                        <td>:</td>
                                        <td><?php echo $ayah->email; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>Pendidikan Terakhir</label></td>
                                        <td>:</td>
                                        <td><?php echo $ayah->graduate; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>Pekerjaan</label></td>
                                        <td>:</td>
                                        <td><?php echo $ayah->job; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>Nama Kantor</label></td>
                                        <td>:</td>
                                        <td><?php echo $ayah->office_name; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>Alamat Kantor</label></td>
                                        <td>:</td>
                                        <td><?php echo $ayah->office_address; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>Tel Kantor</label></td>
                                        <td>:</td>
                                        <td><?php echo $ayah->tel_work; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>Penghasilan Bulanan</label></td>
                                        <td>:</td>
                                        <!-- <td><?php echo $ayah->income; ?></td> -->
                                        <td>Rp. <?php echo $ayah->income; ?></td>
                                      </tr>
                                    </table>
                                  </div><!-- /.box-body -->
                                <?php  }else{?>
                                <div class="text-center">
                                  <img  src="<?php echo base_url(); ?>themesAdmin/dist/img/father.png" alt="User Avatar">
                                  <br>
                                  <h4 class="text-bold">Data Ayah</h4>
                                  Atur Data Ayah untuk melengkapi data
                                  <br><br>
                                  <a href="<?php echo site_url('familys/primary_add/A.'.$profile->id.'-1') ?>" class="btn btn-danger-o" >
                                  Tambahkan</a>
                                </div>
                                <?php } ?>
                              </div>

                              <!-- DATA IBU -->
                              <div class="col-sm-6">
                                 <?php if($ibu){?>
                                  <div class="box-header with-border">
                                    <a class="pull-right" href="<?php echo site_url('familys/primary_edit/I.'.$profile->id.'-'.$ibu->family_id ) ?>"><i class="fa fa-edit"></i> ubah</a>
                                      <h3 class="box-title  text-bold">DATA IBU</h3>
                                  </div><!-- /.box-header -->
                                  <div class="box-body no-padding">
                                    <table class="table table-condensed">
                                     
                                      <tr>
                                        <td><label>Nama Ibu</label></td>
                                        <td>:</td>
                                        <td><?php echo $ibu->name; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>NIK</label></td>
                                        <td>:</td>
                                        <td><?php echo $ibu->nik; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>TTL</label></td>
                                        <td>:</td>
                                        <td><?php $date = new DateTime($ibu->dob);
					                    echo $ibu->pob .', '. $date->format('d F Y');
					                    ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>No Hp</label></td>
                                        <td>:</td>
                                        <td><?php echo $ibu->tel_mobile; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>Email</label></td>
                                        <td>:</td>
                                        <td><?php echo $ibu->email; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>Pendidikan Terakhir</label></td>
                                        <td>:</td>
                                        <td><?php echo $ibu->graduate; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>Pekerjaan</label></td>
                                        <td>:</td>
                                        <td><?php echo $ibu->job; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>Nama Kantor</label></td>
                                        <td>:</td>
                                        <td><?php echo $ibu->office_name; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>Alamat Kantor</label></td>
                                        <td>:</td>
                                        <td><?php echo $ibu->office_address; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>Tel Kantor</label></td>
                                        <td>:</td>
                                        <td><?php echo $ibu->tel_work; ?></td>
                                      </tr>
                                      <tr>
                                        <td><label>Penghasilan Bulanan</label></td>
                                        <td>:</td>
                                        <td>Rp. <?php echo $ibu->income; ?></td>
                                      </tr>
                                    </table>
                                  </div><!-- /.box-body -->
                                <?php  }else{?>
                                  <div class="text-center">
                                    <img  src="<?php echo base_url(); ?>themesAdmin/dist/img/mother.png" alt="User Avatar">
                                    <br>
                                    <h4 class="text-bold">Data Ibu</h4>
                                    Atur Data Ibu untuk melengkapi data
                                    <br><br>
                                    <a href="<?php echo site_url('familys/primary_add/I.'.$profile->id.'-1') ?>" class="btn btn-danger-o">
                                    Tambahkan</a>
                                  </div>
                                <?php } ?>
                              </div>

                              <div class="col-sm-12">
                                <br>
                                <?php if($familys){?>
                                	<div class="box-header with-border">
		                              <h3 class="box-title text-green text-bold">DATA TANGGUNGAN ORANG TUA</h3>
		                              <div class="box-tools pull-right">
		                                <button class="btn btn-box-tool btn-success-o"  data-toggle="modal" data-backdrop="static" data-target="#detailFamily"><i class="fa fa-plus"> Tambah Data</i></button>
		                                
		                              </div>
		                            </div><!-- /.box-header -->
		                            <div class="box-body">
		                              <!-- DATA AYAH -->
		                              <div class="col-sm-12">
	                                	<table class="table table-condensed">
	                                     <tr>
	                                     	<th>No</th>
	                                     	<th>Nama</th>
                                        <th>NIK</th>
	                                     	<th>TTL</th>
                                        <th>Hubungan</th>
	                                     	<th>Aksi</th>
	                                     </tr>
		                                  
		                                  <?php $fi=1; foreach ($familys as $f) {?>
		                                  <tr>
		                                  	<td><?php echo $fi; $fi++;?></td>
		                                  	<td><?php echo $f->name;?></td>
		                                  	<td><?php echo $f->nik;?></td>
		                                  	<td><?php 
                                              $sdob =  $f->dob;
                                              $date = date('d-m-Y', strtotime($sdob));
                                              $dateofbirth = str_replace('-', '/', $date);
                                              echo $f->pob.', '.$dateofbirth;?>
                                        </td>
                                        <td><?php echo $f->sibling_remark;?></td>
		                                    <td>
		                                    	
		                                    	<a href="#" id="<?php echo site_url('dashboard/delete_familys/'.$f->family_id.'/'.$profile->id)?>" onClick="deleteFam(this);" data-toggle="modal" data-target="#deleteFam"><i class="fa fa-trash-alt"></i> hapus</a>

		                                    </td>
		                                    </tr>
		                                  <?php } ?>
		                                    
		                                  
	                                      
	                                    </table>
                                    	</div>
                                    </div>
                                <?php }else{?>
                                <div class="text-center">
                                  <img  src="<?php echo base_url(); ?>themesAdmin/dist/img/family.png" alt="User Avatar">
                                  <br>
                                  <h4 class="text-bold">Data Tanggungan Orang Tua</h4>
                                  Data Keluarga Belum diatur.<br>Silahkan klik tambahkan untuk menambah data asal sekolah digunakan untuk identifikasi murid,<br>sedangkan mutasi jika murid masuk dengan cara berpindah dari sekolah lain
                                  <br><br>
                                  <a class="btn btn-success-o" data-toggle="modal" data-backdrop="static" data-target="#detailFamily">
                                  Tambahkan</a>
                                </div>
                                <?php } ?>
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


                <!-- KEDISIPLINAN TAB-->
                <div class="<?php  if(isset($tab)) if($tab =='akademik'){ echo 'active';}?> tab-pane" id="timeline">
                  <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                      <div class="row"> 
                        <div class="col-sm-4">
                        <label>Tahun Ajaran</label>
                        <select class="form-control">
                          <option>AA</option>
                          <option>BB</option>
                        </select>
                        </div>

                        <div class="col-sm-4">
                        <label>Semester</label>
                        <select class="form-control">
                          <option>Semua</option>
                          <option>Genap</option>
                          <option>Ganji</option>
                        </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-10 col-sm-offset-1">
                      <br>
                      <h4 class="text-bold text-green">Data Akademik</h4>
                      <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th style="width: 50px; ">No&nbsp;</th>
                              <th>Matapelajaran</th>
                              <th>Pengajar</th>
                              <th>KKM</th>
                              <th>Nilai</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=1;for($ia=1;$ia<25;$ia++){?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td>Mata Pelajaran <?echo $i?></td>
                              <td>Pengajar <?php echo $i;?></td>
                              <td><?php echo $i*10;?></td>
                              <td><?php echo $i*10;?></td>
                              <td><?php if($i%3==0){?>
                                <span class="label label-success">Lulus</span>
                                <?php } else { ?>
                                <span class="label label-warning">Remedial</span>
                                <?php } ?>
                              </td>
                            </tr>
                            <?php $i++; } ?>
                            </tbody>
                          </table>
                      </div><!-- /.table-responsive -->
                    </div>
                  </div>
                </div><!-- /.tab-pane -->


                <!-- EKSTRAKULIKULER TAB -->
                <div class="<?php  if(isset($tab)) if($tab =='ekskul'){ echo 'active';}?> tab-pane" id="ekstrakulikuler">
                  <div class="row">
                    <?php if($ekstrakulikuler){ ?>
                      <!-- LOOPING EKSKUL-->
                      <div class="col-sm-10 col-sm-offset-1">
                        <br>
                        <div>
                         <a class="btn btn-success pull-right" href="<?php echo site_url('prestudent/ekskul/'.$profile->id.'-1'); ?>" >Tambah Ekstrakulikuler</a>
                         <h4 class="text-bold text-green">List Ekstrakulikuler</h4>
                         </div>
                         
                        <hr>
                      </div>
                      <?php $i=1;foreach ($ekstrakulikuler as $ekskul){?>
                      <div class="col-sm-10 col-sm-offset-1">

                        <div class='box-comment'>
                          <img class='img-circle img-md' src='<?php echo base_url(); ?>themesAdmin/dist/img/ekskul-default.jpg' alt='ekskul logo'>
                          <div class='ekskul-box'>
                            <span class="username">
                              <span class="text-bold text-green title-ekskul"><?php echo $ekskul->name;?></span>
                              <span class='text-muted pull-right'><a href="<?php echo site_url('prestudent/ekskul/'.$ekskul->id.'.'.$profile->id.'-2')?>"><i class="fa fa-edit"></i> Ubah</a>&nbsp;&nbsp;
                              <a href="#" id="<?php echo site_url('prestudent/ekskul/'.$ekskul->id.'.'.$profile->id.'-3')?>" onClick="deleteEkskul(this);" data-toggle="modal" data-target="#deleteEkskul"><i class="fa fa-trash-alt"></i> hapus</a></span>
                            </span><!-- /.username -->
                            <div>
                              <table>
                                <tr>
                                  <td><span class="text-bold">Posisi</span></td><td>:</td>
                                  <td class="padding-8-left"><?php echo $ekskul->position;?></td>
                                </tr>
                                <tr>
                                  <td><span class="text-bold">tahun</span></td><td>:</td>
                                  <td class="padding-8-left"><?php echo $ekskul->join_year;?></td>
                                </tr>
                                <tr>  
                                  <td><span class="text-bold">Prestasi</span></td><td>:</td>
                                  <td class="padding-8-left"> <?php echo $ekskul->achievement;?></td>
                                </tr>
                              </table>
                            </div>
                            <hr>
                          </div><!-- /.comment-text -->
                        </div><!-- /.box-comment -->
                      </div>
                      <?php } ?>
                    <?php }else {?>
                      <!--NO EKSKUL -->
                      <div class="col-sm-12 text-center">
                       <img class='remark-logo' src='<?php echo base_url(); ?>themesAdmin/dist/img/ekskul-default.jpg' alt='ekskul logo'>
                        <br>
                        <h4 class="text-bold">Ekstrakulikuler</h4>
                        Data Kegiatan Belum diatur.<br>Silahkan klik tambahkan untuk menambahkan kegiatan yang diikuti murid
                        <br><br>
                        <a class="btn btn-danger-o" href="<?php echo site_url('prestudent/ekskul/'.$profile->id.'-1'); ?>" >
                        Tambahkan</a>
                      </div>
                    <?php } ?>
                  </div>
                </div><!-- /.tab-pane -->

                <!-- ABSENSI TAB -->
                <div class="tab-pane" id="absensi">
                  <div class="row">
                  <div class="col-sm-10 col-sm-offset-1">
                    <div class="row"> 
                      <div class="col-sm-3">
                        <label>Show Data</label>
                        <select class="form-control" id ="absensi-data" name="data">
                          <option value="A">Semua Data</option>
                          <option value="F">Dengan Filter</option>
                        </select>
                      </div>

                      <div class="col-sm-3" id="absensita" style="display: none;">
                        <label>Tahun Ajaran</label>
                        <select class="form-control" id='absensi-ta'>
                          <?php if($all_ta) foreach ($all_ta as $ta){ ?>
                            <option value="<?php echo $ta->id?>"><?php echo $ta->start_ta.'/'.$ta->end_ta;?></option>
                          <?php } ?>
                        </select>
                      </div>

                    

                      <div class="col-sm-3" id="absensismt" style="display: none;">
                      <label>Semester</label>
                      <select class="form-control" id='absensi-smt'>
                        <option value="">Semua</option>
                        <option value="1">Ganjil</option>
                        <option value="2">Genap</option>
                      
                      </select>
                      </div>
                    </div>

                    <div class="row">
                      
                      <div class="col-xs-12"><br><h4 class="text-bold text-green"><span id="absensi-title-summary">Ringkasan Keseluruhan</span></h4></div>
                      <div class="col-md-3">
                      
                       <div class="table-responsive">
                        <table id="example1" class="table">
                        
                          <tr>
                            <td>Hari KBM</td>
                            <td> 0</td>
                          </tr>
                          <tr>
                            <td>Hari Libur Semester</td>
                            <td>0</td>
                          </tr>
                          <tr>
                            <td>Hari Libur Nasional</td>
                            <td>0</td>
                          </tr>
                          <tr style="border-top: 2px solid #333333">
                            <td class="text-bold">TOTAL HARI EFEKTIF</td>
                            <td> 0</td>
                          </tr>
                        </table>
                        </div>

                      </div>
                      <div class="col-md-3">
                        <div class="table-responsive">
                        <table id="example1" class="table">
                          <tr>
                            <td>Izin</td>
                            <td> 1</td>
                          </tr>
                          <tr>
                            <td>Sakit</td>
                            <td>2</td>
                          </tr>
                          <tr>
                            <td>Alfa</td>
                            <td>3</td>
                          </tr>
                          <tr style="border-top: 2px solid #333333">
                            <td class="text-bold">TOTAL TIDAK HADIR</td>
                            <td>6</td>
                          </tr>
                        </table>
                        </div>

                      </div>

                      <div class="col-md-3">
                      
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-10 col-sm-offset-1">
                  <h4 class="text-bold text-green">List Detail Ketidakhadiran</h4>
                  <br>

                  <div class="col-sm-12" id="print-data-absensi"></div>
                 
                  </div>
                  </div>
                </div><!-- /.tab-pane -->

                <!-- KEDISIPLINAN TAB-->
                <div class="<?php if(isset($tab)) if($tab =='behavior'){ echo 'active';}?> tab-pane" id="behavior">
                  <?php if(!$behavior){?>
                  <div class="row">
                  <div class="col-sm-12 text-center">
                       <img class='remark-logo' src='<?php echo base_url(); ?>themesAdmin/dist/img/ekskul-default.jpg' alt='ekskul logo'>
                        <br>
                        <h4 class="text-bold">Perilaku</h4>
                        Berikut merupakan menu untuk melakukan pendataan perilaku murid.<br>Silahkan klik tambahkan untuk menambahkan laporan perilaku murid
                        <br><br>
                        <a class="btn btn-danger-o" href="<?php echo site_url('prestudent/behavior/'.$profile->id.'-1'); ?>" >
                        Tambahkan</a>
                  </div>
                  </div>
                  <?php } ?>

                  <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                      <div class="row"> 
                        <div class="col-md-3">
                        <h4 class="text-bold text-green">Filter</h4>
                        <div >
                        <label>Tahun Ajaran</label>


                        <select class="form-control">
                        <?php if($all_ta) foreach ($all_ta as $ta){ ?>
                          <option value="<?php echo $ta->id?>"><?php echo $ta->start_ta.'/'.$ta->end_ta;?></option>
                        <?php } ?>
                        </select>
                        </div>

                        <div >
                        <label>Semester</label>
                        <select class="form-control">
                          <option>AA</option>
                          <option>BB</option>
                        </select>
                        </div>
                        </div>

                        <div class="col-md-3">
                        <h4 class="text-bold text-green">Ragkuman</h4>
                         <div class="table-responsive">
                          <table id="example1" class="table">
                            <tr>
                              <td class="">Poin Perilaku Baik</td>
                              <td>  
                                <?php $point = 0; 
                                    foreach ($behavior as $kdsp){ 
                                      if($kdsp->behavior_type ==1) $point = $point + $kdsp->point; 
                                    }
                                    echo $point;
                                ?>    
                              </td>
                            </tr>
                            <tr>
                              <td class="">Poin Perilaku Buruk</td>
                              <td>  
                               <?php $point = 0; 
                                    foreach ($behavior as $kdsp){ 
                                      if($kdsp->behavior_type ==2) $point = $point + $kdsp->point; 
                                    }
                                    echo $point;
                                ?>    
                              </td>
                            </tr>
                            <tr>
                              <td class="text-bold">TOTAL POIN</td>
                              <td>  
                               <?php $point = 0; 
                                    foreach ($behavior as $kdsp){ 
                                      $point = $point + $kdsp->point; 
                                    }
                                    echo $point;
                                ?>    
                              </td>
                            </tr>
                          </table>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="col-sm-10 col-sm-offset-1">
                      <?php if($behavior){?><a class="btn btn-success pull-right" href="<?php echo site_url('prestudent/behavior/'.$profile->id.'-1'); ?>" >
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;Tambahkan</a><?php }?>
                      <h4 class="text-bold text-green">List Data Pelanggaran</h4>
                      
                      <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th style="width: 50px; ">No&nbsp;</th>
                              <th>Tanggal</th>
                              <th>Kasus</th>
                              <th>Penalty Poin</th>
                              <th>Tindakan</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=1;foreach ($behavior as $kdsp){?>
                            <tr>
                              <td><?php echo $i; $i++;?></td>
                              <td><?php 
                                  $fED = date("d-m-Y", strtotime($kdsp->event_date));
                                  echo $fED; ?>
                              </td>
                              <td><?php echo $kdsp->name; ?></td>
                              <td><?php echo $kdsp->point; ?></td>
                              <td><a href="<?php echo site_url('prestudent/behavior/'.$kdsp->id.'.'.$profile->id.'-2')?>"><i class="fa fa-eye"></i> Penindakan</a></td>
                              <td><a href="<?php echo site_url('prestudent/behavior/'.$kdsp->id.'.'.$profile->id.'-2')?>"><i class="fa fa-edit"></i> Ubah</a>&nbsp;&nbsp;
                              <a href="#" id="<?php echo site_url('prestudent/behavior/'.$kdsp->id.'.'.$profile->id.'-3')?>" onClick="deletePelanggaran(this);" data-toggle="modal" data-target="#deletePelanggaran"><i class="fa fa-trash-alt"></i> hapus</a></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                          </table>
                      </div><!-- /.table-responsive -->
                    </div>
                  </div>
                </div><!-- /.tab-pane -->

                <!-- ABSENSI TAB -->
                <div class="tab-pane" id="dokumen">
                  <div class="row">
                  <div class="col-sm-12">


                    <div class="row">
                      
                      <div class="col-xs-12"><br><h4 class="text-bold text-green"><span id="absensi-title-summary">Dokument</span></h4></div>
                      <div class="col-md-3">
                        <img class="img-responsive" src="">
                        

                      </div>

              <?if (isset($profile)) {?>

                <?php $i=1;foreach ($document as $rdoc){?>
                    <div class="col-md-4 box-shadow">
                      <h3 class="box-title"><?php echo $rdoc->name;?></h3>
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
                    </div>
                <?php } ?>
                
          <?php }?>
                     
                    </div>
                  </div>

                 
                  </div>
                </div><!-- /.tab-pane -->

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



      <!-- MODAL UNTUK EDIT DAN ADD ASAL SEKOLAH -->
    	<div class="modal modal-default fade" id="detailAsalSekolah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
	        <div class="modal-dialog">
	          <div class="modal-content">
	         	<?php
					if($asal_sekolah==false) {
						echo form_open_multipart('dashboard/add_asal_sekolah/'.$profile->id.'','class="form-horizontal" role="form"');
					} else {
						echo form_open_multipart('dashboard/edit_asal_sekolah/save','class="form-horizontal" role="form"');
						$hidden_data_user = array(
							'id' => $asal_sekolah->id,
							'profile_id' => $profile->id
						);
						echo form_hidden($hidden_data_user);
					}
				?> 

				
	      <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-gear"></i>&nbsp;Atur Sekolah Asal</h4><br>
                  <label class="text-orange">&nbsp;&nbsp;
                    <i class="fa fa-bell"></i> HARAP ISI SEMUA DATA YANG BERTANDA (*)</label>
	      </div>
	     <div class="modal-body">
				<div class="text-center">
  					<label class="text-bold text-red" style="font-size: 16px; margin-bottom: 3px;">Pilih Status Masuk</label> <br>
  					<input type="radio" name="entry_status" value="PSB" checked="checked" onclick="show_non_mutasi()"> Non-Mutasi &nbsp;&nbsp;&nbsp;
  		  		<input type="radio" name="entry_status" value="MUT" onclick="hide_non_mutasi()"> Mutasi
		  		</div>

	            	<div id="non_mutation" >
	            	<label class="text-bold" style="font-size: 16px; border-bottom: 1px #333333 solid; margin-bottom: 8px;">ASAL SEKOLAH</label> 
					<div class="form-group">
						<label class="col-sm-3 control-label">Nama Sekolah </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" placeholder="SD Contoh" name="school_name" <?php if($asal_sekolah){ echo 'value="'.$asal_sekolah->name.'" '; } ?>>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">No. Ijazah </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" placeholder="HJKH678758" name="cert_qualify_no" <?php if($asal_sekolah){ echo 'value="'.$asal_sekolah->cert_qualify_no.'" '; } ?>>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Tanggal Lulus </label>
						<div class="col-sm-9">
							<input type="text" class="form-control date-picker-control" name="graduation_date" id="datePicker3" <?php if($asal_sekolah){ 
                $sdob =  $asal_sekolah->graduation_date;
                $date = date('d-m-Y', strtotime($sdob));
                $dateofgrad= str_replace('-', '/', $date);
                echo 'value="'.$dateofgrad.'" '; } ?>>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Tahun Masuk</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" placeholder="3" name="year_start" maxlength="4" <?php if($asal_sekolah){ echo 'value="'.$asal_sekolah->year_start.'" '; } ?>>
						</div>
            <label class="col-sm-3 control-label">Tahun Keluar</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" placeholder="3" name="year_end"  maxlength="4" <?php if($asal_sekolah){ echo 'value="'.$asal_sekolah->year_end.'" '; } ?>>
            </div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Nilai UASBN</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" placeholder="90" name="uasbn" <?php if($asal_sekolah){ echo 'value="'.$asal_sekolah->uasbn.'" '; } ?>>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Nilai UAN</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" placeholder="90" name="uan" <?php if($asal_sekolah){ echo 'value="'.$asal_sekolah->uan.'" '; } ?>>
						</div>
					</div>
					<!-- <div class="form-group">
						<label class="col-sm-3 control-label">NIS</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" placeholder="JHF54363645" name="nis" <?php if($asal_sekolah){ echo 'value="'.$asal_sekolah->nis.'" '; } ?>>
						</div>
					</div> -->
					<div class="form-group">
						<label class="col-sm-3 control-label">NISN </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" placeholder="DRTR56757647" name="nisn" <?php if($asal_sekolah){ echo 'value="'.$asal_sekolah->nisn.'" '; } ?>>
						</div>
					</div>
					</div>
					<!-- </div> -->
					<!-- <div class="col-sm-12"> -->
					<div id="mutation" style="display: none;">
  					<label class="text-bold" style="font-size: 16px; border-bottom: 1px #333333 solid; margin-bottom: 8px;">MUTASI <span class="text-orange">(diisi khusus perpindahan)</span></label> 
  	                
  					<div class="form-group">
  						<label class="col-sm-3 control-label">Nama Sekolah</label>
  						<div class="col-sm-9">
  							<input type="text" class="form-control" placeholder="SD Contoh" name="m_school_name" <?php if($asal_sekolah){ echo 'value="'.$asal_sekolah->name.'" '; } ?>>
  						</div>
  					</div>
  					<div class="form-group">
  						<label class="col-sm-3 control-label">No. Ijazah</label>
  						<div class="col-sm-9">
  							<input type="text" class="form-control" placeholder="CHGD6547564" name="m_cert_qualify_no" <?php if($asal_sekolah){ echo 'value="'.$asal_sekolah->cert_qualify_no.'" '; } ?>>
  						</div>
  					</div>
  					<div class="form-group">
  						<label class="col-sm-3 control-label">Tanggal Lulus</label>
  						<div class="col-sm-9">
  							<input type="text" class="form-control" name="m_graduation_date" id="datePicker33" <?php if($asal_sekolah){  $sdob =  $asal_sekolah->graduation_date;
                $date = date('d-m-Y', strtotime($sdob));
                $dateofgrad= str_replace('-', '/', $date);
                echo 'value="'.$dateofgrad.'" ';} ?> >
  						</div>
  					</div>
  					<div class="form-group">
  						<label class="col-sm-3 control-label">Tahun Masuk</label>
  						<div class="col-sm-9">
  							<input type="text" class="form-control" placeholder="3" name="m_year_start" <?php if($asal_sekolah){ echo 'value="'.$asal_sekolah->year_start.'" '; } ?>>
  						</div>
  					</div>
  					<div class="form-group">
  						<label class="col-sm-3 control-label">Tahun Keluar</label>
  						<div class="col-sm-9">
  							<input type="text" class="form-control" placeholder="3" name="m_year_end" <?php if($asal_sekolah){ echo 'value="'.$asal_sekolah->year_end.'" '; } ?>>
  						</div>
  					</div>
  					<div class="form-group">
  						<label class="col-sm-3 control-label">Alasan Berpindah</label>
  						<div class="col-sm-5">
  							<textarea type="text" class="form-control"  name="m_entry_recent"> <?php if($asal_sekolah){ echo $asal_sekolah->entry_recent; } ?> </textarea>
  						</div>
  					</div>
  					<div class="form-group">
  						<label class="col-sm-3 control-label">Mutasi ke Kelas</label>
  						<div class="col-sm-9">
  							<input type="text" class="form-control" placeholder="7" name="m_entry_level" <?php if($asal_sekolah){ echo 'value="'.$asal_sekolah->entry_level.'" '; } ?>>
  						</div>
  					</div>
					</div>
					<!-- </div>  -->
	     </div>
        <label class="text-orange">&nbsp;&nbsp;
                    <i class="fa fa-bell"></i> PASTIKAN SEMUA DATA YANG BERTANDA (*) SUDAH DIISI</label>
          <div class="modal-footer">
            <button type="button" class="btn btn-success-o pull-left" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
          <?php echo form_close(); ?>  
        </div><!-- /.modal-content -->
      </div>
  	</div>
  	<!-- END MODAL ASAL SEKOLAH-->



  	 <!-- MODAL UNTUK EDIT DAN ADD ASAL SEKOLAH -->
    <div class="modal modal-default fade" id="detailFamily" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
	        <div class="modal-dialog">
	          <div class="modal-content">
	         	<?php
					// if($asal_sekolah==false) {
					echo form_open_multipart('dashboard/add_familys/'.$profile->id.'','class="form-horizontal" role="form"');
					// } else {
					// 	echo form_open_multipart('dashboard/edit_asal_sekolah/save','class="form-horizontal" role="form"');
					// 	$hidden_data_user = array(
					// 		'id' => $asal_sekolah->id,
					// 		'profile_id' => $profile->id
					// 	);
					// 	echo form_hidden($hidden_data_user);
					// }
				?> 

				
	      	<div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-gear"></i>&nbsp;Tanggungan Orang Tua</h4>
	      	</div>
	     	<div class="modal-body">
				<div class="text-center">
  					<label class="text-bold text-red" style="font-size: 16px; margin-bottom: 3px;">Penambahan Data</label> <br>
  				</div>
            	
            	<div class="form-group">
					<label class="col-sm-3 control-label">Nama</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" placeholder="Nama" name="name">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">NIK</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" placeholder="Nomor induk kependudukan" name="nik" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tempat Lahir</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" placeholder=" Jakarta / Medan / Bandung / ..." name="pob" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal Lahir</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="dob" id="datePicker2">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Jenis Hubungan</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" placeholder="Saudara Kandung, ..." name="sibling_remark" >
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Pekerjaan</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" placeholder="PNS/ GURU / Wiraswasta.." name="job" >
					</div>
				</div>
				
	     </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-success-o pull-left" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
          <?php echo form_close(); ?>  
        </div><!-- /.modal-content -->
      </div>
  	</div>
  	<!-- END MODAL ASAL SEKOLAH-->

    <!-- DELETE EKSKUL-->
    <div class="modal modal-warning fade" id="deleteEkskul" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-trash-alt"></i>&nbsp;&nbsp;Hapus</h4>
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


    <!-- DELETE EKSKUL-->
    <div class="modal modal-warning fade" id="deleteFam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-trash-alt"></i>&nbsp;&nbsp;Hapus</h4>
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

    <!-- DELETE PELANGGARAN-->
    <div class="modal modal-warning fade" id="deletePelanggaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-trash-alt"></i>&nbsp;&nbsp;Hapus</h4>
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

        <!-- end kondisi jika ada profile -->
    <?php } else{?>
       <div class="col-md-12">
          <div class="box box-default">
            <div class="box-body">
             
              <div class="text-center">
                Selamat datang pengguna, Anda memiliki Profil Calon Siswa<br>
                Silahkan melakukan pengisian data Profil Calon Siswa dengan menekan tombol ini.<br><br>
                <button class="btn btn-success-o" data-toggle="modal" data-backdrop="static" data-target="#detailProfilPrimer"> Isi Formulir</button>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
      </div>
    <?php }
     } ?>




      <!-- MODAL UNTUK EDIT DAN ADD PROFIL  -->
      <div class="modal modal-default fade" id="detailProfilPrimer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <?php
                if(!$profile) {
                  echo form_open_multipart('dashboard/add_profile/'.$user->id.'','class="form-horizontal" role="form" method="post" id="demoForm"');
                } else {
                  echo form_open_multipart('dashboard/edit_profile/save','class="form-horizontal" role="form"');
                  $hidden_data_user = array(
                    'id' => $profile->id,
                    'user_id' => $user->id
                  );
                  echo form_hidden($hidden_data_user);
                }
              ?> 

        
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-user"></i>&nbsp;Atur Profil Awal</h4><br>
                  <label class="text-orange">&nbsp;&nbsp;
                    <i class="fa fa-bell"></i> HARAP ISI SEMUA DATA YANG BERTANDA (*)</label>
              </div>
               <div class="modal-body">
                <div class="row">
                  <div class="col-sm-12 space-div-modal">
                    <div class="title-sub-modal" >
                      <label class="text-green">A. IDENTITAS SISWA</label>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Nama Lengkap</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="John Doe" name="full_name" <?php echo 'value="'.$user->fullname.'" ';  ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Nama Panggilan</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="John" name="nick_name" <?php if($profile){ echo 'value="'.$profile->nick_name.'" '; } ?>>
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="col-sm-3 control-label">No NIK</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" pplaceholder="XXXXXXXXXXXXXXX"  name="nik" <?php echo 'value="'.$user->nik.'" ';  ?>>
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="col-sm-3 control-label">No Akte <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="XXX XXXXXXXXX" name="no_akte" <?php if($profile){ echo 'value="'.$profile->no_akte.'" '; } ?>>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">No KK <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="XXXXXXXXXXXXXXX" name="no_kk" <?php if($profile){ echo 'value="'.$profile->no_kk.'" '; } ?>>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Jenis Kelamin <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                        <select class="form-control" name="gender">
                          <?php if($profile){ ?>
                            <option value="M" <?php if($profile->gender=='M') echo 'selected="Selected"'?>>Laki-laki</option>
                            <option value="F" <?php if($profile->gender=='F') echo 'selected="Selected"'?>>Perempuan</option>
                           
                          <?php } else { ?>
                             <option value="M">Laki-laki</option>
                            <option value="F">Perempuan</option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Tempat Lahir <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="DKI Jakarta" name="pob" <?php if($profile){ echo 'value="'.$profile->pob.'" '; } ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Tanggal Lahir <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Klik untuk atur tanggal"  name="dob" id="datePicker" 
                        <?php if($profile){ 
                          $sdob =  $profile->dob;
                          $date = date('d-m-Y', strtotime($sdob));
                          $dateofbirth = str_replace('-', '/', $date);
                          // $date = new DateTime($source);
                          // $dateofbirth= $date->format('d/m/Y');
                          echo 'value="'.$dateofbirth.'" '; } else {
                            $sdob =  $user->dob;
                            $date = date('d-m-Y', strtotime($sdob));
                            $dateofbirth = str_replace('-', '/', $date);
                            // $date = new DateTime($source);
                            // $dateofbirth= $date->format('d/m/Y');
                            echo 'value="'.$dateofbirth.'" '; 
                          }
                         
                          ?>

                        >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Agama <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                        <select name="religion" class="form-control">
                       <?php if($profile){ ?>
                            <option value="Islam" <?php if($profile->religion=='Islam') echo 'selected="Selected"'?>>Islam</option>
                            <option value="Katolik" <?php if($profile->religion=='Katolik') echo 'selected="Selected"'?>>Katolik</option>
                            <option value="Protestan" <?php if($profile->religion=='Protestan') echo 'selected="Selected"'?>>Protestan</option>
                             <option value="Hindu" <?php if($profile->religion=='Hindu') echo 'selected="Selected"'?>>Hindu</option>
                              <option value="Budha" <?php if($profile->religion=='Budha') echo 'selected="Selected"'?>>Budha</option>
                               <option value="Khonghucu" <?php if($profile->religion=='Khonghucu') echo 'selected="Selected"'?>>Khonghucu</option>
                             

                            

                           
                          <?php } else { ?>
                              <option value="Islam" >Islam</option>
                              <option value="Katolik">Katolik</option>
                              <option value="Protestan">Protestan</option>
                              <option value="Hindu">Hindu</option>
                              <option value="Budha" >Budha</option>
                              <option value="Khonghucu">Khonghucu</option>
                          <?php } ?>
                          </select>

                        <!-- <input type="text" class="form-control" placeholder="Islam" name="religion" <?php if($profile){ echo 'value="'.$profile->religion.'" '; } ?>> -->
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Kewarganegaraan <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                         <select class="form-control" name="nationality">
                          <option value="WNI"
                          <?php if($profile){ if($profile->nationality=='WNI') echo 'selected="selected"'; } ?>
                          >WNI</option>

                          <option value="WNA"
                          <?php if($profile){ if($profile->nationality=='WNA') echo 'selected="selected"'; } ?>
                          >WNA</option>
                        </select>
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="col-sm-3 control-label">Anak ke</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="1" name="anak_ke" <?php if($profile){ echo 'value="'.$profile->anak_ke.'" '; } ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Jumlah Saudara <br>Kandung</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="1" name="saudara_kandung_total" <?php if($profile){ echo 'value="'.$profile->saudara_kandung_total.'" '; } ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Jumlah Saudara Tiri</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="0" name="saudara_tiri_total" <?php if($profile){ echo 'value="'.$profile->saudara_tiri_total.'" '; } ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Status Anak Yatim/Piatu/Yatim Piatu</label>
                      <div class="col-sm-8">
                        <select class="form-control" name="yatim_piatu">
                          <option value="">-</option>

                          <option value="Yatim"
                          <?php if($profile){ if($profile->yatim_piatu=='Yatim') echo 'selected="selected"'; } ?>
                          >Yatim</option>

                          <option value="Piatu"
                          <?php if($profile){ if($profile->yatim_piatu=='Piatu') echo 'selected="selected"'; } ?>
                          >Piatu</option>

                          <option value="Yatim Piatu"
                          <?php if($profile){ if($profile->yatim_piatu=='Yatim Piatu') echo 'selected="selected"'; } ?>
                          >Yatim Piatu</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Bahasa di Rumah</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Indonesia, Daerah,..." name="bahasa_rumah" <?php if($profile){ echo 'value="'.$profile->bahasa_rumah.'" '; } ?>>
                      </div>
                    </div>
                  </div> 

                  <div class="col-sm-12 space-div-modal">
                    <div class="title-sub-modal">
                      <label class="text-green" >B. KETERANGAN TEMPAT TINGGAL</label>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Alamat Rumah <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                        <textarea type="text"class="form-control"  name="address" id="alamat"> <?php if($profile){ echo $profile->address; } ?> </textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">RT <label class="text-red">*</label></label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="001" name="rt" <?php if($profile){ echo 'value="'.$profile->rt.'" '; } ?>>
                      </div>

                      <label class="col-sm-1 control-label">RW <label class="text-red">*</label></label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="001" name="rw" <?php if($profile){ echo 'value="'.$profile->rw.'" '; } ?>>
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <label class="col-sm-3 control-label">Desa</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="nama Desa" name="desa" <?php if($profile){ echo 'value="'.$profile->desa.'" '; } ?>>
                      </div>
                    </div> -->
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Desa/Kelurahan <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="nama kelurahan" name="kelurahan" <?php if($profile){ echo 'value="'.$profile->kelurahan.'" '; } ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Kecamatan <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Nama Kecamatan" name="kecamatan" <?php if($profile){ echo 'value="'.$profile->kecamatan.'" '; } ?>>
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <label class="col-sm-3 control-label">Kabupaten </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Kabupaten A" name="kabupaten" <?php if($profile){ echo 'value="'.$profile->kabupaten.'" '; } ?>>
                      </div>
                    </div> -->
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Kabupaten/Kota <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Kota A" name="kota" <?php if($profile){ echo 'value="'.$profile->kota.'" '; } ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Provinsi <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Provinsi A" name="provinsi" <?php if($profile){ echo 'value="'.$profile->provinsi.'" '; } ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Kode Pos <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="12xxx" name="kode_pos" <?php if($profile){ echo 'value="'.$profile->kode_pos.'" '; } ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Titik Koordinat </label>
                      <div class="col-sm-4">
                         <div class="input-group">
                        <input type="text" class="form-control" placeholder="Latitude" name="latitude" <?php if($profile){ echo 'value="'.$profile->latitude.'" '; } ?>>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Longitude" name="longitude" <?php if($profile){ echo 'value="'.$profile->longitude.'" '; } ?>>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Status Tempat Tinggal</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Milik Sendiri, Dinas" name="status_tempat_tinggal" <?php if($profile){ echo 'value="'.$profile->status_tempat_tinggal.'" '; } ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Tinggal Bersama</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="orang tua" name="tinggal_bersama" <?php if($profile){ echo 'value="'.$profile->tinggal_bersama.'" '; } ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Kendaraan ke Sekolah <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Sepeda, Motor, Mobil" name="kendaraan" <?php if($profile){ echo 'value="'.$profile->kendaraan.'" '; } ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Jarak Dari Rumah(Km)<label class="text-red">*</label></label>
                      <div class="col-sm-3">
                        <div class="input-group">
                        <input type="number" step="any" class="form-control" placeholder="XX" name="jarak_rumah_sekolah" <?php if($profile){ echo 'value="'.$profile->jarak_rumah_sekolah.'" '; } ?>>
                        <span class="input-group-addon"> Km</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Waktu Tempuh ke sekolah(Menit)<label class="text-red">*</label></label>
                      <div class="col-sm-3">
                        <div class="input-group">
                        <input type="number" step="any" class="form-control" placeholder="XX" name="waktu_tempuh" <?php if($profile){ echo 'value="'.$profile->waktu_tempuh.'" '; } ?>>
                        <span class="input-group-addon"> Mnt</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Tel. Rumah <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="0218088XXX" name="phone_home" <?php if($profile){ echo 'value="'.$profile->phone_home.'" '; } ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">HP <label class="text-red">*</label></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="0218088XXX" name="phone_mobile" <?php if($profile){ echo 'value="'.$profile->phone_mobile.'" '; } ?>>
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <label class="col-sm-3 control-label">Email</label>
                      <div class="col-sm-8">
                        <input type="email" class="form-control" placeholder="name@domain.com" name="email" <?php if($profile){ echo 'value="'.$profile->email.'" '; } ?>>
                        <input type="checkbox" name="cb_same_email" id="cb_same_email"> <i>Sama dengan email user</i>
                      </div>
                    </div> -->
                  </div>

                  <div class="col-md-12 space-div-modal">
                    <div class="title-sub-modal">
                      <label class="text-green" >C. KETERANGAN KESEHATAN</label>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Golongan Darah</label>
                      <div class="col-sm-3">
                        <select id="subject_id" name="golongan_darah" class="form-control">
                          <option value="A"
                          <?php if($profile){ if($profile->golongan_darah=='A') echo 'selected="selected"'; } ?>
                          >A</option>

                          <option value="B"
                          <?php if($profile){ if($profile->golongan_darah=='B') echo 'selected="selected"'; } ?>
                          >B</option>

                          <option value="AB" 
                          <?php if($profile){ if($profile->golongan_darah=='AB') echo 'selected="selected"'; } ?>
                          >AB</option>
                          
                          <option value="O"
                          <?php if($profile){ if($profile->golongan_darah=='O') echo 'selected="selected"'; } ?>
                          >O</option>
                         
                        </select>
                        <!-- <input type="text" class="form-control" placeholder="A,B,AB,O" name="golongan_darah" <?php if($profile){ echo 'value="'.$profile->golongan_darah.'" '; } ?>> -->
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Tinggi <label class="text-red">*</label></label>
                      <div class="col-sm-3">
                         <div class="input-group">
                        <input type="number" step="any" class="form-control" placeholder="xx" name="height" <?php if($profile){ echo 'value="'.$profile->height.'" '; } ?>>
                        <span class="input-group-addon"> Cm</span>
                        </div>
                      </div>

                      <label class="col-sm-2 control-label">Berat Badan <label class="text-red">*</label></label>
                      <div class="col-sm-3">
                        <div class="input-group">
                          <input type="number" step="any" class="form-control" placeholder="xx" name="weight" <?php if($profile){ echo 'value="'.$profile->weight.'" '; } ?>>
                          <span class="input-group-addon"> Kg</span>
                        </div>
                      </div>
                    </div>
                    

                    <div class="form-group">
                      <label class="col-sm-10 control-label" style="text-align: left; important!">Penyakit / Alergi yang Diderita</label>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-5 col-sm-offset-2">
                        <div class="checkbox">
                          <input type="checkbox" name="sakit_lelah">Lelah</input>
                        </div>
                        <div class="checkbox">
                          <input type="checkbox" name="sakit_cacat">Cacat Anggota Badan</input>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="checkbox">
                          <input type="checkbox" name="sakit_jantung">Jantung</input>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="checkbox">
                          <input type="checkbox" name="sakit_kulit">Kulit</input>
                        </div>
                      </div>
                    </div>
                
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Lain-lain (Nyatakan)</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Lainnya" name="sakit_lain_lain" <?php if($profile){ echo 'value="'.$profile->sakit_lain_lain.'" '; } ?>>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Kelainan Jasmani</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="kelainan Jasmani" name="kelainan_jasmani" <?php if($profile){ echo 'value="'.$profile->kelainan_jasmani.'" '; } ?>>
                      </div>
                    </div>
                  </div>
                </div>
                <label class="text-orange">&nbsp;&nbsp;
                    <i class="fa fa-bell"></i> PASTIKAN SEMUA DATA YANG BERTANDA (*) SUDAH DIISI</label>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-success-o pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Simpan</button>
              </div>
              <?php echo form_close(); ?>  
            </div><!-- /.modal-content -->
          </div>
      </div>
      <!-- END MODAL-->


    <!-- MODAL Konfirmasi Pembayaran -->
    <div class="modal modal-default fade" id="dialogPembayaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
          <!-- echo form_open_multipart('dashboard/confirm_payment','class="form-horizontal" role="form" method="post"
            enctype="multipart/form-data"'); -->
           <form class="form-horizontal" action="<?php echo base_url('dashboard/confirm_payment')?>" method="post" enctype="multipart/form-data" role="form">
        


        
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-gear"></i>&nbsp;Konfirmasi Pembayaran</h4>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <label class="text-bold text-red" style="font-size: 16px; margin-bottom: 3px;">Silahkan Sertakan Tanda Bukti Pembayaran untuk konfirmasi</label> <br>
            <label style="font-size: 12px; margin-bottom: 3px;">Upload File berupa Photo / Gambar format .JPEG dan ukuran tidak lebih dari 500 Kb</label>
          </div>
            
            <div class="row">  
          <div class="form-group">
           
            <div class="col-sm-12">
              <label class=" control-label">Bukti Pembayaran</label>
              <img id="blah" src="#" alt="your image" class="img-responsive" style="display: none;" />
              <input type="file" class="form-control" name="image" id="imgInp">
              <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $user->id; ?>">
            </div>
          </div>
          </div>

          
       </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-success-o pull-left" data-dismiss="modal">Batal</button>
          <button type="reset" class="btn btn-warning" onCLick="clearScr();">Bersihkan</button>
          <button type="submit" class="btn btn-success">Simpan</button>
          <!-- <button type="button" data-dismiss="modal" class="btn btn-success" data-toggle="modal" data-backdrop="static" data-target="#dialogPassPembayaran">Simpan</button> -->
        </div>
         </form>
        </div><!-- /.modal-content -->
      </div>
    </div>
    <!-- END MODAL ASAL SEKOLAH-->


     <!-- MODAL Konfirmasi Pembayaran -->
    <div class="modal modal-default fade" id="dialogPassPembayaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
     


        
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-gear"></i>&nbsp;Konfirmasi Pembayaran</h4>
        </div>
        <div class="modal-body">
          
            
         <p>
        <h4 ><strong><?php echo 'Hai, '.$user->fullname;?></strong></h4>
         Pembayaran telah dikonfirmasi, harap menunggu proses aktifasi paling lambat 1x24 jam. jika akun anda belum aktif silahkan hubungi pihak sekolah<br>

         </p>

          
       </div>

        <div class="modal-footer">
       
          <button type="button" data-dismiss="modal" class="btn btn-success">Selesai</button>
        </div>
        </div><!-- /.modal-content -->
      </div>
    </div>
    <!-- END MODAL ASAL SEKOLAH-->



    </div><!-- /.row -->



</section><!-- /.content -->



<script src="<?php echo base_url(); ?>themesAdmin/plugins/datepicker/bootstrap-datepicker.js"></script>

 <!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?php echo base_url(); ?>themesAdmin/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url(); ?>themesAdmin/bootstrap/js/formValidation.min.js"> </script>
<script>
document.addEventListener('DOMContentLoaded', function(e) {
    FormValidation.formValidation(
        document.getElementById('demoForm'),
        {
            fields: {
                nick_name: {
                    validators: {
                        notEmpty: {
                            message: 'The username is required'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The username must be more than 6 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: 'The username can only consist of alphabetical, number and underscore'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        }
                    }
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap3: new FormValidation.plugins.Bootstrap3(),
                submitButton: new FormValidation.plugins.SubmitButton(),
                icon: new FormValidation.plugins.Icon({
                    valid: 'fa fa-check',
                    invalid: 'fa fa-times',
                    validating: 'fa fa-refresh'
                }),
            },
        }
    );
});
</script>