<?php
class Deal extends CI_Model {
	/*
	 * STATUS CODES | 	MEANING
	 * --------------------------------------
	 * 		0		| 	PENDING
	 *		1		|	ACCEPTED
	 *		2		| 	RENTING PERIOD STARTED
	 *		3		|	RENTING PERIOD OVER
	 *		4		| 	CANCELLED
	 *		5		|	SEEN BY GIVER
	 *      6		|	SEEN BY BORROWER
	 * 		7		|	FAILED/CANCELLED AND SEEN
	 *		8		| 	SUCCESSFUL AND SEEN
	 */

	public function __construct()
	{   
		$this->load->database();
		$this->load->model('Item');
		$this->load->model('User');
	} 
	
	public function getMyDeals($user_id = NULL, $dir = NULL) {
		if(is_null($user_id) AND is_null($dir)){ return NULL;}
		// list of deals where user acts as a giver
		else if($dir == GIVER) {
			$sql = "SELECT Deals.status, Deals.deal_id,Deals.start_date, Deals.deal_days, Users.user_name, Users.user_id, Items.item_name, Items.item_id, Deals.g_reviewed,
					Items.item_img_name, Items.item_img_ext, Items.item_rent, Items.item_end_date
					FROM Items, Deals, Users WHERE Items.Item_id = Deals.item_id AND Deals.b_id = Users.user_id
					AND Deals.g_id = ?";
			$query = $this->db->query($sql, array($user_id));
        	$error = $this->db->error();
        	if($error['code'] > 0) {
            	return EXIT_DATABASE; 
        	}
			return $query->result();
		}
		// list of deals where user acts as a borrower
		else if($dir == BORROWER){
			$sql = "SELECT Deals.status ,Deals.deal_id, Deals.start_date, Deals.deal_days ,Users.user_name ,Users.user_id, Items.item_name, Items.item_id, Deals.b_reviewed,
					Items.item_img_name, Items.item_img_ext, Items.item_rent, Items.item_end_date
					FROM Items, Deals, Users WHERE Items.Item_id = Deals.item_id AND Deals.g_id = Users.user_id
					AND Deals.b_id = ?";
			$query = $this->db->query($sql, array($user_id));
        	$error = $this->db->error();
        	if($error['code'] > 0) {
            	return EXIT_DATABASE; 
        	}
			if(is_null($query->result())){ return NULL; }
			return $query->result();
		}

	}
	public function getDeal($deal_id) {
		$this->db->select('deal_id, item_id, g_id, b_id, status, no_of_days');
		$this->db->from('Deals');
		$this->db->where('deal_id',$deal_id);

		$query = $this->db->get();
        $error = $this->db->error();
        if($error['code'] > 0) {
            return EXIT_DATABASE;
        }
        $result = $query->result();
        $item = $this->Item->getItem(NULL, $result[0]->item_id, NULL);
        $result[0]->item_rent = $item->item_rent;
		return $result[0];
	}
	
	// TODO: Remove cyclometric complexity for 'User' model
	// get currently ongoing deals, for cron job and for tranferring coins
	public function getOngoingDeals(){
		$this->db->select('deal_id, b_id, g_id, item_id, no_of_days');
		$this->db->where('status', DEAL_STATUS_RENTING_START);
		$this->db->where('no_of_days >', 0 );
		$this->db->from('Deals');

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

	// exchange information
	public function should_show_contact($user_one_id = NULL, $user_two_id = NULL) {
		if (is_null($user_one_id) OR is_null($user_two_id))
			return EXIT_ERROR;
		$sql = 'SELECT Deals.deal_id FROM Deals WHERE (status = '.DEAL_STATUS_ACCEPTED.' OR status = '.DEAL_STATUS_RENTING_START.' OR status = '.DEAL_STATUS_RENTING_END. ' OR status = '.DEAL_STATUS_G_SEEN.'
			OR status = '.DEAL_STATUS_B_SEEN.') AND g_id = ? AND b_id = ?';
		/*$this->db->select('deal_id');
		$this->db->where('status', DEAL_STATUS_ACCEPTED);
		$this->db->or_where('status', DEAL_STATUS_RENTING_START);
		$this->db->or_where('status', DEAL_STATUS_RENTING_END);
		$this->db->or_where('status', DEAL_STATUS_G_SEEN);
		$this->db->or_where('status', DEAL_STATUS_B_SEEN);
		$this->db->where('g_id', $user_one_id );
		$this->db->where('b_id', $user_two_id );
		$this->db->from('Deals');*/

		$query = $this->db->query($sql, array($user_one_id, $user_two_id));
		$error = $this->db->error();
		if($error['code'] > 0) {
			return EXIT_DATABASE;
		}
		$result = $query->result();
		if(count($result) == 0) {
			$query = $this->db->query($sql, array($user_two_id, $user_one_id));
			$error = $this->db->error();
			if($error['code'] > 0) {
				return EXIT_DATABASE;
			}
			$result = $query->result();
			if(count($result) == 0) {
				return FALSE;
			}
			return TRUE;
		}
		return TRUE;
	}

