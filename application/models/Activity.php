<?php
class Activity extends CI_Model {
	public function __construct() {
		$this->load->database();	
	}
	
	public function insert($user_id = NULL, $community_id = NULL, $item_id = NULL,
		$deal_id = NULL, $other_user_id = NULL, $activity_type = NULL) {
		if (is_null($user_id) OR is_null($activity_type)) {
			return EXIT_ERROR;
		}

		$data = array(
			'user_id' => $user_id,
			'community_id' => $community_id,
			'item_id' => $item_id,
			'deal_id' => $deal_id,
			'other_user_id' => $other_user_id,
			'activity_type' => $activity_type
		);

		$this->db->set('activity_date', 'NOW()', FALSE);
		$this->db->insert('activity', $data);
		$error = $this->db->error();

		if($error['code'] > 0) {
			return EXIT_DATABASE;
		}
		return EXIT_SUCCESS;
	}

	public function getActivities($user_id) {
		$this->db->select('activity_id, user_id, community_id, item_id, other_user_id,
			activity_type, activity_date');
		$this->db->from('activity');
		$this->db->where('user_id', $user_id);

		$query = $this->db->get();
		$error = $this->db->error();
		if ($error['code'] > 0) {
			return EXIT_DATABASE;
		} else {
			return $query->result();
		}
	}
}
?>