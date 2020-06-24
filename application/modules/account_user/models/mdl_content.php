<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_content extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}


	function view_account($id){
		$sql = "SELECT a.*
				FROM endusers AS a
				WHERE a.status = 'A'
				AND a.id ='".$id."'";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function edit_enduser($id_enduser){
		$a = $this->db->select('*')->where('id',$id_enduser)->get('endusers')->result();
		$cok = $this->cek_data('endusers','username',$this->input->post('username'));

		if($this->input->post('old_password')!=null || $this->input->post('password')!=null || $this->input->post('re_password')!=null){
			if($this->input->post('id')){
				$record_detail = array(
					'fullname' => trim($this->input->post('fullname')),
					// 'username' => trim($this->input->post('username')),
					'nik' => trim($this->input->post('nik')),
					'changed_by' => $this->session->userdata('username'),
					);

				
				if((sha1($this->input->post('old_password'))!=$a[0]->password) ){
					return 3;

				}else if((sha1($this->input->post('old_password'))==$a[0]->password) && (empty($a[0]->password)===FALSE) && 
					$this->input->post('password')!=null && 
					$this->input->post('re_password')!=null && 
					($this->input->post('password')==$this->input->post('re_password'))){

						$record_detail['password']=sha1($this->input->post('password'));	
					$this->db->where('id',$id_enduser)->update('endusers',$record_detail);
					return 4;
				} else {	
					//echo $this->input->post('store_name');			
					return 0;
				}
				//die();
								
			}else{
				return 0;
			}
		}else{
			if($this->input->post('id')){
				$record_detail = array(
					'fullname' => trim($this->input->post('fullname')),
					// 'username' => trim($this->input->post('username')),
					'nik' => trim($this->input->post('nik')),
					'changed_by' => $this->session->userdata('username'),
					);
				$this->db->where('id',$id_enduser)->update('endusers',$record_detail);
				return 1;				
			}else{
				return 0;
			}
		}
	}


