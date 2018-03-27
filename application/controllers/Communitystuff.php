<?php
class Communitystuff extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		

		$this->load->model('Unverified_User');
		$this->load->model('User');
		$this->load->model('Community');
		$this->load->model('FaceBookDetails');
		$this->load->model('Member');
		$this->load->model('Item');
		$this->load->model('Deal');
		$this->load->model('City');
		$this->load->model('Demand');
		$this->load->model('Category');
		$this->load->model('Activity');
		$this->load->helper('url');
		$this->load->helper(array('form', 'url'));

		$this->load->library('email');
	}
	// TODO: these three functions are common in all controller, put them in seperate file
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
	

	public function view($comm_id)
	{
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
		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();
		$user_id = $this->getUserId();
		$user_profile = $this->User->getUserProfile($user_id);
		$data['sharentoozbonus']=$user_profile->sharentoozbonus;
		$data['user_earnings'] = $user_profile->user_earnings;
		$data['user_coins'] = $user_profile->user_coins;
		$fb_id = $this->FaceBookDetails->getfb_id($user_id);
		if ($fb_id)
			$fb_id = $fb_id->user_fb_id;
		$data['fb_id']=$fb_id;

		//community demand
		$data['demands'] = $this->Demand->getTopDemands($comm_id);
		if($data['demands'] AND $data['demands'] != -1) {
			foreach($data['demands'] as $demand)
			{
				$demand->isUpvoted = $this->Demand->isUpvoted($user_id, $demand->demand_id);
			}
		}
		$data['alldemands'] = $this->Demand->getAllDemands($comm_id);
		if($data['alldemands'] AND $data['alldemands'] != -1) {
			foreach($data['alldemands'] as $demand)
			{
				$demand->isUpvoted = $this->Demand->isUpvoted($user_id, $demand->demand_id);
			}
		}

		$data['categories'] = $this->Category->getCategories();
		$data['sub_categories'] = $this->Category->getSubCategories();

		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');
		

		$community_list = $this->Community->getCommunity($comm_id);

		$data['members_list'] = $this->Member->getMembers($comm_id);
		
		foreach ($data['members_list'] as $user) {
		
			$user->fb_id = $this->FaceBookDetails->getfb_id($user->user_id);
			
			if ($user->fb_id)
				$fb_id = $user->fb_id->user_fb_id;
		}
		
	
		
		// List of not invited members for some community
		$data['Users'] = array();
		$data['other_users'] = $this->User->getNotInvitedMembers($user_id);
		
		foreach ($data['other_users'] as $other_user) {
			
			$other_user->fb_id = $this->FaceBookDetails->getfb_id($other_user->user_id);
			if ($other_user->fb_id)
				$other_user->fb_id = $other_user->fb_id->user_fb_id;
			
			if($this->Member->isAlreadyEntered($other_user->user_id, $comm_id) == -1) {
				$data['Users'][] = $other_user; 
			}
		}
		
		//var_dump($data['Users']);
		if(is_int($data['Users']) AND $data['Users'] == -1){
			$this->session->set_flashdata('error', 'An error occured');
		}
		// this is only one community. BAD CODE, REWRITE IT
		if($community_list)
		{
			$data['comm_id'] = $community_list->community_id;
			$data['comm_name'] = $community_list->community_name;
			$data['comm_desc'] = $community_list->community_desc;
			$data['comm_code'] = $community_list->community_code;
			$data['comm_no_mem'] = $community_list->no_of_members;
			$data['comm_image'] = $community_list->community_img_name;
			$data['comm_image_ext'] = $community_list->community_img_ext;
			$data['error'] = $this->session->flashdata('error');
			$data['info'] = $this->session->flashdata('info');
			$data['isMember'] = $this->Member->isAlreadyEntered($user_id,$data['comm_id']);
			$data['items'] = NULL;
			if($this->is_logged_in()) {
				$user_id = $this->session->userdata['logged_in']['user_id'];
				if($this->Member->isAlreadyEntered($user_id, $comm_id) != -1 ) {
					$data['items'] = $this->Item->getItem($comm_id);
					if($data['items']){
						foreach($data['items'] as $item)
						{
							//var_dump($item);
							$cat = $this->Category->getCatSub($item->item_category_id);
							$item->isMyItem = $this->Item->isMyItem($item->item_id, $user_id);
							$item->category = $cat->category_name;
							$item->sub_category = $cat->sub_category_name;
							$item->category_id = $cat->category_id;
							//echo '<br>-------------------------<br>';
							//var_dump($item);
						}
					}
				}
			}
			$this->load->view('templates/header', $data);
			$this->load->view('home/view', $data);
			$this->load->view('templates/footer', $data);
		}
		else { show_404();}	
	}

	public function getCommunity(){
		$code = $this->input->post('code');
		$flag = $this->Community->get_community_id($code);
		if($flag==NULL){
			$this->session->set_flashdata('error', 'No such Community.');
			redirect('home/main','refresh');
		}
		else{
			redirect('home/community/'.$flag->community_id,'refresh');
		}
	}

	public function create_comm()
	{
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
		$data['cities'] = $this->City->getCity();

		$flag=0;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');

		if(!$this->is_logged_in())
		{
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}

		$this->form_validation->set_rules('comm_name','Community name','required');
		$this->form_validation->set_rules('comm_desc','Community description','required');
		
		if($this->input->post('upload'))
		{
			$config['upload_path'] = './uploads/communities';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']    = '15000000';
			$config['max_width']  = '1980';
			$config['max_height']  = '1080';
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload())
			{
				$str = $this->upload->display_errors();
				
				if(strcmp($str,"You did not select a file to upload.")==-1){
					$community_img_name = "default";
					$community_img_ext = ".jpeg";
					$community_thumb_name = "default_thumb";
				}
				else{
					$this->session->set_flashdata('error',$this->upload->display_errors());
					redirect('home/create_comm','refresh');
					$flag=1;
				}
			}
			else
			{
				$pic=$this->upload->data();
				//$this->thumb($pic);
				$community_img_name = $pic['raw_name'];
				$community_img_ext = $pic['file_ext'];
				$community_thumb_name = $pic['raw_name'].'_thumb';

			}
		}
		if($flag == 0) {
			//echo $this->session->userdata['logged_in']['user_id'];
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('home/create_comm', $data);
				$this->load->view('templates/footer', $data);
			}
			else {	
				$admin_id = $this->getUserId();
				$community_id = $this->Community->insert($admin_id, $community_img_name,
					$community_img_ext, $community_thumb_name);
				if($community_id > 0) {
					$isInserted = $this->Member->insert($admin_id, $community_id, USER_TYPE_ADMIN);
					if ($isInserted == EXIT_SUCCESS) {
						$this->Activity->insert($admin_id, $community_id, NULL, NULL, NULL, TYPE_CREATE_COMMUNITY);
						$this->session->set_flashdata('info', 'Community created successfully!');
						redirect('home/community/'.$community_id, 'refresh');
					} else {
						$this->Community->delete($community_id);
						$this->session->set_flashdata('error', 'An error occured. Please try later.');
					}
				} else {
					// TODO: make private method for error and info showing
					$this->session->set_flashdata('error', 'An error occured. Please try later.');
				}
				redirect('home/main', 'refresh');
			}
		}
	}
}
