<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/ARO.php';
 
class Barang extends ARO  {

	
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
        $this->load->model('mdl_engine','',TRUE);

        $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }



    
    function user_get()
    {	
    	$data['status'] = "OK";
    	$data['data'] = $this->mdl_engine->get_all_jadwal();

        if(count($data['data']) > 0)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }
    
    function user_post()
    {
        //$this->some_model->updateUser( $this->get('id') );
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }

    function users_get()
    {	
    	$data['status'] = "OK";
    	$data['data'] = $this->modelBarang->getBarang();
        
        if(count($data['data']) > 0)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }

}
