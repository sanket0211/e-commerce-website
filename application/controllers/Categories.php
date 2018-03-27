<!-- CONTROLLER DO ALL WORKS RELATED TO CATEGORIES -->
<?php
class Categories extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->library('facebook/facebook', array('appId' => '498529700307088', 'secret' => '3d83c55a93fd57e939d3ac23b1164497'));

		$this->load->model('User');
		$this->load->model('Category');
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

	
	public function getDropDown(){
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
		$category_id = $this->input->post('category_id', TRUE);
		$subcategories = $this->Category->getSubCategories($category_id);
		if($subcategories == -1 OR is_null($subcategories)){
			echo NULL;
		}
		$output = NULL;
		foreach ($subcategories as $subcategory) {
			$output .= "<option value=".$subcategory->sub_category_id.">".$subcategory->sub_category_name."</option>";
		}
		echo $output;
	}

}