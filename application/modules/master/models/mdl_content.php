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

	function get_all_priviledge() {
		$query = $this->db->select('*')->from('priviledge_list')->get()->result();
		return $query;
	}

	function add_data(){
				$record_detail = array(
						'name' => trim($this->input->post('name')),
						'code' => trim($this->input->post('code')),
						'created_date' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('username'),
						'status'=>'A',
					);
					$this->db->insert('country',$record_detail);
					$tes = 1;
					return $tes;				
	}

	function edit_data($id){
		$record_detail = array(
			'name' => trim($this->input->post('name')),
			'code' => trim($this->input->post('code')),
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username'),
			'status'=>'A',
		);
		$this->db->where('id',$id)->update('country',$record_detail);
		return 1;	
	}

	function get_all_data_active($institution_id){
		$sql = "SELECT a.*, b.priviledge_name as priv 
				FROM endusers as a 
				LEFT JOIN priviledge_list as b 
				ON (a.pvg_id = b.id)
				WHERE a.status = 'A'
				ORDER BY id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_all_data_country(){
		$sql = "SELECT * FROM country 
				WHERE status='A'
				ORDER BY id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_all_data_deactive($institution_id){
		$sql = "SELECT * 
				FROM clients
				WHERE status = 'D' AND user_group_id ='4'
				ORDER BY id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_data($id){
		$hasil_query = $this->db->select('*')->from('country')->where('id',$id)->get()->result();
		return $hasil_query;
	}
	
	function hapus_data(){
		$id = $this->input->post('id');
		$record_detail = array(
			'status' => 'D'
		);
		$this->db->where('id',$id)->update('country',$record_detail);
	}

	function restore_data($id){
		$record_detail = array(
			'status' => 'A'
		);
		$this->db->where('id',$id)->update('clients',$record_detail);
	}
	
	function hapus_data_permanent($id_announcements_config){
		$this->db->where('id',$id_announcements_config)->delete('client');
	}

	function get_all_event_byclient($id){
		$sql = "SELECT * FROM events WHERE client_id='".$id."' AND status='A' ORDER BY id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_event_without_client() {
		$sql = "SELECT * FROM events WHERE client_id=0 AND status='A' ORDER BY id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function link_event($id){
			if($this->input->post('event_id')){
				$record_detail = array(
					'client_id' => $id,
					'changed_by' => $this->session->userdata('username'),
					);
				$this->db->where('id',$this->input->post('event_id'))->update('events',$record_detail);
				$tes =1;
				return $tes;	
			}else {
				$tes = 0;
				return $tes;
			}
		//}
	}

	function event_delete($id){
			if($id){
				$record_detail = array(
					'client_id' => 0,
					'changed_by' => $this->session->userdata('username'),
					);
				$this->db->where('id',$id)->update('events',$record_detail);
				$tes =1;
				return $tes;	
			}else {
				$tes = 0;
				return $tes;
			}
		//}
	}
} ?>