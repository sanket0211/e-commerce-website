<?php
//CONTROLLER RESPONSIBLE FOR ALL ITEM RELATED STUFF
class Itemstuff extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Deal');
		$this->load->model('User');
		$this->load->model('Category');
		$this->load->model('Member');
		$this->load->model('Activity');
		$this->load->model('Category');
		$this->load->model('City');
		$this->load->model('Review');

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
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
	
	public function item($item_id) {
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
		$user_id = $this->getUserId();

		$data['isLoggedin'] = $this->is_logged_in();
		$data['user_name'] = $this->getUserName();
		$data['user_id'] = $this->getUserId();

		$data['giver_name']=$this->Item->getGiver($item_id)->user_name;
		$data['giver_id']=$this->Item->getGiver($item_id)->user_id;
		
		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');

		$item = $this->Item->getItem(NULL, $item_id, NULL);
		$cat = $this->Category->getCatSub($item->item_category_id);
		$item->isMyItem = $this->Item->isMyItem($item->item_id, $user_id);
		$item->category = $cat->category_name;
		$item->sub_category = $cat->sub_category_name;
		$item->category_id = $cat->category_id;
		$item->comm_name = $this->Community->getCommunity($item->community_id)->community_name;
			
		$data['item'] = $item;
		$data['categories'] = $this->Category->getCategories();
		$data['sub_categories'] = $this->Category->getSubCategories();

		$data['item_reviews'] = $this->Review->get_item_review($item_id);
		
		if ($data['item_reviews']) {
			foreach ($data['item_reviews'] as $item_review) {
				$reviewer = $this->User->getUserInfo($item_review->reviewer_id);
				$item_review->reviewer_name = $reviewer->user_name;
				$item_review->reviewer_img_name = $reviewer->user_img_name;
				$item_review->reviewer_img_ext = $reviewer->user_img_ext;
			}
		}

		if(is_null($data['item'])) {
			show_404();
			return;
		}
		$relatedItems = $this->Item->getRelatedItems($user_id, $item->category_id);
		if ($relatedItems == -1) {
			show_error("An error occured");
			return;
		}
		$index = 0;
		foreach ($relatedItems as $relatedItem) {
			if ($relatedItem->item_id == $item->item_id) {
				array_splice($relatedItems, $index, 1);
				break;
			}
			$index++;
		}
		$data['relatedItems'] = $relatedItems;
		$user_profile = $this->User->getUserProfile($user_id);
		$data['coins'] = $user_profile->user_coins;
		$data['offset'] = $user_profile->offset;
		if(is_int($data['item']) AND $data['item'] == -1){ show_404();}

		$this->load->view('templates/header', $data);
		$this->load->view('home/item', $data);
		$this->load->view('templates/footer', $data);
	}

	public function updateitemdetails($item_id){
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

		$this->form_validation->set_rules('item_name','Item Name','trim|required');
		$this->form_validation->set_rules('item_desc','Description','trim|required');
		$this->form_validation->set_rules('item_rent','Rent price','trim|required');

		if ($this->form_validation->run() === FALSE) {

			//$this->session->set_flashdata('error', 'this is an error');
			$this->load->view('templates/header', $data);
			$this->load->view('home/managemyitems', $data);
			$this->load->view('templates/footer', $data);
		} else {
			// Item posted
			$this->Item->updateitemdetails($user_id,$item_id);

			$this->session->set_flashdata('info', 'Item details updated');
			redirect('home/managemyitems');

			
		}
	}

	public function changeitemimage($item_id){
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

		$data['error'] = $this->session->flashdata('error');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->form_validation->set_rules('item_name','Item Name','trim|required');
		$this->form_validation->set_rules('item_desc','Description','trim|required');
		$this->form_validation->set_rules('item_rent','Rent price','trim|required');

		if($this->input->post('upload')) {
			$config['upload_path'] = './uploads/items';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']    = '5120';
			$config['max_width']  = '5120';
			$config['max_height']  = '768';
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload()) {
				$this->session->set_flashdata('error',$this->upload->display_errors());
				redirect('home/item/'.$item_id,'refresh');
				$flag=1;
			} else {
				$pic=$this->upload->data();
				//$this->thumb($pic);
				$item_img_name = $pic['raw_name'];
				$item_img_ext = $pic['file_ext'];
				$item_thumb_name = $pic['raw_name'].'_thumb';
				$this->Item->updateitemimage($user_id,$item_id, $item_img_name, $item_img_ext, $item_thumb_name);
				$this->session->set_flashdata('info', 'Item details updated');
				redirect('home/item/'.$item_id);

				//echo $item_img_name;
			}
		}
	}

	public function post($comm_id = NULL)
	{
		$this->load->library('form_validation');
		if(!$this->is_logged_in()) {
			$this->session->set_flashdata('error', 'Please login to continue');
			redirect('home/login');
		}
		$user_id = $this->getUserId();
		
		if (!$this->User->isMobileVerified($user_id)) {
			$this->session->set_flashdata('error', 'Please verify mobile number to continue.');
			redirect('home/profile/'.$user_id,'refresh');
		}
		else if($comm_id) {	
			$data['community_list'] = $this->Community->getCommunity($comm_id);

			$data['isLoggedin'] = $this->is_logged_in();
			$data['user_name'] = $this->getUserName();
			$data['user_id'] = $this->getUserId();

			$user_profile = $this->User->getUserProfile($user_id);
			$data['sharentoozbonus']=$user_profile->sharentoozbonus;
			$data['user_earnings'] = $user_profile->user_earnings;
			$data['user_coins'] = $user_profile->user_coins;
			
			$data['error'] = $this->session->flashdata('error');
			$data['info'] = $this->session->flashdata('info');

			$data['cities'] = $this->City->getCity();
			$data['adslimit'] = $this->User->getAdsLimit($user_id);
			$data['adslimit'] = $data['adslimit']->ads_limit;
			$data['warn'] = NULL;
			$data['adpostinginfo'] = NULL;
			
			$adpostingcharge = 0;
			if($data['adslimit'] <= 0){
				$data['warn'] = "Dear User, you have no free ads left. You shall be charged 50 gold coins for posting the add.";
				$adpostingcharge = -50;
			} else {
				$data['adpostinginfo']="Dear user, you have ".$data['adslimit']." pending free ads.";
				$adspostingcharge = 0;
			}

			$data['categories'] = $this->Category->getCategories();
			$data['sub_categories'] = $this->Category->getSubCategories();

			if($this->Member->isAlreadyEntered($user_id, $comm_id) == -1) {
				$this->session->set_flashdata('error', 'you must be member of this community');
				redirect('home/view/'.$comm_id);
			} else {
				$flag = 0;
				$data['comm_id'] = $comm_id;

				$this->form_validation->set_rules('item_name','Item Name','required');
				$this->form_validation->set_rules('item_desc','Description','required');
				$this->form_validation->set_rules('item_rent','Rent price','required|is_natural_no_zero');
				$this->form_validation->set_rules('item_brand','Brand','');
				$this->form_validation->set_rules('item_terms','Terms and Conditions','trim');
				$this->form_validation->set_rules('keyfeatures','key features','trim');
				$this->form_validation->set_rules('item_price','Purchase Price','trim|is_natural_no_zero');


				if($this->input->post('upload')) {

					$config['upload_path'] = './uploads/items';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']    = '5242880'; // 5 MB
					$config['max_width']  = '5500';
					$config['max_height']  = '5500';

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload()) {
						$this->session->set_flashdata('error',$this->upload->display_errors());
						$tmp = $this->upload->display_errors();
						redirect('home/post/'.$comm_id,'refresh');
						$flag = 1;
					} else {
						$pic=$this->upload->data();
						//$this->thumb($pic);
						$item_img_name = $pic['raw_name'];
						$item_img_ext = $pic['file_ext'];
						$item_thumb_name = $pic['raw_name'].'_thumb';
						//echo $item_img_name;
					}
				}

				if($flag == 0) {
					if ($this->form_validation->run() === FALSE) {
						$this->load->view('templates/header', $data);
						$this->load->view('home/post', $data);
						$this->load->view('templates/footer', $data);
					} else {
						// Item posted
						$item_id = $this->Item->insert($user_id, $comm_id, $item_img_name, $item_img_ext, $item_thumb_name);
						if($item_id > 0) {
							$this->Activity->insert($user_id, $comm_id, $item_id, NULL, NULL, TYPE_POST_ITEM);
							$this->User->update_coins($user_id,$adpostingcharge);
							$this->session->set_flashdata('info', 'Your item posted successfully!');
							$this->User->updateAdsLimit($user_id,$data['adslimit']-1);
							redirect('home/item/'.$item_id, 'refresh');
						} else {
							$this->session->set_flashdata('error', 'error posting item');
						}
					}
				}
			}
		} else { show_404(); }
	}
	
	// Used in ajax calls
	public function getItemsByCategory($category_id = NULL) {
		if ($category_id == NULL) {
			return NULL;
		}
		
	}

	public function managemyitems(){
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


		$data['activeitems'] = $this->Item->getmyactiveitems($user_id);
		if($data['activeitems'] !=-1){
			foreach($data['activeitems'] as $item)
			{

				$cat = $this->Category->getCatSub($item->item_category_id);
				$item->isMyItem = $this->Item->isMyItem($item->item_id, $user_id);
				$item->category = $cat->category_name;
				$item->sub_category = $cat->sub_category_name;
				$item->category_id = $cat->category_id;
				$item->comm_name = $this->Community->getCommunity($item->community_id)->community_name;
				
				//echo '<br>-------------------------<br>';
				//var_dump($item);
			}
		}

		$data['notactiveitems'] = $this->Item->getmynotactiveitems($user_id);

		if($data['notactiveitems'] !=-1){
			foreach($data['notactiveitems'] as $item)
			{

				$cat = $this->Category->getCatSub($item->item_category_id);
				$item->isMyItem = $this->Item->isMyItem($item->item_id, $user_id);
				$item->category = $cat->category_name;
				$item->sub_category = $cat->sub_category_name;
				$item->category_id = $cat->category_id;
				$item->comm_name = $this->Community->getCommunity($item->community_id)->community_name;
				
				//echo '<br>-------------------------<br>';
				//var_dump($item);
			}
		}

		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('info');

		$this->load->view('templates/header', $data);
		$this->load->view('home/managemyitems', $data);
		$this->load->view('templates/footer', $data);

	}

	public function deactivateitem($item_id){
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
		$data['info'] = $this->session->flashdata('Item successfully deactivated');
	

		$this->Item->deactivateitem($item_id,$user_id);
		
		$this->session->set_flashdata('info', 'Item deactivated');
		redirect('home/managemyitems');
	}

	public function activateitem($item_id){
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

		$amount = $this->input->post('item_rent');
		
		$this->Item->activateitem($item_id,$amount,$user_id);

		$data['error'] = $this->session->flashdata('error');
		$data['info'] = $this->session->flashdata('Item successfully deactivated');

		$this->session->set_flashdata('info', 'Item activated');
		redirect('home/managemyitems');
	}
}
?>
