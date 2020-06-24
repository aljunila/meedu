<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>psb-Beta V.0.2</small>
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
            <div class="col-xs-12">
              <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Summary Drivers</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <?php if(!empty($status)){ ?>
          <div class="<?php echo $alert; ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $status; ?>
          </div>          
          <?php } ?>
                 
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No&nbsp;</th>
                  <th>Name</th>
                  <th>Total Trips</th>
                  <th>Earning</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;foreach ($driver as $row){?>
                <tr>
                  <td align="center"><?php echo $i; $i++;?></td>
                  <td><a href="<?php echo site_url('dashboard/driver_detail/'.$row->driverId.''); ?>" rel="tooltip-top" title="View Detail"><?php echo $row->name;?></a></td>
                  
                  <td><?php echo $row->totalTrip;?></td>
                  <td><?php echo "Rp. ". $row->earning;?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
          </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
        </div><!-- /.box-footer -->
      </div><!-- /.box -->
            </div><!-- /.col -->

             <div class="col-xs-12">
              <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Trips</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <?php if(!empty($status)){ ?>
          <div class="<?php echo $alert; ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $status; ?>
          </div>          
          <?php } ?>
                 
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No&nbsp;</th>
                  <th>Date</th>
                  <th>Driver</th>
                  <th>Duration</th>
                  <th>Earning</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;foreach ($history as $hr){?>
                <tr>
                  <td align="center"><?php echo $i; $i++;?></td>
                  <td><a href="<?php echo site_url('dashboard/driver_detail/'.$hr->orderId.''); ?>" rel="tooltip-top" title="View Detail"><?php echo $hr->dateOrder;?></a></td>
                  
                  <td><?php echo $hr->name;?></td>
                  <td><?php echo $hr->duration;?></td>
                  <td><?php echo $hr->earning;?></td>
                  <td><?php echo $hr->statusOrder;?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
          </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
        </div><!-- /.box-footer -->
      </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          
        </section><!-- /.content -->

          <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>themesAdmin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>