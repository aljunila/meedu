<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_driver extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

		
	function register_check($username,$password,$email,$submitcode){
     	$sqlSubmit = "SELECT a.submitcode, b.partnerId from submition a
     			LEFT JOIN partners b
     			ON a.partnerId = b.partnerId
     			where a.submitcode= '".$submitcode."' ";
		$qSubmit= $this->db->query($sqlSubmit)->result();
		if(count($qSubmit)>0){
			
			$sSelect="email";
	     	$sqlEmail = "SELECT ".$sSelect." from drivers 
	     			where email= '".$email."'";
			$qEmail = $this->db->query($sqlEmail)->result();

			if(count($qEmail)>0){
				$feedback = array('status' => 'Failed','message'=>'Sorry, Email already registered');	
			}else{
			 	$sSelect="*";
		     	$sql = "SELECT ".$sSelect." from drivers
		     			where username = '".$username."'";
				$query = $this->db->query($sql)->result();
				
				if(count($query)>0){
					$feedback = array('status' => 'Failed','message'=>'Sorry, user already registered');	
				}else{
					$feedback = array('status' => 'Success','message'=>'username is available','partnerId'=>$qSubmit[0]->partnerId);		
				}
			}
		}else{
			$feedback = array('status' => 'Failed','message'=>'Sorry, Wrong submition code, please try again');	
			
		}
		return $feedback;
	}

	function changePassword($enduserId,$oldPass,$newPass){
	 	$sSelect="driverId,username";
     	$sql = "SELECT ".$sSelect." from drivers 
				where password = '".$oldPass."'
				AND driverId = '".$enduserId."'
				";
		$query = $this->db->query($sql)->result();
		
		if(count($query)>0){
			$record_detail = array(
				'password' => trim($newPass),
				'changedBy' => $query[0]->username
				);
			$this->db->where('driverId',$query[0]->driverId)->update('drivers',$record_detail);
			$feedback = array('status' => 'Success','message'=>'Success Change password');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Your old password its wrong, please check and try again!');	
		}
		// $feedback = array('status' => 'Failed','message'=>$enduserId." ".$oldPass." ".$newPass);	
		return $feedback;
	}


