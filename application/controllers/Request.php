<?php
/*  CONTROLLER RESPONSIBLE FOR ALL REQUEST RELATED THINGS
 	Requests controlled in this file are : 
	1. Item demand request
	2. Item demand upvote/downvote request
	3. Invitations requests
	*/
class Request extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Notify');
		$this->load->model('Demand');
		$this->load->model('User');
		$this->load->model('Member');
		$this->load->model('Community');
		$this->load->model('Activity');
		
		$this->load->library('email');

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
	
	// Join a community request
	public function join_community($comm_id) {
		if(!$this->is_logged_in()) {
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}
		$user_id = $this->getUserId();
		if(!$this->User->isMobileVerified($user_id)) {
			$this->session->set_flashdata('error', 'Please verify mobile number to continue.');
			redirect('home/profile/'.$user_id,'refresh');
		} else {
			$isValid = $this->Member->isAlreadyEntered($user_id, $comm_id);
			if($isValid == -1) {
				// request for join a community
				$isInserted = $this->Notify->insert(NULL, $user_id, $comm_id, 0);
				if($isInserted == -1) {
					$this->session->set_flashdata('info', 'your request is pending.');	
				} else if($isInserted == 1) {
					$this->session->set_flashdata('info', 'an unknown error occured');
				} else {
					$this->Activity->insert($user_id, $comm_id, NULL, NULL, NULL, TYPE_JOIN_COMMUNITY_REQ);
					$this->session->set_flashdata('info', 'your request has been submitted');
				}
			} else if($isValid == 0) {
				$this->session->set_flashdata('info', 'you are already member of the community');
			} else if($isValid == 1) {
				$this->session->set_flashdata('info','you are admin of this community');
			}
			redirect('home/community/'.$comm_id,'refresh');
		}
	}

	

	// joining request approved
	public function approve($notification_id)
	{
		if($this->is_logged_in()) {
			$notification = $this->Notify->getNotification($notification_id);
			if (!is_int($notification)) {
				$cur_user_id = $this->getUserId();
				if ($this->Member->isMember($cur_user_id, $notification->community_id) == EXIT_SUCCESS) {
					$success = $this->Notify->update_notification($notification_id, NOTIFICATION_ACCEPTED);
					if ($success == EXIT_SUCCESS) {
						$isInserted = $this->Member->insert($notification->user_id,
							$notification->community_id, USER_TYPE_MEMBER);
						if ($isInserted == EXIT_SUCCESS) {
							//$this->session->set_flashdata('info', 'Approved');
							//$this->Activity->insert($user_id, $comm_id, NULL, NULL, $cur_user_id, TYPE_JOIN_COMMUNITY_REQ_ACCEPTED);
						} else {
							//$this->session->set_flashdata('info', 'An error occured.Please try later');
						}
					}
					
				}
				
			}
		}
	}

	// joining request rejected
	public function reject($notification_id)
	{
		if($this->is_logged_in()) {
			$notification = $this->Notify->getNotification($notification_id);
			if (!is_int($notification)) {
				$cur_user_id = $this->getUserId();
				if ($this->Member->isMember($cur_user_id, $notification->community_id) == EXIT_SUCCESS) {
					$success = $this->Notify->update_notification($notification_id, NOTIFICATION_REJECTED);
					//$this->session->set_flashdata('info', 'Declined');	
				}
				
			}
		}
	}

	public function joining_request_seen($is_accepted, $notification_id) {
		$user_id = $this->getUserId();
		if(!$this->is_logged_in()) {
			show_404();
		} else if($is_accepted == 1) {
			$notification = $this->Notify->getNotification($notification_id);
			if (!is_int($notification)) {
				if ($notification->user_id == $user_id AND $notification->status = NOTIFICATION_ACCEPTED) {
					$success = $this->Notify->update_notification($notification_id, NOTIFICATION_ACCEPTED_AND_SEEN);
					//$this->session->set_flashdata('info', 'Accepted');
				}
			}
			
		} else if($is_accepted == 0) {
			$notification = $this->Notify->getNotification($notification_id);
			if (!is_int($notification)) {
				if ($notification->user_id == $user_id AND $notification->status = NOTIFICATION_REJECTED) {
					$success = $this->Notify->update_notification($notification_id, NOTIFICATION_REJECTED_AND_SEEN);
					//$this->session->set_flashdata('info', 'Rejected');	
				}
			}
			
		}
	}

	// Send invitation to join a community 
	public function sendInvitation($user_id, $community_id){
		if (!$this->is_logged_in()){ show_404();}
		$admin_id = $this->getUserId();
		$isInserted = $this->Notify->insert($admin_id, $user_id, $community_id, 1);
		if($isInserted == EXIT_DATABASE){
			return EXIT_DATABASE;
		} else {
			$this->Activity->insert($admin_id, $community_id, NULL, NULL, $user_id, TYPE_INVITATION_SENT);
		}
		//echo $isError;
		//$this->send_invitation_email($user_id, $community_id);
	}

	private function send_invitation_email($user_id, $community_id){
		$user_details = $this->User->getUserProfile($user_id);
		$invitee_details = $this->User->getUserProfile($this->getUserId());
		$community = $this->Community->get_community($community_id);
		//return;
		if(!is_null($user_details) AND !is_null($invitee_details) AND !is_null($community)) {		
			$this->email->from('invite@rentooz.com','Rentooz');
			$this->email->to($user_details->user_email);
			$this->email->subject('Verify your email address');
			$email_msg = "Dear ". $user_details->user_name .", " . $invitee_details->user_name. " have invited you to join " . $community->community_name. ".";
			$email_msg .= "Please click below to process invitation.";  
			$email_msg .= "http://www.rentooz.com/index.php/home/main";
			$email_msg .= "Thanks";  
			$this->email->message($email_msg);
			$this->email->send();
		}
	}

	// Accept invitation
	public function invitation_accept($community_id, $invitee_id){
		if($this->is_logged_in()) {
			$user_id = $this->getUserId();
			$isInserted = $this->Member->insert($user_id, $community_id, USER_TYPE_MEMBER);
			if ($isInserted == EXIT_SUCCESS) {
				$this->Notify->update($user_id, $community_id, NOTIFICATION_ACCEPTED, NOTIFICATION_TYPE_INVITE, $invitee_id);// status, notification_type
				$this->Activity->insert($user_id, $community_id, NULL, NULL, $invitee_id, TYPE_INVITATION_ACCEPTED);
			} else {
				// TODO: Show error via ajax
				//$this->session->set_flashdata('error','An error occured.Try again');
			}
		}
	}

	// Decline invitation
	public function invitation_decline($community_id, $invitee_id){
		if($this->is_logged_in()){
			$user_id = $this->getUserId();
			$this->Notify->update($user_id, $community_id, NOTIFICATION_REJECTED, NOTIFICATION_TYPE_INVITE, $invitee_id); // status , notification_type
			$this->Activity->insert($user_id, $community_id, NULL, NULL, $invitee_id, TYPE_INVITATION_REJECTED);
		}
	}

	// inviter pressed ok button
	public function invitation_seen($notification_id){
		if(!$this->is_logged_in()){ show_404();}
		$is_updated = NULL;
		$inviter_id = $this->getUserId();
		$notification = $this->Notify->getNotification($notification_id);
		if(is_null($notification)) { return; } // error
		if($notification->status == NOTIFICATION_ACCEPTED){
			// notification accepted and seen
			$is_updated = $this->Notify->update_notification($notification_id, NOTIFICATION_ACCEPTED_AND_SEEN);
		} else if ($notification->status == NOTIFICATION_REJECTED) {
			// notification rejected and seen
			$is_updated = $this->Notify->update_notification($notification_id, NOTIFICATION_REJECTED_AND_SEEN);
		}
		var_dump($is_updated);
	}
	
	// upvote the demand
	public function upvote_demand($demand_id){
		if(!$this->is_logged_in()){ show_404();}
		$user_id = $this->getUserId();
		$isError = $this->Demand->upvote($user_id, $demand_id);		
		if($isError == -1){
			$this->session->set_flashdata('error','An error occured.Try again');
		}
		redirect('home/main','refresh');
	}

	// downvote the demand
	public function downvote_demand($demand_id){
		if(!$this->is_logged_in()){ show_404();}
		$user_id = $this->getUserId();
		$isError = $this->Demand->downvote($user_id, $demand_id);		
		if($isError == -1){
			$this->session->set_flashdata('error','An error occured.Try again');
		}
		redirect('home/main','refresh');
	}

}
