
<style type="text/css">
  .subject-name{
    color: #ffffff;
    font-style: bold;
    font-size: 24px;
    padding:18px 0 18px 0;
  }
  .box-shadow{
    padding: 16px;
    border:1px solid #dddddd;
    border-radius: 4px;
    background-color: #fff;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }
  
  a.doc-white{ color: #fff; }
  .text-white{ color: #fff; }

  a.font-adjust{
    font-size: 16px;
  }

</style>
        
        <section class="content-header">
          <h1>
            <?php echo $title;?>
            <small>Sinau v.0.0.1</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('dashboard/dashboard_crud/0-0'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('title_dashboard');?></a></li>
            <li class="active"><?php echo $title;?></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
           <div class="col-xs-12 text-right" style="font-size: 20px;">&nbsp;&nbsp;<?php echo $matapelajaran->kelas;?> </div>
            <div class="col-xs-12" style="font-size: 22px;margin-bottom: 10px"><i class="fa fa-book"></i>
            &nbsp;<?php echo $this->lang->line('title_subjects');?>: <strong><?php echo $matapelajaran->name;?></strong>
            <div class="pull-right"><a class="btn btn-primary" href="<?php echo site_url(); ?>dashboard/show_course_student/<?php echo $matapelajaran->kelas_id;?>"><i class="fa fa-eye"></i>&nbsp;<?php echo $this->lang->line('view_student');?></a></div>
            </div> 
            <div class="col-xs-12">
            <div class="box-shadow">
            <!-- <?php $i=1;foreach ($daftar as $row){?>
              
              <?php 
              $level = 0;
              try {
                  $a= explode(".", $row->chapter_code);
                  $level  = sizeof($a);
              } catch (Exception $e) {
                  $level = 0;
              }

              $marg = $level * 20;
              // $tz = 24-($level*2);
              $tz = 20;
              echo "<div style='padding-left:".$marg."px; 
                    padding-top:6px;
                    padding-bottom:6px;
                    font-size:".$tz."px; 
                    border-bottom :1px #dddddd solid;' >"
              ?>
                <span ><?php echo $row->chapter_code;?></span>
                &nbsp;&nbsp;<?php echo $row->title;?>
                 <div class="pull-right">

                    <?php if ($row->countMaterial!=null){?>
                      <a class="font-adjust" href="<?php echo site_url(); ?>material/material_view/<?php echo $row->material_id;?>" ><span class="label label-success"><?php echo $row->countMaterial;?></span>&nbsp;&nbsp;Materi 
                      
                      </a>
                    <?php }else{ ?>
                      <a class="font-adjust" href="<?php echo site_url(); ?>material/material_crud/0-1"> &nbsp;<i class="fa fa-plus"></i>&nbsp;Tambah Materi</a>
                    <?php } ?>

                    <span class="text-gray">&nbsp;|</span>
                    <?php if ($row->countTest!=null){?>
                      <a class="font-adjust"><span class="label label-primary"><?php echo $row->countTest;?></span>&nbsp;&nbsp;Test
                      </a>
                    <?php } else{ ?>
                      <a class="font-adjust" href="<?php echo site_url(); ?>test/test_crud/0-1">&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;Buat Tes
                      </a>
                    <?php } ?>
                 </div>

              </div>
            <?php } ?> -->

             <?php 
                  
                  if(isset($silabus)){
                      decompose($silabus);
                   }
                  function decompose($silabus){
                    if(isset($silabus)){
                      if(!$silabus){
                        echo "<div class='text-center' style='padding:8px;'><h4><span class='text-blue'><i class='fa fa-info-circle fa-2x'></i><br>Tidak ada kerangka silabus.<br>mohon hubungi admin sekolah untuk pembuatan kerangka awal matapelajaran</span><h4></div>";
                      }else{
                        foreach ($silabus as $sil) {
                        echo $sil->h_object."";
                      }
                    }
                    } 
                  }
                ?>
            </div>

            <div class="modal modal-primary fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('alert_add_silabus_title');?></h4>
                  </div>
                  <div class="modal-body text-center">
                    <h4><?php echo $this->lang->line('alert_add_silabus_content');?><br>
                        <strong><span id="textTitle"></span></strong> ?
                    </h4>
                    <div>
                      <a id="addMateri" href="#">
                        <button type="button" class="btn btn-default"><strong>Materi</strong></button>
                      </a>
                      &nbsp;
                      <a id="addTest" href="#">
                      <button type="button" class="btn btn-default"><strong>Test</strong></button>
                      </a>
                      &nbsp;
                      <a id="addSub" href="#">
                      <button type="button" class="btn btn-warning"><strong>Sub Indikator</strong></button>
                      </a>
                        
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                    <!-- <a id="delData" href="#"><button type="button" class="btn btn-default">Hapus</button></a> -->
                  </div>
                </div>
              </div>
            </div>

          </div><!-- /.row -->



          
        </section><!-- /.content -->

          <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>


    <script>
    function sending(a){
      document.getElementById("addMateri").href='<?php echo site_url(); ?>material/material_crud/0-1';
      document.getElementById("addTest").href='<?php echo site_url(); ?>test/test_crud/0-1';

      b = a.id;
      obj = b.split(',');

      $id_subject = obj[0].split(':');
      $group_priviledge = obj[1].split(':');

      if($group_priviledge[1]=='1'){
        document.getElementById("addSub").style='display:none !important;';
      }else if ($group_priviledge[1]=='2'){
        document.getElementById("addSub").href='<?php echo site_url();?>chapter/chapter_crud/0-1';
        document.getElementById("addSub").style='display:inline; opacity: 1;';
      }

      


    }
    </script>