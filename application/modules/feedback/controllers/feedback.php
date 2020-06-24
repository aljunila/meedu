<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class feedback extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_content');
	}
	
	function feedback_cfg($tes){
		$get_priviledge = $this->session->userdata('user_group_id');
		$institution_id = $this->session->userdata('institution_id');
		$status = explode('-',$tes);
		$cas = $status[1];
		$last_url = 'feedback/feedback_cfg/0-0';
		if($cas >= '4'){
			$last_url = 'feedback/feedback_cfg/0-4';		
		}
		$menu_data = $this->menu_handler->get_menu($last_url);
		switch($cas){
			case 0: // FOR SHOW ALL feedback
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list','Kritik &amp; Saran',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
			
			case 4: // UNTUK TAMPILKAN TRASH billboard
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_trash','Kritik &amp; Saran',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			default : // FOR SHOW ALL feedback
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list','Kritik &amp; Saran',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
		}
	}

	function populate_data(){
    	$get_priviledge = $this->session->userdata('user_group_id');
		if($get_priviledge=='1'){
			$res = $this->mdl_content->get_all_data_active();
	    	$tables='';
	    	$tables = $tables.'
	    	 <div class="table-responsive">
	            <table id="dt_table_data" class="table table-hover">
	              <thead>
	                <tr>
	                  <th>No&nbsp;</th>
	                  <th style=" white-space:nowrap; ">Nama Lengkap</th>
	                  <th style=" white-space:nowrap; ">Perihal</th>
	                  <th style=" white-space:nowrap; ">Pesan</th>
	                  <th style=" white-space:nowrap; ">Tgl Pesan</th>
	                  <th style=" white-space:nowrap; ">Klasifikasi</th>
	                </tr>
	              </thead>
	              <tbody>';
					$i=1;
					foreach ($res as $row){
						$kla="";
						if($row->user_group_id=='3'){
							$kla = 'Orang Tua/Murid';
						}else if($row->user_group_id=='2'){
							$kla= "Staff/Pengajar";
						}

					    $tables = $tables.'
						<tr>
		  					<td align="center" style="width:50px;">'.$i.'</td>
		                  	<td style=" white-space:nowrap;">'.$row->fullname.'</td>
		                  	<td style=" white-space:nowrap;">'.$row->subject.'</td>
		                  	<td style=" white-space:nowrap;">'.$row->msg.'</td>
		                  	<td style=" white-space:nowrap; ">'.$row->created_date.'</td>
		                  	<td style=" white-space:nowrap; ">'.$kla.'</td>
						</tr>';
		  				$i++;
	  				} 

	        $tables = $tables.'
	                </tbody>
	              </table>
	          </div>
			 <script>
		        $(function () {
		            $("#dt_table_data").DataTable({
			            	"scrollX": true,
			            });
		        });
		    </script>';
	    	$data['table_data'] =$tables;
	    	echo json_encode($data);
	    }
    }

    function data_detail(){
    	$result= $this->mdl_content->get_data($this->input->post('id'));
    	$data['data'] = $result[0];
    	echo json_encode($data);
    }

    function add_data_ajax(){
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['new_subject'] = true;
		if($get_priviledge=='1'){
			$result = $this->mdl_content->add_data();
			if($result == 1){
				$status = $this->lang->line('msg_data_success_add');
				$alert = 'alert alert-success';
			} else if($result == 2){
				$status =$this->lang->line('msg_data_duplicate_name_add');
				$alert = 'alert alert-danger';
			} else {
				$alert = 'alert alert-danger';
				$status = $this->lang->line('msg_data_failure_add');
			}
			$data['alert_modal'] = '
			 <div class="'.$alert.' alert-dismissable" id="modal-status">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      '.$status.'
		    </div>';
			echo json_encode($data);
		} else {
			$this->menu_handler->error();
		}
	}

	function edit_data_ajax(){
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['new_subject'] = true;
		if($get_priviledge=='1'){
			$result = $this->mdl_content->edit_data($this->input->post('id'));
			if($result == 1){
				$status = $this->lang->line('msg_data_success_edit');
				$alert = 'alert alert-success';
			} else if($result == 2){
				$status =$this->lang->line('msg_data_duplicate_name_add');
				$alert = 'alert alert-danger';
			} else {
				$alert = 'alert alert-danger';
				$status = $this->lang->line('msg_data_failure_add');
			}

			$data['alert_modal'] = '
			 <div class="'.$alert.' alert-dismissable" id="modal-status">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      '.$status.'
		    </div>';
			echo json_encode($data);
		} else {
			$this->menu_handler->error();
		}
	}

	function delete_data_ajax(){
		$get_priviledge = $this->session->userdata('user_group_id');
		if($get_priviledge=='1'){
			$this->mdl_content->delete_data($this->input->post('id'));
			$status = $this->lang->line('msg_data_success_delete');
			$alert = 'alert alert-success';
			$data['alert_modal'] = '
			 <div class="'.$alert.' alert-dismissable" id="modal-status">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      '.$status.'
		    </div>';
			echo json_encode($data);
		} else {
			$this->menu_handler->error();
		}
	}

	function populate_data_deactive(){
    	$institution_id= $this->session->userdata('institution_id');
    	$res = $this->mdl_content->get_all_data_deactive($institution_id);
    	$tables='';
    	$tables = $tables.'
    	 <div class="table-responsive">
            <table id="tbl_data_trash" class="table table-hover">
              <thead>
                <tr>
                  <th style=" white-space:nowrap; ">No&nbsp;</th>
                  <th style=" white-space:nowrap; ">Nama</th>
                  <th style=" white-space:nowrap; ">Dirjen</th>
                  <th style=" white-space:nowrap; ">Direktorat</th>
                  <th style=" white-space:nowrap; ">Jekel</th>
                  <th style=" white-space:nowrap; ">Tgl Lahir</th>
                  <th style=" white-space:nowrap; ">Telp</th>
                  <th style=" white-space:nowrap; ">Aksi</th>
                </tr>
              </thead>
              <tbody>';
				$i=1;
				foreach ($res as $row){
	                $tables = $tables.'
					<tr>
	  					<td align="center" style="width:60px;">'.$i.'</td>
	                  	<td style=" white-space:nowrap;">'.$row->fullname.'</td>
	                  	<td style=" white-space:nowrap;">'.$row->dirjen.'</td>
	                  	<td style=" white-space:nowrap;">'.$row->direktorat.'</td>
	                  	<td style=" white-space:nowrap;">'.$row->gender.'</td>
	                  	<td style=" white-space:nowrap; ">'.$row->dob.'</td>
	                  	<td style=" white-space:nowrap;">'.$row->phone.'</td>
	                    <td style=" white-space:nowrap;">
	                        <button class="btn btn-primary btn-xs" onClick="ajaxRestoreData('.$row->id.')"><i class="fa fa-undo"></i></button>
	                        <button class="btn btn-danger btn-xs" onClick="prepareDeleteData('.$row->id.')"><i class="fa fa-trash-alt-alt"></i></button>
	                  	</td>
					</tr>';
	  				$i++;
  				} 
        $tables = $tables.'
                </tbody>
              </table>
          </div>
		 <script>
	        $(function () {
	            $("#tbl_data_trash").DataTable({
			            	"scrollX": true,
			            });
	        });
	    </script>';

    	$data['table_data_trash'] =$tables;
    	echo json_encode($data);
    }
 
	function delete_permanent_data_ajax(){
		$get_priviledge = $this->session->userdata('user_group_id');
		if($get_priviledge=='1'){
			$this->mdl_content->delete_permanent_data($this->input->post('id'));
			$status = $this->lang->line('msg_data_success_delete');
			$alert = 'alert alert-success';
			$data['alert_modal'] = '
			 <div class="'.$alert.' alert-dismissable" id="modal-status">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      '.$status.'
		    </div>';
			echo json_encode($data);
		}else {
			$this->menu_handler->error();
		}
	}

	function restore_data_ajax(){
		$get_priviledge = $this->session->userdata('user_group_id');
		if($get_priviledge=='1'){
			$this->mdl_content->restore_data($this->input->post('id'));
			$status = $this->lang->line('msg_data_success_restore');
			$alert = 'alert alert-success';
			$data['alert_modal'] = '
			 <div class="'.$alert.' alert-dismissable" id="modal-status">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      '.$status.'
		    </div>';
			echo json_encode($data);
		}else {
			$this->menu_handler->error();
		}
	}

}