//REGISTER 
	function submitDriver($username,$password,$phone,$email,$partnerId){

		$sSelect="*";
		$sql = "SELECT ".$sSelect." from drivers
					where username= '" .$username."'
					AND password= '".$password."' 
					AND phone = '".$phone."' 
					";
		$statusDriver = $this->db->query($sql)->result();
			
		if(count($statusDriver)==0){
			$today = date("Y-m-d H:i:s");     
			$arrayRegister = array(
				'name' => $username,
				'username' => $username,
				'email' => $email,
				'phone' => $phone,
				'password'=>$password,
				'createdBy' =>  $username,
				'createdDate' =>  $today,
				'partnerId' => $partnerId,
				'changedBy' =>  $username
				);
			$this->db->insert('drivers',$arrayRegister);

			$feedback = array('status' => 'Success','message'=>'register success');	
			return $feedback;
		}else{
		 	$feedback = array('status' => 'Failed','message'=>'username or phone has already registered');
			return $feedback;
		}
	}


	//REGISTER 
	function register($register){
		$statusDriver = $this->db->select('*')->from('drivers')->where('username',$dataDriver->username)->get()->result();
		if(count($statusDriver)==0){
			$dateTime= '1002-11-11 12:21:34'; //HARUS DIGANTI
			$dataDrivers = json_decode($register);
			foreach($dataDrivers as $dataDriver){
				$arrayRegister = array(
									'username' => $dataDriver->username,
									'password' => $dataDriver->password,
									'email' => $dataDriver->email,
									'createdBy' =>  $dataDriver->username,
									'createdDate' =>  $dateTime,
									'changeBy' =>  $dataDriver->nama_user
								);
				$this->db->insert('drivers',$arrayRegister);
			}
			$feedback = array('status' => 'success','message'=>'register success');	
			return $feedback;
		}else{
			$feedback = array('status' => 'failed','message'=>'username/email has already exists');
			return $feedback;
		}
	}

	//LOGIN
	function login($username,$password){
	 	$sSelect="driverId,username,partnerId,name,phone,orderStatus,status";
     	$sql = "SELECT ".$sSelect." from drivers 
				where username = '".$username."'
				AND password = '".$password."'
				";
		$query = $this->db->query($sql)->result();

		if(count($query)>0){
			if($query[0]->status=='A'){
				$record_detail = array(
					'loginStatus' => trim('O'),
					'changedBy' => $query[0]->username
					);
				$this->db->where('driverId',$query[0]->driverId)->update('drivers',$record_detail);
				$feedback = array('status' => 'Success','message'=>$query[0]);	
			} else if($query[0]->status=='P'){
				$feedback = array('status' => 'Failed','message'=>'Your account has been PERMANENTLY BLOCKED, please contact your OEDAK PARTNER');	

			}else if($query[0]->status=='S'){
				$feedback = array('status' => 'Failed','message'=>'Your account has been SUSPENDED, please contact your OEDAK PARTNER');	

			}else{
				$feedback = array('status' => 'Failed','message'=>'Your account not active, please contact your OEDAK PARTNER');	
			}
		}else{
			$feedback = array('status' => 'Failed','message'=>'wrong username / password, try again');	
		}
		return $feedback;
	}




	function logout($username,$id){
	 	$sSelect="driverId,username";
     	$sql = "SELECT ".$sSelect." from drivers 
				where username = '".$username."'
				AND driverId = '".$id."'";
		$query = $this->db->query($sql)->result();

		$onStat='D';
		$vStat='N';

		if(count($query)>0){
			$record_detail = array(
				'loginStatus' => trim($vStat),
				'orderStatus' => trim($onStat),
				'changedBy' => $query[0]->username
				);
			$this->db->where('driverId',$query[0]->driverId)->update('drivers',$record_detail);

			$v_detail = array(
				'onlineStatus' => trim($vStat),
				'changedBy' => $query[0]->username
				);
			$this->db->where('changedBy',$username)->update('vehicles',$v_detail);

			$feedback = array('status' => 'Success','message'=>'User success logged Out');	
		}else{
			$feedback = array('status' => 'Failed','message'=>'wrong username / password, try again');	
		}
		return $feedback;
		// $query = $this->db->select('*')->from('drivers')->where('username',$username)->where('password',$password)->get()->result();
	}

	function changeOnline($username, $id, $id_vehicle, $case){
		// harus dipikirin kalau ada yang on di other device
	 	$sSelect="driverId,username";
     	$sql = "SELECT ".$sSelect." from drivers 
				where username = '".$username."'
				AND driverId = '".$id."'";
		$query = $this->db->query($sql)->result();

		$onStat='A';
		$vStat='N';
		$driverupId='0';
		if($case=='online'){
			$onStat='A';
			$vStat='O';
			$driverupId=$id;
		}else{
			$onStat='D';
			$vStat='N';
			$driverupId='0';
		}

		if(count($query)>0){
			$sqlV = "SELECT * from vehicles
					where vehicleId = '".$id_vehicle."'
					AND (driverId = '".$id."'  OR driverId='0')";
			$queryVehi = $this->db->query($sqlV)->result();

			// $queryVehi= $this->db->select('*')->from('vehicles')->where('vehicleId',$id_vehicle)->where('driverId','0')->get()->result();

			if(count($queryVehi)>0){
				$v_netral_detail = array(
					'onlineStatus' => trim('N'),	
					'driverId'=>'0',
					'changedBy' => $query[0]->username
					);
				$this->db->where('driverId',$id)->update('vehicles',$v_netral_detail);

				if(trim($onStat)=='A'){
					$record_detail = array(
						'orderStatus' => trim($onStat),
						'changedBy' => $query[0]->username
						);
				}else{
					$record_detail = array(
						'orderStatus' => trim($onStat),
						'changedBy' => $query[0]->username,
						'driverLoc'=>null
						);
				}
				$this->db->where('driverId',$query[0]->driverId)->update('drivers',$record_detail);

				$v_detail = array(
					'onlineStatus' => trim($vStat),	
					'driverId'=>$driverupId,
					'changedBy' => $query[0]->username
					);
				$this->db->where('vehicleId',$id_vehicle)->update('vehicles',$v_detail);
				$feedback = array('status' => 'Success','message'=>"Success change online driver and vehicle");	
			}else{
				$feedback = array('status' => 'Failed','message'=>'Mobil Telah dipakai, mohon pilih mobil yang lain');	
			}

		}else{
			$feedback = array('status' => 'Failed','message'=>'Something wrong, maybe username or vehicle online on other device');	
		}
		return $feedback;
		// $query = $this->db->select('*')->from('drivers')->where('username',$username)->where('password',$password)->get()->result();
	}

	function updatePackageRun($username,$driverId,$orderCode,$packageRun){
		$sSelect="*";
     	$sql = "SELECT ".$sSelect." from drivers 
				where username = '".$username."'
				AND driverId = '".$driverId."'
				";
		$query = $this->db->query($sql)->result();

		if(count($query)>0){
			$record_detail = array(
				'packageRun' => trim($packageRun),
				'changedBy' => $query[0]->username
				);
			$this->db->where('driverId',$query[0]->driverId)->update('orderbooks',$record_detail);
			$feedback = array('status' => 'Success','message'=>$query[0]);	
		}else{
			$feedback = array('status' => 'Failed','message'=>'wrong username / password, try again');	
		}
		return $feedback;
	}

	function getOrderBackOnline($username,$driverId){
		$sSelect="driverId";
    //  	$sql = "SELECT ".$sSelect." from orderbooks 
				// where orderCode = '".$orderCode."' AND driverId='".$driverId."'";

		//$sql = "SELECT a.*,b.name,b.phone from orderbooks a LEFT JOIN endusers b on a.enduserId=b.enduserId  where  a.driverId ='".$driverId."' AND 
		//(statusOrder='P' OR statusOrder='B' OR statusOrder='W' OR statusOrder='O' )";
		
		$sql = "SELECT a.*,b.name,b.phone, c.name as vehicleName 
		from orderbooks a 
		LEFT JOIN endusers b on a.enduserId=b.enduserId
		LEFT JOIN vehicles c on c.vehicleId = a.vehicleId
		where  a.driverId ='".$driverId."' AND 
		(statusOrder='P' OR statusOrder='B' OR statusOrder='W' OR statusOrder='O' )";

		$query = $this->db->query($sql)->result();
		if(count($query)>0){
			$fb = array('status' => 'Success','message'=>$query);
			$feedback=$fb;
		}else{
			$feedback = array('status' => 'Failed','message'=>'Sorry you lost data order');
		}
		// $feedback=$sql;
		return $feedback;
	}



	function getOrderBack($username,$driverId,$orderCode){
		$sSelect="driverId";
    //  	$sql = "SELECT ".$sSelect." from orderbooks 
				// where orderCode = '".$orderCode."' AND driverId='".$driverId."'";

		$sql = "SELECT a.*,b.name,b.phone from orderbooks a LEFT JOIN endusers b on a.enduserId=b.enduserId  where a.orderCode='".$orderCode."' AND a.driverId ='".$driverId."'";

		$query = $this->db->query($sql)->result();
		if(count($query)>0){
			$fb = array('status' => 'Success','message'=>$query[0]);
			$feedback=$fb;
		}else{
			$feedback = array('status' => 'Failed','message'=>'Sorry you lost data order');
		}
		return $feedback;
	}

	function takeOrder($username,$driverId,$orderCode,$case,$dateTime){
		// harus dipikirin kalau ada yang on di other device
		if($case=='take'){
		 	$sSelect="driverId";
	     	$sql = "SELECT ".$sSelect." from orderbooks 
					where orderCode = '".$orderCode."' AND statusOrder='B'";
			$query = $this->db->query($sql)->result();

			$sqlVehicle = "SELECT vehicleId from vehicles where driverId ='".$driverId."'"; 
			$qvehicle = $this->db->query($sqlVehicle)->result();
			if(count($query)>0){
				$fb;
				if($query[0]->driverId==0){

					$record_detail = array(
					'driverId' => trim($driverId),
					'vehicleId' => $qvehicle[0]->vehicleId,
					'timeAssigned' => $dateTime,
					'changedBy' => $username
					);
					$this->db->where('orderCode', $orderCode)->update('orderbooks',$record_detail);

					$v_detail = array(
						'orderStatus' => trim('B'),
						'changedBy' => $username
						);

					$this->db->where('driverId',$driverId)->update('drivers',$v_detail);

					$fb = array('status' => 'Success','message'=>'Success driverBid');
					
				}else{
					$fb = array('status' => 'Failed','message'=>'Sorry you lost in bid Order');
				}

				$feedback=$fb;
				
			}else{
				$feedback = array('status' => 'Failed','message'=>'Sorry you lost in bid Order');
				
			}
			
		}else if($case=='pickup'){
			// harus dipikirin kalau ada yang on di other device
		 	$sSelect="driverId";
	     	$sql = "SELECT ".$sSelect." from orderbooks 
					where orderCode = '".$orderCode."' AND (statusOrder='W' OR statusOrder='B')";
			$query = $this->db->query($sql)->result();

			if($case=='pickup'){
				if(count($query)>0){
					$fb;
					if($query[0]->driverId==$driverId){
						// $now = new DateTime();
						// $pickupTime= $now->format('Y-m-d H:i:s');    // MySQL datetime format
						
						$record_detail = array(
						'statusOrder' => trim('O'),
						'timePickup' => $dateTime,
						'changedBy' => $username
						);
						$this->db->where('orderCode', $orderCode)->update('orderbooks',$record_detail);


						$v_detail = array(
							'orderStatus' => trim('O'),
							'changedBy' => $username
							);
						
						$this->db->where('driverId',$driverId)->update('drivers',$v_detail);

						$fb = array('status' => 'Success','message'=>'Success driver Pickup');
						
					}else{
						$fb = array('status' => 'Failed','message'=>'Something wrong');
					}

					$feedback=$fb;
					
				}else{
					$feedback = array('status' => 'Failed','message'=>'Something wrong');
					
				}
			}else{
				$feedback = array('status' => 'Failed','message'=>'Something wrong');
				
			}

		}else if($case=='cancel'){
		 	$sSelect="driverId";
			$sql = "SELECT ".$sSelect." from orderbooks where orderCode = '".$orderCode."' ";
			$query = $this->db->query($sql)->result();
			if(count($query)>0){
				$fb;
				if($query[0]->driverId==$driverId){
					$record_detail = array(
					'statusOrder' => trim('CE'),
					'timePickup' => $dateTime,
					'changedBy' => $username
					);
					$this->db->where('orderCode', $orderCode)->update('orderbooks',$record_detail);
					$fb = array('status' => 'Success','message'=>'Success driver Cancel','orderCode'=>$orderCode);
				}else{
					$fb = array('status' => 'Failed','message'=>'Something wrong');
				}
				$feedback=$fb;
			}else{
				$feedback = array('status' => 'Failed','message'=>'Something wrong');
			}
		}else if($case=='closing'){
			// harus dipikirin kalau ada yang on di other device
		 	$sSelect="driverId, enduserId, statusOrder";
	     	$sql = "SELECT ".$sSelect." from orderbooks 
					where orderCode = '".$orderCode."' AND (statusOrder='O' or statusOrder ='CO')";
			$query = $this->db->query($sql)->result();

			if($case=='closing'){
				if(count($query)>0){
					$enduserId =$query[0]->enduserId;
					$fb;
					if($query[0]->driverId==$driverId){
						
						if($query[0]->statusOrder=='O'){
							$record_detail = array(
							'statusOrder' => trim('CO'),
							'timeClosing' => $dateTime,
							'changedBy' => $username
							);
							$this->db->where('orderCode', $orderCode)->update('orderbooks',$record_detail);
							
	
							$v_detail = array(
								'orderStatus' => trim('A'),
								'changedBy' => $username
								);
							
							$this->db->where('driverId',$driverId)->update('drivers',$v_detail);
	
							// insertig Feedback cause CLOSING
							$today = date("Y-m-d H:i:s");  
	
							$record_detail_feedbac = array(
								'orderCode'=>$orderCode,
								'enduserId'=>$enduserId,
								'driverId'=>$driverId,
								'statusOrder' => trim('CO'),
								'createdBy' => $username,
								'createdDate' => $today,
								'changedBy' => $username
							);
							
							$this->db->insert('feedbacks',$record_detail_feedbac);

						}

						$sSelect="*";
				     		$sqlfb = "SELECT ".$sSelect." from feedbacks
								where orderCode = '".$orderCode."' AND statusOrder='CO'";
						$queryFb = $this->db->query($sqlfb)->result();
						if(count($queryFb)>0){

							$fb = array('status' => 'Success','message'=>$queryFb[0]);
						}else{
							$fb = array('status' => 'Success','message'=>'no feedback');
						}



					}else{
						$fb = array('status' => 'Failed','message'=>'Something wrong');
					}

					$feedback=$fb;
					
				}else{
					$feedback = array('status' => 'Failed','message'=>'Something wrong');
					
				}
			}else{
				$feedback = array('status' => 'Failed','message'=>'Something wrong');
				
			}

		}

		return $feedback;
		
		// $query = $this->db->select('*')->from('drivers')->where('username',$username)->where('password',$password)->get()->result();
	}


	function get_detail_trip_recipt($orderCode){
	 	$sSel = 
	 	"a.*,b.name as driverName, 
	 	b.phone as driverPhone ,b.pathUrl as driverUrl, 
	 	c.name as vName, c.type as vType , c.lisenceNumber,
	 	d.name as uName, d.email as uEmail,
	 	e.description as aliasPackage, e.price as pricePackage
	 	"
	 	;
		$sqlH = "SELECT ".$sSel." from orderbooks a 
			LEFT JOIN drivers b on b.driverId = a.driverId
			LEFT JOIN vehicles c on c.vehicleId = a.vehicleId  
			LEFT JOIN endusers d ON d.enduserId = a.enduserId
			LEFT JOIN packages e ON a.package = e.packageId
			where a.orderCode= '".$orderCode."'";
		$query= $this->db->query($sqlH)->result();
		if($query>0){
			return $query[0];
		}else{
			return false;
		}
	}


