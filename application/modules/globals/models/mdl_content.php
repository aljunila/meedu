<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_content extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_all_tajar_active(){
		$condition = array('institution_id' => $this->session->userdata('institution_id'),
							'status' => 'A');
		$query = $this->db->select('*')->where($condition)->order_by('start_ta', 'desc')->get('tahun_ajaran')->result();
		return $query;
	}
	
	function get_all_tajar_deactive(){
		$condition = array('institution_id' => $this->session->userdata('institution_id'),
							'status' => 'D');
		$query = $this->db->select('*')->where($condition)->get('tahun_ajaran')->result();
		return $query;
	}
	
	function get_tajar($id_tajar){
		$sql = "SELECT 
				a.*, b.nominal as price, b.id as item_id
				FROM tahun_ajaran AS a
				LEFT JOIN item_keuangan AS b 
				ON b.ta_id = a.id
				LEFT JOIN item_categories AS c
				ON b.id_cat = c.id
				where a.institution_id = '".$this->session->userdata('institution_id')."'
				AND a.status = 'A'
				AND a.id = '".$id_tajar."'
				AND c.level ='ta'
				GROUP BY a.id";
		$query = $this->db->query($sql)->result();
		return $query;
	}
		
	function get_news($id){
		$hasil_query = $this->db->select('*')->from('news')->where('id',$id)->get()->result();
		return $hasil_query;
	}

	function cek_data($nm_tabel, $nm_field, $value){
		$c = $this->db->select('*')->from($nm_tabel)->where($nm_field,$value)->order_by('start_ta','desc')->get()->result();
		$hasil_cek=count($c);
		return $hasil_cek;
	}



	function add_tajar(){

		// $cok = $this->cek_data('tahun_ajaran','start_ta',$this->input->post('start_ta'));
		// if($cok==0){
			if($this->input->post('start_ta')){
				$record_detail = array(
						'start_ta' => $this->input->post('start_ta'),
						'end_ta' => $this->input->post('start_ta')+1,
						'institution_id' => $this->session->userdata('institution_id'),
						'changed_by' => $this->session->userdata('username'),
						'created_date' => date('Y-m-d'),
						'created_by' => $this->session->userdata('username'),
						'status'=>'A'
					);
					$this->db->trans_start();
					$this->db->insert('tahun_ajaran',$record_detail);
					$tajar_id = $this->db->insert_id();

					$record_detail2 = array(
						'name' => "Uang Pangkal Tahun Ajaran ".$this->input->post('start_ta').'/'.$this->input->post('end_ta'),
						'ta_id' => $tajar_id,
						'id_cat' => 1,
						'nominal' => trim($this->input->post('price')),
						'institution_id' => $this->session->userdata('institution_id'),
						'changed_by' => $this->session->userdata('username'),
						'created_date' => date('Y-m-d'),
						'created_by' => $this->session->userdata('username'),
						'status'=>'A'
					);
					$this->db->insert('item_keuangan',$record_detail2);
					


					$this->db->trans_complete();
					$tes = 1;
					return $tes;			
			}else {
				$tes = 0;
				return $tes;
			}
		// }else{
		// $tes = 2;
		// return $tes;
		// }
	}
	
	
	function edit_tajar($id_tajar){
		$a = $this->db->select('*')->where('id',$id_tajar)->get('tahun_ajaran')->result();
		// $cok = $this->cek_data('tahun_ajaran','name',$this->input->post('name'));

		// if(($cok==0) || ($this->input->post('name')==$a[0]->name)){
				$record_detail = array(
					// 'name' => trim($this->input->post('name')),
					// 'description' => trim($this->input->post('description')),
					'start_ta' => trim($this->input->post('start_ta')),
					'end_ta' => trim($this->input->post('end_ta')),
					'changed_by' => $this->session->userdata('username')
					);
				$this->db->where('id',$id_tajar)->update('tahun_ajaran',$record_detail);

				$record_detail2 = array(
					'nominal' => trim($this->input->post('price')),
					'institution_id' => $this->session->userdata('institution_id'),
					'changed_by' => $this->session->userdata('username'),
				);
				$this->db->where('id',$this->input->post('item_id'))->update('item_keuangan',$record_detail2);

				return 1;				
		// }else{
		// return 2;
		// }
	}
	
	function edit_tajar_detail($id_tajar){
		$data_cek = $this->input->post(NULL,TRUE);
		$record_detail = array(
			'address'=>trim($data_cek['address']),
			'changed_by' => $this->session->userdata('username')
		);
		
		$this->db->where('id',$id_tajar)->update('users',$record_detail);
	}
	
	function hapus_tajar($id_tajar){
		$record_detail = array(
			'status' => 'D'
		);
		$this->db->where('id',$id_tajar)->update('tahun_ajaran',$record_detail);
	}
	
	function restore_tajar($id_tajar){
		$record_detail = array(
			'status' => 'A'
		);
		$this->db->where('id',$id_tajar)->update('tahun_ajaran',$record_detail);
	}
	
	function hapus_tajar_permanen($id_tajar){
		$this->db->where('id',$id_tajar)->delete('tahun_ajaran');
	}
	
	function get_user_group(){
		$query = $this->db->select('*')->order_by("id","desc")->get('user_groups')->result();
		$priviledge = array();
		foreach ($query as $row){
			$priviledge[$row->id] = $row->id;
		}
		return $priviledge;
	}

	function set_active_tajar($id_tajar){
		$condition = array(
					'institution_id' => $this->session->userdata('institution_id'),
					'active_status' => 'A'
			);
		$record_detail = array(
						'active_status' => 'N',
						'changed_by' => $this->session->userdata('username')
					);
		$condition2 = array(
					'institution_id' => $this->session->userdata('institution_id'),
					'id' => $id_tajar
			);
		$record_detail2 = array(
						'active_status' => 'A',
						'changed_by' => $this->session->userdata('username')
					);
		$this->db->trans_start();
		$this->db->where($condition)->update('tahun_ajaran',$record_detail);
		$this->db->where($condition2)->update('tahun_ajaran',$record_detail2);
		$this->db->trans_complete();
		return 1;
	}
	
	function get_countries(){
		$query = $this->db->select('*')->where('status','A')->order_by("id","asc")->get('countries')->result();
		return $query;
	}

	function get_data_vt($id){
		$sql = "SELECT a.id, a.ta_id, b.start_ta ,b.end_ta, c.id as level_id, c.name as level, d.name as subject, d.institution_id
				FROM view_teacher as a
				LEFT JOIN tahun_ajaran as b
				ON a.ta_id = b.id
				LEFT JOIN tingkat_kelas as c
				ON c.id = a.level_id
				LEFT JOIN subjects as d
				ON a.subject_id = d.id
				WHERE a.status ='A'
              	AND a.id = '".$id."'
				ORDER BY a.id, a.ta_id, a.level_id ASC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_indikator_filter_active(){
		$sql = "SELECT a.*
				FROM subject_indikator as a
				WHERE a.status ='A'
              	AND a.vt_id = '".$this->input->post('vt_id')."'
				ORDER BY a.id";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_category_filter_active(){
		$sql = "SELECT a.*
				FROM score_categories as a
				WHERE a.institution_id = '".$this->input->post('institution_id')."'
              	AND a.status ='A'
              	AND a.level_id = '".$this->input->post('level_id')."'
              	AND a.ta_id='".$this->input->post('ta_id')."'
              	AND a.repeatable='Y'
              	";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_category_filter_non_repeat_active(){
		$sql = "SELECT a.*
				FROM score_categories as a
				WHERE a.institution_id = '".$this->input->post('institution_id')."'
              	AND a.status ='A'
              	AND a.level_id = '".$this->input->post('level_id')."'
              	AND a.ta_id='".$this->input->post('ta_id')."'
              	AND a.repeatable='N'
              	";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	

	function get_score_teacher_filter_active($sc_id, $si_id){
		$sql = "SELECT a.id, a.name
				FROM score_teacher as a
				WHERE a.institution_id = '".$this->input->post('institution_id')."'
              	AND a.status ='A'
              	AND a.sc_id = '".$sc_id."'
              	AND a.si_id='".$si_id."'
              	";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function check_data_v2($table, $condition){
		$query = $this->db->select('*')->where($condition)->get($table)->result();
		return $query;
	}

	function add_subject_indikator(){
		$condition = array('institution_id' => $this->input->post('institution_id'),
							'name' => $this->input->post('name'),
							'vt_id' =>$this->input->post('vt_id'),
							'ta_id'=>$this->input->post('ta_id')
							);
		$cok = $this->check_data_v2('subject_indikator',$condition);
		if(count($cok)==0){
			if($this->input->post('name')){
				$record_detail = array(
						'name' => trim($this->input->post('name')),
						'description' => trim($this->input->post('description')),
						'vt_id' => trim($this->input->post('vt_id')),
						'ta_id' => trim($this->input->post('ta_id')),
						'institution_id' => $this->input->post('institution_id'),
						'changed_by' => $this->input->post('username'),
						'created_date' => date('Y-m-d H:i:s'),
						'created_by' => $this->input->post('username'),
						'status'=>'A'
					);
					$this->db->insert('subject_indikator',$record_detail);
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

	function get_indikator($id){
		$condition = array('institution_id' => $this->input->post('institution_id'),
							'id' => $id);
		$query = $this->db->select('*')->where($condition)->get('subject_indikator')->result();
		return $query;
	}

	function edit_indikator($id){

		$record_detail = array(
			'name' => trim($this->input->post('name')),
			'description' => trim($this->input->post('description')),
			'changed_by' => $this->input->post('username'),
		);
		$this->db->where('id',$id)->update('subject_indikator',$record_detail);
		return 1;				
	}

	function get_score_teacher($id){
		$condition = array('institution_id' => $this->input->post('institution_id'),
							'id' => $id);
		$query = $this->db->select('*')->where($condition)->get('score_teacher')->result();
		return $query;
	}

	function add_score_teacher(){
		$condition = array('institution_id' => $this->input->post('institution_id'),
							'name' => $this->input->post('name'),
							'si_id' => $this->input->post('si_id'),
							'sc_id' => $this->input->post('sc_id')
							);
		$cok = $this->check_data_v2('score_teacher',$condition);

		if(count($cok)==0){
			if($this->input->post('name')){
				$record_detail = array(
						'name' => trim($this->input->post('name')),
						'si_id' => trim($this->input->post('si_id')),
						'sc_id' => trim($this->input->post('sc_id')),
						'institution_id' => $this->input->post('institution_id'),
						'changed_by' => $this->input->post('username'),
						'created_date' => date('Y-m-d H:i:s'),
						'created_by' => $this->input->post('username'),
						'status'=>'A'
					);
					$this->db->insert('score_teacher',$record_detail);
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

	function edit_score_teacher($id){
		$a = $this->db->select('*')->where('id',$id)->get('score_teacher')->result();
		$condition = array('institution_id' => $this->input->post('institution_id'),
							'name' => $this->input->post('name'),
							'si_id' => $this->input->post('si_id'),
							'sc_id' => $this->input->post('sc_id')
							);
		$cok = $this->check_data_v2('score_teacher',$condition);


		if((count($cok)==0) || ($this->input->post('name')==$a[0]->name)){
				$record_detail = array(
					'name' => trim($this->input->post('name')),
					'institution_id' => $this->input->post('institution_id'),
					'changed_by' => $this->input->post('username')
					);
				$this->db->where('id',$id)->update('score_teacher',$record_detail);
				return 1;				
		}else{
			return 2;
		}
	}

	function hapus_score_teacher_permanen($id){
		$this->db->where('id',$id)->delete('score_teacher');
	}


	function get_view_teacher_by_course($kelas_id,$enduser_id){
		$sq = "SELECT a.*
				FROM endusers as a
				WHERE a.id = '".$enduser_id."'
              	AND a.status ='A'
              	";
		$q= $this->db->query($sq)->result();
		

		if(count($q)>0){
			$institution_id = $q[0]->institution_id;
			$ta_active_id = $this->get_ta_active($institution_id);
			$sql = "SELECT a.id ,b.name as subject
			FROM view_teacher as a
			LEFT JOIN subjects as b on b.id = a.subject_id
			LEFT JOIN kelas_teacher as kt ON kt.vt_id = a.id
			LEFT JOIN tingkat_kelas as c on a.level_id = c.id
			LEFT JOIN tahun_ajaran as t ON t.id = a.ta_id
			where a.enduser_id = '".$enduser_id."' 
			AND a.institution_id ='".$institution_id."'
			AND b.status = 'A'  
			AND a.status ='A' 
			AND a.ta_id = '".$ta_active_id."'
			AND kt.kelas_id = '".$kelas_id."'
			ORDER BY a.id DESC";
			$query = $this->db->query($sql)->result();
			return $query;
		}
		
	}

	function get_course_student($course_id){
		//tambah staus A di getcourse
		$sql = "SELECT a.* , b.nis, c.fullname,e.name as kelas_next
		FROM kelas_student as a
		LEFT JOIN student_profile as b
		on a.profile_id = b.id
		LEFT JOIN endusers as c 
		on b.enduser_id = c.id
		LEFT JOIN kelas as e
		ON a.kelas_next = e.id
		WHERE a.kelas_id = '".$course_id."'
		AND c.status ='A' AND a.status ='A'
		ORDER BY  c.fullname ASC
		";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_score_category_tk($level_id,$ta_id,$enduser_id){
		$sq = "SELECT a.*
				FROM endusers as a
				WHERE a.id = '".$enduser_id."'
              	AND a.status ='A'
              	";
		$q= $this->db->query($sq)->result();

		$sql = "SELECT a.*
				FROM score_categories as a
				WHERE a.institution_id = '".$q[0]->institution_id."'
              	AND a.status ='A'
              	AND a.level_id = '".$level_id."'
              	AND a.ta_id='".$ta_id."'
              	";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_course($course_id){
		$sql = "SELECT a.id,a.name,a.tingkat_id,a.level_category, a.description , b.name as tingkat_name, 
		c.title as ta_title, c.start_ta, c.end_ta, a.ta_id,c.institution_id,
		d.fullname as walikelas, d.full_name as wali_f_name, d.nick_name as wali_n_name,
		ds.fullname as walikelas_s, ds.full_name as wali_f_name_s, ds.nick_name as wali_n_name_s, lv.name as jurusan, lv.alias_name as kode_jurusan
		FROM kelas as a
		LEFT JOIN tingkat_kelas as b
		on a.tingkat_id = b.id
		LEFT JOIN level_categories as lv
		ON a.level_category = lv.id
		LEFT JOIN tahun_ajaran as c 
		on a.ta_id = c.id
		LEFT JOIN (SELECT d.kelas_id, e.full_name, e.nick_name, f.fullname from kelas_wali AS d
			LEFT JOIN staff_profile AS e ON d.staff_id = e.id
			LEFT JOIN endusers AS f ON e.enduser_id = f.id
			WHERE (d.status = 'A' OR d.status is NULL) AND d.primary_status = 'Y'
			) as d ON d.kelas_id = a.id
		LEFT JOIN (SELECT d.kelas_id, e.full_name, e.nick_name, f.fullname from kelas_wali AS d
			LEFT JOIN staff_profile AS e ON d.staff_id = e.id
			LEFT JOIN endusers AS f ON e.enduser_id = f.id
			WHERE (d.status = 'A' OR d.status is NULL) AND d.primary_status = 'N'
			) as ds ON ds.kelas_id = a.id
		WHERE a.id = '".$course_id."'
		";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_ta_active($institution_id){
		$sql ="SELECT id 
				FROM tahun_ajaran 
				WHERE institution_id = '".$institution_id."'
				AND status = 'A'
				AND active_status ='A'
				";
		$query = $this->db->query($sql)->result();
		if(count($query)>0){
			return $query[0]->id;
		}else{
			return false;
		}
	}

	function get_all_tajar_active_2($institution_id){
		$condition = array('institution_id' => $institution_id,
							'status' => 'A');
		$query = $this->db->select('*')->where($condition)->order_by('start_ta', 'desc')->get('tahun_ajaran')->result();
		return $query;
	}

	function get_indikator_filter_active_nilai(){
		$sql = "SELECT a.*, b.ta_id, b.level_id
				FROM subject_indikator as a
				LEFT JOIN view_teacher as b
				ON a.vt_id = b.id
				WHERE a.institution_id = '".$this->input->post('institution_id')."'
              	AND a.status ='A'
              	AND a.vt_id = '".$this->input->post('vt_id')."'
				ORDER BY a.id";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_category_filter_active_nilai($level_id,$ta_id){
		$sql = "SELECT a.*
				FROM score_categories as a
				WHERE a.institution_id = '".$this->input->post('institution_id')."'
              	AND a.status ='A'
              	AND a.level_id = '".$level_id."'
              	AND a.ta_id='".$ta_id."'
              	AND a.repeatable='Y'
              	";
		$query = $this->db->query($sql)->result();
		return $query;
	}


	function get_category_filter_non_repeat_active_with_score($level_id,$ta_id,$course_id, $vt_id){
		$sql = "SELECT a.*, c.count_siswa
				FROM score_categories as a
				LEFT JOIN (SELECT count(id) count_siswa, sc_id
				FROM score_student_no_repeat
				WHERE kelas_id = '".$course_id."' AND vt_id = '".$vt_id."' GROUP BY sc_id)
				as c ON a.id = c.sc_id
				WHERE a.institution_id = '".$this->input->post('institution_id')."'
              	AND a.status ='A'
              	AND a.level_id = '".$level_id."'
              	AND a.ta_id='".$ta_id."'
              	AND a.repeatable='N'
              	";
		$query = $this->db->query($sql)->result();
		return $query;
	}


	function get_score_teacher_filter_with_presentage($sc_id, $si_id,$course_id){
		$sql = "SELECT a.id, a.name, c.count_siswa
				FROM score_teacher as a
				LEFT JOIN  (SELECT count(id) as count_siswa, st_id
					FROM score_student 
					WHERE kelas_id = '".$course_id."'
					GROUP BY st_id
				) as c
				ON a.id = c.st_id
				WHERE a.institution_id = '".$this->input->post('institution_id')."'
              	AND a.status ='A'
              	AND a.sc_id = '".$sc_id."'
              	AND a.si_id='".$si_id."'
              	";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_course_student_score($course_id, $st_id){
		$sql = "SELECT a.* , b.nis, c.fullname, ss.score, ss.id as score_id
		FROM kelas_student as a
		LEFT JOIN student_profile as b
		on a.profile_id = b.id
		LEFT JOIN endusers as c 
		on b.enduser_id = c.id
		LEFT JOIN ( SELECT score,ks_id,id
		from score_student WHERE st_id = '".$st_id."'
		)
		AS ss ON ss.ks_id = a.id
		WHERE a.kelas_id = '".$course_id."'
		AND c.status ='A'";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_subject_st_byid($vt_id,$st_id){
		$sql = "SELECT a.id, a.name, b.name as kd, d.title as score_category, e.name as subject
				FROM score_teacher as a
				LEFT JOIN subject_indikator as b ON a.si_id = b.id
				LEFT JOIN view_teacher as c ON c.id = b.vt_id
				LEFT JOIN score_categories as d ON a.sc_id = d.id
				LEFT JOIN subjects as e ON c.subject_id = e.id
				WHERE a.id = '".$st_id."'
				AND a.institution_id = '".$this->input->post('institution_id')."'
				";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function add_score_student($record_detail){
		for($o=0; $o<count($record_detail);$o++){

			if($record_detail[$o]['score_id']!=null){
				$score_id = $record_detail[$o]['score_id'];
				unset($record_detail[$o]['score_id']);
				unset($record_detail[$o]['created_by']);
				unset($record_detail[$o]['created_date']);
				unset($record_detail[$o]['status']);
				$this->db->where('id',$score_id)->update('score_student',$record_detail[$o]);
			}else{

				if($record_detail[$o]['score']!=null){
					unset($record_detail[$o]['score_id']);
					$this->db->insert('score_student',$record_detail[$o]);
				}
			}
			
		}
		$tes = 1;
		return $tes;
	}


	function add_score_student_nr($record_detail){
		for($o=0; $o<count($record_detail);$o++){

			if($record_detail[$o]['score_id']!=null){
				$score_id = $record_detail[$o]['score_id'];
				unset($record_detail[$o]['score_id']);
				unset($record_detail[$o]['created_by']);
				unset($record_detail[$o]['created_date']);
				unset($record_detail[$o]['status']);
				$this->db->where('id',$score_id)->update('score_student_no_repeat',$record_detail[$o]);
			}else{

				if($record_detail[$o]['score']!=null){
					unset($record_detail[$o]['score_id']);
					$this->db->insert('score_student_no_repeat',$record_detail[$o]);
				}
			}
			
		}
		$tes = 1;
		return $tes;
	}

	function get_course_student_score_no_repeat($course_id, $sc_id, $vt_id){
		$sql = "SELECT a.* , b.nis, c.fullname, ss.score, ss.id as score_id
		FROM kelas_student as a
		LEFT JOIN student_profile as b
		on a.profile_id = b.id
		LEFT JOIN endusers as c 
		on b.enduser_id = c.id
		LEFT JOIN ( SELECT score,ks_id,id
		from score_student_no_repeat WHERE sc_id = '".$sc_id."'
		AND vt_id = '".$vt_id."'
		)
		AS ss ON ss.ks_id = a.id
		WHERE a.kelas_id = '".$course_id."'
		AND c.status ='A'";
		$query = $this->db->query($sql)->result();
		return $query;
	}


	function get_subject_sc_byid($vt_id){
		$sql = "SELECT a.id, e.name as subject
				FROM view_teacher as a
				LEFT JOIN subjects as e ON a.subject_id = e.id
				WHERE a.id = '".$vt_id."'
				AND a.institution_id = '".$this->input->post('institution_id')."'
				";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_score_category_byid($id){
		$sql = "SELECT a.id, a.title
				FROM score_categories as a
				WHERE a.id = '".$id."'
				AND a.institution_id = '".$this->input->post('institution_id')."'
				";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_course_student_presensi($course_id){
		$tr = $this->input->post('type_range');
		$dt1 = $this->input->post('date_start');
		$dt2 = $this->input->post('date_end');

		$sqlsmtr='';
		$sqlAddon='';
		if($tr=='fdate' && $dt1!=''){
			$dte  = $dt1;
			$dt   = new DateTime();
			$date = $dt->createFromFormat('d-m-Y', $dte);
			$dt1fix =  $date->format('Y-m-d');

			$sqlAddon=" AND a.record_date='".$dt1fix."' ";

		}else if($tr=='fperiode' && $dt1!='' && $dt2!=''){
			$dte  = $dt1;
			$dt   = new DateTime();
			$date = $dt->createFromFormat('d-m-Y', $dte);
			$dt1fix =  $date->format('Y-m-d');

			$dte2  = $dt2;
			$dt2   = new DateTime();
			$date2 = $dt2->createFromFormat('d-m-Y', $dte2);
			$dt2fix =  $date2->format('Y-m-d');


			$sqlAddon=" AND ( a.record_date BETWEEN '".$dt1fix."' AND '".$dt2fix."')";

		}else if($tr=='fnolif'){
			$sqlAddon='';

		}else if($tr=='fsemester'){
			$sqlsmtr=" AND a.smt_id ='".$this->input->post('semester_id')."'"; 
		}



		$sql = "SELECT b.id, b.enduser_id, b.nis, c.fullname,a.kelas_id, d.izin, e.sakit, f.alpha
		FROM kelas_student as a
		LEFT JOIN student_profile as b ON a.profile_id = b.id
		LEFT JOIN endusers as c ON b.enduser_id = c.id
		LEFT JOIN (SELECT count(a.id) as izin , a.profile_id
			FROM absensi_siswa as a 
			WHERE a.institution_id = '".$this->input->post('institution_id')."' AND a.type = 'I' ".$sqlAddon." ".$sqlsmtr."
			GROUP BY a.profile_id
		) as d ON b.id = d.profile_id
		LEFT JOIN (SELECT count(a.id) as sakit , a.profile_id
			FROM absensi_siswa as a 
			WHERE a.institution_id = '".$this->input->post('institution_id')."' AND a.type = 'S' ".$sqlAddon." ".$sqlsmtr."
			GROUP BY a.profile_id
		) as e ON b.id = e.profile_id
		LEFT JOIN (SELECT count(a.id) as alpha , a.profile_id
			FROM absensi_siswa as a 
			WHERE a.institution_id = '".$this->input->post('institution_id')."' AND a.type = 'A' ".$sqlAddon." ".$sqlsmtr."
			GROUP BY a.profile_id
		) as f ON b.id = f.profile_id
		WHERE a.kelas_id = '".$course_id."'
		AND c.status ='A' ORDER BY c.fullname ASC";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_course_student_presensi_prepare($course_id){
		$dt1 = $this->input->post('start_date');

		$sqlAddon='';
		if($dt1!=''){
			$dte  = $dt1;
			$dt   = new DateTime();
			$date = $dt->createFromFormat('d-m-Y', $dte);
			$dt1fix =  $date->format('Y-m-d');
			$sqlAddon=" AND a.record_date='".$dt1fix."' ";
			// $sqlAddon = $dte;
		}

		$sql = "SELECT b.id, b.nis, c.fullname,a.kelas_id, d.type, d.id as abs_id, d.description
		FROM kelas_student as a
		LEFT JOIN student_profile as b ON a.profile_id = b.id
		LEFT JOIN endusers as c ON b.enduser_id = c.id
		LEFT JOIN (SELECT a.id , a.type , a.profile_id, a.description
			FROM absensi_siswa as a 
			WHERE a.institution_id = '".$this->input->post('institution_id')."' ".$sqlAddon." 
		) as d ON b.id = d.profile_id
		WHERE a.kelas_id = '".$course_id."'
		AND c.status ='A' ORDER BY c.fullname ASC ";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	
	function add_presensi_student($record_detail){
		for($o=0; $o<count($record_detail);$o++){

			if($record_detail[$o]['abs_id']!=null){
				$abs_id = $record_detail[$o]['abs_id'];
				unset($record_detail[$o]['abs_id']);
				unset($record_detail[$o]['created_by']);
				unset($record_detail[$o]['created_date']);
				unset($record_detail[$o]['status']);
				$this->db->where('id',$abs_id)->update('absensi_siswa',$record_detail[$o]);
			}else{
				if($record_detail[$o]['type']!=null){
					unset($record_detail[$o]['abs_id']);
					$this->db->insert('absensi_siswa',$record_detail[$o]);
				}
			}
			
		}
		$tes = 1;
		return $tes;
	}





} ?>