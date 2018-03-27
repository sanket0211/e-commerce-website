<?php
Class FaceBookDetails extends CI_Model {
	public function __construct()
	{   
		$this->load->database();
		// TODO: Remove this line, and move user from unverified_user to user using controller
		$this->load->model('Unverified_User');
	} 
	
	public function isFacebookVerified($user_fb_id=Null){
		
		if(is_null($user_fb_id)){ return NULL;}
		$this->db->select('fb_verified');
		$this->db->where('user_fb_id', $user_fb_id);
		$this->db->from('FaceBookDetails');
		
		$query = $this->db->get();
		
		if($query->conn_id->affected_rows > 0){
			return $query->result()[0]->fb_verified;
		}
		return 0;
	}
	
	public function updatefbverify($user_fb_email, $status){
		
		$this->db->set('fb_verified', $status,FALSE);
		$this->db->where('user_fb_email', $user_fb_email);
		$this->db->update('FaceBookDetails');
	}


	public function insert( $fb_name,$fb_id,$fb_email){
		$data = array(
			'user_name' => $fb_name,
			'user_fb_id' => $fb_id,
			'user_fb_email'=> $fb_email
		);
		$this->db->insert('FaceBookDetails',$data);
	}

	public function getfb_id($user_id){
		
		$sql = "SELECT FaceBookDetails.user_fb_id from Users, FaceBookDetails where Users.user_id = ? and Users.user_email = FaceBookDetails.user_fb_email";
		$query = $this->db->query($sql, array($user_id));
		$result = $query->result();
		if (count($result) <= 0) {
			return NULL;
		}
		return $query->result()[0];
	}

}
?>