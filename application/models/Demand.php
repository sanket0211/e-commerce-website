<?php
class Demand extends CI_Model {
	public function __construct()
	{   
		$this->load->database();
	}

	public function getTopDemands($comm_id){
		$this->db->select('demand_id, demand_item, demand_item_desc, hits');
		$this->db->from('Demands');
		$this->db->where('community_id',$comm_id);
		$this->db->order_by('hits desc');
		
		$this->db->limit(5);

		$query = $this->db->get();
        $error = $this->db->error();
        if($error['code'] > 0) {
            return -1; 
        }
        $result = $query->result();
        if(count($result) == 0) {
            return NULL;
        }
		return $result;
	}

	public function getAllDemands($comm_id){
		$this->db->select('demand_id, demand_item, demand_item_desc, hits');
		$this->db->from('Demands');
		$this->db->where('community_id',$comm_id);
		$this->db->order_by('hits desc');

		$query = $this->db->get();
        $error = $this->db->error();
        if($error['code'] > 0) {
            return -1; 
        }
        $result = $query->result();
        if(count($result) == 0) {
            return NULL;
        }
		return $result;
	}

	public function insert($user_id = NULL){
		if(is_null($user_id)){ return NULL;}
		$data = array(
			'user_id' => $user_id,
			'demand_item' => $this->input->post('demand_item'),
			'demand_item_desc' => $this->input->post('demand_item_desc'),
			'demand_sub_cat' => $this->input->post('sub_cat_id'),
			'community_id'=> $this->input->post('community_id')		
		);
		
		$this->db->insert('Demands', $data);
		$error = $this->db->error();
		if($error['code'] > 0) {
			return -1; // error
		}
		$demand_id = $this->db->insert_id();
		return 0; // succesfully inported
	}

	// upvote the demand
	public function upvote($user_id = NULL, $demand_id = NULL){
		if(is_null($user_id) OR is_null($demand_id)){
			return NULL;
		}
		else {
			$data = array(
				'user_id' => $user_id,
				'demand_id' => $demand_id
			);
			$this->db->insert('demand_hits', $data);

			$this->db->set('hits', 'hits+1', FALSE);
			$this->db->where('demand_id', $demand_id); 
			$this->db->update('Demands');

			$error = $this->db->error();
			if($error['code'] > 0) {
				return -1; // error
			}
			return 0;
		}
	}

	// downvote the demand
	public function downvote($user_id = NULL, $demand_id = NULL){
		if(is_null($user_id) OR is_null($demand_id)){
			return NULL;
		}
		else {
			// entry deleted from demand_hits table
			$this->db->where('demand_id', $demand_id);
			$this->db->where('user_id', $user_id);
			$this->db->delete('demand_hits');

			// now reduce its vote
			$error = $this->db->error();
			if($error['code'] == 0) {
				$this->db->set('hits', 'hits-1',FALSE);
				$this->db->where('demand_id', $demand_id);
				$this->db->update('Demands');
			}

			$error = $this->db->error();
			if($error['code'] > 0) {
				return -1; // error
			}
			return 0;			
		}
	}

	public function isUpvoted($user_id = NULL, $demand_id = NULL){
		$this->db->select('demand_id, user_id');
		$this->db->from('demand_hits');
		$this->db->where('demand_id', $demand_id);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();

		$error = $this->db->error();
		if($error['code'] > 0) {
			return -1; // error
		}
		if($query->num_rows() == 1)
		{
			return 0;
		}
		else
		{
			return 1; // not upvoted
		}	
	}
}