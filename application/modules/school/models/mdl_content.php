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

	function check_data_v2($table, $condition){
		$query = $this->db->select('*')->where($condition)->get($table)->result();
		return $query;
	}

	function add_school(){
		$condition = array('name' => $this->input->post('name'),'status' => 'A'
						);

		$cok = $this->check_data_v2('sekolah',$condition);

		if(count($cok)==0){
			if($this->input->post('name')){
				$record_detail = array(
						'name' => trim($this->input->post('name')),
						'address' => trim($this->input->post('address')),
						'telp' => trim($this->input->post('telp')),
						'email' => trim($this->input->post('email')),
						'accreditation' => trim($this->input->post('accreditation')),
						'curriculum' => trim($this->input->post('curriculum')),
						'implementation' => trim($this->input->post('implementation')),
						'internet' => trim($this->input->post('internet')),
						'classroom' => trim($this->input->post('classroom')),
						'laboratorium' => trim($this->input->post('laboratorium')),
						'library' => trim($this->input->post('library')),
						'surface_area' => trim($this->input->post('s_area')),
						'f_students' => trim($this->input->post('f_students')),
						'm_students' => trim($this->input->post('m_students')),
						'teachers' => trim($this->input->post('teachers')),
						'school_mng' => trim($this->input->post('school_mng')),
						'website' => trim($this->input->post('website')),
						'changed_by' => $this->session->userdata('username'),
						'created_date' => date('Y-m-d'),
						'status'=>'A'
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

	function edit_school($id){
				$record_detail = array(
						'name' => trim($this->input->post('name')),
						'address' => trim($this->input->post('address')),
						'telp' => trim($this->input->post('telp')),
						'email' => trim($this->input->post('email')),
						'accreditation' => trim($this->input->post('accreditation')),
						'curriculum' => trim($this->input->post('curriculum')),
						'implementation' => trim($this->input->post('implementation')),
						'internet' => trim($this->input->post('internet')),
						'classroom' => trim($this->input->post('classroom')),
						'laboratorium' => trim($this->input->post('laboratorium')),
						'library' => trim($this->input->post('library')),
						'surface_area' => trim($this->input->post('s_area')),
						'f_students' => trim($this->input->post('f_students')),
						'm_students' => trim($this->input->post('m_students')),
						'teachers' => trim($this->input->post('teachers')),
						'school_mng' => trim($this->input->post('school_mng')),
						'website' => trim($this->input->post('website')),
						'changed_by' => $this->session->userdata('username'),
						'created_date' => date('Y-m-d'),
						'status'=>'A'
					);
				$this->db->where('id',$id)->update('sekolah',$record_detail);
				return 1;				
	}

	function get_all_school_active(){
		$sql = "SELECT * FROM sekolah WHERE status='A'";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_school_byid($id){
		$condition = array('id' => $id);
		$query = $this->db->select('*')->where($condition)->get('sekolah')->result();
		return $query;
	}

	function get_all_data_active($institution_id){
		$sql = "SELECT a.*, b. name as countryname, c.name as statusproses,
				d.name as sponsorname
				FROM anggota as a 
				LEFT JOIN country as b ON (a.country = b.id)
				LEFT JOIN status as c ON (a.proses = c.code)
				LEFT JOIN sponsor as d ON (a.sponsor = d.id)
				WHERE a.status = 'A' AND a.proses='MDC'
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
		$hasil_query = $this->db->select('*')->from('sekolah')->where('id',$id)->get()->result();
		return $hasil_query;
	}
	
	function hapus_data($id){
		$record_detail = array(
			'status' => 'D'
		);
		$this->db->where('id',$id)->update('sekolah',$record_detail);
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
				$d_medical = str_replace('/', '-', $this->input->post('d_medical'));
				$datemedical = date('Y-m-d', strtotime($d_medical));
				if($this->input->post('medical')=='FIT') {
					$proses = 'PSP';
				} else {
					$proses = 'CC';
				}
				$record_detail = array(
						'medical' => trim($this->input->post('medical')),
						'tgl_medical' => $datemedical,
						'ket_medical' => trim($this->input->post('d_ket')),
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
						'proses' => 'TB',
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

	function edit_proses($id){
		$date_medical = str_replace('/', '-', $this->input->post('date_medical'));
				$datemedical = date('Y-m-d', strtotime($date_medical));

		$date_pengajuan = str_replace('/', '-', $this->input->post('date_pengajuan'));
				$datepengajuan = date('Y-m-d', strtotime($date_pengajuan));

		$date_buat = str_replace('/', '-', $this->input->post('date_buat'));
				$datebuat = date('Y-m-d', strtotime($date_buat));

		$date_expired = str_replace('/', '-', $this->input->post('date_expired'));
				$dateexpired = date('Y-m-d', strtotime($date_expired));

		$date_serah = str_replace('/', '-', $this->input->post('date_serah'));
				$dateserah = date('Y-m-d', strtotime($date_serah));

		$date_psj = str_replace('/', '-', $this->input->post('date_psj'));
				$datepsj = date('Y-m-d', strtotime($date_psj));

		$date_sidikjari = str_replace('/', '-', $this->input->post('date_sidikjari'));
				$datesidikjari = date('Y-m-d', strtotime($date_sidikjari));

		$date_stempel = str_replace('/', '-', $this->input->post('date_stempel'));
				$datestempel = date('Y-m-d', strtotime($date_stempel));

		$date_terbang = str_replace('/', '-', $this->input->post('date_terbang'));
				$dateterbang = date('Y-m-d', strtotime($date_terbang));
			if($this->input->post('id')){

				$record_detail = array(
						'tgl_medical' => $datemedical,
						'tgl_pengajuan' => $datepengajuan,
						'tgl_buat' => $datebuat,
						'tgl_expired' => $dateexpired,
						'tgl_serah' => $dateserah,
						'tgl_psj' => $datepsj,
						'tgl_sidikjari' => $datesidikjari,
						'tgl_stempel' => $datestempel,
						'tgl_terbang' => $dateterbang,
						'no_paspor' => trim($this->input->post('no_paspor')),
						'medical' => trim($this->input->post('medical')),
						'call_from' => trim($this->input->post('call_from')),
						'changed_by' => $this->session->userdata('username'),
					);
				$this->db->where('id',$id)->update('anggota',$record_detail);
				return 1;				
			}else{
				return 0;
			}
		//}
	}
} ?>