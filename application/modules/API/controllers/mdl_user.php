<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_user extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function register_check($username,$password,$email){
	 	
		$sSelect="email";
     	$sqlEmail = "SELECT ".$sSelect." from endusers 
     			where email= '".$email."'";
		$qEmail = $this->db->query($sqlEmail)->result();

		if(count($qEmail)>0){
			$feedback = array('status' => 'Failed','message'=>'Sorry, Email already registered');	
		}else{
		 	$sSelect="*";
	     	$sql = "SELECT ".$sSelect." from endusers 
	     			where username = '".$username."'";
			$query = $this->db->query($sql)->result();
			
			if(count($query)>0){
				$feedback = array('status' => 'Failed','message'=>'Sorry, user already registered');	
			}else{
				$feedback = array('status' => 'Success','message'=>'username is available');		
			}
		}
		return $feedback;
	}


//REGISTER 
	function registerUser($username,$password,$phone,$email){

		$sSelect="*";
		$sql = "SELECT ".$sSelect." from endusers 
					where username= '" .$username."'
					AND password= '".$password."' 
					AND phone = '".$phone."' 
					";
		$statusDriver = $this->db->query($sql)->result();
			
		if(count($statusDriver)==0){
			$today = date("Y-m-d H:i:s");     
			$arrayRegister = array(
				'imsi' => "-",
				'name' => $username,
				'username' => $username,
				'email' => $email,
				'phone' => $phone,
				'password'=>$password,
				'createdBy' =>  $username,
				'createdDate' =>  $today,
				'changedBy' =>  $username
				);
			$this->db->insert('endusers',$arrayRegister);

			$feedback = array('status' => 'Success','message'=>'register success');	
			return $feedback;
		}else{
		 	$feedback = array('status' => 'Failed','message'=>'username or phone has already registered');
			return $feedback;
		}
	}

	//REGISTER 
	function register($register){
		$dataReg = json_decode($register);

		$sSelect="*";
		$sql = "SELECT ".$sSelect." from endusers 
					where email= '" .$dataReg[0]->email."'
					AND phone = '".$dataReg[0]->phone."'
					";
		$statusDriver = $this->db->query($sql)->result();
			
		if(count($statusDriver)==0){
			$today = date("Y-m-d H:i:s");     
			$arrayRegister = array(
				'imsi' => $dataReg[0]->name,
				'name' => $dataReg[0]->name,
				'email' => $dataReg[0]->email,
				'phone' => $dataReg[0]->phone,
				'createdBy' =>  $dataReg[0]->email,
				'createdDate' =>  $today,
				'changedBy' =>  $dataReg[0]->email
				);
			$this->db->insert('endusers',$arrayRegister);

			$feedback = array('status' => 'Success','message'=>'register success');	
			return $feedback;
		}else{
		 	$feedback = array('status' => 'Failed','message'=>'phone or email has already registered');
			return $feedback;
		}
	}


	//LOGIN
	function login($username,$password){
	 	$sSelect="a.enduserId,a.username,a.clientId,a.name,a.email,a.phone,a.orderStatus,a.status, b.name as clientName";
     	$sql = "SELECT ".$sSelect." from endusers a
     			LEFT JOIN clients b 
     			on a.clientId = b.clientId
				where a.username = '".$username."'
				AND a.password = '".$password."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
			$record_detail = array(
				'loginStatus' => trim('O'),
				'changedBy' => $query[0]->username
				);
			$this->db->where('enduserId',$query[0]->enduserId)->update('endusers',$record_detail);
			$feedback = array('status' => 'Success','message'=>$query[0]);		
		}else{
			$feedback = array('status' => 'Failed','message'=>'wrong username / password, try again');	
		}
		return $feedback;
	}

	function logout($username,$enduserId){
	 	$sSelect="enduserId,username,clientId,name,email,phone,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where username = '".$username."'
				AND enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
			$record_detail = array(
				'loginStatus' => trim('N'),
				'changedBy' => $query[0]->username
				);
			$this->db->where('enduserId',$query[0]->enduserId)->update('endusers',$record_detail);
			$feedback = array('status' => 'Success','message'=>'Success Logout');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'wrong username / password, try again');	
		}
		return $feedback;
	}


	function changePassword($enduserId,$oldPass,$newPass){
	 	$sSelect="enduserId,username";
     	$sql = "SELECT ".$sSelect." from endusers 
				where password = '".$oldPass."'
				AND enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
			$record_detail = array(
				'password' => trim($newPass),
				'changedBy' => $query[0]->username
				);
			$this->db->where('enduserId',$query[0]->enduserId)->update('endusers',$record_detail);
			$feedback = array('status' => 'Success','message'=>'Success Change password');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Your old password its wrong, please check and try again!');	
		}
		// $feedback = array('status' => 'Failed','message'=>$enduserId." ".$oldPass." ".$newPass);	
		return $feedback;
	}


	function getHistory($enduserId,$cases){
	 	
	 	$sSelect="enduserId,username,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		
		$today = date("Y-m-d H:i:s");    
		$oneMA = date("Y-m-d H:i:s", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
		if(count($query)>0){
			$sSel = "a.*,b.name as driverName, b.phone as driverPhone , c.name as vName, c.type as vType , c.lisenceNumber";

			$queryHistory="";
			if($cases=='P'){
				$sqlH = "SELECT ".$sSel." from orderbooks a 
					LEFT JOIN drivers b on b.driverId = a.driverId
					LEFT JOIN vehicles c on c.vehicleId = a.vehicleId  
					where a.enduserId= '".$enduserId."' AND (a.createdDate BETWEEN '".$oneMA."' AND '".$today."') AND a.statusOrder='".$cases."'";
					$queryHistory = $this->db->query($sqlH)->result();	
			}else if($cases=='CO'){
			$sqlH = "SELECT ".$sSel." from orderbooks a 
					LEFT JOIN drivers b on b.driverId = a.driverId
					LEFT JOIN vehicles c on c.vehicleId = a.vehicleId  
					where a.enduserId= '".$enduserId."' AND (a.createdDate BETWEEN '".$oneMA."' AND '".$today."') AND (a.statusOrder='".$cases."' OR a.statusOrder='AJ'  ) ";
					$queryHistory = $this->db->query($sqlH)->result();
			}else if($cases=='O'){
				$sqlH = "SELECT ".$sSel." from orderbooks a
					LEFT JOIN drivers b on b.driverId = a.driverId
					LEFT JOIN vehicles c on c.vehicleId = a.vehicleId  
					where a.enduserId= '".$enduserId."' AND (a.createdDate BETWEEN '".$oneMA."' AND '".$today."') AND (a.statusOrder='O' OR a.statusOrder='W' )";
					$queryHistory = $this->db->query($sqlH)->result();	
			}


			$feedback = array('status' => 'Success','message'=>$queryHistory);
		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		return $feedback;
	}
	
	
	function messageFeedback($enduserId,$subject,$tripId,$message){
	 	$sSelect="enduserId,username,status";
     		$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		$queryHistory = $enduserId."<br>".$subject."<br>".$tripId."<br>".$message;
		
		if(count($query)>0){

			$feedback = array('status' => 'Success','message'=>$queryHistory);
		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		return $feedback;
	}
	
	
	function getOrderBack($enduserId,$username){
	 	
	 	$sSelect="enduserId,username,orderStatus,status";
     		$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."' AND username='".$username."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
			$sSel = "a.*,b.name as driverName, b.phone as driverPhone , c.name as vName, c.type as vType , c.lisenceNumber";

			$sqlH = "SELECT ".$sSel." from orderbooks a 
				LEFT JOIN drivers b on b.driverId = a.driverId
				LEFT JOIN vehicles c on c.vehicleId = a.vehicleId  
				where a.enduserId= '".$enduserId."' AND (a.statusOrder='O' OR a.statusOrder='W' or a.statusOrder='B' ) AND a.driverId <> 0";
			$queryHistory = $this->db->query($sqlH)->result();
			if(count($queryHistory)>0){
			$feedback = array('status' => 'Success','message'=>$queryHistory);
			}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
			}
		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		return $feedback;
	}


	function driverPosition($enduserId){
	 	$sSelect="enduserId,username,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
			$sSelect="driverId,driverLoc,name";
			$sql = "SELECT ".$sSelect." from drivers 
				where status = 'A' AND loginStatus= 'O'
				AND orderStatus = 'A'
				";
			$queryDriverLoc = $this->db->query($sql)->result();	
			$feedback = array('status' => 'Success','message'=>$queryDriverLoc);	
		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		return $feedback;
	}


	function driverPositionById($enduserId,$driverId,$orderCode){
	 	$sSelect="enduserId,username,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
			$sSelect="b.driverId,b.driverLoc,b.name,a.statusOrder,a.timePickup,a.timeClosing,a.package,a.packageRun";
			$sql = "SELECT ".$sSelect." from orderbooks a INNER JOIN drivers b on a.driverId = b.driverId  where a.orderCode ='".$orderCode."' AND  a.driverId='".$driverId."' AND b.loginStatus= 'O' ";
			$queryDriverLoc = $this->db->query($sql)->result();	
			$feedback = array('status' => 'Success','message'=>$queryDriverLoc);	 
		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		return $feedback;
	}



	function orderUserPost($enduserId,$orderCode,$orderDetail){
		$dataOrder = json_decode($orderDetail);
		foreach($dataOrder as $row){
			$order_array = array(
				'orderCode' => $row->orderCode,
				'enduserId' => $row->enduserId,
				'driverId' => $row->driverId,
				'pickupAddr' => $row->pickupAddr,
				'pickupCoor' => $row->pickupCoor,
				'closingAddr' => $row->closingAddr,
				'closingCoor' => $row->closingCoor,
				'methode' => $row->methode,
				'pic' => $row->pic,
				'picPhone' => $row->picPhone,
				'notes' => $row->notes,
				'timePickup' => $row->timePickup,
				'timeClosing' => $row->timeClosing,
				'package' => $row->package,
				'packageRun' => $row->packageRun,
				'estimates'=>$row->estimates,
				'price' => $row->price,
				'statusOrder' => 'B',
				'createdBy' => $row->createdBy,
				'createdDate'=>$row->createdDate,
				'changedBy' => $row->createdBy

			);
			$this->db->insert('orderbooks',$order_array);
		}
		
		$check_order = $this->check_no_order($orderCode);
		if($check_order==1){
			$feedback = array('status' => 'Success','message'=>"order success store");	
			
		}else{
			$feedback = array('status' => 'Failed','message'=>"order already on server");
		}
		return $feedback;
		
	}

	function orderUserChange($username,$enduserId,$orderCode,$status){
		$check_order = $this->check_no_order($orderCode);
		$id_driver = $this->check_driver_order($orderCode);
		if($check_order==1){
			$record_detail = array(
				'statusOrder' => trim($status),
				'changedBy' => $username
				);
			$this->db->where('orderCode',$orderCode)->update('orderbooks',$record_detail);
			
			if($status=='CE'){
				$record_driver = array(
				'orderStatus' => trim('A'),
				'changedBy' => $username
				);
				$this->db->where('driverId',$id_driver)->update('drivers',$record_driver);
			}

			$feedback = array('status' => 'Success','message'=>"order success change");	
		}else{
			$feedback = array('status' => 'Failed','message'=>"order already on server");
		}
		return $feedback;
	}

	function check_driver_order($orderCode){
		$sSelect="driverId";
     	$sql = "SELECT ".$sSelect." from orderbooks
				where orderCode = '".$orderCode."'";
		$query = $this->db->query($sql)->result();
		// return $feedback;
		return $query[0]->driverId;
	}

	function checkOrderDriver($username, $enduserId,$orderCode){
		$sSelect="driverId,timeAssigned";
     	$sql = "SELECT ".$sSelect." from orderbooks
				where orderCode = '".$orderCode."'";
		$query = $this->db->query($sql)->result();
		$hasil = $query[0]->driverId;
		$timeAssigned = $query[0]->timeAssigned;

		if($hasil=='0'){
			$feedback = array('status' => 'Success','message'=>$hasil);
		}else{
			$profileDriver = $this->getProfileDriver($hasil);
			if($profileDriver){
				$record_detail = array(
					'statusOrder' => trim('W'),
					'changedBy' => $username
					);
				$this->db->where('orderCode',$orderCode)->update('orderbooks',$record_detail);
				
				$feedback = array('status' => 'Success','message'=>$profileDriver[0],'timeAssigned'=>$timeAssigned);
			}
			
		}

		return $feedback;
	}

	function get_package(){
		$sSelect="packageId, name, duration, price, description";
     	$sql = "SELECT ".$sSelect." from packages";
		$hasil = $this->db->query($sql)->result();
		if(count($hasil)>0){
			$feedback = array('status' => 'Success','message'=>$hasil);
		}else{
			$feedback = array('status' => 'Failed','message'=>"packages cannot be fetched");
		}
		return $feedback;
	}


	// //LOGIN
	// function login($username,$password){
 //        $sSelect="userId,username,clientId,firstname,lastname,phone,email,orderStatus,status";
	// 	if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
 //       		$sql = "SELECT ".$sSelect." from endusers 
	// 				where email= '" .$username."'
	// 				AND password = '".$password."'
	// 				";
	// 		$query = $this->db->query($sql)->result();
	// 		return $query;
 //    	}else {
	//      	$sql = "SELECT ".$sSelect." from endusers 
	// 				where username = '".$username."'
	// 				AND password = '".$password."'
	// 				";
	// 		$query = $this->db->query($sql)->result();
	// 		return $query;
 //   		}
	// }
	function check_no_order($orderCode){
		$query = $this->db->select('*')->from('orderbooks')->where('orderCode',$orderCode)->get()->result();
		if($query>0){
			$fb = 1;
		}else{
			$fb= 0;
		}
		return $fb;
	
	}

	function getProfileDriver($driverId){
		$sSelect="a.driverId,a.name,a.phone,b.name as vName, b.type, b.lisenceNumber";
     	$sql = "SELECT ".$sSelect." from drivers a LEFT JOIN vehicles b on a.driverId = b.driverId
				where a.driverId = '".$driverId."'";
		$query = $this->db->query($sql)->result();	
		return $query;
		
	}

	function getMethode($enduserId){
		$sSelect="enduserId,username,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
	     	$sqlmethode = "SELECT * from packages";
			$queryMethode = $this->db->query($sqlmethode)->result();
			$feedback = array('status' => 'Success','message'=>$queryMethode);
		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		return $feedback;
		
	}

	//GET PROFILE
	function profile_get($driverId){
		$query = $this->db->select('*')->from('drivers')->where('driverId',$driverId)->get()->result();
		return $query;
	}
	
	function enduser_profile_get($enduserId){
		$query = "select A.enduserId, A.username, A.clientId as clientId, A.name, A.fcmId, A.phone,
					A.email, A.address, A.pathUrl, B.name as clientName
					FROM endusers as A
					LEFT JOIN clients as B ON B.clientId = A.clientId
					WHERE A.enduserId = '".$enduserId."'";
		$result = $this->db->query($query)->result();
		$feedback = array('status' => 'Success','message'=>$result[0]);
		return $feedback;
	}


		//FEEDBACK
	function updateProfile($enduserId,$profileDetail){
	 	$sSelect="enduserId,username,orderStatus,status";
     		$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();

		if(count($query)>0){
		
			$dataOrder = json_decode($profileDetail);
			foreach($dataOrder as $row){
				$record_detail = array(
					'name' => $row->name,
					'phone' => $row->phone,
					'pathUrl' => $row->image,
					'email' => $row->email,
					'changedBy' => $row->changedBy
	
				);
				$this->db->where('enduserId',$row->enduserId)->update('endusers',$record_detail);
			}	
			
			$feedback = array('status' => 'Success','message'=>'Profile user has been updated','data'=>$record_detail);	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Profile failed to update');	
		}
		return $feedback;
	}
	
	//UPDATE PROFILE
	function profile_put($driverId, $profile){
		if($idDriver){
			$this->db->where('driverId',$driverId)->update('drivers',$profile);
			$feedback = array('status' => 'success','message'=>'profile has been set');	
			return $feedback;
		}else {
			$feedback = array('status' => 'failed','message'=>'failed to update/set profile');
			return $feedback;
		}
	}

	function userFeedback($enduserId,$orderCode,$cases){
		$sSelect="enduserId,username,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
	     	$sqlfb = "SELECT * from feedbacks
					where orderCode = '".$orderCode."' AND statusOrder='".$cases."'";
			$queryFb = $this->db->query($sqlfb)->result();
			$feedback = array('status' => 'Success','message'=>$queryFb[0]);
		}else{
			$feedback = array('status' => 'Failed','message'=>'your id not valid to fetch data');	
		}
		// $feedback = array('status' => 'Failed','message'=>$enduserId." ".$orderCode);


		return $feedback;
		
	}

	//FEEDBACK
	function updateFeedback($enduserId,$rate, $message, $orderCode, $scase){
	 	$sSelect="enduserId,username,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where enduserId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();

		if(count($query)>0){
			$record_detail = array(
				'enduserFb' => $message,
				'enduserRate' => $rate,
				'changedBy' => $query[0]->username
				);
			$this->db->where('orderCode',$orderCode)->update('feedbacks',$record_detail);
			$feedback = array('status' => 'Success','message'=>'Thanks for your feedback');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Feedback Failed to post');	
		}
		return $feedback;
	}
	

	//GET USER
	function userOrder($userId){
	 	$sSelect="firstname,lastname,phone,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from endusers 
				where userId = '".$userId."'
				";
		$query = $this->db->query($sql)->result();
		return $query;
		// $query = $this->db->select('*')->from('drivers')->where('username',$username)->where('password',$password)->get()->result();
	}
	
	//GET CLIENT
	function get_client($userId){
		$sSelect = "A.enduserId, A.clientId as clientId, B.customerId";
		$sql = "SELECT A.* from endusers as A
				LEFT JOIN creditcards as B ON B.clientId = A.clientId
				WHERE A.enduserId = '".$userId."'";
		$query = $this->db->query($sql)->result();
		return $sql;
	}
	
	function accept_invitation($email){
		$pendingData = $this->db->select('*')->where('email',$email)->get('pending_responses')->result();
		$clientId = $pendingData[0]->clientId;
		$expenseCode = $pendingData[0]->expenseCode;
		$recordDetail = array(
			'clientId' => $clientId,
			'expenseCode' => $expenseCode
		);
		$cek = $this->db->select('*')->where('email',$email)->get('endusers')->result();
		if(count($cek)>0){
			$this->db->where('email',$email)->update('endusers',$recordDetail);
			
		}else{
			$recordDetail['email'] = $email;
			$this->db->insert('endusers', $recordDetail);
		}
		return array('status' => 'Success','message'=>'completed');
	}

	//////////////////////
	//for reset password//
	//////////////////////
	//get user by email
	function get_user_reset($email){
		$query = $this->db->select('*')->from('endusers')->where('email', $email)->get()->result();
		return $query;
	}
	
	//update password
	function reset_pass($id, $detail){
		$this->db->where('enduserId', $id)->update('endusers', $detail);
	}

}
?>