<?php
class Nonessentials extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// TODO: Remove unncessary models
		$this->load->model('Unverified_User');
		$this->load->model('User');
		$this->load->model('Community');
		$this->load->model('Member');
		$this->load->model('Item');
		$this->load->model('Deal');
		$this->load->model('City');
		$this->load->model('Demand');
		$this->load->model('Category');
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

	public function subscriber(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','required');
		$data['error'] = $this->session->flashdata('error');
		$data['error'] = NULL;

		$this->form_validation->set_rules('user_email','Email','required');

		if ($this->form_validation->run() === FALSE) {   
			$this->load->view('home/comingsoon', $data);
		}
		$data = array(
			'subscriber_email' => $this->input->post('subscriber_email')
		);
		// Use model
		$result = $this->db->insert('Subscription', $data);
		var_dump($this->db->error());
		die();
		$this->session->set_flashdata('error', 'Thank you for subscribing');
		redirect('home/comingsoon','refresh');
	}

	public function bonusandoffers(){
		
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

		$data['sharentoozbonus'] = $this->User->getsharentoozbonus($user_id);
		$data['sharentoozbonus'] = $data['sharentoozbonus']->sharentoozbonus;

		$this->load->view('templates/header', $data);
		$this->load->view('home/sharentoozbonus', $data);
		$this->load->view('templates/footer', $data);
	}


	public function about_us() {
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
		$user_id = $this->getUserId();
		if($this->is_logged_in())
		{
			$user_id = $this->getUserId();
			$user_profile = $this->User->getUserProfile($user_id);
			$data['sharentoozbonus']=$user_profile->sharentoozbonus;
			$data['user_earnings'] = $user_profile->user_earnings;
			$data['user_coins'] = $user_profile->user_coins;
		}
		

		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');
		$this->load->view('templates/header', $data);
		$this->load->view('home/about-us', $data);
		$this->load->view('templates/footer', $data);
	}

	public function termsandconditions() {
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
		$user_id = $this->getUserId();
		if($this->is_logged_in())
		{
			$user_id = $this->getUserId();
			$user_profile = $this->User->getUserProfile($user_id);
			$data['sharentoozbonus']=$user_profile->sharentoozbonus;
			$data['user_earnings'] = $user_profile->user_earnings;
			$data['user_coins'] = $user_profile->user_coins;
		}

		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');
		$this->load->view('templates/header', $data);
		$this->load->view('home/termsandconditions', $data);
		$this->load->view('templates/footer', $data);
	}

	public function privacypolicy() {
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
		$user_id = $this->getUserId();
		if($this->is_logged_in())
		{
			$user_id = $this->getUserId();
			$user_profile = $this->User->getUserProfile($user_id);
			$data['sharentoozbonus']=$user_profile->sharentoozbonus;
			$data['user_earnings'] = $user_profile->user_earnings;
			$data['user_coins'] = $user_profile->user_coins;
		}

		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');
		$this->load->view('templates/header', $data);
		$this->load->view('home/privacypolicy', $data);
		$this->load->view('templates/footer', $data);
	}

	public function contact_us() {
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
		$user_id = $this->getUserId();
		if($this->is_logged_in())
		{
			$user_id = $this->getUserId();
			$user_profile = $this->User->getUserProfile($user_id);
			$data['sharentoozbonus']=$user_profile->sharentoozbonus;
			$data['user_earnings'] = $user_profile->user_earnings;
			$data['user_coins'] = $user_profile->user_coins;
		}

		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');

		$this->load->view('templates/header', $data);
		$this->load->view('home/contact-us', $data);
		$this->load->view('templates/footer', $data);
	}

	public function faq() {
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
		$user_id = $this->getUserId();
		if($this->is_logged_in())
		{
			$user_id = $this->getUserId();
			$user_profile = $this->User->getUserProfile($user_id);
			$data['sharentoozbonus']=$user_profile->sharentoozbonus;
			$data['user_earnings'] = $user_profile->user_earnings;
			$data['user_coins'] = $user_profile->user_coins;
		}
		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');
		

		$this->load->view('templates/header', $data);
		$this->load->view('home/faq', $data);
		$this->load->view('templates/footer', $data);
	}


	public function howitworks() {
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
		$user_id = $this->getUserId();
		if($this->is_logged_in())
		{
			$user_id = $this->getUserId();
			$user_profile = $this->User->getUserProfile($user_id);
			$data['sharentoozbonus']=$user_profile->sharentoozbonus;
			$data['user_earnings'] = $user_profile->user_earnings;
			$data['user_coins'] = $user_profile->user_coins;
		}

		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');

		$this->load->view('templates/header', $data);
		$this->load->view('home/howitworks', $data);
		$this->load->view('templates/footer', $data);
	}

	public function queries(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');

		$fullname = $this->input->post('full_name');
		$email = $this->input->post('email');
		$message = $this->input->post('message');
		
		/*print_r($fullname);
		print_r($email);
		print_r($message);
		die();*/

		$this->email->from($email,'Rentooz');
		$this->email->to('support@rentooz.com');

		$this->email->subject('query');
		$email_msg = $message;  
		$this->email->message($email_msg);

		$this->email->send();
		
		$this->email->print_debugger();
		redirect('home/index', 'refresh');
	}
	
	// Bad function name, loading already loaded helpers
	public function contactusform(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');

		$fullname = $this->input->post('name');
		$email = $this->input->post('email');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');

		$this->email->from($email,'Rentooz');
		$this->email->to('support@rentooz.com');

		$this->email->subject($subject);
		$email_msg = $message;  
		$this->email->message($email_msg);

		$this->email->send();
		
		$this->email->print_debugger();
		redirect('home/contact-us', 'refresh');
	}

}
?>