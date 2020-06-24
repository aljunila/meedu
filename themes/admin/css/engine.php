<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class engine extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_engine');
	}
	
	
	function index()
	{
		$get_priviledge = $this->data_handler->user_priviledge($this->session->userdata('id'));
		$data['priviledge']=$get_priviledge;
		$data['daftar'] = $this->mdl_engine->get_all_engine();
		$this->set_header('engine','',0,$data,'engine',0,2);	
	}

	
	function mobile_login(){
		$username = $_POST['uname'];
		$password = $_POST['pwd'];

		if(!empty($username)){			
			date_default_timezone_set('Asia/Jakarta');
			$detail_login = $this->mdl_engine->get_user($username);
			
			$tanggal = date('Y-m-d');
			$waktu = date('H:i:s');
			if ($detail_login !== FALSE && ($detail_login->password == sha1($password))){
				$user_data = array(
					'username'=>$username,
					'name'=>$detail_login->nama,
					'id'=>$detail_login->id,
					'priviledge'=>$detail_login->priviledge
					);
				echo json_encode($user_data);
			} elseif (($detail_login ===FALSE) || ($detail_login->password != sha1($password))){
				echo 0;
				
			}
		}
	}

	function sync_customer(){
		$case = $_POST['case'];	

		if ($case=='customer'){
			$data_load = $this->mdl_engine->get_all_customer();
			echo json_encode($data_load);
		}else{
			$data_load = $this->mdl_engine->get_all_jadwal();
			echo json_encode($data_load);
		}
	}

	function error(){
		$this->load->view('403');	
	}
	
	function add_engines($lap_pelanggan="",$jenisgangguan="",$detailsolusi="",$laptest="",$img_user="",$img_cust="",$nama_img_user="",$nama_img_cust=""){
		$cek_unique_id = $this->mdl_engine->cek_unique_id($_POST['unique_id']);
		if($cek_unique_id==0){


			$lap_pelanggan = $_POST['lap_pelanggan'];
			$jenisgangguan = $_POST['jenisgangguan'];
			$detailsolusi = $_POST['detailsolusi'];
			$laptest = $_POST['laptest'];
			$img_user = $_POST['img_user'];
			$img_cust = $_POST['img_cust'];
			$nama_img_user= $_POST['nama_img_user'];
			$nama_img_cust= $_POST['nama_img_cust'];
			
			$nama_img1="";
			$nama_img2="";
			
			$data1 = $img_user;
			$data2 = $img_cust;
			$path1 = $_SERVER['DOCUMENT_ROOT'].'/laporanmain/data_file/user/';
			$path2 = $_SERVER['DOCUMENT_ROOT'].'/laporanmain/data_file/pelanggan/';
			// print_r($path1);die();
			if(!empty($data1)){
				define('UPLOAD_DIR', $path1);
				$img1 = $data1;
				$img1 = str_replace('data:image/png;base64,', '', $img1);
				$img1 = str_replace(' ', '+', $img1);
				$data1 = base64_decode($img1);
				$nama_img1 = uniqid() . '.png';
				$file1 = UPLOAD_DIR . $nama_img1;
				$success1 = file_put_contents($file1, $data1, FILE_APPEND | LOCK_EX);
			} else {
				$file1 = $data1;
			}
			
			if(!empty($data2)){
				define('UPLOAD_DIR2', $path2);		
				$img2 = $data2;
				$img2 = str_replace('data:image/png;base64,', '', $img2);
				$img2 = str_replace(' ', '+', $img2);
				$data2 = base64_decode($img2);
				$nama_img2 = uniqid() . '.png';
				$file2 = UPLOAD_DIR2 . $nama_img2;
				$success2 = file_put_contents($file2, $data2, FILE_APPEND | LOCK_EX);
			} else {
				$file2 = $data2;
			}
			
			$result = $this->mdl_engine->add_engines($lap_pelanggan,$jenisgangguan,$detailsolusi,$laptest,$img_user,$img_cust,$nama_img1,$nama_img2);
		

			if ($result){
				echo "1";
				
			} else {
				echo "0";
				
			}

		}else{
			echo "2";
		}
	}

}
