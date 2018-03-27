<?php
class Bonus extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('User');
		$this->load->helper('url');
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');

		//$this->user = $this->facebook->getUser();
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



	public function freeaddposting(){
		if(!$this->is_logged_in())
		{
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}

		$user_id = $this->getUserId();
		$user_profile = $this->User->getUserProfile($user_id);
		$data['sharentoozbonus']=$user_profile->sharentoozbonus;
		$data['user_earnings'] = $user_profile->user_earnings;
		$data['user_coins'] = $user_profile->user_coins;
		if(!$this->User->isMobileVerified($user_id)){
			$this->session->set_flashdata('error', 'Please verify mobile number to continue.');
			redirect('home/profile/'.$user_id,'refresh');
		}
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
		$sharentoozbonus = $this->User->getsharentoozbonus($user_id)->sharentoozbonus;
		$data['sharentoozbonus']=$sharentoozbonus;
		if($sharentoozbonus>=50){
			$this->User->subsharentoozbonus($user_id,50);
			$adslimit = $this->User->getAdsLimit($user_id)->ads_limit;
			$data['adslimit']=$adslimit;
			$this->User->updateAdsLimit($user_id,$adslimit + 3);
			$this->session->set_flashdata('error', 'Your new add limit is '.$adslimit+3);
			redirect('home/bonusandoffers');
		}
	}

	public function freegoldcoins(){
		if(!$this->is_logged_in())
		{
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}

		$user_id = $this->getUserId();
		$user_profile = $this->User->getUserProfile($user_id);
		$data['sharentoozbonus']=$user_profile->sharentoozbonus;
		$data['user_earnings'] = $user_profile->user_earnings;
		$data['user_coins'] = $user_profile->user_coins;
		if(!$this->User->isMobileVerified($user_id)){
			$this->session->set_flashdata('error', 'Please verify mobile number to continue.');
			redirect('home/profile/'.$user_id,'refresh');
		}
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
		$sharentoozbonus = $this->User->getsharentoozbonus($user_id)->sharentoozbonus;
		$data['sharentoozbonus']=$sharentoozbonus;
		
		$this->User->subsharentoozbonus($user_id,100);
		$this->User->update_coins($user_id,300);
		
		$this->session->set_flashdata('error', 'Offer successfully applied');
		redirect('home/bonusandoffers');
		
	}

	public function rechargebonus(){

		if(!$this->is_logged_in())
		{
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}
		$user_id = $this->getUserId();
		$user_profile = $this->User->getUserProfile($user_id);
		$data['sharentoozbonus']=$user_profile->sharentoozbonus;
		$data['user_earnings'] = $user_profile->user_earnings;
		$data['user_coins'] = $user_profile->user_coins;
		if(!$this->User->isMobileVerified($user_id)){
			$this->session->set_flashdata('error', 'Please verify mobile number to continue.');
			redirect('home/profile/'.$user_id,'refresh');
		}
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
		$user_id = $this->getUserId();
		
		$user_id = $this->getUserId();
		$mobile=$this->input->post('mobile'); 
		$operator=$this->input->post('operator'); 
		$amount=20;
		//generating random unique orderid for your reference
		$uniqueorderid = substr(number_format(time() * rand(),0,'',''),0,10);
		/*print_r($mobile);
		print_r($operator);
		print_r($amount);
		print_r($uniqueorderid);
		die();*/
		$data = array(
			'mobile' => $mobile,
			'operator' => $operator,
			'amount' => $amount,
			'uniqueorderid' => $uniqueorderid
			
		);

		$this->db->insert('Recharge', $data);

		//now run joloapi.comapi link for recharge
		$ch = curl_init();
		$timeout = 100; // set to zero for no 
		$myHITurl = 'http://joloapi.com/api/recharge.php?mode=1&userid=scube0211&key=432063692803158&operator='.$operator.'&service='.$mobile.'&amount='.$amount.'&orderid='.$uniqueorderid;
		/*print_r($myHITurl);
		die();*/
		curl_setopt ($ch, CURLOPT_URL, $myHITurl);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		$curl_error = curl_errno($ch);
		curl_close($ch);
		//dump output of api if you want during test
		// lets extract data from output for display to user and for updating databse
		$maindata = explode(",", $file_contents);
		$countdatas = count($maindata);
		if($countdatas > 2){
		//recharge is success
		$joloapiorderid = $maindata[0]; //it is joloapi.comgenerated order id
		$txnstatus = $maindata[1]; //it is status of recharge SUCCESS,FAILED
		$operator= $maindata[2]; //operator code
		$service= $maindata[3]; //mobile number
		$amount= $maindata[4]; //amount
		$mywebsiteorderid= $maindata[5]; //your website order id
		$errorcode= $maindata[6]; // api error code 
		$operatorid= $maindata[7]; //original operator transaction id
		$myapibalance= $maindata[8];  //my joloapi.comremaining balance
		$myapiprofit= $maindata[9]; //my earning on this recharge
		$txntime= $maindata[10]; // recharge time

		$data['joloapiorderid'] = $maindata[0]; //it is joloapi.comgenerated order id
		$data['txnstatus'] = $maindata[1]; //it is status of recharge SUCCESS,FAILED
		$data['operator']= $maindata[2]; //operator code
		$data['service']= $maindata[3]; //mobile number
		$data['amount']= $maindata[4]; //amount
		$data['mywebsiteorderid']= $maindata[5]; //your website order id
		$data['errorcode']= $maindata[6]; // api error code 
		$data['operatorid']= $maindata[7]; //original operator transaction id
		$data['myapibalance']= $maindata[8];  //my joloapi.comremaining balance
		$data['myapiprofit']= $maindata[9]; //my earning on this recharge
		$data['txntime']= $maindata[10]; // recharge time
		}

		else{
		//recharge is failed
		$txnstatus = $maindata[0]; //it is status of recharge FAILED
		$errorcode= $maindata[1];// api error code
		$data['txnstatus'] = $maindata[0]; //it is status of recharge SUCCESS,FAILED
		$data['errorcode']= $maindata[1]; // api error code 
		
		}
		
		//if curl request timeouts
		if($curl_error=='28'){
		//Request timeout, consider recharge status as pending/success
		$txnstatus = "PENDING";
		}
		//cases
		if($txnstatus=='SUCCESS'){
			$this->User->subsharentoozbonus($user_id,100);
			$this->User->NewEarnings($user_id,'-'.$amount);
			$this->load->view('templates/header', $data);
			$this->load->view('home/rechargestatus', $data);
			$this->load->view('templates/footer', $data);
			//YOUR REST QUERY HERE
		} 
		if($txnstatus=='PENDING'){
			$this->User->NewEarnings($user_id,'-'.$amount);
			$this->load->view('templates/header', $data);
			$this->load->view('home/rechargestatus', $data);
			$this->load->view('templates/footer', $data);
				//YOUR REST QUERY HERE
		}
		if
		($txnstatus=='FAILED'){
			$this->load->view('templates/header', $data);
			$this->load->view('home/rechargestatus', $data);
			$this->load->view('templates/footer', $data);
			//YOUR REST QUERY HERE
		}
		else{
			$this->load->view('templates/header', $data);
			$this->load->view('home/rechargestatus', $data);
			$this->load->view('templates/footer', $data);
		}
		//display the result to customer
		
		
	}
}
?>
