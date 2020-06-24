<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class alldata extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_content');
	}
	
// PERLU DIUBAH
	function data_crud($tes){
		$title_page='Data Besar';
		$title_trash='Kotak Sampah - Pendaftaran';

		$get_priviledge = $this->session->userdata('user_group_id');
		$status = explode('-',$tes);
		$cas = $status[1];

		$primary_id = $status[0];
		$last_url = 'alldata/data_crud/0-0';
		if(($cas >= '4') && ($cas !== '7')){
			$last_url = 'alldata/data_crud/0-4';		
		}
		$menu_data = $this->menu_handler->get_menu($last_url);
		$institution_id= $this->session->userdata('institution_id');
		$data['country'] = $this->mdl_content->get_all_country();
		$data['doc'] = $this->mdl_content->get_all_doc();
		$data['masakan'] = $this->mdl_content->get_all_masakan();
		// $data['all_tajar'] =$this->mdl_content->get_all_tajar_active();
		// $data['tajar_active'] =$this->mdl_content->get_ta_active($institution_id);
		// $data['all_tingkat'] =$this->mdl_content->populate_tingkat();
		switch($cas){
			case 0: // FOR SHOW ALL lawyerS
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list',$title_page,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else if($get_priviledge=='2'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list',$title_page,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
			case 4: // UNTUK TAMPILKAN TRASH event
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_trash',$title_trash ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else if($get_priviledge=='2'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_trash',$title_trash ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
			
			default:
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list',$title_page ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else if($get_priviledge=='2'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list',$title_page ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
		}
	}
	
    function populate_data(){
    	$res = $this->mdl_content->get_all_data_active();

    	$tables='';
    	$tables = $tables.'
    	 <div class="table-responsive">
            <table id="tbl_data" class="table table-bordered table-striped" style="width:100%;">
              <thead>
                <tr>
                  <th style="width:5%;">No&nbsp;</th>
                  <th style="width:25%;">Nama</th>
                  <th style="width:10%;">Tujuan</th>
                  <th style="width:20%;">Tempat, Tanggal Lahir</th>
                  <th style="width:10%;">Sponsor</th>
                  <th style="width:10%;">Agen</th>
                  <th style="width:10%;">Status</th>
                  <th style="width:10%;">Aksi</th>
                </tr>
              </thead>
              <tbody>';
				$i=1;
				foreach ($res as $row){
					if($row->dob!=NULL) {
						 $date = date('d-m-Y', strtotime($row->dob));
	                     $dateofbirth = str_replace('-', '/', $date);
                    } else {
                    	$dateofbirth = "";
                    }

					if($row->proses=="MDC") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahmedical(this);">'.$row->statusproses.'</a>';
					} else if($row->proses=="PSP") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahpasport(this);">'.$row->statusproses.'</a>';
					} else if($row->proses=="PSJ") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahpanggilan(this);">'.$row->statusproses.'</a>';
					} else if($row->proses=="SJ") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahsidikjari(this);">'.$row->statusproses.'</a>';
					} else if($row->proses=="RTB") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahready(this);">'.$row->statusproses.'</a>';
					} else if($row->proses=="PTB") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahcall(this);">'.$row->statusproses.'</a>';
					} else if($row->proses=="TB") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" >'.$row->statusproses.'</a>';
					}


                $tables = $tables.'
				<tr>
  					<td align="center">'.$i.'</td>
                  	<td><a href="'.site_url('pendaftaran/data_detail/'.$row->id).'">'.$row->name.'</a></td>
                  	<td>'.$row->countryname.'</td>
                  	<td>'.$row->pob.', '.$dateofbirth.'</td>
                  	<td>'.$row->sponsorname.'</td>
                  	<td>'.$row->agen.'</td>
                  	<td>'.$row->statusproses.'</td>
                    <td align="center">
                    	
                        <a class="btn btn-success-o btn-xs"  href="'.site_url('pendaftaran/profil/'.$row->id).'" rel="tooltip-top" title="Profile" ><i class="fa fa-user"></i></a>
                        <button class="btn btn-warning btn-xs" onClick="prepare_delete_data('.$row->id.')"><i class="fa fa-trash-alt"></i></button>
                  	</td>
				</tr>';
  				$i++;
  				} 

        $tables = $tables.'
                </tbody>
              </table>
          </div>
		 <script>
	        $(function () {
	            $("#tbl_data").DataTable();
	        });
	    </script>';

    	$data['table_data'] =$tables;
    	echo json_encode($data);
    }

    function populate_data_deactive(){
		$default_date = '0000-00-00';
    	$institution_id= $this->session->userdata('institution_id');
    	$res = $this->mdl_content->get_all_data_deactive($institution_id);
    	$tables='';
    	$tables = $tables.'
    	 <div class="table-responsive">
            <table id="tbl_data" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width:5%;">No&nbsp;</th>
                  <th style="width:25%;">Nama</th>
                  <th style="width:10%;">Kode Klient</th>
                  <th style="width:20%;">Username</th>
                  <th style="width:15%;">Email</th>
                  <th style="width:15%;">Tlp</th>
                  <th style="width:15%;">Aksi</th>
                </tr>
              </thead>
              <tbody>';
				$i=1;
				foreach ($res as $row){
			    $tables = $tables.'
				<tr>
  					<td align="center">'.$i.'</td>
                  	<td>'.$row->fullname.'</td>
                  	<td>'.$row->unique_id.'</td>
                  	<td>'.$row->username.'</td>
                  	<td>'.$row->email.'</td>
                  	<td>'.$row->phone.'</td>
                    <td>
                    <div class="pull-right">
                        <button class="btn btn-primary btn-xs" onClick="ajax_restore_data('.$row->id.')"><i class="fa fa-undo"></i></button>
                        <button class="btn btn-danger btn-xs" onClick="prepare_delete_data('.$row->id.')"><i class="fa fa-trash-alt"></i></button>
                       
                    </div>
                  </td>
				</tr>';
  				$i++;
  				} 

        $tables = $tables.'
                </tbody>
              </table>
          </div>
		 <script>
	        $(function () {
	            $("#tbl_data").DataTable();
	        });
	    </script>';

    	$data['table_data'] =$tables;
    	echo json_encode($data);
    }

    

