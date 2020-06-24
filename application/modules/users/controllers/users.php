<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class users extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_content');
	}
	
// PERLU DIUBAH
	function users_crud($tes){
		$title_page='User';
		$title_trash='Kotak Sampah - User';

		$get_priviledge = $this->session->userdata('user_group_id');
		$status = explode('-',$tes);
		$cas = $status[1];

		$primary_id = $status[0];
		$last_url = 'users/users_crud/0-0';
		if(($cas >= '4') && ($cas !== '7')){
			$last_url = 'users/users_crud/0-4';		
		}
		$menu_data = $this->menu_handler->get_menu($last_url);
		$institution_id= $this->session->userdata('institution_id');
		$data['lawyers'] =$this->mdl_content->get_all_lawyer();
		switch($cas){
			case 0: // FOR SHOW ALL lawyerS
					if($get_priviledge=='1'){
						$data['akses'] = $this->mdl_content->get_all_priviledge();
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list',$title_page,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else if($get_priviledge=='5'){
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
					} else if($get_priviledge=='5'){
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
					}else if($get_priviledge=='5'){
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
                  <th style="width:30%;">Nama</th>
                  <th style="width:5%;">L/P</th>
                  <th style="width:20%;">Username</th>
                  <th style="width:15%;">NIK</th>
                  <th style="width:15%;">Hak Akses</th>
                  <th style="width:15%;">Aksi</th>
                </tr>
              </thead>
              <tbody>';
				$i=1;
				foreach ($res as $row){
					if($row->gender=='M') {
						$gender = 'L';
					} else { 
						$gender = 'P';
					}

                $tables = $tables.'
				<tr>
  					<td align="center">'.$i.'</td>
                  	<td>'.$row->fullname.'</td>
                  	<td>'.$gender.'</td>
                  	<td>'.$row->username.'</td>
                  	<td>'.$row->nik.'</td>
                  	<td>'.$row->akses.'</td>
                    <td>
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
			$result = $this->mdl_content->edit_data($this->input->post('lawyer_id'));
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
		if($get_priviledge=='1'){
			$this->mdl_content->hapus_data($this->input->post('id'));
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

	function access_key($tes){
		$title_page='User';
		$title_trash='Kotak Sampah - User';

		$get_priviledge = $this->session->userdata('user_group_id');
		$status = explode('-',$tes);
		$cas = $status[1];

		$primary_id = $status[0];
		$last_url = 'users/users_crud/0-0';
		if(($cas >= '4') && ($cas !== '7')){
			$last_url = 'users/users_crud/0-4';		
		}
		$menu_data = $this->menu_handler->get_menu($last_url);
		$institution_id= $this->session->userdata('institution_id');
		// $data['all_tajar'] =$this->mdl_content->get_all_tajar_active();
		// $data['tajar_active'] =$this->mdl_content->get_ta_active($institution_id);
		// $data['all_tingkat'] =$this->mdl_content->populate_tingkat();
		switch($cas){
			case 0: // FOR SHOW ALL lawyerS
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_akses',$title_page,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else if($get_priviledge=='5'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_akses',$title_page,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
			case 4: // UNTUK TAMPILKAN TRASH event
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_trash',$title_trash ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else if($get_priviledge=='5'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_trash',$title_trash ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
			
			default:
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_akses',$title_page ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else if($get_priviledge=='5'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_akses',$title_page ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
		}
	}

	function populate_akses(){
    	$default_date = '0000-00-00';
    	$institution_id= $this->session->userdata('institution_id');
    	$res = $this->mdl_content->get_all_priviledge($institution_id);

    	$tables='';
    	$tables = $tables.'
    	 <div class="table-responsive">
            <table id="tbl_akses" class="table table-bordered table-striped" style="width:100%;">
              <thead>
                <tr>
                  <th style="width:5%;">No&nbsp;</th>
                  <th style="width:70%;">Nama Akses</th>
                  <th style="width:15%;">Aksi</th>
                </tr>
              </thead>
              <tbody>';
				$i=1;
				foreach ($res as $row){

                $tables = $tables.'
				<tr>
  					<td align="center">'.$i.'</td>
                  	<td>'.$row->priviledge_name.'</td>
                    <td>
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
	            $("#tbl_akses").DataTable();
	        });
	    </script>';

    	$data['table_data'] =$tables;
    	echo json_encode($data);
    }

}