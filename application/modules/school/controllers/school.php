<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class school extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_content');
	}
	
// PERLU DIUBAH
	function school_crud($tes){
		$title_page='Management Sekolah';
		$title_trash='Kotak Sampah - Pendaftaran';

		$get_priviledge = $this->session->userdata('user_group_id');
		$status = explode('-',$tes);
		$cas = $status[1];

		$primary_id = $status[0];
		$last_url = 'school/school_crud/0-0';
		if(($cas >= '4') && ($cas !== '7')){
			$last_url = 'school/school_crud/0-4';		
		}
		$menu_data = $this->menu_handler->get_menu($last_url);
		$institution_id= $this->session->userdata('institution_id');
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
			case 1: // UNTUK ADD 
					// if($get_priviledge=='1'){
						$data['new_data'] = true;
						$this->menu_handler->set_menu('school_detail','Data Sekolah Baru',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					// } else {
					// 	$this->menu_handler->error();
					// }
					break;
			case 2: // UNTUK EDIT
					if($get_priviledge==CA){
						$edit_school = $this->mdl_content->get_school_byid($status[0]);
						$data['data'] = $edit_school[0];
						$this->menu_handler->set_menu('school_detail','Edit Data Sekolah',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
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
    	$res = $this->mdl_content->get_all_school_active();

    	$tables='';
    	$tables = $tables.'
    	 <div class="table-responsive">
            <table id="tbl_data" class="table table-bordered table-striped" style="width:100%;">
              <thead>
                <tr>
                  <th style="width:5%;">No&nbsp;</th>
                  <th style="width:15%;">Nama Sekolah</th>
                  <th style="width:25%;">Alamat</th>
                  <th style="width:10%;">Telp</th>
                  <th style="width:10%;">Email</th>
                  <th style="width:10%;">Website</th>
                  <th style="width:10%;">Jumlah Siswa</th>
                  <th style="width:15%;">Aksi</th>
                </tr>
              </thead>
              <tbody>';
				$i=1;
				foreach ($res as $row){
					
                $tables = $tables.'
				<tr>
  					<td align="center">'.$i.'</td>
                  	<td>'.$row->name.'</td>
                  	<td>'.$row->address.'</td>
                  	<td>'.$row->telp.'</td>
                  	<td>'.$row->email.'</td>
                  	<td>'.$row->website.'</td>
                  	<td><a class="btn btn-success-o btn-xs" >P <i class="fa fa-female"></i></a> : '.$row->f_students.'<br>
                  		<a class="btn btn-success-o btn-xs" >L <i class="fa fa-male"></i></a> : '.$row->m_students.'</td>
                    <td align="center">
                        <a class="btn btn-success btn-xs"  href="#" onClick="ajaxSendMsg('.$row->id.');" rel="tooltip-top" title="Profile" ><i class="fa fa-user"></i></a>
                        <a class="btn btn-warning btn-xs" href="'.site_url('school/school_crud/'.$row->id.'-2').'"          rel="tooltip-top" title="Edit"><i class="fa fa-edit"></i></a>
                        <button class="btn btn-danger btn-xs" onClick="prepare_delete_data('.$row->id.')"><i class="fa fa-trash-alt"></i></button>
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

	function add_school(){
		$last_url = 'school/school_crud/0-0';
		$menu_data = $this->menu_handler->get_menu($last_url);
		$get_priviledge = $this->session->userdata('user_group_id');
		// $data['all_priviledge'] = $this->mdl_content->get_user_group();
		$data['new_data'] = true;
		if($get_priviledge=='1'){
			$result = $this->mdl_content->add_school();
			$data['daftar'] = $this->mdl_content->get_all_school_active();
			if($result == 1){
					$data['daftar'] = $this->mdl_content->get_all_school_active();
					$data['status'] = $this->lang->line('msg_data_success_add');
					$data['alert'] = 'alert alert-success';
					// $this->menu_handler->set_menu('ekskul_list','Ekstrakulikuler',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
				} else if($result == 2){
					$data['status'] =$this->lang->line('msg_data_duplicate_name_add');
					$data['alert'] = 'alert alert-danger';
					// $this->menu_handler->set_menu('ekskul_detail','Ekstrakulikuler',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
				} else {
					$data['alert'] = 'alert alert-danger';
					$data['status'] = $this->lang->line('msg_data_failure_add');
					// $this->menu_handler->set_menu('ekskul_detail','Ekstrakulikuler',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
				}
				redirect('school/school_crud/0-0');
		} else {
			$this->menu_handler->error();
		}
	}    

	function edit_school($id_subject, $status=''){
		$last_url = 'school/school_crud/0-0';
		$menu_data = $this->menu_handler->get_menu($last_url);
		// if($get_priviledge=='1'){
			if($id_subject =='save'){
				$result = $this->mdl_content->edit_school($this->input->post('id'));
				if($result==1){
					$data['daftar'] = $this->mdl_content->get_all_school_active();
					$data['status'] = $this->lang->line('msg_data_success_edit');
					$data['alert'] = 'alert alert-success';
					$this->menu_handler->set_menu('data_list','Management Sekolah',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
				} else {
					$data['status'] = $this->lang->line('msg_data_failure_edit');
					$data['alert'] = 'alert alert-danger';
					$this->edit_ekskul($this->input->post('id'),$data);
				}
			}else{
				$edit_ekskul = $this->mdl_content->get_school_byid($this->input->post('id'));
				$data['data'] = $edit_ekskul[0];
				$data['status'] = $this->lang->line('msg_data_failure_edit');
				$data['alert'] = 'alert alert-danger';
				$this->menu_handler->set_menu('school_detail','Edit Data Sekolah',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);			
			}
		// } else {
		// 	$this->menu_handler->error();
		// }
	}

	function data_detail(){
    	$result= $this->mdl_content->get_data($this->input->post('id'));
    	$data['item'] = $result[0];
    	echo json_encode($data);
    }

    function get_school_detail(){
    	$result = $this->mdl_content->get_data($this->input->post('id'));
    	echo json_encode($result[0]);
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

	
}