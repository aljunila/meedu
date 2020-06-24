<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_user extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function register_check($username,$password,$email){
	 	
		$sSelect="email";
     	$sqlEmail = "SELECT ".$sSelect." from endusers 
     			where email= '".$email."'";
		$qEmail = $this->db->query($sqlEmail)->result();

		if(count($qEmail)>0){
			$feedback = array('status' => 'Failed','message'=>'Sorry, Email already registered');	
		}else{
		 	$sSelect="*";
	     	$sql = "SELECT ".$sSelect." from endusers 
	     			where username = '".$username."'";
			$query = $this->db->query($sql)->result();
			
			if(count($query)>0){
				$feedback = array('status' => 'Failed','message'=>'Sorry, user already registered');	
			}else{
				$feedback = array('status' => 'Success','message'=>'username is available');		
			}
		}
		return $feedback;
	}



	function dataNabProduct($username,$productId,$types){
		$sSel = "a.update_date,a.nab";
	 	$sqlH = "SELECT ".$sSel." from inv_nab_history as a 
			LEFT JOIN inv_product as b on b.id = a.product_id
			where a.product_id= '".$productId."'";
		$query= $this->db->query($sqlH)->result();
		if($query>0){
			$feedback = array('status' => 'Success','message'=>$query);	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Sorry, user already registered');	
		}
		return $feedback;
	}

