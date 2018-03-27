<?php
class Member extends CI_Model {
	public function __construct()
	{   
		$this->load->database();
		$this->load->model('Community');
	}
	
	// TODO: Refactor this function and its usage
	public function isAlreadyEntered($member_id, $community_id) {
        $this->db->select('role');
        $this->db->from('Members');
        $this->db->where('member_id', $member_id);
        $this->db->where('community_id', $community_id);

		$query = $this->db->get();
		// Not good way, change it
		if($query->num_rows() == 1)
		{
			$row = $query->row();
			return $row->role;
		}
		else
		{
			return -1;
		}	
	}
	
	public function isMember($member_id = NULL, $community_id = NULL) {
		if (is_null($member_id) OR is_null($community_id)) {
			return EXIT_ERROR;
		} else {
			$this->db->select('*');
	        $this->db->from('Members');
	        $this->db->where('member_id', $member_id);
	        $this->db->where('community_id', $community_id);
	
			$query = $this->db->get();
			$error = $this->db->error();
			if($error['code'] > 0) {
				return EXIT_DATABASE;
			}
			return EXIT_SUCCESS;
		}
	}
	
	public function admin_list($community_id)
	{
        $this->db->select('member_id');
        $this->db->from('Members');
        $this->db->where('community_id', $community_id);
        $this->db->where('role', 1);
		$query = $this->db->get();
		return $query->result();
	}

	public function insert($member_id, $community_id, $role)
	{
		$data = array(
			'member_id' => $member_id,
			'community_id' => $community_id,
			'role' => $role,
		);
		$this->db->insert('Members', $data);
		$error = $this->db->error();
		if($error['code'] > 0) {
			return EXIT_DATABASE;
		}
		$this->db->where('community_id', $community_id);
		$this->db->set('no_of_members','no_of_members + 1',FALSE);
		$this->db->update('Communities');
        return EXIT_SUCCESS;

	}
	// return list of members
	public function getMembers($comm_id) {
		$sql = "SELECT Users.user_id,Users.user_name, Users.user_img_name, Users.user_img_ext
			FROM Users INNER JOIN (SELECT Members.member_id FROM Members WHERE
			Members.community_id=? ) AS a ON a.member_id = Users.user_id ";
		$query = $this->db->query($sql, array($comm_id));
		return $query->result();
	}	

}
?>
