	<div class="bg-white">
		<div class="row">
			<div class="col-lg-12">
				<h1><?php echo $title; ?></h1>
				<ol class="breadcrumb">
					<li><i class="fa fa-calendar"></i>&nbsp;&nbsp;Dashboard</li>
					<li class="active"><i class="fa fa-list"></i>&nbsp;&nbsp;Detail Laporan</li>
				</ol>
			</div>
		</div>
		
		<?php $i=1;foreach ($lap_pelanggan as $rowlp){?>
			<div class="row">
				<label class="col-sm-1 control-label">Tanggal</label>
				<label  class="col-sm-5 control-label"><?php echo $rowlp->change_date;  ?> </label>
			</div>
			<div class="row">
				<label class="col-sm-1 control-label">Teknisi</label>
				<label  class="col-sm-5 control-label"><?php echo $rowlp->change_by;  ?> </label>
			</div>
		


		<div class="row">
          <div class="col-lg-6">
			
            <div class="panel panel-primary">
              <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapseLaporan">
						<h4 class="panel-title"><a class="accordion-toggle"> I.  DETAIL PELANGGAN</a></h4>
			  </div>
			  <div id="collapseLaporan" class="panel-collapse collapse in">
				  <div class="panel-body">
				  
				  	<div class="row">
						<label class="col-sm-4 control-label">Perusahaan</label>
						<label  class="col-sm-8 control-label"><?php echo ": ". $rowlp->n_perusahaan;  ?> </label>
					</div>
					<div class="row">
						<label class="col-sm-4 control-label">Pelanggan</label>
						<label  class="col-sm-8 control-label"><?php echo ": ". $rowlp->n_perusahaan;  ?> </label>
					</div>
					<div class="row">
						<label class="col-sm-4 control-label">Alamat</label>
						<label  class="col-sm-8 control-label"><?php echo": ".  $rowlp->alamat;  ?> </label>
					</div>
					<div class="row">
						<label class="col-sm-4 control-label">Telp</label>
						<label  class="col-sm-8 control-label"><?php echo ": ". $rowlp->telp;  ?> </label>
					</div>
					<div class="row">
						<label class="col-sm-4 control-label">Email</label>
						<label  class="col-sm-8 control-label"><?php echo ": ".$rowlp->email;  ?> </label>
					</div>
					<div class="row">
						<label class="col-sm-4 control-label">Circuit ID</label>
						<label  class="col-sm-8 control-label"><?php echo ": ".$rowlp->circuit_id;  ?> </label>
					</div>
					<div class="row">
						<label class="col-sm-4 control-label">Bandwitdh</label>
						<label  class="col-sm-8 control-label"><?php echo ": ".$rowlp->bandwidth;  ?> </label>
					</div>
					<div class="row">
						<label class="col-sm-4 control-label">Janis Layanan</label>
						<label  class="col-sm-8 control-label"><?php 

						$jl = explode('#',$rowlp->jenis_lay);
						for($i =1; $i<count($jl);$i++){
							echo "- ".$jl[$i]."<br>";
						}


						?> </label>
					</div>

					<div class="row">
						<label class="col-sm-4 control-label">Interface</label>
						<label  class="col-sm-8 control-label"><?php 

						$jl = explode('#',$rowlp->interface);
						for($i =1; $i<count($jl);$i++){
							echo "- ".$jl[$i]."<br>";
						}


						?> </label>
					</div>

					<div class="row">
						<label class="col-sm-4 control-label">Catatan</label>
						<label  class="col-sm-8 control-label"><?php echo ": ".$rowlp->catatan_pelanggan  ?> </label>
					</div>

				  </div>
				</div>
            </div>
            <?php }?>
            </div>
            <div class="col-lg-6">
			
            <div class="panel panel-primary">
              <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapsejenisgangguan">
						<h4 class="panel-title"><a class="accordion-toggle"> II. JENIS GANGGUAN</a></h4>
			  </div>
			  <div id="collapsejenisgangguan" class="panel-collapse collapse in">
				  <div class="panel-body">
				  	<div class="row">
						<label class="col-sm-4 control-label">Kategori </label>
						<label  class="col-sm-8 control-label">Keterangan</label>
						<label class="col-sm-12"><hr class="nomargin"></label>
					</div>
						
					<?php $i=1;foreach ($jenisgangguan as $rowjg){?>
					<div class="row">
						<label class="col-sm-4"><?php echo $rowjg->kategori  ?> </label>
						<label  class="col-sm-8"><?php echo $rowjg->keterangan  ?> </label>
					</div>
					 <?php }?>

				  </div>
				</div>
            </div>
          </div>

         </div>


		
		<div class="row">
          
        </div>

		<div class="row">
          <div class="col-lg-6">
			
            <div class="panel panel-primary">
              <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapsedetailgangguan">
						<h4 class="panel-title"><a class="accordion-toggle"> III. DETAIL GANGGUAN</a></h4>
			  </div>
			  <div id="collapsedetailgangguan" class="panel-collapse collapse in">
				  <div class="panel-body">
				  	
				  	<?php $i=1;foreach ($detailsolusi as $rowds){?>
					<div class="row">
						<textarea class="col-md-offset-1 col-sm-10" rows="5" readonly="true"><?php echo $rowds->detail_gangguan ?> </textarea>
					</div>
					 <?php }?>

				  </div>
				</div>
            </div>
			
          </div>
		  <div class="col-lg-6">
			
            <div class="panel panel-primary">
              <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapsepengetesan">
					<h4 class="panel-title"><a class="accordion-toggle"> IV. PENANGANAN / SOLUSI</a></h4>
			  </div>
			  <div id="collapsepengetesan" class="panel-collapse collapse in">
				  <div class="panel-body">
				  	
				  	<?php $i=1;foreach ($detailsolusi as $rowds){?>
					<div class="row">
						<textarea class="col-md-offset-1 col-sm-10" rows="5" readonly="true"><?php echo $rowds->solusi ?> </textarea>
					</div>
					 <?php }?>

				  </div>
				</div>
            </div>
          </div>

        </div>


        <div class="row">
          <div class="col-lg-6">
			
            <div class="panel panel-primary">
              <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapsecatatan">
						<h4 class="panel-title"><a class="accordion-toggle"> V.  PENGETESAN</a></h4>
			  </div>
			  <div id="collapsecatatan" class="panel-collapse collapse in">
				  <div class="panel-body">

					<div class="row">
						<label class="col-sm-4">Deskripsi </label>
						<label class="col-sm-4">Result</label>
						<label class="col-sm-4">Status</label>
						<label class="col-sm-12"><hr class="nomargin"></label>
					</div> 				  	
				  	<?php $i=1;foreach ($lap_test as $rowlt){?>
					<div class="row">
						<label class="col-sm-4"><?php echo $rowlt->deskripsi  ?> </label>
						<label class="col-sm-4"><?php echo $rowlt->result  ?> </label>
						<label class="col-sm-4"><?php echo $rowlt->status_test  ?> </label>
					</div>
					 <?php }?>

				  </div>
				</div>
            </div>
          </div>

          <div class="col-lg-6">
			
            <div class="panel panel-primary">
              <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapsedashboardList">
						<h4 class="panel-title"><a class="accordion-toggle"> CATATAN</a></h4>
			  </div>
			  <div id="collapsedashboardList" class="panel-collapse collapse in">
				  <div class="panel-body">
				  	<?php $i=1;foreach ($lap_pelanggan as $rowlp){?>
					<div class="row">
						<textarea class="col-md-offset-1 col-sm-10" rows="7" readonly="true"><?php echo $rowlp->catatan_laporan  ?> </textarea> 
					 <?php }?>

				  </div>
				</div>
            </div>
          </div>
		
        </div>
        </div>

        <div class="row">
        	<?php $i=1;foreach ($lap_pelanggan as $rowlp){?>
	        <div class="col-sm-6">

			
			 	<label class="">Dibuat Oleh</label><br>
			 	<label class="">PT Intelex Telecom Global</label><br>
	          	<img  widht="120px" height="180px" src="<?php echo base_url(); ?>data_file/user/<?php echo $rowlp->img_ttd_user;?>">
	          	<br><label class="ttd"><?php echo $rowlp->change_by;?></label>
	        </div>
	        <div class="col-md-offset-2 col-sm-4">
	        	<label class="">Mengetahui,</label><br>
			 	<label class="">Pelanggan</label><br>
	          	<img  widht="120px" height="180px" src="<?php echo base_url(); ?>data_file/pelanggan/<?php echo $rowlp->img_ttd_pelanggan;?>">
	        	<br><label class="ttd"><?php echo $rowlp->n_pelanggan;?></label>
	        </div>
	        <?php }?>
        </div>
 </div>

        


       