<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_content');
		
	}
	
	function check($registration_code){
	
	}
}	