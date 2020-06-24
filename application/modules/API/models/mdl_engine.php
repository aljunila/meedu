<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_engine extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

		
	function get_user($username){
		$sql = "SELECT * from users 
				where username = '".$username."'
				AND priviledge = '3'
				";
		$query = $this->db->query($sql)->result();	
		if ($query) {
			return $query[0];
		} else {
			return false;
		}
	}


	//___DRIVER______________________________________________________________________________________
	//this query for driver data
	
	//GET PROFILE
	function driver_profile_get($driverId){
		$query = $this->db->select('*')->from('drivers')->where('driverId',$driverId)->get()->result();
		return $query;
	}

	//UPDATE PROFILE
	function driver_profile_put($driverId, $profile){
		if($idDriver){
			$this->db->where('driverId',$driverId)->update('drivers',$profile);
			$feedback = array('status' => 'success','message'=>'profile has been set');	
			return $feedback;
		}else {
			$feedback = array('status' => 'failed','message'=>'failed to update/set profile');
			return $feedback;
		}
	}

	//REGISTER 
	function driver_register_post($register){
		$statusDriver = $this->db->select('*')->from('drivers')->where('username',$dataDriver->username)->get()->result();
		if(count($statusDriver)==0){
			$dateTime= '1002-11-11 12:21:34'; //HARUS DIGANTI
			$dataDrivers = json_decode($register);
			foreach($dataDrivers as $dataDriver){
				$arrayRegister = array(
									'username' => $dataDriver->username,
									'password' => $dataDriver->password,
									'email' => $dataDriver->email,
									'createdBy' =>  $dataDriver->username,
									'createdDate' =>  $dateTime,
									'changeBy' =>  $dataDriver->nama_user
								);
				$this->db->insert('drivers',$arrayRegister);
			}
			$feedback = array('status' => 'success','message'=>'register success');	
			return $feedback;
		}else{
			$feedback = array('status' => 'failed','message'=>'username/email has already exists');
			return $feedback;
		}
	}

	//LOGIN
	function driver_login_get($username,$password){
		$query = $this->db->select('*')->from('drivers')->where('username',$username)->where('password',$password)->get()->result();
		return $query;
	}






	
	


	function get_all_customer(){
		$query = $this->db->select('*')->from('customer')->order_by('id')->get()->result();
		return $query;
	}

	function get_all_jadwal(){
		$query = $this->db->select('*')->from('jadwal')->order_by('id')->get()->result();
		return $query;
	}
	
	function cek_unique_id($unique_id){
		$c = $this->db->select('*')->from('lap_pelanggan')->where('unique_id',$unique_id)->get()->result();
		$hasil_cek=count($c);
		return $hasil_cek;
	}

	function add_engines($lap_pelanggan,$jenisgangguan,$detailsolusi,$laptest,$img_user,$img_cust,$nama_img_user,$nama_img_cust){
		$datanya="";

		$datalp = json_decode($lap_pelanggan);
		foreach($datalp as $row){
		   // foreach($users as $user){
			$laporan_pelanggan_array = array(
								'unique_id' => $row->unique_id,
								'id_pelanggan' => $row->id_pelanggan,
								'circuit_id' => $row->circuit_id,
								'bandwidth' => $row->bandwidth,
								'jenis_lay' => $row->jenis_lay,
								'interface' => $row->interface,
								'catatan_pelanggan' => $row->catatan_pelanggan,
								'img_ttd_user' => $nama_img_user,
								'img_ttd_pelanggan' => $nama_img_cust,
								'catatan_laporan' => $row->catatan_laporan,
								'tgl_jadwal' => $row->tgl_jadwal,
								'tgl_kunjungan' => $row->ch_date,
								'id_jadwal'=>$row->id_jadwal,
								'change_by' => $row->nama_user,
								'status' => 1 
							);
			$this->db->insert('lap_pelanggan',$laporan_pelanggan_array);
		   // }
		}

		$datajg = json_decode($jenisgangguan);
		foreach($datajg as $rowjg){
			$laporan_jenisgangguan_array = array(
								'unique_id' => $rowjg->unique_id,
								'kategori' => $rowjg->kategori,
								'keterangan' => $rowjg->keterangan,
								'change_by' =>  $rowjg->nama_user,
								'status' => 1 
							);
			$this->db->insert('lap_jenisgangguan',$laporan_jenisgangguan_array);
		   // }
		}

		$datads = json_decode($detailsolusi);
		foreach($datads as $rowds){
			$laporan_detailnsolusi_array = array(
								'unique_id' => $rowds->unique_id,
								'detail_gangguan' => $rowds->detail_gangguan,
								'solusi' => $rowds->solusi,
								'change_by' => $rowds->nama_user,
								'status' => 1 
							);
			$this->db->insert('lap_detailnsolusi',$laporan_detailnsolusi_array);
		   // }
		}

		$datalt = json_decode($laptest);
		foreach($datalt as $rowlt){
			$laporan_laptest_array = array(
								'unique_id' => $rowlt->unique_id,
								'deskripsi' => $rowlt->deskripsi,
								'result' => $rowlt->result,
								'status_test' => $rowlt->status_test,
								'change_by' => $rowlt->nama_user,
								'status' => 1 
							);
			$this->db->insert('lap_test',$laporan_laptest_array);
		   // }
		}
		
		
	
		return $datanya;
	}
	
}
?>