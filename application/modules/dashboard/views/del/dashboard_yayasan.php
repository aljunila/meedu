<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Sinau v.0.0.1</small>
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

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-white"><i class="fa fa-building text-green"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Jumlah Sekolah/</span>
                  <span class="info-box-text">Instansi</span>
                  <span class="info-box-number"><?php echo $total_sekolah; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->


            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-white"><i class="fa fa-exchange text-green"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Transaksi</span>
                  <!-- <span class="info-box-text">Pengelola</span> -->
                  <span class="info-box-number"><?php echo 'Rp. '.number_format($total_transaction, 0, ',', '.'); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

             <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-white"><i class="fa fa-child text-green"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Jumlah Murid</span>
                  <!-- <span class="info-box-text">Siswa</span> -->
                  <span class="info-box-number"><?php echo $total_murid; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->


            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-white"><i class="fa fa-users text-green"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Jumlah Staff</span>
                  <!-- <span class="info-box-text">/Staff</span> -->
                  <span class="info-box-number"><?php echo $total_staff; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <div class="col-sm-6">
               <div class="info-box">
                <div class="box-header"><span class="pull-right">
                <select name="sekolah_id" id="sekolah_id" class="form-control">
                  <option value="0">-- Semua --</option>
                  <?php foreach($sekolah as $p) { ?>
                     <?php echo '<option value = "'.$p->id.'">'.$p->name.' </option>'?>
                  <?php } ?>
                </select>
              </span><label>Berita Sekolah</label></div>
                <div class="box-body">
                  <div class="col-sm-12">

                    <div id="print-data-berita"></div>
                  </div>
                </div>
              </div>
            </div>

             <div class="col-sm-6">
               <div class="info-box">
                <div class="box-header"><span class="pull-right">
                <select name="sekolah_id_a" id="sekolah_id_a" class="form-control">
                  <option value="0">-- Semua --</option>
                  <?php foreach($sekolah as $p) { ?>
                     <?php echo '<option value = "'.$p->id.'">'.$p->name.' </option>'?>
                  <?php } ?>
                </select>
              </span><label>Pengumuman Sekolah</label></div>
                <div class="box-body">
                  <div class="col-sm-12">

                    <div id="print-data-pengumuman"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6" style="display: none;">
              <div class="info-box">
                <div class="box-body">
                  <div class="col-sm-6">
                    <div class="text-center"><h3>Grafik Staff</h3></div>
                    <canvas id="pieChart" style="height:250px"></canvas>
                  </div>
                  <div class="col-sm-6">
                    <div class="table-responsive">
                      <table class="table no-margin">
                        <thead>
                          <tr>
                            <th>Sekolah</th>
                            <th>Staff</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($sekolah_staff as $ss) { ?>
                          <tr>
                            <td><?php echo $ss->sekolah?></td>
                            <td><?php if($ss->jml==''){ echo '0';} else { echo $ss->jml;}?></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6" style="display: none;">
              <div class="info-box">
                <div class="box-body">
                  <div class="col-sm-6">
                    <div class="text-center"><h3>Grafik Murid</h3></div>
                    <canvas id="pieChart2" style="height:250px"></canvas>
                  </div>
                  <div class="col-sm-6">
                    <div class="table-responsive">
                      <table class="table no-margin">
                        <thead>
                          <tr>
                            <th>Sekolah</th>
                            <th>Murid</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($sekolah_murid as $sm) { ?>
                          <tr>
                            <td><?php echo $sm->sekolah?></td>
                            <td><?php if($sm->jml==''){ echo '0';} else { echo $sm->jml;}?></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-sm-6">
              <div class="info-box">
                <div class="box-body">
                  <div class="col-sm-6">
                    <div class="text-center"><h3>Grafik Pemasukan</h3></div>
                    <canvas id="pieChart3" style="height:250px"></canvas>
                  </div>
                  <div class="col-sm-12">
                    <div class="table-responsive">
                      <label>Data Grafik</label>
                      <table class="table no-margin">
                        <thead>
                          <tr>
                            <th>Sekolah</th>
                            <th>Transaksi</th>
                            <th>Jml Transaksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($sekolah_trans as $st) { ?>
                          <tr>
                            <td><?php echo $st->sc_name;?></td>
                            <td><?php if($st->total_trans==''){ echo 'Rp. '.number_format(0, 0, ',', '.');} else { echo 'Rp. '.number_format($st->total_trans, 0, ',', '.');}?></td>
                            <td><?php { echo number_format($st->count_trans, 0, ',', '.');}?>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </section><!-- /.content -->

            <!--MODAL ACTIVE STATUS-->
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

       <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript">
    $( document ).ready(function() {

      $('#sekolah_id').on('change', function () {

        sekolah_id = $('#sekolah_id').val();
       

        ajaxBerita(sekolah_id);
    });


    $('#sekolah_id_a').on('change', function () {


        sekolah_id_a = $('#sekolah_id_a').val();
       
        ajaxAnnoun(sekolah_id_a);
    });



      var aa = <?php 
      $datas =array(
        '#dd4b39',
        '#f39c12',
        '#00c0ef',
        '#0073b7',
        '#3c8dbc',
        '#00a65a',
        '#001f3f',
        '#39cccc',
        '#3d9970',
        '#01ff70',
        '#ff851b',
        '#f012be',
        '#605ca8',
        '#d81b60',
        '#111111',
        '#d33724',
        '#db8b0b',
        '#00a7d0',
        '#005384',
        '#357ca5',
        '#008d4c',
        '#001a35',
        '#30bbbb',
        '#368763',
        '#00e765',
        '#ff7701',
        '#db0ead',
        '#555299',
        '#ca195a'
        );
      echo json_encode($datas);

      ?>;



        moment.locale('id');
        $( ".tgl_daftar" ).each(function() {
          var el = $( this );
          var timeValue = el.text();
          var strTimeAgo = moment(timeValue).format('ll');
          el.text(strTimeAgo);
        });



        ajaxBerita();
        ajaxAnnoun();
    });
        $(function(){
            //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChartCanvas2 = $("#pieChart2").get(0).getContext("2d");
    var pieChartCanvas3 = $("#pieChart3").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var pieChart2 = new Chart(pieChartCanvas2);
    var pieChart3 = new Chart(pieChartCanvas3);

   
    // var PieData = [
    //   {
    //     value: <?php echo $total_sekolah;?>,
    //     color: "#f56954",
    //     highlight: "#f56954",
    //     label: "Anak"
    //   },
    //   {
    //     value:  <?php echo $total_admin;?>,
    //     color: "#f39c12",
    //     highlight: "#f39c12",
    //     label: "Dewasa - Pria"
    //   },
    //   {
    //     value:  <?php echo $total_murid;?>,
    //     color: "#00c0ef",
    //     highlight: "#00c0ef",
    //     label: "Dewasa - Wanita"
    //   },
    //   {
    //     value:  <?php echo $total_staff;?>,
        
    //     color: "#00a65a",
       
    //      highlight: "#00a65a",
    //     label: "Private"
    //   }
    // ];
    var murid = <?php 
    $as;
    $i=0;
    foreach ($sekolah_murid as $sm) {
      $as[$i]= array('value'=>$sm->jml,'color'=>$datas[$i],'highlight'=>$datas[$i],'label'=>$sm->sekolah);
      $i++;
    } 
    echo json_encode($as);

    ?>;


    var staff = <?php 
    $ss;
    $i=0;
    foreach ($sekolah_staff as $st) {
      $as[$i]= array('value'=>$st->jml,'color'=>$datas[$i],'highlight'=>$datas[$i],'label'=>$st->sekolah);
      $i++;
    } 
    echo json_encode($as);

    ?>;
    console.log(staff);


    var trans_s = <?php 
    $as;
    $i=0;
    foreach ($sekolah_trans as $st) {
      $as[$i]= array('value'=>$st->total_trans,'color'=>$datas[$i],'highlight'=>$datas[$i],'label'=>$st->sc_name);
      $i++;
    } 
    echo json_encode($as);

    ?>;
    


    var PieData = [
      {
        value: <?php echo $total_sekolah;?>,
        color: "#f56954",
        highlight: "#f56954",
        label: "Anak"
      },
      {
        value:  <?php echo $total_admin;?>,
        color: "#f39c12",
        highlight: "#f39c12",
        label: "Dewasa - Pria"
      },
      {
        value:  <?php echo $total_murid;?>,
        color: "#00c0ef",
        highlight: "#00c0ef",
        label: "Dewasa - Wanita"
      },
      {
        value:  <?php echo $total_staff;?>,
        
        color: "#00a65a",
       
         highlight: "#00a65a",
        label: "Private"
      }
    ];
    console.log(PieData);
    // SETTING CHART
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(staff, pieOptions);
    pieChart2.Doughnut(murid, pieOptions);
    pieChart3.Doughnut(trans_s, pieOptions);
        });

    function ajaxBerita(sekolah_id){
      $.ajax({
      type: "POST",
      url: "<?php echo site_url('dashboard/populate_berita_yayasan')?>",
      data: { 
        sekolah_id : sekolah_id,
      },
      success: function(html)
      {
        $("#print-data-berita").html(html);
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
   function ajaxAnnoun(sekolah_id_a){
      $.ajax({
      type: "POST",
      url: "<?php echo site_url('dashboard/populate_announ_yayasan')?>",
      data: { 
        sekolah_id : sekolah_id_a,
      },
      success: function(html)
      {
        // alert(html); 
        $("#print-data-pengumuman").html(html);
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
