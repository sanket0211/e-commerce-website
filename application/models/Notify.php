<?php
	/*
	 * (notification_type, status)  | 	MEANING
	 * --------------------------------------
	 * 				0,0				| 	JOIN COMMUNITY
	 *				0,1				|	JOIN COMMUNITY REQUEST ACCEPTED
	 *				0,2				| 	JOIN COMMUNITY REQUEST REJECTED
	 *				0,3				|	JOIN COMMUNITY REQUEST ACCEPTED AND SEEN BY BOTH USERS
	 *				0,4				|	JOIN COMMUNITY REQUEST REJECTED AND SEEN BY BOTH USERS
	 *				1,0				|	INVITAION SENT
	 *				1,1				| 	INVITATION ACCEPTED
	 *				1,2				|	INVITATION REJECTED
	 *				1,3				|	INVITATION RESULT ACCEPTED AND SEEN BY BOTH USERS
	 *				1,4				|	INVITATION RESULT REJECTED AND SEEN BY BOTH USERS
	 */

define("DUPLICATE_KEY", 1062);
class Notify extends CI_Model {
	public function __construct()
    {   
        $this->load->database();
		$this->load->model('Member');
    } 
	
	// Get a notification of particular notification id  
	public function getNotification($notification_id = NULL) {
		if (is_null($notification_id)) { return EXIT_USER_INPUT; }
		$this->db->select('*');
		$this->db->from('Notifications');
		$this->db->where('notification_id', $notification_id);
				
		$query = $this->db->get();
		$error = $this->db->error();
       	if($error['code'] > 0) {
           	return EXIT_DATABASE; // database error
       	}
		$result = $query->row();
		return $result;
	}

	public function insert($admin_id = NULL, $user_id = NULL, $community_id = NULL, $notify_type = NULL)
	{
		if(is_null($user_id) OR is_null($community_id) OR is_null($notify_type)){
			return NULL;
		}
		// request for joining a community
		else if ($notify_type == NOTIFICATION_TYPE_JOIN) {
			$data = array(
            	'user_id' => $user_id,
	            'admin_id' => NULL,
    	        'community_id' => $community_id,
        	    'notification_type' => NOTIFICATION_TYPE_JOIN
        	);
			$this->db->insert('Notifications', $data);
			$error = $this->db->error();
    		if($error['code'] > 0) {
    			return EXIT_DATABASE;
    		}
    		return EXIT_SUCCESS;
		}

		// invite the user for join a community
		else if ($notify_type == NOTIFICATION_TYPE_INVITE AND $admin_id){
			$data = array(
            	'user_id' => $user_id,
	            'admin_id' => $admin_id, // the invitation sender id
    	        'community_id' => $community_id,
        	    'notification_type' => NOTIFICATION_TYPE_INVITE, // notification type is invition
        	);
			$this->db->insert('Notifications', $data);
			$error = $this->db->error();
        	if($error['code'] > 0) {
            	return EXIT_DATABASE; 
        	}
        	$insert_id = $this->db->insert_id();
			return  $insert_id;
		}
	}
	
	// TODO: Update notifications according to notification_id
	public function update($user_id, $community_id, $status, $notification_type = NULL, $invitee_id = NULL)
	{	
		// add one more argument in all calling functions
		if($notification_type == NOTIFICATION_TYPE_JOIN OR is_null($notification_type)) {
			$membersList = $this->Member->getMembers($community_id);
    	    foreach($membersList as $member)
        	{
	            $member_id = $member->member_id;
				$this->db->where('admin_id', $member_id);
				$this->db->where('community_id', $community_id);
				$this->db->where('user_id',$user_id);

	            $data = array(
    	            'status' => $status
        	    );
            	$this->db->update('Notifications', $data);
				$this->Member->insert($user_id, $community_id, 0);
        	}
			return $this->db->error();
		}
		else if($notification_type == 1){
			$this->db->where('admin_id', $invitee_id);
			$this->db->where('community_id', $community_id);
			$this->db->where('user_id', $user_id);
			$this->db->where('notification_type', 1);
	        $data = array(
    	        'status' => $status
        	);
            $this->db->update('Notifications', $data);
		}
	}
	
