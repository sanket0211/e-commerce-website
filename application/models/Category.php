<?php
class Category extends CI_Model {
	public function __construct()
	{   
		$this->load->database();
	}

	public function getCategories(){
		$this->db->select('category_id, category_name');
		$this->db->from('Categories');

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

	public function getSubCategories($cat_id = NULL){
		if(is_null($cat_id)){
			$this->db->select('category_id, sub_category_id, sub_category_name');
			$this->db->from('Sub_Categories');

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
		else {
			$this->db->select('category_id, sub_category_id, sub_category_name');
			$this->db->from('Sub_Categories');
			$this->db->where('category_id',$cat_id);


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
	}

	public function getCatSub($sub_id = NULL){
		if(is_null($sub_id)){ return NULL;}
		$sql = "select S.sub_category_id,S.category_id,sub_category_name,C.category_name from Sub_Categories as S,Categories as C where S.sub_category_id = ? AND C.category_id = S.category_id";
		
		$query = $this->db->query($sql, array($sub_id));
		$error = $this->db->error();
		if($error['code'] > 0) {
			return -1;  // error
		}
		return $query->result()[0];
	}
}