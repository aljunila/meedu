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
	
	function get_priviledge($id){
		$query=$this->db->where('id',$id)->get('priviledge_list')->result();
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
				a.login_status, a.user_group_id
				FROM endusers a
				WHERE a.status ='A'
				ORDER BY a.id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
	//tested
	function get_all_enduser_deactive(){
		$sql = "SELECT a.id, a.fullname, a.username, a.user_group_id, a.nik, a.institution_id,
				a.login_status, a.user_group_id
				FROM endusers a
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

	// function add_priviledge(){
	// 	$cok = $this->cek_data('priviledge_list','priviledge_name',$this->input->post('name'));
	// 	$class = $this->input->post('menu');
	// 	$cs = implode("|", $class);
	// 	// print_r($cs);
	// 	// die();
	// 	if ($cok==0){
	// 		if(!empty($cs)){
	// 			$record_detail = array(
	// 					'priviledge_name' => trim($this->input->post('name')),
	// 					'menu_id' => $cs,
	// 					'createdDate' => date('Y-m-d h:i:s'),
	// 					'createdBy' => $this->session->userdata('username'),
	// 					'status' => 'A'
	// 				);
	// 			// print_r($record_detail);
	// 			// die();
	// 				$this->db->insert('priviledge_list',$record_detail);
	// 				$tes = 1;
	// 				return $tes;			
	// 		}else {
	// 			$tes = 0;
	// 			return $tes;
	// 		}
	// 	}else{
	// 	$tes = 2;
	// 	return $tes;
	// 	}
	// 	// } else {
	// 	// $tes = 2;
	// 	// return $tes;
	// 	// }
	// }

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
	
	
	// function edit_priviledge($id){
	// 	$class = $this->input->post('menu');
	// 	$cs = implode("|", $class);

	// 	if(!empty($cs)){
	// 		if($this->input->post('id')){
	// 			$record_detail = array(
	// 				'priviledge_name' => trim($this->input->post('name')),
	// 				'menu_id' => $cs,
	// 				'changedBy' => $this->session->userdata('username'),
	// 				'createdDate' => date('Y-m-d h:i:s'),
	// 				'status' => 'A'
	// 				);
			
	// 				$this->db->where('id',$id)->update('priviledge_list',$record_detail);
	// 				return 1;
	// 			} else {	
	// 				//echo $this->input->post('store_name');			
	// 				return 0;
	// 			}
	// 			//die();
								
	// 		}else{
	// 			return 0;
	// 		}
	// }
	
	function edit_enduser_detail($id_enduser){
		$data_cek = $this->input->post(NULL,TRUE);
		$record_detail = array(
			'address'=>trim($data_cek['address']),
			'changed_by' => $this->session->userdata('username'),
			'changedBy' => $this->session->userdata('username'),
		);
		
		$this->db->where('id',$id_enduser)->update('endusers',$record_detail);
	}
	
	function hapus_priviledge($id){
		$record_detail = array(
			'status' => 'D'
		);
		$this->db->where('id',$id)->update('priviledge_list',$record_detail);
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

	function get_all_menu() {
		$sql = "SELECT * FROM menu WHERE parent_id=0";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_all_priviledge_active() {
		$sql = "SELECT * FROM priviledge_list WHERE status='A'";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_all_admin_active() {
			$sql = "SELECT a.*,c.name as position, b.nick_name,
				b.full_name as t_name, d.priviledge_name
				from endusers as a
				left join staff_profile as b on b.enduser_id = a.id
				LEFT JOIN position as c ON b.position = c.id
				LEFT JOIN priviledge_list as d ON a.pvg_id = d.id
				where a.status = 'A' AND (a.user_group_id = '2' OR a.user_group_id = '1')
				AND a.institution_id='".$this->session->userdata('institution_id')."'
				AND a.user_group_id='1'
				";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_all_staff_active() {
			$sql = "SELECT a.*,c.name as position, b.nick_name,
				b.full_name as t_name, d.priviledge_name
				from endusers as a
				left join staff_profile as b on b.enduser_id = a.id
				LEFT JOIN position as c ON b.position = c.id
				LEFT JOIN priviledge_list as d ON a.user_group_id = d.id
				where a.status = 'A' AND (a.user_group_id = '2' OR a.user_group_id = '1')
				AND a.institution_id='".$this->session->userdata('institution_id')."'
				";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function edit_user($id) {
		// $id = $this->input->post('id');
		// print_r($id);
		// die();
		if($id){
			$record_detail = array(
					'pvg_id' => $this->input->post('user_group'),
					'user_group_id' => 1,
					'created_date' => date('Y-m-d h:i:s')
					);
			
					$this->db->where('id',$id)->update('endusers',$record_detail);
					return 1;
				} else {	
					//echo $this->input->post('store_name');			
					return 0;
				}
	}

	function get_menu_group () {
		$sql = "SELECT * FROM menu_groups WHERE status='A' ORDER BY id";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function add_priviledge(){
		$cok = $this->cek_data('priviledge_list','priviledge_name',$this->input->post('name'));
		$class = $this->input->post('menu');
		$cs = count($class);
		// print_r($class[1]);
		// die();
		if ($cok==0){
			if(!empty($this->input->post('name'))){
				$data = array (
					'priviledge_name' => trim($this->input->post('name')),
					'status'	=> 'A',
					'createdDate' => date('Y-m-d h:i:s'),
					'createdBy' => $this->session->userdata('username'),
				);
				$this->db->insert('priviledge_list',$data);
				$idnew = $this->db->insert_id();
				for($a=0; $a<$cs; $a++) {
					$menu = $class[$a];
					$record_detail = array (
						'menu_id' => $menu,
						'user_group_id' => '1',
						'pvg_id' => $idnew,
						'created_date' => date('Y-m-d h:i:s'),
						'created_by' => $this->session->userdata('username')
					);
					$this->db->insert('priviledges',$record_detail);
				}
				$tes = 1;
				return $tes;
			}	else {
					$tes = 0;
					return $tes;
				}
		} else {
			$tes = 2;
			return $tes;
		}
	}


	function edit_priviledge($id){
		$class = $this->input->post('menu');
		$cs = count($class);
		if(!empty($this->input->post('name'))){
				$data = array (
					'priviledge_name' => trim($this->input->post('name')),
					'status'	=> 'A',
					'changedBy' => $this->session->userdata('username'),
				);
				$this->db->where('id',$id)->update('priviledge_list',$data);
				$sql = "DELETE FROM priviledges WHERE user_group_id=1 AND pvg_id='".$id."'";
				$query = $this->db->query($sql);
				for($a=0; $a<$cs; $a++) {
					$menu = $class[$a];
					$record_detail = array (
						'menu_id' => $menu,
						'user_group_id' => '1',
						'pvg_id' => $id,
						'created_date' => date('Y-m-d h:i:s'),
						'created_by' => $this->session->userdata('username')
					);
					$this->db->insert('priviledges',$record_detail);
				}
				$tes = 1;
				return $tes;
			}	else {
					$tes = 0;
					return $tes;
				}
	}

	function hapus_user($id){
		$record_detail = array(
			'user_group_id' => 2,
			'pvg_id' => 0
		);
		$this->db->where('id',$id)->update('endusers',$record_detail);
	}

	function get_menu_user($id) {
		$sql = "SELECT * FROM priviledges WHERE user_group_id=1 AND pvg_id='".$id."'";
		$query = $this->db->query($sql)->result();
		return $query;
	}
} ?>