<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_client extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	
	function check_partner($partner){
		$query=$this->db->select('partnername')->where('partnername',$partner)->get('partner')->result();
		return $query;
	}
	
	function get_partners($id){
		$query=$this->db->select('password')->where('partnerId',$id)->get('partner')->result();
		if ($query) { 
			return $query[0];
		} else {
			return false;
		}
	}

	function get_all_partner(){
		$sql ="SELECT * FROM partners";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
	function get_all_partner_active(){
		$sql ="SELECT * FROM partners where status ='A'";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
	function get_all_partner_deactive(){
		$sql ="SELECT * FROM partners where status ='D'";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
	function get_partner($id_partner){
		$hasil_query = $this->db->select('*')->from('clients')->where('clientId',$id_partner)->get()->result();
		return $hasil_query;
	}
	function get_vehicle($clientId){
		$sql = "SELECT cd.contractId, v.name, v.type, v.fuelType, v.lisenceNumber, v.color,d.name as driverName,d.phone,d.orderStatus, d.loginStatus, odb.pic,odb.picPhone, odb.methode, odb.pickupAddr, odb.timePickup, odb.timeClosing
			FROM vehicles v 
			INNER JOIN contractdetail cd 
			ON cd.vehicleId = v.vehicleId 
			INNER JOIN contracts c 
			ON cd.contractId = c.contractId 
			LEFT JOIN drivers d 
			ON v.driverId = d.driverId 
			LEFT JOIN orderbooks odb 
			ON d.driverId = odb.driverId 
			WHERE c.status='A' 
			AND c.clientId = '".$clientId."'
			GROUP BY v.vehicleId
			ORDER BY odb.createdDate DESC";
			$query = $this->db->query($sql)->result();
		return $query;
	}
	function get_driver($id_partner){
		$hasil_query = $this->db->select('*')->from('drivers')->where('partnerId',$id_partner)->get()->result();
		return $hasil_query;
	}

	function get_all_enduser_active_bypartner($idPartner){
		$sql = "SELECT a.*, b.name as clientName 
				FROM endusers a
				LEFT JOIN clients b
					ON a.clientId = b.clientId
				WHERE a.status = 'A'
				AND a.clientId = '".$idPartner."'
				ORDER BY a.enduserId DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
	function cek_data($nm_tabel, $nm_field, $value){
	$c = $this->db->select('*')->from($nm_tabel)->where($nm_field,$value)->get()->result();
	$hasil_cek=count($c);
	return $hasil_cek;
	}
	
	function add_partner(){
		$this->load->helper('email');
		$cok = $this->cek_data('partners','username',$this->input->post('username'));
		$coki = $this->cek_data('partners','partnercode',$this->input->post('partnercode'));
		if($coki==0){
			if ($cok==0){
				if(($this->input->post('username')) && ($this->input->post('password')) && ($this->input->post('password')==$this->input->post('re_password')) && ($this->input->post('partnercode')) && ($this->input->post('name')) && ($this->input->post('phone')) && ($this->input->post('email')) ){
						$record_detail = array(
							'partnerCode' => trim($this->input->post('partnercode')),
							'username' => trim($this->input->post('username')),
							'password' => sha1($this->input->post('password')),
							'name' => trim($this->input->post('name')),
							'email' => trim($this->input->post('email')),
							'phone' => trim($this->input->post('phone')),
							'address' => $this->input->post('address'),
							'changedBy' => $this->session->userdata('username'),
							'createdDate' => date('Y-m-d'),
							'createdBy' => $this->session->userdata('username'),
							'status'=>'A'
						);
						$this->db->insert('partners',$record_detail);
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
	
	
	function edit_partner($id_partner){
	$a = $this->db->select('*')->where('partnerId',$id_partner)->get('partners')->result();
		if($this->input->post('password')!=null || $this->input->post('re_password')!=null){
			if($this->input->post('id')){
				$record_detail = array(
					'name' => trim($this->input->post('name')),
					'partnerCode' => trim($this->input->post('partnercode')),
					'phone' => trim($this->input->post('phone')),
					'address' => $this->input->post('address'),
					'email' => trim($this->input->post('email')),
					'changedBy' => $this->session->userdata('username')
					);

				
				if((empty($a[0]->password)===FALSE)&&($this->input->post('password')==$this->input->post('re_password'))){
							
							$record_detail['password']=sha1($this->input->post('password'));
					//echo $this->input->post('password');		
					$this->db->where('partnerId',$id_partner)->update('partners',$record_detail);
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
					'partnerCode' => trim($this->input->post('partnercode')),
					'phone' => trim($this->input->post('phone')),
					'address' => $this->input->post('address'),
					'email' => trim($this->input->post('email')),
					'changedBy' => $this->session->userdata('username')
					);

				$this->db->where('partnerId',$id_partner)->update('partners',$record_detail);
				return 1;				
			}else{
				return 0;
			}

			
		}
	}
	
	function edit_partner_detail($id_partner){
		$data_cek = $this->input->post(NULL,TRUE);
		$record_detail = array(
			'address'=>trim($data_cek['address']),
			'id_city'=>trim($data_cek['id_city']),
			'change_by' => $this->session->userdata('username')
		);
		
		$this->db->where('partnerId',$id_partner)->update('partners',$record_detail);
	}
	
	function hapus_partner($id_partner){
		$record_detail = array(
			'status' => 'D'
		);
		
		$this->db->where('partnerId',$id_partner)->update('partners',$record_detail);
	}
	
	function restore_partner($id_partner){
		$record_detail = array(
			'status' => 'A'
		);
		
		$this->db->where('partnerId',$id_partner)->update('partners',$record_detail);
	}
	
	function hapus_partner_permanen($id_partner){
		$this->db->where('partnerId',$id_partner)->delete('partners');
	}
	
	function get_priviledge(){
		$query = $this->db->select('*')->order_by("id","desc")->get('user_priviledge')->result();
		$priviledge = array();
		foreach ($query as $row){
			$priviledge[$row->id] = $row->priviledge;
		}
		return $priviledge;
	}
	
	
	
}
?>