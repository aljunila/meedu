<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminsekolah extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_content');
	}
	
// PERLU DIUBAH
	function adminsekolah_crud($tes){
		$title_page='Admin Sekolah';
		$title_trash='Kotak Sampah - Clients';

		$get_priviledge = $this->session->userdata('user_group_id');
		$status = explode('-',$tes);
		$cas = $status[1];

		$primary_id = $status[0];
		$last_url = 'adminsekolah/adminsekolah_crud/0-0';
		if(($cas >= '4') && ($cas !== '7')){
			$last_url = 'adminsekolah/adminsekolah_crud/0-4';		
		}
		$menu_data = $this->menu_handler->get_menu($last_url);
		$institution_id= $this->session->userdata('institution_id');
		$data['priviledge'] =$this->mdl_content->get_all_priviledge();
		$data['sekolah'] =$this->mdl_content->get_all_school_active();
		// $data['all_tingkat'] =$this->mdl_content->populate_tingkat();
		switch($cas){
			case 0: // FOR SHOW ALL lawyerS
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list',$title_page,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else if($get_priviledge=='2'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list',$title_page,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
			case 4: // UNTUK TAMPILKAN TRASH event
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_trash',$title_trash ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else if($get_priviledge=='2'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_trash',$title_trash ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
			
			default:
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list',$title_page ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else if($get_priviledge=='2'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list',$title_page ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
		}
	}
	
    function populate_data(){
    	$default_date = '0000-00-00';
    	$institution_id= $this->session->userdata('institution_id');
    	$res = $this->mdl_content->get_all_data_active($institution_id);

    	$tables='';
    	$tables = $tables.'
    	 <div class="table-responsive">
            <table id="tbl_data" class="table table-bordered table-striped" style="width:100%;">
              <thead>
                <tr>
                  <th style="width:5%;">No&nbsp;</th>
                  <th style="width:25%;">Nama</th>
                  <th style="width:20%;">Sekolah</th>
                  <th style="width:15%;">Username</th>
                  <th style="width:10%;">No. Telp</th>
                  <th style="width:10%;">Aksi</th>
                </tr>
              </thead>
              <tbody>';
				$i=1;
				foreach ($res as $row){

                $tables = $tables.'
				<tr>
  					<td align="center">'.$i.'</td>
                  	<td>'.$row->fullname.'</td>
                  	<td>'.$row->nama_sekolah.'</td>
                  	<td>'.$row->username.'</td>
                  	<td>'.$row->phone.'</td>
                    <td align="center">
                        <button class="btn bg-teal btn-xs" onClick="prepare_edit_data('.$row->id.')"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-warning btn-xs" onClick="prepare_delete_data('.$row->id.')"><i class="fa fa-trash-alt"></i></button>
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
	            $("#tbl_data").DataTable();
	        });
	    </script>';

    	$data['table_data'] =$tables;
    	echo json_encode($data);
    }

    function populate_data_deactive(){
		$default_date = '0000-00-00';
    	$institution_id= $this->session->userdata('institution_id');
    	$res = $this->mdl_content->get_all_data_deactive($institution_id);
    	$tables='';
    	$tables = $tables.'
    	 <div class="table-responsive">
            <table id="tbl_data" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width:5%;">No&nbsp;</th>
                  <th style="width:25%;">Nama</th>
                  <th style="width:10%;">Kode Klient</th>
                  <th style="width:20%;">Username</th>
                  <th style="width:15%;">Email</th>
                  <th style="width:15%;">Tlp</th>
                  <th style="width:15%;">Aksi</th>
                </tr>
              </thead>
              <tbody>';
				$i=1;
				foreach ($res as $row){
			    $tables = $tables.'
				<tr>
  					<td align="center">'.$i.'</td>
                  	<td>'.$row->fullname.'</td>
                  	<td>'.$row->unique_id.'</td>
                  	<td>'.$row->username.'</td>
                  	<td>'.$row->email.'</td>
                  	<td>'.$row->phone.'</td>
                    <td>
                    <div class="pull-right">
                        <button class="btn btn-primary btn-xs" onClick="ajax_restore_data('.$row->id.')"><i class="fa fa-undo"></i></button>
                        <button class="btn btn-danger btn-xs" onClick="prepare_delete_data('.$row->id.')"><i class="fa fa-trash-alt"></i></button>
                       
                    </div>
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
	            $("#tbl_data").DataTable();
	        });
	    </script>';

    	$data['table_data'] =$tables;
    	echo json_encode($data);
    }

    

