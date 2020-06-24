		<div class="row">
			<div class="col-lg-12">
				<h1><?php echo $title; ?></h1>
				<ol class="breadcrumb">
					<li><i class="fa fa-calendar"></i>&nbsp;&nbsp;Dashboard</li>
					<li class="active"><i class="fa fa-list"></i>&nbsp;&nbsp;List Kunjungan</li>
				</ol>
			</div>
		</div>
		
		<div class="row">
          <div class="col-lg-12">
			<?php if(!empty($status)){ ?>
					<div class="<?php echo $alert; ?> alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $status; ?>
					</div>					
			<?php } ?>
            <div class="panel panel-primary">
              <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapsedashboardList">
						<h4 class="panel-title"><a class="accordion-toggle"> Laporan hasil kunjungan</a></h4>
			  </div>
			  <div id="collapsedashboardList" class="panel-collapse collapse in">
				  <div class="panel-body">
				  
						<table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Perusahaan</th>
									<th>Alamat</th>
									<th>Tgl Jadwal</th>
									<th>Tgl Kunjungan</th>
									<th>Teknisi</th>
								</tr>
							</thead>
							
							<tbody>
								<?php $i=1;foreach ($daftar as $row){?>
								<tr>
									<td align="center"><?php echo $i; $i++;?></td>
									<td><a href="<?php echo site_url('dashboard/dashboard_crud/'.$row->id.'-1'); ?>"><?php echo $row->n_perusahaan;?></a></td>
									<td><?php echo $row->alamat;?></td>
									<td align="center"><?php echo date('d/m/Y',strtotime($row->tgl_jadwal));?></td>
									<td align="center"><?php echo date('d/m/Y',strtotime($row->tgl_kunjungan));?></td>
									
									 <td><?php echo $row->change_by;?></td>
								
									

									
								</tr>
								<?php } ?>
							</tbody>
						</table>
				  </div>
				</div>
            </div>
			<p class="footer" align="right">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
          </div>
        </div>