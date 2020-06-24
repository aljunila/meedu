<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/ARO.php';
require APPPATH.'/libraries/firebase/firebase.php';
require APPPATH.'/libraries/firebase/push.php';
 
class driver extends ARO  {

	function __construct(){
        // Construct our parent class
        parent::__construct();
        $this->load->model('mdl_driver','',TRUE);
		require_once(APPPATH.'libraries/stripe/init.php');
        $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }

    function changePassword_post(){ 
        $oldPass = $this->post('oldPass');
        $newPass = $this->post('newPass');
        $enduserId = $this->post('id_user');
        $data = $this->mdl_driver->changePassword($enduserId,$oldPass,$newPass);
        $this->response($data);
    }
    //LOGIN
    function registerCheck_post(){ 
        $username = $this->post('username');
        $password = $this->post('password');
        $email = $this->post('email');
        $submitcode = $this->post('submitcode');
        $data = $this->mdl_driver->register_check($username,$password,$email,$submitcode);
        $this->response($data);
    }

    //REGISTER
    function registerDriver_post(){
        $username = $this->post('username');
        $password = $this->post('password');
        $phone = $this->post('phone');
        $email = $this->post('email');
        $data = $this->mdl_driver->submitDriver($username,$password,$phone,$email);
        $this->response($data);
    }
    
    function submitDriver_post(){ 
        $username = $this->post('username');
        $password = $this->post('password');
        $phone = $this->post('phone');
        $email = $this->post('email');
        $partnerId = $this->post('partnerId');
        $data = $this->mdl_driver->submitDriver($username,$password,$phone,$email,$partnerId);
        $this->response($data);
    }

    //LOGIN
    function mobileLogin_post(){ 
        $username = $this->post('username');
        $password = $this->post('password');
        $data = $this->mdl_driver->login($username,$password);
        $this->response($data);
       
    }

    function mobileLogout_post(){ 
        $username = $this->post('username');
        $driverId = $this->post('driverId');
        $data = $this->mdl_driver->logout($username,$driverId);
        $this->response($data);
    }

     function onlineChange_post(){ 
        $username = $this->post('username');
        $driverId = $this->post('driverId');
        $vehicleId = $this->post('vehicleId');
        $case = $this->post('case');
        $data = $this->mdl_driver->changeOnline($username,$driverId,$vehicleId,$case);
        $this->response($data);
    }

    function getOrderBackOnline_post(){
        $username = $this->post('username');
        $driverId = $this->post('driverId');
        $data = $this->mdl_driver->getOrderBackOnline($username,$driverId);
        $this->response($data);
    }
    

    function getOrderBack_post(){
        $username = $this->post('username');
        $driverId = $this->post('driverId');
        $orderCode = $this->post('orderCode');
        $data = $this->mdl_driver->getOrderBack($username,$driverId,$orderCode);
        $this->response($data);
    }

    function takeOrder_post(){ 
        $username = $this->post('username');
        $driverId = $this->post('driverId');
        $orderCode = $this->post('orderCode');
        $case = $this->post('case');
       

        $data = $this->mdl_driver->takeOrder($username,$driverId,$orderCode,$case, $this->post('dateTime'));

        if($case=='closing'){
            $this->orderRecipt($orderCode);
        }

        $this->response($data);
    }    


