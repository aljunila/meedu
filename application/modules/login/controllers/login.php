<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
class Login extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_login');
	}

	function index($code=''){
		$this->load->view('login');
	}


	function check($data=array()){
		$institution_id=$this->input->post('institution_id');
		$username=$this->input->post('username');
		$password=$this->input->post('password');


		if(!empty($username)){
			date_default_timezone_set('Asia/Jakarta');
			$detail_login = $this->mdl_login->get_user($username);
			$tanggal = date('Y-m-d');
			$waktu = date('H:i:s');

			if ($detail_login !== FALSE && ($detail_login->password == sha1($password))){
				// if($detail_login->active_status=='A') {
					// print_r($detail_login->status);
					// die();
				if($detail_login->status=='A'){
					$validasi = $this->mdl_login->validate_session($username);
					
					if(isset($validasi[0])){
						$this->mdl_login->remove_session($validasi[0]->session_id);
					}	

					$user_data = array(
						$id = $detail_login->id,
						$nama = $detail_login->fullname,
						$user_group_id = $detail_login->priviledge_id,
						'username'=>$username,
						'name'=>$detail_login->fullname,
						'id'=>$id,
						'user_group_id'=>$user_group_id,
						'tanggal'=>$tanggal,
						'waktu'=>$waktu,
						'last_access'=>time()
						);
				
					$this->session->set_userdata($user_data);
					// print_r($user_data);
					// die();
					//$this->session->set_userdata('nama');
					$ip_user =  $this->input->ip_address();
					$this->session->set_flashdata('false_login','Wrong Username / Password!');
					$this->session->set_flashdata('username',$username);
					$this->activity_logging->user_logging(0,"Login tanggal ".date('d-m-Y')." - ".$waktu." dari IP : ".$ip_user);
					
					// if($user_group_id == '-1'){
						redirect('dashboard');
					// }

				}else{
					$this->session->set_flashdata('false_login','Maaf User Anda tidak aktif');
					$this->session->set_flashdata('username',$username);
				}	
			// } else {
			// 		$this->session->set_flashdata('false_login','Mohon Maaf, untuk sementara sekolah ini tidak dapat diakses, karena sedang dalam masa penangguhan (Suspended). Terimakasih');
			// 		$this->session->set_flashdata('username',$username);
			// } 

				
			} elseif (($detail_login ===FALSE) || ($detail_login->password != sha1($password))){
				$this->session->set_flashdata('false_login','Wrong Username / Password!');
				$this->session->set_flashdata('username',$username);
			}
		}

		//$institution = $this->mdl_login->get_institution_by_id($institution_id);
		
		redirect('login');
	}
	
	function logout(){		
		$institution_id=$this->session->userdata('institution_id');
		if($institution_id==''){

			$this->activity_logging->user_logging(0,"Logout tanggal ".date('d-m-Y')." dari IP : ".$ip_user);
			$this->session->sess_destroy();
			redirect('login');
		}else{
			$ip_user =  $this->input->ip_address();	
			$this->activity_logging->user_logging(0,"Logout tanggal ".date('d-m-Y')." dari IP : ".$ip_user);
			$this->session->sess_destroy();
			redirect('login');
		}
		
		// $this->index($profile_sekolah->url_code);

	}
	
	function forgot_password(){
		$this->load->view('forgot_password');
	}
		
	function sign_up_get(){
		$this->load->view('sign_up');
	} 
	
	function sign_up_save(){
		$username=$this->input->post('username');
		$detail_user = $this->mdl_login->get_user($username);
		if ($detail_user === FALSE ){
			$result = $this->mdl_login->add_user();
			$this->session->set_flashdata('false_logup','User has been created!');
			$this->session->set_flashdata('username',$username);
			
			$detail_login = $this->mdl_login->get_user($username);
			
				$validasi = $this->mdl_login->validate_session($username);
				
				if(isset($validasi[0])){
					$this->mdl_login->remove_session($validasi[0]->session_id);
				}
				$user_data = array(
					$id = $detail_login->id,
					$nama = $detail_login->name,
					$priviledge = $detail_login->priviledge,
					'username'=>$username,
					'name'=>$username,
					'id'=>$id,
					'user_group_id'=>$priviledge,
					'tanggal'=>$tanggal,
					'waktu'=>$waktu,
					'last_access'=>time()
					);
			
				$this->session->set_userdata($user_data);
				$ip_user =  $this->input->ip_address();
				$this->activity_logging->user_logging(0,"Login tanggal ".date('d-m-Y')." - ".$waktu." dari IP : ".$ip_user);
				redirect('dashboard');
				
		} elseif ($detail_user !==FALSE){
			
			$this->session->set_flashdata('false_logup','Username has been used!');
			$this->session->set_flashdata('username',$username);
		}
		
		redirect('login/sign_up_get');
	}
		
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */