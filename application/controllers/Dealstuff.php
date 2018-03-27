<?php
class Dealstuff extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User');
		$this->load->model('Deal');
		$this->load->model('Activity');
		$this->load->model('Item');
		
		$this->load->helper('form');
	}

	private function is_logged_in() {
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

	public function transfer_coin(){
		$ongoingDeals = $this->Deal->getOngoingDeals();
		if (is_null($ongoingDeals)){
			echo "No ongoing deals today";
			return;
		} else if ($ongoingDeals == -1) {
			echo "Database error";
			return;
		}
		foreach ($ongoingDeals as $deal) {
			$this->Deal->transferCoins($deal->g_id, $deal->b_id, $deal->item_id);
			$this->Deal->reduceDealDay($deal->deal_id);
		}
	}

	public function start_deals() {
		$todays_deals = $this->Deal->get_todays_starting_deals();
		if (count($todays_deals) == 0) {
			echo "No deals are starting today";
			return;
		}
		foreach ($todays_deals as $deal) {
			$this->start_renting_period($deal->deal_id);
		}
	}

	public function stop_deals() {
		$todays_deals = $this->Deal->get_todays_ending_deals();
		if (count($todays_deals) == 0) {
			echo "No deals are ending today";
			return;
		}
		foreach ($todays_deals as $deal) {
			$this->stop_renting_period($deal->deal_id);
		}
	}

	// All deals: ongoing and finished
	public function deals() {
		if(!$this->is_logged_in()) {
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}
		$user_id = $this->getUserId();
		if(!$this->User->isMobileVerified($user_id)){
			$this->session->set_flashdata('error', 'Please verify mobile number to continue.');
			redirect('home/profile/'.$user_id,'refresh');
		}

		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $user_id;
		
		$user_profile = $this->User->getUserProfile($user_id);
		$data['user_earnings'] = $user_profile->user_earnings;
		$data['user_coins'] = $user_profile->user_coins;
		$data['sharentoozbonus']=$user_profile->sharentoozbonus;

		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');

		// giver list
		$giver_list = $this->Deal->getMyDeals($user_id, GIVER);
		if (is_int($giver_list) AND $giver_list == NULL) {
			$data['giver_list'] = NULL;
		} else
			$data['giver_list'] = $giver_list;

		// borrower list
		$borrower_list = $this->Deal->getMyDeals($user_id, BORROWER);
		if (is_int($borrower_list) AND $borrower_list == NULL) {
			$data['borrower_list'] = NULL;
		} else
			$data['borrower_list'] = $borrower_list;
		
		/*var_dump($data['giver_list']);
		var_dump($data['borrower_list']);
		die();*/
		$this->load->view('templates/header', $data);
		$this->load->view('home/deals', $data);
		$this->load->view('templates/footer', $data);
	}

	public function approve_item_req($deal_id) {
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
		else {
			$user_id = $this->getUserId();
			$isValid = $this->Deal->getDeal($deal_id);
			if(is_null($isValid)){ show_404();}
			else if(is_numeric($isValid) && $isValid == EXIT_DATABASE ) {
				$this->session->set_flashdata('error', 'An error occured');
				redirect('home/main','refresh');
			}
			else if($user_id == $isValid->g_id) {
				$item_price = $isValid->item_rent * $isValid->no_of_days;
				$this->User->UpdateOffset($isValid->b_id, $item_price);
				$isError = $this->Deal->updateDeal($deal_id, DEAL_STATUS_ACCEPTED);
				if($isError == EXIT_DATABASE) {
					$this->session->set_flashdata('error', 'An error occured');
				}
				$this->Activity->insert($user_id, NULL, $isValid->item_id, $deal_id, $isValid->b_id,
					TYPE_ACCEPT_ITEM_REQUEST);
				//$this->start_renting_period($deal_id);
				$this->Item->deactivateitem($isValid->item_id, $user_id);
			}
			redirect('home/index','refresh');
		}
	}

	private function start_renting_period($deal_id)
	{
		$isValid = $this->Deal->getDeal($deal_id);
		if(is_null($isValid)){ return EXIT_DATABASE; }
		else if(is_int($isValid) AND $isValid == -1 ) {
			return EXIT_ERROR;
		} else {
			$isError = $this->Deal->startDeal($deal_id);
			return EXIT_SUCCESS;
		}
	}

	private function stop_renting_period($deal_id) {
		$isValid = $this->Deal->getDeal($deal_id);
		if(is_null($isValid)){ return EXIT_DATABASE; }
		else if(is_int($isValid) AND $isValid == -1 ) {
			return EXIT_ERROR;
		} else {
			$isError = $this->Deal->stopDeal($deal_id);
			return EXIT_SUCCESS;
		}
	}

	public function cancel_item_req($deal_id) {
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
		else {
			$isValid = $this->Deal->getDeal($deal_id);
			if(is_null($isValid)){ show_404();}
			else if($isValid == EXIT_DATABASE ) { 
				$this->session->set_flashdata('error', 'An error occured');
				redirect('home/index','refresh');
			}   
			else if($user_id == $isValid->g_id) {
				$isError = $this->Deal->updateDeal($deal_id, DEAL_STATUS_CANCELLED); 
				if($isError == -1) {
					$this->session->set_flashdata('error', 'An error occured');
				} else {
					$this->Activity->insert($user_id, NULL, $isValid->item_id, $deal_id, $isValid->b_id,
					TYPE_REJECT_ITEM_REQUEST);
				}

			}   
			redirect('home/index','refresh');
		}   

	}
	
	// this function will used for ajax calling when user press OK button
	public function item_request_comp_success($deal_id)
	{
		//$data['isLoggedin'] = $this->is_logged_in();
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
		else {
			$deal = $this->Deal->getDeal($deal_id);
			$user_id = $this->getUserId();
			if(is_null($deal)) {
				 //show_404();
				// do nothing
			} else if(is_int($deal) AND $deal == -1 ) {
				// db error
			} else if($user_id == $deal->g_id) {
				if ($deal->status == DEAL_STATUS_RENTING_END) {
					$this->Deal->updateDeal($deal_id, DEAL_STATUS_G_SEEN);
				} else if ($deal->status == DEAL_STATUS_B_SEEN) {
					$this->Deal->updateDeal($deal_id, DEAL_STATUS_BOTH_SEEN);
				}
			} else if ($user_id == $deal->b_id) {
				if ($deal->status == DEAL_STATUS_RENTING_END) {
					$this->Deal->updateDeal($deal_id, DEAL_STATUS_B_SEEN);
				} else if ($deal->status == DEAL_STATUS_G_SEEN) {
					$this->Deal->updateDeal($deal_id, DEAL_STATUS_BOTH_SEEN);
				}
			} 
		}
	}

	public function item_request_can_fail($deal_id)
	{
		//$data['isLoggedin'] = $this->is_logged_in();
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
		else {
			$deal = $this->Deal->getDeal($deal_id);
			$user_id = $this->getUserId();
			if(is_null($deal)){
				 //show_404();
				// do nothing
			}
			else if(is_int($deal) AND $deal == -1 ) {
				// db error
			}
			else if($user_id == $deal->b_id) {
				$isError = $this->Deal->updateDeal($deal_id, DEAL_STATUS_UNSUCCESS_SEEN);
				if($isError == -1) {
					// db error while updating
				}
			}
		}
	}
	
	// AJAX: called when user pressed 'Review Now' or 'Review Later' button 
	public function submit_review($deal_id, $review_status, $who) {
		if ($review_status == REVIEW_LATER AND $who == GIVER) {
			$this->Deal->updateDeal($deal_id, NULL, $review_status, GIVER);
		} else if ($review_status == REVIEW_LATER AND $who == BORROWER) {
			$this->Deal->updateDeal($deal_id, NULL, $review_status, BORROWER);
		}
	}
}
?>
