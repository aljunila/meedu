<style type="text/css">
  .center-cropped {
  object-fit: cover; /* Do not scale the image */
  object-position: center; /* Center the image within the element */
  height: 65px;
  width: 100%;
}

#panel-berita{
    padding-bottom: 8px; padding-top:8px;border-bottom: 1px solid #dddddd;
    color: #666666;
  }

.img-diagonal{
    -webkit-clip-path: polygon(0 0, 0 80%, 100% 100%, 100% 0);
}

.category-news{
    position: absolute;
    margin-top: -35px;
}

.nav-tabs-custom > .nav-tabs > li.active {
    border-color: #179b8d !important;
    border-bottom-color: transparent !important;
}
.nav-tabs {
   /*border-bottom: 1px solid #d45500 !important;*/
}

</style>
<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>STEPA</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        <section class="content">

          <div class="row">
          </div>

          <div class="row">
              <div class="col-sm-12">
                 <div class="info-box">
                  <div class="box-body">
                    <h4>Overview </h4>
                    <div class="col-sm-12">
                         <div class="clearfix visible-sm-block"></div>

                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-yellow"><i class="far fa-building"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Sekolah<br>Stepa PLUS</span>
                                <span class="info-box-number" id ="count-sekolah">0</span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                          </div><!-- /.col -->
                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box ">
                              <span class="info-box-icon bg-yellow"><i class="fa fa-user-check"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Aktivitas<br>Ananda</span>
                                <span class="info-box-number" id="count-aktivitas">0</span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                          </div><!-- /.col -->

                          <div class="clearfix visible-sm-block"></div>

                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-yellow"><i class="fa fa-user-friends"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Proyek<br>Keluarga</span>
                                <span class="info-box-number" id ="count-proyek">0</span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                          </div><!-- /.col -->
                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-yellow"><i class="fa fa-chalkboard-teacher"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Edukasi<br>Ayah &amp; Bunda</span>
                                <span class="info-box-number" id="count-edukasi">0</span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                          </div><!-- /.col -->

                    </div>
                  </div>
                </div>
              </div> 
              <div class="col-sm-12">
                 <div class="info-box">
                  <div class="box-body">
                    <h4>List Sekolah STEPA-PLUS</h4>
                    <div class="col-sm-12">
                        <div id="print-data"></div>
                    </div>
                  </div>
                </div>
              </div> 
          </div>
        </section><!-- /.content -->

   

          <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <script type="text/javascript">
    $( document ).ready(function() {
       var sekolah_id=0;
       populateSekolah();
       populateCountSummary();
      
    });
      
    function populateSekolah(){
      var id = '';
      $.ajax({
      type: "POST",
      url: "<?php echo site_url('dashboard/pedagogy_populate_sekolah')?>",
      data: { 
        id : id,
      },
      success: function(response){
        var getData = JSON.parse(response);
        $("#print-data").html(getData.table_data);
      }
      });
    }

    function populateCountSummary(){
      var id = '';
      $.ajax({
      type: "POST",
      url: "<?php echo site_url('dashboard/pedagogy_populate_count_summary')?>",
      data: { 
        id : id,
      },
      success: function(response){
        // console.log(response);
        // alert(response);
        var getData = JSON.parse(response);
        $("#count-sekolah").html(getData.sekolah);
        $("#count-proyek").html(getData.proyek);
        $("#count-aktivitas").html(getData.aktivitas);
        $("#count-edukasi").html(getData.edukasi);
      }
      });
    }

    </script>
