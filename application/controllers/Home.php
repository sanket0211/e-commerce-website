<?php
class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('User');
		$this->load->model('Community');
		$this->load->model('Bank_Details');
		$this->load->model('Member');
		$this->load->model('Item');
		$this->load->model('FaceBookDetails');
		$this->load->model('Deal');
		$this->load->model('City');
		$this->load->model('Demand');
		$this->load->model('Category');
		$this->load->model('Activity');

		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('email');
		$this->load->library('session');

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

	public function comingsoon() {
		$this->load->view('home/comingsoon');
	}
		
	public function index()
	{
		if(!$this->is_logged_in())
		{
			$data['isLoggedin'] = $this->is_logged_in();
			$this->load->view('home/index', $data);
			$this->load->view('templates/footer', $data);
		} else{
			$user_id = $this->getUserId();
			$user_profile = $this->User->getUserProfile($user_id);
			$data['sharentoozbonus']=$user_profile->sharentoozbonus;
			$data['user_earnings'] = $user_profile->user_earnings;
			$data['user_coins'] = $user_profile->user_coins;
			$data['error'] = $this->session->flashdata('error');
			$data['info'] = $this->session->flashdata('info');
			
			$data['myCommunites'] = NULL;
			$data['isLoggedin'] = $this->is_logged_in();
			$data['user_name'] = $this->getUserName();
			$data['user_id'] = $this->getUserId();
			$data['community_list'] = $this->Community->getCommunity();
			$data['not_joined_communities'] = $this->Community->getNotJoinedCommunities($data['user_id']);
			
			/*$this->load->view('templates/header', $data);*/
			$this->load->view('home/index', $data);
			$this->load->view('templates/footer', $data);
		}
	}
	
	
	public function fb_verify(){
		
		$data['cities'] = $this->City->getCity();
		$data['info'] = $this->session->flashdata('info');
		$data['error'] = $this->session->flashdata('error');
		$fb_name = $this->input->post('fb_name');
		$fb_id = $this->input->post('fb_id');
		$fb_email = $this->input->post('fb_email');
		
		$data['fb_name'] = $fb_name;
		$data['fb_id'] = $fb_id;
		$data['fb_email'] = $fb_email;
		
		
		$checkfbverification =$this->FaceBookDetails->isFacebookVerified($fb_id);
		$isfbverified = $checkfbverification;
		$data['isfbverified']=$isfbverified;

		if($isfbverified == 1){
			$this->session->set_flashdata('error', 'Its time to complete your profile!!');
			$this->load->view('home/complete_profile', $data);
		
		}
		if($isfbverified == 2){
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
		if($isfbverified == 0){
			$this->FaceBookDetails->insert($fb_name,$fb_id, $fb_email);
			$this->FaceBookDetails->updatefbverify($fb_email, 1);
			$this->load->view('home/complete_profile', $data);
		}
		
	}
	

	public function itemRequest($comm_id = NULL, $item_id = NULL)
	{
		//$data['isLoggedin'] = $this->is_logged_in();
		if(is_null($item_id) AND is_null($comm_id)) {
			show_404();
		}
		if(!$this->is_logged_in()) {
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}
		$user_id = $this->getUserId();
		$user_profile = $this->User->getUserProfile($user_id);
		$user_earnings = $user_profile->user_earnings;
		$user_coins = $user_profile->user_coins;
		$user_offset = $user_profile->offset;

		$item = $this->Item->getItemInfo($item_id);
		if (is_int($item)) {
			if ($item == NULL)
				show_404();
			else if ($item == EXIT_DATABASE){
				$this->session->set_flashdata('error', 'An unknown error occured, please try later');
				redirect('home/main', 'refresh');
			}

		}

		$item_rent = $item->item_rent;
		$data['sharentoozbonus'] = $user_profile->sharentoozbonus;
		$data['user_earnings'] = $user_earnings;
		$data['user_coins'] = $user_coins;
		
		if (!$this->User->isMobileVerified($user_id)){
			$this->session->set_flashdata('error', 'Please verify mobile number to continue.');
			redirect('home/profile/'.$user_id,'refresh');
		} else {
			$no_of_days = $this->input->post('no_of_days');
			$start_date = $this->input->post('renting_start_date');
			$total_rent = $no_of_days * $item_rent;

			if ($total_rent > ($user_coins - $user_offset)) {
				$this->session->set_flashdata('error', 'You don\'t have enough coins.<a href='.base_url().'home/wallet/'.$user_id.'>Buy here!</a>');
				redirect('home/item/'.$item_id,'refresh');
			}

			if((date('Y-m-d', strtotime($start_date))) <= (date('Y-m-d'))) {
				$this->session->set_flashdata('error', 'Please provide date greater than today\'s date.');
				redirect('home/item/'.$item_id,'refresh');
			}
			$item_status = $this->Item->is_item_activated($item_id);

			if ($item_status == FALSE) {
				$this->session->set_flashdata('error', 'this item is not available right now!');
				redirect('home/item/'.$item_id,'refresh');	
			}

			$request_status = $this->Deal->isAlreadyEntered($user_id, $item_id);

			// TODO: Use constants here
			if(is_null($request_status) or $request_status == DEAL_STATUS_UNSUCCESS_SEEN)
			{
				// Item request submiting 
				$giver_id = $this->Item->getGiverId($item_id);
				$isInserted = $this->Deal->insert($user_id, $giver_id, $item_id, DEAL_STATUS_PENDING, $start_date, $no_of_days);
				if ($isInserted == EXIT_DATABASE) {
					$this->session->set_flashdata('info', 'your request has been submitted');	
				}
				$deal_id = $isInserted;
				$this->Activity->insert($user_id, NULL, $item_id, $deal_id, $giver_id, TYPE_REQUEST_ITEM);
				$this->session->set_flashdata('info', 'your request has been submitted');
			}
			else if($request_status == 0)
			{
				// item request already submitted
				$this->session->set_flashdata('info', 'you request for this item is pending.');
			}
			else if($request_status == 1)
			{
				// item request is already approved.
				$this->session->set_flashdata('info','request has been accepted');
			}
			else if($request_status == 2)
			{
				// item request is already approved.
				$this->session->set_flashdata('info','renting period already started');
			}
			else if($request_status == 3)
			{
				// item request is already approved.
				$this->session->set_flashdata('info','request period has been over');
			}
			else if($request_status == 4)
			{
				// item request is already approved.
				$this->session->set_flashdata('info','request has been cancelled');
			}
			else if ($request_status == EXIT_DATABASE) {
				// $isValid == -1 ---> DB error
				$this->session->set_flashdata('info','cannot process your request,please retry');
			}
			redirect('home/item/'.$item_id,'refresh');
		}
	}
	

	public function main() {
		if(!$this->is_logged_in()) {
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

		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');

		$session_data = $this->session->userdata('logged_in');
		$data['user_email'] = $session_data['user_email'];
		$data['user_phone'] = $session_data['user_phone'];
		
		$data['categories'] = $this->Category->getCategories();

		$data['myCommunites'] = $this->Community->getCommunity(NULL,$user_id);
		$data['all_communites'] = $this->Community->getCommunity();

		$data['myCommunites'] = $this->Community->getCommunity(NULL,$user_id);
		$data['all_communites'] = $this->Community->getCommunity();
		// TODO: Move my items to somewhere else
		$data['myItems'] = $this->Item->getItem(NULL,NULL,$user_id);
		$data['items'] = $this->Item->getmycommunityitems($user_id);
		$data['recentItems'] = $this->Item->getRecentItems($user_id);
		foreach($data['items'] as $item) {
			$cat = $this->Category->getCatSub($item->item_category_id);
			$item->isMyItem = $this->Item->isMyItem($item->item_id, $user_id);
			$item->category = $cat->category_name;
			$item->sub_category = $cat->sub_category_name;
			$item->category_id = $cat->category_id;
			$item->comm_name = $this->Community->getCommunity($item->community_id)->community_name;
		}
	
		$this->load->view('templates/header', $data);
		$this->load->view('home/main', $data);
		$this->load->view('templates/footer', $data);
	}

	public function GiverItems($giver_id){
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

		$data['isMobileVerified']= $this->User->isMobileVerified($user_id);
		$user_profile = $this->User->getUserProfile($user_id);
		$data['sharentoozbonus']=$user_profile->sharentoozbonus;
		$data['user_earnings'] = $user_profile->user_earnings;
		$data['user_coins'] = $user_profile->user_coins;
		
		$fb_id = $this->FaceBookDetails->getfb_id($giver_id);
		if ($fb_id) {
			$fb_id = $fb_id->user_fb_id;
		}
		$data['fb_id'] = $fb_id;
		
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();

		$giver_profile = $this->User->getUserProfile($giver_id);

		$data['items'] = $this->Item->getmyactiveitems($giver_id);

		foreach($data['items'] as $item) {
			$cat = $this->Category->getCatSub($item->item_category_id);
			$item->isMyItem = $this->Item->isMyItem($item->item_id, $user_id);
			$item->category = $cat->category_name;
			$item->sub_category = $cat->sub_category_name;
			$item->category_id = $cat->category_id;
			$item->comm_name = $this->Community->getCommunity($item->community_id)->community_name;
		}

		if($user_profile) {

			$data['giver_id'] = $giver_profile->user_id;
			$data['giver_name'] = $giver_profile->user_name;
			if ($this->Deal->should_show_contact($giver_id, $user_id)) {
				$data['user_phone'] = $giver_profile->user_phone;
				$data['user_email'] = $giver_profile->user_email;
			}
			else {
				$data['user_phone'] = NULL;
				$data['user_email'] = NULL;
			}
			/*$data['user_email'] = $user_profile->user_email;*/
			$data['giver_img_name'] = $giver_profile->user_img_name;
			//$data['user_address'] = $user_profile->user_address;
			$data['giver_img_ext'] = $giver_profile->user_img_ext;
			
			$data['isMobileVerified'] = $this->User->isMobileVerified($user_id);
			/*$data['user_earnings'] = $user_profile->user_earnings;
			$data['user_coins'] = $user_profile->user_coins;*/

			$this->load->view('templates/header', $data);
			$this->load->view('home/giveritems', $data);
			$this->load->view('templates/footer', $data);
		}
	}

	public function community() {
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

		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');
		
		$session_data = $this->session->userdata('logged_in');
		$data['user_email'] = $session_data['user_email'];
		$data['user_phone'] = $session_data['user_phone'];
		$user_id = $this->session->userdata['logged_in']['user_id'];

		$data['myCommunites'] = $this->Community->getCommunity(NULL,$user_id);
		$data['all_communites'] = $this->Community->getCommunity();
		
		$this->load->view('templates/header', $data);
		$this->load->view('home/community', $data);
		$this->load->view('templates/footer', $data);
	}

	
	public function putDemand(){

		if(!$this->is_logged_in()) {
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
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');


		$this->form_validation->set_rules('demand_item','Item name','trim|required');
		$this->form_validation->set_rules('demand_item_desc','Description','trim|required');

		$user_id = $this->getUserId();
		if ($this->form_validation->run() === FALSE)
		{
			redirect('home/main','refresh');

		}
		else
		{
			$isError = $this->Demand->insert($user_id);		
			if($isError == -1){
				$this->session->set_flashdata('error','An error occured.Try again');
			}
			else {
				$this->session->set_flashdata('info','demand submitted.');
			}
			redirect('home/main','refresh');
		}

	}

	public function refer_earn($user_id)
	{
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
		$data['info'] = $this->session->flashdata('info');
		
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();

		$cur_user_id = $this->session->userdata['logged_in']['user_id'];
		$user_profile = $this->User->getUserProfile($user_id);
		if($user_profile AND $user_id == $cur_user_id)
		{
			$data['user_id'] = $user_profile->user_id;
			$data['user_name'] = $user_profile->user_name;
			$data['user_phone'] = $user_profile->user_phone;
			$data['user_email'] = $user_profile->user_email;
			$data['user_email'] = $user_profile->user_email;
			$data['user_img_name'] = $user_profile->user_img_name;
			$data['referral_code'] = $user_profile->referral_code;
			$data['user_img_ext'] = $user_profile->user_img_ext;
			$data['welcome'] = 'Welcome ' . $data['user_name'] ;
			//$data['comm_image'] = NULL ;//site_url($community_list->community_picture);
			$data['error'] = NULL;
			$data['info'] = $this->session->flashdata('info');
		}
		else
		{
			//echo "he";
			show_404();
		}
		$this->load->view('templates/header', $data);
		$this->load->view('home/refer_earn', $data);
		$this->load->view('templates/footer', $data);
	}

	// No need of taking user id here
	public function wallet($user_id)
	{
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

		
		//$data['sharentoozbonus'] = $this->User->getsharentoozbonus($user_id)->sharentoozbonus;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');

		if(!$this->is_logged_in())
		{
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}
		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');

		$cur_user_id = $this->session->userdata['logged_in']['user_id'];
		$user_profile = $this->User->getUserProfile($user_id);
		if($user_profile AND $user_id == $cur_user_id)
		{
			$data['user_id'] = $user_profile->user_id;
			$data['user_earnings'] = $user_profile->user_earnings;
			$data['user_coins'] = $user_profile->user_coins;
			
		} else {
			show_404();
		}
		$this->load->view('templates/header', $data);
		$this->load->view('home/wallet', $data);
		$this->load->view('templates/footer', $data);
	}

	public function bank_details(){
		if(!$this->is_logged_in()) {
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}
		$user_id = $this->getUserId();
		$user_profile = $this->User->getUserProfile($user_id);
		$data['sharentoozbonus']=$user_profile->sharentoozbonus;
		$data['user_earnings'] = $user_profile->user_earnings;
		$data['user_coins'] = $user_profile->user_coins;
		if(!$this->User->isMobileVerified($user_id)) {
			$this->session->set_flashdata('error', 'Please verify mobile number to continue.');
			redirect('home/profile/'.$user_id,'refresh');
		}

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->form_validation->set_rules('account_number','Account Number','trim|required');
		$this->form_validation->set_rules('account_name','Account Name','trim|required');
		$this->form_validation->set_rules('account_type','Account Type','trim|required');
		$this->form_validation->set_rules('branch','Branch','trim');
		$this->form_validation->set_rules('ifsc','IFSC','trim');

		if ($this->form_validation->run() === FALSE) {

		//$this->session->set_flashdata('error', 'this is an error');
		$this->load->view('templates/header', $data);
		$this->load->view('home/wallet/'.$user_id, $data);
		$this->load->view('templates/footer', $data);
		} 
		else {
			// Item posted4
			$amount = $this->input->post('amount');
			$this->User->NewEarnings($user_id,'-'.$amount);
			$this->Bank_Details->insert($user_id);
			$this->session->set_flashdata('error', 'Request Successfully Submitted. You shall get your money in 7 working days.');
			redirect('home/wallet/'.$user_id,'refresh');
		}

}

	public function get_coins()
	{
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
		$user_profile = $this->User->getUserProfile($user_id);
		$data['user_earnings'] = $user_profile->user_earnings;
		$data['user_coins'] = $user_profile->user_coins;

		$user_id = $this->getUserId();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');

		
		$get_coins = $this->input->post('coins');
		
		
		if($get_coins > ($data['user_earnings'] * 10)){
			$this->session->set_flashdata('error', 'Number of coins requested are more than what you can buy using your earnings.');
			redirect('home/wallet/'.$user_id,'refresh');
		}
		if(!is_int($get_coins)){
			$this->session->set_flashdata('error', 'Invalid input.');
			redirect('home/wallet/'.$user_id,'refresh');
		}
		
		$new_earnings = $data['user_earnings'] - $get_coins/10;
		$get_coins = $get_coins + $data['user_coins'];
		$this->User->UpdateCoins($get_coins, $user_id, $new_earnings);
		$user_profile = $this->User->getUserProfile($user_id);
		$data['user_earnings'] = $user_profile->user_earnings;
		$data['user_coins'] = $user_profile->user_coins;
		$this->load->view('templates/header', $data);
		$this->load->view('home/wallet', $data);
		$this->load->view('templates/footer', $data);
		
		if(!$this->is_logged_in())
		{
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}
		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');
		redirect('home/wallet/'.$user_id, 'refresh');
	}

	public function buy_coins()
	{
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
		$user_profile = $this->User->getUserProfile($user_id);
		$data['user_earnings'] = $user_profile->user_earnings;
		$data['user_coins'] = $user_profile->user_coins;
		$user_email = $user_profile->user_email;
		$data['user_email'] = $user_profile->user_email;
		$data['user_phone'] = $user_profile->user_phone;

		$user_id = $this->getUserId();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');

		
		$data['get_coins'] = $this->input->post('coins');

		//string to hash
		$amount = $data['get_coins']/10;
		$data['amount'] = $amount;
		$str = $amount.'|'.$data['user_email'].'|'.$data['user_name'].'|'.$data['user_phone'];

		//hmac-sha1 algorithm
		$key = "15d83296442d4353a641e3eb42dc2ae3";
		$datastring = $str;
		$data['my_sign']=hash_hmac("sha1", $datastring,$key);

	
		$this->load->view('templates/header', $data);
		$this->load->view('home/buy_coins', $data);
		$this->load->view('templates/footer', $data);
		
	}

	public function payment_success()
	{

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
		$user_profile = $this->User->getUserProfile($user_id);
		
		
		$url = parse_url($_SERVER['REQUEST_URI']);
		parse_str($url['query'], $params);
		
		
		$status = $params['status'];
		$data['error']=null;
		$data['amount']=null;
		$data['buyer_name']=null;
		$data['buyer_phone']=null;
		$data['buyer_email']=null;	
		$data['created_at']=null;		  
		if($status == "success"){
			$data['payment_id']=$params['payment_id'];
			$payment_id = $data['payment_id'];
			include 'instamojo.php';
			$api = new Instamojo('6dbb479d11ffa6824bde391a116ca6d9', '7e42310d892ca10ca80ee81c3b51688c');
			$data['error']="payment successful.";
			try {
			    $response = $api->paymentDetail($payment_id);
			    
			    $data['amount']=$response['amount'];
			    $data['buyer_name']=$response['buyer_name'];
			    $data['buyer_phone']=$response['buyer_phone'];
			    $data['buyer_email']=$response['buyer_email'];	
			    $data['created_at']=$response['created_at'];	
			    $this->User->update_coins($user_id, $data['amount']*10);	    
			}
			catch (Exception $e) {
			    print('Error: ' . $e->getMessage());
			}
		}
		else
		{
			$data['error']= "There was an error in payment.";
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('home/payment_success', $data);
		$this->load->view('templates/footer', $data);

	}
	
}
?>
