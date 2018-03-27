<?php
// Controller do all stuffs related to user's activity
class Activitystuff extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('User');
		$this->load->model('Activity');
		$this->load->model('Community');
		$this->load->model('Item');
		$this->load->model('Deal');
		
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
	
	public function activities() {
		if (!$this->is_logged_in()) {
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();

		$user_id = $this->getUserId();
		$user_profile = $this->User->getUserProfile($user_id);
		$data['sharentoozbonus']=$user_profile->sharentoozbonus;
		$data['user_earnings'] = $user_profile->user_earnings;
		$data['user_coins'] = $user_profile->user_coins;

		$activities = $this->Activity->getActivities($user_id);
		// ALL ACTIVITES BY THIS USER
		foreach ($activities as $activity) {
			// adding community nam
			if ($activity->activity_type == TYPE_CREATE_COMMUNITY) {
				$community = $this->Community->get_community($activity->community_id);
				$activity->community_name = $community->community_name;
			}
			// adding item name
			elseif ($activity->activity_type == TYPE_POST_ITEM) {
				$item = $this->Item->getItem(NULL, $activity->item_id);
				$activity->item_name = $item->item_name;
			}
			// adding item name and giver name, this user requested for item
			elseif ($activity->activity_type == TYPE_REQUEST_ITEM) {
				$item = $this->Item->getItem(NULL, $activity->item_id);
				$giver = $this->User->getUserInfo($activity->other_user_id);
				//var_dump($giver);
				
				$activity->item_name = $item->item_name;
				$activity->giver_name = $giver->user_name;
			}
			// adding item name and borrower name
			elseif ($activity->activity_type == TYPE_ACCEPT_ITEM_REQUEST) {
				$item = $this->Item->getItem(NULL, $activity->item_id);
				$borrower = $this->User->getUserInfo($activity->other_user_id);
				
				$activity->item_name = $item->item_name;
				$activity->borrower_name = $borrower->user_name;
			}
			// adding item name and borrower name
			elseif ($activity->activity_type == TYPE_REJECT_ITEM_REQUEST) {
				$item = $this->Item->getItem(NULL, $activity->item_id);
				$borrower = $this->User->getUserInfo($activity->other_user_id);
				
				$activity->item_name = $item->item_name;
				$activity->borrower_name = $borrower->user_name;
			}
			// adding community name, this user requested to join a community
			elseif ($activity->activity_type == TYPE_JOIN_COMMUNITY_REQ) {
				$community = $this->Community->get_community($activity->community_id);
				$activity->community_name = $community->community_name;
			}
			// adding community name & other user name, accepted request of another user
			elseif ($activity->activity_type == TYPE_JOIN_COMMUNITY_REQ_ACCEPTED) {
				// Not fully functional right now
				$community = $this->Community->get_community($activity->community_id);
				$other_user = $this->User->getUserInfo($activity->other_user_id);
				
				$activity->other_user_name = $other_user->user_name;
				$activity->community_name = $community->community_name;
			}

			// adding community name & other user name, rejected request of another user
			elseif ($activity->activity_type == TYPE_JOIN_COMMUNITY_REQ_REJECTED) {
				// Not fully functional right now
				$community = $this->Community->get_community($activity->community_id);
				$other_user = $this->User->getUserInfo($activity->other_user_id);
				
				$activity->other_user_name = $other_user->user_name;
				$activity->community_name = $community->community_name;
			}

			// adding user name, community name
			elseif ($activity->activity_type == TYPE_INVITATION_SENT) {
				$community = $this->Community->get_community($activity->community_id);
				$other_user = $this->User->getUserInfo($activity->other_user_id);
				
				$activity->other_user_name = $other_user->user_name;
				$activity->community_name = $community->community_name;
			}

			// add community name, invitation accepted by this user
			elseif ($activity->activity_type == TYPE_INVITATION_ACCEPTED) {
				$community = $this->Community->get_community($activity->community_id);
				$other_user = $this->User->getUserInfo($activity->other_user_id);
				
				$activity->other_user_name = $other_user->user_name;
				$activity->community_name = $community->community_name;
			}

			// add community name, invitation rejected by this user
			elseif ($activity->activity_type == TYPE_INVITATION_REJECTED) {
				$community = $this->Community->get_community($activity->community_id);
				$other_user = $this->User->getUserInfo($activity->other_user_id);
				
				$activity->other_user_name = $other_user->user_name;
				$activity->community_name = $community->community_name;
			}

			// add item name, review added by this user
			elseif ($activity->activity_type == TYPE_ITEM_REVIEW_SUBMITTED) {
				$item = $this->Item->getItem(NULL, $activity->item_id);
				$activity->item_name = $item->item_name;
			}

			// add item name, review added by this user
			elseif ($activity->activity_type == TYPE_USER_REVIEW_SUBMITTED) {
				$other_user = $this->User->getUserInfo($activity->other_user_id);
				$activity->other_user_name = $other_user->user_name;
			}

			// add item name and borrower name, deal canceled by this user
			elseif ($activity->activity_type == TYPE_DEAL_CANCELED) {
				$deal = $this->Deal->getDeal($activity->deal_id);
				$borrower = $this->User->getUserInfo($activity->other_user_id);
				
				$activity->item_name = $item->item_name;
				$activity->borrower_name = $borrower->user_name;
			}
		}
		$data['activities'] = $activities;
		
		$this->load->view('templates/header', $data);
		$this->load->view('home/activity', $data);
		$this->load->view('templates/footer');
	}
}
?>