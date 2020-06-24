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

	function get_all_anggota_active() {
		$query = $this->db->select('*')->from('anggota')->where('status','A')->get()->result();
		return $query;
	}

	function add_data(){
			if($this->input->post('name')) {

				$record_detail = array(
						'name' => trim($this->input->post('name')),
						'code' => trim($this->input->post('code')),
						'description' => trim($this->input->post('des')),
						'parent_id' => trim($this->input->post('parent_id')),
						'created_date' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('username'),
						'status'=>'A',
					);
					$this->db->insert('account_list',$record_detail);
					$tes = 1;
					return $tes;			
			}else {
				$tes = 0;
				return $tes;
			}			
	}

	function edit_data($id){
		if($this->input->post('name')) {

				$record_detail = array(
						'name' => trim($this->input->post('name')),
						'code' => trim($this->input->post('code')),
						'description' => trim($this->input->post('des')),
						'parent_id' => trim($this->input->post('parent_id')),
						'created_date' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('username'),
						'status'=>'A',
					);
					$this->db->where('id',$id)->update('account_list',$record_detail);
					$tes = 1;
					return $tes;			
			}else {
				$tes = 0;
				return $tes;
			}	
	}

	function get_all_data_active($institution_id){
		$sql = "SELECT * 
				FROM endusers
				WHERE status = 'A'
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
		$hasil_query = $this->db->select('*')->from('endusers')->where('id',$id)->get()->result();
		return $hasil_query;
	}
	
	function hapus_data($id){
		$record_detail = array(
			'status' => 'D'
		);
		$this->db->where('id',$id)->update('client',$record_detail);
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

	function get_all_parent_account() {
		$sql = "SELECT * FROM account_list WHERE parent_id=0 ORDER BY code ASC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function add_acc(){
		$record_detail = array(
						'name' => trim($this->input->post('name')),
						'code' => trim($this->input->post('code')),
						'parent_id' => 0,
						'created_date' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('username'),
						'status'=>'A',
		);
		$this->db->insert('account_list',$record_detail);
		$tes = 1;
		return $tes;					
	}

	function get_all_account_byparent($id) {
		$sql = "SELECT a.*, b.nominal FROM account_list as a 
				LEFT JOIN cost_setup as b ON (a.id = b.acc_id)
				 WHERE parent_id='".$id."' ORDER BY code ASC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_setup($id){
		$sql = "SELECT a.id as acc_id, b.id, b.nominal
				FROM account_list as a 
				LEFT JOIN cost_setup as b ON (a.id =b.acc_id)
				WHERE a.id = '".$id."'";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function add_setup(){
			if($this->input->post('acc_id')) {

				$record_detail = array(
						'acc_id' => trim($this->input->post('acc_id')),
						'nominal' => trim($this->input->post('nominal')),
						'created_date' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('username'),
					);
					$this->db->insert('cost_setup',$record_detail);

			$record_detail = array(
				'acc_source' => '0',
				'acc_target' => trim($this->input->post('acc_id')),
				'nominal' => trim($this->input->post('nominal')),
				'description' => 'SETUP',
				'date' => date('Y-m-d'),
				'created_date' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('username'),
				'status'=>'A',
				);
			$this->db->insert('transactions',$record_detail);
			$id = $this->db->insert_id();
					$debit = array(
					'trx_id' => $id,
					'trx_date' => date('Y-m-d H:i:s'),
					'acc_id' => '0',
					'nominal' => '-'.$this->input->post('nominal'),
					'type' => 'D',
					'created_date' => date('Y-m-d H:i:s'),
					'created_by' => $this->session->userdata('username'),
					'status'=>'A',
					);
				$this->db->insert('transaction_details',$debit);

				$kredit = array(
					'trx_id' => $id,
					'trx_date' => date('Y-m-d H:i:s'),
					'acc_id' => trim($this->input->post('acc_id')),
					'nominal' => $this->input->post('nominal'),
					'type' => 'K',
					'created_date' => date('Y-m-d H:i:s'),
					'created_by' => $this->session->userdata('username'),
					'status'=>'A',
					);
				$this->db->insert('transaction_details',$kredit);
					$tes = 1;
					return $tes;			
			}else {
				$tes = 0;
				return $tes;
			}			
	}
} ?>