	public function get_todays_starting_deals() {
		$todays_date = $nowFormat = date('Y-m-d');
		$this->db->select('deal_id, no_of_days');
		$this->db->where('status', DEAL_STATUS_ACCEPTED);
		$this->db->where('start_date = ',  $todays_date);
		$this->db->from('Deals');

		$query = $this->db->get();
		$error = $this->db->error();
		if($error['code'] > 0) {
			return EXIT_DATABASE;
		}
		$result = $query->result();
		return $result;		
	}

	public function get_todays_ending_deals() {
		$this->db->select('deal_id, no_of_days');
		$this->db->where('status', DEAL_STATUS_RENTING_START);
		$this->db->where('no_of_days = ',  0);
		$this->db->from('Deals');

		$query = $this->db->get();
		$error = $this->db->error();
		if($error['code'] > 0) {
			return EXIT_DATABASE;
		}
		$result = $query->result();
		return $result;		
	}

	public function transferCoins($g_id = NULL, $b_id = NULL, $item_id = NULL){
		if(is_null($g_id) OR is_null($b_id) OR is_null($item_id)){
			return NULL;
		}
		$item = $this->Item->getItem(NULL, $item_id, NULL);
		if($item){
			$item_rent_price = $item->item_rent;
			// increase giver's coin
			$this->User->UpdateEarnings($g_id, $item_rent_price);

			// reduce borrowers's coin
			$this->User->UpdateOffset($b_id, -$item_rent_price);
			$this->User->update_coins($b_id , -$item_rent_price);
			var_dump($item_rent_price);
		}
	}

	public function reduceDealDay($deal_id = NULL){
		if(is_null($deal_id)){
			return NULL;
		}
		$this->db->set('no_of_days', 'no_of_days-1', FALSE);
		$this->db->where('deal_id', $deal_id); 
		$this->db->update('Deals');
	}
	
	public function startDeal($deal_id){
		$this->updateDeal($deal_id, DEAL_STATUS_RENTING_START);
	}
	
	public function stopDeal($deal_id){
		$this->updateDeal($deal_id, DEAL_STATUS_RENTING_END);
	}

	public function updateDeal($deal_id, $status, $review_status = NULL, $who = NULL) {
		if (is_null($review_status)) {
			$this->db->where('deal_id', $deal_id);
			$data = array(
				'status' => $status
			);  
			$this->db->update('Deals', $data);
			$error = $this->db->error();
			if($error['code'] > 0) {
				return EXIT_DATABASE; 
			}

			$deal = $this->getDeal($deal_id);
			// deactivating the item
			if($status == 1) {
				$this->Item->updateItemStatus($deal->g_id, $deal->item_id, DEACTIVATE_ITEM);
			}
			// reactivate the item
			else if($status == 5 OR $status == 6){
				$this->Item->updateItemStatus($deal->g_id, $deal->item_id, ACTIVATE_ITEM);
			}
			return 1;
		} else if (is_numeric($review_status) AND $who) {
			// updating review details
			$this->db->where('deal_id', $deal_id);
			if ($who == GIVER) {
				$data = array(
				'g_reviewed' => $review_status
				);	
			} else if ($who == BORROWER) {
				$data = array(
				'b_reviewed' => $review_status
				);
			} else {
				return EXIT_USER_INPUT;
			}
			$this->db->update('Deals', $data);
			$error = $this->db->error();
			if($error['code'] > 0) {
				return EXIT_DATABASE; 
			}
		}
	}
	