    function orderRecipt($orderCode){
        // $orderCode = $this->post('orderCode');
        $now = gmdate("Y-m-d\TH:i:s\Z");
        $nomExtra = 30000;
        // $hash = md5($email.$now);
        // $orderCode = 'dd98ce72';
        $dataTrip = $this->mdl_driver->get_detail_trip_recipt($orderCode);

        // print_r($dataTrip);
        // die();
        $dAssignf = date("F j, Y", strtotime($dataTrip->timeAssigned));
        $tAssignf = date("H:i:s", strtotime($dataTrip->timeAssigned));
        $dPickf = date("F j, Y", strtotime($dataTrip->timePickup)); 
        $tPickf = date("H:i:s", strtotime($dataTrip->timePickup));
        $dClosingf = date("F j, Y", strtotime($dataTrip->timeClosing)); 
        $tClosingf = date("H:i:s", strtotime($dataTrip->timeClosing));
        $extTime = 0;

        if($dataTrip->packageRun>1){
            $extTime = $dataTrip->packageRun - 1;
        }
        $extNominal = $extTime * $nomExtra;

        $totalPrice = $extNominal + $dataTrip->pricePackage;
        $totalPrice = number_format($totalPrice."",2,",",".");

        $extNominal = number_format($extNominal."",2,",",".");

        $pricePkg = number_format($dataTrip->pricePackage."",2,",",".");

        if($dataTrip->driverUrl==""){
            $profpic = "";
        }else{
            $profpic = "http://oedak.id/driver_documents/".$dataTrip->driverUrl;
        }

        

        
        try {
            $mandrill = new Mandrill(MANDRILL_API_KEY);
            $template_name = 'recipt-user';
            $template_content = array(
                array(
                    'name' => 'example name',
                    'content' => 'example content'
                )
            );
            $message = array(
                'html' => '<p>Example HTML content</p>',
                'text' => 'Example text content',
                'subject' => 'Thanks For Using OEDAK - Trip',
                'from_email' => 'mailer@oedak.com',
                'from_name' => 'Oedak NoReply',
                'to' => array(
                    array(
                        'email' => $dataTrip->uEmail,
                        'name' => $dataTrip->uEmail,
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => 'mailer@oedak.com'),
                'important' => false,
                'track_opens' => null,
                'track_clicks' => null,
                'auto_text' => null,
                'auto_html' => null,
                'inline_css' => true,
                'url_strip_qs' => null,
                'preserve_recipients' => null,
                'view_content_link' => null,
                'bcc_address' => 'message.bcc_address@example.com',
                'tracking_domain' => null,
                'signing_domain' => null,
                'return_path_domain' => null,
                'merge' => true,
                'merge_language' => 'mailchimp',
                'global_merge_vars' => array(
                    array(
                        'name' => 'merge1',
                        'content' => 'merge1 content'
                    )
                ),
                'merge_vars' => array(
                    array(
                        'rcpt' => $dataTrip->uEmail,
                        'vars' => array(
                            array(
                                'name' => 'NAMEOFUSER',
                                'content' => $dataTrip->uName
                            ),
                            array(
                                'name' => 'PRICE',
                                'content' => $totalPrice
                            ),
                            array(
                                'name' => 'DASSIGN',
                                'content' => $dAssignf
                            ),
                            array(
                                'name' => 'TASSIGN',
                                'content' => $tAssignf
                            ),
                            array(
                                'name' => 'DRIVERNAME',
                                'content' => $dataTrip->driverName
                            ),
                            array(
                                'name' => 'VNAME',
                                'content' => $dataTrip->vName
                            ),
                            array(
                                'name' => 'VNUMB',
                                'content' => $dataTrip->lisenceNumber
                            ),
                            array(
                                'name' => 'DPICK',
                                'content' => $dPickf
                            ),
                            array(
                                'name' => 'TPICK',
                                'content' => $tPickf
                            ),
                            array(
                                'name' => 'DCLOSING',
                                'content' => $dClosingf
                            ),
                            array(
                                'name' => 'TCLOSING',
                                'content' => $tClosingf
                            )
                            ,
                            array(
                                'name' => 'PICKADDR',
                                'content' => $dataTrip->pickupAddr
                            ),
                            array(
                                'name' => 'PACKAGENAME',
                                'content' => $dataTrip->aliasPackage
                            ),
                            array(
                                'name' => 'PACKAGEPRICE',
                                'content' => $pricePkg
                            ),
                            array(
                                'name' => 'EXTTIME',
                                'content' => $extTime ." Hours"
                            ),
                            array(
                                'name' => 'EXTNOMINAL',
                                'content' => $extNominal
                            ),
                            array(
                                'name' => 'DPARTURL',
                                'content' => $profpic
                            )
                        )
                    )
                ),
                'tags' => array('invitation'),
                'google_analytics_domains' => array('example.com'),
                'google_analytics_campaign' => 'message.from_email@example.com',
                'metadata' => array('website' => 'www.oedak.com'),
                'recipient_metadata' => array(
                    array(
                        'rcpt' => 'recipient.email@example.com',
                        'values' => array('user_id' => 123456)
                    )
                )
            );
            $async = false;
            $ip_pool = 'Main Pool';
            $send_at = gmdate("Y-m-d\TH:i:s\Z");
            $result = $mandrill->messages->sendTemplate($template_name, $template_content, $message, $async, $ip_pool, $send_at);
            return $result[0]['status'];
            /*
            Array
            (
                [0] => Array
                    (
                        [email] => recipient.email@example.com
                        [status] => sent
                        [reject_reason] => hard-bounce
                        [_id] => abc123abc123abc123abc123abc123
                    )
            
            )
            */
            $this->response(array('status' => 'Success','message'=>'Password '.$email.' telah di reset, check password baru pada email'));
        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }
        
        
    }

    function getPhotoDriver_post(){ 
        $driverId = $this->post('driverId');
        $data = $this->mdl_driver->getPhotoDriver($driverId);
        $this->response($data);
    }



    function onlinePosition_post(){ 
        $driverId = $this->post('id_user');
        $driverLoc = $this->post('driverLoc');
        $data = $this->mdl_driver->onlinePosition($driverId,$driverLoc);
        $this->response($data);
    }

     
    function getOrder_post(){ 
        $driverId = $this->post('id_user');
        $driverLoc = $this->post('driverLoc');
        $data = $this->mdl_driver->getOrder($driverId,$driverLoc);
        $this->response($data);
    }

    function getOrderByCode_post(){ 
        $driverId = $this->post('id_user');
        $driverLoc = $this->post('driverLoc');
        $orderCode = $this->post('orderCode');
        $data = $this->mdl_driver->getOrderByCode($driverId,$driverLoc,$orderCode);
        $this->response($data);
    }


    function feedbackDriver_post(){ 
        $driverId = $this->post('driverId');
        $rate = $this->post('rate');
        $message = $this->post('message');
        $orderCode = $this->post('orderCode');
        $case = $this->post('case');
        $data = $this->mdl_driver->updateFeedback($driverId,$rate,$message,$orderCode,$case);
        $this->response($data);
    }


    function driverOverview_post(){ 
        $driverId= $this->post('driverId');
        $data = $this->mdl_driver->driverOverview($driverId);
        $this->response($data);
    }

    function carlist_post(){ 
        $username = $this->post('username');
        $driverId = $this->post('driverId');
        $partnerId = $this->post('partnerId');
        $data = $this->mdl_driver->car_get($username,$driverId,$partnerId);
        $this->response($data);
    }

    function getHistory_post(){ 
        $statusOrder = "CO";
        $driverId = $this->post('driverId');
        $data = $this->mdl_driver->getHistoryOrder($driverId,$statusOrder);
        $this->response($data);
    }

     function getFeedback_post(){ 
        $driverId = $this->post('driverId');
        $data = $this->mdl_driver->getFeedback($driverId);
        $this->response($data);
    }

    function historyOrder_post(){ 
        $driverId = $this->post('id_user');
        $statusOrder = $this->post('statusOrder');
        $data = $this->mdl_driver->getHistoryOrder($driverId,$statusOrder );
        $this->response($data);
    }



    //REGISTER
    function register_post(){
        $result = $this->mdl_driver->register($this->post('register'));
        $this->response($result);
    }

    //PROFILE SHOW
    function profile_get(){   //-> GET
        $driverId = $this->get('id');

        $data['status'] = "success";
        $data['data'] = $this->mdl_driver->profile_get($driverId);
        if(count($data['data']) > 0){
            $this->response($data, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }

    

    function updatePackage_post(){ 
        $username = $this->post('username');
        $driverId = $this->post('driverId');
        $orderCode= $this->post('orderCode');
        $packageRun= $this->post('packageRun');
        $data = $this->mdl_driver->updatePackageRun($username,$driverId,$orderCode,$packageRun);
        $this->response($data);
    }

    //PROFILE UPDATE
    function profilePut_post(){
        $result = $this->mdl_driver->profile_put($this->post('idProfile'),$this->post('profile'));
        $this->response($result);
    }
   
    //GET USER ADD
    function userOrder_get(){   //-> GET
        $userId = $this->get('userId');

        $data['status'] = "success";
        $data['data'] = $this->mdl_driver->userOrder($userId);
        if(count($data['data']) > 0){
            $this->response($data, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'User order could not be found'), 404);
        }
    }
	
	//FIREBASE
	function firebase_individual_get(){
		$firebase = new Firebase();
        $push = new Push();
		
		$payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';
		
		$title = isset($_GET['title']) ? $_GET['title'] : '';
		$message = isset($_GET['message']) ? $_GET['message'] : '';

		$push->setTitle($title);
        $push->setMessage($message);
		
		$push->setIsBackground(FALSE);
        $push->setPayload($payload);
		
		$json = '';
        $response = '';
		
		$json = $push->getPush();
		$regId = isset($_GET['regId']) ? $_GET['regId'] : '';
		$response = $firebase->send($regId, $json);
		$data['status'] = "success";
        $data['data'] = $response;
		$this->response = $this->response($data, 200);
	}

	//POST CHARGE USER USING STRIPE
	function stripe_charge_post(){
		\Stripe\Stripe::setApiKey(STRIPE_PRIVATE_KEY_TEST);
		$enduserId = $this->post('enduserId');
		$amount = ($this->post('amount')*100);
		$paymentMethod = $this->post('paymentMethod');
		if($paymentMethod == 'P'){		
			$enduserData = $this->mdl_driver->get_user_cc($enduserId);
			if($enduserData){
				$customerId = $enduserData[0]->customerId;
				$charge = true;
			}else{
				$charge = false;
			}
		}elseif($paymentMethod == 'C'){
			$clientData = $this->mdl_driver->get_client_cc($enduserId);
			$customerId = $clientData[0]->customerId;
		}
		if($charge){
		$customer = \Stripe\Customer::retrieve($customerId);
		\Stripe\Charge::create(array(
			"amount" => $amount, // Amount in cents
			"currency" => "idr",
			"customer" => $customer->id
			));		
		$this->response(array('success' => 'test charge success'), 200);
		}else{
			$this->response(array('error' => 'User\'s credit card data could not be found'), 404);
		}
	}
	
	//POST CANCEL USER STRIPE
	function stripe_cancel_post(){
		\Stripe\Stripe::setApiKey(STRIPE_PRIVATE_KEY_TEST);
		$enduserId = $this->post('enduserId');
		$cancelation =  $this->mdl_driver->get_cancel_fee();
		$amount = $cancelation[0]->price * 100;
		$paymentMethod = $this->post('paymentMethod');
		if($paymentMethod == 'P'){		
			$enduserData = $this->mdl_driver->get_user_cc($enduserId);
			$customerId = $enduserData[0]->customerId;
		}elseif($paymentMethod == 'C'){
			$clientData = $this->mdl_driver->get_client_cc($enduserId);
			$customerId = $clientData[0]->customerId;
		}
		
		$customer = \Stripe\Customer::retrieve($customerId);
		\Stripe\Charge::create(array(
			"amount" => $amount, // Amount in cents
			"currency" => "idr",
			"customer" => $customer->id
			));		
		$this->response(array('success' => 'test cancelation success'), 200);
	}
}
