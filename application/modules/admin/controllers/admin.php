<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_login');
	}

	function index()
	{
		$this->load->view('admin');
	}
	
	function check($data=array()){
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		
		if(!empty($username)){
			date_default_timezone_set('Asia/Jakarta');
			$detail_login = $this->mdl_login->get_user($username);
			$tanggal = date('Y-m-d');
			$waktu = date('H:i:s');
			if ($detail_login !== FALSE && ($detail_login->password == sha1($password))){
				$validasi = $this->mdl_login->validate_session($username);
				if(isset($validasi[0])){
					$this->mdl_login->remove_session($validasi[0]->session_id);
				}	


				$user_data = array(
					$id = $detail_login->id,
					$nama = $detail_login->name,
					$user_group_id = $detail_login->user_group_id,
					$pvg_id = $detail_login->pvg_id,
					'username'=>$username,
					'name'=>$nama,
					'id'=>$id,
					'pvg_id' => $pvg_id,
					'user_group_id'=>$user_group_id,
					'tanggal'=>$tanggal,
					'waktu'=>$waktu,
					'last_access'=>time()
					);
			
				$this->session->set_userdata($user_data);
				//$this->session->set_userdata('nama');
				$ip_user =  $this->input->ip_address();
				$this->session->set_flashdata('false_login','Wrong Username / Password!');
				$this->session->set_flashdata('username',$username);
				$this->activity_logging->user_logging(0,"Login tanggal ".date('d-m-Y')." - ".$waktu." dari IP : ".$ip_user);
				
				if($user_group_id == '-1'){
					redirect('dashboard');
				}
				
			} elseif (($detail_login ===FALSE) || ($detail_login->password != sha1($password))){
				$this->session->set_flashdata('false_login','Wrong Username / Password!');
				$this->session->set_flashdata('username',$username);
			}
		}
		
		redirect('admin');
	}
	
	function logout(){		
		$ip_user =  $this->input->ip_address();	
		$this->activity_logging->user_logging(0,"Logout tanggal ".date('d-m-Y')." dari IP : ".$ip_user);
		$this->session->sess_destroy();
		redirect('admin');
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
					'name'=>$name,
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