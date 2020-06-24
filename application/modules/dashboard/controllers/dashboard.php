<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class dashboard extends MX_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('mdl_content');
	}

	function index() {
		redirect('dashboard/dashboard_crud/0-0');
	}
	
	function dashboard_crud($tes){
		$titlePage = $this->lang->line('title_dashboard');
		$get_priviledge = $this->session->userdata('user_group_id');
		$status = explode('-',$tes);
		$cas = $status[1];
		$primary_id = $status[0];
		$last_url = 'dashboard/dashboard_crud/0-0';
		if(($cas >= '4') && ($cas <= '6')){
			$last_url = 'dashboard/dashboard_crud/0-4';		
		}
		$menu_data = $this->menu_handler->get_menu($last_url);
		
		switch($cas){
			case 0: // FOR SHOW ALL dashboard
				if($get_priviledge == '2'){
					$data['daftar'] ="hehe";
					// $income = $this->mdl_content->get_all_bill();
					// $data['income'] = $income[0]->total;
					// $payment = $this->mdl_content->get_all_payment();
					// $data['payment'] = $payment[0]->total;
					$this->menu_handler->set_menu('dashboard_admin','dashboard Management',$data,0,0);
				}elseif($get_priviledge == '1'){
					$data['daftar'] ="hehe";
					// $income = $this->mdl_content->get_all_bill();
					// $data['income'] = $income[0]->total;
					// $payment = $this->mdl_content->get_all_payment();
					// $data['payment'] = $payment[0]->total;
					$this->menu_handler->set_menu('dashboard_sekolah','dashboard Management',$data,0,0);
				} else {
					$data['daftar'] ="hehe";
					$this->menu_handler->set_menu('dashboard_sekolah','dashboard Management',$data,0,0);
				}
				break;
			case 1: 
				if($get_priviledge == '2'){
					$titlePage = $this->lang->line('title_silabus');
					$data['silabus'] = "haha";
					$this->menu_handler->set_menu('course_subject',$titlePage, $data, $menu_data['menu_row'],$menu_data['sub_menu_row']);
				} else {
					$this->menu_handler->error();
				}
				break;
			
			default:
					if($get_priviledge < '3'){
						$data['daftar'] = "haha";
						// print_r($data['daftar']);die();
						$this->menu_handler->set_menu('dashboard','dashboard Management',$data,0,0);
					} else {
						$this->menu_handler->error();
					}
					break;
		}
	}

	function populate_data(){
    	$res = $this->mdl_content->get_record_finger();

    	$tables='';
    	$tables = $tables.'
    	 <div class="table-responsive">
            <table id="tbl_data" class="table table-bordered table-striped" style="width:100%;">
              <thead>
                <tr>
                  <th style="width:5%;">No&nbsp;</th>
                  <th style="width:25%;">Nama Finger</th>
                  <th style="width:25%;">Lokasi</th>
                  <th style="width:10%;">Jumlah</th>
                </tr>
              </thead>
              <tbody>';
				$i=1;
				foreach ($res as $row){
                $tables = $tables.'
				<tr>
  					<td align="center">'.$i.'</td>
                  	<td>'.$row->name.'</a></td>
                  	<td>'.$row->location.'</td>
                  	<td>'.$row->jumlah.'</td>
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

    function populate_cost() {
    	$filter = $this->input->post('filter');
    	$income = $this->mdl_content->get_all_bill();
		$get = $income[0]->total;
		if(!empty($get)) {
			$total = $get; 
		} else {
			$total = 0;
		}
		$tables='';
    	$tables = $tables.'<h4> '. number_format($total."",2,",",".").'</h4>
    	 <script>
	        $(function () {
	            $("#tbl_data").DataTable();
	        });
	    </script>';

    	$data['table_data'] =$tables;
    	echo json_encode($data);
    }

     function populate_pay() {
    	$filter = $this->input->post('filter');
    	$payment = $this->mdl_content->get_all_payment();
		$get = $payment[0]->total;
		if(!empty($get)) {
			$total = $get; 
		} else {
			$total = 0;
		}
		$tables='';
    	$tables = $tables.'<h4> '. number_format($total."",2,",",".").'</h4>
    	 <script>
	        $(function () {
	            $("#tbl_data").DataTable();
	        });
	    </script>';

    	$data['table_data'] =$tables;
    	echo json_encode($data);
    }
}