//FEEDBACK
	function updateFeedback($driverId,$rate, $message, $orderCode, $scase){
	 	$sSelect="driverId,username";
     	$sql = "SELECT ".$sSelect." from drivers 
				where driverId = '".$driverId."'";
		$query = $this->db->query($sql)->result();

		if(count($query)>0){
			if($scase=='CO'){
				$record_detail = array(
					'driverFb' => $message,
					'driverRate' => $rate,
					'changedBy' => $query[0]->username
					);
				$this->db->where('orderCode',$orderCode)->update('feedbacks',$record_detail);
				$feedback = array('status' => 'Success','message'=>'Thanks for your feedback');	

			}else{
				// GET DATA FROM ORDERBOOKS
				$selectORD="driverId, enduserId, statusOrder";
		     	$sqlORD = "SELECT ".$selectORD." from orderbooks 
						where orderCode = '".$orderCode."' ";
				$queryORD = $this->db->query($sqlORD)->result();

				
				if(count($queryORD)>0){
					$enduserId =$queryORD[0]->enduserId;
					$fb;
					if($queryORD[0]->driverId==$driverId){

						$record_detail = array(
						'statusOrder' => trim('CE'),
						'changedBy' => $query[0]->username
						);
						$this->db->where('orderCode', $orderCode)->update('orderbooks',$record_detail);
						
						$v_detail = array(
							'orderStatus' => trim('A'),
							'changedBy' => $query[0]->username
							);
						
						$this->db->where('driverId',$driverId)->update('drivers',$v_detail);

						// insertig Feedback cause CLOSING
						$today = date("Y-m-d H:i:s");  

						$record_detail_feedbac = array(
							'orderCode'=>$orderCode,
							'enduserId'=>$enduserId,
							'driverId'=>$driverId,
							'driverFb' => $message,
							'driverRate' => $rate,
							'statusOrder' => trim('CE'),
							'createdBy' => $query[0]->username,
							'createdDate' => $today,
							'changedBy' => $query[0]->username
						);
						
						$this->db->insert('feedbacks',$record_detail_feedbac);

						

						$sSelect="*";
				     		$sqlfb = "SELECT ".$sSelect." from feedbacks
								where orderCode = '".$orderCode."' AND statusOrder='CE'";
						$queryFb = $this->db->query($sqlfb)->result();
						if(count($queryFb)>0){
							$fb = array('status' => 'Success','message'=>$queryFb[0]);
						}else{
							$fb = array('status' => 'Success','message'=>'no feedback');
						}



					}else{
						$fb = array('status' => 'Failed','message'=>'Something wrong');
					}

					$feedback=$fb;
					
				}else{
					$feedback = array('status' => 'Failed','message'=>'Something wrong');
					
				}
			}
		}else{
			$feedback = array('status' => 'Failed','message'=>'Feedback Failde to post');	
		}
		return $feedback;
	}


	
	function driverOverview($driverId){
	 	$sSelect="driverId,username";
     	$sql = "SELECT ".$sSelect." from drivers 
				where driverId = '".$driverId."'";
		$query = $this->db->query($sql)->result();

		if(count($query)>0){
	     	$sqlTrip = "SELECT driverId from orderbooks
					where driverId = '".$driverId."' AND statusOrder='CO'";
			$queryTrip= $this->db->query($sqlTrip)->result();


	     	$sqlRate = "SELECT * from feedbacks
					where driverId = '".$driverId."' AND statusOrder='CO' AND enduserRate <> 0";
			$queryRate= $this->db->query($sqlRate)->result();

			$sumRate=0;
			$avgRate=0;

			for ($fi=0; $fi <count($queryRate) ; $fi++) { 
				$sumRate = $sumRate + $queryRate[$fi]->enduserRate;
				$avgRate =$sumRate / count($queryRate);
			}

			// $avgRate =$sumRate / count($queryRate);


			$sqlRate5 = "SELECT * from feedbacks
					where driverId = '".$driverId."' AND statusOrder='CO' AND enduserRate ='5'";
			$queryRate5= $this->db->query($sqlRate5)->result();

			$overview['totalTrip'] = count($queryTrip);
			$overview['totalRate'] = count($queryRate);
			$overview['totalRate5'] = count($queryRate5);
			$overview['ratingStar'] = $avgRate;
			

			$feedback = array('status' => 'Success','message'=>$overview);	
		}else{
			$feedback = array('status' => 'Failed','message'=>'Failed load overview');	
		}
		return $feedback;
	}

	




	//LOGIN
	function onlinePosition($driverId,$driverLoc){
	 	$sSelect="driverId,username,loginStatus";
     	$sql = "SELECT ".$sSelect." from drivers 
				where driverId = '".$driverId."'";
			
		$query = $this->db->query($sql)->result();

		if(count($query)>0){
		
			if($query[0]->loginStatus!='O'){
				$record_detail = array(
					'driverLoc' => $driverLoc,
					'loginStatus' =>'O',
					'orderStatus' =>'A',
					'changedBy' => $query[0]->username
					);
				$this->db->where('driverId',$query[0]->driverId)->update('drivers',$record_detail);
				$feedback = array('status' => 'Success','message'=>$driverLoc);	
			}else{
				$record_detail = array(
					'driverLoc' => $driverLoc,
					
					'changedBy' => $query[0]->username
					);
				$this->db->where('driverId',$query[0]->driverId)->update('drivers',$record_detail);
				$feedback = array('status' => 'Success','message'=>$driverLoc);	
			}
		}else{
			$feedback = array('status' => 'Failed','message'=>'id user not valid');	
		}
		return $feedback;
	}

	//GET ORDER
	function getOrder($driverId,$driverLoc){
	 	$sSelect="driverId,username";
     	$sql = "SELECT ".$sSelect." from drivers 
				where driverId = '".$driverId."'";
		$query = $this->db->query($sql)->result();

		if(count($query)>0){

	     	$sql2 = "SELECT a.*,b.name,b.phone,b.username as enduserUsername from orderbooks a LEFT JOIN endusers b on a.enduserId=b.enduserId  where a.statusOrder='B' AND a.driverId ='0' ORDER BY a.changedDate DESC LIMIT 1";
			
			$bidding = $this->db->query($sql2)->result();
			if(count($bidding)>0){
				$feedback = array('status' => 'Success','message'=>$bidding[0]);	
			}else{
			
				$feedback = array('status' => 'Nothing Order','message'=>'nothing order');	
			}
		}else{
			$feedback = array('status' => 'Nothing Order','message'=>'nothing order');	
		}
		return $feedback;
	}

	function getOrderByCode($driverId,$driverLoc,$orderCode){
	 	$sSelect="driverId,username";
     	$sql = "SELECT ".$sSelect." from drivers 
				where driverId = '".$driverId."'";
		$query = $this->db->query($sql)->result();

		if(count($query)>0){

	     	$sql2 = "SELECT a.*,b.name,b.phone from orderbooks a LEFT JOIN endusers b on a.enduserId=b.enduserId  where a.orderCode='".$orderCode."' AND a.driverId ='".$driverId."' ORDER BY a.changedDate DESC LIMIT 1 	";
			
			$bidding = $this->db->query($sql2)->result();
			if(count($bidding)>0){
				$feedback = array('status' => 'Success','message'=>$bidding[0]);	
			}else{
			
				$feedback = array('status' => 'Nothing Order','message'=>'nothing order');	
			}
		}else{
			$feedback = array('status' => 'Nothing Order','message'=>'nothing order');	
		}
		return $feedback;
	}

	//GET PROFILE
	function car_get($username,$driverId,$partnerId){
		// $query = $this->db->select('*')->from('vehicles')->where('partnerId',$partnerId)->where('onlineStatus','N')->get()->result();
		//$query = $this->db->select('*')->from('vehicles')->where('partnerId',$partnerId)->where('driverId','0')->get()->result();
		
		$sql2 = "SELECT * from vehicles where partnerId='".$partnerId."' AND status ='A' AND (driverId ='0' OR driverId ='".$driverId."')";
			$query = $this->db->query($sql2)->result();
		if(count($query)>0){
			$feedback = array('status' => 'Success','message'=>$query);	
		}else{
			$feedback = array('status' => 'Vehicle','message'=>'no available vehicle of partner');	
		}
		
		return $feedback;
	}



	//GET PROFILE
	function profile_get($driverId){
		$query = $this->db->select('*')->from('drivers')->where('driverId',$driverId)->get()->result();
		return $query;
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


	function getPhotoDriver($driverId){
     	$sql = "SELECT * from drivers 
				where driverId = '".$driverId."'";
		$query = $this->db->query($sql)->result();
		if(count($query)>0){
			$feedback = array('status' => 'Success','message'=>$query[0]);	
		}else{
			$feedback = array('status' => 'Failed','message'=>'no image profile');	
		}

		return $feedback;
		
	}



	//GET History ORDER
	function getHistoryOrder($driverId,$statusOrder){
	 	$sSelect="driverId,username";
     	$sql = "SELECT ".$sSelect." from drivers 
				where driverId = '".$driverId."'";
		$query = $this->db->query($sql)->result();

		if(count($query)>0){

			$sql2="SELECT * FROM orderbooks WHERE driverId ='".$driverId."' AND statusOrder='".$statusOrder."' AND ( changedDate > ( NOW( ) - INTERVAL 1 MONTH )) ORDER BY changedDate DESC ";
			$history = $this->db->query($sql2)->result();
			// if(count($history)>0){
			$feedback = array('status' => 'Success','message'=>$history);	
		}else{
			$feedback = array('status' => 'Nothing Order','message'=>'nothing order');	
		}

		// $feedback = array('status' => 'Success','message'=>$query);	
		return $feedback;
	}


	function getFeedback($driverId){
	 	$sSelect="driverId,username";
     	$sql = "SELECT ".$sSelect." from drivers 
				where driverId = '".$driverId."'";
		$query = $this->db->query($sql)->result();

		if(count($query)>0){

			$sql2="SELECT * FROM feedbacks WHERE driverId ='".$driverId."' AND ( changedDate > ( NOW( ) - INTERVAL 1 MONTH )) ORDER BY changedDate DESC ";
			$feedbacks = $this->db->query($sql2)->result();
			// if(count($history)>0){
			$feedback = array('status' => 'Success','message'=>$feedbacks);	
		}else{
			$feedback = array('status' => 'Nothing Order','message'=>'nothing order');	
		}

		// $feedback = array('status' => 'Success','message'=>$query);	
		return $feedback;
	}
	
	//GET CLIENT
	function get_client_cc($userId){
		$sSelect = "A.enduserId, A.clientId as clientId, B.customerId as customerId";
		$sql = "SELECT ".$sSelect." from endusers as A
				JOIN creditcards as B ON B.clientId = A.clientId
				WHERE A.enduserId = '".$userId."'";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function get_user_cc($userId){
		$condition = array(
					'enduserId' => $userId,
					'status' => 'A'
				);
		$query = $this->db->select("*")->where($condition)->get("creditcards")->result();
		if(count($query) > 0){
			return $query;
		}else{
			return false;
		}
	}
	
	function get_cancel_fee(){
		$query = $this->db->select("*")->where("name","cancelation")->get("packages")->result();
		return $query;
	}
}
?>