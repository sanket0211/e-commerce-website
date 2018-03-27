<?php
class Community extends CI_Model {
	public function __construct()
	{   
		$this->load->database();
	} 

	public function getCommunity($comm = NULL, $user_id = NULL)
	{
		// Return list of all public communities
		if(is_null($comm) AND is_null($user_id))
		{

			$this->db->select('community_name, no_of_members, community_id, community_desc,community_img_name,community_img_ext');
			$this->db->from('Communities');
			$query = $this->db->get();
			return $query->result();
		}
		// Return details of public community
		else if(!is_null($comm) AND is_null($user_id))
		{
			$this->db->select('community_code,community_id,community_name,no_of_members,community_desc,community_img_name,community_img_ext');
			$this->db->from('Communities');
			$this->db->where('community_id', $comm);

			$query = $this->db->get();
			$result = $query->result();
			if(count($result) > 0) {
				return $result[0];
			}
			return NULL;
		}
		// Return list of joined community
		else {

			$sql = "select Communities.community_code,Communities.community_name,Communities.community_img_name,Communities.community_img_ext, Communities.no_of_members, Communities.community_id from Communities,Members where Members.community_id = Communities.community_id AND Members.member_id = ?";
			$query = $this->db->query($sql, array($user_id));
			return $query->result();
		}
	}

	public function get_community($community_id = NULL) {
		if(is_null($community_id)) { return NULL;}
		//var_dump($community_id);
		$this->db->select('community_id,community_name,no_of_members,community_desc,community_img_name,community_img_ext');
		$this->db->from('Communities');
		$this->db->where('community_id', $community_id);
		$query = $this->db->get();
		
		if($query->num_rows() == 1)
		{
			$row = $query->row();
			return $row;
		}
		return NULL;
	}

	public function get_community_id($code = NULL) {
		if(is_null($code)) { return NULL;}
		//var_dump($community_id);
		$this->db->select('community_id');
		$this->db->from('Communities');
		$this->db->where('community_code', $code);
		$query = $this->db->get();
		
		$result = $query->result();
			if(count($result) > 0) {
				return $result[0];
			}
		return NULL;
	}

	public function getNotJoinedCommunities($user_id = NULL) {
		if(is_null($user_id)) { return NULL; }
		$sql = "select Communities.community_name,Communities.community_id from Communities where Communities.community_id NOT IN (select Members.community_id from Members where Members.member_id = ?)";
		$query = $this->db->query($sql, array($user_id));
		return $query->result();
	}
	public function insert($admin_id,$community_img_name,$community_img_ext,$community_thumb_name)
	{

		//generate community code
		//$this->delete($user_id);
		$charset = "abcdefghijklmnopqrstuvwxyz0123456789";
		$code = substr(str_shuffle($charset), 0, 6);

		$city_id = $this->input->post('comm_location');
		//$community_privacy= $this->input->post('comm_privacy');
		/*if($community_privacy == "Private"){
			$community_privacy=1;
			
		}
		else{
			$community_privacy=0;
		}*/
		if(!$admin_id) {
			return false;
		}
		$data = array(
			'community_name' => $this->input->post('comm_name'),
			'community_code' => $code,
			'community_desc' => $this->input->post('comm_desc'),
			'admin_id' => $admin_id,
			'no_of_members' => 1,
			'no_of_admins' => 1,
			'community_img_name' => $community_img_name,
			'community_img_ext' => $community_img_ext,
			'community_thumb_name' => $community_thumb_name,
			'city_id' => $city_id
			/*
			's_name' => $this->input->post('title'),
			's_name' => $this->input->post('title'),*/
		);
		$this->db->insert('Communities', $data);
		$insert_id = $this->db->insert_id();
		$error = $this->db->error();	
		if($error['code'] > 0) {
			return EXIT_DATABASE;
		}
		return $insert_id;
	}

	public function delete($community_id = NULL) {
		if (is_num($community_id))
			$this->db->delete('Communities', array('community_id', $community_id));
	}
}
?>