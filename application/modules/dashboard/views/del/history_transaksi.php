<script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=100%,height=300');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
 </script>

<link rel="stylesheet" href="<?php echo base_url(); ?>themesAdmin/plugins/datepicker/datepicker3.css">
<!-- Content Header (Page header) -->


<section class="content-header">
    <h1>
    <?php echo $title; ?>
    <small><?php if(isset($new_category)) { echo '<i class="fa fa-user"></i>&nbsp;&nbsp;New test'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit test'; } ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard/dashboard_crud/0-0')?>" tooltip="Goto Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('test/test_crud/0-0')?>"><?php echo $title; ?></a></li>
        <li class="active"><?php if(isset($new_category)) { echo '<i class="fa fa-user"></i>&nbsp;&nbsp;New test'; } else { echo '<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit test'; } ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
        	    <!-- TABLE: LATEST ORDERS -->
	     <?php	if(@$status){ ?>
			<div class="<?php echo $alert; ?> alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?php echo $status; ?>
			</div>
			<?php } ?>
            <div class="box box-primary " >
                <div class="box-header with-border">
                  <h3 class="box-title">Detail Pembayaran</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body" id="divToPrint" >
                 	

				<div style="text-align:center; font-size: 12px">
			       LTQ-IQRO<br>
			       JL. KH. Ahmad Madani No. 199D<br>
				   Telp. / Fax :(021) 84979461 web : www.iqro.or.id
			       <br>
			       <strong>PEMBAYARAN</strong>
			    </div> 
			    <div style="width:100%;height: auto; overflow: hidden; ">
			        <div 
			        style="width: 40%;
			        float: right;"
			        >
			          <table style="font-size: 13px">
			            <tr>
			              <td>No Resi
			              </td>
			              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			              <td><?php echo $trans->tsNumb;?>
			              </td>
			            </tr>
			            
			            <tr>
			              <td>Jenis Pembayaran</td>
			              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			              <td> 
			              	
							<?php if($trans->paymentMethode =='C'){ echo 'Tunai';} else if ($trans->paymentMethode =='T'){ echo 'Transfer';}?>
							</td>
			            </tr>
			            <tr>
			              <td>Tgl Pembayaran</td>
			              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			              <td> 
							<?php echo $trans->tsDate; ?>
			              </td>
			            </tr>
			            
			            <tr>
			              <td>Diterima Oleh</td>
			              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			              <td><?php echo $trans->namaUser; ?></td>
			            </tr>
			          </table>

			        </div>
			        <div 
			        style="float: none;"
			        >
			         <table  style="font-size: 13px">
			            <tr>
			              <td>Formulir
			              </td>
			              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			              <td> <?php
			              		if($profile->category=='1'){
			              			echo 'ANAK';
			              		}else if($profile->category=='2'){
			              			echo 'DEWASA';
			              		}else if($profile->category=='3'){
			              			echo 'PRIVATE';
			              		}
			              		?>
			              </td>
			            </tr>
			            <tr>
			              <td>Nama Kelas/ TA</td>
			              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			              <td><?php echo $profile->psbId;?></td>
			            </tr>
			            <tr>
			              <td>Nomor Urut Pendaftaran</td>
			              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			              <td> <?php echo sprintf('%08d',$user->id);?></td>
			            </tr>
			            <tr>
			              <td>Nama</td>
			              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			              <td><?php echo $profile->fullname;?></td>
			            </tr>
			          </table>

			        </div>
			       </div> 
			  
			    
                  <div class="table-responsive">
                  <table width="100%" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No&nbsp;</th>
                        <th style="text-align: left;">Item</th>
                        <th style="text-align: left;">Biaya</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php $i=1;
                       $nominal=0;
                       foreach ($trans_detail as $rb){?>
	                      <tr>
	                        <td align="center"><?php echo $i; $i++;?></td>
	                        <td><?php  echo $rb->catName;?></td>
	                        <td>
	                        	<?php echo "Rp. "; echo number_format($rb->nominal."",2,",",".") ;?></td>
	                      </tr>

                      <?php  
                        $nominal = $nominal + ($rb->nominal*1);
                      } ?>

                      <tr>
                      	<td>
                      	</td>
                      	<td><strong>TOTAL</strong></td>
                      	<td><strong>
                      	<input style="display: none;" type="text" name="total" value="<?php echo $nominal;?>">
							<?php echo "Rp. "; echo number_format($nominal."",2,",",".") ;?>
						</strong></td>
                      </tr>
                      </tbody>
                    </table>
                </div><!-- /.table-responsive -->
					
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                	<div class="pull-right">
						<button  class="btn btn-default" onclick="PrintDiv();" ><i class="fa fa-printer"></i> Cetak Bukti</button>
						&nbsp;
						<a href="<?php echo site_url('dashboard/dashboard_crud/0-0') ?>"><button class="btn btn-danger"> Batal</button></a>
					</div>
					
					
					
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
            <?php if(!isset($new_category)){ ?>
				<div class="modal modal-warning fade" id="deleteMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
							</div>
							<div class="modal-body">
								<p class="error-text"><i class="fa fa-exclamation-triangle fa-2x"></i> Are you sure you want to delete the test?</p>
							</div>
							<div class="modal-footer">
			                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
			                    <a href="<?php echo site_url('test/test_crud/'.$test->testId.'-3'); ?>"><button type="button" class="btn btn-outline">Delete</button></a>
			                </div>
							
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div>
				<?php } ?>

        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script src="<?php echo base_url(); ?>themesAdmin/plugins/datepicker/bootstrap-datepicker.js"></script>



