 <link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/morris/morris.css">
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
            <small>Event</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-white"><i class="fa fa-download text-orange"></i></span>
                <div class="info-box-content center">
                 
                <div class="col-md-12">
                   <h4><strong>PEMASUKAN</strong></h4>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="filter" id="filter" class="form-control">
                      <option value="d">Hari Ini</option>
                      <option value="m">Bulan Ini</option>
                      <option value="y">Tahun Ini</option>
                      <option value="">Semua</option>
                    </select> 
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div id="table-cost"></div>
                  </div>
                </div>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->


            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-white"><i class="fa fa-upload text-orange"></i></span>
                <div class="info-box-content">
                  <div class="col-md-12">
                   <h4><strong>PENGELUARAN</strong></h4>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="filter2" id="filter2" class="form-control">
                      <option value="d">Hari Ini</option>
                      <option value="m">Bulan Ini</option>
                      <option value="y">Tahun Ini</option>
                      <option value="">Semua</option>
                    </select> 
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div id="table-pay"></div>
                  </div>
                </div>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-white"><i class="fa fa-users text-orange"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"><h4><strong>SPONSOR</strong></h4></span>
                  <span class="info-box-text"><?php echo $sponsor; ?></span>
                  <span class="info-box-number"></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-white"><i class="fa fa-user text-orange"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"><h4><strong>AGEN</strong></h4></span>
                  <span class="info-box-text"><?php echo $agen; ?></span>
                  <span class="info-box-number"></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-xs-12">
              <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Chart Jumlah Peserta</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body chart-responsive">
                <div class="chart" id="bar-chart" style="height: 300px;"></div>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
           <div class="col-xs-6">
              <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">JUMLAH PESERTA FINGER</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>

              <div id="table-data"></div>
              <!-- /.box-body -->
            </div>
          </div>

            </div>

            <div class="row">
             

              <div class="col-sm-6" style="display: none;">
                 <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li <?php if(!isset($tab) || $tab =='berita'){ echo 'class="active"';}?>>
                        <a href="#berita" data-toggle="tab">Berita
                        
                          <!-- <span data-toggle="tooltip" title="" class="badge bg-orange" data-original-title="3 berita baru">3</span> -->
                          <!-- <span data-toggle="tooltip" title="" class="badge bg-orange" data-original-title="3 berita baru">3</span> -->
                        </a> 
                      </li>
                      <li <?php if(isset($tab)) if($tab =='pengumuman'){ echo 'class="active"';}?>>
                        <a href="#pengumuman" data-toggle="tab">Pengumuman</a>
                      </li>
                    </ul>
                    
                    <div class="tab-content">
                      <div class=" <?php if(!isset($tab) || $tab =='berita'){ echo 'active';}?> tab-pane" id="berita">
                        <div class="post">
                          <div class="row">

                            <div class="col-sm-12">
                              <div class="box-body">
                                <div id="print-data-berita"></div>
                              </div>
                            </div>

                          </div>
                        </div><!-- /.post -->
                      </div><!-- /.tab-pane -->


                      <!-- MAPEL TAB-->
                      <div class="<?php  if(isset($tab)) if($tab =='pengumuman'){ echo 'active';}?> tab-pane" id="pengumuman">
                        <div class="row">
                          <div class="col-sm-12">
                              <div id="print-data-pengumuman"></div>
                          </div>
                        </div>
                      </div><!-- /.tab-pane -->


                    </div><!-- /.tab-content -->
                  </div><!-- /.nav-tabs-custom -->
              </div>
          </div><!-- /.row -->
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
              <div>
              
              <img class="img-responsive img-diagonal" id="print-news-img">
              <span class="category-news">Category</span>
              
              </div>
              <label class="text-bold text-red" style="font-size: 16px; margin-bottom: 3px;" id="print-news-title"></label> 
              <div id="print-for-news"></div>
              <div id="print-news-content"></div>
              <a id="print-news-file" target="_blank" class="btn btn-xs btn-success-o">
                                            <i class="fa fa-download" title="View"></i> Unduh Lampiran</a>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Selesai</button>
          </div> 
        </div><!-- /.modal-content -->
      </div>
    </div>



    <div class="modal modal-default fade" id="ch_announ" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-bullhorn"></i>&nbsp;Pengumuman</h4>
          </div>
          <div class="modal-body">
            <div class="text-justify">
              <div>
              <img class="img-responsive" id="print-announ-img">
              </div>
              <label class="text-bold text-red" style="font-size: 16px; margin-bottom: 3px;" id="print-announ-title"></label> 
              <div id="print-for-announ"></div>
              <div id="print-announ-content"></div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Selesai</button>
          </div> 
        </div><!-- /.modal-content -->
      </div>
    </div>
    <!-- END MODAL ACTIVE STATUS-->
<script src="<?php echo base_url(); ?>themesAdmin/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
     <script src="<?php echo base_url(); ?>themesAdmin/plugins/morris/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/fastclick/fastclick.js"></script>
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/flot/jquery.flot.js"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/flot/jquery.flot.resize.js"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/flot/jquery.flot.pie.js"></script>
    <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/flot/jquery.flot.categories.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/chartjs/Chart.js"></script>

<script>
  $(document).ready(function(){
    populate_data();
    populate_cost();
    populate_pay();
  });

   $('#filter').on('change', function () {
        populate_cost();
    });

   $('#filter2').on('change', function () {
        populate_pay();
    });

  $(function () {
    "use strict";

    //BAR CHART
    var bar = new Morris.Bar({  
      element: 'bar-chart',
      resize: true,
      data: [
        {y: 'Interview', a: <?php echo $anggota->itv; ?>},
        {y: 'Medical', a: <?php echo $anggota->mdc; ?>},
        {y: 'Pasporan', a: <?php echo $anggota->psp; ?>},
        {y: 'P. Sidik Jari', a: <?php echo $anggota->psj; ?>},
        {y: 'Sidik Jari', a: <?php echo $anggota->sj; ?>},
        {y: 'Visa', a: <?php echo $anggota->tvs; ?>},
        {y: 'Ready', a: <?php echo $anggota->rtb; ?>},
        {y: 'Data Terbang', a: <?php echo $anggota->ptb; ?>}
      ],
      barColors: ['#00a65a', '#f56954'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Jumlah'],
      hideHover: 'auto'
    });
  });

  function populate_data(){
    loadingOverlay(true);
    var id = '';
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('dashboard/populate_data')?>",
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

  function populate_cost(){
    loadingOverlay(true);
    var id = '';
    var filter = $('#filter').val();
    //alert(filter);
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('dashboard/populate_cost')?>",
      data: { 
        id :id,
        filter : filter,
           },
      success: function(html){
        loadingOverlay(false);
        var jsontext  = html;
        var getData = JSON.parse(jsontext);
        $("#table-cost").html(getData.table_data);
      }
    }); 
  }

   function populate_pay(){
    loadingOverlay(true);
    var id = '';
    var filter = $('#filter2').val();
    //alert(filter);
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('dashboard/populate_pay')?>",
      data: { 
        id :id,
        filter : filter,
           },
      success: function(html){
        loadingOverlay(false);
        var jsontext  = html;
        var getData = JSON.parse(jsontext);
        $("#table-pay").html(getData.table_data);
      }
    }); 
  }
</script>
