<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_content extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	function cek_data($nm_tabel, $nm_field, $value){
		$c = $this->db->select('*')->from($nm_tabel)->where($nm_field,$value)->get()->result();
		$hasil_cek=count($c);
		return $hasil_cek;
	}

	function check_partner($partnerId){
		$query = $this->db->select('*')->from('partners')->where('partnerId',$partnerId)->get()->result();
		return $query;
	}
	
	function get_priviledge(){
		$query = $this->db->select('*')->order_by("id","desc")->get('user_priviledge')->result();
		$priviledge = array();
		foreach ($query as $row){
			$priviledge[$row->id] = $row->priviledge;
		}
		return $priviledge;
	}

	function get_sekolah($y_id){
		$sql = "SELECT * 
				FROM sekolah
				WHERE status = 'A'
				AND yayasan_id = '".$y_id."'
				";
		$query = $this->db->query($sql)->result();
		return $query;
	}


	

	function add_data(){
		$type_user='1';
		$c_data = $this->cek_data('endusers','username',$this->input->post('username'));
		if ($c_data==0){
			if(($this->input->post('username')) && ($this->input->post('password')) && ($this->input->post('password')==$this->input->post('re_password'))  ){

				$dn = str_replace('/', '-', $this->input->post('dob'));
				$date_dob = date('Y-m-d', strtotime($dn));


				$record_detail = array(
						'username' => trim($this->input->post('username')),
						'password' => sha1($this->input->post('password')),
						'nik' => trim($this->input->post('nik')),
						'fullname' => trim($this->input->post('fullname')),
						'email' => trim($this->input->post('email')),
						'gender' => trim($this->input->post('gender')),
						'dob' => trim($date_dob),
						'phone' => trim($this->input->post('phone')),
						'user_group_id' => $type_user,
						'institution_id' => $this->session->userdata('institution_id'),
						'changed_by' => $this->session->userdata('username'),
						'created_date' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('username'),
						'pvg_id' => trim($this->input->post('akses')),
						'status'=>'A',
						'active_status'=>'A'
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
	}

	function edit_data($id){

				$record_detail = array(
					'user_group_id' => 1,
					'pvg_id' => trim($this->input->post('akses')),
					'changed_by' => $this->session->userdata('username'),
					);
	
				$simpan = $this->db->where('id',$this->input->post('lawyer_id'))->update('endusers',$record_detail);
				if($simpan) {
					return 1;
				} else {			
					return 0;
				}				
	}

// PERUBAHAN MINOR 'table data'	
	function get_all_data_active($institution_id){
		$sql = "SELECT a.*, b.priviledge_name as akses FROM endusers as a
				LEFT JOIN priviledge_list as b 
				ON (a.pvg_id = b.id)
				WHERE a.status = 'A' AND user_group_id ='1'
				ORDER BY id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_all_data_deactive($institution_id){
		$sql = "SELECT * 
				FROM endusers
				WHERE status = 'D' AND user_group_id ='1'
				ORDER BY id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_data($id){
		$sql = "SELECT a.*, b.priviledge_name 
				FROM endusers as a
				LEFT JOIN priviledge_list as b 
				ON (a.pvg_id = b.id)
				WHERE a.id = '".$id."'
				ORDER BY id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	function hapus_data($id){
		$record_detail = array(
			'user_group_id' => '2'
		);
		$this->db->where('id',$id)->update('endusers',$record_detail);
	}

	function restore_data($id){
		$record_detail = array(
			'status' => 'A'
		);
		$this->db->where('id',$id)->update('endusers',$record_detail);
	}
	
	function hapus_data_permanent($id_announcements_config){
		$this->db->where('id',$id_announcements_config)->delete('endusers');
	}

	function get_all_priviledge() {
		$sql = "SELECT * FROM priviledge_list WHERE status='A'";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_all_lawyer(){
		$sql = "SELECT * 
				FROM endusers
				WHERE status = 'A'
				ORDER BY id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

} ?>