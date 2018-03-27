<?php
class Review extends CI_Model {
	public function __construct()
	{
		$this->load->database();
		
		$this->load->model('Deal');
	}
	
	public function add_item_review($deal_id = NULL, $item_id = NULL, $reviewer_id = NULL, $stars = NULL, $comment = NULL) {
		if (is_null($deal_id) OR is_null($item_id) OR is_null($reviewer_id) OR is_null($stars) OR is_null($comment)) {
			return EXIT_ERROR;
		}

		$data = array(
			'deal_id' => $deal_id,
			'item_id' => $item_id,
			'reviewer_id' => $reviewer_id,
			'stars' => $stars,
			'comment' => $comment
		);

		$review = $this->get_item_review($item_id, $deal_id, $reviewer_id);
		if ($review == EXIT_DATABASE) {
			return EXIT_DATABASE;
		}else if (is_null($review)) {
			$this->db->insert('item_review', $data);
		} else {
			$this->db->where('deal_id', $deal_id);
			$this->db->where('item_id', $item_id);
			$this->db->where('reviewer_id', $reviewer_id);
			$this->db->update('item_review', $data);
		}
		$error = $this->db->error();
		if ($error['code'] > 0) {
			return EXIT_DATABASE;
		}
		return EXIT_SUCCESS;
	}

	public function add_user_review($deal_id = NULL, $reviewer_id = NULL, $reviewee_id = NULL,
		$stars = NULL, $comment = NULL) {
		if (is_null($deal_id) OR is_null($reviewee_id) OR is_null($reviewee_id) OR is_null($stars)) {
			return EXIT_ERROR;
		}

		$data = array(
			'deal_id' => $deal_id,
			'reviewee_id' => $reviewee_id,
			'reviewer_id' => $reviewer_id,
			'stars' => $stars,
			'comment' => $comment
		);

		$review = $this->get_user_review($deal_id, $reviewer_id, $reviewee_id);
		if ($review == EXIT_DATABASE) {
			return EXIT_DATABASE;
		}else if (is_null($review)) {
			$this->db->insert('user_review', $data);
			$error = $this->db->error();
			if ($error['code'] > 0) {
				return EXIT_DATABASE;
			}
		} else {
			$this->db->where('deal_id', $deal_id);
			$this->db->where('reviewer_id', $reviewer_id);
			$this->db->where('reviewee_id', $reviewee_id);
			$this->db->update('user_review', $data);
		}

		$deal = $this->Deal->getDeal($deal_id);
		if ($reviewer_id == $deal->g_id) {
			$this->Deal->updateDeal($deal_id, NULL, REVIEW_SUBMITTED, GIVER);
		} else if ($reviewer_id == $deal->b_id) {
			$this->Deal->updateDeal($deal_id, NULL, REVIEW_SUBMITTED, BORROWER);	
		}
		
		return EXIT_SUCCESS;
	}
	
	public function get_item_review($item_id = NULL, $deal_id = NULL, $user_id = NULL) {
		if (is_null($item_id))
			return EXIT_ERROR;
		$this->db->select('deal_id, item_id, reviewer_id, stars, comment');
		if ($deal_id)
			$this->db->where('deal_id', $deal_id);
		if ($user_id)
			$this->db->where('reviewer_id', $user_id);
		$this->db->where('item_id', $item_id);
		
		$this->db->from('item_review');

		$query = $this->db->get();
		$error = $this->db->error();

		$result = $query->result();
		if ($error['code'] > 0) {
			return EXIT_DATABASE;
		} else if (count($result) == 0) {
			return NULL;
		}
		return $result;
	}

	public function get_user_review($deal_id, $reviewer_id, $reviewee_id) {
		$this->db->select('deal_id, reviewer_id, reviewee_id, stars, comment');
		$this->db->where('deal_id', $deal_id);
		$this->db->where('reviewer_id', $reviewer_id);
		$this->db->where('reviewee_id', $reviewee_id);
		$this->db->from('user_review');
		
		$result = $this->db->get()->result();
		$error = $this->db->error();
		if ($error['code'] > 0) {
			return EXIT_DATABASE;
		} else if (count($result) == 0) {
			return NULL;
		}
		return $result;
	}
}
?>