//REGISTER 
	function registerUser($username,$password,$phone,$email){

		$sSelect="*";
		$sql = "SELECT ".$sSelect." from endusers 
					where username= '" .$username."'
					AND password= '".$password."' 
					AND phone = '".$phone."' 
					";
		$statusDriver = $this->db->query($sql)->result();
			
		if(count($statusDriver)==0){
			$today = date("Y-m-d H:i:s");     
			$arrayRegister = array(
				'imsi' => "-",
				'name' => $username,
				'username' => $username,
				'email' => $email,
				'phone' => $phone,
				'password'=>$password,
				'createdBy' =>  $username,
				'createdDate' =>  $today,
				'changedBy' =>  $username
				);
			$this->db->insert('endusers',$arrayRegister);

			$feedback = array('status' => 'Success','message'=>'register success');	
			return $feedback;
		}else{
		 	$feedback = array('status' => 'Failed','message'=>'username or phone has already registered');
			return $feedback;
		}
	}

	//REGISTER 
	function register($register){
		$dataReg = json_decode($register);

		$sSelect="*";
		$sql = "SELECT ".$sSelect." from endusers 
					where email= '" .$dataReg[0]->email."'
					AND phone = '".$dataReg[0]->phone."'
					";
		$statusDriver = $this->db->query($sql)->result();
			
		if(count($statusDriver)==0){
			$today = date("Y-m-d H:i:s");     
			$arrayRegister = array(
				'imsi' => $dataReg[0]->name,
				'name' => $dataReg[0]->name,
				'email' => $dataReg[0]->email,
				'phone' => $dataReg[0]->phone,
				'createdBy' =>  $dataReg[0]->email,
				'createdDate' =>  $today,
				'changedBy' =>  $dataReg[0]->email
				);
			$this->db->insert('endusers',$arrayRegister);

			$feedback = array('status' => 'Success','message'=>'register success');	
			return $feedback;
		}else{
		 	$feedback = array('status' => 'Failed','message'=>'phone or email has already registered');
			return $feedback;
		}
	}


	//LOGIN
	function login($username,$password,$fcmId){
	 	$sSelect="
	 	a.id,
	 	a.username,
	 	a.fullname,
	 	a.status,
	 	a.daftar_id,
	 	a.ta_masuk_id, a.level_masuk_id, a.phone,a.nik, a.institution_id, a.pass_status, a.pass_verified, a.active_status,a.progress_status, b.name as sekolah, b.address,b.phone, b.fax, b.email,b.logo, a.user_group_id, c.name as yayasan, c.id as yayasan_id";
     	$sql = "SELECT ".$sSelect." from endusers a
     			LEFT JOIN sekolah b 
     			on a.institution_id = b.id
     			LEFT JOIN yayasan as c
     			ON c.id = b.yayasan_id
				where a.username = '".$username."'
				AND a.password = '".$password."'
				AND a.status = 'A'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
			$record_detail = array(
				'login_status' => trim('Y'),
				'changed_by' => $query[0]->username
				);
			$this->db->where('id',$query[0]->id)->update('endusers',$record_detail);
			$feedback = array('status' => 'Success','message'=>$query[0]);		
		}else{
			$feedback = array('status' => 'Failed','message'=>'wrong username / password, try again');	
		}
		return $feedback;
	}

	function logout($username,$enduserId){
	 	$sSelect="id,username,institution_id,fullname,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where username = '".$username."'
				AND id = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
			$record_detail = array(
				'login_status' => trim('N'),
				'changed_by' => $query[0]->username
				);
			$this->db->where('id',$query[0]->id)->update('endusers',$record_detail);
			$feedback = array('status' => 'Success','message'=>'Success Logout');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'wrong username / password, try again');	
		}
		return $feedback;
	}


	function getNews($username){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status, c.id as yayasan_id";
     	$sql = "SELECT ".$sSelect." from endusers as a 
     			LEFT JOIN sekolah as b ON a.institution_id = b.id
     			LEFT JOIN yayasan as c ON c.id = b.yayasan_id
				WHERE a.username = '".$username."'
				";
		$query = $this->db->query($sql)->result();

		
		if($this->input->post('user_group_id')=='5'){
			$sql = "SELECT a.*,
					IF(a.publish_domain='Y', b.name, c.name) as institusi
					FROM news as a
					LEFT JOIN yayasan as b
					ON a.institution_id = b.id
					LEFT JOIN sekolah as c
					ON a.institution_id = c.id
					WHERE a.status = 'A'
					AND (
					(a.publish_domain='Y' AND a.institution_id = '".$query[0]->yayasan_id."' AND (a.publish_to ='0' OR a.publish_to='".$query[0]->institution_id."'))
						OR
					 (a.publish_domain='S' AND a.institution_id = '".$query[0]->institution_id."' AND (a.publish_to ='0' OR a.publish_to='".$query[0]->institution_id."'))
					)
					ORDER BY a.id DESC";
			$qu = $this->db->query($sql)->result();

		}else if($this->input->post('user_group_id')=='1'){
			$sql = "SELECT a.*,
					IF(a.publish_domain='Y', b.name, c.name) as institusi
					FROM news as a
					LEFT JOIN yayasan as b
					ON a.institution_id = b.id
					LEFT JOIN sekolah as c
					ON a.institution_id = c.id
					WHERE a.status = 'A'
					AND (
					(a.publish_domain='Y' AND a.institution_id = '".$query[0]->yayasan_id."' AND (a.publish_to ='0' OR a.publish_to='".$query[0]->institution_id."'))
						OR
					 (a.publish_domain='S' AND a.institution_id = '".$query[0]->institution_id."' AND (a.publish_to ='0' OR a.publish_to='".$query[0]->institution_id."'))
					)
					ORDER BY a.id DESC";
			$qu = $this->db->query($sql)->result();
			
		}else if($this->input->post('user_group_id')=='3'){
			$sql = "SELECT a.*,
					IF(a.publish_domain='Y', b.name, c.name) as institusi
					FROM news as a
					LEFT JOIN yayasan as b
					ON a.institution_id = b.id
					LEFT JOIN sekolah as c
					ON a.institution_id = c.id
					WHERE a.status = 'A'
					AND (
					(a.publish_domain='Y' AND a.institution_id = '".$query[0]->yayasan_id."' AND (a.publish_to ='0' OR a.publish_to='".$query[0]->institution_id."'))
						OR
					 (a.publish_domain='S' AND a.institution_id = '".$query[0]->institution_id."' AND (a.publish_to ='0' OR a.publish_to='".$query[0]->institution_id."'))
					)
					ORDER BY a.id DESC";
			$qu = $this->db->query($sql)->result();
			
		}else{
			$sql = "SELECT a.*,
					IF(a.publish_domain='Y', b.name, c.name) as institusi
					FROM news as a
					LEFT JOIN yayasan as b
					ON a.institution_id = b.id
					LEFT JOIN sekolah as c
					ON a.institution_id = c.id
					WHERE a.status = 'A'
					AND (
					(a.publish_domain='Y' AND a.institution_id = '".$query[0]->yayasan_id."' AND (a.publish_to ='0' OR a.publish_to='".$query[0]->institution_id."'))
						OR
					 (a.publish_domain='S' AND a.institution_id = '".$query[0]->institution_id."' AND (a.publish_to ='0' OR a.publish_to='".$query[0]->institution_id."'))
					)
					ORDER BY a.id DESC";
			$qu = $this->db->query($sql)->result();
			
		}

		$feedback = array('status' => 'Success','message'=>$qu);
		return $feedback;

	}

	function getDataKelas($username,$ta_id){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id";
     	$sql = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.username = '".$username."'
				";
		$query = $this->db->query($sql)->result();

		$sql = "SELECT a.*, b.name as kelas_name
				FROM kelas_student as a
				INNER JOIN kelas as b
				ON a.kelas_id = b.id
				WHERE b.ta_id =  '".$ta_id."' 
				AND a.profile_id =  '".$query[0]->profile_id."' ";
		$qu = $this->db->query($sql)->result();

		$feedback = array('status' => 'Success','message'=>$qu);
		return $feedback;
	}

	function getDailyActivities($enduser_id){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id";
     	$sql = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.id = '".$enduser_id."'
				";
		$query = $this->db->query($sql)->result();


		$s_select = "a.id, a.institution_id,b.name, b.description, b.objective, a.start_date, a.end_date, a.pda_id, COUNT(e.id_soal) as soal, d.name as tingkat_psy";
		$sql2 = "SELECT ".$s_select." 
				FROM psy_daily_activities_assigned as a
				LEFT JOIN (
					SELECT id as id_soal , pda_id
					FROM psy_daily_todo_list
					) as e
				ON a.pda_id = e.pda_id
				LEFT JOIN psy_daily_activities as b
				ON a.pda_id = b.id 
				LEFT JOIN psy_level as d
				ON b.psy_level = d.id 
				WHERE a.status = 'A' AND a.institution_id = '".$query[0]->institution_id."'
				AND (a.start_date IS NOT NULL OR a.end_date IS NOT NULL)
				GROUP BY a.pda_id
				ORDER BY a.id DESC";
		
		$qu = $this->db->query($sql2)->result();

		$feedback = array('status' => 'Success','message'=>$qu);
		return $feedback;
	}

	function getProjectActivities($enduser_id){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id";
     	$sql = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.id = '".$enduser_id."'
				";
		$query = $this->db->query($sql)->result();


		$s_select = "a.id, a.institution_id,b.name, b.description, b.objective, b.hint, b.participant, a.start_date, a.end_date, a.pda_id, COUNT(e.id_soal) as soal, d.name as tingkat_psy";
		$sql2 = "SELECT ".$s_select." 
				FROM psy_projects_assigned as a
				LEFT JOIN (
					SELECT id as id_soal , pda_id
					FROM psy_project_todo_list
					) as e
				ON a.pda_id = e.pda_id
				LEFT JOIN psy_projects as b
				ON a.pda_id = b.id 
				LEFT JOIN psy_level as d
				ON b.psy_level = d.id 
				WHERE a.status = 'A' AND a.institution_id = '".$query[0]->institution_id."'
				AND (a.start_date IS NOT NULL OR a.end_date IS NOT NULL)
				GROUP BY a.pda_id
				ORDER BY a.id DESC";
		
		$qu = $this->db->query($sql2)->result();

		$feedback = array('status' => 'Success','message'=>$qu);
		return $feedback;
	}


	function getAnekdotList($enduser_id){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id";
     	$sql = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.id = '".$enduser_id."'
				";
		$query = $this->db->query($sql)->result();


		$s_select = "a.*";
		$sql2 = "SELECT ".$s_select." 
				FROM psy_anekdot_feedback as a
				WHERE a.status = 'A' AND a.institution_id = '".$query[0]->institution_id."'
				AND a.enduser_id = '".$enduser_id."'
				ORDER BY a.id DESC";
		
		$qu = $this->db->query($sql2)->result();

		$feedback = array('status' => 'Success','message'=>$qu);
		return $feedback;
	}

	function addAnekdot($enduser_id){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id,a.user_group_id";
     	$sql = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.id = '".$enduser_id."'
				";
		$query = $this->db->query($sql)->result();


		$today = date("Y-m-d H:i:s");     
		$arrayRegister = array(
			'enduser_id' => $enduser_id,
			'write_date' => $this->input->post('write_date'),
			'name' => $this->input->post('name'),
			'content' => $this->input->post('content'),
			'user_group_id' => $query[0]->user_group_id,
			'institution_id' =>  $query[0]->institution_id,
			'created_by' =>  $query[0]->username,
			'created_date' =>  $today,
			'changed_by' =>  $query[0]->username
			);
		$this->db->insert('psy_anekdot_feedback',$arrayRegister);
		

		$feedback = array('status' => 'Success','message'=>'Anekdot sukses disimpan');
		return $feedback;
	}

	function addDailyAns($enduser_id){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id,a.user_group_id";
     	$sql = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.id = '".$enduser_id."'
				";
		$query = $this->db->query($sql)->result();


		$sql1 = "SELECT * from psy_daily_todo_record 
				where enduser_id = '".$enduser_id."' 
				AND pda_id ='".$this->input->post('pda_id')."'
				AND pdt_id = '".$this->input->post('pdt_id')."'
				";
		$q1 = $this->db->query($sql1)->result();

		if(count($q1)>0){
			$feedback = array('status' => 'Faled','message'=>'Data Telah tersimpan sebelumnya');
		}else{
			$today = date("Y-m-d H:i:s");     
			$arrayRegister = array(
				'enduser_id' => $enduser_id,
				'pda_id' => $this->input->post('pda_id'),
				'pdt_id' => $this->input->post('pdt_id'),
				'ans' => 'Y',
				'institution_id' =>  $query[0]->institution_id,
				'created_by' =>  $query[0]->username,
				'created_date' =>  $today,
				'changed_by' =>  $query[0]->username
				);
			$this->db->insert('psy_daily_todo_record',$arrayRegister);
			

			$feedback = array('status' => 'Success','message'=>'Data sukses disimpan');
		}
		return $feedback;
	}
	

	function addProjectAns($enduser_id){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id,a.user_group_id";
     	$sql = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.id = '".$enduser_id."'
				";
		$query = $this->db->query($sql)->result();


		$sql1 = "SELECT * from psy_project_todo_record 
				where enduser_id = '".$enduser_id."' 
				AND pda_id ='".$this->input->post('pda_id')."'
				AND pdt_id = '".$this->input->post('pdt_id')."'
				";
		$q1 = $this->db->query($sql1)->result();

		if(count($q1)>0){
			$feedback = array('status' => 'Faled','message'=>'Data Telah tersimpan sebelumnya');
		}else{
			$today = date("Y-m-d H:i:s");     
			$arrayRegister = array(
				'enduser_id' => $enduser_id,
				'pda_id' => $this->input->post('pda_id'),
				'pdt_id' => $this->input->post('pdt_id'),
				'ans' => 'Y',
				'institution_id' =>  $query[0]->institution_id,
				'created_by' =>  $query[0]->username,
				'created_date' =>  $today,
				'changed_by' =>  $query[0]->username
				);
			$this->db->insert('psy_project_todo_record',$arrayRegister);
			

			$feedback = array('status' => 'Success','message'=>'Data sukses disimpan');
		}
		return $feedback;
	}
	


	function getTodoListProject($enduser_id,$pda_id){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id";
     	$sql = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.id = '".$enduser_id."'
				";
		$query = $this->db->query($sql)->result();


		$s_select = "a.id, a.institution_id,b.name, b.description, b.objective, b.hint, b.participant, a.start_date, a.end_date, a.pda_id, COUNT(e.id_soal) as soal, d.name as tingkat_psy";
		$sql2 = "SELECT a.* 
				FROM psy_project_todo_list as a
				WHERE a.pda_id = '".$pda_id."' ";
		$qu = $this->db->query($sql2)->result();

		$feedback = array('status' => 'Success','message'=>$qu);
		return $feedback;
	}


	function getDetailProjectActivities($enduser_id,$id){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id";
     	$sql = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.id = '".$enduser_id."'
				";
		$query = $this->db->query($sql)->result();


		$s_select = "a.id, a.institution_id,b.name, b.description, b.objective, b.hint, b.participant, a.start_date, a.end_date, a.pda_id, COUNT(e.id_soal) as soal, d.name as tingkat_psy";
		$sql2 = "SELECT ".$s_select." 
				FROM psy_projects_assigned as a
				LEFT JOIN (
					SELECT id as id_soal , pda_id
					FROM psy_project_todo_list
					) as e
				ON a.pda_id = e.pda_id
				LEFT JOIN psy_projects as b
				ON a.pda_id = b.id 
				LEFT JOIN psy_level as d
				ON b.psy_level = d.id 
				WHERE a.status = 'A' AND a.institution_id = '".$query[0]->institution_id."'
				AND a.id ='".$id."'
				GROUP BY a.pda_id
				ORDER BY a.id DESC";
		
		$qu = $this->db->query($sql2)->result();

		$feedback = array('status' => 'Success','message'=>$qu);
		return $feedback;
	}


	function getTodoListDaily($enduser_id,$pda_id){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id";
     	$sql = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.id = '".$enduser_id."'
				";
		$query = $this->db->query($sql)->result();

		$s_select = "a.id, a.institution_id,b.name, b.description, b.objective, b.hint, b.participant, a.start_date, a.end_date, a.pda_id, COUNT(e.id_soal) as soal, d.name as tingkat_psy";
		$sql2 = "SELECT a.* 
				FROM psy_daily_todo_list as a
				WHERE a.pda_id = '".$pda_id."' ";
		$qu = $this->db->query($sql2)->result();

		$feedback = array('status' => 'Success','message'=>$qu);
		return $feedback;
	}


	function getDetailDailyActivities($enduser_id,$id){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id";
     	$sql = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.id = '".$enduser_id."'
				";
		$query = $this->db->query($sql)->result();


		$s_select = "a.id, a.institution_id,b.name, b.description, b.objective, a.start_date, a.end_date, a.pda_id, COUNT(e.id_soal) as soal, d.name as tingkat_psy";
		$sql2 = "SELECT ".$s_select." 
				FROM psy_daily_activities_assigned as a
				LEFT JOIN (
					SELECT id as id_soal , pda_id
					FROM psy_daily_todo_list
					) as e
				ON a.pda_id = e.pda_id
				LEFT JOIN psy_daily_activities as b
				ON a.pda_id = b.id 
				LEFT JOIN psy_level as d
				ON b.psy_level = d.id 
				WHERE a.status = 'A' AND a.institution_id = '".$query[0]->institution_id."'
				AND a.id ='".$id."'
				GROUP BY a.pda_id
				ORDER BY a.id DESC";
		
		$qu = $this->db->query($sql2)->result();

		$feedback = array('status' => 'Success','message'=>$qu);
		return $feedback;
	}


	function getKajianParenting($enduser_id){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id";
     	$sql = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.id = '".$enduser_id."'
				";
		$query = $this->db->query($sql)->result();


		$s_select = "a.id, a.institution_id,b.name, b.description, b.objective, a.start_date, a.end_date, a.pda_id, COUNT(e.id_soal) as soal, d.name as tingkat_psy";
		$sql2 = "SELECT a.*, b.name as tingkat_sekolah, c.name as tingkat_kelas , d.name as category
				FROM psy_articles as a
				LEFT JOIN classifications as b ON a.classification = b.id
				LEFT JOIN tingkat_kelas as c ON a.level_id = c.id
				LEFT JOIN psy_categories as d ON a.psy_category = d.id
				WHERE a.status = 'A'
				ORDER BY a.id DESC";
		
		$qu = $this->db->query($sql2)->result();

		$feedback = array('status' => 'Success','message'=>$qu);
		return $feedback;
	}
	




	function getDataRaport($username){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id";
     	$sql = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.username = '".$username."'
				";
		$query = $this->db->query($sql)->result();
		$course_id = $this->input->post('course_id');

		$sql = "SELECT a.*
				FROM raport_pdf_file as a
				WHERE a.profile_id =  '".$query[0]->profile_id."' 
				AND a.kelas_id = '".$course_id."'
				";
		$qu = $this->db->query($sql)->result();

		$feedback = array('status' => 'Success','message'=>$qu);
		return $feedback;
	}


	function getDataPresensi($username, $course_id, $start_date, $end_date){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id";
     	$sql_s = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.username = '".$username."'
				";
		$q = $this->db->query($sql_s)->result();
		$profile_id = $q[0]->profile_id;
		$institution_id = $q[0]->institution_id;

		$sqlsmtr='';
		$sqlAddon='';
		$sqlAddon=" AND ( a.record_date BETWEEN '".$start_date."' AND '".$end_date."')";

		// $sqlsmtr=" AND a.smt_id ='".$this->input->post('semester_id')."'"; 

		$sql = "SELECT b.id, b.enduser_id, b.nis, c.fullname,a.kelas_id, d.izin, e.sakit, f.alpha
		FROM kelas_student as a
		LEFT JOIN student_profile as b ON a.profile_id = b.id
		LEFT JOIN endusers as c ON b.enduser_id = c.id
		LEFT JOIN (SELECT count(a.id) as izin , a.profile_id
			FROM absensi_siswa as a 
			WHERE a.institution_id = '".$institution_id."' AND a.type = 'I' ".$sqlAddon." ".$sqlsmtr."
			GROUP BY a.profile_id
		) as d ON b.id = d.profile_id
		LEFT JOIN (SELECT count(a.id) as sakit , a.profile_id
			FROM absensi_siswa as a 
			WHERE a.institution_id = '".$institution_id."' AND a.type = 'S' ".$sqlAddon." ".$sqlsmtr."
			GROUP BY a.profile_id
		) as e ON b.id = e.profile_id
		LEFT JOIN (SELECT count(a.id) as alpha , a.profile_id
			FROM absensi_siswa as a 
			WHERE a.institution_id = '".$institution_id."' AND a.type = 'A' ".$sqlAddon." ".$sqlsmtr."
			GROUP BY a.profile_id
		) as f ON b.id = f.profile_id
		WHERE a.kelas_id = '".$course_id."'
		AND a.profile_id = '".$profile_id."'
		AND c.status ='A' ORDER BY c.fullname ASC";
		$query = $this->db->query($sql)->result();
		// return $query;

		$feedback = array('status' => 'Success','message'=>$query);
		return $feedback;
	}

	function getDataPresensiList($username, $course_id, $start_date, $end_date){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id";
     	$sql_s = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.username = '".$username."'
				";
		$q = $this->db->query($sql_s)->result();
		$profile_id = $q[0]->profile_id;
		$institution_id = $q[0]->institution_id;

		$sqlsmtr='';
		$sqlAddon='';
		$sqlAddon=" AND ( a.record_date BETWEEN '".$start_date."' AND '".$end_date."')";
		// $sqlsmtr=" AND a.smt_id ='".$this->input->post('semester_id')."'"; 
		$sql = "SELECT a.id,a.record_date,a.type, a.profile_id
				FROM absensi_siswa as a 
				WHERE a.institution_id = '".$institution_id."'
				AND a.profile_id = '".$profile_id."'
				AND a.kelas_id ='".$course_id."'
				 ".$sqlAddon." ";
		$query = $this->db->query($sql)->result();
		// return $query;

		$feedback = array('status' => 'Success','message'=>$query);
		return $feedback;
	}


	function getStudentBehavior($enduser_id){
		$profile_id ='';
		$institution_id ='';
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id";
     	$sql_s = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.id = '".$enduser_id."'
				";
		$q = $this->db->query($sql_s)->result();
		if(count($q)>0){
			$profile_id = $q[0]->profile_id;
			$institution_id = $q[0]->institution_id;
		}

		$sql = "select a.*,
				b.name, b.point, c.id as behavior_type
				from behavior_siswa as a
				join master_behavior as b on b.id = a.master_behavior_id
				join master_behavior_type as c on b.behavior_type = c.id
				where a.status = 'A' AND profile_id = '".$profile_id."'
				";
		$query = $this->db->query($sql)->result();
		$feedback = array('status' => 'Success','message'=>$query);
		return $feedback;
	}

	function getAnnouncement($username){
		$sSelect="id,username,institution_id,fullname,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where username = '".$username."'
				";
		$query = $this->db->query($sql)->result();

		$sql = "SELECT * 
				FROM announcements
				WHERE status = 'A'
				AND institution_id = '".$query[0]->institution_id."'
				ORDER BY id DESC";
		$qu = $this->db->query($sql)->result();
		$feedback = array('status' => 'Success','message'=>$qu);
		return $feedback;
	}


	function getTahunAjaran($username){
		$sSelect="id,username,institution_id,fullname,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where username = '".$username."'
				";
		$query = $this->db->query($sql)->result();

		$sql = "SELECT 
				a.*, b.start_date as smt1_sd, b.end_date as smt1_ed, c.start_date as smt2_sd, c.end_date as smt2_ed
				FROM tahun_ajaran AS a
				LEFT JOIN (SELECT ta_id, id, start_date, end_date
					FROM semesters 
					WHERE status = 'A' 
					AND institution_id =  '".$query[0]->institution_id."'
					AND periode = 1
				) as b
				ON a.id = b.ta_id
				LEFT JOIN (SELECT ta_id, id, start_date, end_date
					FROM semesters 
					WHERE status = 'A' 
					AND institution_id =  '".$query[0]->institution_id."'
					AND periode = 2
				) as c
				ON a.id = c.ta_id
				where a.institution_id = '".$query[0]->institution_id."'
				AND a.status = 'A'
				GROUP BY a.id";
		$qu = $this->db->query($sql)->result();
		$feedback = array('status' => 'Success','message'=>$qu);
		return $feedback;
	}


	function getEkskul($username){
		$sSelect="a.id, a.username, a.institution_id, a.fullname, a.status,b.id as profile_id";
     	$sql = "SELECT ".$sSelect." from endusers as a
     			LEFT JOIN student_profile as b ON a.id = b.enduser_id
				where a.username = '".$username."'
				";
		$query = $this->db->query($sql)->result();

		$sql = "SELECT a.*,
				b.name
				from ekstrakulikuler as a
				join master_ekstrakulikuler as b on b.id = a.master_ekskul_id
				where a.status = 'A' AND a.profile_id = '".$query[0]->profile_id."' ";
		$qu = $this->db->query($sql)->result();

		$feedback = array('status' => 'Success','message'=>$qu);
		return $feedback;
	}
	

	function get_students_parent($enduser_id){
		$sSel = "a.id,a.fullname,a.username, a.user_group_id, a.daftar_id, a.ta_masuk_id, a.nik as u_nik, a.institution_id,a.phone  as u_phone, a.dob as u_dob, a.pass_verified, a.pass_status, a.progress_status, a.active_status,a.photo_url,
				b.name as institution_name, b.yayasan_id, c.id as profile_id,
				c.full_name, c.nick_name, c.nik, c.nis, c.nisn, c.dob, c.pob, c.no_akte, c.nationality, c.gender, c.religion, c.register_date
				";
	 	$sqlH = "SELECT ".$sSel." 
	 		FROM student_parent as sp
	 		LEFT JOIN endusers AS a 
	 		ON sp.student_id = a.id
			LEFT JOIN sekolah AS b 
			on a.institution_id = b.id
			LEFT JOIN student_profile AS c
			on a.id = c.enduser_id
			where sp.enduser_id = '".$enduser_id."' 
			";
		$query= $this->db->query($sqlH)->result();
		if($query>0){
			$feedback = array('status' => 'Success','message'=>$query);	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Tidak Ada Murid yang terdaftar sebagai anak murid anda');	
		}
		return $feedback;
	}


	function getStudents($id){
		$sSel = "a.id,a.fullname,a.username, a.user_group_id, a.daftar_id, a.ta_masuk_id, a.nik as u_nik, a.institution_id,a.phone  as u_phone, a.dob as u_dob, a.pass_verified, a.pass_status, a.progress_status, a.active_status,a.photo_url,
				b.name as institution_name, b.yayasan_id, c.id as profile_id,
				c.full_name, c.nick_name, c.nik, c.nis, c.nisn, c.dob, c.pob, c.no_akte, c.nationality, c.gender, c.religion, c.anak_ke, c.saudara_kandung_total as kandung, c.saudara_tiri_total as tiri, c.saudara_angkat_total as angkat, c.tinggal_bersama, c.phone, c.email, c.phone_parent, c.email_parent, c.phone_home,c.phone_mobile, 
				c.address, c.rt ,c.rw,c.kelurahan,c.kecamatan, c.kota, c.kode_pos, c.provinsi, c.status_tempat_tinggal, c.golongan_darah, c.sakit_lelah, c.sakit_jantung, c.sakit_kulit, c.sakit_cacat, c.sakit_lain_lain, c.kelainan_jasmani, c.jarak_rumah_sekolah, c.kendaraan,c.bahasa_rumah, c.yatim_piatu, c.weight, c.height, c.register_date
				";
	 	$sqlH = "SELECT ".$sSel." 
	 		FROM endusers AS a 
			LEFT JOIN sekolah AS b 
			on a.institution_id = b.id
			LEFT JOIN student_profile AS c
			on a.id = c.enduser_id
			where a.id in (".$id.")";
		$query= $this->db->query($sqlH)->result();
		if($query>0){
			$feedback = array('status' => 'Success','message'=>$query);	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Maaf, User tidak terdaftar. Mohon periksa kembali');	
		}
		return $feedback;
	}

	function get_asal_sekolah($id,$user_group_id){

		if($user_group_id=='3'){
			$id= $this->get_id_profile($id);
		}

		$sSel = "a.*";
	 	$sqlH = "SELECT ".$sSel." 
	 		FROM asal_sekolah AS a 
			where a.profile_id in (".$id.")";
		$query= $this->db->query($sqlH)->result();
		if($query>0){
			$feedback = array('status' => 'Success','message'=>$query);	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Maaf, User tidak terdaftar. Mohon periksa kembali');	
		}
		return $feedback;
	}

	function get_familys($id,$user_group_id){
		if($user_group_id=='3'){
			$id= $this->get_id_profile($id);
		}
		
		$sSel = "a.*";
	 	$sqlH = "SELECT ".$sSel." 
	 		FROM familys AS a 
			where a.profile_id in (".$id.")";
		$query= $this->db->query($sqlH)->result();
		if($query>0){
			$feedback = array('status' => 'Success','message'=>$query);	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Maaf, User tidak terdaftar. Mohon periksa kembali');	
		}
		return $feedback;
	}



	function get_invoices($id){
		// if($user_group_id=='3'){
		$id= $this->get_id_profile($id);
		// }

		$sSel = "a.*";
	 	$sqlH = "SELECT ".$sSel." 
	 		FROM invoices AS a 
			where a.profile_id = '".$id."' ORDER BY a.id DESC";
		$query= $this->db->query($sqlH)->result();
		if($query>0){
			$feedback = array('status' => 'Success','message'=>$query);	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Maaf, User tidak terdaftar. Mohon periksa kembali');	
		}
		return $feedback;
	}

	function get_transactions($id){
		$sSel = "a.*";
	 	$sqlH = "SELECT ".$sSel." 
	 		FROM transactions AS a 
			where a.enduser_id = '".$id."' AND a.closing_status ='CO' ORDER BY a.id DESC";
		$query= $this->db->query($sqlH)->result();
		if($query>0){
			$feedback = array('status' => 'Success','message'=>$query);	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Maaf, User tidak terdaftar. Mohon periksa kembali');	
		}
		return $feedback;
	}

	/* Note:
		untuk bagian ini ditambahkan email bawhwa password anda telah diubah

	*/
	function changePassword($id,$oldPass,$newPass){
	 	$sSelect="id, username";
     	$sql = "SELECT ".$sSelect." from endusers 
				where password = '".$oldPass."'
				AND id = '".$id."'
				";
		$query = $this->db->query($sql)->result();
		if(count($query)>0){
			$record_detail = array(
				'password' => trim($newPass),
				'changed_by' => $query[0]->username
				);
			$this->db->where('id',$query[0]->id)->update('endusers',$record_detail);
			$feedback = array('status' => 'Success','message'=>'Success Change password');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Your old password its wrong, please check and try again!');	
		}
		return $feedback;
	}



	// INVESTMENT

	// SAHAM
	function getProductListSH($enduserId,$username,$types){
	 	$sSelect="enduserId, username, status";
     		$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."' AND username='".$username."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
			$queryHistory="";
			$sSel = "a.*";

			if($types=='0'){
				$sqlH = "SELECT ".$sSel." from inv_product_sh a 
					where a.status= 'A' ";
			}else{
				$sqlH = "SELECT ".$sSel." from inv_product_sh a 
					where a.status= 'A' AND a.category='".$types."' ";
			}

			$queryHistory = $this->db->query($sqlH)->result();


			if(count($queryHistory)>0){
				$feedback = array('status' => 'Success','message'=>$queryHistory);
			}else{
				$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
			}



		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		return $feedback;
	}


	function getProductListRD($enduserId,$username,$types){
	 	$sSelect="enduserId, username, status";
     		$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."' AND username='".$username."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
			$queryHistory="";
			$sSel = "a.*";
			
			if($types=='0'){
				$sqlH = "SELECT ".$sSel." from inv_product a 
				where a.status= 'A' AND a.type='RD'";
			}else{
				$sqlH = "SELECT ".$sSel." from inv_product a 
				where a.status= 'A' AND a.type='RD' AND category='".$types."'";
			}

			$queryHistory = $this->db->query($sqlH)->result();
			if(count($queryHistory)>0){
				$feedback = array('status' => 'Success','message'=>$queryHistory);
			}else{
				$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
			}
		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		return $feedback;
	}




	function getHistory($enduserId,$cases){
	 	
	 	$sSelect="enduserId,username,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		
		$today = date("Y-m-d H:i:s");    
		$oneMA = date("Y-m-d H:i:s", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
		if(count($query)>0){
			$sSel = "a.*,b.name as driverName, b.phone as driverPhone , c.name as vName, c.type as vType , c.lisenceNumber";

			$queryHistory="";
			if($cases=='P'){
				$sqlH = "SELECT ".$sSel." from orderbooks a 
					LEFT JOIN drivers b on b.driverId = a.driverId
					LEFT JOIN vehicles c on c.vehicleId = a.vehicleId  
					where a.enduserId= '".$enduserId."' AND (a.createdDate BETWEEN '".$oneMA."' AND '".$today."') AND a.statusOrder='".$cases."'";
					$queryHistory = $this->db->query($sqlH)->result();	
			}else if($cases=='CO'){
			$sqlH = "SELECT ".$sSel." from orderbooks a 
					LEFT JOIN drivers b on b.driverId = a.driverId
					LEFT JOIN vehicles c on c.vehicleId = a.vehicleId  
					where a.enduserId= '".$enduserId."' AND (a.createdDate BETWEEN '".$oneMA."' AND '".$today."') AND (a.statusOrder='".$cases."' OR a.statusOrder='AJ'  ) ";
					$queryHistory = $this->db->query($sqlH)->result();
			}else if($cases=='O'){
				$sqlH = "SELECT ".$sSel." from orderbooks a
					LEFT JOIN drivers b on b.driverId = a.driverId
					LEFT JOIN vehicles c on c.vehicleId = a.vehicleId  
					where a.enduserId= '".$enduserId."' AND (a.createdDate BETWEEN '".$oneMA."' AND '".$today."') AND (a.statusOrder='O' OR a.statusOrder='W' )";
					$queryHistory = $this->db->query($sqlH)->result();	
			}


			$feedback = array('status' => 'Success','message'=>$queryHistory);
		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		return $feedback;
	}
	
	function fcmSingle($fcmId,$title,$msg,$case){
		$feedback = $fcmId."<br>".$title."<br>".$msg."<br>".$case;
		return $feedback;
	}


	function messageFeedback($enduserId,$subject,$tripId,$message){
	 	$sSelect="enduserId,username,status";
     		$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		$queryHistory = $enduserId."<br>".$subject."<br>".$tripId."<br>".$message;
		
		if(count($query)>0){

			$feedback = array('status' => 'Success','message'=>$queryHistory);
		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		return $feedback;
	}
	
	
	function getOrderBack($enduserId,$username){
	 	
	 	$sSelect="enduserId,username,orderStatus,status";
     		$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."' AND username='".$username."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
			$sSel = "a.*,b.name as driverName, b.phone as driverPhone , c.name as vName, c.type as vType , c.lisenceNumber";

			$sqlH = "SELECT ".$sSel." from orderbooks a 
				LEFT JOIN drivers b on b.driverId = a.driverId
				LEFT JOIN vehicles c on c.vehicleId = a.vehicleId  
				where a.enduserId= '".$enduserId."' AND (a.statusOrder='O' OR a.statusOrder='W' )";
			$queryHistory = $this->db->query($sqlH)->result();
			if(count($queryHistory)>0){
			$feedback = array('status' => 'Success','message'=>$queryHistory);
			}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
			}
		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		return $feedback;
	}

	function get_detail_trip_recipt($orderCode){
	 	$sSel = "a.*,b.name as driverName, b.phone as driverPhone , c.name as vName, c.type as vType , c.lisenceNumber";
		$sqlH = "SELECT ".$sSel." from orderbooks a 
			LEFT JOIN drivers b on b.driverId = a.driverId
			LEFT JOIN vehicles c on c.vehicleId = a.vehicleId  
			where a.orderCode= '".$orderCode."'";
		$query= $this->db->query($sqlH)->result();
		if($query>0){
			return $query[0];
		}else{
			return false;
		}
	}


	function driverPosition($enduserId){
		$today = date("Y-m-d"); 
	 	$sSelect="enduserId,username,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
			$sSelect="driverId,driverLoc,name";
			$sql = "SELECT ".$sSelect." from drivers 
				where status = 'A' AND loginStatus= 'O'
				AND orderStatus = 'A' AND changedDate LIKE '".$today."%'
				";
			$queryDriverLoc = $this->db->query($sql)->result();	
			$feedback = array('status' => 'Success','message'=>$queryDriverLoc);	
		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		return $feedback;
	}


	function driverPositionById($enduserId,$driverId,$orderCode){
	 	$sSelect="enduserId,username,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
			$sSelect="b.driverId,b.driverLoc,b.name,a.statusOrder,a.timePickup,a.timeClosing,a.package,a.packageRun";
			$sql = "SELECT ".$sSelect." from orderbooks a INNER JOIN drivers b on a.driverId = b.driverId  where a.orderCode ='".$orderCode."' AND  a.driverId='".$driverId."' AND b.loginStatus= 'O' ";
			$queryDriverLoc = $this->db->query($sql)->result();	
			$feedback = array('status' => 'Success','message'=>$queryDriverLoc);	 
		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		return $feedback;
	}



	function orderUserPost($enduserId,$orderCode,$orderDetail){
		$dataOrder = json_decode($orderDetail);
		foreach($dataOrder as $row){
			$statusOrder='B';
			if ($row->statusOrder=='SC'){
				$statusOrder = 'SC';
			}else{
				$statusOrder='B';
			}

			if(isset($row->timeAppointed)){
				$order_array = array(
					'orderCode' => $row->orderCode,
					'enduserId' => $row->enduserId,
					'driverId' => $row->driverId,
					'pickupAddr' => $row->pickupAddr,
					'pickupCoor' => $row->pickupCoor,
					'closingAddr' => $row->closingAddr,
					'closingCoor' => $row->closingCoor,
					'methode' => $row->methode,
					'pic' => $row->pic,
					'picPhone' => $row->picPhone,
					'notes' => $row->notes,
					'timeAppointed' => $row->timeAppointed,
					'timePickup' => $row->timePickup,
					'timeClosing' => $row->timeClosing,
					'package' => $row->package,
					'packageRun' => $row->packageRun,
					'estimates'=>$row->estimates,
					'price' => $row->price,
					'paymentMethod' => $row->paymentMethod,
					'statusOrder' => $statusOrder,
					'createdBy' => $row->createdBy,
					'createdDate'=>$row->createdDate,
					'changedBy' => $row->createdBy

				);
				$this->db->insert('orderbooks',$order_array);
			}else{
				$order_array = array(
				'orderCode' => $row->orderCode,
				'enduserId' => $row->enduserId,
				'driverId' => $row->driverId,
				'pickupAddr' => $row->pickupAddr,
				'pickupCoor' => $row->pickupCoor,
				'closingAddr' => $row->closingAddr,
				'closingCoor' => $row->closingCoor,
				'methode' => $row->methode,
				'pic' => $row->pic,
				'picPhone' => $row->picPhone,
				'notes' => $row->notes,
				'timePickup' => $row->timePickup,
				'timeClosing' => $row->timeClosing,
				'package' => $row->package,
				'packageRun' => $row->packageRun,
				'estimates'=>$row->estimates,
				'price' => $row->price,
				'paymentMethod' => $row->paymentMethod,
				'statusOrder' => $statusOrder,
				'createdBy' => $row->createdBy,
				'createdDate'=>$row->createdDate,
				'changedBy' => $row->createdBy

				);
				$this->db->insert('orderbooks',$order_array);

			}
		}
		
		$check_order = $this->check_no_order($orderCode);
		if($check_order==1){
			$feedback = array('status' => 'Success','message'=>"order success store");	
			
		}else{
			$feedback = array('status' => 'Failed','message'=>"order already on server");
		}
		return $feedback;
		
	}

	function orderUserChange($username,$enduserId,$orderCode,$status){
		$check_order = $this->check_no_order($orderCode);
		$id_driver = $this->check_driver_order($orderCode);
		if($check_order==1){
			$record_detail = array(
				'statusOrder' => trim($status),
				'changedBy' => $username
				);
			$this->db->where('orderCode',$orderCode)->update('orderbooks',$record_detail);
			
			if($status=='CE'){
				$record_driver = array(
				'orderStatus' => trim('A'),
				'changedBy' => $username
				);
				$this->db->where('driverId',$id_driver)->update('drivers',$record_driver);
			}

			$feedback = array('status' => 'Success','message'=>"order success change");	
		}else{
			$feedback = array('status' => 'Failed','message'=>"order already on server");
		}
		return $feedback;
	}

	function check_driver_order($orderCode){
		$sSelect="driverId";
     	$sql = "SELECT ".$sSelect." from orderbooks
				where orderCode = '".$orderCode."'";
		$query = $this->db->query($sql)->result();
		// return $feedback;
		return $query[0]->driverId;
	}

	function checkOrderDriver($username, $enduserId,$orderCode){
		$sSelect="driverId,timeAssigned";
     	$sql = "SELECT ".$sSelect." from orderbooks
				where orderCode = '".$orderCode."'";
		$query = $this->db->query($sql)->result();
		$hasil = $query[0]->driverId;
		$timeAssigned = $query[0]->timeAssigned;

		if($hasil=='0'){
			$feedback = array('status' => 'Success','message'=>$hasil);
		}else{
			$profileDriver = $this->getProfileDriver($hasil);
			if($profileDriver){
				$record_detail = array(
					'statusOrder' => trim('W'),
					'changedBy' => $username
					);
				$this->db->where('orderCode',$orderCode)->update('orderbooks',$record_detail);
				
				$feedback = array('status' => 'Success','message'=>$profileDriver[0],'timeAssigned'=>$timeAssigned);
			}
			
		}

		return $feedback;
	}

	function get_package(){
		$sSelect="packageId, name, duration, price, description";
     	$sql = "SELECT ".$sSelect." from packages";
		$hasil = $this->db->query($sql)->result();
		if(count($hasil)>0){
			$feedback = array('status' => 'Success','message'=>$hasil);
		}else{
			$feedback = array('status' => 'Failed','message'=>"packages cannot be fetched");
		}
		return $feedback;
	}

	function get_reason(){
		$sSelect="*";
     	$sql = "SELECT ".$sSelect." from feedback_cancel";
		$hasil = $this->db->query($sql)->result();
		if(count($hasil)>0){
			$feedback = array('status' => 'Success','message'=>$hasil);
		}else{
			$feedback = array('status' => 'Failed','message'=>"packages cannot be fetched");
		}
		return $feedback;
	}

	

	

	

// WATCHLIST
	function addWatchList($enduserId,$username, $product_id){
		$sSelect="*";
     	$sql = "SELECT ".$sSelect." from inv_watchlist 
				where enduser_id = '".$enduserId."'
				AND product_id ='".$product_id."'
				";
		$query = $this->db->query($sql)->result();
		
		$intId = (int)$enduserId;
		$productId = (int)$product_id;

		if(count($query)==0){
	     	$today = date("Y-m-d H:i:s");     
			$arrayRegister = array(
				'enduser_id' => $intId,
				'product_id' => $productId,
				'created_by' =>  $username,
				'created_date' =>  $today,
				'changed_by' =>  $username
				);
			$this->db->insert('inv_watchlist',$arrayRegister);

			$feedback = array('status' => 'Success','message'=>'Product successfully added to the watchlist');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'This product is already in your watchlist');	
		}
		return $feedback;
	}
	function getWatchlistRD($enduserId, $username,$types){
     	if($types=='0'){
	     	$sql = "SELECT b.*
	     	from inv_watchlist as a
	     	INNER JOIN inv_product as b
	     	ON a.product_id = b.id
	     	WHERE a.enduser_id = '".$enduserId."' AND
	     	b.type ='RD'
	     	";
	    }else{
	    	$sql = "SELECT b.*
	     	from inv_watchlist as a
	     	INNER JOIN inv_product as b
	     	ON a.product_id = b.id
	     	WHERE a.enduser_id = '".$enduserId."' AND
	     	b.type ='RD' AND b.category = '".$types."'
	     	";
	    }
		$hasil = $this->db->query($sql)->result();
		if(count($hasil)>0){
			$feedback = array('status' => 'Success','message'=>$hasil);
		}else{
			$feedback = array('status' => 'Failed','message'=>"packages cannot be fetched");
		}
		return $feedback;
	}
	function deleteWatchlist($enduserId,$username, $product_id){
		$sSelect="*";
     	$sql = "SELECT ".$sSelect." from inv_watchlist 
				where enduser_id = '".$enduserId."' 
				AND product_id ='".$product_id."'
				";
		$query = $this->db->query($sql)->result();
		
		$intId = (int)$enduserId;
		$productId = (int)$product_id;

		if(count($query)>0){
	     	$this->db->where('enduser_id',$enduserId)->where('product_id',$product_id)->delete('inv_watchlist');
			$feedback = array('status' => 'Success','message'=>'Product successfully deleted to the watchlist');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Failed delete from watchlist');	
		}
		return $feedback;
	}


	function addWatchListSH($enduserId,$username, $product_id){
		$sSelect="*";
     	$sql = "SELECT ".$sSelect." from inv_watchlist_sh 
				where enduser_id = '".$enduserId."'
				AND product_id ='".$product_id."'
				";
		$query = $this->db->query($sql)->result();
		
		$intId = (int)$enduserId;
		$productId = (int)$product_id;

		if(count($query)==0){
	     	$today = date("Y-m-d H:i:s");     
			$arrayRegister = array(
				'enduser_id' => $intId,
				'product_id' => $productId,
				'created_by' =>  $username,
				'created_date' =>  $today,
				'changed_by' =>  $username
				);
			$this->db->insert('inv_watchlist_sh',$arrayRegister);

			$feedback = array('status' => 'Success','message'=>'Product successfully added to the watchlist');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'This product is already in your watchlist');	
		}
		return $feedback;
	}
	function getWatchlistSH($enduserId, $username,$types){
     	if($types=='0'){
	     	$sql = "SELECT b.*
	     	from inv_watchlist_sh as a
	     	INNER JOIN inv_product_sh as b
	     	ON a.product_id = b.id
	     	WHERE a.enduser_id = '".$enduserId."'
	     	";
	    }else{
	    	$sql = "SELECT b.*
	     	from inv_watchlist_sh as a
	     	INNER JOIN inv_product_sh as b
	     	ON a.product_id = b.id
	     	WHERE a.enduser_id = '".$enduserId."' AND b.category = '".$types."'
	     	";
	    }
		$hasil = $this->db->query($sql)->result();
		if(count($hasil)>0){
			$feedback = array('status' => 'Success','message'=>$hasil);
		}else{
			$feedback = array('status' => 'Failed','message'=>"packages cannot be fetched");
		}
		return $feedback;
	}
	function deleteWatchlistSH($enduserId,$username, $product_id){
		$sSelect="*";
     	$sql = "SELECT ".$sSelect." from inv_watchlist_sh
				where enduser_id = '".$enduserId."' 
				AND product_id ='".$product_id."'
				";
		$query = $this->db->query($sql)->result();
		
		$intId = (int)$enduserId;
		$productId = (int)$product_id;

		if(count($query)>0){
	     	$this->db->where('enduser_id',$enduserId)->where('product_id',$product_id)->delete('inv_watchlist_sh');
			$feedback = array('status' => 'Success','message'=>'Product successfully deleted to the watchlist');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Failed delete from watchlist');	
		}
		return $feedback;
	}