// TDK PERLU DIUBAH    
    function add_data(){
		$get_priviledge = $this->session->userdata('user_group_id');

		if($get_priviledge=='1'){
			$result = $this->mdl_content->add_data();
			if($result == 1){
					$status = $this->lang->line('msg_data_success_add');
					$alert = 'alert alert-success';
				} else if($result == 2){
					$status =$this->lang->line('msg_data_duplicate_name_add');
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
			
		} else if($get_priviledge=='2'){
			$result = $this->mdl_content->add_data('');
			if($result == 1){
					$status = $this->lang->line('msg_data_success_add');
					$alert = 'alert alert-success';
				} else if($result == 2){
					$status =$this->lang->line('msg_data_duplicate_name_add');
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
		} else {
			$this->menu_handler->error();
		}
	}

	function edit_data(){
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['new_subject'] = true;
		if($get_priviledge=='1'){
			$result = $this->mdl_content->edit_data($this->input->post('id'));
			if($result == 1){
				$status = $this->lang->line('msg_data_success_edit');
				$alert = 'alert alert-success';
			} else if($result == 2){
				$status =$this->lang->line('msg_data_duplicate_name_add');
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
		} else if($get_priviledge=='2'){
			$result = $this->mdl_content->edit_data($this->input->post('id'));
			if($result == 1){
				$status = $this->lang->line('msg_data_success_edit');
				$alert = 'alert alert-success';
			} else if($result == 2){
				$status =$this->lang->line('msg_data_duplicate_name_add');
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
		} else {
			$this->menu_handler->error();
		}
	}

	function data_detail(){
    	$result= $this->mdl_content->get_data($this->input->post('id'));
    	$data['item'] = $result[0];
    	echo json_encode($data);
    }

	function delete_data(){
		$get_priviledge = $this->session->userdata('user_group_id');
			$this->mdl_content->hapus_data($this->input->post('id'));
			$status = $this->lang->line('msg_data_success_delete');
			$alert = 'alert alert-success';
			$data['alert_modal'] = '
			 <div class="'.$alert.' alert-dismissable" id="modal-status">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      '.$status.'
		    </div>';
			echo json_encode($data);
	}

	function delete_data_permanent(){
		$get_priviledge = $this->session->userdata('user_group_id');
		if($get_priviledge=='1'){
			$this->mdl_content->hapus_data_permanent($this->input->post('id'));
			$status = $this->lang->line('msg_data_success_delete');
			$alert = 'alert alert-success';
			$data['alert_modal'] = '
			 <div class="'.$alert.' alert-dismissable" id="modal-status">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      '.$status.'
		    </div>';
			echo json_encode($data);
		} else if($get_priviledge=='2'){
			$this->mdl_content->hapus_data_permanent($this->input->post('id'));
			$status = $this->lang->line('msg_data_success_delete');
			$alert = 'alert alert-success';
			$data['alert_modal'] = '
			 <div class="'.$alert.' alert-dismissable" id="modal-status">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      '.$status.'
		    </div>';
			echo json_encode($data);
		} else {
			$this->menu_handler->error();
		}
	}

	function restore_data(){
		$get_priviledge = $this->session->userdata('user_group_id');
		if($get_priviledge=='1'){
			$this->mdl_content->restore_data($this->input->post('id'));
			$status = $this->lang->line('msg_data_success_restore');
			$alert = 'alert alert-success';
			$data['alert_modal'] = '
			 <div class="'.$alert.' alert-dismissable" id="modal-status">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      '.$status.'
		    </div>';
			echo json_encode($data);
		} else if($get_priviledge=='2'){
			$this->mdl_content->restore_data($this->input->post('id'));
			$status = $this->lang->line('msg_data_success_restore');
			$alert = 'alert alert-success';
			$data['alert_modal'] = '
			 <div class="'.$alert.' alert-dismissable" id="modal-status">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      '.$status.'
		    </div>';
			echo json_encode($data);
		} else {
			$this->menu_handler->error();
		}
	}

	function client_detail($id){
		$last_url = 'clients/clients_crud/0-0';
		$menu_data = $this->menu_handler->get_menu($last_url);
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['questions'] = $this->mdl_content->get_all_event_byclient($id);
		$client = $this->mdl_content->get_data($id);
		$data['client'] = $client[0];

		$this->menu_handler->set_menu('client_detail','Client',$data,5,9);
	}

	

	function ubah_medical() {
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['new_subject'] = true;
			$result = $this->mdl_content->edit_medical($this->input->post('m_id'));
			if($result == 1){
				$status = $this->lang->line('msg_data_success_edit');
				$alert = 'alert alert-success';
			} else if($result == 2){
				$status =$this->lang->line('msg_data_duplicate_name_add');
				$alert = 'alert alert-danger';
			} else {
				$alert = 'alert alert-danger';
				$status = $this->lang->line('msg_data_failure_add');
			}

			redirect('pendaftaran/pendaftaran_crud/0-0');
	}

	function ubah_paspor() {
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['new_subject'] = true;
			$result = $this->mdl_content->edit_paspor($this->input->post('p_id'));
			if($result == 1){
				$status = $this->lang->line('msg_data_success_edit');
				$alert = 'alert alert-success';
			} else if($result == 2){
				$status =$this->lang->line('msg_data_duplicate_name_add');
				$alert = 'alert alert-danger';
			} else {
				$alert = 'alert alert-danger';
				$status = $this->lang->line('msg_data_failure_add');
			}

			redirect('pendaftaran/pendaftaran_crud/0-0');
	}

	function ubah_psj() {
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['new_subject'] = true;
			$result = $this->mdl_content->edit_psj($this->input->post('s_id'));
			if($result == 1){
				$status = $this->lang->line('msg_data_success_edit');
				$alert = 'alert alert-success';
			} else if($result == 2){
				$status =$this->lang->line('msg_data_duplicate_name_add');
				$alert = 'alert alert-danger';
			} else {
				$alert = 'alert alert-danger';
				$status = $this->lang->line('msg_data_failure_add');
			}

			redirect('terbang/pt_crud/0-0');
	}

	function ubah_sj() {
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['new_subject'] = true;
			$result = $this->mdl_content->edit_sj($this->input->post('j_id'));
			if($result == 1){
				$status = $this->lang->line('msg_data_success_edit');
				$alert = 'alert alert-success';
			} else if($result == 2){
				$status =$this->lang->line('msg_data_duplicate_name_add');
				$alert = 'alert alert-danger';
			} else {
				$alert = 'alert alert-danger';
				$status = $this->lang->line('msg_data_failure_add');
			}

			redirect('pendaftaran/pendaftaran_crud/0-0');
	}

	function ubah_ptb() {
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['new_subject'] = true;
			$result = $this->mdl_content->edit_psj($this->input->post('t_id'));
			if($result == 1){
				$status = $this->lang->line('msg_data_success_edit');
				$alert = 'alert alert-success';
			} else if($result == 2){
				$status =$this->lang->line('msg_data_duplicate_name_add');
				$alert = 'alert alert-danger';
			} else {
				$alert = 'alert alert-danger';
				$status = $this->lang->line('msg_data_failure_add');
			}

			redirect('terbang/rt_crud/0-0');
	}

	function ubah_call() {
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['new_subject'] = true;
			$result = $this->mdl_content->edit_call($this->input->post('b_id'));
			if($result == 1){
				$status = $this->lang->line('msg_data_success_edit');
				$alert = 'alert alert-success';
			} else if($result == 2){
				$status =$this->lang->line('msg_data_duplicate_name_add');
				$alert = 'alert alert-danger';
			} else {
				$alert = 'alert alert-danger';
				$status = $this->lang->line('msg_data_failure_add');
			}

			redirect('terbang/pt_crud/0-0');
	}

	function profil($anggota_id,$prevdata=''){
		$last_url = 'pendaftaran/pendaftaran_crud/0-0';
		$menu_data = $this->menu_handler->get_menu($last_url);
		$get_priviledge = $this->session->userdata('user_group_id');
		$institution_id = $this->session->userdata('institution_id');
			$profile_id= $this->mdl_content->get_id_profile($anggota_id);
			$data['profil'] = $profile_id[0];
			$data['file'] = $this->mdl_content->get_file_upload($anggota_id);
			$data['children'] = $this->mdl_content->get_children_byid($anggota_id);
			$data['ahli'] = $this->mdl_content->get_keahlian_byid($anggota_id);
			$data['exp'] = $this->mdl_content->get_pengalaman_byid($anggota_id);
			$data['fileupload'] = $this->mdl_content->get_file_byid($anggota_id);
			$data['doc'] = $this->mdl_content->get_doc_upload($anggota_id);
			$data['jurnal'] = $this->mdl_content->get_transaction($anggota_id);
			$data['account'] = $this->mdl_content->get_all_account();
			
			$this->menu_handler->set_menu('profile','Profil Anggota',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
	}

	function upload_doc() {
		$anggota_id = $this->input->post('idx');
		$get_priviledge = $this->session->userdata('user_group_id');
		$data['new_subject'] = true;
			$result = $this->mdl_content->upload_doc($this->input->post('b_id'));
			if($result == 1){
				$status = $this->lang->line('msg_data_success_edit');
				$alert = 'alert alert-success';
			} else if($result == 2){
				$status =$this->lang->line('msg_data_duplicate_name_add');
				$alert = 'alert alert-danger';
			} else {
				$alert = 'alert alert-danger';
				$status = $this->lang->line('msg_data_failure_add');
			}

			redirect('pendaftaran/profil/'.$anggota_id);
	}

	function rt_crud($tes){
		$title_page='Pendaftaran - Ready Terbang';
		$title_trash='Kotak Sampah - Pendaftaran';

		$get_priviledge = $this->session->userdata('user_group_id');
		$status = explode('-',$tes);
		$cas = $status[1];

		$primary_id = $status[0];
		$last_url = 'terbang/rt_crud/0-0';
		if(($cas >= '4') && ($cas !== '7')){
			$last_url = 'terbang/rt_crud/0-4';		
		}
		$menu_data = $this->menu_handler->get_menu($last_url);
		$institution_id= $this->session->userdata('institution_id');
		$data['country'] = $this->mdl_content->get_all_country();
		$data['doc'] = $this->mdl_content->get_all_doc();
		$data['masakan'] = $this->mdl_content->get_all_masakan();
		// $data['all_tajar'] =$this->mdl_content->get_all_tajar_active();
		// $data['tajar_active'] =$this->mdl_content->get_ta_active($institution_id);
		// $data['all_tingkat'] =$this->mdl_content->populate_tingkat();
		switch($cas){
			case 0: // FOR SHOW ALL lawyerS
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list_rt',$title_page,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else if($get_priviledge=='2'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list_rt',$title_page,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
			case 4: // UNTUK TAMPILKAN TRASH event
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_trash',$title_trash ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else if($get_priviledge=='2'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_trash',$title_trash ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
			
			default:
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list_rt',$title_page ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else if($get_priviledge=='2'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list_rt',$title_page ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
		}
	}
	
    function populate_data_rt(){
    	$res = $this->mdl_content->get_all_data_rt();

    	$tables='';
    	$tables = $tables.'
    	 <div class="table-responsive">
            <table id="tbl_data" class="table table-bordered table-striped" style="width:100%;">
              <thead>
                <tr>
                  <th style="width:5%;">No&nbsp;</th>
                  <th style="width:25%;">Nama</th>
                  <th style="width:10%;">Tujuan</th>
                  <th style="width:20%;">Tempat, Tanggal Lahir</th>
                  <th style="width:10%;">Sponsor</th>
                  <th style="width:10%;">Agen</th>
                  <th style="width:10%;">Aksi</th>
                </tr>
              </thead>
              <tbody>';
				$i=1;
				foreach ($res as $row){
					if($row->dob!=NULL) {
						 $date = date('d-m-Y', strtotime($row->dob));
	                     $dateofbirth = str_replace('-', '/', $date);
                    } else {
                    	$dateofbirth = "";
                    }

					if($row->proses=="MDC") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahmedical(this);">'.$row->statusproses.'</a>';
					} else if($row->proses=="PSP") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahpasport(this);">'.$row->statusproses.'</a>';
					} else if($row->proses=="PSJ") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahpanggilan(this);">'.$row->statusproses.'</a>';
					} else if($row->proses=="SJ") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahsidikjari(this);">'.$row->statusproses.'</a>';
					} else if($row->proses=="RTB") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahready(this);">'.$row->statusproses.'</a>';
					} else if($row->proses=="PTB") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahcall(this);">'.$row->statusproses.'</a>';
					} else if($row->proses=="TB") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" >'.$row->statusproses.'</a>';
					}


                $tables = $tables.'
				<tr>
  					<td align="center">'.$i.'</td>
                  	<td><a href="'.site_url('pendaftaran/data_detail/'.$row->id).'">'.$row->name.'</a></td>
                  	<td>'.$row->countryname.'</td>
                  	<td>'.$row->pob.', '.$dateofbirth.'</td>
                  	<td>'.$row->sponsor.'</td>
                  	<td>'.$row->agen.'</td>
                    <td align="center">
                    	<a class="btn btn-success-o btn-xs" href="#"  id="'.$row->id.'" onClick="ubahready(this);"
                        rel="tooltip-top" title="Ubah Proses" ><i class="fa fa-edit"></i></a>
                        <a class="btn btn-success-o btn-xs"  href="'.site_url('pendaftaran/profil/'.$row->id).'" rel="tooltip-top" title="Profile" ><i class="fa fa-user"></i></a>
                        <button class="btn btn-warning btn-xs" onClick="prepare_delete_data('.$row->id.')"><i class="fa fa-trash-alt"></i></button>
                  	</td>
				</tr>';
  				$i++;
  				} 

        $tables = $tables.'
                </tbody>
              </table>
          </div>
		 <script>
	        $(function () {
	            $("#tbl_data").DataTable();
	        });
	    </script>';

    	$data['table_data'] =$tables;
    	echo json_encode($data);
    }

    function pt_crud($tes){
		$title_page='Pendaftaran - Panggilan Terbang';
		$title_trash='Kotak Sampah - Pendaftaran';

		$get_priviledge = $this->session->userdata('user_group_id');
		$status = explode('-',$tes);
		$cas = $status[1];

		$primary_id = $status[0];
		$last_url = 'terbang/pt_crud/0-0';
		if(($cas >= '4') && ($cas !== '7')){
			$last_url = 'terbang/pt_crud/0-4';		
		}
		$menu_data = $this->menu_handler->get_menu($last_url);
		$institution_id= $this->session->userdata('institution_id');
		$data['country'] = $this->mdl_content->get_all_country();
		$data['doc'] = $this->mdl_content->get_all_doc();
		$data['masakan'] = $this->mdl_content->get_all_masakan();
		// $data['all_tajar'] =$this->mdl_content->get_all_tajar_active();
		// $data['tajar_active'] =$this->mdl_content->get_ta_active($institution_id);
		// $data['all_tingkat'] =$this->mdl_content->populate_tingkat();
		switch($cas){
			case 0: // FOR SHOW ALL lawyerS
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list_pt',$title_page,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else if($get_priviledge=='2'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list_pt',$title_page,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
			case 4: // UNTUK TAMPILKAN TRASH event
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_trash',$title_trash ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else if($get_priviledge=='2'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_trash',$title_trash ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
			
			default:
					if($get_priviledge=='1'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list_pt',$title_page ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else if($get_priviledge=='2'){
						$data['daftar'] = null;
						$this->menu_handler->set_menu('data_list_pt',$title_page ,$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					}else {
						$this->menu_handler->error();
					}
					break;
		}
	}
	
    function populate_data_pt(){
    	$res = $this->mdl_content->get_all_data_pt();

    	$tables='';
    	$tables = $tables.'
    	 <div class="table-responsive">
            <table id="tbl_data" class="table table-bordered table-striped" style="width:100%;">
              <thead>
                <tr>
                  <th style="width:5%;">No&nbsp;</th>
                  <th style="width:15%;">Nama</th>
                  <th style="width:10%;">Tujuan</th>
                  <th style="width:15%;">Tempat, Tanggal Lahir</th>
                  <th style="width:10%;">Sponsor</th>
                  <th style="width:5%;">Agen</th>
                  <th style="width:10%;">Tgl Terbang</th>
                  <th style="width:10%;">Penerbangan Dari Kota</th>
                  <th style="width:10%;">Update Data</th>
                  <th style="width:20%;">Aksi</th>
                </tr>
              </thead>
              <tbody>';
				$i=1;
				foreach ($res as $row){
					if($row->dob!=NULL) {
						 $date = date('d-m-Y', strtotime($row->dob));
	                     $dateofbirth = str_replace('-', '/', $date);
                    } else {
                    	$dateofbirth = "";
                    }

                    if($row->tgl_terbang!=NULL) {
						$tgl_terbang = date('d-m-Y', strtotime($row->tgl_terbang));
	                     $tglterbang = str_replace('-', '/', $tgl_terbang);
	                 } else {
                    	$tgl_terbang = "";
                    }

					if($row->proses=="MDC") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahmedical(this);">Update Data</a>';
					} else if($row->proses=="PSP") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahpasport(this);">Update Data</a>';
					} else if($row->proses=="PSJ") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahpanggilan(this);">Update Data</a>';
					} else if($row->proses=="SJ") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahsidikjari(this);">Update Data</a>';
					} else if($row->proses=="RTB") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahready(this);">Update Data</a>';
					} else if($row->proses=="PTB") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" onClick="ubahcall(this);">Update Data</a>';
					} else if($row->proses=="TB") {
						$status = '<a class="btn btn-success-o btn-xs"  id="'.$row->id.'" >Update Data</a>';
					}


                $tables = $tables.'
				<tr>
  					<td align="center">'.$i.'</td>
                  	<td><a href="'.site_url('pendaftaran/data_detail/'.$row->id).'">'.$row->name.'</a></td>
                  	<td>'.$row->countryname.'</td>
                  	<td>'.$row->pob.', '.$dateofbirth.'</td>
                  	<td>'.$row->sponsor.'</td>
                  	<td>'.$row->agen.'</td>
                  	<td>'.$tglterbang.'</td>
                  	<td>'.$row->call_from.'</td>
                  	<td>'.$status.'</td>
                    <td align="center">
                    	<a class="btn btn-success-o btn-xs" href="#"  id="'.$row->id.'" onClick="ubahpanggilan(this);"
                        rel="tooltip-top" title="Ubah Proses" ><i class="fa fa-edit"></i></a>
                        <a class="btn btn-success-o btn-xs"  href="'.site_url('pendaftaran/profil/'.$row->id).'" rel="tooltip-top" title="Profile" ><i class="fa fa-user"></i></a>
                        <button class="btn btn-warning btn-xs" onClick="prepare_delete_data('.$row->id.')"><i class="fa fa-trash-alt"></i></button>
                  	</td>
				</tr>';
  				$i++;
  				} 

        $tables = $tables.'
                </tbody>
              </table>
          </div>
		 <script>
	        $(function () {
	            $("#tbl_data").DataTable();
	        });
	    </script>';

    	$data['table_data'] =$tables;
    	echo json_encode($data);
    }

    function export_data(){
    	$last_url = 'alldata/data_crud/0-0';
		$menu_data = $this->menu_handler->get_menu($last_url);
		$get_priviledge = $this->session->userdata('user_group_id');
		
			$alldata = $this->mdl_content->get_all_data_active();
			$data['data']=$alldata;

			$this->load->view('data_export',$data);
		}
}