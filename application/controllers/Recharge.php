<?php
class Recharge extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('User');
		$this->load->model('Codes');

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
	
	
	public function view_plans(){
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
		$data['error'] = $this->session->flashdata('error');
	
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
		$user_id = $this->getUserId();
		$plans=Array(
			0=>'TUP',
			1=>'FTT',
			2=>'2G',
			3=>'3G',
			4=>'SMS',
			5=>'LSC',
			6=>'OTR',
			7=>'RMG'
			
		);
		
		$user_id = $this->getUserId();
		$mobile=$this->input->post('mobile');
		$data['mobile'] =$mobile;

		$ch = curl_init();
		$timeout = 100; // set to zero for no 
		$myHITurl = 'https://joloapi.com/api/findoperator.php?userid=scube0211&key=432063692803158&mob='.$mobile.'&type=text';
		

		curl_setopt ($ch, CURLOPT_URL, $myHITurl);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		$curl_error = curl_errno($ch);
		curl_close($ch);
		//dump output of api if you want during test
		$maindata = explode(",", $file_contents);
		$countdatas = count($maindata);
		
		if($countdatas == 2){
			
			$operator_id = $maindata[0]; //it is joloapi.comgenerated order id
			$circode = $maindata[1]; //it is status of recharge SUCCESS,FAILED	
			$data['operator_id']=$operator_id;
			$data['circode']=$circode;
			$ch = curl_init();
			$timeout = 100; // set to zero for no 
			for ($x = 0; $x <= 7; $x++) {
				$myHITurl = 'https://joloapi.com/api/findplan.php?userid=scube0211&key=432063692803158&opt='.$operator_id.'&cir='.$circode.'&typ='.$plans[$x].'&amt=&max=&type=json';
				
				curl_setopt ($ch, CURLOPT_URL, $myHITurl);
				curl_setopt ($ch, CURLOPT_HEADER, 0);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$file_contents = curl_exec($ch);
				$curl_error = curl_errno($ch);
				if($x==0){
					$topup= json_decode($file_contents, true);
					$data['topup']=$topup;
					
				}
				else if($x==1){
					$fulltalktime= json_decode($file_contents, true);
					$data['fulltalktime']=$fulltalktime;
				}
				else if($x==2){
					$twog= json_decode($file_contents, true);
					$data['twog']=$twog;
				}
				else if($x==3){
					$threeg= json_decode($file_contents, true);
					$data['threeg']=$threeg;
				}
				else if($x==4){
					$sms= json_decode($file_contents, true);
					$data['sms']=$sms;
				}
				else if($x==5){
					$localstd= json_decode($file_contents, true);
					$data['localstd']=$localstd;
				}
				else if($x==6){
					$other= json_decode($file_contents, true);
					$data['other']=$other;
				}
				else if($x==7){
					$roaming= json_decode($file_contents, true);
					$data['roaming']=$roaming;
				}
				}
				
				$this->load->view('templates/header', $data);
				$this->load->view('home/view_plans', $data);
				$this->load->view('templates/footer', $data);
				
				/*$someArray= json_decode($file_contents, true);
				if (count($someArray) > 0) {
				echo "<table class=\"table\"><thead><tr><th>Detail</th><th>Amount (Rs.)</th> <th>Validity (days)</th>  </tr></thead><tbody>";
				foreach($someArray as $key => $value) {
				echo " <tr><td>" .$value["Detail"] . "</td>  <td>" .$value["Amount"] . "</td>    <td>" .$value["Validity"] . "</td> </tr>";
				}
				echo "</tbody></table><br/>";
				}else{echo"Nooffer details available for this category";}*/
				
    		
			
			
	
			
			curl_close($ch);
			//dump output of api if you want during test
				
		}



	}

	public function recharge(){

		if(!$this->is_logged_in())
		{
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}
		$user_id = $this->getUserId();
		
		if(!$this->User->isMobileVerified($user_id)){
			$this->session->set_flashdata('error', 'Please verify mobile number to continue.');
			redirect('home/profile/'.$user_id,'refresh');
		}
		$user_profile = $this->User->getUserProfile($user_id);
		$data['sharentoozbonus']=$user_profile->sharentoozbonus;
		$data['user_earnings'] = $user_profile->user_earnings;
		$data['user_coins'] = $user_profile->user_coins;
		
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
		
		$mobile=$this->input->post('mobile');
		$operator=$this->input->post('operator'); 
		$amount=$this->input->post('amount');
		//generating random unique orderid for your reference
		$uniqueorderid = substr(number_format(time() * rand(),0,'',''),0,10);
		
		if($amount > $data['user_earnings']){
			$this->session->set_flashdata('error', 'You are trying to recharge with a value greater than your earnings.');
			redirect('home/wallet/'.$user_id,'refresh');
			}

		$operators=Array(
			
			28=>'AT',
			1=>'AL',
			3=>'BS',
			24=>'BSS',
			8=>'IDX',
			22=>'VF',
			17=>'TD',
			25=>'TDS',
			18=>'TI',
			13=>'RG',
			12=>'RL',
			10=>'MS',
			19=>'UN',
			26=>'UNS',
			5=>'VD',
			27=>'VDS',
			6=>'MTM',
			7=>'MTMS',
			20=>'MTD',
			21=>'MTDS',
			30=>'VG',
			31=>'VGS',
			32=>'VC',
			33=>'T24',
			34=>'T24S',
			
		);
		$operator = $operators[$operator];

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
			$this->User->NewEarnings($user_id,'-'.$amount);
			$this->load->view('templates/header', $data);
			$this->load->view('home/rechargestatus', $data);
			$this->load->view('templates/footer', $data);
			//YOUR REST QUERY HERE
		} 
		else if($txnstatus=='PENDING'){
			$this->User->NewEarnings($user_id,'-'.$amount);
			$this->load->view('templates/header', $data);
			$this->load->view('home/rechargestatus', $data);
			$this->load->view('templates/footer', $data);
				//YOUR REST QUERY HERE
		}
		else if
		($txnstatus=='FAILED'){
			$this->load->view('templates/header', $data);
			$this->load->view('home/rechargestatus', $data);
			$this->load->view('templates/footer', $data);
			//YOUR REST QUERY HERE
		}
		else {
			echo"You cannot run file directly.";
			$this->load->view('templates/header', $data);
			$this->load->view('home/rechargestatus', $data);
			$this->load->view('templates/footer', $data);
		}
		//display the result to customer
	}

	public function match_recharge_code() {
		if(!$this->is_logged_in()) {
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}
		$user_id = $this->getUserId();
		if(!$this->User->isMobileVerified($user_id)){
			$this->session->set_flashdata('error', 'Please verify mobile number to continue.');
			redirect('home/profile/'.$user_id,'refresh');
		}
		$recharge_code = $this->input->post('recharge_code');
		if ($this->Codes->is_code_matches($recharge_code)) {
			$code = $this->Codes->get_code_details($recharge_code);
			if ($code->used == 0) {
				$this->Codes->code_used($recharge_code, $user_id);
				$this->User->NewEarnings($user_id, $code->recharge_value);
				$this->session->set_flashdata('info',"Congratulations! ". $code->recharge_value . " added to your earning.Now,you can use them to recharge your mobile");
			}
			else
				$this->session->set_flashdata('error',"Recharge code already used.");
		}
		else
			$this->session->set_flashdata('error',"Invalid recharge code");
		redirect('home/wallet/'.$user_id, 'refresh');
	}

}

?>