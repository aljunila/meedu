<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Mdl_content extends CI_Model {
	
		function __construct() {
			parent::__construct();
		}
	
	function get_all_bill() {
		$filter = $this->input->post('filter');

		if($filter=="d") {
			$date = date("Y-m-d");
			$sqldate = "AND a.date= '".$date."'";
		} elseif($filter=="m") {
			$date = date("Y-m");
			$sqldate = "AND a.date like '".$date."-%'"; 
		} elseif($filter=="y") {
			$date = date("Y");
			$sqldate = "AND a.date like '".$date."-%'"; 
		} else {
			$sqldate = "";
		}
		
		
		$sql = "SELECT SUM(nominal) as total
				FROM transactions as a 
				LEFT JOIN agent as b ON (a.agent_id = b.id)
				WHERE a.agent_id!=0 ".$sqldate." AND a.payment='A'";
		$query = $this->db->query($sql)->result();
		return $query;
	}	

	function get_all_payment() {
		$filter = $this->input->post('filter');

		if($filter=="d") {
			$date = date("Y-m-d");
			$sqldate = "AND a.date= '".$date."'";
		} elseif($filter=="m") {
			$date = date("Y-m");
			$sqldate = "AND a.date like '".$date."-%'"; 
		} elseif($filter=="y") {
			$date = date("Y");
			$sqldate = "AND a.date like '".$date."-%'"; 
		} else {
			$sqldate = "";
		}

		$sql = "SELECT SUM(nominal) as total
				FROM transactions as a 
				WHERE a.agent_id=0 ".$sqldate." AND a.payment='A'";
		$query = $this->db->query($sql)->result();
		return $query;
	}	

}		
?>