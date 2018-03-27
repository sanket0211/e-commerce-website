<?php
Class User extends CI_Model {
	public function __construct()
	{   
		$this->load->database();
		// TODO: Remove this line, and move user from unverified_user to user using controller
		$this->load->model('Unverified_User');
	} 
	
	public function fblogin($user_email){
		$this->db->select('user_id, user_name, user_email, user_password, user_phone');
		$this->db->from('Users');
		$this->db->where('user_email', $user_email);
		//$this->db->where('password', );
		//$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();
		
	}



	public function login()
	{
		$user_email = $this->input->post('user_email');
		$user_password = $this->input->post('user_password');
		$this->db->select('user_id, user_name, user_email, user_password,profession');
		$this->db->from('Users');
		$this->db->where('user_email', $user_email);
		//$this->db->where('password', );
		//$this->db->limit(1);

		$query = $this->db->get();

		//print_r($query);
		if($query->num_rows() == 1)
		{
			//echo $query;
			//password_verify($password, $hash);
			$row = $query->row();
			if(password_verify($user_password, $row->user_password)){
				// user verified
				//print_r($query->result());
				return $query->result();
			}
			return NULL;
		}
		else
		{
			//echo "Not valid<br>";
			return false;
		}
	}
	public function check_contact($contact){

		$this->db->select('contact');
		$this->db->where('contact', $contact);
		$this->db->from('Users');

		$query = $this->db->get();
		if($query->conn_id->affected_rows > 0){
			
			return 1; // not a rentooz user
		}
		else{	
			return 0;
		}
	}

	public function insert_contact($user_id,$contact_id){
		$data = array(
			'user_id' => $user_id,
			'contact_id'=>$contact_id
		);

		$this->db->insert('Contacts', $data);

	}

	public function get_contact_details($contact){
		$this->db->select('user_id,user_name,user_email,user_img_name,user_img_ext,joined_date,likes,followers,contact');
		$this->db->from('Users');
		$this->db->where('contact', $contact);
		$query = $this->db->get();
		if ($query == FALSE) {
			return NULL;
		}
		$result = $query->result();
		if(count($result) > 0) {
			return $result[0];
		}
		return NULL;
	}

	private function setReferral($user_id){
		$result = $this->getUserProfile($user_id);
		$usname = $result->user_name;
		$len =(6 - strlen ( $user_id ));
		$lenname = strlen($usname);

		if($lenname >=$len){
			$usname = substr ( $usname , 0 , $len);
		}

		else{
			$rest = "abcdef";
			$usname = $usname . $rest;
			$usname = substr ( $usname , 0 , $len);
		}
		$ref = $usname . $user_id;
		$this->db->set('referral_code', $ref)  
                ->where('user_id', $user_id)
                ->update('Users');
	}

	public function updateUserName($user_id, $user_name){

		
		$this->db->set('user_name', $user_name, FALSE);
		$this->db->where('user_id', $user_id);
		$this->db->update('Users');
	}
	
	

	public function checkBalanceCoins($user_id=null){
		$this->db->select('user_coins');
		$this->db->from('Users');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		if ($query == FALSE) {
			return NULL;
		}
		$result = $query->result();
		return $result[0];
	}
	public function getAdsLimit($user_id){
		$this->db->select('ads_limit');
		$this->db->from('Users');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		if ($query == FALSE) {
			return NULL;
		}
		$result = $query->result();
		return $result[0];
	}

	public function updateAdsLimit($user_id,$newAdsLimit){
		if($newAdsLimit < 0) {
			$newAdsLimit=0;
		}
		$this->db->set('ads_limit', $newAdsLimit, FALSE);
		$this->db->where('user_id', $user_id);
		$this->db->update('Users');
	}

	public function addsharentoozbonus($user_id=NULL,$sharentoozbonus=NULL){
		$this->db->set('sharentoozbonus', 'sharentoozbonus+'.$sharentoozbonus, FALSE);
		$this->db->where('user_id', $user_id);
		$this->db->update('Users');	
	}

	public function subsharentoozbonus($user_id=NULL,$sharentoozbonus=NULL){
		
		$this->db->set('sharentoozbonus', 'sharentoozbonus-'.$sharentoozbonus, FALSE);
		$this->db->where('user_id', $user_id);
		$this->db->update('Users');	
	}

	public function getsharentoozbonus($user_id){
		$this->db->select('sharentoozbonus');
		$this->db->from('Users');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();

		$result = $query->result();
		return $result[0];
	}

	public function moveHere($unverified_user_id)
	{
		$this->db->select('unverified_user_id,unverified_user_name,unverified_user_password,
			unverified_user_email,unverified_user_img_name,unverified_user_img_name_ext,unverified_user_thumb_name,unverified_user_firstname,unverified_user_lastname,unverified_user_age,unverified_user_profession');
		$this->db->where('unverified_user_id',$unverified_user_id);
		$query = $this->db->get('unverified_users')->result();
		$result = $query[0];
		
		

		$data = array(
			'user_name' => $result->unverified_user_name,
			'user_fname' => $result->unverified_user_firstname,
			'user_lname' => $result->unverified_user_lastname,
			'user_password' => $result->unverified_user_password,
			'user_email' => $result->unverified_user_email,
			'user_img_name' => $result->unverified_user_img_name,
			'profession' => $result->unverified_user_profession,
			'age' => $result->unverified_user_age,
			'user_img_ext' => $result->unverified_user_img_name_ext,
			'user_thumb_name' => $result->unverified_user_thumb_name,
			'joined_date' => date('Y-m-d H:i:s')
		);
		if($error['code'] > 0) {

			// remove these two lines
			/*var_dump($error);
			die();*/
			return 0;
		}
		$this->db->insert('Users',$data);

		$last_inserted_id = $this->db->insert_id();
		return $last_inserted_id;
	}

	public function get_all_users($profession){
		if($profession==1){
			$this->db->select('user_id,user_name,user_fname,user_lname,user_email,user_img_name,user_img_ext,likes,followers');
			$this->db->from('Users');
			$this->db->where('profession', $profession);
			$query = $this->db->get();
			return $query->result();
		}
	}

	public function update_following($user_id,$following_id){
		$data = array(
			'user_id'=>$user_id,
			'following_id'=>$following_id
		);
		$this->db->insert('All_Followers',$data);
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
	
	// sent otp to mobile for verification
	public function gen_OTP($user_id = NULL){
		if(is_null($user_id)){ return NULL;}
		$this->delete($user_id);
		$charset = "1234567890";
		$otp = substr(str_shuffle($charset), 0, 4);
		$data = array(
			'user_id' => $user_id,
			'user_phone_otp' => $otp
		);
		$this->db->insert('verify_user', $data);
		$error = $this->db->error();
		if($error['code'] > 0) {
			return -1; // error
		}
		return $otp; // success
	}

	public function get_otp($user_id) {
		$this->db->select('user_phone_otp');
		$this->db->from('verify_user');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			$row = $query->row();
			return $row;
		}
		return -1;
	}
	
	public function delete($user_id = NULL){
		if(is_null($user_id)){ return NULL;}
		$this->db->delete('verify_user',array('user_id' => $user_id));
	}

	public function verify_mobile($user_id = NULL){
		$otp = $this->input->post('mob_otp');
		if(is_null($user_id) OR is_null($otp)){ return NULL;}
		$this->db->select('user_phone_otp');
		$this->db->where('user_id',$user_id);
		$this->db->from('verify_user');

		$query = $this->db->get();
		if($query->conn_id->affected_rows > 0){
			$otp_gen = $query->result()[0]->user_phone_otp;
			if($otp == $otp_gen){
				$this->delete($user_id);
				return 0; // verified
			}
		}
		return -1; // not verified
	}
	public function isMobileVerified($user_id = NULL){
		if(is_null($user_id)){ return NULL;}
		$this->db->select('user_phone_otp');
		$this->db->where('user_id', $user_id);
		$this->db->from('verify_user');

		$query = $this->db->get();
		//var_dump($query->conn_id->affected_rows);
		if($query->conn_id->affected_rows > 0){
			return 0; // not verified
		}
		return 1; // verified
	}
	
	
	

	public function isUser($user_email=null){

		$this->db->select('user_email');
		$this->db->where('user_email', $user_email);
		$this->db->from('Users');

		$query = $this->db->get();
		if($query->conn_id->affected_rows > 0){
			return 1; // not a rentooz user
		}
		return 0;
	}

	public function crosscheckpasswordchangecode($code){

		$this->db->select('user_email');
		$this->db->where('password_change_code', $code);
		$this->db->from('Forgotpassword');

		$query = $this->db->get();
		if($query->conn_id->affected_rows > 0){
			return 1; // not a rentooz user
		}
		return 0;
	}

	public function checkTable($user_email=null){

		$this->db->select('user_email');
		$this->db->where('user_email', $user_email);
		$this->db->from('Forgotpassword');

		$query = $this->db->get();
		if($query->conn_id->affected_rows > 0){
			$this->db->delete('Forgotpassword',array('user_email' => $user_email));
			return; // not a rentooz user
		}
		else{	
			return;
		}
	}

	public function getUserProfile($user_id = NULL)
	{
		if(!$user_id) {
			$this->db->select('user_id,user_name,user_email,user_img_name,user_img_ext,likes,followers,contact,profession');
			$this->db->from('Users');
			$query = $this->db->get();
			return $query->result();
		} else {
			$this->db->select('user_id,user_name,user_email,user_img_name,user_img_ext,joined_date,likes,followers,contact,profession');
			$this->db->from('Users');
			$this->db->where('user_id', $user_id);
			$query = $this->db->get();
			if ($query == FALSE) {
				return NULL;
			}
			$result = $query->result();
			if(count($result) > 0) {
				return $result[0];
			}
			return NULL;
		}
	}


	public function get_professional_data($user_id = NULL)
	{
		$this->db->select('ca_id,school,undergraduate_college,articleship,working_at,user_id,fb_link,linkedin_link');
			$this->db->from('Ca');
			$this->db->where('user_id', $user_id);
			$query = $this->db->get();
			if ($query == FALSE) {
				return NULL;
			}
			$result = $query->result();
			if(count($result) > 0) {
				return $result[0];
			}
			return NULL;
	}



	public function check_following($requested_user_id,$user_id)
	{

			$this->db->select('following_id');
			$this->db->from('All_Followers');
			$this->db->where('user_id', $user_id);
			$this->db->where('following_id', $requested_user_id);
			$query = $this->db->get();
			if($query->conn_id->affected_rows>0){
				return 1;
			}
			return 0;
	}

	public function update_user_likes($user_id){
		$this->db->select('likes');
			$this->db->from('Users');
			$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		$likes=$query->result()[0]->likes;

		$this->db->set('likes', $likes+1, FALSE);
		$this->db->where('user_id', $user_id);
		$this->db->update('Users');
	}

	public function update_user_followers($follow_id){
		$this->db->select('followers');
			$this->db->from('Users');
			$this->db->where('user_id', $follow_id);
		$query = $this->db->get();
		$followers=$query->result()[0]->followers;

		$this->db->set('followers', $followers+1, FALSE);
		$this->db->where('user_id', $follow_id);
		$this->db->update('Users');
	}


	// Use this function to get neccessary user details
	public function getUserInfo($user_id = NULL) {
		if(is_null($user_id)) {
			$this->db->select('user_id,user_name,user_phone,user_email,user_img_name,user_img_ext');
			$this->db->from('Users');
			$query = $this->db->get();
			return $query->result();
		} else {
			$this->db->select('user_id,user_name,user_phone,user_email,user_img_name,user_img_ext,joined_date');
			$this->db->from('Users');
			$this->db->where('user_id', $user_id);
			$query = $this->db->get();
			if ($query == FALSE) {
				return NULL;
			}
			$result = $query->result();
			if(count($result) > 0) {
				return $result[0];
			}
			return NULL;
		}
	}

	public function getNotInvitedMembers($user_id = NULL){
		$sql = "SELECT U.user_name,U.user_id,U.user_email,U.user_img_name,U.user_img_ext FROM Users as U where U.user_id != ?";
		$query = $this->db->query($sql, array($user_id));
		$error = $this->db->error();
        if($error['code'] > 0) {
            return -1; 
        }
		return $query->result();
	}

	
	public function UpdateCoins($get_coins= NULL, $user_id = NULL, $new_earnings=NULL){
		
		$sql = "update Users set Users.user_coins = ?, Users.user_earnings = ? where Users.user_id = ?";
		$query = $this->db->query($sql, array($get_coins, $new_earnings, $user_id));
		$error = $this->db->error();
	}

	// update borrower's offset after the giver accepted item request 
	public function UpdateOffset($user_id = NULL, $offset = NULL){
		if(is_null($user_id) OR is_null($offset)){
			return NULL;
		}
		$this->db->set('offset', 'offset+'.$offset, FALSE);
		$this->db->where('user_id', $user_id);
		$this->db->update('Users');
	}

	public function updatepassword($email){
		$pass = $this->input->post('user_password_new');
		$check = password_hash($this->input->post('user_password_new'),PASSWORD_DEFAULT);
		$this->db->set('user_password', $check, FALSE);
		$this->db->where('user_email', $email);
		$this->db->update('Users');
	}
	
	public function update_coins($user_id = NULL, $user_coins_diff = NULL){
		if(is_null($user_id) OR is_null($user_coins_diff)){
			return NULL;
		}
		$this->db->set('user_coins', 'user_coins+'.$user_coins_diff, FALSE);
		$this->db->where('user_id', $user_id);	
		$this->db->update('Users');
	}

	public function updateEarnings($user_id = NULL, $user_coins_diff = NULL){
		if(is_null($user_id) OR is_null($user_coins_diff)){
			return NULL;
		}
		$this->db->set('user_earnings', 'user_earnings+'.$user_coins_diff/10, FALSE);
		$this->db->where('user_id', $user_id);
		$this->db->update('Users');
	}

	public function NewEarnings($user_id = NULL, $earnings= NULL){
		if(is_null($user_id) OR is_null($earnings)){
			return NULL;
		}
		$this->db->set('user_earnings', 'user_earnings+('.$earnings.')', FALSE);
		$this->db->where('user_id', $user_id);
		$this->db->update('Users');
	}
	
	public function changeprofilephoto($user_id = NULL,$user_img_name,$user_img_ext,$user_thumb_name){
		
		if(is_null($user_id)) { return NULL; }
		$sql = "UPDATE Users SET user_img_name=?, user_img_ext=?, user_thumb_name=? WHERE Users.user_id=?";
		$query = $this->db->query($sql, array($user_img_name,$user_img_ext,$user_thumb_name,$user_id));
		
		return $query;
	}

	public function updatePhoneNumber($user_id = NULL){
		if(is_null($user_id)){
			return NULL;
		}

		$user_number = $this->input->post('user_phone');
		$this->db->set('user_phone', $user_number, FALSE);
		$this->db->where('user_id', $user_id);
		$this->db->update('Users');
	}

}
?>
