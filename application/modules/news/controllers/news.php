<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class news extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_content');
	}
	
// PERLU DIUBAH
	function news_crud($tes){
		$title_page='Management Berita';
		$title_trash='Kotak Sampah - Pendaftaran';

		$get_priviledge = $this->session->userdata('user_group_id');
		$status = explode('-',$tes);
		$cas = $status[1];

		$primary_id = $status[0];
		$last_url = 'news/news_crud/0-0';
		if(($cas >= '4') && ($cas !== '7')){
			$last_url = 'news/news_crud/0-4';		
		}
		$menu_data = $this->menu_handler->get_menu($last_url);
		$institution_id= $this->session->userdata('institution_id');
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
			case 1: // UNTUK ADD 
					// if($get_priviledge=='1'){
						$data['new_data'] = true;
						$this->menu_handler->set_menu('news_detail','Input Berita Baru',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					// } else {
					// 	$this->menu_handler->error();
					// }
					break;
			case 2: // UNTUK EDIT
					if($get_priviledge==CA){
						$edit_school = $this->mdl_content->get_news_byid($status[0]);
						$data['data'] = $edit_school[0];
						$this->menu_handler->set_menu('news_detail','Edit Berita',$data,$menu_data['menu_row'],$menu_data['sub_menu_row']);
					} else {
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
    	$default_date = '0000-00-00';
    	$res = $this->mdl_content->get_all_news_active();

    	$tables='';
    	$tables = $tables.'
    	 <div class="table-responsive">
            <table id="tbl_data" class="table table-bordered table-striped" style="width:100%;">
              <thead>
                <tr>
                  <th style="width:5%;">No&nbsp;</th>
                  <th style="width:15%;">Judul</th>
                  <th style="width:40%;">Isi</th>
                  <th style="width:15%;">Tanggal Publikasi</th>
                  <th style="width:15%;">Selesai Publikasi</th>
                  <th style="width:10%;">Aksi</th>
                </tr>
              </thead>
              <tbody>';
				$i=1;
				foreach ($res as $row){

				$StartDate = date("d/m/Y", strtotime($row->publish_date));
				$EndDate = date("d/m/Y", strtotime($row->unpublish_date));

                $tables = $tables.'
				<tr>
  					<td align="center">'.$i.'</td>
                  	<td>'.$row->title.'</td>
                  	<td>'.$row->content.'</td>
                  	<td>'.$StartDate.'</td>
                  	<td>'.$EndDate.'</td>
                    <td align="center">
                        <a class="btn btn-warning btn-xs" href="'.site_url('news/news_crud/'.$row->id.'-2').'"          rel="tooltip-top" title="Edit"><i class="fa fa-edit"></i></a>
                        <button class="btn btn-danger btn-xs" onClick="prepare_delete_data('.$row->id.')"><i class="fa fa-trash-alt"></i></button>
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

	function add_news(){
		$new_news_config = $_POST['new_news_config'];
		if($new_news_config==true){  // ADD PROJECT

			$imgName = 'img_news_'.time().'.jpg';
			$config['file_name']			= $imgName;
	        $config['upload_path']          = FCPATH.'data/news/';
	        $config['allowed_types']        = 'gif|jpg|jpeg|png';
			$config['overwrite']			= true;
	        $config['max_size']             = 10000;
	        $config['max_width']            = 2048;
	        $config['max_height']           = 2048;

	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);

	        if(!$this->load->library('upload', $config)) {
            	$error = $this->upload->display_errors();
            	$img = "";
	        } else {
	        	$this->upload->initialize($config);
	        	$this->upload->do_upload('image');
	            $result = $this->upload->data();

				$img =$imgName;
			}

			$this->add_news_config($img);
        }else{	// EDIT PROJECT
        	$imgName = $_POST['img'];
        	
        	if( $_POST['img']==''){
        		$imgName = 'img_news_'.time().'.jpg';
        	}
        	// print_r($imgName);
        	// die();
        	$_POST['img'] =$imgName;

			$config['file_name']			= $imgName;
	        $config['upload_path']          = FCPATH.'data/news/';
	        $config['allowed_types']        = 'gif|jpg|jpeg|png';
			$config['overwrite']			= true;
	        $config['max_size']             = 10000;
	        $config['max_width']            = 2048;
	        $config['max_height']           = 2048;

	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);

	        if ( ! $this->upload->do_upload('image')){
	            $error = array('error' => $this->upload->display_errors());
	            $data['status']=$error['error'];
				$data['alert'] = 'alert alert-danger';
				$data['new_news_config'] = $new_news_config;

				$conditi = $error['error'];
				$conditi = strtoupper($conditi);
				$conditi = substr($conditi, 3,11);
				if($conditi == "YOU DID NOT"){
					$this->edit_news_config('save');
				}else{
					$this->menu_handler->set_menu('news_detail','news_config',$data,1,1);
				}
				
	        } else{
	            $data = array('upload_data' => $this->upload->data());
	           	if($data){	
					$this->edit_news_config('save');
				}
	        }

		}
    }

    function add_news_config($imgName){
		$get_priviledge = $this->session->userdata('user_group_id');
		// $data['all_priviledge'] = $this->mdl_content->get_priviledge(); 
		//$institution_id= $this->session->userdata('institution_id');
		$data['new_news_config'] = true;
		if($get_priviledge=='1'){
			$result = $this->mdl_content->add_news_config($imgName);
			$data['daftar'] = $this->mdl_content->get_all_news_active();
			if($result == 1){
				$data['daftar'] = $this->mdl_content->get_all_news_active();
				$data['status'] = "News has been added.";
				$data['alert'] = 'alert alert-success';
				$this->menu_handler->set_menu('data_list','Management Berita',$data,1,1);
			} else if($result == 2){
				$data['status'] = "Sorry, news title has been used";
				$data['alert'] = 'alert alert-danger';
				$this->menu_handler->set_menu('news_detail','Berita',$data,1,1);
			} else {
				$data['alert'] = 'alert alert-danger';
				$data['status'] = "Please check again!!!";
				$this->menu_handler->set_menu('news_detail','Berita',$data,1,1);
			}
		}  else {
			$this->menu_handler->error();
		}
	}

	function edit_news_config($id_news_config, $status=''){
		$get_priviledge = $this->session->userdata('user_group_id');
			if($id_news_config =='save'){
				$result = $this->mdl_content->edit_news_config($this->input->post('id'));
				if($result==1){
					$data['daftar'] = $this->mdl_content->get_all_news_active();
					$data['status'] = "News data has been updated.";
					$data['alert'] = 'alert alert-success';
					$this->menu_handler->set_menu('data_list','Berita',$data,1,1);
				} else {
					$data['status'] = "Please check again!!!";
					$data['alert'] = 'alert alert-danger';
					$this->edit_news_config($this->input->post('id'),$data);
					$this->menu_handler->set_menu('news_detail','news_config',$data,1,1);
				}
			} 
	}

	function data_detail(){
    	$result= $this->mdl_content->get_data($this->input->post('id'));
    	$data['item'] = $result[0];
    	echo json_encode($data);
    }

    function get_school_detail(){
    	$result = $this->mdl_content->get_data($this->input->post('id'));
    	echo json_encode($result[0]);
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

	
}