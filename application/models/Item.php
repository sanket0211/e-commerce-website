<?php
class Item extends CI_Model {
	/*
	 * STATUS CODES | 	MEANING
	 * --------------------------------------
	 * 		0		| 	READY FOR RENT, ACTIVATE
	 *		1		|	RENTED , DEACTIVATED
	 */
	
	public function __construct()
	{   
		$this->load->database();
	}

	public function getGiverId($item_id = NULL) {
		if(is_null($item_id)) { return NULL; }
		else {
			$this->db->select('user_id');
            $this->db->from('Items');
            $this->db->where('Item_id',$item_id);
			$query = $this->db->get();
			$error = $this->db->error();
        	if($error['code'] > 0) {
            	return 0;
        	}

			return $query->row()->user_id;
		}
	}
	public function getItem($comm_id = NULL, $item_id = NULL, $user_id=NULL)
	{
		if(is_null($item_id) AND is_null($comm_id) AND is_null($user_id)) {
			return NULL;
		}
		// return all items belongs to a community
		if($comm_id AND is_null($item_id) ) {
            $this->db->select('item_id,item_brand,item_purchase_price,item_key_features,item_terms,item_name,post_date, item_rent, item_end_date, item_img_name,item_img_ext,item_category_id, item_status');
            $this->db->from('Items');
			$this->db->where('community_id',$comm_id);

            $query = $this->db->get();
            $error = $this->db->error();
       		if($error['code'] > 0) {
           		return 0;
       		}
            return $query->result();
        }
        // return all items posted by user
        if($user_id AND is_null($item_id) AND is_null($comm_id))
        {
        	$sql = "select Items.item_status, Items.item_id,Items.item_purchase_price,Items.item_terms,Item.item_key_features,Item.item_brand,Item.post_date,Items.item_name, Items.item_end_date,item_category_id, Items.item_rent, Items.item_img_name, Items.item_img_ext from Items where Items.user_id = ?";
			$query = $this->db->query($sql, array($user_id));
			$error = $this->db->error();
			if($error['code'] > 0 OR is_null($query)) {
				return -1; // error
			}
			return $query->result();
        }
        // give details of a particular item
        else if($item_id) {
            $this->db->select('item_id, user_id, community_id, item_brand,item_purchase_price,item_key_features,item_terms,item_desc, item_name,post_date, item_rent, item_end_date, item_img_name,item_img_ext,item_category_id, item_status');
            $this->db->from('Items');
			$this->db->where('item_id',$item_id);
            $query = $this->db->get();
			$result = $query->result();
			
            $error = $this->db->error();
			if($error['code'] > 0) {
				return ;
			} else if($query->num_rows() == 0) {
				return NULL; // error or no such item
			}
			return $result[0];
        }
	}

	public function getItemInfo($item_id) {
		$this->db->select('item_id, item_name, item_rent, item_img_name, item_img_ext');
        $this->db->from('Items');
		$this->db->where('item_id',$item_id);
        $query = $this->db->get();
		$result = $query->result();
		
        $error = $this->db->error();
		if($error['code'] > 0) {
			return EXIT_DATABASE;
		} else if($query->num_rows() == 0) {
			return NULL; // error or no such item
		}
		return $result[0];
	}

	public function getGiver($item_id){
		$this->db->select('item_id,user_id');
        $this->db->from('Items');
		$this->db->where('item_id',$item_id);

        $query = $this->db->get();
		$result = $query->result();

		$giver_id = $result[0]->user_id;

		$this->db->select('user_name,user_id');
        $this->db->from('Users');
		$this->db->where('user_id',$giver_id);
        $query = $this->db->get();

		$result = $query->result();
		return $result[0];
	}

