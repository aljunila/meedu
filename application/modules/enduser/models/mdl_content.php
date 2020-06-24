<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_content extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	
	function check_enduser($enduser){
		$query=$this->db->select('endusername')->where('endusername',$enduser)->get('enduser')->result();
		return $query;
	}
	
	function get_endusers($id){
		$query=$this->db->select('password')->where('enduserId',$id)->get('enduser')->result();
		if ($query) { 
			return $query[0];
		} else {
			return false;
		}
	}
	
	function get_all_enduser(){
		$sql = "SELECT a.*, b.name as clientName 
				FROM endusers a
				LEFT JOIN clients b
					ON a.clientId = b.clientId
				ORDER BY a.enduserId DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	// tested
	function get_all_enduser_active(){
		$sql = "SELECT a.id, a.fullname, a.username, a.user_group_id, a.nik, a.institution_id,
				a.login_status, a.user_group_id,
				IF(a.user_group_id = '1', b.name, c.name) as sekolah
				FROM endusers a
				LEFT JOIN sekolah b
				ON a.institution_id = b.id
                LEFT JOIN yayasan as c 
				ON a.institution_id = c.id
				WHERE  a.user_group_id IN(1,5)
				AND a.status ='A'
				ORDER BY a.id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
	//tested
	function get_all_enduser_deactive(){
		$sql = "SELECT a.id, a.fullname, a.username, a.user_group_id, a.nik, a.institution_id,
				a.login_status, a.user_group_id,
				IF(a.user_group_id = '1', b.name, c.name) as sekolah
				FROM endusers a
				LEFT JOIN sekolah b
				ON a.institution_id = b.id
                LEFT JOIN yayasan as c 
				ON a.institution_id = c.id
				WHERE  a.user_group_id IN(1,5)
				AND a.status ='D'
				ORDER BY a.id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_all_sekolah(){
		$hasil_query = $this->db->select('*')->from('sekolah')->where('status','A')->get()->result();
		return $hasil_query;
	}

	function get_all_yayasan(){
		$hasil_query = $this->db->select('*')->from('yayasan')->where('status','A')->get()->result();
		return $hasil_query;
	}


	function get_enduser($id_enduser){
		$hasil_query = $this->db->select('*')->from('endusers')->where('id',$id_enduser)->get()->result();
		return $hasil_query;
	}
	
	function cek_data($nm_tabel, $nm_field, $value){
		$c = $this->db->select('*')->from($nm_tabel)->where($nm_field,$value)->get()->result();
		$hasil_cek=count($c);
		return $hasil_cek;
	}

	function add_enduser(){
		if($this->input->post('user_group_id')==1){
			$institution_id=$this->input->post('institution_id');
		}else{
			$institution_id=$this->input->post('yayasan_id');
		}
		$cok = $this->cek_data('endusers','username',$this->input->post('username'));
		if ($cok==0){
			if(($this->input->post('username')) && ($this->input->post('password')) && ($this->input->post('password')==$this->input->post('re_password')) ){
				$record_detail = array(
						'fullname' => trim($this->input->post('fullname')),
						'username' => trim($this->input->post('username')),
						'password' => sha1($this->input->post('password')),
						'nik' => $this->input->post('nik'),
						'user_group_id' => $this->input->post('user_group_id'),
						'institution_id' => $institution_id,
						'changed_by' => $this->session->userdata('username'),
						'created_date' => date('Y-m-d h:i:s'),
						'created_by' => $this->session->userdata('username'),
						'status'=>'A',
					);
				// print_r($record_detail);
				// die();
					$this->db->insert('endusers',$record_detail);
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
		// } else {
		// $tes = 2;
		// return $tes;
		// }
	}

	function edit_student($id_student){
		$a = $this->db->select('*')->where('id',$id_student)->get('endusers')->result();
		$record_detail = array(
			'fullname' => trim($this->input->post('fullname')),
			'username' => trim($this->input->post('username')),
			'username' => trim($this->input->post('username')),
			'changed_by' => $this->session->userdata('username')
			);
		$this->db->where('id',$id_student)->update('endusers',$record_detail);
		return 1;				
		// }else{
		// 	return 2;
		// }
	}
	
	
	function edit_enduser($id_enduser){
		$a = $this->db->select('*')->where('id',$id_enduser)->get('endusers')->result();
		$cok = $this->cek_data('endusers','username',$this->input->post('username'));


		if($this->input->post('user_group_id')==1){
			$institution_id=$this->input->post('institution_id');
		}else{
			$institution_id=$this->input->post('yayasan_id');
		}


		if($this->input->post('password')!=null || $this->input->post('re_password')!=null){
			if($this->input->post('id')){
				$record_detail = array(
					'fullname' => trim($this->input->post('fullname')),
					'username' => trim($this->input->post('username')),
					'nik' => trim($this->input->post('nik')),
					'changed_by' => $this->session->userdata('username'),
					'institution_id' => $institution_id,
					'user_group_id' => $this->input->post('user_group_id')
					);

				
				if((empty($a[0]->password)===FALSE)&&($this->input->post('password')==$this->input->post('re_password'))){
							
						$record_detail['password']=sha1($this->input->post('password'));	
					$this->db->where('id',$id_enduser)->update('endusers',$record_detail);
					return 1;
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
					'username' => trim($this->input->post('username')),
					'nik' => trim($this->input->post('nik')),
					'changed_by' => $this->session->userdata('username'),
					'institution_id' => $institution_id,
					'user_group_id' => $this->input->post('user_group_id')
					);
				$this->db->where('id',$id_enduser)->update('endusers',$record_detail);
				return 1;				
			}else{
				return 0;
			}
		}
	}
	
	function edit_enduser_detail($id_enduser){
		$data_cek = $this->input->post(NULL,TRUE);
		$record_detail = array(
			'address'=>trim($data_cek['address']),
			'changed_by' => $this->session->userdata('username')
		);
		
		$this->db->where('id',$id_enduser)->update('endusers',$record_detail);
	}
	
	function hapus_enduser($id_enduser){
		$record_detail = array(
			'status' => 'D'
		);
		$this->db->where('id',$id_enduser)->update('endusers',$record_detail);
	}
	
	function restore_enduser($id_enduser){
		$record_detail = array(
			'status' => 'A'
		);
		$this->db->where('id',$id_enduser)->update('endusers',$record_detail);
	}
	
	function hapus_enduser_permanen($id_enduser){
		$this->db->where('id',$id_enduser)->delete('endusers');
	}
	
	function get_user_group(){
		$query = $this->db->select('*')->order_by("id","desc")->get('user_groups')->result();
		$priviledge = array();
		foreach ($query as $row){
			$priviledge[$row->id] = $row->id;
		}
		return $priviledge;
	}
	
	function get_menu($last_url){
		$query = $this->db->select('*')->where('action_url',$last_url)->get('menu')->result();
		if($query[0]->parent_id == '0'){
			$ret_val = array(
							'menu_row' => $query[0]->menu_id,
							'sub_menu_row' => 0 	
							);
		}else{
			$sub_query = $this->db->select('*')->where('menu_id',$query[0]->parent_id)->get('menu')->result();
			$ret_val = array(
							'menu_row' => $sub_query[0]->menu_id,
							'sub_menu_row' => $query[0]->menu_id	
							);
		}
		return $ret_val;
	}
} ?>