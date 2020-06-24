<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
class webviews extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function help()
	{
		$this->load->view('help');
	}

	function promo()
	{
		$this->load->view('promo');
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */