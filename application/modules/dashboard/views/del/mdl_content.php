<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Mdl_content extends CI_Model {
	
		function __construct() {
			parent::__construct();
		}
		
		function get_all_lap_pelanggan() {

			$query = "SELECT a.*, b.n_perusahaan , b.alamat, b.telp
				FROM lap_pelanggan a
				INNER JOIN customer b
					ON a.id_pelanggan = b.id
				WHERE a.status = '1'
				ORDER BY a.id";
			$hasil_query = $this->db->query($query)->result();
			return $hasil_query;
		}


		function get_count_active($table) {
			$c = $this->db->select('*')->from($table)->where('status','A')->get()->result();
			$count=count($c);
			return $count;
		}
		
		function get_all_event_trash() {
			$hasil_query = $this->db->select('*')->from('tbl_event')->where('status','0')->get()->result();
			return $hasil_query;
		}
		
		function get_unique_id($id_laporan) {

			$query = $this->db->select('unique_id')->from('lap_pelanggan')->where('id',$id_laporan)->get()->result();
			$unique_id ="";
			foreach ($query as $row){
				$unique_id = $row->unique_id;
			}
			return $unique_id;
		}


		function get_lap_pelanggan($unique_id){
			$query = "SELECT a.*, b.n_perusahaan,b.n_pelanggan , b.alamat, b.telp, b.email
					FROM lap_pelanggan a
					INNER JOIN customer b
						ON a.id_pelanggan = b.id
					WHERE a.status = '1' AND
					a.unique_id ='".$unique_id."'
					ORDER BY a.id";
			$hasil_query = $this->db->query($query)->result();
			return $hasil_query;
		}

		function get_jenisgangguan($unique_id){
			$query = $this->db->select('*')->from('lap_jenisgangguan')->where('unique_id',$unique_id)->get()->result();
			return $query;
		}
		function get_detailsolusi($unique_id){
			$query = $this->db->select('*')->from('lap_detailnsolusi')->where('unique_id',$unique_id)->get()->result();
			return $query;
		}

		function get_lap_test($unique_id){
			$query = $this->db->select('*')->from('lap_test')->where('unique_id',$unique_id)->get()->result();
			return $query;
		}




		function get_all_profil($start_date, $end_date){
			$date1= $start_date.' 00:00:00';
			$date2= $end_date.' 23:59:59';
			$sql ="SELECT a.id, a.first_name, a.last_name, a.job, a.email, a.date
				FROM tbl_profil a
				WHERE a.date 
				BETWEEN '".$date1."' AND '".$date2."'";
			$hasil_query= $this->db->query($sql)->result();
			return $hasil_query;
		}
	
		function cek_data($nm_tabel, $nm_field, $value){
			$c = $this->db->select('*')->from($nm_tabel)->where($nm_field,$value)->get()->result();
			$hasil_cek=count($c);
			return $hasil_cek;
		}
	
	function cek_refresh($value1){
	$c = $this->db->select('*')->from('event')->where('id',$value1)->get()->result();
	$hasil_cek=count($c);
	return $hasil_cek;
	}
	
	function cek_refresh1($value1, $value2){
	$c = $this->db->select('*')->from('event')->where('id',$value1)->where('kode',$value2)->get()->result();
	$hasil_cek=count($c);
	return $hasil_cek;
	}
	
	
	function add_event(){
		$cok = $this->cek_data('tbl_event','name_event',$this->input->post('name_event'));
			if ($cok==0){
				if(($this->input->post('status_quest')) && ($this->input->post('name_event')) && ($this->input->post('place')) && ($this->input->post('start_date')) && ($this->input->post('end_date')) ){
					$record_detail = array(
							'status_quest' => trim($this->input->post('status_quest')),
							'name_event' => trim($this->input->post('name_event')),
							'place' => trim($this->input->post('place')),
							'start_date' => trim($this->input->post('start_date')),
							'end_date' => trim($this->input->post('end_date'))
						);
						$this->db->insert('tbl_event',$record_detail);
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
	
	
	function edit_event($id_event){
		if(($this->input->post('name_event')) && ($this->input->post('start_date')) && ($this->input->post('end_date'))){
		$record_detail = array(
				'name_event' => trim($this->input->post('name_event')),
				'place' => trim($this->input->post('place')),
				'start_date' => trim($this->input->post('start_date')),
				'end_date' => trim($this->input->post('end_date')),
			);
			$this->db->where('id',$id_event)->update('tbl_event',$record_detail);
			$tes = 1;
			return $tes;				
		}else {
		$tes = 0;
		return $tes;
		}
	}
	
	
	function cek_id_event_all($id_event){
		$cek_invoice = $this->cek_data('invoice','id_event',$id_event);
		$cek_expense = $this->cek_data('expense','id_event',$id_event);
		if(($cek_invoice == 0) || ($cek_expense== 0)) {
			return 1;
		} else {
			return 0;
		}
	
	}
	
	function hapus_event($id_event,$start_date,$end_date){
		$date1= $start_date.' 00:00:00';
		$date2= $end_date.' 23:59:59';
		$record_detail = array(
			'status' => '0'
		);
		//$this->db->where('id',$id_event)->delete('tbl_event');
		$this->db->where('id',$id_event)->update('tbl_event',$record_detail);
		//$this->db->where("date between '$date1' and 'date2' ")->update('tbl_profil',$record_detail);
		$sql ="UPDATE tbl_profil 
		SET status = '0' 
		WHERE date 
		BETWEEN '".$date1."' AND '".$date2."'";
		$this->db->query($sql);
		
		$sql_answer ="UPDATE tbl_answer 
		SET status = '0' 
		WHERE date 
		BETWEEN '".$date1."' AND '".$date2."'";
		$this->db->query($sql_answer);
		
	}
	
	function restore_event($id_event,$start_date,$end_date){
		$date1= $start_date.' 00:00:00';
		$date2= $end_date.' 23:59:59';
		$record_detail = array(
			'status' => '1'
		);
		//$this->db->where('id',$id_event)->delete('tbl_event');
		$this->db->where('id',$id_event)->update('tbl_event',$record_detail);
		//$this->db->where("date between '$date1' and 'date2' ")->update('tbl_profil',$record_detail);
		$sql ="UPDATE tbl_profil 
		SET status = '1' 
		WHERE date 
		BETWEEN '".$date1."' AND '".$date2."'";
		$this->db->query($sql);
		
		$sql_answer ="UPDATE tbl_answer 
		SET status = '1' 
		WHERE date 
		BETWEEN '".$date1."' AND '".$date2."'";
		$this->db->query($sql_answer);
		
	}
	
	function delete_trash($id_event,$start_date,$end_date){
		$date1= $start_date.' 00:00:00';
		$date2= $end_date.' 23:59:59';
		$this->db->where('id',$id_event)->delete('tbl_event');

		$sql ="DELETE from tbl_profil 
		WHERE date 
		BETWEEN '".$date1."' AND '".$date2."'";
		$this->db->query($sql);
		
		$sql_answer ="DELETE from tbl_answer 
		WHERE date 
		BETWEEN '".$date1."' AND '".$date2."'";
		$this->db->query($sql_answer);
		
	}
	
	function get_all_quesioner(){
	//$sql="SELECT * FROM tbl_question";
	$query = $this->db->select('*')->from('tbl_question')->get()->result();
	return $query;
	}
	
	function count_responden($start_date, $end_date){
		$date1= $start_date.' 00:00:00';
		$date2= $end_date.' 23:59:59';
		$query ="SELECT nama FROM tbl_profil where status='1' AND date BETWEEN '".$date1."' AND '".$date2."'";
		$hasil_query = $this->db->query($query)->result();
		$count_query = count($hasil_query);
		return $count_query;
	}
	
	function get_quesioner($id_question){
		$this->db->select('*');
		$this->db->from('tbl_question');
		//$this->db->join('tbl_question b','a.id_question = b.id');
		$this->db->where('id',$id_question);
		$hasil_query = $this->db->get()->result();
		return $hasil_query;
		
	}
	
	function get_answer($id_question,$start_date, $end_date){
		//$this->db->select('*');
		//$this->db->from('tbl_choice a');
		//$this->db->join('tbl_question b','a.id_question = b.id');
		//$this->db->where('a.id_question',$id_question);
		$date1= $start_date.' 00:00:00';
		$date2= $end_date.' 23:59:59';
		$query = "SELECT a.*, b.*, c.nama, COUNT(*) AS jumlah
				FROM tbl_answer a

				INNER JOIN tbl_question b
					ON a.id_question = b.id
				INNER JOIN tbl_profil c
					ON a.id_profil = c.id

				WHERE a.id_question = ".$id_question."
					AND c.status ='1'
					AND a.date BETWEEN '".$date1."' AND '".$date2."'
				GROUP BY a.content";
		$hasil_query = $this->db->query($query)->result();
		return $hasil_query;
		
	}
	
	function hapus_event1($id_event,$start_date,$end_date){
		$date1= $start_date.' 00:00:00';
		$date2= $end_date.' 23:59:59';
		$record_detail = array(
			'status' => '0'
		);
		$this->db->where('id',$id_event)->update('tbl_event',$record_detail);
		$sql ="UPDATE tbl_profil 
		SET status = '0' 
		WHERE date 
		BETWEEN '".$date1."' AND '".$date2."'";
		$this->db->query($sql);
		
		$sql_answer ="UPDATE tbl_answer
		SET status = '0' 
		WHERE date 
		BETWEEN '".$date1."' AND '".$date2."'";
		$this->db->query($sql_answer);
		
	}
	
	function hapus_event2($id_event,$start_date,$end_date){
		$date1= $start_date.' 00:00:00';
		$date2= $end_date.' 23:59:59';
		$record_detail = array(
			'status' => '0'
		);
		$this->db->where('id',$id_event)->update('tbl_event',$record_detail);
		$sql ="UPDATE tbl_profil 
		SET status = '0' 
		WHERE date 
		BETWEEN '".$start_date."' AND '".$end_date."'";
		$this->db->query($sql);
		
		$sql_answer ="UPDATE tbl_answer
		SET status = '0' 
		WHERE date 
		BETWEEN '".$start_date."' AND '".$end_date."'";
		$this->db->query($sql_answer);
		
	}
	
	function restore_event1($id_event,$start_date,$end_date){
		$date1= $start_date.' 00:00:00';
		$date2= $end_date.' 23:59:59';
		$record_detail = array(
			'status' => '1'
		);
		$this->db->where('id',$id_event)->update('tbl_event',$record_detail);
		$sql ="UPDATE tbl_profil
		SET status = '1' 
		WHERE date 
		BETWEEN '".$date1."' AND '".$date2."'";
		$this->db->query($sql);
		
		$sql_answer ="UPDATE tbl_answer 
		SET status = '1' 
		WHERE date 
		BETWEEN '".$date1."' AND '".$date2."'";
		$this->db->query($sql_answer);
		
	}
	
	function restore_event2($id_event,$start_date,$end_date){
		$date1= $start_date.' 00:00:00';
		$date2= $end_date.' 23:59:59';
		$record_detail = array(
			'status' => '1'
		);
		$this->db->where('id',$id_event)->update('tbl_event',$record_detail);
		$sql ="UPDATE tbl_profil 
		SET status = '1' 
		WHERE date 
		BETWEEN '".$start_date."' AND '".$end_date."'";
		$this->db->query($sql);
		
		$sql_answer ="UPDATE tbl_answer 
		SET status = '1' 
		WHERE date 
		BETWEEN '".$start_date."' AND '".$end_date."'";
		$this->db->query($sql_answer);
		
	}
	
	function delete_trash1($id_event,$start_date,$end_date){
		$date1= $start_date.' 00:00:00';
		$date2= $end_date.' 23:59:59';
		$this->db->where('id',$id_event)->delete('tbl_event');

		$sql ="DELETE from tbl_profil
		WHERE date 
		BETWEEN '".$date1."' AND '".$date1."'";
		$this->db->query($sql);
		
		$sql_answer ="DELETE from tbl_answer 
		WHERE date 
		BETWEEN '".$date1."' AND '".$date1."'";
		$this->db->query($sql_answer);
		
	}
	
	function delete_trash2($id_event,$start_date,$end_date){
		$date1= $start_date.' 00:00:00';
		$date2= $end_date.' 23:59:59';
		$this->db->where('id',$id_event)->delete('tbl_event');

		$sql ="DELETE from tbl_profil
		WHERE date 
		BETWEEN '".$start_date."' AND '".$end_date."'";
		$this->db->query($sql);
		
		$sql_answer ="DELETE from tbl_answer 
		WHERE date 
		BETWEEN '".$start_date."' AND '".$end_date."'";
		$this->db->query($sql_answer);
		
	}
	
	//User Priviledge
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