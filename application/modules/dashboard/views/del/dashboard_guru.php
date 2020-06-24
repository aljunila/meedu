<style type="text/css">
  .subject-name{
    color: #ffffff;
    font-style: bold;
    font-size: 24px;
    padding:16px 0 16px 0;
  }

  #panel-berita{
    padding-bottom: 16px; padding-top:8px;border-bottom: 1px solid #dddddd;
    color: #666666;
  }
  #panel-image{
    padding-top: 10px;padding-bottom: 10px;
  }

  #panel-title-berita{
    font-size: 19px; font-weight: 800; line-height: 21px; 
  }


  #block-announ{
    border:1px solid #ddd;padding: 10px;
  }

  #block-announ:hover{
    border:1px solid #00a65a; padding: 10px;
  }

</style>
        <section class="content-header">
          <h1>
            <?php echo $title;?>
            <small>Sinau v.0.0.1</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $title?></li>
          </ol>
        </section>

        <section class="content">

          <div class="row">
            <div class="clearfix visible-sm-block"></div>
            
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-white">
                  

                  <?php if($enduser->photo_url==''){?>
                    <img src="<?php echo base_url(); ?>themesAdmin/dist/img/user3-128x128.jpg" class="user-image" alt="User Image"  style="width: 64px; height: 64px;">
                   <?php }else{ ?>
                    <img src="<?php echo base_url(); ?>data/profile/<?php echo $enduser->photo_url;?>" class="user-image" alt="User Image"  style="width: 64px; height: 64px;">
                   <?php } ?>
                  

                </span>
                <div class="info-box-content">
                  <span class="info-box-text text-green"><h4><?php echo $this->session->userdata('name'); ?></h4></span>
                  <span class="info-box-text"><?php echo $this->session->userdata('institution_name');?></span> 
                </div>
              </div> 
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-white"><i class="fa fa-child text-green"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Kelas</span>
                  <span class="info-box-number"><?php echo $count_course;?></span> 
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-white"><i class="fa fa-book text-green"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Mata Pelajaran</span>
                  <span class="info-box-number"><?php echo $count_subject;?></span> 
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
         <!--    <div class="col-sm-6">
               <div class="info-box">
                <div class="box-header">Berita</div>
                <div class="box-body">
                  <div class="col-sm-12">
                      <div id="print-data-berita"></div>
                  </div>
                </div>
                <div class="overlay text-center" id="loading-berita">
                  <i class="fa fa-refresh fa-spin"></i> Loading ....
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="info-box">
                <div class="box-header">Pengumuman</div>
                <div class="box-body">
                  <div class="col-sm-12">
                      <div id="print-data-pengumuman"></div>
                  </div>
                </div>
                <div class="overlay text-center" id="loading-pengumuman">
                  <i class="fa fa-refresh fa-spin"></i> Loading ....
                </div>
              </div>
            </div> -->

            <div class="col-xs-12">
              <div class="info-box">
                <div class="box-header"><span class="text-green" style="font-size: 16px;"><i class="fa fa-news"></i> Pengumuman</span></div>
                <div class="box-body">
                  <div class="col-sm-12">
                      <div class="" id="print-data-pengumuman">
                   
                         
                      </div>
                     
                  </div>
                </div>
                <div class="overlay text-center" id="loading-pengumuman">
                  <i class="fa fa-refresh fa-spin"></i> Loading ....
                </div>
              </div>
            </div>

             <div class="col-sm-8">
               <div class="info-box">
                <div class="box-header"><span class="text-green" style="border-bottom: 1px solid #ddd; font-size: 16px; padding-right: 10px"><i class="fa fa-news"></i> Berita</span></div>
                <div class="box-body">
                  <div class="col-sm-12">
                      <div id="print-data-berita"></div>
                      
                     </div>
                  </div>
                </div>
                <div class="overlay text-center" id="loading-berita">
                  <i class="fa fa-refresh fa-spin"></i> Loading ....
                </div>
              </div>
            </div>
             
          </div>
          
        </section><!-- /.content -->

         <div class="modal modal-default fade" id="ch_news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
          
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-gear"></i>&nbsp;Tinjau Detail</h4>
          </div>
          <div class="modal-body">
            <div class="text-justify">
              <img class="img-responsive" id="print-news-img">
              <label class="text-bold text-red" style="font-size: 16px; margin-bottom: 3px;" id="print-news-title"></label> 
              <div id="print-for-news"></div>
              <div id="print-news-content"></div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Selesai</button>
          </div> 
        </div><!-- /.modal-content -->
      </div>
    </div>
    <!-- END MODAL ACTIVE STATUS-->

          <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <script type="text/javascript">
    var aco=1;
    $( document ).ready(function() {
        var sekolah_id=0;
       var cases =2;
       var last_id =17;
       ajaxBerita(cases, last_id);
       ajaxPengumuman(sekolah_id);
       callIntervall();
     });


    function callIntervall(){
       setInterval(function () {
          moveRight();
      }, 5000);
    }

    function moveLeft() {
        $('#slider ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };



    function ajaxBerita(cases,last_id){
      $("#loading-berita").show();
      // alert(cases+'-'+last_id);
      $.ajax({
      type: "POST",
      url: "<?php echo site_url('dashboard/populate_berita_sekolah_guru_v2')?>",
      data: { 
        cases : cases,
        last_id : last_id
      },
      success: function(html)
      {
        // alert(html);
        if(html!='false'){
          $("#print-data-berita").html(html);
        }
        $("#loading-berita").hide();
      }
      });
    }



    function ajaxPengumuman(sekolah_id){
      $("#loading-pengumuman").show();
      $.ajax({
      type: "POST",
      url: "<?php echo site_url('dashboard/populate_pengumuman_guru')?>",
      data: { 
        sekolah_id : sekolah_id,
      },
      success: function(html)
      {
        $("#print-data-pengumuman").html(html);
        $("#loading-pengumuman").hide();
      }
      });
    }


    function ajaxSendMsg(id){
      // alert(id);
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('news_config/get_news')?>",
        data: { 
          id:id,
             },
        success: function(html){
          var jsontext   = html;
          var pic = document.getElementById('print-news-img');
          var getData = JSON.parse(jsontext);
          var imgUrl = '<?php echo base_url(); ?>'+'data/news/'+getData.img;
          $("#print-news-title").html(getData.title);
          $("#print-news-content").html(getData.content);
          $("#print-for-news").hide();
          if(getData.img==''){
            pic.style.display="none";
          }else{
            pic.style.display="block";
          }
          pic.src =imgUrl;
          $('#ch_news').modal('show');
        }
      }); 
    }

    function ajaxViewAnnoun(id){
      // alert(id);
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('announ_config/get_announ')?>",
        data: { 
          id:id,
             },
        success: function(html){
          var jsontext   = html;
          var pic = document.getElementById('print-news-img');
          var getData = JSON.parse(jsontext);
          var imgUrl = '<?php echo base_url(); ?>'+'data/annon/'+getData.img;
          $("#print-news-title").html(getData.title);
          $("#print-news-content").html(getData.content);
          var a_for='';
          if(getData.type_division=='ALL'){
            a_for='Semua';
          }else if(getData.type_division=='STF'){
            a_for='Staff & Pengajar';
          }else if(getData.type_division=='STD'){
            a_for='Murid';
          }else if(getData.type_division=='PST'){
            a_for='Calon Murid';
          }

           $("#print-for-news").html('<span class="text-info">Ditujukan kepada:<label > '+a_for+'</label></span>');
          $("#print-for-news").show();
          if(getData.img==''){
            pic.style.display="none";
          }else{
            pic.style.display="block";
          }
          pic.src =imgUrl;
          $('#ch_news').modal('show');
        }
      }); 
    }




    </script>