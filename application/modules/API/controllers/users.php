<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// header('Access-Control-Allow-Methods: GET, HEAD, PUT, PATCH, POST, DELETE, OPTIONS');
// require APPPATH.'/libraries/ARO.php';
// require_once(APPPATH.'libraries/Mandrill.php');
 
class user extends ARO  {

	function __construct(){
        // Construct our parent class
        parent::__construct();
        $this->load->model('mdl_user','',TRUE);
		$this->load->model('mdl_driver','',TRUE);
		// require_once(APPPATH.'libraries/stripe/init.php');
        $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }



    //LOGIN
    function registerCheck_post(){ 
        $username = $this->post('username');
        $password = $this->post('password');
        $email = $this->post('email');
        $data = $this->mdl_user->register_check($username,$password,$email);
        $this->response($data);
    }


    //LOGIN 
    function changePassword_post(){ 
        $oldPass = $this->post('oldPass');
        $newPass = $this->post('newPass');
        $enduserId = $this->post('id_user');
        $data = $this->mdl_user->changePassword($enduserId,$oldPass,$newPass);
        $this->response($data);
    }


    //REGISTER
    function registerUser_post(){
        $username = $this->post('username');
        $password = $this->post('password');
        $phone = $this->post('phone');
        $email = $this->post('email');
        $data = $this->mdl_user->registerUser($username,$password,$phone,$email);
        $this->response($data);
    }


    function getMethode_get(){
        $enduserId = $this->get('enduserId');
        $data = $this->mdl_user->getMethode($enduserId);
        $this->response($data);
    }

    //LOGIN
    function mobileLoginn_get(){ 
        $username = $this->get('username');
        $password = sha1($this->get('password'));

        $data['status'] = "success";
        $data['data'] = $this->mdl_user->login($username,$password);
        if(count($data['data']) > 0){
            $this->response($data, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'Login failed, please check again!'), 404);
        }
    }

    //LOGIN DONE
    function mobileLogin_post(){ 
        $data=null;
        $case = $this->post('case');
        if($case=='login'){
            $username = $this->post('username');
            $password = $this->post('password');
            $fcmId = $this->post('fcmId');
            $data = $this->mdl_user->login($username,$password,$fcmId);
        }else if ($case=='logout'){
            $username = $this->post('username');
            $enduserId= $this->post('enduserId');
            $data = $this->mdl_user->logout($username,$enduserId);
        }
       
        $this->response($data);
    }
    // FORUM DONE
    function forumParentClass_post(){ 
        $data=null;
        $case = $this->post('case');
        if($case=='list'){
            $data = $this->mdl_user->getForumList();
        }else if ($case=='add'){
            $data = $this->mdl_user->addForumList();
        }
       
        $this->response($data);
    }

    // NEWS ANNOUNCE DONE
    function getDataPublic_post(){ 
        $data=null;
        $case = $this->post('case');
        if($case=='news'){
            $username = $this->post('username');
            $news = $this->mdl_user->getNews($username);
            $data  = $news;
        }else if ($case=='announcement'){
            $username = $this->post('username');
            $data = $this->mdl_user->getAnnouncement($username);
        }else if ($case=='tahun_ajaran'){
            $username = $this->post('username');
            $data = $this->mdl_user->getTahunAjaran($username);
        }
       
        $this->response($data);
    }

    // EKSKULL 
    function getPengembangan_post(){
        $data=null;
        $case = $this->post('case');
        if($case=='ekskul'){
            $username = $this->post('username');
            $data = $this->mdl_user->getEkskul($username);
        }

        $this->response($data);
    }

    function getDataRaport_post(){
        $data=null;
        $username = $this->post('username');
        $data = $this->mdl_user->getDataRaport($username);
        $this->response($data);
    }

    function getDataKelas_post(){
        $data=null;
        $ta_id = $this->post('ta_id');
        $username = $this->post('username');
        $data = $this->mdl_user->getDataKelas($username,$ta_id);
        $this->response($data);
    }

    function getDataPresensi_post(){
        $data=null;
        $case = $this->post('case');
        $course_id = $this->post('course_id');
        $start_date = $this->post('start_date');
        $end_date = $this->post('end_date');
        $username = $this->post('username');
        if($case=='count'){
            $data = $this->mdl_user->getDataPresensi($username,$course_id, $start_date, $end_date);
        }else if($case=='list'){
            $data = $this->mdl_user->getDataPresensiList($username,$course_id, $start_date, $end_date);
        }

        $this->response($data);
    }

    function getStudentBehavior_post(){
        $data=null;
        $enduser_id = $this->post('enduser_id');
        $type = $this->post('type');
        $data = $this->mdl_user->getStudentBehavior($enduser_id,$type);
        $this->response($data);
    }

    function getEventList_post(){
        $data=null;
        $enduser_id = $this->post('enduser_id');
        $date = $this->post('dates');
        $data = $this->mdl_user->getEventList($enduser_id,$date);
        $this->response($data);
    }

    function addPesanSekolah_post(){
        $data=null;
        $enduser_id = $this->post('enduser_id');
        $data = $this->mdl_user->addPesanSekolah($enduser_id);
        $this->response($data);
    }


// PSY DATA
    function getDailyActivities_post(){
        $data=null;
        $enduser_id = $this->post('enduser_id');
        $data = $this->mdl_user->getDailyActivities($enduser_id);
        $this->response($data);
    }

    function getAnekdotList_post(){
        $data=null;
        $enduser_id = $this->post('enduser_id');
        $data = $this->mdl_user->getAnekdotList($enduser_id);
        $this->response($data);
    }

    function addAnekdot_post(){
        $data=null;
        $enduser_id = $this->post('enduser_id');
        $data = $this->mdl_user->addAnekdot($enduser_id);
        $this->response($data);
    }

    function addDailyAns_post(){
        $data=null;
        $enduser_id = $this->post('enduser_id');
        $data = $this->mdl_user->addDailyAns($enduser_id);
        $this->response($data);
    }

    function addProjectAns_post(){
        $data=null;
        $enduser_id = $this->post('enduser_id');
        $data = $this->mdl_user->addProjectAns($enduser_id);
        $this->response($data);
    }
   
    function getProjectActivities_post(){
        $data=null;
        $enduser_id = $this->post('enduser_id');
        $data = $this->mdl_user->getProjectActivities($enduser_id);
        $this->response($data);
    }

    function projectActivity_post(){
        $data=null;
        $enduser_id = $this->post('enduser_id');
        $id = $this->post('id');
        $data = $this->mdl_user->getDetailProjectActivities($enduser_id,$id);
        $this->response($data);
    }

    function getTodoListProject_post(){
        $data=null;
        $enduser_id = $this->post('enduser_id');
        $id = $this->post('id');
        $data = $this->mdl_user->getTodoListProject($enduser_id,$id);
        $this->response($data);
    }

    function dailyActivity_post(){
        $data=null;
        $enduser_id = $this->post('enduser_id');
        $id = $this->post('id');
        $data = $this->mdl_user->getDetailDailyActivities($enduser_id,$id);
        $this->response($data);
    }

    function getTodoListDaily_post(){
        $data=null;
        $enduser_id = $this->post('enduser_id');
        $id = $this->post('id');
        $data = $this->mdl_user->getTodoListDaily($enduser_id,$id);
        $this->response($data);
    }
    
    function getKajianParenting_post(){
        $data=null;
        $enduser_id = $this->post('enduser_id');
        $data = $this->mdl_user->getKajianParenting($enduser_id);
        $this->response($data);
    }


    function addProjectFeedback_post(){
        $data=null;
        $enduser_id = $this->post('enduser_id');
        $data = $this->mdl_user->addProjectFeedback($enduser_id);
        $this->response($data);
    }



    function getStudents_post(){ 
        $data=null;
        $enduserId= $this->post('enduser_id');
        $data = $this->mdl_user->getStudents($enduserId);
        $this->response($data);
    }

    function getTeacher_post(){ 
        $data=null;
        $enduserId= $this->post('enduser_id');
        $data = $this->mdl_user->getTeacher($enduserId);
        $this->response($data);
    }


    //REGISTER
    function register_post(){
        $result = $this->mdl_user->register($this->post('register'));
        // $result = json_decode($this->post('register'));
        $this->response($result);
    }

    //PROFILE SHOW
    function profile_get(){   //-> GET
        $driverId = $this->get('id');

        $data['status'] = "success";
        $data['data'] = $this->mdl_user->profile_get($driverId);
        if(count($data['data']) > 0){
            $this->response($data, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }


    //PROFILE ENDUSER SHOW
    function enduser_profile_get(){   //-> GET
        $enduserId = $this->get('enduserId');

        // $data['status'] = "success";
        $data = $this->mdl_user->enduser_profile_get($enduserId);
        if(count($data) > 0){
            $this->response($data);         
        }else{
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }
    
    function updateProfile_post(){ 
        $enduserId = $this->post('enduserId');
        $profileDetail = $this->post('profileDetail');
        $data = $this->mdl_user->updateProfile($enduserId,$profileDetail);
        $this->response($data);
    }

    function userFeedback_post(){ 
        $enduserId = $this->post('enduserId');
        $orderCode= $this->post('orderCode');
        $cases= $this->post('case');
        $data = $this->mdl_user->userFeedback($enduserId,$orderCode,$cases);
        $this->response($data);
    }

    function userFeedbackUpdate_post(){ 
        $enduserId = $this->post('enduserId');
        $rate = $this->post('rate');
        $message = $this->post('message');
        $orderCode = $this->post('orderCode');
        $case = $this->post('case');
        $data = $this->mdl_user->updateFeedback($enduserId,$rate,$message,$orderCode,$case);
        $this->response($data);
    }

    //PROFILE UPDATE
    function profilePut_post(){
        $result = $this->mdl_user->profile_put($this->post('idProfile'),$this->post('profile'));
        $this->response($result);
    }
   
    //GET USER ADD
    function userOrder_get(){   //-> GET
        $userId = $this->get('userId');

        $data['status'] = "success";
        $data['data'] = $this->mdl_user->userOrder($userId);
        if(count($data['data']) > 0){
            $this->response($data, 200); // 200 being the HTTP response code
        }else{
            $this->response(array('error' => 'User order could not be found'), 404);
        }
    }

    //GET PACKAGE
    function populatePackage_get(){
        $data = $this->mdl_user->get_package();
        $this->response($data, 200);
    }

    function populateReason_get(){
        $data = $this->mdl_user->get_reason();
        $this->response($data, 200);
    }


    function sendFCM_get(){
        $fcmId = $this->get('fcmId');
        $title = $this->get('title');
        $msg = $this->get('msg');
        $case = $this->get('case');
        $result = $this->mdl_user->fcmSingle($fcmId,$title,$msg,$case);
        $this->response($result);
    }
    

    
    function resetPass_post2(){
        $email = $this->post('email');
        $e = array('email' => $email);
        
        $check_email = $this->mdl_user->get_user_reset($email);
        
        $now = gmdate("Y-m-d\TH:i:s\Z");
        $hash = md5($email.$now);
        $newpass = substr($hash,0,10);
        
        if((isset($check_email)) && (!empty($check_email))){
            $now = gmdate("Y-m-d\TH:i:s\Z");
            $hash = md5($email.$now);
            $newpass = substr($hash,0,10);
            $detail = array('password'=>sha1($newpass));
            $this->mdl_user->reset_pass($check_email[0]->enduserId,$detail);
            
            $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://iix80.rumahweb.com',
            'smtp_port' => 465,
            'smtp_user' => 'mailer@oedak.com',
            'smtp_pass' => '0edakmailer0',
            'mailtype'  => 'html', 
            'charset' => 'utf-8',
            'wordwrap' => TRUE
            );
            
            $this->load->library('email',$config);
            $this->email->set_newline("\r\n");
                $this->email->from('mailer@oedak.com', 'NO Reply oedak.com');
            $this->email->to($email);

            $this->email->subject('Reset Password OEDAK');
            $this->email->message('Password dengan user account <b>'.$check_email[0]->username.'</b>, telah di reset menjadi <b>'.$newpass.'</b>. Silahkan segera login dan mengubah password anda.');

            if($this->email->send()){
                $this->response(array('status' => 'Success','message'=>'Password '.$email.' telah di reset, check password baru pada email'));
            }
             else
            {
                $this->response($this->email->print_debugger());
            }       
                    
        } else {
            $this->response(array('status' => 'Failed','message'=>$email.' tidak terdaftar untuk aplikasi oedak'));
            // $this->response(array('error' => 'User email could not be found'), 404);
        }
    }
    
    function resetPass3_post(){
        $email = $this->post('email');
        $email_to = $this->post('email_to');
        $e = array('email' => $email);
        
        $check_email = $this->mdl_user->get_user_reset($email);
        
        $now = gmdate("Y-m-d\TH:i:s\Z");
        $hash = md5($email.$now);
        $newpass = substr($hash,0,10);
        
        if((isset($check_email)) && (!empty($check_email))){
            $now = gmdate("Y-m-d\TH:i:s\Z");
            $hash = md5($email.$now);
            $newpass = substr($hash,0,10);
            $detail = array('password'=>sha1($newpass));
            $this->mdl_user->reset_pass($check_email[0]->id,$detail);

            // $orderCode = 'dd98ce72';
            // $dataTrip = $this->mdl_user->get_detail_trip_recipt($orderCode);
            $datauser = $check_email;
            // print_r($datauser);die();
            
            try {
                $mandrill = new Mandrill(MANDRILL_API_KEY);
                // print_r($mandrill);
                $template_name = 'stepa_reset_pass';
                $template_content = array(
                    array(
                        'name' => 'example name',
                        'content' => 'example content'
                    )
                );
                $message = array(
                    'html' => '<p>Example HTML content</p>',
                    'text' => 'Example text content',
                    'subject' => 'STEPA News & Update',
                    'from_email' => 'info@stepa.prologi-rnd.com',
                    'from_name' => 'STEPA NoReply',
                    'to' => array(
                        array(
                            'email' => $email_to,
                            'name' => $email_to,
                            'type' => 'to' 
                        )
                    ),
                    'headers' => array('Reply-To' => 'info@stepa.prologi-rnd.com'),
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
                            'rcpt' => $email,
                            'vars' => array(
                                array(
                                    'name' => 'USERNAME',
                                    'content' => $check_email[0]->fullname
                                ),
                                array(
                                    'name' => 'NEWPASS',
                                    'content' => $newpass
                                )
                            )
                        )
                    ),
                    'tags' => array('invitation'),
                    'google_analytics_domains' => array('example.com'),
                    'google_analytics_campaign' => 'message.from_email@example.com',
                    'metadata' => array('website' => 'www.stepa.prologi-rnd.com'),
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
                $this->response(array('status' => 'Error','message'=>$e));
                throw $e;
            }
        }else{
            $this->response(array('status' => 'Failed','message'=>$email.' tidak terdaftar untuk aplikasi oedak'));
            // $this->response(array('error' => 'User email could not be found'), 404);
        }
    }

    function forgotpass_post(){
        $email = $this->post('email');
        $email_to = $this->post('email_to');
        $e = array('email' => $email);
        
        $check_email = $this->mdl_user->get_user_reset($email);
        
        $now = gmdate("Y-m-d\TH:i:s\Z");
        $hash = md5($email.$now);
        $newpass = substr($hash,0,10);
        
        if((isset($check_email)) && (!empty($check_email))){
            $now = gmdate("Y-m-d\TH:i:s\Z");
            $hash = md5($email.$now);
            $newpass = substr($hash,0,10);
            $detail = array('password'=>sha1($newpass));
            $this->mdl_user->reset_pass($check_email[0]->id,$detail);

            // $orderCode = 'dd98ce72';
            // $dataTrip = $this->mdl_user->get_detail_trip_recipt($orderCode);
            $datauser = $check_email;
            // print_r($datauser);die();
            
            try {
                $mandrill = new Mandrill(MANDRILL_API_KEY);
                // print_r($mandrill);
                $template_name = 'stepa_reset_pass';
                $template_content = array(
                    array(
                        'name' => 'example name',
                        'content' => 'example content'
                    )
                );
                $message = array(
                    'html' => '<p>Example HTML content</p>',
                    'text' => 'Example text content',
                    'subject' => 'STEPA News & Update',
                    'from_email' => 'info@stepa.prologi-rnd.com',
                    'from_name' => 'STEPA NoReply',
                    'to' => array(
                        array(
                            'email' => $email_to,
                            'name' => $email_to,
                            'type' => 'to' 
                        )
                    ),
                    'headers' => array('Reply-To' => 'info@stepa.prologi-rnd.com'),
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
                            'rcpt' => $email,
                            'vars' => array(
                                array(
                                    'name' => 'USERNAME',
                                    'content' => $check_email[0]->fullname
                                ),
                                array(
                                    'name' => 'NEWPASS',
                                    'content' => $newpass
                                )
                            )
                        )
                    ),
                    'tags' => array('invitation'),
                    'google_analytics_domains' => array('example.com'),
                    'google_analytics_campaign' => 'message.from_email@example.com',
                    'metadata' => array('website' => 'www.stepa.prologi-rnd.com'),
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
                $this->response(array('status' => 'Error','message'=>$e));
                throw $e;
            }
        }else{
            $this->response(array('status' => 'Failed','message'=>$email.' tidak terdaftar untuk aplikasi oedak'));
            // $this->response(array('error' => 'User email could not be found'), 404);
        }
    }

    function send_invitaition_post(){
        echo MANDRILL_API_KEY;
        try {
            $mandrill = new Mandrill(MANDRILL_API_KEY);
            $message = array(
                'html' => '<p>Example HTML content</p>',
                'text' => 'Example text content',
                'subject' => 'example subject',
                'from_email' => 'mailer@oedak.com',
                'from_name' => 'Example Name',
                'to' => array(
                    array(
                        'email' => 'wildansoft@gmail.com',
                        'name' => 'Wildan Wiryawan',
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => 'mailer@oedak.com'),
                'important' => false,
                'track_opens' => null,
                'track_clicks' => null,
                'auto_text' => null,
                'auto_html' => null,
                'inline_css' => null,
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
                        'rcpt' => 'recipient.email@example.com',
                        'vars' => array(
                            array(
                                'name' => 'merge2',
                                'content' => 'merge2 content'
                            )
                        )
                    )
                ),
                'tags' => array('invitation'),
                'subaccount' => 'customer-123',
                'google_analytics_domains' => array('example.com'),
                'google_analytics_campaign' => 'message.from_email@example.com',
                'metadata' => array('website' => 'www.example.com'),
                'recipient_metadata' => array(
                    array(
                        'rcpt' => 'recipient.email@example.com',
                        'values' => array('user_id' => 123456)
                    )
                )
            );
            $async = false;
            $ip_pool = 'Main Pool';
            $send_at = 'example send_at';
            $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
            print_r($result);
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
        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }
    }

    function resetPass_post(){
        $email = $this->post('email');
        $e = array('email' => $email);
        
        $check_email = $this->mdl_user->get_user_reset($email);
        
        $now = gmdate("Y-m-d\TH:i:s\Z");
        $hash = md5($email.$now);
        $newpass = substr($hash,0,10);
        
        if((isset($check_email)) && (!empty($check_email))){
            $now = gmdate("Y-m-d\TH:i:s\Z");
            $hash = md5($email.$now);
            $newpass = substr($hash,0,10);
            $detail = array('password'=>sha1($newpass));
            $this->mdl_user->reset_pass($check_email[0]->id,$detail);
            
            try {
                $mandrill = new Mandrill(MANDRILL_API_KEY);
                $template_name = 'oedak reset pass';
                $template_content = array(
                    array(
                        'name' => 'example name',
                        'content' => 'example content'
                    )
                );
                $message = array(
                    'html' => '<p>Example HTML content</p>',
                    'text' => 'Example text content',
                    'subject' => 'Oedak Reset Password',
                    'from_email' => 'mailer@oedak.com',
                    'from_name' => 'Oedak NoReply',
                    'to' => array(
                        array(
                            'email' => $email,
                            'name' => $email,
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
                            'rcpt' => $email,
                            'vars' => array(
                                array(
                                    'name' => 'USERNAME',
                                    'content' => $check_email[0]->username
                                ),
                                array(
                                    'name' => 'NEWPASS',
                                    'content' => $newpass
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
        }else{
            $this->response(array('status' => 'Failed','message'=>$email.' tidak terdaftar untuk aplikasi oedak'));
            // $this->response(array('error' => 'User email could not be found'), 404);
        }
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
    
    function students_parent_post(){ 
        $data=null;
        $enduserId= $this->post('enduser_id');
        $data = $this->mdl_user->get_students_parent($enduserId);
        $this->response($data);
    }

    function students_past_school_post(){ 
        $data=null;
        $profileId= $this->post('profile_id');
        $userGroupId= $this->post('user_group_id');
        $data = $this->mdl_user->get_asal_sekolah($profileId,$userGroupId);
        $this->response($data);
    }

    function students_family_post(){ 
        $data=null;
        $profileId= $this->post('profile_id');
        $userGroupId= $this->post('user_group_id');
        $data = $this->mdl_user->get_familys($profileId,$userGroupId);
        $this->response($data);
    }

    function students_invoices_post(){ 
        $data=null;
        $profileId= $this->post('profile_id');
        $data = $this->mdl_user->get_invoices($profileId);
        $this->response($data);
    }

    function students_transactions_post(){ 
        $data=null;
        $enduserId= $this->post('enduser_id');
        $data = $this->mdl_user->get_transactions($enduserId);
        $this->response($data);
    }

    // FINGER
    function sync_finger_post(){
        $data=null;
        $institution_id = $this->post('institution_id');
        $data = $this->mdl_user->sync_finger($institution_id);
        $this->response($data);
    }

    function sync_finger_options(){
        $data=null;
        $institution_id = 13;
        $data = $this->mdl_user->sync_finger($institution_id);
        $this->response($data);
    }

    function sync_finger_get(){
        $data=null;
        $institution_id=$this->get('institution_id');
        $data_absen = $this->get('data_absen');

        $data = $this->mdl_user->sync_finger($institution_id,$data_absen);
        $this->response($data);
    }

    function schedule_course_post(){
        $data=null;
        $enduserId= $this->post('enduser_id');
        $data = $this->mdl_user->get_schedule_course($enduserId);
        $this->response($data);
    }

    // GURU
    function schedule_course_teacher_post(){
        $data=null;
        $enduserId= $this->post('enduser_id');
        $data = $this->mdl_user->get_schedule_course_teacher($enduserId);
        $this->response($data);
    }

    function course_by_teacher_post(){
        $data=null;
        $enduserId= $this->post('enduser_id');
        $data = $this->mdl_user->get_course_by_teacher($enduserId);
        $this->response($data);
    }

    function subject_by_teacher_post(){
        $data=null;
        $enduserId= $this->post('enduser_id');
        $data = $this->mdl_user->get_subject_by_teacher($enduserId);
        $this->response($data);
    }

    function kelaswali_by_teacher_post(){
        $data=null;
        $enduserId= $this->post('enduser_id');
        $data = $this->mdl_user->kelaswali_by_teacher($enduserId);
        $this->response($data);
    }

    function course_student_presensi_post(){
        $data=null;
        $course_id= $this->post('course_id');
        $data = $this->mdl_user->get_course_student_presensi($course_id);
        $this->response($data);
    }

     function course_prepare_presensi_post(){
        $data=null;
        $course_id= $this->post('course_id');
        $data = $this->mdl_user->get_course_prepare_presensi($course_id);
        $this->response($data);
    }

    function course_save_presensi_post(){
        $data=null;
        $course_id= $this->post('course_id');
        $data = $this->mdl_user->add_presensi_student($course_id);
        $this->response($data);
    }

}