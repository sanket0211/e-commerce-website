<?php
class ReviewStuff extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	
		$this->load->model('User');
		$this->load->model('Review');

		
		$this->load->helper('form');

		$this->load->library('form_validation');
	}
	
	private function is_logged_in()
	{
		return null !== $this->session->userdata('logged_in');
	}
	
	private function getUserId() {
		if($this->is_logged_in()) {
			$session_data = $this->session->userdata('logged_in');
			return $session_data['user_id'];
		}
		return NULL;
	}

	private function getUserName() {
		if($this->is_logged_in()) {
			$session_data = $this->session->userdata('logged_in');
			return $session_data['user_name'];
		}
		return NULL;
	}
	
	public function review_user($deal_id) {
		if (!$this->is_logged_in()) {
			$this->session->set_flashdata('info', 'Please login to continue.');
			redirect('home/login');
		}
		$deal = $this->Deal->getDeal($deal_id);
		$item_id = $deal->item_id;
		$data['item'] = $this->Item->getItemInfo($item_id);
		$data['deal_id'] = $deal->deal_id;
		
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();

		$user_id = $this->getUserId();
		
		if ($deal->g_id != $user_id) {
			if ($deal->b_id == $user_id)
				redirect('review_user_item/'.$deal_id);
			else
				show_404();
		}
		$user_profile = $this->User->getUserProfile($user_id);
		$data['sharentoozbonus']=$user_profile->sharentoozbonus;
		$data['user_earnings'] = $user_profile->user_earnings;
		$data['user_coins'] = $user_profile->user_coins;


		$data['borrower'] = $this->User->getUserInfo($deal->b_id);

		$this->load->view('templates/header', $data);
		$this->load->view('home/review_user', $data);
		$this->load->view('templates/footer', $data);
	}

	public function submit_user_review() {
		$deal_id = $this->input->post('deal_id');
		$borrower_behaviour = $this->input->post('borrower-behaviour');
		$item_condition = $this->input->post('item-condition');
		$borrower_timing = $this->input->post('borrower-timing');
		
		$comment = $this->input->post('comment');

		// TODO: remove other field other than 'username'
		$this->form_validation->set_rules('borrower-behaviour','username', 'is_natural_no_zero');
		$this->form_validation->set_rules('item-condition','username', 'is_natural_no_zero');
		$this->form_validation->set_rules('borrower-timing','username', 'is_natural_no_zero');
		$this->form_validation->set_rules('deal-id','username', 'is_natural_no_zero');

		if ($this->form_validation->run() === FALSE) {   
			$this->session->set_flashdata('error', 'Invalid form submitted.');
			redirect('review_user/'.$deal_id, 'refresh');
		}

		$stars = ($borrower_behaviour + $item_condition + $borrower_timing )/3;
		$deal = $this->Deal->getDeal($deal_id);
		$this->Review->add_user_review($deal->deal_id, $deal->g_id, $deal->b_id, $stars, $comment);

		$this->session->set_flashdata('info', 'Review submitted successfully');
		redirect('home/deals');
	}

	public function review_user_item($deal_id) {
		if (!$this->is_logged_in()) {
			$this->session->set_flashdata('info', 'Please login to continue.');
			redirect('home/login');
		}
		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');

		$deal = $this->Deal->getDeal($deal_id);
		$item_id = $deal->item_id;
		$data['item'] = $this->Item->getItemInfo($item_id);
		$data['deal_id'] = $deal->deal_id;
		
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();

		$user_id = $this->getUserId();

		if ($deal->b_id != $user_id) {
			if ($deal->g_id == $user_id)
				redirect('review_user/'.$deal_id);
			else
				show_404();
		}

		$user_profile = $this->User->getUserProfile($user_id);
		$data['sharentoozbonus']=$user_profile->sharentoozbonus;
		$data['user_earnings'] = $user_profile->user_earnings;
		$data['user_coins'] = $user_profile->user_coins;

		$data['giver'] = $this->User->getUserInfo($deal->g_id);

		$this->load->view('templates/header', $data);
		$this->load->view('home/review_user_item', $data);
		$this->load->view('templates/footer', $data);
	}

	public function submit_user_item_review() {
		$deal_id = $this->input->post('deal_id');
		$giver_behaviour = $this->input->post('giver-behaviour');
		$item_condition = $this->input->post('item-condition');
		$giver_timing = $this->input->post('giver-timing');
		$comment = $this->input->post('comment');

		$item_usefulness = $this->input->post('item-usefulness');
		$item_rent_appropriate = $this->input->post('item-rent-appropriate');
		$item_review_comment = $this->input->post('item-review-comment');
		
		
		$comment = $this->input->post('comment');

		// TODO: remove other field other than 'username'
		$this->form_validation->set_rules('giver-behaviour','username', 'is_natural_no_zero');
		$this->form_validation->set_rules('item-condition','username', 'is_natural_no_zero');
		$this->form_validation->set_rules('giver-timing','username', 'is_natural_no_zero');
		$this->form_validation->set_rules('deal-id','username', 'is_natural_no_zero');

		if ($this->form_validation->run() === FALSE) {   
			$this->session->set_flashdata('error', 'Invalid form submitted.');
			redirect('review_user_item/'.$deal_id, 'refresh');
		}

		$stars = ($giver_behaviour + $item_condition + $giver_timing )/3;
		$deal = $this->Deal->getDeal($deal_id);
		$this->Review->add_user_review($deal->deal_id, $deal->b_id, $deal->g_id, $stars, $comment);

		$item_stars = ($item_usefulness + $item_rent_appropriate)/2;
		$this->Review->add_item_review($deal->deal_id, $deal->item_id, $deal->b_id, $item_stars,
			$item_review_comment);

		$this->session->set_flashdata('info', 'Review submitted successfully');
		redirect('home/deals');
	}
}
?>
