<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class globals extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_content');
		
	}

	//function index()
	//{
		//$data['qty_month'] = '';
		//$this->menu_handler->set_menu('settings','Settings',$data,3,12);
	//}

	function privacy_policy(){
		$this->load->view('privacy_policy');
	}	
	
	function news($id){
		// print_r($id);
		// die();
		// $this->load->library('encryption'); 
		// $id=str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
		// $decrypt = $this->encryption->decode($id);
		$news= $this->mdl_content->get_news($id);
		$data['news']=$news[0];
		$this->load->view('news_detail',$data);

	}

	function session_expired(){
		$data['news']="";
		$this->load->view('expired_view',$data);
	}

	function tajar_crud($tes){
		$get_priviledge = $this->session->userdata('user_group_id');
		$status = explode('-',$tes);
		$cas = $status[1];
		$last_url = 'tajar/tajar_crud/0-0';
		if($cas >= '4'){
			$last_url = 'tajar/tajar_crud/0-4';		
		}
		$menu_data = $this->menu_handler->get_menu($last_url);
		switch($cas){
			case 0: // FOR SHOW ALL enduserS
					if($get_priviledge=='1'){

						$data['daftar'] = $this->mdl_content->get_all_tajar_active();
						$this->menu_handler->set_menu('tajar_list',$this->lang->line('label_tajar'),$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			case 1: // UNTUK ADD tajar
					if($get_priviledge=='1'){
						$data['all_user_group'] = $this->mdl_content->get_user_group();
						$data['all_country'] = $this->mdl_content->get_countries();
						$data['new_tajar'] = true;
						$this->menu_handler->set_menu('tajar_detail',$this->lang->line('label_tajar'),$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			case 2: // UNTUK EDIT tajar
					if($get_priviledge=='1'){
						$data['all_user_group'] = $this->mdl_content->get_user_group();
						$data['all_country'] = $this->mdl_content->get_countries();
						$edit_tajar = $this->mdl_content->get_tajar($status[0]);
						$data['tajar'] = $edit_tajar[0];
						$this->menu_handler->set_menu('tajar_detail',$this->lang->line('label_tajar'),$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					} 	
					break;
			case 3: // UNTUK DELETE tajar MASUK TRASH
					if($get_priviledge=='1'){
						$data['daftar'] = $this->mdl_content->get_all_tajar_active();
						$datatajar = $this->mdl_content->get_tajar($status[0]);

						$this->mdl_content->hapus_tajar($status[0]);
						$data['daftar'] = $this->mdl_content->get_all_tajar_active();
						$data['status'] = 'Data has been deleted';
						$data['alert'] = 'alert alert-success';
						$this->menu_handler->set_menu('tajar_list',$this->lang->line('label_tajar'),$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			case 4: // UNTUK TAMPILKAN TRASH tajar
					if($get_priviledge=='1'){
						$data['daftar'] = $this->mdl_content->get_all_tajar_deactive();
						$this->menu_handler->set_menu('tajar_trash','Subject Trash',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			case 5: // UNTUK RESTORE tajar
					if($get_priviledge=='1'){
						$this->mdl_content->restore_tajar($status[0]);
						$data['daftar'] = $this->mdl_content->get_all_tajar_deactive();								
						$data['status'] = 'Data has been restored';
						$data['alert'] = 'alert alert-success';
						$this->menu_handler->set_menu('tajar_trash','Subject Trash',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			case 6: // UNTUK DELETE tajar PERMANEN
					if($get_priviledge=='-1'){
						$data['daftar'] = $this->mdl_content->get_all_tajar_deactive();
						$this->mdl_content->hapus_tajar_permanen($status[0]);
						$data['daftar'] = $this->mdl_content->get_all_tajar_deactive();
						$data['status'] = 'Tahun ajaran has been permanently deleted';
						$data['alert'] = 'alert alert-success';
						$this->menu_handler->set_menu('tajar_trash','Subject Trash',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
			
			default:
					if($get_priviledge=='1'){
						$data['daftar'] = $this->mdl_content->get_all_tajar_active();
						$this->menu_handler->set_menu('tajar_list',$this->lang->line('label_tajar'),$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$this->menu_handler->error();
					}
					break;
		}
	}
	
	function add_tajar(){
		$last_url = 'tajar/tajar_crud/0-0';
		$menu_data = $this->menu_handler->get_menu($last_url);
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['all_priviledge'] = $this->mdl_content->get_user_group();
		$data['new_tajar'] = true;
		if($get_priviledge=='1'){
			$result = $this->mdl_content->add_tajar();
			$data['daftar'] = $this->mdl_content->get_all_tajar_active();
			if($result == 1){
					$data['daftar'] = $this->mdl_content->get_all_tajar_active();
					$data['status'] = "Subject has been added.";
					$data['alert'] = 'alert alert-success';
					$this->menu_handler->set_menu('tajar_list',$this->lang->line('label_tajar'),$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
				} else if($result == 2){
					$data['status'] = "Sorry, tahun ajaran name has been used";
					$data['alert'] = 'alert alert-danger';
					$this->menu_handler->set_menu('tajar_detail',$this->lang->line('label_tajar'),$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
				} else {
					$data['alert'] = 'alert alert-danger';
					$data['status'] = "Please check again!!!";
					$this->menu_handler->set_menu('tajar_detail',$this->lang->line('label_tajar'),$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
				}
		} else {
			$this->menu_handler->error();
		}
	}
	
	function edit_tajar($id_tajar, $status=''){
		$last_url = 'tajar/tajar_crud/0-0';
		$menu_data = $this->menu_handler->get_menu($last_url);
		$get_priviledge = $this->session->userdata('user_group_id');
		if($get_priviledge=='1'){
			if($id_tajar =='save'){
				$result = $this->mdl_content->edit_tajar($this->input->post('id'));
				if($result==1){
					$data['daftar'] = $this->mdl_content->get_all_tajar_active();
					$data['status'] = "tajar data has been updated.";
					$data['alert'] = 'alert alert-success';
					$this->menu_handler->set_menu('tajar_list',$this->lang->line('label_tajar'),$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
				} else {
					$data['status'] = "Please check again!!!";
					$data['alert'] = 'alert alert-danger';
					$this->edit_tajar($this->input->post('id'),$data);
				}
			}else{
				$edit_tajar = $this->mdl_content->get_tajar($this->input->post('id'));
				$data['tajar'] = $edit_tajar[0];
				$data['status'] = "Please check again!!!";
				$data['alert'] = 'alert alert-danger';
				$this->menu_handler->set_menu('tajar_detail',$this->lang->line('label_tajar'),$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);			
			}
		} else {
			$data['all_priviledge'] = $this->mdl_content->get_user_group();
			$edit_tajar = $this->mdl_content->get_tajar($this->input->post('id'));
			$data['tajar'] = $edit_tajar[0];
			if($id_tajar =='save'){
				if (($this->input->post('id')) == ($this->session->userdata('id'))){
					$result = $this->mdl_content->edit_tajar($this->input->post('id'),2);
					if($result==1){
						$edit_tajar = $this->mdl_content->get_tajar($this->input->post('id'));
						$data['tajar'] = $edit_tajar[0];
						$data['status'] = "tajar data has been updated.";
						$data['alert'] = 'alert alert-success';
						$this->menu_handler->set_menu('tajar_detail',$this->lang->line('label_tajar'),$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
						$data['status'] = "Please check again!!!";
						$data['alert'] = 'alert alert-danger';
						$this->edit_tajar($this->input->post('id'),$data);
					}
				} else {
					$this->menu_handler->error();
				}
			} else if($id_tajar =='save_detail'){
				if (($this->input->post('id')) == ($this->session->userdata('id'))){
					$result = $this->mdl_content->edit_tajar_detail($this->input->post('id'));
					if($result==1){
						$data['daftar'] = $this->mdl_content->get_all_tajar_active();
						$data['status'] = "Subject data has been updated.";
						$data['alert'] = 'alert alert-success';
						$this->edit_tajar($this->input->post('id'),$data);
					} else {
						$data['status'] = "Please check again!!!";
						$data['alert'] = 'alert alert-danger';
						$this->edit_tajar($this->input->post('id'),$data);
						}
				} else {
					$this->menu_handler->error();
				}
			} else {
				$edit_tajar = $this->mdl_content->get_tajar($this->input->post('id'));
				$data['tajar'] = $edit_tajar[0];
				$this->menu_handler->set_menu('tajar_detail',$this->lang->line('label_tajar'),$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
			}
		}
	}

	function view_teacher_setting($vt_id){

		// $last_url = 'subject/subject_crud/0-0';
		// $menu_data = $this->menu_handler->get_menu($last_url);
		// $get_priviledge = $this->session->userdata('user_group_id');
		// if($get_priviledge=='2'){
			$data['subject']='dsa';
			$view_teacher = $this->mdl_content->get_data_vt($vt_id);
			$data['view_teacher']=$view_teacher[0];
			$this->load->view('subject_settings',$data);
		// } else {
		// 	$this->menu_handler->error();
		// }
	}

	function indikator_populate(){
		$daftar = $this->mdl_content->get_indikator_filter_active();
		$category = $this->mdl_content->get_category_filter_active();
		$category_nr = $this->mdl_content->get_category_filter_non_repeat_active();

		$i=1; for ($o = 0; $o<count($daftar);$o++){ 
		 echo '
		 <div style="border-bottom: 1px solid #dddddd; padding-top: 8px; margin-bottom: 10px;" >
            <button class="btn btn-xs btn-info" onClick="prepareEditIndikator('.$daftar[$o]->id.')"><i class="fa fa-edit"></i></button> &nbsp;
            <label>'.$daftar[$o]->name.' </label> 
            <div style="font-size: 12px; padding-bottom: 8px;">'.$daftar[$o]->description.'</div>';
            	foreach ($category as $cate) {
            	echo '
            	<div style="padding-left: 10px;"><button class="btn btn-xs btn-success-o" onClick="ajaxAddST('.$cate->id.','.$daftar[$o]->id.')"><i class="fa fa-plus"></i></button>&nbsp; '.$cate->title.' 
	              <ul>';

	              	$score_teacher =  $this->mdl_content->get_score_teacher_filter_active($cate->id,$daftar[$o]->id);
	              	foreach ($score_teacher as $sc) {
	              		echo '
	              		<li style="border-bottom: 1px solid #dddddd; padding-top: 4px; padding-bottom: 4px;" >'.$sc->name.'
	              			<div class="pull-right">
		              			<button class="btn btn-xs btn-info" onClick="prepareEditST('.$sc->id.')"><i class="fa fa-edit"></i></button>&nbsp;
		              			<button class="btn btn-xs btn-warning" onClick = "prepareDeleteST('.$sc->id.')"><i class="fa fa-trash-alt"></i></button>
	              			</div>
	              		</li>
	              		';
	              	}
	              
	             echo '
	              </ul>
	            </div>';
            	}
            	
         
	    echo '
          </div>';
      	}


      	foreach ($category_nr as $cate_nr) {
	      	echo '
	      	<div>
	            <label>'.$cate_nr->title.' </label> 
	            <div style="font-size: 12px; padding-bottom: 8px;">'.$cate_nr->description.'</div>
	        </div>';

	    }
	}

	function add_indikator_ajax(){
		$result = $this->mdl_content->add_subject_indikator();
		if($result == 1){
			$status = $this->lang->line('msg_data_success_add');
			$alert = 'alert alert-success';
		} else if($result == 2){
			$status = $this->lang->line('msg_data_duplicate_name_add');
			$alert = 'alert alert-danger';
		} else {
			$alert = 'alert alert-danger';
			$status = $this->lang->line('msg_data_failure_add');
		}

		$data['alert_modal'] = '
		 <div class="'.$alert.' alert-dismissable" id="modal-status">
	      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	      '.$status.'
	    </div>';
		echo json_encode($data);
		
	}

	function edit_indikator_ajax(){
		$result = $this->mdl_content->edit_indikator($this->input->post('id'));
		if($result==1){
			$status = $this->lang->line('msg_data_success_edit');
			$alert = 'alert alert-success';
		} else {
			$status = $this->lang->line('msg_data_failure_edit');
			$alert = 'alert alert-danger';
		}
		
		$data['alert_modal'] = '
		 <div class="'.$alert.' alert-dismissable" id="modal-status">
	      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	      '.$status.'
	    </div>';
		echo json_encode($data);
		
	}


	function indikator_detail(){
		$result = $this->mdl_content->get_indikator($this->input->post('id'));
		$data['indikator']=$result[0];
		echo json_encode($data);
	}


	function score_teacher_detail(){
		$result = $this->mdl_content->get_score_teacher($this->input->post('id'));
		$data['sc_data']=$result[0];
		echo json_encode($data);
	}



	function add_score_teacher_ajax(){
		$result = $this->mdl_content->add_score_teacher();
		if($result == 1){
			$status = $this->lang->line('msg_data_success_add');
			$alert = 'alert alert-success';
		} else if($result == 2){
			$status = $this->lang->line('msg_data_duplicate_name_add');
			$alert = 'alert alert-danger';
		} else {
			$alert = 'alert alert-danger';
			$status = $this->lang->line('msg_data_failure_add');
		}

		$data['alert_modal'] = '
		 <div class="'.$alert.' alert-dismissable" id="modal-status">
	      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	      '.$status.'
	    </div>';
		echo json_encode($data);
		
	}

	function edit_score_teacher_ajax(){
		
		$result = $this->mdl_content->edit_score_teacher($this->input->post('id'));
		if($result==1){
			$status = $this->lang->line('msg_data_success_edit');
			$alert = 'alert alert-success';
		} else {
			$status = $this->lang->line('msg_data_failure_edit');
			$alert = 'alert alert-danger';
		}
		
		$data['alert_modal'] = '
		 <div class="'.$alert.' alert-dismissable" id="modal-status">
	      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	      '.$status.'
	    </div>';
		echo json_encode($data);
		
	}



	function set_active_tajar($id_tajar){
		$last_url = 'tajar/tajar_crud/0-0';
		$menu_data = $this->menu_handler->get_menu($last_url);
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['all_priviledge'] = $this->mdl_content->get_user_group();
		$data['new_tajar'] = true;
		if($get_priviledge=='1'){
			$result = $this->mdl_content->set_active_tajar($id_tajar);
			$data['daftar'] = $this->mdl_content->get_all_tajar_active();
			if($result == 1){
					$data['daftar'] = $this->mdl_content->get_all_tajar_active();
					$data['status'] = "Pengaturan Tahun Ajaran yang Aktif Berhasil";
					$data['alert'] = 'alert alert-success';
					$this->menu_handler->set_menu('tajar_list',$this->lang->line('label_tajar'),$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
				} else if($result == 2){
					$data['status'] = "Sorry, tahun ajaran name has been used";
					$data['alert'] = 'alert alert-danger';
					$this->menu_handler->set_menu('tajar_list',$this->lang->line('label_tajar'),$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
				} else {
					$data['alert'] = 'alert alert-danger';
					$data['status'] = "Please check again!!!";
					$this->menu_handler->set_menu('tajar_list',$this->lang->line('label_tajar'),$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
				}
		} else {
			$this->menu_handler->error();
		}
	}

	function delete_score_teacher_ajax(){
		
			$this->mdl_content->hapus_score_teacher_permanen($this->input->post('id'));
			$status = $this->lang->line('msg_data_success_permanent_delete');
			$alert = 'alert alert-success';
			$data['alert_modal'] = '
			 <div class="'.$alert.' alert-dismissable" id="modal-status">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      '.$status.'
		    </div>';
			echo json_encode($data);
		
	}

	function input_nilai($course_id,$enduser_id){
		// print_r($course_id.'-'.$enduser_id);
		// die();
		
		$data['view_teacher'] = $this->mdl_content->get_view_teacher_by_course($course_id,$enduser_id); //done
		$result = $this->mdl_content->get_course_student($course_id);// Done
		$data['course_id'] = $course_id;
		$c_info = $this->mdl_content->get_course($course_id);// done
		$data['course'] = $c_info[0];
		$data['student'] = $result;
		$data['enduser_id'] = $enduser_id;
		// print_r($data['enduser_id']);
		// die();
		$data['tajar_active'] = $this->mdl_content->get_ta_active($c_info[0]->institution_id);
		$all_ta = $this->mdl_content->get_all_tajar_active_2($c_info[0]->institution_id);
		$data['all_tajar'] = $all_ta;
		$this->load->view('course_view_student_teacher',$data);
	}

	function indikator_populate_nilai(){
		$daftar = $this->mdl_content->get_indikator_filter_active_nilai();

		$level_id='';
		$ta_id ='';
		if(count($daftar)>0){
			$level_id = $daftar[0]->level_id;
			$ta_id = $daftar[0]->ta_id;
		}
		// 

		// print_r($daftar);
		// die();
		
		$sic = $this->mdl_content->get_course_student($this->input->post('course_id'));
		$count_sic = count($sic);


		$category = $this->mdl_content->get_category_filter_active_nilai($level_id,$ta_id);
		// echo json_encode($category);
		// die();
		$category_nr = $this->mdl_content->get_category_filter_non_repeat_active_with_score($level_id,$ta_id, $this->input->post('course_id'),$this->input->post('vt_id'));
		echo '<div class="col-md-offset-1 col-md-10">';
		$i=1; for ($o = 0; $o<count($daftar);$o++){ 
		 echo '
		 <div style="border-bottom: 1px solid #dddddd; padding-top: 8px; margin-bottom: 10px;" >
            <label>'.$daftar[$o]->name.' </label>'; 
            // <div style="font-size: 12px; padding-bottom: 8px;">'.$daftar[$o]->description.'</div>';
            	foreach ($category as $cate) {
            	echo '
            	<div style="padding-left: 10px;"> '.$cate->title.' 
	              <ul>';

	              	$score_teacher =  $this->mdl_content->get_score_teacher_filter_with_presentage($cate->id,$daftar[$o]->id,$this->input->post('course_id'));
	              	foreach ($score_teacher as $sc) {
	              		echo '
	              		<li style="border-bottom: 1px solid #dddddd; padding-top: 4px; padding-bottom: 4px;" >'.$sc->name.'
	              			<div class="pull-right">
	              				';


	              				if($sc->count_siswa!=null){
	              					echo $sc->count_siswa;
	              				}else{
	              					echo '0';
	              				}

	              		echo	'/'.$count_sic.' &nbsp;&nbsp;
		              			<button class="btn btn-xs btn-info" onClick="prepareEditPenilaianSiswa('.$sc->id.')"><i class="fa fa-edit"></i></button>&nbsp;
		              		
	              			</div>
	              		</li>
	              		';
	              	}
	              
	             echo '
	              </ul>
	            </div>';
            	}
            	
         
	    echo '
          </div>';
      	}


      	foreach ($category_nr as $cate_nr) {
	      	echo '
	      	<div style="border-bottom: 1px solid #ddd;">
            	<label>'.$cate_nr->title.' </label> 
            	<div class="pull-right">';
          				if($cate_nr->count_siswa!=null){
          					echo $cate_nr->count_siswa;
          				}else{
          					echo '0';
          				}

          		echo	'/'.$count_sic.' &nbsp;&nbsp;
              			<button class="btn btn-xs btn-info" onClick="prepareEditPenilaianSiswaNoRepeat('.$cate_nr->id.')"><i class="fa fa-edit"></i></button>&nbsp;
              		
          		</div>
	        </div>';

	    }

	    echo '</div>';
	}

	function populate_siswa_nilai(){
		$student= $this->mdl_content->get_course_student_score($this->input->post('course_id'),$this->input->post('sc_id'));

		$course = $this->mdl_content->get_course($this->input->post('course_id'));
		$subject = $this->mdl_content->get_subject_st_byid($this->input->post('vt_id'),$this->input->post('sc_id'));
		// echo json_encode($subject);
		// die();
		$subj = $subject[0];
		$tables='';
		$tables= $tables.'   
			<div class="table-responsive">
                <table id="data_siswa_nilai" class="table table-bordered table-striped" style="font-size:12px;">
                  <thead>
                    <tr>
                      <th style="width:20px;">No&nbsp;</th>
                      <th>Nama </th>
                      <th style="width:48px;" class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>';
                    $i=1;foreach ($student as $row){
                    $tables = $tables. '
                    <tr>
                      <td style="width:20px;">'.$i.'</td>
                      <td class="text-left">'.$row->fullname.'</td>
                      <td style="width:48px;"><input style="width:48px;" name="number['.$row->id.']" type="number" step="0.01" value="'.$row->score.'" />
                      	  <input name="idx['.$row->id.']" type="text" value="'.$row->score_id.'"style="display:none;" />
                      </td>
                    </tr>';
                    $i++;
                    }
                    $tables=$tables. '
                    </tbody>
                  </table>
              </div>';

                $tables = $tables. '<script>
			        $(function () {
			            $("#data_siswa_nilai").DataTable({
			            	"paging":   false,
					        "ordering": false,
					        "info":     false
			            });
			        });
			    </script>';


		$su = '<Label>'.$subj->subject.'</label> / '.$subj->kd.' / '.$subj->score_category.'/'.$subj->name;

          $data['siswa_table']=$tables;
          $data['course']= $course[0];
          $data['subject']= $su;
          echo json_encode($data);
	}

	function edit_penilaian_score(){
		$id_concat=$this->input->post('id_concat');
		$id_part = explode('-', $id_concat);
		$enduser_id= $this->input->post('enduser_id');
		$cc=0;
		$idxs =  $this->input->post('idx');
		foreach ($this->input->post('number') as $key => $value) {
			$ksd = $idxs[$key]; 
			$record_nilai[$cc] = array(
				'ks_id' => $key,
				'score' => $value,
				'score_id' => $ksd,
				'st_id' => $id_part[0],
				'kelas_id' => $id_part[1],
				'institution_id' => $this->session->userdata('institution_id'),
				'changed_by' => 'GLOBALS',
				'created_date' => date('Y-m-d H:i:s'),
				'created_by' => 'GLOBALS',
				'status'=>'A'
			);
			$cc++;
		}
		// echo json_encode($record_nilai);
		// die();

		$course = $this->mdl_content->add_score_student($record_nilai);

		$this->input_nilai($id_part[1],$enduser_id);
		
		
		// $data['tab']='penilaian';
		// $get_priviledge = $this->session->userdata('user_group_id');
		// $last_url = 'course/course_crud/0-0';
		// $menu_data = $this->menu_handler->get_menu($last_url);
		// if($get_priviledge=='2'){
		// 	$all_ta = $this->mdl_content->get_all_tajar_active();
		// 	$data['all_ta'] = $all_ta;
		// 	$data['daftar'] = $this->mdl_content->get_all_course_active();
		// 	$data['tajar_active']=false;
		// 	foreach ($all_ta as $tajar){
		// 		if($tajar->active_status=='A') {
		// 			$data['tajar_active']=$tajar->id;
		// 			$data['all_teacher']= $this->mdl_content->populate_teacher_for_walikelas($tajar->id);
		// 		}
				
		// 	}

		// 	$data['status'] = "Penilaian telah disimpan";
		// 	$data['alert'] = 'alert alert-success';
		// 	$this->view_student($id_part[1],$data);
		// } else{
		// 	$this->menu_handler->error();
		// }

	}

	function edit_penilaian_score_nr(){
		$id_concat=$this->input->post('id_concat_nr');
		$id_part = explode('-', $id_concat);
		$enduser_id= $this->input->post('enduser_id_nr');
		$cc=0;
		$idxs =  $this->input->post('idxnr');
		foreach ($this->input->post('numbernr') as $key => $value) {
			$ksd = $idxs[$key]; 
			$record_nilai[$cc] = array(
				'ks_id' => $key,
				'score' => $value,
				'score_id' => $ksd,
				'sc_id' => $id_part[0],
				'kelas_id' => $id_part[1],
				'vt_id' => $id_part[2],
				'institution_id' => $this->session->userdata('institution_id'),
				'changed_by' => $this->session->userdata('username'),
				'created_date' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('username'),
				'status'=>'A'
			);
			$cc++;
		}
		// echo json_encode($record_nilai);
		// die();

		$course = $this->mdl_content->add_score_student_nr($record_nilai);
		$this->input_nilai($id_part[1],$enduser_id);
		
		
		// $data['tab']='penilaian';
		// $get_priviledge = $this->session->userdata('user_group_id');
		// $last_url = 'course/course_crud/0-0';
		// $menu_data = $this->menu_handler->get_menu($last_url);
		// if($get_priviledge=='2'){
		// 	$all_ta = $this->mdl_content->get_all_tajar_active();
		// 	$data['all_ta'] = $all_ta;
		// 	$data['daftar'] = $this->mdl_content->get_all_course_active();
		// 	$data['tajar_active']=false;
		// 	foreach ($all_ta as $tajar){
		// 		if($tajar->active_status=='A') {
		// 			$data['tajar_active']=$tajar->id;
		// 			$data['all_teacher']= $this->mdl_content->populate_teacher_for_walikelas($tajar->id);
		// 		}
				
		// 	}

		// 	$data['status'] = "Penilaian telah disimpan";
		// 	$data['alert'] = 'alert alert-success';
		// 	$this->view_student($id_part[1],$data);
		// } else{
		// 	$this->menu_handler->error();
		// }

	}


	function populate_siswa_nilai_no_repeat(){
		$student= $this->mdl_content->get_course_student_score_no_repeat($this->input->post('course_id'),$this->input->post('sc_id'),$this->input->post('vt_id'));
		$course = $this->mdl_content->get_course($this->input->post('course_id'));
		$subject = $this->mdl_content->get_subject_sc_byid($this->input->post('vt_id'));
		$score_categories = $this->mdl_content->get_score_category_byid($this->input->post('sc_id'));
		$subj = $subject[0];
		$sc = $score_categories[0];

		$tables='';
		$tables= $tables.'   
			<div class="table-responsive">
                <table id="data_siswa_nilai" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width:20px;">No&nbsp;</th>
                      <th>Nama </th>
                      <th style="width:48px;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>';
                    $i=1;foreach ($student as $row){
                    $tables = $tables. '
                    <tr>
                      <td style="width:20px;" align="center">'.$i.'</td>
                      <td>'.$row->fullname.'</td>
                      <td style="width:48px;"><input style="width:48px;" name="numbernr['.$row->id.']" type="text" value="'.$row->score.'" />
                      	  <input name="idxnr['.$row->id.']" type="text" value="'.$row->score_id.'"style="display:none;" />
                      </td>
                    </tr>';
                    $i++;
                    }
                    $tables=$tables. '
                    </tbody>
                  </table>
              </div>';

                $tables = $tables. '<script>
			        $(function () {
			            $("#data_siswa_nilai").DataTable({
			            	"paging":   false,
					        "ordering": false,
					        "info":     false
			            });
			        });
			    </script>';


		$su = '<Label>'.$subj->subject.'</label> / '.$sc->title;

          $data['siswa_table']=$tables;
          $data['course']= $course[0];
          $data['subject']= $su;
          echo json_encode($data);
	}


/// WALAS
	function view_student_walikelas($course_id,$enduser_id){
		$data['view_teacher'] = $this->mdl_content->get_view_teacher_by_course($course_id,$enduser_id); 
		$result = $this->mdl_content->get_course_student($course_id);
		$data['course_id'] = $course_id;
		$c_info = $this->mdl_content->get_course($course_id);


		if($this->session->userdata('classification')==1){
			$data['score_categories']=$this->mdl_content->get_score_category_tk($c_info[0]->tingkat_id,$c_info[0]->ta_id,$enduser_id);
		}

		
		$data['course'] = $c_info[0];
		$data['enduser_id'] = $enduser_id;
		// print_r($data['course']);
		// die();
		$data['student'] = $result;
		$data['tajar_active'] = $this->mdl_content->get_ta_active($c_info[0]->institution_id);
		$all_ta = $this->mdl_content->get_all_tajar_active_2($c_info[0]->institution_id);
		$data['all_tajar'] = $all_ta;
		
		$this->load->view('course_view_student_walikelas',$data);
	}

	function populate_presensi_walikelas(){
		// $student= $this->mdl_content->get_course_student_score($this->input->post('course_id'),$this->input->post('sc_id'));
		$student= $this->mdl_content->get_course_student_presensi($this->input->post('course_id'));
		
		$tables='';
		$tables= $tables.
			'   
			<div class="table-responsive" style="font-size:12px !important;">
                <table id="data_siswa_nilai" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width:15px !important;">No&nbsp;</th>
                      <th class="text-left">Nama </th>
                      <th style="width:20px;" class="text-center">I</th>
                      <th style="width:20px;" class="text-center">S</th>
                      <th style="width:20px;" class="text-center">A</th>
                    </tr>
                    </thead>
                    <tbody>';
                    $i=1;foreach ($student as $row){
                    $izin='<td style="width:20px;" class="text-center text-bold"> - </td>'; 
                    $sakit='<td style="width:20px;" class="text-center text-bold"> - </td>'; 
                    $alpha='<td style="width:20px;" class="text-center text-bold"> - </td>';

                    if($row->izin!=''){$izin = '<td style="width:20px;" class="text-olive text-center text-bold">'.$row->izin.'</td>';}
                    if($row->sakit!=''){$sakit = '<td style="width:20px;" class="text-orange text-center text-bold">'.$row->sakit.'</td>';}
                    if($row->alpha!=''){$alpha = '<td style="width:20px;" class="text-red text-center text-bold">'.$row->alpha.'</td>';}

                    $tables = $tables. '
                    <tr>
                      <td style="width:15px !important;">'.$i.'</td>
                      <td class="text-left">'.$row->fullname.'</td>
                      '.$izin.'
                      '.$sakit.'
                      '.$alpha.'
                    </tr>';
                    $i++;
                    }
                    $tables=$tables. '
                    </tbody>
                  </table>
              </div>';

                $tables = $tables. '<script>
			        $(function () {
			            $("#data_siswa_nilai").DataTable({
			            	"paging":   false,
					        "ordering": false,
					        "info":     false
			            });
			        });
			    </script>';


		// $su = '<Label>'.$subj->subject.'</label> / '.$subj->kd.' / '.$subj->score_category.'/'.$subj->name;

          $data['siswa_table']=$tables;

          echo json_encode($data);
	}

	function populate_siswa_prepare_absensi(){
		$student= $this->mdl_content->get_course_student_presensi_prepare($this->input->post('course_id'));
		$course = $this->mdl_content->get_course($this->input->post('course_id'));

		$tables='';
		$tables= $tables.'   
			<div class="table-responsive" style="font-size:12px !important;">
                <table id="data_siswa_presensi" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width:15px;">No&nbsp;</th>
                      <th>Nama </th>
                      <th style="width:40px;">Aksi</th>
                      <th style="width:48px;">Ket</th>
                    </tr>
                    </thead>
                    <tbody>';
                    $i=1;foreach ($student as $row){
                    $tables = $tables. '
                    <tr>
                      <td style="width:15px;" align="center">'.$i.'</td>
                      <td>'.$row->fullname.'</td>
                      <td>
                      	<select name="types['.$row->id.']"  style="width:40px;">
                          <option value = "" '; 
                          if($row->type==null){ $tables=$tables. 'selected="Selected"'; }
                          $tables=$tables. '>Hadir</option>
                         
                          <option value = "S" ';
                          if($row->type=='S'){ $tables=$tables. 'selected="Selected"'; }
                          $tables=$tables.'>Sakit</option>

                          <option value = "I" ';
                          if($row->type=='I'){ $tables=$tables. 'selected="Selected"'; }
                          $tables=$tables.'>Izin</option>

                          <option value = "A" ';
                           if($row->type=='A'){ $tables=$tables. 'selected="Selected"'; }
                          $tables=$tables.'>Alpha</option>
                       	</select>
                      	<input name="idx['.$row->id.']" type="text" value="'.$row->abs_id.'"  style="display:none;" />
                      </td>
                      <td style="width:48px;">
                      <input style="width:48px;" name="description['.$row->id.']" type="text" value="'.$row->description.'"  />
                      </td>
                    </tr>';
                    $i++;
                    }
                    $tables=$tables. '
                    </tbody>
                  </table>
              </div>';

                $tables = $tables. '<script>
			        $(function () {
			            $("#data_siswa_presensi").DataTable({
			            	"paging":   false,
					        "ordering": false,
					        "info":     false
			            });
			        });
			    </script>';



          $data['siswa_table']=$tables;
          $data['course']= $course[0];
          $data['post_print']= json_encode($this->input->post());
          echo json_encode($data);
	}

	function edit_presensi_walikelas(){
		$id_concat=$this->input->post('id_concat');
		$ta_active_id = $this->mdl_content->get_ta_active($this->input->post('institution_id'));

		$cc=0;
		$idxs =  $this->input->post('idx');
		$description =  $this->input->post('description');
		foreach ($this->input->post('types') as $key => $value) {
			$descp = $description[$key]; 
			$abs_id  = $idxs[$key]; 

			$dt1 = $this->input->post('a_start_date');
			if($dt1!=''){
				$dte  = $dt1;
				$dt   = new DateTime();
				$date = $dt->createFromFormat('d-m-Y', $dte);
				$dt1fix =  $date->format('Y-m-d');
				// $sqlAddon = $dte;
			}


			$record_nilai[$cc] = array(
				'abs_id' => $abs_id,
				'profile_id' => $key,
				'type' => $value,
				'record_date' => $dt1fix,
				'description' => $descp,
				'ta_id' => $ta_active_id,
				'kelas_id' => $this->input->post('a_course_id'),
				'institution_id' => $this->input->post('institution_id'),
				'changed_by' => $this->input->post('enduser_id'),
				'created_date' => date('Y-m-d H:i:s'),
				'created_by' => $this->input->post('enduser_id'),
				'status'=>'A'
			);
			$cc++;
		}
		// print_r($record_nilai);
		// die();
		$course = $this->mdl_content->add_presensi_student($record_nilai);

		
		$this->view_student_walikelas($this->input->post('a_course_id'),$this->input->post('enduser_id'));
		
	}



	
}