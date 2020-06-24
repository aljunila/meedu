<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Url_safe {
	
	public function enc_url($string){
		$CI =& get_instance();
		$CI->load->library('encrypt');
		$url_safe = $CI->encrypt->encode($string);
		$url_safe = strtr($url_safe,array('+' => '.', '=' => '-', '/' => '~'));
		return $url_safe;
	}
	
}