	public function isAlreadyEntered($user_id = NULL, $item_id = NULL) {
		if(is_null($user_id) AND is_null($item_id)) {
			return EXIT_ERROR;
		}

		$giver_id = $this->Item->getGiverId($item_id);
		$this->db->select('status');
		$this->db->from('Deals');
		$this->db->where('item_id',$item_id);
		$this->db->where('b_id',$user_id);
		$this->db->where('g_id',$giver_id);

		$query = $this->db->get();
		$error = $this->db->error();

		if($error['code'] > 0) {
			return EXIT_DATABASE;
		}
		$result = $query->result();
		if (count($result) == 0)
			return NULL; // already entred
		return $result[0]->status;
	} 

	public function notify_giver($user_id = NULL) {
		if(is_null($user_id)) { return NULL; }
		else {
			/*$sql = 'SELECT Deals.status, Deals.deal_id, Users.user_name, Users.user_id, Items.item_name, Deals.g_reviewed FROM Items, Deals, Users
				WHERE Items.Item_id = Deals.item_id AND Deals.b_id = Users.user_id AND
				(Deals.status != '. DEAL_STATUS_CANCELLED .' AND Deals.status != '. DEAL_STATUS_G_SEEN .' AND
				Deals.status !='. DEAL_STATUS_UNSUCCESS_SEEN .' AND Deals.status != '. DEAL_STATUS_BOTH_SEEN.')
				AND Deals.g_id = ?';*/
			$sql = 'SELECT Deals.status, Deals.deal_id, Users.user_name, Users.user_id, Items.item_name, Deals.g_reviewed FROM Items, Deals, Users
				WHERE Items.Item_id = Deals.item_id AND Deals.b_id = Users.user_id AND Deals.g_id = ?';
			$query = $this->db->query($sql, array($user_id));
			return $query->result();
		}
	}
	
	public function notify_borrower($user_id = NULL) {
		if(is_null($user_id)) { return NULL; }
		else {
			/*$sql = 'SELECT Deals.status, Deals.deal_id, Users.user_name, Users.user_id, Items.item_name, Deals.b_reviewed FROM Items, Deals, Users
				WHERE Users.user_id = Deals.g_id AND Deals.item_id = Items.item_id AND
				(Deals.status != '. DEAL_STATUS_PENDING .' AND Deals.status != '. DEAL_STATUS_B_SEEN .' AND
				Deals.status !='. DEAL_STATUS_UNSUCCESS_SEEN .' AND Deals.status != '. DEAL_STATUS_BOTH_SEEN.')
				AND Deals.b_id = ?';*/
			$sql = 'SELECT Deals.status, Deals.deal_id, Users.user_name, Users.user_id, Items.item_name, Deals.b_reviewed FROM Items, Deals, Users
				WHERE Users.user_id = Deals.g_id AND Deals.item_id = Items.item_id AND Deals.b_id = ?';
			$query = $this->db->query($sql, array($user_id));
			return $query->result();
		}
	}

	public function insert($b_id, $g_id, $item_id, $status, $start_date, $no_of_days) {
		$date = date("Y-m-d",strtotime($start_date));
		$data = array(
			'b_id' => $b_id,
			'g_id' => $g_id,
			'item_id' => $item_id,
			'status' => $status,
			'start_date' => $date,
			'no_of_days' => $no_of_days,
			'deal_days' => $no_of_days
		);

		$this->db->insert('Deals', $data);

		$error = $this->db->error();
		if($error['code'] > 0) {
			return EXIT_DATABASE;
		}
		return $this->db->insert_id();
	}
	
}
