<?php
class Unverified_User extends CI_Model {

	public function __construct()
	{   
		$this->load->database();

	}   

	public function get_user($slug = FALSE)
	{   
		if ($slug === FALSE)
		{
			$query = $this->db->get('unverified_users');
			return $query->result_array();
		}
		$query = $this->db->get_where('news', array('slug' => $slug));
		return $query->row_array();

		$this->load->model('User');

	}   

	public function insert($unverified_user_img_name,$unverified_user_img_name_ext,$unverified_user_thumb_name)
	{ 
		$city_id = $this->input->post('city_id'); 
		$data = array(
			'referral' => $this->input->post('referral'),
			'unverified_user_name' => $this->input->post('user_name'),
			'unverified_user_password' => password_hash($this->input->post('user_password_new'),PASSWORD_DEFAULT),
			'unverified_user_phone' => $this->input->post('user_phone'),
			'unverified_user_email' => $this->input->post('user_email'),
			'unverified_user_email_code' => sha1(time()),
			'unverified_user_img_name' => $unverified_user_img_name,
			'unverified_user_img_name_ext' => $unverified_user_img_name_ext,
			'unverified_user_thumb_name' => $unverified_user_thumb_name,
			'unverified_user_city_id' => $city_id,
			'unverified_user_address'=> $this->input->post('user_address')
		);
		
		$this->db->insert('unverified_users', $data);
		$error = $this->db->error();
		
		if($error['code'] > 0) {

			// remove these two lines
			/*var_dump($error);
			die();*/
			return 0;
		}
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}


	private function delete($unverified_user_id){
		$this->db->delete('unverified_users',array('unverified_user_id' => $unverified_user_id));
	}

	// send back email and email verification code
	public function getEmailDetails($user_id = NULL){
		if(is_null($user_id)){ return NULL;}
		$this->db->select('unverified_user_id, unverified_user_email_code,unverified_user_email, unverified_user_name');
		$this->db->where('unverified_user_id', $user_id);
		$this->db->from('unverified_users');

		$query = $this->db->get();

		$error = $this->db->error();
		if($error['code'] > 0) {
			return -1; // db error
		}
		return $query->result()[0];
	}
	public function verifyEmail($verification_code = NULL, $user_id = NULL){
		if(is_null($verification_code) OR is_null($user_id)){ return NULL;}
		// Move this entry to user table, Now user email is verified but mobile is not verified
		$this->db->set('unverified_user_email_vs', 1)  
                ->where('unverified_user_email_code', $verification_code)  
                ->where('unverified_user_id', $user_id)
                ->update('unverified_users');
        	$error = $this->db->error();
        	$num_rows = $this->db->affected_rows();
        	if($num_rows > 0){
        		$new_user_id = $this->User->MoveHere($user_id);
        		$this->User->gen_OTP($new_user_id); // inserting in verify_mobile table
        		$this->delete($user_id);
        		return $num_rows;
        	}
        	return -1;
	}	

}

?>
