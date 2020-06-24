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

	function add_data(){
		$dob = str_replace('/', '-', $this->input->post('dob'));
				$datedob = date('Y-m-d', strtotime($dob));
		$c_data = $this->cek_data('anggota','name',$this->input->post('name'));
		// if ($c_data==0){
			if($this->input->post('name')) {

				$record_detail = array(
						'name' => trim($this->input->post('name')),
						'address' => trim($this->input->post('address')),
						'phone' => trim($this->input->post('phone')),
						'pob' => trim($this->input->post('pob')),
						'dob' => $datedob,
						'father' => trim($this->input->post('father')),
						'gfather' => trim($this->input->post('gfather')),
						'mother' => trim($this->input->post('mother')),
						'country' => trim($this->input->post('country')),
						'pend' => trim($this->input->post('pend')),
						'language' => trim($this->input->post('language')),
						'sponsor' => trim($this->input->post('sponsor')),
						'pj' => trim($this->input->post('pj')),
						'changed_by' => $this->session->userdata('username'),
						'created_date' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('username'),
						'status' =>'A',
						'proses' => 'MDC'
					);
					$this->db->insert('anggota',$record_detail);
					$id_anggota = $this->db->insert_id();

					if($this->input->post('anak')) {
					$a=json_encode($this->input->post('anak'));
					$someObject = json_decode($a);
				  
				  	for($i=0; $i<count($someObject);$i++){
				  		$data_inv = array (
							'id_anggota' => $id_anggota,
							'name' => $someObject[$i]->name,
							'anak_ke' => $someObject[$i]->no,
							'created_by' => $this->session->userdata('username'),
							'created_date' => date('Y-m-d H:i:s'),
							'changed_by' => $this->session->userdata('username'),
						);
				  			
				  		$this->db->insert('childrens',$data_inv);
				  	} }

				  	if($this->input->post('exp')) {
				  	$b=json_encode($this->input->post('exp'));
					$objectExp = json_decode($b);
				  
				  	for($y=0; $y<count($objectExp);$y++){
				  		$data_exp = array (
							'id_anggota' => $id_anggota,
							'country' => $objectExp[$y]->country,
							'time' => $objectExp[$y]->time,
							'period' => $objectExp[$y]->period,
							'end' => $objectExp[$y]->end,
							'problem' => $objectExp[$y]->problem,
							'des' => $objectExp[$y]->des,
							'created_by' => $this->session->userdata('username'),
							'created_date' => date('Y-m-d H:i:s'),
							'changed_by' => $this->session->userdata('username'),
						);
				  			
				  		$this->db->insert('pengalaman',$data_exp);
				  	} }

				  	if($this->input->post('ahli')) {
				  	$c=json_encode($this->input->post('ahli'));
					$objectAhli = json_decode($c);
				  
				  	for($n=0; $n<count($objectAhli);$n++){
				  		$data_ahli = array (
							'id_anggota' => $id_anggota,
							'ahli' => $objectAhli[$n]->ahli,
							'ket' => $objectAhli[$n]->ket,
							'created_by' => $this->session->userdata('username'),
							'created_date' => date('Y-m-d H:i:s'),
							'changed_by' => $this->session->userdata('username'),
						);
				  			
				  		$this->db->insert('keahlian',$data_ahli);
				  	} }
					$tes = 1;
					return $tes;			
			}else {
				$tes = 0;
				return $tes;
			}
		// }else{
		// 	$tes = 2;
		// 	return $tes;
		// }			
	}

	function edit_data($id){
		$dob = str_replace('/', '-', $this->input->post('dob'));
				$datedob = date('Y-m-d', strtotime($dob));
		$a = $this->db->select('*')->where('id',$id)->get('anggota')->result();
		$cok = $this->cek_data('anggota','name',$this->input->post('name'));
			if($this->input->post('id')){

				$record_detail = array(
						'name' => trim($this->input->post('name')),
						'address' => trim($this->input->post('address')),
						'phone' => trim($this->input->post('phone')),
						'pob' => trim($this->input->post('pob')),
						'dob' => $datedob,
						'father' => trim($this->input->post('father')),
						'gfather' => trim($this->input->post('gfather')),
						'mother' => trim($this->input->post('mother')),
						'country' => trim($this->input->post('country')),
						'pend' => trim($this->input->post('pend')),
						'language' => trim($this->input->post('language')),
						'sponsor' => trim($this->input->post('sponsor')),
						'pj' => trim($this->input->post('pj')),
						'changed_by' => $this->session->userdata('username'),
					);
				$this->db->where('id',$id)->update('anggota',$record_detail);
				return 1;				
			}else{
				return 0;
			}
		//}
	}

	function get_all_data_active(){
		$sql = "SELECT a.*, b. name as countryname, 
				c.name as statusproses, d.name as agen, 
				e.name as sponsorname
				FROM anggota as a 
				LEFT JOIN country as b ON (a.country = b.id)
				LEFT JOIN status as c ON (a.proses = c.code)
				LEFT JOIN agent as d ON (a.agent = d.id)
				LEFT JOIN sponsor as e ON (a.sponsor = e.id)
				WHERE a.status = 'A'
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
		$hasil_query = $this->db->select('*')->from('anggota')->where('id',$id)->get()->result();
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

	function get_all_country(){
		$sql = "SELECT * 
				FROM country
				ORDER BY name ASC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_all_doc(){
		$sql = "SELECT * 
				FROM kelengkapan
				ORDER BY id ASC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_all_masakan(){
		$sql = "SELECT * 
				FROM masakan
				ORDER BY id ASC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function edit_medical($id){
			if($this->input->post('medical')){
				if($this->input->post('medical')=='FIT') {
					$proses = 'PSP';
				} else {
					$proses = 'CC';
				}
				$record_detail = array(
						'medical' => trim($this->input->post('medical')),
						'proses' => $proses,
						'changed_by' => $this->session->userdata('username'),
					);
				$this->db->where('id',$id)->update('anggota',$record_detail);

				$datafile = $_FILES;
				if(!empty($_FILES['image']['name'])) {
				$config['upload_path']          = './data/doc/';
		        $config['allowed_types']        = 'jpg|jpeg|png|pdf|doc|docx';
				$config['overwrite']			= true;
		        $config['max_size']             = 10000;
		        $config['max_width']            = 2048;
		        $config['max_height']           = 2048;
				 $this->load->library('upload', $config);
				   $this->upload->initialize($config);
				   for($count=0; $count<count($_FILES["image"]["name"]); $count++)
				   {
				   	$_FILES["file"]["name"] = $_FILES['image']['name'][$count];
				    $_FILES["file"]["type"] = $_FILES["image"]["type"][$count];
				    $_FILES["file"]["tmp_name"] = $_FILES["image"]["tmp_name"][$count];
				    $_FILES["file"]["error"] = $_FILES["image"]["error"][$count];
				    $_FILES["file"]["size"] = $_FILES["image"]["size"][$count];
				    if($this->upload->do_upload('file'))
				    {
				     $data = $this->upload->data();
				     	$imgName = $data['file_name'];
				     	$save_doc = array(
						'file' => $imgName,
						'anggota_id' => $id,
						'proses' => 'MDC',
						'status' => 'A',
						'created_by' => $this->session->userdata('username'),
						'created_date' => date('Y-m-d H:i:s')
						);
				
					$this->db->insert('documents',$save_doc);
				    }
				}
			}
				return 1;				
			}else{
				return 0;
			}
		//}
	}

	function edit_paspor($id){
			$d_pengajuan = str_replace('/', '-', $this->input->post('d_pengajuan'));
				$pengajuan = date('Y-m-d', strtotime($d_pengajuan));
			$d_buat = str_replace('/', '-', $this->input->post('d_buat'));
				$buat = date('Y-m-d', strtotime($d_buat));
			$d_expired = str_replace('/', '-', $this->input->post('d_expired'));
				$expired = date('Y-m-d', strtotime($d_expired));
			$d_serah = str_replace('/', '-', $this->input->post('d_serah'));
				$serah = date('Y-m-d', strtotime($d_serah));

				$record_detail = array(
						'tgl_pengajuan' => $pengajuan,
						'tgl_buat' => $buat,
						'tgl_expired' => $expired,
						'tgl_serah' => $serah,
						'proses' => 'PSJ',
						'changed_by' => $this->session->userdata('username'),
					);
				$this->db->where('id',$id)->update('anggota',$record_detail);

				$datafile = $_FILES;
				if(!empty($_FILES['image']['name'])) {
				$config['upload_path']          = './data/doc/';
		        $config['allowed_types']        = 'jpg|jpeg|png|pdf|doc|docx';
				$config['overwrite']			= true;
		        $config['max_size']             = 10000;
		        $config['max_width']            = 2048;
		        $config['max_height']           = 2048;
				 $this->load->library('upload', $config);
				   $this->upload->initialize($config);
				   for($count=0; $count<count($_FILES["image"]["name"]); $count++)
				   {
				   	$_FILES["file"]["name"] = $_FILES['image']['name'][$count];
				    $_FILES["file"]["type"] = $_FILES["image"]["type"][$count];
				    $_FILES["file"]["tmp_name"] = $_FILES["image"]["tmp_name"][$count];
				    $_FILES["file"]["error"] = $_FILES["image"]["error"][$count];
				    $_FILES["file"]["size"] = $_FILES["image"]["size"][$count];
				    if($this->upload->do_upload('file'))
				    {
				     $data = $this->upload->data();
				     	$imgName = $data['file_name'];
				     	$save_doc = array(
						'file' => $imgName,
						'anggota_id' => $id,
						'proses' => 'PSP',
						'status' => 'A',
						'created_by' => $this->session->userdata('username'),
						'created_date' => date('Y-m-d H:i:s')
						);
				
					$this->db->insert('documents',$save_doc);
				    }
				}
			}
				return 1;				
	}

	function edit_psj($id){
			if($id){

				$record_detail = array(
						'proses' => trim($this->input->post('status')),
						'changed_by' => $this->session->userdata('username'),
					);
				$this->db->where('id',$id)->update('anggota',$record_detail);
				return 1;				
			}else{
				return 0;
			}
		//}
	}

	function edit_sj($id){
			$d_stempel = str_replace('/', '-', $this->input->post('d_stempel'));
				$stempel = date('Y-m-d', strtotime($d_stempel));
			$d_sidikjari = str_replace('/', '-', $this->input->post('d_sidikjari'));
				$sidikjari = date('Y-m-d', strtotime($d_sidikjari));

				$record_detail = array(
						'tgl_stempel' => $stempel,
						'tgl_sidikjari' => $sidikjari,
						'proses' => 'RTB',
						'changed_by' => $this->session->userdata('username'),
					);
				$this->db->where('id',$id)->update('anggota',$record_detail);
				return 1;				
	}

	function edit_call($id){
			$d_flight = str_replace('/', '-', $this->input->post('d_flight'));
				$flight = date('Y-m-d', strtotime($d_flight));

				$record_detail = array(
						'tgl_terbang' => $flight,
						'call_from' => trim($this->input->post('p_flight')),
						// 'proses' => 'TB',
						'changed_by' => $this->session->userdata('username'),
					);
				$this->db->where('id',$id)->update('anggota',$record_detail);

				$datafile = $_FILES;
				if(!empty($_FILES['image']['name'])) {
				$config['upload_path']          = './data/doc/';
		        $config['allowed_types']        = 'jpg|jpeg|png|pdf|doc|docx';
				$config['overwrite']			= true;
		        $config['max_size']             = 10000;
		        $config['max_width']            = 2048;
		        $config['max_height']           = 2048;
				 $this->load->library('upload', $config);
				   $this->upload->initialize($config);
				   for($count=0; $count<count($_FILES["image"]["name"]); $count++)
				   {
				   	$_FILES["file"]["name"] = $_FILES['image']['name'][$count];
				    $_FILES["file"]["type"] = $_FILES["image"]["type"][$count];
				    $_FILES["file"]["tmp_name"] = $_FILES["image"]["tmp_name"][$count];
				    $_FILES["file"]["error"] = $_FILES["image"]["error"][$count];
				    $_FILES["file"]["size"] = $_FILES["image"]["size"][$count];
				    if($this->upload->do_upload('file'))
				    {
				     $data = $this->upload->data();
				     	$imgName = $data['file_name'];
				     	$save_doc = array(
						'file' => $imgName,
						'anggota_id' => $id,
						'proses' => 'TB',
						'status' => 'A',
						'created_by' => $this->session->userdata('username'),
						'created_date' => date('Y-m-d H:i:s')
						);
				
					$this->db->insert('documents',$save_doc);
				    }
				}
			}
				return 1;				
	}

	function get_id_profile($anggota_id) {
		$sql = "SELECT a.*, b.name as statusname, c.name as tujuan 
				FROM anggota as a 
				LEFT JOIN status as b ON (a.proses = b.code)
				LEFT JOIN country as c ON (a.country = c.id)
				WHERE a.id = '".$anggota_id."'";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_file_upload($anggota_id) {
		$sql = "SELECT * FROM documents 
				WHERE anggota_id = '".$anggota_id."'";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_children_byid($anggota_id) {
		$sql = "SELECT * FROM childrens 
				WHERE id_anggota = '".$anggota_id."'
				ORDER BY id ASC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_keahlian_byid($anggota_id) {
		$sql = "SELECT * FROM keahlian 
				WHERE id_anggota = '".$anggota_id."'
				ORDER BY id ASC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_pengalaman_byid($anggota_id) {
		$sql = "SELECT * FROM pengalaman 
				WHERE id_anggota = '".$anggota_id."'
				ORDER BY id ASC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_file_byid($anggota_id) {
		$sql = "SELECT a.*, b.name as namefile FROM doc_kelengkapan as a 
				LEFT JOIN kelengkapan as b ON (a.k_id = b.id) 
				WHERE anggota_id = '".$anggota_id."'
				ORDER BY id ASC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_doc_upload($anggota_id){
		$sql = "SELECT * FROM kelengkapan 
				WHERE id NOT IN 
				(SELECT k_id FROM doc_kelengkapan 
					WHERE anggota_id = '".$anggota_id."')
				ORDER BY id ASC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function upload_doc() {
		$id 	= $this->input->post('idx');
		$jum 	= $this->input->post('jum');
		$config['upload_path']          = './data/doc/';
		$config['allowed_types']        = 'jpg|jpeg|png|pdf|doc|docx';
		$config['overwrite']			= true;
		$config['max_size']             = 10000;
		$config['max_width']            = 2048;
		$config['max_height']           = 2048;
        for ($i=1; $i <=$jum ; $i++) { 
		if(!$this->load->library('upload', $config)) {
	            $error = $this->upload->display_errors();
	            // menampilkan pesan error
	            print_r($error);
	        } else {
	        	$this->upload->initialize($config);
	        	$upload = $this->upload->do_upload('upload'.$i);
	            $result = $this->upload->data();
	            $kid = $this->input->post('kid'.$i);
	            if(!empty($upload)) {
                	$data = array (
						'anggota_id'	=> $id,
						'k_id'			=> $kid,
						'file_url'		=> $result['file_name']
						);
	                   $this->db->insert('doc_kelengkapan',$data);
	            }
	        } 
	      }
	}

	function get_transaction($anggota_id) {
		$sql = "SELECT * FROM transactions WHERE anggota_id='".$anggota_id."'
				ORDER BY created_date DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_all_account() {
		$sql = "SELECT * FROM account_list WHERE parent_id!=0 ORDER BY parent_id ASC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_all_data_rt(){
		$sql = "SELECT a.*, b. name as countryname, 
				c.name as statusproses, d.name as agen, 
				e.name as sponsorname
				FROM anggota as a 
				LEFT JOIN country as b ON (a.country = b.id)
				LEFT JOIN status as c ON (a.proses = c.code)
				LEFT JOIN agent as d ON (a.agent = d.id)
				LEFT JOIN sponsor as e ON (a.sponsor = e.id)
				WHERE a.status = 'A' AND a.proses='RTB'
				ORDER BY id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_all_data_pt(){
		$sql = "SELECT a.*, b. name as countryname, 
				c.name as statusproses, d.name as agen, 
				e.name as sponsorname
				FROM anggota as a 
				LEFT JOIN country as b ON (a.country = b.id)
				LEFT JOIN status as c ON (a.proses = c.code)
				LEFT JOIN agent as d ON (a.agent = d.id)
				LEFT JOIN sponsor as e ON (a.sponsor = e.id)
				WHERE a.status = 'A' AND a.proses='PTB'
				ORDER BY id DESC";
		$query = $this->db->query($sql)->result();
		return $query;
	}
} ?>