	public function update_notification($notification_id = NULL, $status = NULL) {
		if (is_null($notification_id) OR is_null($status)) { return EXIT_USER_INPUT;}
		$this->db->where('notification_id', $notification_id);
		$data = array(
			'status' => $status
		);
		$this->db->update('Notifications', $data);
		$error = $this->db->error();
		if ($error['code'] > 0) {
			return EXIT_DATABASE; // error
		}
		return EXIT_SUCCESS;
	}
	
	// user_id already present in notification table for notification_type
	public function already_entered($user_id, $notification_type){
		$this->db->select('admin_id, status community_id');
		$this->db->where('user_id', $user_id);
		$this->db->where('notification_type', $notification_type);

		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			$row = $query->row();
			return $row;
		}
		return -1;
	}

	// delete an notification
	public function delete($admin_id, $community_id, $user_id, $notification_type){
		$this->db->where('admin_id', $admin_id);
		$this->db->where('community_id', $community_id);
		$this->db->where('user_id',$user_id);
		$this->db->where('notification_type', $notification_type);
		$this->db->delete('Notifications');
	}

	// Join community request from a user to its members
	public function notify_members($user_id)
	{
		$sql = 'SELECT DISTINCT N.notification_id, N.admin_id, N.notification_type, N.user_id, C.community_name, 
			N.community_id, U.user_name, N.status From Notifications as N, Members as M,Communities as C,
			Users as U where N.admin_id IS NULL AND N.user_id = U.user_id AND C.community_id = N.community_id
			AND M.community_id = N.community_id AND N.notification_type = '. NOTIFICATION_TYPE_JOIN .'
			AND N.status = FALSE AND M.member_id = ?';

		$query = $this->db->query($sql, array($user_id));
		return $query->result();
	}

	public function member_notification_count($user_id) {
		$result = $this->notify_members($user_id);
		return count($result);
	}

	// all join community reponses as notifications for a user
	public function join_community_notifications($user_id)
	{
		$sql = 'SELECT DISTINCT N.notification_id, C.community_id, C.community_name, N.status FROM Notifications 	as N,Communities as C WHERE N.notification_type = '. NOTIFICATION_TYPE_JOIN .' AND
				N.community_id = C.community_id AND (N.status = '.NOTIFICATION_ACCEPTED.' OR N.status = '.NOTIFICATION_REJECTED.') AND  N.user_id = ?';
		$query = $this->db->query($sql, array($user_id));
		if($query == FALSE){
			return NULL;
		}
		return $query->result();
	}

	// Community join invitations to a user
	// COLUMNS RETURNS: community name, admin name,admin id, user name, user id, notification status
	public function invitee_notifications($user_id) {
		$sql = "SELECT N.notification_id, C.community_name, C.community_id, U1.user_name AS invitee_name, N.admin_id AS invitee_id,
				U2.user_name, N.user_id, N.status FROM Notifications AS N, Communities AS C, Users AS U1, Users AS U2
				WHERE N.notification_type = 1 AND N.community_id = C.community_id AND N.admin_id = U1.user_id AND
				N.user_id = U2.user_id AND N.status = 0 AND N.user_id = ?";
		$query = $this->db->query($sql, array($user_id));
		if($query == FALSE){
			return NULL;
		}
		return $query->result();
	}

	// Community join invitations from a user
	// COLUMNS RETURNS: community name, admin name,admin id, user name, user id, notification status
	public function inviter_notifications($user_id) {
		$sql = "SELECT N.notification_id, C.community_name, C.community_id, U1.user_name AS invitee_name, N.admin_id AS invitee_id,
				U2.user_name, N.user_id, N.status FROM Notifications AS N, Communities AS C, Users AS U1, Users AS U2
				WHERE N.notification_type = 1 AND N.community_id = C.community_id AND N.admin_id = U1.user_id AND
				N.user_id = U2.user_id AND ( N.status = 1 OR N.status = 2)  AND N.admin_id = ?";
		$query = $this->db->query($sql, array($user_id));
		if($query == FALSE){
			return NULL;
		}
		return $query->result();
	}	
}
