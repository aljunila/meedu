<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Enduser extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_content');
	}

	function enduser_crud($tes){
		$get_priviledge = $this->session->userdata('user_group_id');
		$status = explode('-',$tes);
		$cas = $status[1];
		$last_url = 'enduser/enduser_crud/0-0';
		if($cas >= '4'){
			$last_url = 'enduser/enduser_crud/'.$tes;		
		}
		$menu_data = $this->menu_handler->get_menu($last_url);
		switch($cas){
			case 0: // FOR SHOW ALL enduserS
					if($get_priviledge=='-1'){
						$data['daftar'] = $this->mdl_content->get_all_enduser_active();
						$this->menu_handler->set_menu('enduser_list','Admin User',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else if($get_priviledge=='2'){
						$idPartner = $this->session->userdata('idChild');
						$data['daftar'] = $this->mdl_content->get_all_enduser_active_bypartner($idPartner);
						$this->menu_handler->set_menu('enduser_list','enduser',$data,5,9);
					} else {
						$this->menu_handler->error();
					}
					break;
			case 1: // UNTUK ADD enduser
					if($get_priviledge=='-1'){
						$data['all_sekolah'] = $this->mdl_content->get_all_sekolah();
						$data['all_yayasan'] = $this->mdl_content->get_all_yayasan();
						$data['new_enduser'] = true;
						$this->menu_handler->set_menu('enduser_detail','Admin User',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			case 2: // UNTUK EDIT enduser
					if($get_priviledge=='-1'){
						$data['all_sekolah'] = $this->mdl_content->get_all_sekolah();
						$data['all_yayasan'] = $this->mdl_content->get_all_yayasan();
						$edit_enduser = $this->mdl_content->get_enduser($status[0]);
						$data['datas'] = $edit_enduser[0];
						$this->menu_handler->set_menu('enduser_detail','Admin User',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
						
					} 	
					break;
			case 3: // UNTUK DELETE enduser MASUK TRASH
					if($get_priviledge=='-1'){
						$data['daftar'] = $this->mdl_content->get_all_enduser_active();
						$dataenduser = $this->mdl_content->get_enduser($status[0]);
						// $loginStatus = $dataenduser[0]->login_status;
						if ($dataenduser[0]->login_status=='A') {
							$data['status'] = 'Sorry, enduser account still logged on';
							$data['alert'] = 'alert alert-danger';
							$this->menu_handler->set_menu('enduser_list','Admin User',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
						} else {
							$this->mdl_content->hapus_enduser($status[0]);
							$data['daftar'] = $this->mdl_content->get_all_enduser_active();
							$data['status'] = 'Data has been deleted';
							$data['alert'] = 'alert alert-success';
							$this->menu_handler->set_menu('enduser_list','Admin User',$data,5,9);
						}
					} else {
						$this->menu_handler->error();
					}
					break;
			case 4: // UNTUK TAMPILKAN TRASH enduser
					if($get_priviledge=='-1'){
						$data['daftar'] = $this->mdl_content->get_all_enduser_deactive();
						$this->menu_handler->set_menu('enduser_trash','Admin Trash',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			case 5: // UNTUK RESTORE enduser
					if($get_priviledge=='-1'){
						$this->mdl_content->restore_enduser($status[0]);
						$data['daftar'] = $this->mdl_content->get_all_enduser_deactive();	
						$data['status'] = 'Data has been restored';
						$data['alert'] = 'alert alert-success';
						$this->menu_handler->set_menu('enduser_trash','Admin Trash',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			case 6: // UNTUK DELETE enduser PERMANEN
					if($get_priviledge=='-1'){
						$data['daftar'] = $this->mdl_content->get_all_enduser_deactive();
						$this->mdl_content->hapus_enduser_permanen($status[0]);
						$data['daftar'] = $this->mdl_content->get_all_enduser_deactive();
						$data['status'] = 'enduser has been permanently deleted';
						$data['alert'] = 'alert alert-success';
						$this->menu_handler->set_menu('enduser_trash','Admin Trash',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			
			default:
					if($get_priviledge=='1'){
						$data['daftar'] = $this->mdl_content->get_all_enduser_active();
						$this->menu_handler->set_menu('enduser_list','Admin User',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
		}
	}
	
	function add_enduser(){
		$last_url = 'enduser/enduser_crud/0-0';
		$menu_data = $this->menu_handler->get_menu($last_url);
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['all_priviledge'] = $this->mdl_content->get_user_group();
		$data['new_enduser'] = true;
		if($get_priviledge=='-1'){
			$result = $this->mdl_content->add_enduser();
			$data['daftar'] = $this->mdl_content->get_all_enduser_active();
			if($result == 1){
					$data['daftar'] = $this->mdl_content->get_all_enduser_active();
					$data['status'] = "enduser has been added.";
					$data['alert'] = 'alert alert-success';
					$this->menu_handler->set_menu('enduser_list','Admin User',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
				} else if($result == 2){
					$data['status'] = "Sorry, enduser name or Email has been used";
					$data['alert'] = 'alert alert-danger';
					$this->menu_handler->set_menu('enduser_detail','Admin User',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
				} else {
					$data['alert'] = 'alert alert-danger';
					$data['status'] = "Please check again!!!";
					$this->menu_handler->set_menu('enduser_detail','Admin User',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
				}
		} else {
			$this->menu_handler->error();
		}
	}
	
	function edit_enduser($id_enduser, $status=''){
		$last_url = 'enduser/enduser_crud/0-0';
		$menu_data = $this->menu_handler->get_menu($last_url);
		$get_priviledge = $this->session->userdata('user_group_id');
		if($get_priviledge=='-1'){
			if($id_enduser =='save'){
				$result = $this->mdl_content->edit_enduser($this->input->post('id'));
				if($result==1){
					$data['daftar'] = $this->mdl_content->get_all_enduser_active();
					$data['status'] = "enduser data has been updated.";
					$data['alert'] = 'alert alert-success';
					$this->menu_handler->set_menu('enduser_list','Admin User',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
				} else {
					$data['status'] = "Please check again!!!";
					$data['alert'] = 'alert alert-danger';
					$this->edit_enduser($this->input->post('id'),$data);
				}
			} else if($id_enduser =='save_detail'){
				$result = $this->mdl_content->edit_enduser_detail($this->input->post('id'));
				$data['daftar'] = $this->mdl_content->get_all_enduser_active();
				$data['status'] = "enduser data has been updated.";
				$data['alert'] = 'alert alert-success';
				$this->menu_handler->set_menu('enduser_list','Admin User',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
			}else{
				$edit_enduser = $this->mdl_content->get_enduser($this->input->post('id'));
				$data['enduser'] = $edit_enduser[0];
				$data['status'] = "Please check again!!!";
				$data['alert'] = 'alert alert-danger';
				$this->menu_handler->set_menu('enduser_detail','Admin User',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);			
			}
		} else {
			$this->menu_handler->error();
		}
	}

	
}