	public function updateitemdetails($user_id,$item_id){
		$item_name=$this->input->post('item_name');
		$item_rent=$this->input->post('item_rent');
		$item_desc=$this->input->post('item_desc');
		$item_cat_id=$this->input->post('item_sub_cat_id');
		$item_terms=$this->input->post('item_terms');
		$item_brand=$this->input->post('item_brand');
		$item_rent=$this->input->post('item_rent');
		$item_key_features=$this->input->post('item_key_features');
		$item_purchase_price=$this->input->post('item_purchase_price');
		


		$this->db->set('item_name', $item_name)
                ->where('item_id', $item_id)
                ->where('user_id',$user_id)
                ->update('Items');

        $this->db->set('item_brand', $item_brand)
                ->where('item_id', $item_id)
                ->where('user_id',$user_id)
                ->update('Items');

        $this->db->set('item_terms', $item_terms)
                ->where('item_id', $item_id)
                ->where('user_id',$user_id)
                ->update('Items');

        $this->db->set('item_key_features', $item_key_features)
                ->where('item_id', $item_id)
                ->where('user_id',$user_id)
                ->update('Items');

        $this->db->set('item_purchase_price', $item_purchase_price)
                ->where('item_id', $item_id)
                ->where('user_id',$user_id)
                ->update('Items');

        $this->db->set('item_desc', $item_desc)
                ->where('item_id', $item_id)
                ->where('user_id',$user_id)
                ->update('Items');

        $this->db->set('item_category_id', $item_cat_id)
                ->where('item_id', $item_id)
                ->where('user_id',$user_id)
                ->update('Items');

        $this->db->set('item_rent', $item_rent)
                ->where('item_id', $item_id)
                ->where('user_id',$user_id)
                ->update('Items');
	}

	public function getmycommunityitems($user_id = NULL)
	{
		if($user_id)
		{
			$sql = "select item_id,item_purchase_price,item_key_features,item_brand, item_name,item_desc,Items.community_id, item_category_id, item_rent,item_end_date, item_img_name, item_img_ext, item_thumb_name from Items,Members where Items.community_id = Members.community_id and Items.activity = 1 and Members.member_id = ?";
			$query = $this->db->query($sql, array($user_id));
			$error = $this->db->error();
			if($error['code'] > 0 OR $query == FALSE) {
				return -1; // error
			}
			return $query->result();
		}
	}

	public function getmyactiveitems($user_id = NULL)
	{
		if($user_id)
		{

			$sql = "select item_id,item_purchase_price,item_name,item_desc,Items.community_id, item_category_id, item_rent,item_end_date, item_img_name, item_img_ext, item_thumb_name from Items where Items.activity = 1 and Items.user_id = ?";
			$query = $this->db->query($sql, array($user_id));
			$error = $this->db->error();
			if($error['code'] > 0 OR is_null($query)) {
				return -1; // error
			}
			return $query->result();
		}
	}

	public function getmynotactiveitems($user_id = NULL)
	{
		if($user_id)
		{
			$sql = "select item_id, item_name,item_desc,Items.community_id, item_category_id, item_rent,item_end_date, item_img_name, item_img_ext, item_thumb_name from Items where Items.activity = 0 and Items.user_id = ?";
			$query = $this->db->query($sql, array($user_id));
			$error = $this->db->error();
			if($error['code'] > 0 OR is_null($query)) {
				return -1; // error
			}
			return $query->result();
		}
	}

	public function deactivateitem($item_id,$user_id){
		$this->db->set('activity', 0)  
                ->where('item_id', $item_id)
                ->where('user_id',$user_id)
                ->update('Items');
	}

	public function activateitem($item_id,$amount,$user_id){
		$this->db->set('activity', 1)  
                ->where('item_id', $item_id)
                ->where('user_id',$user_id)
                ->update('Items');

        $this->db->set('item_rent', $amount)  
                ->where('item_id', $item_id)
                ->where('user_id',$user_id)
                ->update('Items');
	}
		
	public function is_item_activated($item_id) {
		$this->db->select('activity');
        $this->db->from('Items');
		$this->db->where('item_id',$item_id);

        $query = $this->db->get();
        $error = $this->db->error();
        if ($error['code'] > 0) {
        	return EXIT_DATABASE;
        }
        $result = $query->result();
        if (count($result) == 0)
        	return EXIT_ERROR;
        $result = $result[0];
        if ($result->activity == 0)
        	return FALSE;
        return TRUE;
	}

