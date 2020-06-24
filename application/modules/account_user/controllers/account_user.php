<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class account_user extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_content');
	}

	function account_bank($tes){
		$get_priviledge = $this->session->userdata('user_group_id');
		$status = explode('-',$tes);
		$cas = $status[1];
		$last_url = 'settings/account_bank/0-0';
		if($cas >= '4'){
			$last_url = 'settings/account_bank/0-4';		
		}
		$menu_data = $this->menu_handler->get_menu($last_url);
		switch($cas){
			case 0: // FOR SHOW ALL enduserS
					if($get_priviledge=='1'){// untuk admin sekolah
						$data['daftar'] = $this->mdl_content->get_all_account_active();
						$this->menu_handler->set_menu('account_list','Bank Account',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else if($get_priviledge=='5'){
						$institution_id = $this->session->userdata('institution_id');
						$data['daftar'] = $this->mdl_content->get_all_institution_filter_active($institution_id);
						$this->menu_handler->set_menu('account_list','Institution',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			case 1: // UNTUK ADD institution
					if($get_priviledge=='1'){
						$data['all_user_group'] = $this->mdl_content->get_user_group();
						$data['new_data'] = true;
						$this->menu_handler->set_menu('account_detail','Bank Account',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			case 2: // UNTUK EDIT institution
					if($get_priviledge=='1'){
						$edit_data = $this->mdl_content->get_account($status[0]);
						$data['account'] = $edit_data[0];
						$this->menu_handler->set_menu('account_detail','Bank Account',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					} 	
					break;
			case 3: // UNTUK DELETE institution MASUK TRASH
					if($get_priviledge=='1'){
						$data['daftar'] = $this->mdl_content->get_all_account_active();
						$this->mdl_content->delete_account($status[0]);
						$data['daftar'] = $this->mdl_content->get_all_account_active();
						$data['status'] = 'Data has been deleted';
						$data['alert'] = 'alert alert-success';
						$this->menu_handler->set_menu('account_list','Bank Account',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			case 4: // UNTUK TAMPILKAN TRASH institution
					if($get_priviledge=='1'){
						$data['daftar'] = $this->mdl_content->get_all_account_deactive();
						$this->menu_handler->set_menu('account_trash','Bank Trash',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			case 5: // UNTUK RESTORE institution
					if($get_priviledge=='1'){
						$this->mdl_content->restore_account($status[0]);
						$data['daftar'] = $this->mdl_content->get_all_account_deactive();								
						$data['status'] = 'Data has been restored';
						$data['alert'] = 'alert alert-success';
						$this->menu_handler->set_menu('account_trash','Bank Trash',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			case 6: // UNTUK DELETE institution PERMANEN
					if($get_priviledge=='1'){
						$this->mdl_content->delete_account_permanen($status[0]);
						$data['daftar'] = $this->mdl_content->get_all_account_deactive();
						$data['status'] = 'Data has been permanently deleted';
						$data['alert'] = 'alert alert-success';
						$this->menu_handler->set_menu('account_trash','Bank Trash',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			
			default:
					if($get_priviledge=='1'){
						$data['daftar'] = $this->mdl_content->get_all_account_active();
						$this->menu_handler->set_menu('account_list','Bank Account',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
		}
	}
	
	function view_account(){
		// $last_url = 'account_user/account_bank/0-0';
		// $menu_data = $this->menu_handler->get_menu($last_url);
		$get_priviledge = $this->session->userdata('user_group_id');
		$institution_id = $this->session->userdata('institution_id');
		$user_id = $this->session->userdata('id');
		$result = $this->mdl_content->view_account($user_id);
		// $profil = $this->mdl_content->view_profile($user_id);
		// print_r($user_id);
		// die();
		$data['account']=$result[0];
		$this->menu_handler->set_menu('account_detail','Akun &amp; Profil',$data,5,9);

	}


	function add_account(){
		$last_url = 'settings/account_bank/0-0';
		$menu_data = $this->menu_handler->get_menu($last_url);
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['new_data'] = true;
		if($get_priviledge=='1'){
			$result = $this->mdl_content->add_account();
			$data['daftar'] = $this->mdl_content->get_all_account_active();
			if($result == 1){
					$data['daftar'] = $this->mdl_content->get_all_account_active();
					$data['status'] = "Data has been added.";
					$data['alert'] = 'alert alert-success';
					$this->menu_handler->set_menu('account_list','Bank Account',$data,5,9);
			} else if($result == 2){
				$data['status'] = "Sorry, Data name has been used";
				$data['alert'] = 'alert alert-danger';
				$this->menu_handler->set_menu('account_detail','Bank Account',$data,5,9);
			} else {
				$data['alert'] = 'alert alert-danger';
				$data['status'] = "Please check again!!!";
				$this->menu_handler->set_menu('account_detail','Bank Account',$data,5,9);
			}
		} else {
			$this->menu_handler->error();
		}
	}
	
	// function edit_account($id_institution, $status=''){
	// 	$last_url = 'settings/account_bank/0-0';
	// 	$menu_data = $this->menu_handler->get_menu($last_url);
	// 	$get_priviledge = $this->session->userdata('user_group_id');
	// 	if($get_priviledge=='1'){
	// 		if($id_institution =='save'){
	// 			$result = $this->mdl_content->edit_account($this->input->post('id'));
	// 			if($result==1){
	// 				$data['daftar'] = $this->mdl_content->get_all_account_active();
	// 				$data['status'] = "Data has been updated.";
	// 				$data['alert'] = 'alert alert-success';
	// 				$this->menu_handler->set_menu('account_list','Bank Account',$data,5,9);
	// 			} else {
	// 				$data['status'] = "Please check again!!!";
	// 				$data['alert'] = 'alert alert-danger';
	// 				$this->edit_account($this->input->post('id'),$data);
	// 			}
	// 		}else{
	// 			$edit_institution = $this->mdl_content->get_account($this->input->post('id'));
	// 			$data['account'] = $edit_institution[0];
	// 			$data['status'] = "Please check again!!!";
	// 			$data['alert'] = 'alert alert-danger';
	// 			$this->menu_handler->set_menu('account_detail','Bank Account',$data,5,9);			
	// 		}
	// 	} else {
	// 		$this->menu_handler->error();
	// 	}
	// }

	function edit_account($id_enduser, $status=''){
		// print_r($_POST);
		// die();
		// $last_url = 'enduser/enduser_crud/0-0';
		// $menu_data = $this->menu_handler->get_menu($last_url);
		$get_priviledge = $this->session->userdata('user_group_id');
		
		if($id_enduser =='save'){
			$result = $this->mdl_content->edit_enduser($this->input->post('id'));
			if($result==1){
				$data['status'] = "Akun berhasil diperbaharui";
				$data['alert'] = 'alert alert-success';
				$result = $this->mdl_content->view_account($this->input->post('id'));
				$data['account']=$result[0];
				$this->menu_handler->set_menu('account_detail','Akun &amp; Profil',$data,5,9);
			}else if($result==4){
				$data['status'] = "Akun berhasil diperbaharui &amp password telah diubah";
				$data['alert'] = 'alert alert-success';
				$result = $this->mdl_content->view_account($this->input->post('id'));
				$data['account']=$result[0];
				$this->menu_handler->set_menu('account_detail','Akun &amp; Profil',$data,5,9);
			}if($result==3){
				$data['status'] = "Password Lama salah, Mohon Periksa kembali.";
				$data['alert'] = 'alert alert-danger';
				$result = $this->mdl_content->view_account($this->input->post('id'));
				$data['account']=$result[0];
				$this->menu_handler->set_menu('account_detail','Akun &amp; Profil',$data,5,9);
			}else if($result==2){
				$data['status'] = "Password baru tidak sama dengan konfirmasi password baru, mohon periksa kembali";
				$data['alert'] = 'alert alert-danger';
				$result = $this->mdl_content->view_account($this->input->post('id'));
				$data['account']=$result[0];
				$this->menu_handler->set_menu('account_detail','Akun &amp; Profil',$data,5,9);
			} else {
				$data['status'] = "Please check again!!!";
				$data['alert'] = 'alert alert-danger';
				$result = $this->mdl_content->view_account($this->input->post('id'));
				$data['account']=$result[0];
				$this->menu_handler->set_menu('account_detail','Akun &amp; Profil',$data,5,9);
			}
		} else{
			// $data['enduser'] = $edit_enduser[0];
			$data['status'] = "Please check again!!!";
			$data['alert'] = 'alert alert-danger';
			$result = $this->mdl_content->view_account($this->input->post('id'));
			$data['account']=$result[0];
			$this->menu_handler->set_menu('account_detail','Akun &amp; Profil',$data,5,9);			
		}
		
	}


	function change_profile_picture(){
		// print_r($this->input->post());
		// die();
		$imgName = $_POST['img'];
		$enduser_id = $this->input->post('enduser_id');
        	
        	
    	if( $_POST['img']==''){
    		$imgName = 'img_profile_'.$enduser_id.'_'.time().'.jpg';
    	}
    	$_POST['img'] =$imgName;

    	

		$config['file_name']			= $imgName;
        $config['upload_path']          = FCPATH.'data/profile/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['overwrite']			= true;
        $config['max_size']             = 10000;
        $config['max_width']            = 2048;
        $config['max_height']           = 2048;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('image')){
            $error = array('error' => $this->upload->display_errors());
            $data['status']=$error['error'];
			$data['alert'] = 'alert alert-danger';

			$conditi = $error['error'];
			$conditi = strtoupper($conditi);
			$conditi = substr($conditi, 3,11);
			if($conditi == "YOU DID NOT"){
			// 	$this->edit_news_config('save');
				$data['status'] = $error['error'];
				$data['alert'] = 'alert alert-danger';
				$data['tab'] = 'activity';
				$this->profil_murid($enduser_id,$data);
			}else{
				$data['status'] = $error['error'];
				$data['alert'] = 'alert alert-danger';
				$data['tab'] = 'activity';
				$this->profil_murid($enduser_id,$data);
			}
			
        } else{
        	
   //          $data = array('upload_data' => $this->upload->data());
   //         	if($data){	
		$this->mdl_content->save_profile_picture($enduser_id);
			$data['status'] = "Profil Foto telah diubah";
			$data['alert'] = 'alert alert-success';
			$data['tab'] = 'activity';
			redirect('dashboard/dashboard_crud/0-0');
			// }
        }

	}

	
	
}