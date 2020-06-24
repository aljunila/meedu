<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_handler {
	
	function select_data($tbl_name='',$field='', $order='', $key='',$value='',$limit=''){
		$CI =& get_instance();
		if(!empty($tbl_name)){
			if(!empty($key) && !empty($value)){
				if(!empty($order)){
					if(!empty($limit)){
						$query = $CI->db->select($field)->where($key,$value)->order_by($order)->get($tbl_name,$limit)->result();
					} else {
						$query = $CI->db->select($field)->where($key,$value)->order_by($order)->get($tbl_name)->result();
					}
				} else {
					if(!empty($limit)){
						$query = $CI->db->select($field)->where($key,$value)->get($tbl_name,$limit)->result();
					} else {
						$query = $CI->db->select($field)->where($key,$value)->get($tbl_name)->result();
					}
				}
			} else {
				if(!empty($order)){
					if(!empty($limit)){
						$query = $CI->db->select($field)->order_by($order)->get($tbl_name,$limit)->result();
					} else {
						$query = $CI->db->select($field)->order_by($order)->get($tbl_name)->result();
					}
				} else {
					if(!empty($limit)){
						$query = $CI->db->select($field)->get($tbl_name,$limit)->result();
					} else {
						$query = $CI->db->select($field)->get($tbl_name)->result();
					}
				}
			}
			return $query;
		} else { 
			return false;
		}
	}
	
	function data_management($action='', $tbl_name='', $data='', $key='', $value='',$ret_id=FALSE){
		$CI =& get_instance();
		if(!empty($tbl_name)){
			switch($action){
				case 'add':
					$query = $CI->db->insert($tbl_name,$data);
					if($ret_id){
						return $CI->db->insert_id();
					}
					break;
				case 'edit':
					$query = $CI->db->where($key,$value)->update($tbl_name,$data);
					break;
				case 'delete':
					if($tbl_name == 'users'){
						$query2 = $CI->db->like('user_data','"id";s:1:"'.$value.'"')->delete('ci_sessions');
						$query3 = $CI->db->where('id_user',$value)->delete('user_priviledge');
						$query4 = $CI->db->where('id_user',$value)->delete('user_profile');
					}
					if($tbl_name == 'user_groups'){
						$query3 = $CI->db->where('id_group',$value)->delete('group_priviledge');
					}
					if(($tbl_name == 'tbl_menu') || ($tbl_name == 'tbl_submenu')){
						if($tbl_name == 'tbl_menu'){
							$query4 = $CI->db->where($key,$value)->delete('tbl_submenu');
							$query3 = $CI->db->where($key,$value)->delete('user_priviledge');
						} else {
							$query3 = $CI->db->where('id_sub',$value)->delete('user_priviledge');
						}
						
					}
					$query = $CI->db->where($key,$value)->delete($tbl_name);
					break;
			}
		}
	}

	function data_check($mode='',$tbl_name='',$where='',$value='',$request=''){
		$CI =& get_instance();
		$next_step = true;
		switch($mode){
			case 'delete':
				$cek = $CI->data_handler->select_data($tbl_name,'*','',$where,$value,$request);
				if(count($cek)==0){
					$next_step = false;
				}
				break;
			case 'save':
				$cek = $CI->data_handler->select_data($tbl_name,'*','',$where,$value,$request);
				if(count($cek)>0){
					$next_step = false;
				}
				break;
			default:
				break;
		}
		if($next_step){
			return $next_step;
		} else {
			return false;
		}
		
	}
	
	
	function user_priviledge($id_user='',$id_menu='',$id_sub =''){
		$CI =& get_instance();
		//$query = $CI->db->select('*')->where('id_user',$id_user)->where('id_menu',$id_menu)->where('id_sub',$id_sub)->get('user_priviledge')->result();
		$query = $CI->db->select('*')->where('id',$id_user)->get('users')->result();
		if($query){
			$hak_user = array();
			foreach($query as $row){
				if(!in_array($row->priviledge,$hak_user)){
					array_push($hak_user,$row->priviledge);
				}
			}
			return $hak_user;
		} else { 
			return false;
		}
	}
	
	function auto_delete(){
	
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */