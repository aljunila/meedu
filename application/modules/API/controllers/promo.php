<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// header('Access-Control-Allow-Methods: GET, HEAD, PUT, PATCH, POST, DELETE, OPTIONS');
require APPPATH.'/libraries/ARO.php';
// require_once(APPPATH.'libraries/Mandrill.php');
 
class promo extends ARO  {

	function __construct(){
        // Construct our parent class
        parent::__construct();
        $this->load->database();
        // $this->load->model('mdl_berita','',TRUE);
		// require_once(APPPATH.'libraries/stripe/init.php');
        // $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        // $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        // $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }


    function index_post() {
        $data = array(
                    'id'           => $this->post('id'),
                    'title'        => $this->post('title'),
                    'content'      => $this->post('content'),
                    'image'        => $this->post('image'),
                    'publish_date' => $this->post('publish_date'),
                    'unpublish_date'=> $this->post('unpublish_date'),
                    'category_id'  => $this->post('category_id'),
                    'discount'     => $this->post('discount'),
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_by'   => $this->post('created_by'),
                    'status'       =>'A');
        $insert = $this->db->insert('promo', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('promo')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('promo')->result();
        }
        $this->response($kontak, 200);
    }

     function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'           => $this->put('id'),
                    'title'        => $this->put('title'),
                    'content'      => $this->put('content'),
                    'image'        => $this->put('image'),
                    'publish_date' => $this->put('publish_date'),
                    'unpublish_date'=> $this->put('unpublish_date'),
                    'category_id'  => $this->put('category_id'),
                    'discount'     => $this->put('discount'),
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_by'   => $this->put('created_by'),
                    'status'       =>'A');
        $this->db->where('id', $id);
        $update = $this->db->update('promo', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('promo');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}