// TDK PERLU DIUBAH    
    function add_data(){
		$get_priviledge = $this->session->userdata('user_group_id');

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
			
		} else if($get_priviledge=='2'){
			$result = $this->mdl_content->add_data('');
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

	function edit_data(){
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
		} else if($get_priviledge=='2'){
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

	function data_detail(){
    	$result= $this->mdl_content->get_data($this->input->post('id'));
    	$data['item'] = $result[0];
    	echo json_encode($data);
    }

	function delete_data(){
		$get_priviledge = $this->session->userdata('user_group_id');
			$this->mdl_content->hapus_data($this->input->post('id'));
			$status = $this->lang->line('msg_data_success_delete');
			$alert = 'alert alert-success';
			$data['alert_modal'] = '
			 <div class="'.$alert.' alert-dismissable" id="modal-status">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      '.$status.'
		    </div>';
			echo json_encode($data);
	}

	function delete_data_permanent(){
		$get_priviledge = $this->session->userdata('user_group_id');
		if($get_priviledge=='1'){
			$this->mdl_content->hapus_data_permanent($this->input->post('id'));
			$status = $this->lang->line('msg_data_success_delete');
			$alert = 'alert alert-success';
			$data['alert_modal'] = '
			 <div class="'.$alert.' alert-dismissable" id="modal-status">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      '.$status.'
		    </div>';
			echo json_encode($data);
		} else if($get_priviledge=='2'){
			$this->mdl_content->hapus_data_permanent($this->input->post('id'));
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

	function restore_data(){
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
		} else if($get_priviledge=='2'){
			$this->mdl_content->restore_data($this->input->post('id'));
			$status = $this->lang->line('msg_data_success_restore');
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

	function client_detail($id){
		$last_url = 'clients/clients_crud/0-0';
		$menu_data = $this->menu_handler->get_menu($last_url);
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['questions'] = $this->mdl_content->get_all_event_byclient($id);
		$client = $this->mdl_content->get_data($id);
		$data['client'] = $client[0];

		$this->menu_handler->set_menu('client_detail','Client',$data,5,9);
	}

	function get_event_client(){
		$client_id = $this->input->post('client_id');

		$s_o_c = $this->mdl_content->get_event_without_client();
		$s_i_c = $this->mdl_content->get_all_event_byclient($client_id);

		$table_soc = 
		'<div class="table-responsive">
            <table id="data-siswa-1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No&nbsp;</th>
                  <th>Event </th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>';
                $i=1;
                foreach ($s_o_c as $row){
					if($this->session->userdata('user_group_id')=='1'){
	                   	$aksi='
	                   	<a href="#" rel="tooltip-top" title="Add" class="btn btn-info btn-xs" onClick="ajaxStudentAdd('.$row->id.','.$client_id.')"> 
	                   		<i class="fa fa-plus"></i>
	                   	</a>';
	                } else {
	                  	$aksi ='N/A';
	                }

	                $table_soc= $table_soc.
	                '<tr>
	                  <td align="center">'.$i.'</td>
	                  <td>'.$row->title.'</td>
	                  <td>'.date('d M Y', strtotime($row->start_date)).' - '.date('d M Y', strtotime($row->start_date)).'</td>
	                  <td>'.$aksi.'
	                  </td>
	                </tr>';
                $i++;
                } 
        $table_soc = $table_soc .'
                </tbody>
              </table>
        </div>';
        $table_soc = $table_soc.
        	'<script>
		        $(function () {
		            $("#data-siswa-1").DataTable();
		        });
		    </script>
			';
		$data['soc']= $table_soc;


		$table_sic = 
		'<div class="table-responsive">
            <table id="data-siswa-2" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No&nbsp;</th>
                  <th>Event </th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>';
                $i=1;
                foreach ($s_i_c as $rs){
					if($this->session->userdata('user_group_id')=='1'){
	                   	$aksi='
	               
  					  	<a class="btn btn-xs btn-warning" href="#" rel="tooltip-top" title="Delete" onClick="modalDelete('.$rs->id.','.$client_id.');"
	                   		> 
  						   <i class="fa fa-trash-alt"></i>
  					  	</a>



	                   	';
	                } else {
	                  	$aksi ='N/A';
	                }

	                $table_sic= $table_sic.
	                '<tr>
	                  <td align="center">'.$i.'</td>
	                  <td>'.$rs->title.'</td>
	                  <td>'.date('d M Y', strtotime($rs->start_date)).' - '.date('d M Y', strtotime($rs->start_date)).'</td>
	                  <td>'.$aksi.'
	                  </td>
	                </tr>';
                $i++;
                } 
        $table_sic = $table_sic .'
                </tbody>
              </table>
        </div>';
        $table_sic = $table_sic.
        	'<script>
		        $(function () {
		            $("#data-siswa-2").DataTable();
		        });
		    </script>
			';
		$data['sic']= $table_sic;

		echo json_encode($data);
	}

	function get_event(){
		$client_id = $this->input->post('client_id');
		$s_i_c = $this->mdl_content->get_all_event_byclient($client_id);


		$table_sic = 
		'<div class="table-responsive">
            <table id="data-siswa-2" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No&nbsp;</th>
                  <th>Event </th>
                  <th>Tanggal </th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>';
                $i=1;
                foreach ($s_i_c as $rs){       	
				
	                $table_sic= $table_sic.
	                '<tr>
	                  <td align="center">'.$i.'</td>
	                  <td>'.$rs->title.'</td>
	                  <td>'.date('d M Y', strtotime($rs->start_date)).' - '.date('d M Y', strtotime($rs->start_date)).'</td>
	                  <td><a href="#" class="btn btn-danger-o btn-xs" rel="tooltip-top" title="Delete"
	                   	data-toggle="modal" data-target="#deleteMessage"  id="'.site_url('clients/client_event_delete/'.$rs->id.'/'.$client_id).'" onClick="sendimg(this);"
	                   	> 
  						   <i class="fa fa-trash-alt" ></i>
  						   Hapus
  					  	</a>
	                  </td>
	                </tr>';
                $i++;
                } 
        $table_sic = $table_sic .'
                </tbody>
              </table>
        </div>';
        $table_sic = $table_sic.
        	'<script>
		        $(function () {
		            $("#data-siswa-2").DataTable();
		        });
		    </script>
			';
		$data['sic']= $table_sic;

		echo json_encode($data);
	}

	function add_event_client(){
		$client_id = $this->input->post('client_id');
		$event_id = $this->input->post('event_id');
		$result = $this->mdl_content->link_event($client_id);
		print_r($result);
	}

	function ajax_event_delete(){
		$client_id= $this->input->post('client_id');
		$id= $this->input->post('id');
		$result = $this->mdl_content->event_delete($id);	
	}

	function client_event_delete($id,$client_id){
		$result = $this->mdl_content->event_delete($id);
		$data['status'] = "Event telah dihapus dari Client.";
		$data['alert'] = 'alert alert-success';
		$this->client_detail($client_id,$data);
		
	}
}