//PORTFOLIO	
	function addToPortfolio($enduserId,$username, $product_id){
		$sSelect="*";
     	$sqlW = "SELECT ".$sSelect." from inv_watchlist
				where enduser_id = '".$enduserId."' 
				AND product_id ='".$product_id."'
				";
		$queryW = $this->db->query($sqlW)->result();

		$sSelect="*";
     	$sql = "SELECT ".$sSelect." from inv_portfolio 
				where enduser_id = '".$enduserId."' 
				AND product_id ='".$product_id."'
				";
		$query = $this->db->query($sql)->result();
		
		$intId = (int)$enduserId;
		$productId = (int)$product_id;

		if(count($query)==0){
			if(count($queryW)>0){
				$this->db->where('enduser_id',$enduserId)->where('product_id',$product_id)->delete('inv_watchlist');
			}

	     	$today = date("Y-m-d H:i:s");     
			$arrayRegister = array(
				'enduser_id' => $intId,
				'product_id' => $productId,
				'created_by' =>  $username,
				'created_date' =>  $today,
				'changed_by' =>  $username
				);
			$this->db->insert('inv_portfolio',$arrayRegister);

			$feedback = array('status' => 'Success','message'=>'Product successfully added to the portfolio');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'This product is already in your portfolio');	
		}
		return $feedback;
	}
	function getPortfolioRD($enduserId, $username,$types){
		if($types=='0'){
	     	$sql = "SELECT b.*
	     	from inv_portfolio as a
	     	INNER JOIN inv_product as b
	     	ON a.product_id = b.id
	     	WHERE a.enduser_id = '".$enduserId."' AND
	     	b.type ='RD'
	     	";
     	}else{
     		$sql = "SELECT b.*
	     	from inv_portfolio as a
	     	INNER JOIN inv_product as b
	     	ON a.product_id = b.id
	     	WHERE a.enduser_id = '".$enduserId."' AND
	     	b.type ='RD' AND b.category = '".$types."'
	     	";
     	}
		$hasil = $this->db->query($sql)->result();
		if(count($hasil)>0){
			$feedback = array('status' => 'Success','message'=>$hasil);
		}else{
			$feedback = array('status' => 'Failed','message'=>"no data portfolio");
		}
		return $feedback;
	}
	function deletePortfolio($enduserId,$username, $product_id){
		$sSelect="*";
     	$sql = "SELECT ".$sSelect." from inv_portfolio 
				where enduser_id = '".$enduserId."' 
				AND product_id ='".$product_id."'
				";
		$query = $this->db->query($sql)->result();
		
		$intId = (int)$enduserId;
		$productId = (int)$product_id;

		if(count($query)>0){
	     	$this->db->where('enduser_id',$enduserId)->where('product_id',$product_id)->delete('inv_portfolio');
			$feedback = array('status' => 'Success','message'=>'Product successfully deleted to the portfolio');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Failed delete from portfolio');	
		}
		return $feedback;
	}


	function addToPortfolioSH($enduserId,$username, $product_id){
		$sSelect="*";
     	$sqlW = "SELECT ".$sSelect." from inv_watchlist_sh
				where enduser_id = '".$enduserId."' 
				AND product_id ='".$product_id."'
				";
		$queryW = $this->db->query($sqlW)->result();

		$sSelect="*";
     	$sql = "SELECT ".$sSelect." from inv_portfolio_sh 
				where enduser_id = '".$enduserId."' 
				AND product_id ='".$product_id."'
				";
		$query = $this->db->query($sql)->result();
		
		$intId = (int)$enduserId;
		$productId = (int)$product_id;

		if(count($query)==0){
			if(count($queryW)>0){
				$this->db->where('enduser_id',$enduserId)->where('product_id',$product_id)->delete('inv_watchlist_sh');
			}

	     	$today = date("Y-m-d H:i:s");     
			$arrayRegister = array(
				'enduser_id' => $intId,
				'product_id' => $productId,
				'created_by' =>  $username,
				'created_date' =>  $today,
				'changed_by' =>  $username
				);
			$this->db->insert('inv_portfolio_sh',$arrayRegister);

			$feedback = array('status' => 'Success','message'=>'Product successfully added to the portfolio');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'This product is already in your portfolio');	
		}
		return $feedback;
	}
	function getPortfolioSH($enduserId, $username,$types){
		if($types=='0'){
	     	$sql = "SELECT b.*
	     	from inv_portfolio_sh as a
	     	INNER JOIN inv_product_sh as b
	     	ON a.product_id = b.id
	     	WHERE a.enduser_id = '".$enduserId."' 
	     	";
     	}else{
     		$sql = "SELECT b.*
	     	from inv_portfolio_sh as a
	     	INNER JOIN inv_product_sh as b
	     	ON a.product_id = b.id
	     	WHERE a.enduser_id = '".$enduserId."'  AND b.category = '".$types."'
	     	";
     	}
		$hasil = $this->db->query($sql)->result();
		if(count($hasil)>0){
			$feedback = array('status' => 'Success','message'=>$hasil);
		}else{
			$feedback = array('status' => 'Failed','message'=>"no data portfolio");
		}
		return $feedback;
	}
	function deletePortfolioSH($enduserId,$username, $product_id){
		$sSelect="*";
     	$sql = "SELECT ".$sSelect." from inv_portfolio_sh 
				where enduser_id = '".$enduserId."' 
				AND product_id ='".$product_id."'
				";
		$query = $this->db->query($sql)->result();
		
		$intId = (int)$enduserId;
		$productId = (int)$product_id;

		if(count($query)>0){
	     	$this->db->where('enduser_id',$enduserId)->where('product_id',$product_id)->delete('inv_portfolio_sh');
			$feedback = array('status' => 'Success','message'=>'Product successfully deleted to the portfolio');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Failed delete from portfolio');	
		}
		return $feedback;
	}





	function check_no_order($orderCode){
		$query = $this->db->select('*')->from('orderbooks')->where('orderCode',$orderCode)->get()->result();
		if($query>0){
			$fb = 1;
		}else{
			$fb= 0;
		}
		return $fb;
	
	}

	function getProfileDriver($driverId){
		$sSelect="a.driverId,a.name,a.phone,b.name as vName, b.type, b.lisenceNumber";
     	$sql = "SELECT ".$sSelect." from drivers a LEFT JOIN vehicles b on a.driverId = b.driverId
				where a.driverId = '".$driverId."'";
		$query = $this->db->query($sql)->result();	
		return $query;
		
	}

	function getMethode($enduserId){
		$sSelect="enduserId,username,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
	     	$sqlmethode = "SELECT * from packages";
			$queryMethode = $this->db->query($sqlmethode)->result();
			$feedback = array('status' => 'Success','message'=>$queryMethode);
		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		return $feedback;
		
	}

	//GET PROFILE
	function profile_get($driverId){
		$query = $this->db->select('*')->from('drivers')->where('driverId',$driverId)->get()->result();
		return $query;
	}

	function enduser_profile_get($enduserId){
		$query = "select A.enduserId, A.username, A.clientId as clientId, A.name, A.fcmId, A.phone,
					A.email, A.address, A.pathUrl, B.name as clientName
					FROM endusers as A
					LEFT JOIN clients as B ON B.clientId = A.clientId
					WHERE A.enduserId = '".$enduserId."'";
		$result = $this->db->query($query)->result();
		$feedback = array('status' => 'Success','message'=>$result[0]);
		return $feedback;
	}


		//FEEDBACK
	function updateProfile($enduserId,$profileDetail){
	 	$sSelect="enduserId,username,orderStatus,status";
     		$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();

		if(count($query)>0){
		
			$dataOrder = json_decode($profileDetail);
			foreach($dataOrder as $row){
				$record_detail = array(
					'name' => $row->name,
					'phone' => $row->phone,
					'pathUrl' => $row->image,
					'email' => $row->email,
					'changedBy' => $row->changedBy
	
				);
				$this->db->where('enduserId',$row->enduserId)->update('endusers',$record_detail);
			}	
			
			$feedback = array('status' => 'Success','message'=>'Profile user has been updated','data'=>$record_detail);	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Profile failed to update');	
		}
		return $feedback;
	}

	//UPDATE PROFILE
	function profile_put($driverId, $profile){
		if($idDriver){
			$this->db->where('driverId',$driverId)->update('drivers',$profile);
			$feedback = array('status' => 'success','message'=>'profile has been set');	
			return $feedback;
		}else {
			$feedback = array('status' => 'failed','message'=>'failed to update/set profile');
			return $feedback;
		}
	}

	function userFeedback($enduserId,$orderCode,$cases){
		$sSelect="enduserId,username,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
	     	$sqlfb = "SELECT * from feedbacks
					where orderCode = '".$orderCode."' AND statusOrder='".$cases."'";
			$queryFb = $this->db->query($sqlfb)->result();
			$feedback = array('status' => 'Success','message'=>$queryFb[0]);
		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		// $feedback = array('status' => 'Failed','message'=>$enduserId." ".$orderCode);


		return $feedback;
		
	}

	//FEEDBACK
	function updateFeedback($enduserId,$rate, $message, $orderCode, $scase){
	 	$sSelect="enduserId,username,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();

		if(count($query)>0){
			$record_detail = array(
				'enduserFb' => $message,
				'enduserRate' => $rate,
				'changedBy' => $query[0]->username
				);
			$this->db->where('orderCode',$orderCode)->update('feedbacks',$record_detail);
			$feedback = array('status' => 'Success','message'=>'Thanks for your feedback');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Feedback Failed to post');	
		}
		return $feedback;
	}	

	//GET USER
	function userOrder($userId){
	 	$sSelect="firstname,lastname,phone,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where userId = '".$userId."'
				";
		$query = $this->db->query($sql)->result();
		return $query;
		// $query = $this->db->select('*')->from('drivers')->where('username',$username)->where('password',$password)->get()->result();
	}
	
	function get_user_data($condition){
		$query = $this->db->select("*")->where($condition)->get('endusers')->result();
		if(count($query) > 0){
			return $query;
		}else{
			return false;
		}
	}
	
		
	function get_user_cc($userId){
		$condition = array(
					'enduserId' => $userId,
					'status' => 'A'
				);
		$query = $this->db->select("*")->where($condition)->get("creditcards")->result();
		return $query;
	}
	
	function add_cus($detail){
		$this->db->insert('creditcards',$detail);
	}
	
	function edit_cus($id, $detail){
		$this->db->where('enduserId', $id)->update('creditcards',$detail);
	}
	
	function get_pay_method($key, $val){
		$condition = array(
					$key => $val,
					'status' => 'A'
				);
		$query = $this->db->select('*')->where($condition)->get('creditcards')->result();
		if(count($query) > 0){
			return $query;
		}else{
			return false;
		}
	}

	//GET CLIENT
	function get_client($userId){
		$sSelect = "A.enduserId, A.clientId as clientId, B.customerId";
		$sql = "SELECT A.* from endusers as A
				LEFT JOIN creditcards as B ON B.clientId = A.clientId
				WHERE A.enduserId = '".$userId."'";
		$query = $this->db->query($sql)->result();
		return $sql;
	}
	

	//////////////////////
	//for reset password//
	//////////////////////
	//get user by email
	function get_user_reset($email){
		$query = $this->db->select('*')->from('endusers')->where('username', $email)->get()->result();
		return $query; 
	}
	
	//update password
	function reset_pass($id, $detail){
		$this->db->where('id', $id)->update('endusers', $detail);
	}

	function get_id_profile($id){
		$query = $this->db->select('*')->from('student_profile')->where('enduser_id',$id)->get()->result();
		if(count($query)>0){
			return $query[0]->id;
		}else{
			return false;
		}
	}

}
?>