	// give list of my items and check given item is mine
	public function isMyItem($item_id = NULL, $user_id = NULL) {
		if(is_null($user_id)) {
			return NULL;
		}
		else if(is_null($item_id)) {
            $this->db->select('item_id,item_name, item_rent, item_end_date, item_img_name,item_img_ext,community_id');
			$this->db->from('Items');
			$this->db->where('user_id',$user_id);
			$query = $this->db->get();
			$result = $query->result();
			if(count($result) > 0)
			{   
				return $result[0];
			}   
			return NULL;
		}
		else {
			$this->db->select('item_id');
			$this->db->from('Items');
			$this->db->where('user_id',$user_id);
			$this->db->where('item_id',$item_id);
			$query = $this->db->get();
			$result = $query->result();
			if(count($result) > 0)
			{
				return True; // it is my item
			}
			return False; // it's not my item
		}
	}

	public function insert($user_id, $comm_id, $item_img_name, $item_img_ext, $item_thumb_name)
	{
		//$end_date = \DateTime::createFromFormat('m/d/Y', $this->input->post('item_end_date'));
		$data = array(
			'user_id' => $user_id,
			'community_id' => $comm_id,
			'item_name' => $this->input->post('item_name'),
			'item_desc' => $this->input->post('item_desc'),
			'item_rent' => $this->input->post('item_rent'),
			'item_category_id' => $this->input->post('item_sub_cat_id'),
			'item_img_name' => $item_img_name,
			'item_img_ext' => $item_img_ext,
			'item_thumb_name' => $item_thumb_name,
			'item_brand' => $this->input->post('item_brand'),
			'item_terms' => $this->input->post('item_terms'),
			'item_purchase_price' => $this->input->post('item_price'),
			'item_key_features' => $this->input->post('keyfeatures')
		);
		$this->db->set('post_date', 'NOW()', FALSE); // posting date of item
		$this->db->set('item_end_date', 'NOW()', FALSE);
		$this->db->insert('Items', $data);
		$error = $this->db->error();	
		if($error['code'] > 0) {
			return EXIT_DATABASE;
		}
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	public function updateitemimage($user_id, $item_id, $item_img_name, $item_img_ext, $item_thumb_name){
		
		if(is_null($user_id)) { return NULL; }
		/*print_r($item_id);
		die();*/
		$sql = "UPDATE Items SET item_img_name=?, item_img_ext=?, item_thumb_name=? WHERE Items.user_id=? AND Items.item_id=?" ;
		$query = $this->db->query($sql, array($item_img_name,$item_img_ext,$item_thumb_name,$user_id,$item_id,));
		
		return $query;
	}

	public function updateItemStatus($user_id = NULL, $item_id = NULL, $status = NULL){
		if(is_null($user_id) OR is_null($item_id) OR is_null($status)){
			return NULL; // invalid request
		}
		if($this->isMyItem($item_id,$user_id)){
			$this->db->set('item_status', $status)  
                ->where('item_id', $item_id)
                ->update('Items');
            return 0; // success
		}
		return -1; // unsuccessful
	}
	
	// Get last 5 recent item posted by users
	public function getRecentItems($user_id = NULL) {
		if($user_id)
		{
			$sql = "SELECT item_id, item_name, item_desc, Items.community_id, item_category_id,
					item_rent,item_end_date, item_img_name, item_img_ext, item_thumb_name FROM Items,Members
					WHERE Items.community_id = Members.community_id and Members.member_id = ?
					ORDER BY Items.item_id DESC LIMIT 5";
			$query = $this->db->query($sql, array($user_id));
			$error = $this->db->error();
			if($error['code'] > 0 OR $query == FALSE) {
				return -1; // error
			}
			$result = $query->result();
			return $result;
		}
	}
	
	// Get related products
	public function getRelatedItems($user_id = NULL, $category_id = NULL) {
		if (is_numeric($category_id) AND is_numeric($user_id)) {
			$sql = "SELECT item_id, item_name, item_desc, Items.community_id, item_category_id,
					item_rent,item_end_date, item_img_name, item_img_ext, item_thumb_name FROM Items,Members,Sub_Categories
					WHERE Items.community_id = Members.community_id AND Items.item_category_id = Sub_Categories.sub_category_id
					AND Members.member_id = ? AND Sub_Categories.category_id = ?";
			$query = $this->db->query($sql, array($user_id, $category_id));
			$error = $this->db->error();
			if($error['code'] > 0 OR $query == FALSE) {
				return -1; // error
			}
			$result = $query->result();
			return $result;
		}
		return NULL;
	}
}
?>
