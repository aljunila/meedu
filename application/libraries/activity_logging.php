<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity_logging {

	public function user_logging($level='',$activity='')
    {
		$CI =& get_instance();
		//START pengambilan level logging
		//MENGAMBIL tingkat logging yang tersimpan di database pengaturan situs website. 
		//table : site_settings
		//field : setting_type
		//isi_field : logging_level
		//Ambil isi dari field : setting_content
		//
		$get_site_level = $CI->db->select('*')->where('setting_type','logging_level')->get('site_settings')->result();
		$site_level = $get_site_level[0]->setting_content;
		//
		//END Pengambilan level
		if($level=='99' || $level <= $site_level){
			$username = $CI->session->userdata('username');
			//echo "Logging User : ".$username." .... <br />";
			//echo "Logging Level : ".$level." Activity : ".$activity." Site Logging Level : ".$site_level;die();
			switch($level){
				case 0:
						$type = "login/logout";
						break;
				case 1:
						$type = "menu/submenu access";
						break;
				case 2:
						$type = "action/ aksi";
						break;
				case 3:
						break;
				case 99:
						$type = "Mengakses halaman 404";
						break;
				default:
						break;
			}
			$update_data = array(
				'username' => $username,
				'log_type' => $type,
				'activity' => $activity,
				'requested_url'=>base_url().$CI->uri->uri_string()
			);
			$CI->db->insert('log_history',$update_data);
		}
    }

	
	public function clear_logging($log_date='')
    {
		$CI =& get_instance();
		$query = $CI->db->truncate('log_history');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */