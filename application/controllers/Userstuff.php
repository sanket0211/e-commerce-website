<?php

class Userstuff extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('User');
		$this->load->model('Unverified_User');
		$this->load->model('FaceBookDetails');
		$this->load->model('City');
		$this->load->model('Item');
		$this->load->model('Category');
		$this->load->model('Community');

		$this->load->helper('form');
		
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('email');
	}

	private function is_logged_in()
	{
		return null !== $this->session->userdata('logged_in');
	}
	private function getUserName() {
		if($this->is_logged_in()) {
			$session_data = $this->session->userdata('logged_in');
			return $session_data['user_name'];
		}
		return NULL;
	}
	private function getUserId() {
		if($this->is_logged_in()) {
			$session_data = $this->session->userdata('logged_in');
			return $session_data['user_id'];
		}
		return NULL;
	}

	public function register()
	{
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
	
		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');

		if($this->is_logged_in())
		{
			$this->session->set_flashdata('info','You are already registered.');
			redirect('home/index','refresh');
		}
		$flag = 0;

		$this->form_validation->set_rules('user_name','Name','required');
		$this->form_validation->set_rules('user_password_new','Password','required');
		$this->form_validation->set_rules('user_password_repeat','Confirm password','required');
		$this->form_validation->set_rules('user_email','Email','required|valid_email');
		//$this->form_validation->set_rules('user_phone','Phone','required');
		//$this->form_validation->set_rules('user_address','Address','required	');
		
		
		$fb_id = $this->input->post('fb_id');
		$fb_email = $this->input->post('fb_email');
		$isfacebookverified = $this->FaceBookDetails->isFacebookVerified($fb_id);

		if($this->input->post('upload'))
		{
		
			$config['upload_path'] = './uploads/profile';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']    = '1024000000';
			$config['max_width']  = '15000';
			$config['max_height']  = '15000';
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload())
			{
				$str = $this->upload->display_errors();
				
				if(strcmp($str,"You did not select a file to upload.")==-1){
					$unverified_user_img_name = "default";
					$unverified_user_img_name_ext = ".jpg";
					$unverified_user_thumb_name = "default_thumb";
				}
				else{
					$this->session->set_flashdata('error',$this->upload->display_errors());
					redirect('home/login','refresh');
					$flag=1;
				}
			}
			else
			{
				$pic=$this->upload->data();
				//$this->thumb($pic);
				$unverified_user_img_name = $pic['raw_name'];
				$unverified_user_img_name_ext = $pic['file_ext'];
				$unverified_user_thumb_name = $pic['raw_name'].'_thumb';
			}
		}
		if($flag == 0){
		
			if ($this->form_validation->run() === FALSE)
			{   
			
				$this->session->set_flashdata('error', 'Wrong form');
				redirect('home/login','refresh');
			}
			else if($_POST['user_password_new'] !== $_POST['user_password_repeat'])
			{
				$this->session->set_flashdata('error', 'Password didn\'t match');
				redirect('home/login','refresh');
			}	
			else if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
				$this->session->set_flashdata('error', 'Invalid email format');
				redirect('home/login','refresh');
			}
			else
			{
				
				//$this->db->insert('unverified_users',$file);
				$data = array('upload_data' => $this->upload->data());
				$insert_id = $this->Unverified_User->insert($unverified_user_img_name,$unverified_user_img_name_ext,$unverified_user_thumb_name);
				
				if($insert_id > 0)
				{
					// success
					if($isfacebookverified==0){
					$this->send_verification_email($insert_id);
					} else {
					$emailDetail = $this->Unverified_User->getEmailDetails($insert_id);
					$num_length = strlen((string)$emailDetail->unverified_user_id);
					$sent_code = $num_length.$emailDetail->unverified_user_id.$emailDetail->unverified_user_email_code; 
		
					
					$len = (int)substr($sent_code, 0,1);
					$user_id = (int)substr($sent_code, 1, $len);
					$verification_code = substr($sent_code, $len+1);
					/*var_dump($verification_code);
					var_dump($user_id);*/
					if(strlen($user_id) != $len){
						return NULL;
					}
					$isVerified = $this->Unverified_User->verifyEmail($verification_code, $user_id);
					
					
					
					$this->FaceBookDetails->updatefbverify($fb_email,2);
					
					$result = $this->User->fblogin($fb_email);
						if($result) {
							
							
							$session_array = array();
							foreach($result as $row)
							{
								//print_r($row);
								$session_array = array(
									'user_id' => $row->user_id,
									'user_name' => $row->user_name,
									'user_email' => $row->user_email,
									'user_phone' => $row->user_phone
								);
								$this->session->set_userdata('logged_in', $session_array);
							}
							redirect('home/main', 'refresh');
							}
						
					}
					//$this->session->set_flashdata('error', $insert_id);
					//$this->User->moveHere($insert_id);

					$this->session->set_flashdata('error', 'An email has been sent to you!!');

					redirect('home/login','refresh');
				}
				else
				{
					//$pic = array('upload_data' => $this->upload->data());
					//$this->load->view('upload_success', $pic);
					$this->session->set_flashdata('error', 'User cannot be created');
					redirect('home/login','refresh');
				}
			}
		}
	}

	public function changeprofilephoto(){
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
		$user_id = $this->getUserId();
		$user_profile = $this->User->getUserProfile($user_id);
		$data['sharentoozbonus']=$user_profile->sharentoozbonus;
		$data['user_earnings'] = $user_profile->user_earnings;
		$data['user_coins'] = $user_profile->user_coins;

		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		
		if(!$this->is_logged_in())
		{
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}
		
		if($this->input->post('upload'))
		{
			$config['upload_path'] = './uploads/profile';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']    = '15000000';
			$config['max_width']  = '1980';
			$config['max_height']  = '1080';
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload())
			{
				$this->session->set_flashdata('error',$this->upload->display_errors());
				redirect('home/profile/'.$user_id,'refresh');
				
			}
			else
			{
				$pic=$this->upload->data();
				//$this->thumb($pic);
				$user_img_name = $pic['raw_name'];
				$user_img_ext = $pic['file_ext'];
				$user_thumb_name = $pic['raw_name'].'_thumb';
				
				
				$insert_id = $this->User->changeprofilephoto($user_id, $user_img_name,$user_img_ext,$user_thumb_name);
				if($insert_id > 0)
				{
					
					$this->session->set_flashdata('info', 'Success!. Profile photo updated!');
				}	
				else
				{
					$this->session->set_flashdata('error', 'Error');
				}
				redirect('home/profile/'.$user_id, 'refresh');

			}
		}
	
	}

	public function login()
	{
		/*if ($this->user) 
		{
			$data['user_profile'] = $this->facebook->api('/me/');

			// Get logout url of facebook
			$data['logout_url'] = $this->facebook->getLogoutUrl(array('next' => base_url() . 'index.php/oauth_login/logout'));

			// Send data to profile page
			$this->load->view('home/main', $data);	
			
		} 
		else 
		{

			// Store users facebook login url
			$data['login_url'] = $this->facebook->getLoginUrl();
			$this->load->view('home/login', $data);
		}*/


	    /*$this->load->library('email');
	    $this->email->from('name@domain.com','fullname');
	    $this->email->to('ssanket369@gmail.com');
	    $this->email->subject('A test email from CodeIgniter using Gmail');
	    $this->email->message('I can now email from CodeIgniter using Gmail as my server!');
	    $this->email->send();*/

		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
		$user_id = $this->getUserId();
		
		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');

		$data['cities'] = $this->City->getCity();
		if($this->is_logged_in())
		{
			$user_profile = $this->User->getUserProfile($user_id);
			$data['sharentoozbonus']=$user_profile->sharentoozbonus;
			$data['user_earnings'] = $user_profile->user_earnings;
			$data['user_coins'] = $user_profile->user_coins;

			$this->session->set_flashdata('info','You are already logged in.');
			redirect('home/main','refresh');
		}	
		$data['error'] = $this->session->flashdata('error');
		$data['title'] = 'Login';
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->form_validation->set_rules('user_email','Email','trim|required');
		$this->form_validation->set_rules('user_password','Password','trim|required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('home/login', $data);
			$this->load->view('templates/footer', $data);
		}
		else if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
			$this->session->set_flashdata('error','Invalid email format');
			$this->load->view('templates/header', $data);
			$this->load->view('home/login', $data);
			$this->load->view('templates/footer', $data);
		}
		else
		{

			// confirming user account;
			$result = $this->User->login();
			if($result) {
				

				$session_array = array();
				foreach($result as $row)
				{
					//print_r($row);
					$session_array = array(
						'user_id' => $row->user_id,
						'user_name' => $row->user_name,
						'user_email' => $row->user_email,
						'user_phone' => $row->user_phone
					);
					$this->session->set_userdata('logged_in', $session_array);
				}
				redirect('home/main', 'refresh');
			} else {

				$this->session->set_flashdata('error','Invalid password or Invalid username');
				$this->session->set_flashdata('info','If you are new user, please verify email to continue');
				redirect('home/login','refresh');

			}
			$this->load->view('templates/header', $data);
			$this->load->view('home/login', $data);
			$this->load->view('templates/footer', $data);
		}

	}

	public function logout()
	{
		// Destroy session
		session_destroy();

		// Redirect to baseurl
		redirect(base_url());
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home/index', 'refresh');
	}

	public function forgotpassword(){

		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');

		$this->load->view('home/forgotpassword',$data);
	}

	public function passwordchangelink(){
		$user_email=$this->input->post('email');
		if(!$this->User->isUser($user_email)){
			$this->session->set_flashdata('error', 'Sorry, this email is not registered with us.');
			redirect('home/forgotpassword','refresh');
		}
		else{
			$this->User->checkTable($user_email);
			$data = array(
			'user_email' => $user_email,
			'password_change_code' => sha1(time())
		);
			$this->db->insert('Forgotpassword', $data);
			$this->send_changepassword_email($user_email); 
			$this->session->set_flashdata('error', 'Password change link has been sent to you on mail.');
			redirect('home/forgotpassword','refresh');

		}
	}

	private function send_changepassword_email($user_email){
		$this->db->select('user_id,user_email,password_change_code');
		$this->db->where('user_email', $user_email);
		$this->db->from('Forgotpassword');

		$query = $this->db->get();
		$emailDetail = $query->result()[0];
		$this->email->from('support@rentooz.com','Rentooz');
		$this->email->to($user_email);
		$this->email->subject('Password Change link');
		$email_msg = "Dear User, Please click on below URL or paste into your browser to change your password";  
		$email_msg .= "http://www.rentooz.com/index.php/home/changepassword/" .$emailDetail->password_change_code;    
		$email_msg .= "Thanks,  Support Team";  
		$this->email->message($email_msg);
		$this->email->send();		
	}

	public function changepassword($code){
		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');
		if(is_null($code)){
			print_r("hello");
			die();
			show_404();
		}
		else{
			$check = $this->User->crosscheckpasswordchangecode($code);

			if($check){
				$data['code']=$code;
				$this->load->view('home/changepassword',$data);
			}
			else{
				show_404();
			}
		}
	}

	public function verifychangepassword($code){
		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');
		
		$this->form_validation->set_rules('user_password_new','Password','required');
		$this->form_validation->set_rules('user_password_repeat','Confirm password','required');

		if ($this->form_validation->run() === FALSE)
		{   
			redirect('home/changepassword/'.$code,'refresh');
		}
		else if($_POST['user_password_new'] !== $_POST['user_password_repeat'])
		{
			$this->session->set_flashdata('error', 'Password didn\'t match');
			redirect('home/changepassword/'.$code,'refresh');
		}	
		else{
			$this->db->select('user_id,user_email,password_change_code');
			$this->db->where('password_change_code', $code);
			$this->db->from('Forgotpassword');

			$query = $this->db->get();
			$emailDetail = $query->result()[0];
			
			$this->User->updatepassword($emailDetail->user_email);
			$this->db->delete('Forgotpassword',array('user_email' => $emailDetail->user_email));
			$this->session->set_flashdata('error', 'Password Changed Successfully');
			redirect('home/login','refresh');
		}
	}

	private function send_verification_email($user_id){
		$emailDetail = $this->Unverified_User->getEmailDetails($user_id);
		if($emailDetail->unverified_user_id AND $emailDetail->unverified_user_id != -1) {
			$this->email->from('support@rentooz.com','Rentooz');
			$this->email->to($emailDetail->unverified_user_email);
			$num_length = strlen((string)$emailDetail->unverified_user_id);
			$this->email->subject('Verify your email address');
			$email_msg = "Dear User,<p> Please click on below URL or paste into your browser to verify your Email Address.<p>";  
			$email_msg .= "http://www.rentooz.com/index.php/home/verify/" . $num_length . $emailDetail->unverified_user_id.$emailDetail->unverified_user_email_code;    
			$email_msg .= "<p>Thanks,  Support Team</p>";  
			$this->email->message($email_msg);
			$this->email->send();		
		}
	}
	
	public function verify($sent_code){
		$len = (int)substr($sent_code, 0,1);
		$user_id = (int)substr($sent_code, 1, $len);
		$verification_code = substr($sent_code, $len+1);
		/*var_dump($verification_code);
		var_dump($user_id);*/
		if(strlen($user_id) != $len){
			return NULL;
		}
		$isVerified = $this->Unverified_User->verifyEmail($verification_code, $user_id);
		if($isVerified == -1){
			$this->session->set_flashdata('error','Can\'t verify email');
		}
		else {
			$this->login();
			$this->session->set_flashdata('info','Email verified');
			redirect('home/login','refresh');
		}
		redirect('home/login','refresh');
	}

	public function gen_otp(){
		$user_id = $this->getUserId();
		$isError = $this->User->gen_OTP($user_id);
		echo $isError;
		//$this->send_otp($isError);
		$isError = $this->User->gen_OTP($user_id);
		if(is_null($isError) OR $isError == -1){
			// error
		}
		$this->send_otp($isError);
	}
		
	public function send_otp($otp=NULL){
		$user_id = $this->getUserId();
		$username = urlencode('rentooz');
		$password = urlencode('1274706582');

		$user_details = $this->User->getUserProfile($user_id);
		$mobile = '91' . $user_details->user_phone;
		if(is_null($otp)){
			$otp = $this->User->get_otp($user_id)->user_phone_otp;
		}

		// Message details
		$numbers = urlencode($mobile);
		$sender = urlencode('RENTOZ');
		$message = urlencode('your OTP is '.$otp.' Thank you for using our service.');

		// Prepare data for POST request
		$data = 'username=' . $username . '&password=' . $password . '&mobileno=' . $numbers . '&sendername=' . $sender . '&message=' . $message;

		// Send the GET request with cURL
		$URL = 'http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?'.$data;

		$curl = curl_init();
		curl_setopt_array($curl, array( 
   			CURLOPT_RETURNTRANSFER => 1,
		   	CURLOPT_HEADER => 1,
		   	CURLOPT_VERBOSE => 1,          
   			CURLOPT_URL => $URL
		));

		$curl_response = curl_exec($curl);

		if($curl_response == FALSE) {
			die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
		}
		curl_close($curl);
	}

	public function verify_mobile(){
		$user_id = $this->getUserId();
		$isError = $this->User->verify_mobile($user_id);
		if($isError == -1){
			$this->session->set_flashdata('error','Wrong OTP entered');
		}
		else{
			$this->session->set_flashdata('info','Mobile verified');
		}
		redirect('home/profile/'.$user_id,'refresh');
	}

	public function changemobilenumber(){
		if(!$this->is_logged_in()) { show_404(); }
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->form_validation->set_rules('user_phone','Phone','required');

		$user_id = $this->getUserId();
		if ($this->form_validation->run() === FALSE) {
			redirect('home/profile/'.$user_id,'refresh');
		} else {
			$isError = $this->User->gen_OTP($user_id);
			if($isError == -1){
				$this->session->set_flashdata('error','An error occured.Try again');
			} else {
				$this->User->updatePhoneNumber($user_id);
				$this->session->set_flashdata('info','Mobile number changed successfully. Please verify it.');
			}
			redirect('home/profile/'.$user_id,'refresh');
		}
	}

	public function profile($user_id)
	{
		if(!$this->is_logged_in()) {
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}
		
		

		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
		$user_id = $this->getUserId();
		
		$fb_id = $this->FaceBookDetails->getfb_id($user_id);
		if ($fb_id) {
			$fb_id = $fb_id->user_fb_id;
		}
		$data['fb_id'] = $fb_id;

		
		$cur_user_id = $this->getUserId();

		$giver_profile = $this->User->getUserProfile($user_id);

		$data['items'] = $this->Item->getmyactiveitems($user_id);

		foreach($data['items'] as $item) {
			$cat = $this->Category->getCatSub($item->item_category_id);
			$item->isMyItem = $this->Item->isMyItem($item->item_id, $user_id);
			$item->category = $cat->category_name;
			$item->sub_category = $cat->sub_category_name;
			$item->category_id = $cat->category_id;
			$item->comm_name = $this->Community->getCommunity($item->community_id)->community_name;
		}

		$data['giver_id'] = $giver_profile->user_id;
			$data['giver_name'] = $giver_profile->user_name;
		
		
		$user_profile = $this->User->getUserProfile($user_id);

		if($user_profile AND $user_id == $cur_user_id) {
			$data['user_id'] = $user_profile->user_id;
			$data['user_name'] = $user_profile->user_name;
			$data['user_phone'] = $user_profile->user_phone;
			$data['user_email'] = $user_profile->user_email;
			$data['user_email'] = $user_profile->user_email;
			$data['user_img_name'] = $user_profile->user_img_name;
			$data['user_address'] = $user_profile->user_address;
			$data['user_img_ext'] = $user_profile->user_img_ext;
			$data['isMobileVerified'] = $this->User->isMobileVerified($user_id);
			$data['user_earnings'] = $user_profile->user_earnings;
			$data['user_coins'] = $user_profile->user_coins;
			$data['sharentoozbonus']=$user_profile->sharentoozbonus;

			$this->load->view('templates/header', $data);
			$this->load->view('home/profile', $data);
			$this->load->view('templates/footer', $data);
		} else { show_404();}
	}
}
?>
