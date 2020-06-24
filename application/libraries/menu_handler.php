<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_handler {
	
	public function set_menu($view, $title, $data, $nav_state, $sub_nav_state){
		$CI =& get_instance();
		$nav = array();								//CURRENT MENU
		//$sub_nav = array();	
		for($i=0;$i<2000;$i++){
			if($i==$nav_state){
				$nav[$i] = 'active treeview';
				//$sub_nav[$i] = 'select_sub show';
			} else {
				$nav[$i] = 'treeview';
				//$sub_nav[$i] = 'select_sub';
			}
		}

		$sub_nav = array();						//CURRENT SUBMENU
		for($i=0;$i<2000;$i++){
			if($i==$sub_nav_state){
				$sub_nav[$i] = 'active treeview';
			} else {
				$sub_nav[$i] = 'treeview';
			}
		}
	

		$data['nav'] = $nav;
		//$data['sub_nav'] = $sub_nav;
		$data['sub_nav'] = $sub_nav;
		$data['title'] = $title;
		$CI->parser->set('content', $view, $data);
		//$CI->parser->set('header', $header);
		$CI->parser->render('template');
	}
	
	/*public function set_header($data, $id_menu, $id_submenu ,$view=''){
		$CI =& get_instance();
		if(empty($data)){
			$data = array(); //HARUS ARRAY!
		}
		if(empty($view)){
			if($id_submenu == '0'){
				$view = $this->get_menu_content($id_menu);
			} else {
				$view = $this->get_sub_menu_content($id_submenu);
			}
		}
		$menu = $this->menu('get',$id_menu,$id_submenu);
		
		//$mail_system = $this->get_mail_system();
		//$mail_system2 = $this->get_mail_system2();
		if(!empty($view)!==FALSE){
			$CI->parser->set('content', $view, $data);
			$CI->parser->set('menu', $menu);
			//$CI->parser->set('mail_system', $mail_system);
			//$CI->parser->set('mail_system2', $mail_system2);
			$CI->parser->set('mail_system', '');
			$CI->parser->set('mail_system2', '');
			$CI->parser->render('template_admin');
		} else {
			redirect('dashboard');
		}
	}
	*/
	
	public function error(){
	$this->throw_error();
	}
	public function menu($request='',$id_m='',$id_sm='',$data='',$view=''){
		$CI =& get_instance();
		if(isset($data['request'])===FALSE){
			$data['request'] = $request;
		}
		if($request!="get"){
			
			preg_match('/([0-9]+)/',$request,$match);
			if(strripos($request,'.')){
				$get_request = explode('.',$request);
				preg_match('/([a-z]+)/',$get_request[0],$cek_status);
				if($cek_status){
					//CEK APAKAH ADA STATUS UNTUK ADD SUBMENU atau EDIT DELETE MENU & SUBMENU
					$stat_menu = $cek_status[1];
					switch($stat_menu){
						case "add":
								if(count($get_request)==2){
									echo "ADD SUBMENU !";	
								} else {
									$this->throw_error();
								}
								break;
						case "edit":
								$jenis = count($get_request);
								switch($jenis){
									case 2:
										echo "EDIT MENU !";
										break;
									case 3:
										echo "EDIT SUBMENU !";
										break;
									default:
										$this->throw_error();
										break;
								} 
								break;
						case "delete":
								$jenis = count($get_request);
								switch($jenis){
									case 2:
										echo "DELETE MENU !";
										break;
									case 3:
										echo "DELETE SUBMENU !";
										break;
									default:
										$this->throw_error();
										break;
								} 
								break;
						default:
							$this->throw_error();
							break;
					}
				} else {
					//BAGIAN UNTUK VIEW SUBMENU SAJA !
					if((count($get_request) < 3) && !empty($get_request[1])){
						$menu_state = "VIEW SUB MENU !";
						$get_priviledge = $CI->data_handler->select_data('user_priviledge','*','','id_user',$CI->session->userdata('id'));
						$p_menu = array();
						$p_sub_menu = array();
						$temp_id_m ="";
						$temp_id_sm ="";
						foreach($get_priviledge as $row){
							if($temp_id_m!=$row->id_menu){
								array_push($p_menu,$row->id_menu);
								$temp_id_m = $row->id_menu;
							}
							if($temp_id_sm!=$row->id_sub){
								array_push($p_sub_menu,$row->id_sub);
								$temp_id_sm = $row->id_sub;
							}
						}
						$get_details = $this->get_name($match[1],'menu','tbl_');
						$get_details2 = $this->get_name($get_request[1],'submenu','tbl_');
						if($get_details){
							$m_name = $get_details[0]->nama_menu;
							if($get_details2){
								$sm_name = $get_details2[0]->nama_submenu;
								if(in_array($get_details[0]->id_menu,$p_menu)){
									if(in_array($get_details2[0]->id_submenu,$p_sub_menu)){
										$CI->activity_logging->user_logging(1,'Mengakses submenu '.$sm_name);
										if(isset($data['state_history'])){
											$data['history'] = $CI->data_handler->select_data('log_history','*','id desc');
											$all_history = count($data['history']);
											if($all_history > 100){
												$data['history'] = $CI->data_handler->select_data('log_history','*','id desc','','',1000);
												if(isset($data['status_type'])){
													$data['status_type'] .= ',warning';
													$data['status_data'] .= ',Hanya menampilkan '.count($data['history']).' data terakhir dari '.$all_history.' yang ada.';
												} else {
													$data['status_type'] = 'warning';
													$data['status_data'] = 'Hanya menampilkan '.count($data['history']).' data terakhir dari '.$all_history.' yang ada.';
												}
											}
											if(isset($data['status_type'])){
												$data['status_type'] .= ',success';
												$data['status_data'] .= ','.count($data['history']).' data berhasil ditampilkan.';
											} else {
												$data['status_type'] = 'success';
												$data['status_data'] = count($data['history']).' data berhasil ditampilkan.';
											}
										}
										$hak_akses = $CI->data_handler->user_priviledge($CI->session->userdata('id'),$get_details[0]->id_menu,$get_details2[0]->id_submenu);
										$data['hak_akses'] = $hak_akses;
										$this->set_header($data,$match[1],$get_request[1],$view);									
									} else {
										$CI->activity_logging->user_logging(1,'Mengakses paksa submenu '.$sm_name.'. Access Denied!');
										$this->throw_error();
									}
								} else {
									$CI->activity_logging->user_logging(1,'Mengakses paksa menu '.$m_name.'. Access Denied!');
									$this->throw_error();
								}
							} else {
								$this->throw_error();
							}
						} else {
							$this->throw_error();
						}
						
					} else {
						$this->throw_error();
					}
				}
			} elseif($request=='add') {
				//ADD MENU
				echo "ADD MENU ! </br>";
				echo $id_m." : ".$id_sm;
			} elseif($match){
				$get_details = $this->get_name($match[1],'menu','tbl_');
				if(!empty($get_details)){
					$m_name = $get_details[0]->nama_menu;
					$CI->activity_logging->user_logging(1,'Mengakses Menu '.$m_name);
					$this->set_header($data,$match[1],0);
				} else {
					$CI->activity_logging->user_logging(1,'Mencoba mengakses Menu dengan kode '.$match[1].'. Access Denied!');
					$this->throw_error();
				}
				//$menu_state = "VIEW MENU !";
			} else {
				redirect('');
			}
		} else {
			//$get_priviledge = $CI->data_handler->select_data('user_priviledge','*','','id_user',$CI->session->userdata('id'));
			$get_priviledge = $CI->db->select('*,tbl_menu.urutan as urutan_menu')->join('tbl_menu','tbl_menu.id_menu=user_priviledge.id_menu')->join('tbl_submenu','tbl_submenu.id_submenu=user_priviledge.id_sub')->where('user_priviledge.id_user',$CI->session->userdata('id'))->order_by('tbl_menu.urutan','asc')->order_by('tbl_submenu.urutan','asc')->get('user_priviledge')->result();
			//print_r($get_priviledge);die();
			$get_empty_menu = $CI->db->select('*')->join('tbl_menu','tbl_menu.id_menu=user_priviledge.id_menu')->where('id_sub',0)->order_by('user_priviledge.id_menu','asc')->get('user_priviledge')->result();
			//print_r($get_empty_menu);die();
			$p_menu = array();
			$p_sub_menu = array();
			$temp_id_m ="";
			$temp_id_sm ="";
			foreach($get_priviledge as $row){
				if($temp_id_m!=$row->id_menu){
					$p_menu[$row->urutan_menu] = $row->id_menu;
					//array_push($p_menu,$row->id_menu);
					$temp_id_m = $row->id_menu;
				}
				if($temp_id_sm!=$row->id_sub){
					if(!isset($p_sub_menu[$row->id_menu])){
						$p_sub_menu[$row->id_menu] = array();
					}
					array_push($p_sub_menu[$row->id_menu],$row->id_sub);
					$temp_id_sm = $row->id_sub;
				}
			}
			foreach($get_empty_menu as $row){
				if(!in_array($row->id_menu,$p_menu)){
					$p_menu[$row->urutan] = $row->id_menu;
				}
			}
			ksort($p_menu);
			$menu = $this->get_list_menu($CI->session->userdata('user_group'));
			//print_r($p_menu);die();
			$submenu = $this->get_list_sub_menu($CI->session->userdata('user_group'));
			$isi = "";
			foreach($p_menu as $key=>$value){
				$detail_menu = $CI->data_handler->select_data('tbl_menu','*','','id_menu',$value);
				if($value == $id_m){
					$current = 'current';
				} else {
					$current = '';
				}
				
				$nm_menu = $detail_menu[0]->nama_menu;
				$img_menu = $detail_menu[0]->image;
				$cek_sub_menu = count($CI->data_handler->select_data('tbl_submenu','*','','id_menu',$value));
				if($cek_sub_menu > 0) {
					if($value == $id_m){
						$isi .= "<li class=".'"'.$current.'"'.">
								<a href=\"#\"><img src=\"".base_url()."$img_menu\" width=25 height=25 alt=\"\">
									".$nm_menu."
								</a>       
								<ul>";
					} else {
						$isi .= "
							<li> 
								<a href=\"#\"><img src=\"".base_url()."$img_menu\" width=25 height=25 alt=\"\">
								".$nm_menu."
								</a>
								<ul>";
						
					}
					foreach($p_sub_menu as $i_menu=>$value2){
						if($value == $i_menu){
							foreach($value2 as $key2=>$value3){
								$detail_sub_menu = $CI->data_handler->select_data('tbl_submenu','*','','id_submenu',$value3);
								if($value3 == $id_sm){
									$sub_current = 'class="current"';
								} else {
									$sub_current = '';
								}
								$nm_sub_menu = $detail_sub_menu[0]->nama_submenu;
								$get_folder = explode('/',$detail_sub_menu[0]->content_file);
								$isi .= "
										<li $sub_current><a href=\"".site_url($get_folder[0].'/menu/'.$value.'.'.$value3)."\">".$nm_sub_menu."</a></li>
								";
							}
							$isi .= "</ul>
									</li>";
						}
					}
				} else {
					$get_folder = explode('/',$detail_menu[0]->content_file);
					if($value == $id_m){
						$isi .= "<li class=".'"'.$current.'"'.">
									<a href=\"".site_url($get_folder[0].'/menu/'.$value)."\"><img src=\"".base_url()."$img_menu\" width=25 height=25 alt=\"\">
										".$nm_menu."
									</a>       
								</li>";
					} else {
						$isi .= "<li> 
									<a href=\"".site_url($get_folder[0].'/menu/'.$value)."\"><img src=\"".base_url()."$img_menu\" width=25 height=25 alt=\"\">
									".$nm_menu."
									</a>
								</li>";
						
					}
				}
			}
			return $isi;
		}
	}
	
	function get_total_menu(){
		$CI =& get_instance();
		$query = $CI->db->count_all('tbl_menu');
		return $query;
	}
	
	function get_total_sub_menu(){
		$CI =& get_instance();
		$query = $CI->db->count_all('tbl_submenu');
		return $query;
	}

	function get_list_menu($user_group){
		$CI =& get_instance();
		$query = $CI->db->select('*')->where('homesite',0)->order_by('urutan')->get('tbl_menu')->result();
		$menu = array();
		foreach ($query as $row){
			$menu[$row->id_menu] = $row->nama_menu.'|'.$row->image;
		}
		return $menu;
	}
	
	function add_menu(){
	
	}
	
	function del_menu($id_menu){
	
	}
	
	function get_menu_content($id_menu){
		$CI =& get_instance();
		if(!empty($id_menu)){
			$query = $CI->db->select('*')->where('id_menu',$id_menu)->get('tbl_menu')->result();
			return $query[0]->content_file;
		} else {
			return false;
		}
	}
	
	function get_list_sub_menu($user_group){
		$CI =& get_instance();
		$query = $CI->db->select('*')->order_by('id_menu')->order_by('urutan')->get('tbl_submenu')->result();
		$submenu = array();
		foreach ($query as $row){
			$submenu[$row->id_menu][$row->id_submenu] = $row->nama_submenu.'|'.$row->content_file;
		}
		return $submenu;
	}
	
	function get_sub_menu_content($id_sub_menu){
		$CI =& get_instance();
		if(!empty($id_sub_menu)){
			$query = $CI->db->select('*')->where('id_submenu',$id_sub_menu)->get('tbl_submenu')->result();
			return $query[0]->content_file;
		} else {
			return false;
		}
	}
	
	function add_sub_menu(){
	
	}
	
	function del_sub_menu($id_sub_menu){
	
	}
	
	public function get_name($id='',$table_name='',$prefix ='tbl_'){
		$CI =& get_instance();
		if(!empty($table_name) && !empty($id)){
			$query = $CI->db->select('*')->where('id_'.$table_name,$id)->get($prefix.$table_name)->result();
			return $query;
		} else {
			return false;
		}
	}
	
	
	function get_mail_system(){
		$CI =& get_instance();
		$get_mail = $CI->db->select('*')->where('id_reciever',$CI->session->userdata('id'))->order_by('change_date desc')->get('tbl_mail',5)->result();
		$get_user = $CI->db->select('*')->get('users')->result();
		$list_user = array();
		foreach($get_user as $row){
			$list_user[$row->id] = $row->nama;
		}
		$unread_mail = $this->get_unread();
		if($unread_mail > 0){
			$span_unread_mail = '<span>'.$unread_mail.'</span>';
		} else {
			$span_unread_mail = '';
		}
		$mail_system = '<!-- A small toolbar button -->
			<div class="toolbar_small">
				<div class="toolbutton">
					'.$span_unread_mail.'
					<img src="'.base_url().'themes/admin/img/icons/16x16/mail.png" width="16" height="16" alt="mail" >
				</div>
				<div class="toolbox">
					<span class="arrow"></span>
					<h3>Your Messages</h3>
					<ul class="mail">';
		foreach($get_mail as $row){
			if($row->status){
				$li_class = '<li class="read">';
			} else {
				$li_class = '<li>';
			}
			$mail_system .= $li_class.'
							<a href="#"> <strong>'.date('H:m',strtotime($row->change_date)).'</strong>'.$row->subject.'
							<small>
								From: '.$list_user[$row->id_sender].'
							</small> </a>
						</li>';
		}
		$mail_system .= '
					</ul>
					<a class="inbox" href="'.site_url('mail').'">Go to inbox &raquo;</a>
				</div>
			</div> <!-- End of small toolbar button -->';
		return $mail_system;
	}
	
	function get_mail_system2(){
		$unread_mail = $this->get_unread();
		if($unread_mail > 0){
			$mail_system2 = '<a href="'.site_url('mail').'">'.$unread_mail.' New Messages</a>';
		} else {
			$mail_system2 = '<a href="'.site_url('mail').'">No New Message</a>';
		}
		return $mail_system2;
	}
	
	function get_unread(){
		$CI =& get_instance();
		$get_mail = $CI->db->select('*')->where('id_reciever',$CI->session->userdata('id'))->where('status',0)->where('trash',0)->order_by('change_date desc')->get('tbl_mail')->result();
		$unread_mail = count($get_mail);
		return $unread_mail;
	}
	
	function throw_error($link='',$caption='',$request=''){
		$CI =& get_instance();
		if(!empty($link) && !empty($caption)){
			$data = array(
				'link_back' => $link,
				'caption' => $caption,
				'request' => $request,
			);
		} else {
			$data = array();
		}
		$CI->load->view('error_404',$data);
	}
	
	function get_menu($last_url){
		$CI =& get_instance();
		$query = $CI->db->select('*')->where('action_url',$last_url)->get('menu')->result();
		if($query[0]->parent_id == '0'){
			$ret_val = array(
							'menu_row' => $query[0]->menu_id,
							'sub_menu_row' => 0 	
							);
		}else{
			$sub_query = $CI->db->select('*')->where('menu_id',$query[0]->parent_id)->get('menu')->result();
			$ret_val = array(
							'menu_row' => $sub_query[0]->menu_id,
							'sub_menu_row' => $query[0]->menu_id	
							);
		}
		return $ret_val;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */