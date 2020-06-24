<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_auth {

	function __construct()
	{
		$CI =& get_instance();
		// session_start();
		preg_match('/API\/([a-zA-Z0-9\_\/]+)/',$CI->uri->uri_string(),$match);
		
		if($match){
			$API = 'API/'.$match[1];
		}else{
			$API = '';
		}

		
		preg_match('/login\/([a-zA-Z0-9\_\/]+)/',$CI->uri->uri_string(),$match);
		if($match){
			$LOGIN = 'login/'.$match[1];
		}else{
			$LOGIN = '';
		}


		$allowed_url_list = array (
					'admin',
					'admin/sign_up_get',
					'admin/sign_up_save',
					'admin/forgot_get',
					'admin/forgot_save',
					'login',
					'yayasan',
					$LOGIN,
					'psychology',
					'psb',
					 'globals',
					 'usr_msg',
					'random/get_total',
					'login/sign_up_get',
					'login/sign_up_save',
					'login/forgot_get',
					'login/forgot_save',
					'engine/engine_crud/0-0',
					'engine/engine_crud/0-1',
					'engine/add_engine',
					'engine/add_engines',
					'engine/mobile_login',
					'engine/sync_customer',
					'engine/sync_gt',
					'engine/get_kurs',
					'engine/get_aturan',
					'engine/get_kpp',
					'API',
					$API,
					'engine/get_ikhtisar',
					'engine/get_langkah',
					'engine/get_user_profile',
					'engine/mobile_user_update',
					'engine/mobile_user_register',
					'm404'
				);
		$sess_username = $CI->session->userdata('username');
		//print_r($CI->session->all_userdata());die();
		if(empty($sess_username) && ($CI->uri->uri_string() != 'login/check') && ($CI->uri->uri_string() != 'admin/check')){
			if (in_array($CI->uri->uri_string(),$allowed_url_list)===FALSE){
				redirect('login');
			}
		} elseif (!empty($sess_username)) {
			if($CI->uri->uri_string() == 'login'){
				redirect('dashboard');
			}
			$last_access = $CI->session->userdata('last_access');
			if((time() - $last_access)>3000){
				$CI->session->sess_destroy();
				redirect('login');
			}
			$CI->session->set_userdata('last_access',time());
		}
	}
}
