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

	function get_priviledge(){
		$query = $this->db->select('*')->order_by("id","desc")->get('user_priviledge')->result();
		$priviledge = array();
		foreach ($query as $row){
			$priviledge[$row->id] = $row->priviledge;
		}
		return $priviledge;
	}

	function get_all_data_active(){
		$s_select = "a.*, b.user_group_id";
		$sql = "SELECT ".$s_select." 
				FROM user_message_for_school as a
				LEFT JOIN endusers as b ON b.id = a.enduser_id 
				WHERE a.status = 'A'
				AND a.institution_id= '".$this->session->userdata('institution_id')."'
				ORDER BY a.id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_all_data_deactive(){
		$s_select = "*";
		$sql = "SELECT ".$s_select." 
				FROM user_message_for_school as a
				WHERE a.status = 'D'
				AND a.institution_id= '".$this->session->userdata('institution_id')."'
				ORDER BY a.id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_data($id){
		$query = $this->db->select('*')->from('user_message_for_school')->where('id',$id)->get()->result();
		return $query;
	}

	function add_data(){
		$type_user='3';
		$c_data = $this->cek_data('user_message_for_school','username',$this->input->post('username'));
		if ($c_data==0){
			if(($this->input->post('username')) && ($this->input->post('password')) && ($this->input->post('password')==$this->input->post('re_password'))  ){

				$dn = str_replace('/', '-', $this->input->post('dob'));
				$date_dob = date('Y-m-d', strtotime($dn));


				$record_detail = array(
						'username' => trim($this->input->post('username')),
						'password' => sha1($this->input->post('password')),
						'nik' => trim($this->input->post('nik')),
						'email' => trim($this->input->post('email')),
						'nip' => trim($this->input->post('nip')),
						'id_unit' => trim($this->input->post('id_dirjen')),
						'id_sub_unit' => trim($this->input->post('id_satker')),
						'fullname' => trim($this->input->post('fullname')),
						'gender' => trim($this->input->post('gender')),
						'dob' => trim($date_dob),
						'phone' => trim($this->input->post('phone')),
						'user_group_id' => $type_user,
						'institution_id' => $this->session->userdata('institution_id'),
						'changed_by' => $this->session->userdata('username'),
						'created_date' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('username'),
						'status'=>'A',
						'active_status'=>'A'
					);
					$this->db->insert('user_message_for_school',$record_detail);
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
		$a = $this->db->select('*')->where('id',$id)->get('user_message_for_school')->result();
		$cok = $this->cek_data('user_message_for_school','username',$this->input->post('username'));

		if($this->input->post('password')!=null || $this->input->post('re_password')!=null){
			if($this->input->post('id')){
				$dn = str_replace('/', '-', $this->input->post('dob'));
				$date_dob = date('Y-m-d', strtotime($dn));

				$record_detail = array(
					'fullname' => trim($this->input->post('fullname')),
					'username' => trim($this->input->post('username')),
					'nip' => trim($this->input->post('nip')),
					'email' => trim($this->input->post('email')),
					'id_unit' => trim($this->input->post('id_dirjen')),
					'id_sub_unit' => trim($this->input->post('id_satker')),
					'nik' => trim($this->input->post('nik')),
					'dob' => trim($date_dob),
					'gender' => trim($this->input->post('gender')),
					'phone' => trim($this->input->post('phone')),
					'changed_by' => $this->session->userdata('username'),
					);

				
				if((empty($a[0]->password)===FALSE)&&($this->input->post('password')==$this->input->post('re_password'))){
					$record_detail['password']=sha1($this->input->post('password'));	
					$this->db->where('id',$id)->update('user_message_for_school',$record_detail);
					return 1;
				} else {			
					return 0;
				}				
			}else{
				return 0;
			}
		}else{
			if($this->input->post('id')){
				$dn = str_replace('/', '-', $this->input->post('dob'));
				$date_dob = date('Y-m-d', strtotime($dn));

				$record_detail = array(
					'fullname' => trim($this->input->post('fullname')),
					'username' => trim($this->input->post('username')),
					'email' => trim($this->input->post('email')),
					'nip' => trim($this->input->post('nip')),
					'id_unit' => trim($this->input->post('id_dirjen')),
					'id_sub_unit' => trim($this->input->post('id_satker')),
					'nik' => trim($this->input->post('nik')),
					'dob' => trim($date_dob),
					'gender' => trim($this->input->post('gender')),
					'phone' => trim($this->input->post('phone')),
					'changed_by' => $this->session->userdata('username'),
					);
				$this->db->where('id',$id)->update('user_message_for_school',$record_detail);
				return 1;				
			}else{
				return 0;
			}
		}
	}

	function delete_data($id){
		$record_detail = array(
			'status' => 'D'
		);
		$this->db->where('id',$id)->update('user_message_for_school',$record_detail);
	}

	function restore_data($id){
		$record_detail = array(
			'status' => 'A'
		);
		$this->db->where('id',$id)->update('user_message_for_school',$record_detail);
	}
	
	function delete_permanent_data($id){
		$this->db->where('id',$id)->delete('user_message_for_school');
	}


} ?>