// GROUP CRUD
	function get_all_group_active(){
		$sql = "SELECT a.id, a.name as yayasan,a.address as address, a.phone as phone,a.email,
				b.name as country,  COUNT(d.yayasan_id) as jml
				FROM yayasan a
				LEFT OUTER JOIN sekolah d on a.id = d.yayasan_id
				LEFT JOIN countries as b on b.id = a.country_id
				WHERE a.status = 'A'
				GROUP BY a.id, a.name
				ORDER BY a.id";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
	function get_all_group_deactive(){
		$sql = "SELECT a.id, a.name as yayasan,a.address as address, a.phone as phone,a.email,
				b.name as country,  COUNT(d.yayasan_id) as jml
				FROM yayasan a
				LEFT OUTER JOIN sekolah d on a.id = d.yayasan_id
				LEFT JOIN countries as b on b.id = a.country_id
				WHERE a.status = 'D'
				GROUP BY a.id, a.name
				ORDER BY a.id";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_group($id){
		$hasil_query = $this->db->select('*')->from('yayasan')->where('id',$id)->get()->result();
		return $hasil_query;
	}

	function add_group(){
		$cok = $this->cek_data('yayasan','name',$this->input->post('name'));
		if($cok==0){
			if($this->input->post('name')){
				$record_detail = array(
						'name' => trim($this->input->post('name')),
						'email' => trim($this->input->post('email')),
						'country_id' => trim($this->input->post('country_id')),
						'phone' => trim($this->input->post('phone')),
						'address' => trim($this->input->post('address')),
						'changed_by' => $this->session->userdata('username'),
						'created_date' => date('Y-m-d'),
						'created_by' => $this->session->userdata('username'),
						'status'=>'A'
					);
					$this->db->insert('yayasan',$record_detail);
					$tes = 1;
					return $tes;			
			}else {
				$tes = 0;
				return $tes;
			}
		}else{
		$tes = 2;
		return $tes;
		}
	}
	
	function edit_group($id){
		// $a = $this->db->select('*')->where('id',$id)->get('yayasan')->result();
		// $cok = $this->cek_data('yayasan','name',$this->input->post('name'));

		// if($cok==0){
		$record_detail = array(
			'name' => trim($this->input->post('name')),
			'email' => trim($this->input->post('email')),
			'country_id' => trim($this->input->post('country_id')),
			'phone' => trim($this->input->post('phone')),
			'address' => trim($this->input->post('address')),
			'changed_by' => $this->session->userdata('username')
			);
		$this->db->where('id',$id)->update('yayasan',$record_detail);
		return 1;				
		// }else{
		// return 2;
		// }
	}
	
	function delete_group($id){
		$record_detail = array(
			'status' => 'D'
		);
		$this->db->where('id',$id)->update('yayasan',$record_detail);
	}
	
	function restore_group($id){
		$record_detail = array(
			'status' => 'A'
		);
		$this->db->where('id',$id)->update('yayasan',$record_detail);
	}
	
	function delete_group_permanen($id){
		$this->db->where('id',$id)->delete('yayasan');
	}



// INSTITUTION FOR ADMIN YAYASAN

	function get_all_institution_filter_active($institution_id){
		$sql = "SELECT a.id as id, a.name as institution, a.address as address, a.phone as phone, a.active_status,
				b.name as country,
				c.name as classification,
				e.name as yayasan
				from sekolah as a
				join countries as b on b.id = a.country_id
				left join yayasan as e
				on e.id = a.yayasan_id
				left join classifications as c on a.classification = c.id
				where a.status = 'A' AND a.yayasan_id ='".$institution_id."'";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
	function get_all_institution_filter_deactive($institution_id){
		$sql = "SELECT a.id as id, a.name as institution, a.address as address, a.phone as phone, a.active_status,
				b.name as country,
				c.name as classification,
				e.name as yayasan
				from sekolah as a
				join countries as b on b.id = a.country_id
				left join yayasan as e
				on e.id = a.yayasan_id
				left join classifications as c on a.classification = c.id
				where a.status = 'D' AND a.yayasan_id ='".$institution_id."'";
		$query = $this->db->query($sql)->result();
		return $query;
	}


// BANK ACCOUNT
	function get_all_account_active(){
		$sql = "select *
				from account_bank
				where status = 'A' AND institution_id='".$this->session->userdata('institution_id')."'";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
	function get_all_account_deactive(){
		$sql = "select *
				from account_bank
				where status = 'D' AND institution_id='".$this->session->userdata('institution_id')."'";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
	function get_account($id){
		$hasil_query = $this->db->select('*')->from('account_bank')->where('id',$id)->get()->result();
		return $hasil_query;
	}

	function get_yayasans(){
		$hasil_query = $this->db->select('*')->from('yayasan')->get()->result();
		return $hasil_query;
	}
	
	function cek_data($nm_tabel, $nm_field, $value){
		$c = $this->db->select('*')->from($nm_tabel)->where($nm_field,$value)->get()->result();
		$hasil_cek=count($c);
		return $hasil_cek;
	}

	function add_account(){
		$cok = $this->cek_data('account_bank','acc_number',$this->input->post('acc_number'));
		if($cok==0){
			if($this->input->post('acc_number')){
				$record_detail = array(
						'acc_bank' => trim($this->input->post('acc_bank')),
						'acc_number' => trim($this->input->post('acc_number')),
						'acc_name' => trim($this->input->post('acc_name')),
						'branch' => trim($this->input->post('branch')),
						'institution_id' => trim($this->session->userdata('institution_id')),
						'changed_by' => $this->session->userdata('username'),
						'created_date' => date('Y-m-d'),
						'created_by' => $this->session->userdata('username'),
						'status'=>'A',
					);
					$this->db->insert('account_bank',$record_detail);
					$tes = 1;
					return $tes;			
			}else {
				$tes = 0;
				return $tes;
			}
		}else{
		$tes = 2;
		return $tes;
		}
	}
	
	
	function edit_account($id){
		// $a = $this->db->select('*')->where('id',$id_institution)->get('sekolah')->result();
		// $cok = $this->cek_data('sekolah','name',$this->input->post('name'));

		// if($cok==0){
				$record_detail = array(
					'acc_bank' => trim($this->input->post('acc_bank')),
					'acc_number' => trim($this->input->post('acc_number')),
					'acc_name' => trim($this->input->post('acc_name')),
					'branch' => trim($this->input->post('branch')),
					'changed_by' => $this->session->userdata('username')
					);
				$this->db->where('id',$id)->update('account_bank',$record_detail);
				return 1;				
		// }else{
		// return 2;
		// }
	}

	function delete_account($id){
		$record_detail = array(
			'status' => 'D'
		);
		$this->db->where('id',$id)->update('account_bank',$record_detail);
	}
	
	function restore_account($id){
		$record_detail = array(
			'status' => 'A'
		);
		$this->db->where('id',$id)->update('account_bank',$record_detail);
	}
	
	function delete_account_permanen($id){
		$this->db->where('id',$id)->delete('account_bank');
	}
	


	function add_institution_request(){
		$cok = $this->cek_data('sekolah','name',$this->input->post('name'));
		if($cok==0){
			if($this->input->post('name')){
				$record_detail = array(
						'name' => trim($this->input->post('name')),
						'email' => trim($this->input->post('email')),
						'country_id' => trim($this->input->post('country_id')),
						'yayasan_id' => trim($this->input->post('yayasan_id')),
						'classification' => trim($this->input->post('classification')),
						'phone' => trim($this->input->post('phone')),
						'address' => trim($this->input->post('address')),
						'changed_by' => $this->session->userdata('username'),
						'created_date' => date('Y-m-d'),
						'created_by' => $this->session->userdata('username'),
						'status'=>'A',
						'active_status'=>'P',
					);
					$this->db->insert('sekolah',$record_detail);
					$tes = 1;
					return $tes;			
			}else {
				$tes = 0;
				return $tes;
			}
		}else{
		$tes = 2;
		return $tes;
		}
	}

	function change_active_status($id,$status){
		$record_detail = array(
			'active_status' => $status
		);
		$this->db->where('id',$id)->update('sekolah',$record_detail);
	}
	
	function edit_institution_detail($id_institution){
		$data_cek = $this->input->post(NULL,TRUE);
		$record_detail = array(
			'address'=>trim($data_cek['address']),
			'changed_by' => $this->session->userdata('username')
		);
		
		$this->db->where('id',$id_institution)->update('users',$record_detail);
	}
	
	
	function get_user_group(){
		$query = $this->db->select('*')->order_by("id","desc")->get('user_groups')->result();
		$priviledge = array();
		foreach ($query as $row){
			$priviledge[$row->id] = $row->id;
		}
		return $priviledge;
	}
	
	function get_countries(){
		$query = $this->db->select('*')->where('status','A')->order_by("id","asc")->get('countries')->result();
		return $query;
	}

	function get_classifications(){
		$query = $this->db->select('*')->where('status','A')->order_by("id","asc")->get('classifications')->result();
		return $query;
	}

	 function save_profile_picture($enduser_id){
		$record_detail = array(
			'photo_url' => $this->input->post('img'),
			'changed_by' => $this->session->userdata('username'),
			);
	
		$this->db->where('id',$enduser_id)->update('endusers',$record_detail);
		return 1;		
	}
} ?>