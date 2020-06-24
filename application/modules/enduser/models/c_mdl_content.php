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
	
	function get_all_enduser_active(){
		$query = $this->db->select('*')->from('users')->where('status','A')->get()->result();
		return $query;
	}
	
	function get_all_enduser_deactive(){
		$query = $this->db->select('*')->from('users')->where('status','D')->get()->result();
		return $query;
	}
	
	function get_enduser($id_enduser){
		$hasil_query = $this->db->select('*')->from('users')->where('id',$id_enduser)->get()->result();
		return $hasil_query;
	}
	
	function cek_data($nm_tabel, $nm_field, $value){
		$c = $this->db->select('*')->from($nm_tabel)->where($nm_field,$value)->get()->result();
		$hasil_cek=count($c);
		return $hasil_cek;
	}

	function add_enduser(){
		$this->load->helper('email');
		$cok = $this->cek_data('users','username',$this->input->post('username'));
		$coki = $this->cek_data('users','name',$this->input->post('email'));
		if($coki==0){
			if ($cok==0){
				if(($this->input->post('username')) && ($this->input->post('password')) && ($this->input->post('password')==$this->input->post('re_password')) && ($this->input->post('name'))  && ($this->input->post('phone')) && ($this->input->post('email')) ){
					$record_detail = array(
							'username' => trim($this->input->post('username')),
							'password' => sha1($this->input->post('password')),
							'name' => trim($this->input->post('name')),
							'email' => trim($this->input->post('email')),
							'phone' => trim($this->input->post('phone')),
							'address' => $this->input->post('address'),
							'changed_by' => $this->session->userdata('username'),
							'created_date' => date('Y-m-d'),
							'created_by' => $this->session->userdata('username'),
							'status'=>'A'
						);
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
		} else {
		$tes = 2;
		return $tes;
		}
	}
	
	
	function edit_enduser($id_enduser){
		$a = $this->db->select('*')->where('id',$id_enduser)->get('endusers')->result();
		$cok = $this->cek_data('endusers','username',$this->input->post('username'));

		if($this->input->post('password')!=null || $this->input->post('re_password')!=null){
			if($this->input->post('id')){
				$record_detail = array(
					'name' => trim($this->input->post('name')),
					'phone' => trim($this->input->post('phone')),
					'address' => $this->input->post('address'),
					'changed_by' => $this->session->userdata('username')
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
					'name' => trim($this->input->post('name')),
					'phone' => trim($this->input->post('phone')),
					'address' => $this->input->post('address'),
					'changed_by' => $this->session->userdata('username')
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